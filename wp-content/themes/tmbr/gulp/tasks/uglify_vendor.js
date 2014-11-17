(function() {
  var CONF, gulp, rename, uglify;

  gulp = require("gulp");

  uglify = require("gulp-uglify");

  CONF = require("../config");

  rename = require("gulp-rename");

  module.exports = function() {
    return gulp.task("uglify_vendor", ["concat_vendor"], function() {
      gulp.src("public/js/vendor.js").pipe(uglify()).pipe(rename("vendor.min.js")).pipe(gulp.dest("public/js"));
    });
  };

}).call(this);
