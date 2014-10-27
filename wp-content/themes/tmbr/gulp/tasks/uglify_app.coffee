gulp = require("gulp")
uglify = require("gulp-uglify")
CONF = require("../config")
rename = require("gulp-rename")
module.exports = ->
  gulp.task "uglify_app", ["coffee"], ->
    gulp.src("public/js/application.js").pipe(uglify()).pipe(rename("application.min.js")).pipe gulp.dest("public/js")