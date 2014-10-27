gulp = require('gulp')
shell = require('gulp-shell')

module.exports = ->
  gulp.task 'deploy', shell.task [
    'sh ../../../deploy.sh'
  ]