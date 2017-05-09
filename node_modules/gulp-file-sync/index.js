'use strict';

var gutil = require('gulp-util'),
    fs = require('fs-extra'),
    path = require('path'),
    crc = require('crc'),
    packageInfo = require('./package.json');

var pluginDisplayName = packageInfo.name.replace('gulp-', '');

var isIgnored = function(_options, _dir, _file) {
	if (_options.ignore) {
		if (Array.isArray(_options.ignore)) {
      // 为了让 ignore 参数更容易使用，ignore 参数支持传入数组
      // 如果 ignore 的文件为数组，则遍历数组元素并把每个元素封装成一个 options，然后重新调用 isIgnored
			return _options.ignore.some(function(_filter) {
				return isIgnored({ ignore: _filter }, _dir, _file);
			});
		} else {
			var _ignoreFileType = typeof _options.ignore;
      // 判断参数类型，转换为实际使用的类型
			if (_ignoreFileType === 'function') {
				return _options.ignore(_dir, _file);

			} else if (_ignoreFileType === 'string') {
				return _options.ignore === _file;

			} else {
				// 获取匹配的文件 
				var _matcheFile = _options.ignore.exec(_file);
				return _matcheFile && _matcheFile.length > 0;
			}
		}
	}
	return false;
};

// 判断两个文件是否为相同的文件（即文件没有变动）
var isSameFile = function(_src, _dest) {
	var _srcCrc = crc.crc32(fs.readFileSync(_src)).toString(16),
      _destCrc = crc.crc32(fs.readFileSync(_dest)).toString(16);
	return _srcCrc === _destCrc;
};

// 移除文件
var remove = function(_options, _src, _dest) {

	var _files = fs.readdirSync(_dest);
	_files.forEach(function(_file) {
		if (isIgnored(_options, _dest, _file)) {
			return;
		}
		var _fullPathSrc = path.join(_src, _file),
        _fullPathDest = path.join(_dest, _file),
        _statDest = fs.statSync(_fullPathDest);

    if (_statDest.isDirectory() && !_options.recursive) {
      // 不允许递归子目录
      return;
    }

		if (!fs.existsSync(_fullPathSrc)) {
      _options.beforeDeleteFileCallback && _options.beforeDeleteFileCallback(_fullPathSrc);

      // 如果一个文件不在源目录而在目标目录，则删除该文件
			fs.removeSync(_fullPathDest);

      _options.deleteFileCallback(_fullPathSrc, _fullPathDest);

		} else {
      var _statSrc = fs.statSync(_fullPathSrc);
			if (_statSrc.isFile() !== _statDest.isFile() || _statSrc.isDirectory() !== _statDest.isDirectory()) {
        _options.beforeDeleteFileCallback && _options.beforeDeleteFileCallback(_fullPathSrc);

        fs.removeSync(_fullPathDest);

        _options.deleteFileCallback(_fullPathSrc, _fullPathDest);

			} else if (_statDest.isDirectory()) {
				remove(_options, _fullPathSrc, _fullPathDest);
			}
		}
	} );
};

// 新增文件
var add = function(_options, _src, _dest) {

	var _files = fs.readdirSync(_src);
	_files.forEach(function(_file) {
		if (isIgnored(_options, _src, _file)) {
			return;
		}
		var _fullPathSrc = path.join(_src, _file),
        _fullPathDest = path.join(_dest, _file),
        _existsDest = fs.existsSync(_fullPathDest),
        _statSrc = fs.statSync(_fullPathSrc);
		if (_statSrc.isFile()) {
			if (_existsDest) {
				var _statDest = fs.statSync(_fullPathDest);
				if (_statDest.isFile()) {
          // 源目录与目标目录都存在该文件，判断该文件是否为相同的文件（没有被修改过）
					if (!isSameFile(_fullPathSrc, _fullPathDest)) {
            // 文件不相同，即文件被修改过，则把新文件拷贝到目标目录

            _options.beforeUpdateFileCallback && _options.beforeUpdateFileCallback(_fullPathSrc);

            // forece 参数为 true 表明可以操作 index.js 所在目录更上层的目录内的文件
						fs.copySync(_fullPathSrc, _fullPathDest, { force: true });

            _options.updateFileCallback(_fullPathSrc, _fullPathDest);
					}
				}
			} else {
        // 如果文件只存在于源目录而不在目标目录，即为新增文件，同步到目标目录
        
        _options.beforeAddFileCallback && _options.beforeAddFileCallback(_fullPathSrc);
     
        // forece 参数为 true 表明可以操作 index.js 所在目录更上层的目录内的文件
				fs.copySync(_fullPathSrc, _fullPathDest, { force: true });

        _options.addFileCallback(_fullPathSrc, _fullPathDest);
			}

		} else if (_statSrc.isDirectory()) {

      if (!_options.recursive) {
        // 不允许递归子目录
        return;
      }

			if (!_existsDest) {
				fs.mkdirsSync(_fullPathDest);
			}
			add(_options, _fullPathSrc, _fullPathDest);
		}
	} );
};

// 同步文件操作
var fileSync = function(_src, _dest, _options) {
  if (typeof(_src) !== 'string') { 
    throw new gutil.PluginError(pluginDisplayName, 'Missing source directory or type is not a string.')
  }
  if (typeof(_dest) !== 'string') {
    throw new gutil.PluginError(pluginDisplayName, 'Missing destination directory or type is not a string.')
  }

	_options = _options || {};

  // 是否递归所有子目录的参数的默认值
  _options.recursive = (_options.recursive === undefined) || _options.recursive; 

  // 新增文件时输出到控制台的默认 callback 
  _options.addFileCallback  = _options.addFileCallback || function(_fullPathSrc, _fullPathDest) {
    gutil.log('File addition synced ' + _fullPathDest);
  };

  // 删除文件时输出到控制台的默认 callback
  _options.deleteFileCallback  = _options.deleteFileCallback || function(_fullPathSrc, _fullPathDest) {
    gutil.log('File deletion synced ' + _fullPathDest);
  };

  // 修改文件时输出到控制台的默认 callback
  _options.updateFileCallback  = _options.updateFileCallback || function(_fullPathSrc, _fullPathDest) {
    gutil.log('File modification synced ' + _fullPathDest);
  };

  // 检查目标目录是否存在，如果目标目录不存在则创建一个，如果目标目录不存在而直接写入文件则会 crash
  fs.ensureDirSync(_dest);
  remove(_options, _src, _dest);
  add(_options, _src, _dest);
};

module.exports = fileSync;
