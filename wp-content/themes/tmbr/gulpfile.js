(function() {
  try {
    var beep = require('beepbeep');
    var gulp = require('gulp');
    var gutil = require('gulp-util');
    var concat = require('gulp-concat');
    var uglify = require('gulp-uglify');
    var uglifycss = require('gulp-uglifycss');
    var imagemin = require('gulp-imagemin');
    var plumber = require('gulp-plumber');
    var sourcemaps = require('gulp-sourcemaps');
    var del = require('del');
    var expect = require('gulp-expect-file');
    var sass = require("gulp-sass");
    var runSequence = require('run-sequence');
    var rev = require('gulp-rev');
    var rename = require('gulp-rename');
    var livereload = require('gulp-livereload');
    var iconfont = require('gulp-iconfont');
    var runTimestamp = Math.round(Date.now()/1000);
    var consolidate = require('gulp-consolidate');
    var autoprefixer = require('gulp-autoprefixer');
  } catch( e ) {
    console.log('Could not find one of the packages gulp needs to run.  Please run `npm install` to see if that resolves the issue.  The error is below:');
    console.log(e);
    return false;
  }

  var paths = {
    vendorScripts: [

      // Specify your vendor scripts in dependency order
      'assets/vendor/modernizr/modernizr.js',
      'assets/vendor/jquery/dist/jquery.js',

      // Bootstrap JS files
      // 'assets/vendor/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/affix.js',
      // 'assets/vendor/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/alert.js',
      // 'assets/vendor/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/button.js',
      // 'assets/vendor/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/carousel.js',
      // 'assets/vendor/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/collapse.js',
      // 'assets/vendor/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/dropdown.js',
      // 'assets/vendor/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/tab.js',
      // 'assets/vendor/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/transition.js',
      // 'assets/vendor/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/scrollspy.js',
      // 'assets/vendor/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/modal.js',
      // 'assets/vendor/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/tooltip.js',
      // 'assets/vendor/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/popover.js',


      'assets/vendor/flexslider/jquery.flexslider.js',                  //  Flexslider (slideshow) - http://www.woothemes.com/flexslider/
      // 'assets/vendor/isotope/jquery.isotope.js',                         Isotope (filter & sort layouts) - http://isotope.metafizzy.co/
      'assets/vendor/waypoints/lib/jquery.waypoints.js',                //  Waypoints (trigger function on scroll) - http://imakewebthings.com/waypoints/

      'assets/vendor/jquery-unveil/jquery.unveil.js',                   //  jQuery Unveil (lazy load assets) - http://luis-almeida.github.io/unveil/
      'assets/vendor/jquery.easing/js/jquery.easing.js',                //  jQuery Easing (advanced easing options) - http://gsgd.co.uk/sandbox/jquery/easing/
      // 'assets/vendor/jquery.stellar/jquery.stellar.js',                  Stellar.js (parallax helper) - http://markdalgleish.com/projects/stellar.js/
      // 'assets/vendor/magnific-popup/dist/jquery.magnific-popup.js',      Magnific Popup (responsive lightbox) - http://dimsemenov.com/plugins/magnific-popup/
      // 'assets/vendor/pace/pace.js',                                      PACE (page load progress bar) - http://github.hubspot.com/pace/docs/welcome/
      // 'assets/vendor/videojs/dist/video-js/video.js',                    Video.js (work with HTML5 video) - http://videojs.com/
      'assets/vendor/respond/src/respond.js',                           //  Respond.js (media query helper for IE) - https://github.com/scottjehl/Respond
      'assets/vendor/responsejs/response.js'                            //  Response.js (serve responsive content via HTML5) - http://responsejs.com/


    ],
    appScripts: [
      // You can keep your JS tidy in its own file for a specific feature.
      // Nothing's important about the naming scheme, just as long as the file
      // is included in this array, it'll come together.
        'assets/scripts/modules/*.js',
        'assets/scripts/main.js'
    ],
    styles: [
      // do your @imports from this file, not the gulpfile
      'assets/stylesheets/application.scss'
    ],
    stylesWatchDir: 'assets/stylesheets/**/*.scss',
    images: ['assets/images/**'],
    fonts: ['assets/fonts/**'],
    icons: ['assets/icons/**/*.svg']
  };




  gulp.task('clean', function(cb) {
    // You can use multiple globbing patterns as you would with `gulp.src`
    del(['public'], cb);
  });

  /* This group of tasks deal with deleting specific groups of items from the
   * public folder.  This is used presently for when the "watch" task notices a
   * change in a certain set of files, it removes the original set, so that
   * we're not building up giant lists of unused files as we make changes to
   * the JS or SASS components. */
  gulp.task('clean:vendorScripts', function(cb) {
    del(['public/js/vendor*'], cb);
  });
  gulp.task('clean:appScripts', function(cb) {
    del(['public/js/application*'], cb);
  });
  gulp.task('clean:styles', function(cb) {
    del(['public/css/'], cb);
  });
  gulp.task('clean:images', function(cb) {
    del(['public/images/'], cb);
  });
  gulp.task('clean:fonts', function(cb) {
    del(['public/fonts/'], cb);
  });

  var errorHandler = function(msg, error) {
    var chalk = gutil.colors
    gutil.log(chalk.bgRed('There was an issue', chalk.bold(msg)))
    beep()
    error.emit('end')
  }

  gulp.task('scripts:vendor', function(){
    return gulp.src(paths.vendorScripts)
      .pipe(plumber(function () {
          errorHandler(
            'building the Vendor Scripts',
            this
          )
      }))
      .pipe(expect(paths.vendorScripts))
      .pipe(concat('vendor.js'))
      .pipe(gulp.dest('public/js'))
      .pipe(uglify())
      .pipe(rename('vendor.min.js'))
      .pipe(gulp.dest('public/js'))
  });

  gulp.task('scripts:app', function(){
    return gulp.src(paths.appScripts)
      .pipe(plumber(function () {
          errorHandler(
            'building the App Scripts',
            this
          )
      }))
      .pipe(expect(paths.appScripts))
      .pipe(concat('application.js'))
      .pipe(gulp.dest('public/js'))
      .pipe(uglify())
      .pipe(rename('application.min.js'))
      .pipe(gulp.dest('public/js'))
  });
  gulp.task('styles', function(){
    return gulp.src(paths.styles)
      .pipe(plumber(function () {
          errorHandler(
            'building the styles',
            this
          )
      }))
      .pipe(sass({
        precision: 10
      }))
      .pipe(autoprefixer({
          browsers: ['last 2 versions'],
          cascade: false
      }))
      .pipe(gulp.dest('public/css'))
      .pipe(rename('application.min.css'))
      .pipe(uglifycss())
      .pipe(gulp.dest('public/css'))
      .pipe(livereload())
  });

  gulp.task('images', function(){
    return gulp.src(paths.images)
      .pipe(plumber(function () {
          errorHandler(
            'optimizing the images',
            this
          )
      }))
      .pipe(imagemin())
      .pipe(gulp.dest('public/images'))
  });

  gulp.task('fonts', function(){
    return gulp.src(paths.fonts)
      .pipe(plumber(function () {
          errorHandler(
            'moving the fonts',
            this
          )
      }))
      .pipe(gulp.dest('public/fonts'))
  });

  gulp.task('startwatch', function(){
    watchers = [
      gulp.watch(paths.vendorScripts, function(event){
        runSequence('clean:vendorScripts', 'scripts:vendor', 'version');
      }),
      gulp.watch(paths.appScripts, function(event){
        runSequence('clean:appScripts', 'scripts:app', 'version');
      }),
      gulp.watch(paths.stylesWatchDir, function(event){
        runSequence('clean:styles', 'styles', 'version');
      }),
      gulp.watch(paths.images, function(event){
        runSequence('clean:images', 'images', 'version');
      }),
      gulp.watch(paths.fonts, function(event){
        runSequence('clean:fonts', 'fonts', 'version');
      })
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
      .pipe(plumber(function () {
          errorHandler(
            'versioning assets',
            this
          )
      }))
      .pipe(gulp.dest('public'))
      .pipe(rev())
      .pipe(gulp.dest('public'))
      .pipe(rev.manifest())
      .pipe(gulp.dest('public'))
      .on('error', gutil.log);
  });

  gulp.task('refresh', function() {
    livereload.listen();
  });

  gulp.task('default', function(){
    runSequence(
      ['clean'],
      ['iconfont'],
      ['scripts:vendor', 'scripts:app', 'styles', 'images', 'fonts'],
      ['version', 'startwatch'],
      'refresh'
    );
  });

  gulp.task('build', function(){
    runSequence(
      'clean',
      'iconfont',
      ['scripts:vendor', 'scripts:app', 'styles', 'images', 'fonts'],
      'version'
    );
  });


  /****************** ICON FONT SECTION *********************/

  /**
   * Takes SVG files in the assets/icons directory and builds a font from them.
   * The font gets placed in the assets/fonts directory, which will then be
   * copied into the public/fonts dir during build time.
   *
   * An SCSS file is generated called tmbricons.scss.  This file needs to be
   * added to the application.scss file for the font to be utilized in the
   * concatenated assets.
   *
   * An template exists from which the tmbricons.scss file is generated. That
   * file is `assets/stylesheets/template_tmbricons.tmpl`.  The syntax is
   * fairly self-documenting and shouldn't need to be changed often at all -
   * likely not even per project.
   */
  gulp.task('iconfont', function(){
    return gulp.src(paths.icons)
      .pipe(iconfont({
        fontName: 'tmbricons', // required
        appendUnicode: true, // recommended option
        formats: ['ttf', 'eot', 'woff', 'woff2', 'svg'], // default, 'woff2' and 'svg' are available
        timestamp: runTimestamp, // recommended to get consistent builds when watching files
      }))
      .on('glyphs', buildFontCss)
      .pipe(gulp.dest('assets/fonts/'));
  });


  /**
   * Function that Builds the SCSS file based on the icons processed by iconfont task.
   *
   * @param glyphs Collection of fonts that were processed
   * @param options = options passed into the iconfont() method in the iconfont task
   */
  var buildFontCss = function(glyphs, options) {
    var options = {
      glyphs: glyphs.map(function(glyph) {
        // this line is needed because gulp-iconfont has changed the api from 2.0
        return { name: glyph.name, codepoint: glyph.unicode[0].charCodeAt(0) }
      }),
      fontName: options.fontName,
      fontPath: '../fonts/', // set path to font (from your CSS file if relative)
      className: options.fontName // set class name in your CSS
    };
    gulp.src('assets/stylesheets/template_' + options.fontName + '.tmpl')
      .pipe(consolidate('lodash', options)) // compile the template
      .pipe(rename(options.fontName + '.scss'))
      .pipe(gulp.dest('assets/stylesheets/')); // set path to export your CSS
  }

})();
