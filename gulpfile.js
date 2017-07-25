var gulp = require('gulp');
var sass = require('gulp-sass');
var postcss = require('gulp-postcss');
var browserSync = require('browser-sync');
var autoprefixer = require('gulp-autoprefixer');
var cssnext = require('postcss-cssnext');
var notify = require('gulp-notify');
var cssmin = require('gulp-cssmin');
var minify = require('gulp-minify');
var rename = require('gulp-rename');
var plumber = require('gulp-plumber');
var sourcemaps = require('gulp-sourcemaps');
var concat = require("gulp-concat");
var runSequence = require('run-sequence');
var del = require('del');

gulp.task( 'sass', function() {
  var processors = [
    cssnext({browsers: ['last 2 version', 'iOS 8.4'], flexbox: 'no-2009'})
  ];
  return gulp.src(['sass/*.scss'])
  .pipe(sourcemaps.init())
  .pipe(plumber({errorHandler: notify.onError('<%= error.message %>')}))
  .pipe(sass({outputStyle: 'expanded',}))
  .pipe(postcss(processors))
  .pipe(sourcemaps.write())
  .pipe(gulp.dest('.'));
});

gulp.task( 'css-min', function () {
  gulp.src( 'style.css' )
  .pipe(cssmin())
  .pipe(rename({suffix: '.min'}))
  .pipe(gulp.dest('.'));
});

gulp.task( 'css-concat', ['css-min'], function () {
  gulp.src( ['style.min.css', 'fonts/fontawesome/css/font-awesome.min.css'] )
  .pipe( concat('main.min.css') )
  .pipe(gulp.dest( '.' ));
});

gulp.task( 'js-min', function() {
  return gulp.src( 'js/cd-scripts.js' )
  .pipe( minify({ ext:{ min:'.min.js', }, }) )
  .pipe( gulp.dest( 'assets/js/' ) );
});

gulp.task( 'js-concat-hljs', ['js-min'], function() {
  return gulp.src( ['js/highlight.js', 'js/cd-scripts.js'] )
  .pipe( concat( 'cd-scripts+hljs.js' ) )
  .pipe( gulp.dest( 'js/' )  );
});

gulp.task( 'js-concat-hljs-web', ['js-min'], function() {
  return gulp.src( ['js/highlight-web.js', 'js/cd-scripts.js'] )
  .pipe( concat( 'cd-scripts+hljs_web.js' ) )
  .pipe( gulp.dest( 'js/' ) );
});

gulp.task( 'js-min-concat', ['js-concat-hljs', 'js-concat-hljs-web'], function() {
  return gulp.src( ['js/cd-scripts+hljs.js', 'js/cd-scripts+hljs_web.js'] )
  .pipe( minify({ ext:{ min:'.min.js', }, }) )
  .pipe( gulp.dest( 'assets/js' ) );
});

gulp.task( 'clean', ['js-min-concat'], function(cb) {
  del( ['assets/js/cd-scripts+hljs.js', 'assets/js/cd-scripts+hljs_web.js', 'assets/js/cd-scripts.js'], cb );
});

gulp.task( 'browser-sync', function () {
  browserSync({
    open: 'external',
    notify: false,
    proxy: "http://coldbox.vccw/",
  });
});

gulp.task( 'editor-sass', function() {
  var processors = [ cssnext({browsers: ['last 2 version', 'iOS 8.4'], flexbox: 'no-2009'}) ];
  return gulp.src('parts/editor-style.scss')
  .pipe(sourcemaps.init())
  .pipe(plumber({errorHandler: notify.onError('<%= error.message %>')}))
  .pipe(sass({outputStyle: 'expanded',}))
  .pipe(postcss(processors))
  .pipe(gulp.dest( 'parts' ));
});

gulp.task( 'editor-min', ['editor-sass'], function() {
  gulp.src('parts/editor-style.css')
  .pipe(cssmin())
  .pipe(rename({suffix: '.min'}))
  .pipe(gulp.dest('parts'));
});

gulp.task( 'bs-reload', function () {
  browserSync.reload();
});
gulp.task( 'default', ['browser-sync'], function () {
  gulp.watch("sass/*.scss", ['sass', 'bs-reload', 'css-min']);
  gulp.watch("js/*.*", ['bs-reload', 'js-min', 'js-concat-hljs-web', 'js-concat-hljs']);
  gulp.watch("parts/*.*", ['bs-reload']);
  gulp.watch("parts/*.scss", ['editor-sass', 'editor-min'])
  gulp.watch("czr/*.*", ['bs-reload']);
  gulp.watch("*.php", ['bs-reload']);
});

gulp.task( 'copy', function() {
  return gulp.src(
    [ '*.php', 'readme.txt', 'screenshot.jpg', '*.css', 'parts/*.php', 'parts/*.css', 'js/*.js', 'img/*.*',
      'czr/*.*', 'fonts/fontawesome/css/*.css', 'fonts/fontawesome/fonts/*.*', 'fonts/icomoon/*.css', 'fonts/icomoon/fonts/*.*', 
      'languages/coldbox.po', 'assets/js/*.js' ],
    { base: '.' }
  )
  .pipe( gulp.dest( 'dist' ) );
} );

gulp.task( 'sass-dev', function() {
  var processors = [
    cssnext({browsers: ['last 2 version', 'iOS 8.4'], flexbox: 'no-2009'})
  ];
  return gulp.src(['sass/*.scss'])
  .pipe(sass({outputStyle: 'expanded',}))
  .pipe(postcss(processors))
  .pipe(gulp.dest('.'));
});

gulp.task( 'dist', function(cb){
    return runSequence( 'sass-dev', 'css-min', 'editor-sass', 'editor-min', 'js-concat-hljs', 'js-concat-hljs-web', 'copy', cb );
});