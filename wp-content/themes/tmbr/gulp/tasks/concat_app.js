(function() {
  var CONF, concat, gulp;

  gulp = require("gulp");

  concat = require("gulp-concat");

  CONF = require("../config");

  module.exports = function() {
    return gulp.task("concat_app", function() {
      return gulp.src(CONF.files.concat_app).pipe(concat("application.js")).pipe(gulp.dest("public/js"));
    });
  };

}).call(this);
