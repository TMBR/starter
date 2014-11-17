(function() {
  var browserSync, gulp, notify, plumber, reload, sass;

  gulp = require("gulp");

  notify = require("gulp-notify");

  sass = require("gulp-sass");

  plumber = require("gulp-plumber");

  browserSync = require('browser-sync');

  reload = browserSync.reload;

  module.exports = function() {
    return gulp.task('sass', function() {
      return gulp.src("assets/stylesheets/application.scss").pipe(plumber()).pipe(sass({
        sourceComments: "map",
        errLogToConsole: true,
        sourceMap: "sass"
      })).pipe(gulp.dest("public/css"));
    });
  };

}).call(this);
