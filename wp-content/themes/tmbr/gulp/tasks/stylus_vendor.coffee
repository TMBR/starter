# unused, but left available for reference and in case of future use.
gulp = require("gulp")
rename = require("gulp-rename")
notify = require("gulp-notify")
stylus = require("gulp-stylus")
module.exports = ->
  gulp.src("public/stylesheets/styl/vendor.styl").pipe(stylus(set: [
    "include css"
    "linenos"
  ])).on("error", notify.onError(
    message: "<%= error.message %>"
    title: "Stylus Error"
  )).pipe gulp.dest("public/stylesheets")
