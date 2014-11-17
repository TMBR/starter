(function() {
  var cssmin, gulp, rename;

  gulp = require('gulp');

  cssmin = require('gulp-cssmin');

  rename = require('gulp-rename');

  module.exports = function() {
    return gulp.task('cssmin', ['sass'], function() {
      return gulp.src('public/css/application.css').pipe(cssmin()).pipe(rename('application.min.css')).pipe(gulp.dest('public/css'));
    });
  };

}).call(this);
