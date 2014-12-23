(function() {
  var gulp, rev;

  gulp = require('gulp');

  rev = require('gulp-rev');

  module.exports = function() {
    return gulp.task('rev', function() {
      return gulp.src(
        ['public/css/application.css', 'public/js/application.js', 'public/js/vendor.js', 'public/css/application.min.css', 'public/js/application.min.js', 'public/js/vendor.min.js'],
        {
          base: 'public'
        })
        .pipe(gulp.dest('public'))
        .pipe(rev())
        .pipe(gulp.dest('public'))
        .pipe(rev.manifest())
        .pipe(gulp.dest('public'));
    });
  };

}).call(this);
