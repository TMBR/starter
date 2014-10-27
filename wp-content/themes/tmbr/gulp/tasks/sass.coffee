gulp = require("gulp")
notify = require("gulp-notify")
sass = require("gulp-sass")
plumber = require("gulp-plumber")
browserSync = require('browser-sync')
reload = browserSync.reload

module.exports = ->
  gulp.task 'sass', ->
    gulp.src("assets/stylesheets/application.scss")
    .pipe(plumber())
    .pipe(sass(
      sourceComments: "map"
      errLogToConsole: true
      sourceMap: "sass"
      )
    )
    # .pipe reload
    #   stream: true
    .pipe gulp.dest("public/css")
