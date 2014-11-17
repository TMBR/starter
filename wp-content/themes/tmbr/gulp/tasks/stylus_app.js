(function() {
  var gulp, notify, stylus;

  gulp = require("gulp");

  notify = require("gulp-notify");

  stylus = require("gulp-stylus");

  module.exports = function() {
    return gulp.src("assets/stylesheets/application.styl").pipe(stylus({
      set: ["resolve url", "include css", "linenos", "compress"]
    })).on("error", notify.onError({
      message: "<%= error.message %>",
      title: "Stylus Error"
    })).pipe(gulp.dest("public/stylesheets"));
  };

}).call(this);
