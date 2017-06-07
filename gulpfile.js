var gulp = require('gulp');
var sass = require('gulp-sass');
var postcss = require('gulp-postcss');
var browserSync = require('browser-sync');
var autoprefixer = require('gulp-autoprefixer');
var cssnext = require('postcss-cssnext');
var sourcemaps = require('gulp-sourcemaps');
var plumber = require('gulp-plumber');
var notify = require('gulp-notify');
// var cssmin = require('gulp-cssmin');
// var rename = require('gulp-rename');
// var fileSync = require('gulp-file-sync');

gulp.task('sass', function() {
  // var processors = [
  //   cssnext({browsers: ['last 2 version', 'iOS 8.4'], flexbox: 'no-2009'})
  // ];
  return gulp.src(['sass/*.scss'])
  .pipe(sourcemaps.init())
  .pipe(plumber({errorHandler: notify.onError('<%= error.message %>')}))
  .pipe(sass({outputStyle: 'expanded',}))
  // .pipe(postcss(processors))
  .pipe(sourcemaps.write())
  .pipe(gulp.dest('.'));
});
gulp.task('browser-sync', function () {
  browserSync({
    open: 'external',
    notify: false,
    proxy: "http://coldbox.dev/",
    port: "8000",
    // reloadDelay: 300
  });
});
gulp.task('bs-reload', function () {
  browserSync.reload();
});
gulp.task('default', ['browser-sync'], function () {
  gulp.watch("sass/*.scss", ['sass', 'bs-reload']);
  gulp.watch("js/*.*", ['bs-reload']);
  gulp.watch("parts/*.*", ['bs-reload']);
  gulp.watch("czr/*.*", ['bs-reload']);
  gulp.watch("*.*", ['bs-reload']);
});
