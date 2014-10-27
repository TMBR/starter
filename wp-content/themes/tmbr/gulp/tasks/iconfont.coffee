gulp = require('gulp')
iconfont = require("gulp-iconfont")
module.exports = ->
  gulp.task "iconfont", ->
    gulp.src(["assets/components/entypo/font/*.svg"]).pipe(iconfont(
      fontName: "entypo"
      appendCodepoints: true
    )).on("codepoints", (codepoints, options) ->
      console.log codepoints, options
    ).pipe gulp.dest("public/fonts/")

