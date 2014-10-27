gulp = require("gulp")
concat = require("gulp-concat")
CONF = require("../config")
module.exports = ->
  gulp.task "concat_vendor", ->
    gulp.src(CONF.files.concat_vendor).pipe(concat("vendor.js")).pipe gulp.dest("public/js")

