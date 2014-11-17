(function() {
  var gulp, png, svg, svgSprites;

  gulp = require('gulp');

  svgSprites = require('gulp-svg-sprites');

  svg = svgSprites.svg;

  png = svgSprites.png;

  module.exports = function() {
    return gulp.task('svg_sprites', function() {
      return gulp.src('assets/images/svg/*.svg').pipe(gulp.dest("public/images/svg")).pipe(svg()).pipe(gulp.dest("assets/stylesheets/svg")).pipe(png());
    });
  };

}).call(this);
