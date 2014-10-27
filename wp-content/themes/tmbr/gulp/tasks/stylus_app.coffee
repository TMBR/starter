# unused, but left available for reference and in case of future use.
gulp = require("gulp")
notify = require("gulp-notify")
stylus = require("gulp-stylus")
module.exports = ->
  gulp.src("assets/stylesheets/application.styl").pipe(stylus(set: [
    "resolve url"
    "include css"
    "linenos"
    "compress"
  ])).on("error", notify.onError(
    message: "<%= error.message %>"
    title: "Stylus Error"
  )).pipe gulp.dest("public/stylesheets")
