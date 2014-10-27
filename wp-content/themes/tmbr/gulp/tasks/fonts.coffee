gulp = require('gulp')
module.exports = ->
  gulp.src('assets/fonts')
  .pipe gulp.dest('public/fonts')