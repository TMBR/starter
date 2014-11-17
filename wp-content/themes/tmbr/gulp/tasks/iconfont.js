(function() {
  var gulp, iconfont;

  gulp = require('gulp');

  iconfont = require("gulp-iconfont");

  module.exports = function() {
    return gulp.task("iconfont", function() {
      return gulp.src(["assets/components/entypo/font/*.svg"]).pipe(iconfont({
        fontName: "entypo",
        appendCodepoints: true
      })).on("codepoints", function(codepoints, options) {
        return console.log(codepoints, options);
      }).pipe(gulp.dest("public/fonts/"));
    });
  };

}).call(this);
