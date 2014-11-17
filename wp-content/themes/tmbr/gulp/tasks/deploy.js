(function() {
  var gulp, shell;

  gulp = require('gulp');

  shell = require('gulp-shell');

  module.exports = function() {
    return gulp.task('deploy', shell.task(['git push origin']));
  };

}).call(this);
