(function() {

  var gulp = require('gulp');
  var gutil = require('gulp-util');
  var concat = require('gulp-concat');
  var uglify = require('gulp-uglify');
  var uglifycss = require('gulp-uglifycss');
  var imagemin = require('gulp-imagemin');
  var sourcemaps = require('gulp-sourcemaps');
  var del = require('del');
  var sass = require("gulp-sass");
  var runSequence = require('run-sequence');
  var rev = require('gulp-rev');
  var rename = require('gulp-rename');



  var paths = {
    vendorScripts: [
      // specify your vendor scripts in dependency order
      'assets/vendor/modernizr/modernizr.js',
      'assets/vendor/jquery/dist/jquery.js'
    ],
    appScripts: [
      // You can keep your JS tidy in its own file for a specific feature.
      // Nothing's important about the naming scheme, just as long as the file
      // is included in this array, it'll come together.
      'assets/scripts/index.js',
      'assets/scripts/_frontpage.js',
      'assets/scripts/_slider.js'
    ],
    styles: [
      // do your @imports from this file, not the gulpfile
      'assets/stylesheets/application.scss'
    ],
    stylesWatchDir: 'assets/stylesheets/**/*.scss',
    images: ['assets/images/**'],
    fonts: ['assets/fonts/**']
  };

  gulp.task('clean', function(cb) {
    // You can use multiple globbing patterns as you would with `gulp.src`
    del(['public'], cb);
  });


  gulp.task('scripts:vendor', function(){
    return gulp.src(paths.vendorScripts)
      .pipe(concat('vendor.js'))
      .pipe(gulp.dest('public/js'))
      .pipe(uglify())
      .pipe(rename('vendor.min.js'))
      .pipe(gulp.dest('public/js'))
      .on('error', gutil.log);
  });

  gulp.task('scripts:app', function(){
    return gulp.src(paths.appScripts)
      .pipe(concat('application.js'))
      .pipe(gulp.dest('public/js'))
      .pipe(uglify())
      .pipe(rename('application.min.js'))
      .pipe(gulp.dest('public/js'))
      .on('error', gutil.log);
  });
  gulp.task('styles', function(){
    return gulp.src(paths.styles)
      .pipe(sass({
        sourceComments: "map",
        errLogToConsole: true,
        sourceMap: "sass"
      }))
      .pipe(gulp.dest('public/css'))
      .pipe(rename('application.min.css'))
      .pipe(uglifycss())
      .pipe(gulp.dest('public/css'))
      .on('error', gutil.log);
  });

  gulp.task('images', function(){
    return gulp.src(paths.images)
      .pipe(imagemin())
      .pipe(gulp.dest('public/images'))
      .on('error', gutil.log);
  });

  gulp.task('fonts', function(){
    return gulp.src(paths.fonts)
      .pipe(gulp.dest('public/fonts'))
      .on('error', gutil.log);
  });

  gulp.task('startwatch', function(){
    watchers = [
      gulp.watch(paths.vendorScripts, ['scripts:vendor']),
      gulp.watch(paths.appScripts, ['scripts:app']),
      gulp.watch(paths.stylesWatchDir, ['styles']),
      gulp.watch(paths.images, ['images']),
      gulp.watch(paths.fonts, ['fonts'])
    ];

    watchers.forEach(function(watcher, index){
      watcher.on('change', function(event){
        var relPath = event.path.replace(__dirname + '/', '');
        gutil.log('File \'' + gutil.colors.cyan(relPath) + '\' was ' + gutil.colors.magenta(event.type) + '.  Running respective task...');
      });
    });
  });

  gulp.task('version', function(){
    return gulp.src(
      [
        'public/css/application.min.css',
        'public/js/application.min.js',
        'public/js/vendor.min.js'
      ],
      {
        base: 'public'
      })
      .pipe(gulp.dest('public'))
      .pipe(rev())
      .pipe(gulp.dest('public'))
      .pipe(rev.manifest())
      .pipe(gulp.dest('public'))
      .on('error', gutil.log);
  });

  gulp.task('default', function(){
    runSequence(
      'clean',
      ['scripts:vendor', 'scripts:app', 'styles', 'images', 'fonts'],
      ['version', 'startwatch']
    );
  });

  gulp.task('build', function(){
    runSequence(
      'clean',
      ['scripts:vendor', 'scripts:app', 'styles', 'images', 'fonts'],
      'version'
    );
  });

})();
