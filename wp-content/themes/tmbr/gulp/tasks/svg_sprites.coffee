gulp = require('gulp')
svgSprites = require('gulp-svg-sprites')

svg = svgSprites.svg
png = svgSprites.png

module.exports = ->
  gulp.task 'svg_sprites', ->
    gulp.src('assets/images/svg/*.svg')
      .pipe(gulp.dest("public/images/svg"))
      .pipe(svg())
      .pipe(gulp.dest("assets/stylesheets/svg"))
      .pipe(png())