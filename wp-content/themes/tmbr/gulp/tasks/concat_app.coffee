gulp = require("gulp")
concat = require("gulp-concat")
CONF = require("../config")
module.exports = ->
  gulp.task "concat_app", ["coffee"], ->
    gulp.src(CONF.files.concat_app).pipe(concat("application.js")).pipe gulp.dest("public/js")