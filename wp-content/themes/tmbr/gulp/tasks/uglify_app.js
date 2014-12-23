(function() {
  var CONF, gulp, rename, uglify;

  gulp = require("gulp");

  uglify = require("gulp-uglify");

  CONF = require("../config");

  rename = require("gulp-rename");

  module.exports = function() {
    return gulp.task("uglify_app", function() {
      console.log('doing uglify');
      return gulp.src("public/js/application.js").pipe(uglify()).pipe(rename("application.min.js")).pipe(gulp.dest("public/js"));
    });
  };

}).call(this);
