const path = require('path')

module.exports = (env, argv) => {
  const isModeNone = argv.mode === 'none'
  const isModeDev = argv.mode === 'development'
  const mode = argv.mode

  let entries
  if (isModeDev) {
    entries = {
      scripts: './assets/js/cd-scripts.babel.js'
    }
  } else {
    entries = {
      scripts: ['babel-polyfill', './assets/js/cd-scripts.babel.js'],
      hljs: './assets/js/hljs.js',
      hljs_web: './assets/js/hljs_web.js',
      'scripts+hljs': [
        'babel-polyfill',
        './assets/js/cd-scripts.babel.js',
        './assets/js/hljs.js'
      ],
      'scripts+hljs_web': [
        'babel-polyfill',
        './assets/js/cd-scripts.babel.js',
        './assets/js/hljs_web.js'
      ]
    }
  }

  return {
    mode: 'development',
    entry: entries,
    output: {
      filename: '[name].js',
      path:
        mode === 'none'
          ? path.join(__dirname, 'assets/js/unmin/')
          : path.join(__dirname, 'assets/js/min/')
    },
    devtool: mode === 'development' ? 'source-map' : 'none',
    optimization: {
      minimize: !isModeNone
    },
    module: {
      rules: [
        {
          test: /\.js$/,
          exclude: /node_modules/,
          use: [
            {
              loader: 'babel-loader',
              options: {
                presets: [['env', { modules: false }]],
                plugins: 'transform-es2015-for-of'
              }
            }
          ]
        }
      ]
    }
  }
}
