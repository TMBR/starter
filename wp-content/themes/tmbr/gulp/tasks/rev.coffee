gulp = require('gulp')
rev = require('gulp-rev')

module.exports = ->
  gulp.task 'rev', ['uglify_app', 'uglify_vendor', 'cssmin'], ->
    gulp.src([
      'public/css/application.css'
      'public/js/application.js'
      'public/js/vendor.js'
      'public/css/application.min.css'
      'public/js/application.min.js'
      'public/js/vendor.min.js'
    ],
    base: 'public'
    )
      .pipe(gulp.dest('public'))
      .pipe(rev())
      .pipe(gulp.dest('public'))
      .pipe rev.manifest()
      .pipe gulp.dest('public')