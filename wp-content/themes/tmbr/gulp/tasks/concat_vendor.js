(function() {
  var CONF, concat, gulp;

  gulp = require("gulp");

  concat = require("gulp-concat");

  CONF = require("../config");

  module.exports = function() {
    return gulp.task("concat_vendor", function() {
      return gulp.src(CONF.files.concat_vendor).pipe(concat("vendor.js")).pipe(gulp.dest("public/js"));
    });
  };

}).call(this);
