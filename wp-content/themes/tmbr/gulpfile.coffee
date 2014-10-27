watch = require('gulp-watch')
_ = require('./node_modules/underscore')
clean = require('gulp-clean')
CONF = require('./gulp/config')
gulp = require('./gulp')(CONF.tasks)
es = require('event-stream')
browserSync = require('browser-sync')

gulp.task 'browser-sync', ->
  browserSync
    # proxy: 'believeslate.dev'
    server:
      baseDir: './'


gulp.task 'watch', ->

  gulp.watch [
    'assets/stylesheets/**/*.scss'
  ], [
    'sass'
  ]

  gulp.watch [
    '**/*.coffee'
  ], [
    'coffee'
  ]

  gulp.watch [
    '!assets/images/sprite/**/*'
    'assets/images/**/*'
  ], ['copy']

gulp.task 'copy', ->
  es.merge(
    gulp.src([
      'assets/images/**/*'
    ])
    .pipe(gulp.dest('public/images'))
    gulp.src([
      "assets/fonts/**"
      ],
    )
    .pipe(gulp.dest('public/fonts'))
  )

gulp.task 'clean', ->
  gulp.src([
    'public/**/*'
    'assets/scripts/**/*.js'
  ],
    read: false
  ).pipe clean()

gulp.task 'compile', [
  'coffee'
  'sass'
  'concat_vendor'
]
gulp.task 'compress', [
  'uglify_app'
  'uglify_vendor'
  'cssmin'
]
gulp.task 'build', [
  'clean'
  'compile'
  'compress'
  'copy'
  'rev'
]
gulp.task 'default', [
  'build'
  'watch'
  # 'browser-sync'
]
