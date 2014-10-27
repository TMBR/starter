gulp = require('gulp')
spritesmith = require('gulp.spritesmith')
es = require('event-stream')
module.exports = ->

    # REGULAR IMAGES
    spriteData = gulp.src([
      'assets/images/sprite/*.png'
      'assets/images/sprite/**/*.png'
    ])
    .pipe(spritesmith(
      imgName: '../images/sprite.png'
      cssName: '_sprite.scss'
    ))
    spriteData.img.pipe(
      gulp.dest('public/images/')
    )
    spriteData.css.pipe(
      gulp.dest('assets/stylesheets/')
    )

    # 2X IMAGES
    spriteData2x = gulp.src([
      'assets/images/sprite/2x/*.png'
      'assets/images/sprite/2x/**/*.png'
    ])
    .pipe(spritesmith(
      imgName: '../images/sprite2x.png'
      cssName: '_sprite2x.scss'
    ))
    spriteData2x.img.pipe(
      gulp.dest('public/images/')
    )
    spriteData2x.css.pipe(
      gulp.dest('assets/stylesheets/')
    )


    # SVG
    spriteDataSVG = gulp.src([
      'assets/images/sprite/svg/*.svg'
    ])
    .pipe(spritesmith(
      imgName: '../images/spritesvg.png'
      cssName: '_spritesvg.scss'
    ))
    spriteDataSVG.img.pipe(
      gulp.dest('public/images/')
    )
    spriteDataSVG.css.pipe(
      gulp.dest('assets/stylesheets/')
    )

  gulp.task 'sprite', ->
    es.merge(spriteData, spriteData2x, spriteDataSVG)


