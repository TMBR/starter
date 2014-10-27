gulp = require("gulp")
coffee = require("gulp-coffee")
notify = require("gulp-notify")
gutil = require('gulp-util');
browserify = require('gulp-browserify')
rename = require('gulp-rename')

module.exports = ->
  gulp.task 'coffee', ->

    gulp.src('assets/scripts/index.coffee', { read: false })
    .pipe browserify
      transform: ['coffeeify']
      extensions: ['.coffee']
      debug: !gulp.env.production
    .pipe rename('application.js')
    .pipe gulp.dest('./public/js')


    # c = coffee(
    #   bare: false
    #   sourceMap: true
    # )
    # c.on 'error', (e) ->
    #   gutil.log(e)
    #   c.end()
    # gulp.src("assets/scripts/**/*.coffee").pipe(c)
    # .pipe gulp.dest("assets/scripts")
