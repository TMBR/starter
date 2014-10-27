gulp = require("gulp")
uglify = require("gulp-uglify")
CONF = require("../config")
rename = require("gulp-rename")
module.exports = ->
  gulp.task "uglify_vendor", ["concat_vendor"], ->
    gulp.src("public/js/vendor.js").pipe(uglify()).pipe(rename("vendor.min.js")).pipe gulp.dest("public/js")
    return

