var gulp = require('gulp')
var sass = require('gulp-sass')
var postcss = require('gulp-postcss')
var browserSync = require('browser-sync')
var cssnext = require('postcss-cssnext')
var notify = require('gulp-notify')
var cssmin = require('gulp-cssmin')
var minify = require('gulp-minify')
var rename = require('gulp-rename')
var plumber = require('gulp-plumber')
var sourcemaps = require('gulp-sourcemaps')
var concat = require('gulp-concat')
var babel = require('gulp-babel')
var runSequence = require('run-sequence')
var del = require('del')
var stylus = require('gulp-stylus')

gulp.task('sass', function () {
  var processors = [
    cssnext({ browsers: ['last 2 version'], flexbox: 'no-2009' })
  ]
  return gulp.src(['sass/*.scss'])
    .pipe(sourcemaps.init())
    .pipe(plumber({ errorHandler: notify.onError('<%= error.message %>') }))
    .pipe(sass({ outputStyle: 'expanded' }))
    .pipe(postcss(processors))
    .pipe(rename({ prefix: 'cd-' }))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('assets/css/'))
})

gulp.task('css-min', function () {
  return gulp.src('assets/css/style.css')
    .pipe(cssmin())
    .pipe(rename({
      prefix: 'cd-',
      suffix: '.min'
    }))
    .pipe(gulp.dest('assets/css/'))
})

gulp.task('js', function () {
  return gulp.src('assets/js/cd-scripts.babel.js')
    .pipe(babel())
    .pipe(rename('cd-scripts.js'))
    .pipe(gulp.dest('assets/js/'))
})

gulp.task('js-min', ['js'], function () {
  return gulp.src('assets/js/cd-scripts.js')
    .pipe(minify({ ext: { min: '.min.js' } }))
    .pipe(gulp.dest('assets/js/'))
})

gulp.task('js-concat-hljs', ['js-min'], function () {
  return gulp.src(['assets/js/highlight.js', 'assets/js/cd-scripts.js'])
    .pipe(concat('cd-scripts+hljs.js'))
    .pipe(gulp.dest('assets/js/'))
})

gulp.task('js-concat-hljs-web', ['js-min'], function () {
  return gulp.src(['assets/js/highlight-web.js', 'assets/js/cd-scripts.js'])
    .pipe(concat('cd-scripts+hljs_web.js'))
    .pipe(gulp.dest('assets/js/'))
})

gulp.task('js-min-concat', ['js-concat-hljs', 'js-concat-hljs-web'], function () {
  return gulp.src(['assets/js/cd-scripts+hljs.js', 'assets/js/cd-scripts+hljs_web.js'])
    .pipe(minify({ ext: { min: '.min.js' } }))
    .pipe(gulp.dest('assets/js'))
})

gulp.task('browser-sync', function () {
  browserSync({
    notify: true,
    proxy: 'https://coldbox.fly/'
  })
})

gulp.task('editor-sass', function () {
  var processors = [ cssnext({browsers: ['last 2 version', 'iOS 8.4'], flexbox: 'no-2009'}) ]
  return gulp.src('parts/editor-style.scss')
    .pipe(sourcemaps.init())
    .pipe(plumber({errorHandler: notify.onError('<%= error.message %>')}))
    .pipe(sass({outputStyle: 'expanded'}))
    .pipe(postcss(processors))
    .pipe(gulp.dest('parts'))
})

gulp.task('editor-min', ['editor-sass'], function () {
  return gulp.src('parts/editor-style.css')
    .pipe(cssmin())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('parts'))
})

gulp.task('page-styl', function () {
  return gulp.src('sass/page-style.styl')
    .pipe(sourcemaps.init())
    .pipe(stylus())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('assets/css/'))
})

gulp.task('page-styl-min', ['page-styl'], function () {
  return gulp.src('assets/css/page-style.css')
    .pipe(cssmin())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('assets/css/'))
})

gulp.task('bs-reload', function () {
  browserSync.reload()
})
gulp.task('watch', ['browser-sync', 'js', 'sass'], function () {
  gulp.watch('sass/*.scss', ['sass', 'bs-reload', 'css-min'])
  gulp.watch('sass/*.styl', ['page-styl', 'bs-reload', 'page-styl-min'])
  gulp.watch('js/*.*', ['bs-reload', 'js', 'js-min', 'js-concat-hljs-web', 'js-concat-hljs'])
  gulp.watch('parts/*.*', ['bs-reload'])
  gulp.watch('parts/*.scss', ['editor-sass', 'editor-min'])
  gulp.watch('czr/*.*', ['bs-reload'])
  gulp.watch('*.php', ['bs-reload'])
})

gulp.task('clean', function () {
  del(['style.min.css'])
})

gulp.task('sass-dev', function () {
  var processors = [
    cssnext({browsers: ['last 2 version', 'iOS 8.4'], flexbox: 'no-2009'})
  ]
  return gulp.src(['sass/*.scss'])
    .pipe(sass({outputStyle: 'expanded'}))
    .pipe(postcss(processors))
    .pipe(gulp.dest('assets/css/'))
})

gulp.task('copy', function () {
  return gulp.src(
    [ '*.php', '*.css', 'readme.txt', 'screenshot.jpg', 'CHANGELOG.md',
      'parts/*.php', 'parts/*.css', 'parts/tgm/*.php', 'page-templates/*.php', 'img/*.*', 'czr/*.*',
      'fonts/fontawesome/css/*.css', 'fonts/fontawesome/fonts/*.*', 'fonts/icomoon/*.css', 'fonts/icomoon/fonts/*.*',
      'languages/coldbox.pot', 'assets/js/*.js', '!assets/js/*.babel.js', 'assets/css/*.css' ],
    { base: '.' }
  )
    .pipe(gulp.dest('dist'))
})

gulp.task('dist', function (cb) {
  return runSequence(['sass-dev', 'editor-sass', 'page-styl'], ['css-min', 'editor-min', 'page-styl-min'], ['js', 'js-min'], 'js-min-concat', 'clean', 'copy', cb)
})
