gulp = require('gulp')
cssmin = require('gulp-cssmin')
rename = require('gulp-rename')
module.exports = ->
  gulp.task 'cssmin', ['sass'], ->
    gulp.src('public/css/application.css')
    .pipe(cssmin())
    .pipe(rename('application.min.css'))
    .pipe gulp.dest('public/css')