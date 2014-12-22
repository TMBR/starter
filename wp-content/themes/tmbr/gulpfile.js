(function() {

  var gulp = require('gulp');
  var concat = require('gulp-concat');
  var uglify = require('gulp-uglify');
  var uglifycss = require('gulp-uglifycss');
  var imagemin = require('gulp-imagemin');
  var sourcemaps = require('gulp-sourcemaps');
  var del = require('del');
  var sass = require("gulp-sass");
  var runSequence = require('run-sequence');


  var paths = {
    scripts: [ // specify your scripts in dependency order
      'assets/scripts/index.js',
      'assets/scripts/_frontpage.js',
      'assets/scripts/_slider.js'
    ],
    styles: ['assets/stylesheets/application.scss'],
    images: ['assets/images/**'],
    fonts: ['assets/fonts/**']
  };

  gulp.task('clean', function(cb) {
    // You can use multiple globbing patterns as you would with `gulp.src`
    del(['public'], cb);
  });


  gulp.task('scripts', function(){
    // Minify and copy all JavaScript (except vendor scripts)
    // with sourcemaps all the way down
    return gulp.src(paths.scripts)
      .pipe(sourcemaps.init())
        .pipe(uglify())
        .pipe(concat('application.min.js'))
      .pipe(sourcemaps.write())
      .pipe(gulp.dest('public/js'));
  });

  gulp.task('styles', function(){
    return gulp.src(paths.styles)
      .pipe(sourcemaps.init())
        .pipe(sass({
          sourceComments: "map",
          errLogToConsole: true,
          sourceMap: "sass"
        }))
      .pipe(sourcemaps.write())
      .pipe(uglifycss({
        // max-line-len: 80
      }))
      .pipe(gulp.dest('public/css'));
  });

  gulp.task('images', function(){
    return gulp.src(paths.images)
      .pipe(gulp.dest('public/images'));
  });

  gulp.task('fonts', function(){
    return gulp.src(paths.fonts)
      .pipe(gulp.dest('public/fonts'));
  });

  gulp.task('startwatch', function(){
    watchers = [
      gulp.watch(paths.scripts, ['scripts']),
      gulp.watch(paths.styles, ['styles']),
      gulp.watch(paths.images, ['images']),
      gulp.watch(paths.fonts, ['fonts'])
    ];

    watchers.forEach(function(watcher, index){
      watcher.on('change', function(event){
        console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
      });
    });
  });

  gulp.task('default', function(){
    runSequence(
      'clean',
      ['scripts', 'styles', 'images', 'fonts'],
      'startwatch'
    );
  })



















  // var CONF, browserSync, del, es, gulp, runSequence, watch, _;

  // CONF = require('./gulp/config');
  // watch = require('gulp-watch');
  // del = require('del');
  // runSequence = require('run-sequence');
  // gulp = require('./gulp')(CONF.tasks);
  // es = require('event-stream');

  // // browserSync = require('browser-sync');
  // // gulp.task('browser-sync', function() {
  // //   return browserSync({
  // //     server: {
  // //       baseDir: './'
  // //     }
  // //   });
  // // });

  // gulp.task('watch', function() {
  //   gulp.watch(['assets/stylesheets/**/*.scss'], ['sass']);
  //   gulp.watch(['assets/scripts/**/*.js'], ['concat_app']);
  //   return gulp.watch(['assets/images/**/*', '!assets/images/sprite/**/*'], ['copy']);
  // });

  // gulp.task('copy', function() {
  //   var x = gulp.src(['assets/images/**/*']).pipe(gulp.dest('public/images'));
  //   var y = gulp.src(['assets/fonts/**']).pipe(gulp.dest('public/fonts'));
  //   return y;
  // });

  // gulp.task('clean', function(cb) {
  //   return del(['public/**'], cb);
  // });



  // gulp.task('compile', function(){
  //   return runSequence( 'sass', 'concat_app', 'concat_vendor' );
  // });

  // gulp.task('compress', function(){
  //   return runSequence( 'uglify_app', 'uglify_vendor', 'cssmin' );
  // });

  // gulp.task('build', function(cb) {
  //   return runSequence(
  //     'clean',
  //     'copy',
  //     'compile',
  //     'compress',
  //     'rev'
  //   );
  // });

  // gulp.task('default', function(){
  //   return runSequence('build', 'watch');
  // });

}).call(this);
