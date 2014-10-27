# this is an array used to set configs dynamically from one place.
module.exports =

  # all of the tasks we want to load.
  # these must be individual files in the tasks/ dir.
  tasks: [
    'sass'
    'cssmin'
    'coffee'
    'uglify_app'
    'concat_vendor'
    'uglify_app'
    'uglify_vendor'
    'sprite'
    'browser_sync'
    'rev'
    'deploy'
  ]

  # you can inject these file arrays as needed into the various gulp tasks.
  files:

    # watch tasks
    watch:
      concat: []
      style: []


    # concat vendor scripts tasks
    concat_vendor: [
      'assets/components/modernizr/modernizr.js'
      'assets/components/underscore/underscore.js'
      'assets/components/jquery/dist/jquery.js'
      'assets/components/fancybox/source/jquery.fancybox.js'
      'assets/components/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js'
      'assets/components/imagesloaded/imagesloaded.pkgd.js'
      'assets/components/Velocity.js/jquery.velocity.js'
      'assets/components/dropkick/jquery.dropkick.js'
      'assets/components/mousetrap/mousetrap.js'
      'assets/components/jquery-hoverIntent/jquery.hoverIntent.js'
      'assets/components/jquery-dotimeout/jquery.ba-dotimeout.js'
      'assets/components/jquery.equalheights/jquery.equalheights.js'
      'assets/components/jquery-cycle2/build/jquery.cycle2.js'
      'assets/components/jquery.cookie/jquery.cookie.js'
      # 'assets/components/skrollr-stylesheets/src/skrollr.stylesheets.js'
      # 'assets/components/skrollr/src/skrollr.js'
      'assets/components/jquery-infinite-scroll/jquery.infinitescroll.js'
      'assets/components/fitvids/jquery.fitvids.js'
      'assets/components/jquery-form/jquery.form.js'
      # leaving bootstrap in case we end up adding later
      # 'assets/components/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/affix.js'
      # 'assets/components/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/alert.js'
      # 'assets/components/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/button.js'
      # 'assets/components/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/carousel.js'
      'assets/components/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/collapse.js'
      # 'assets/components/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/dropdown.js'
      # 'assets/components/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/modal.js'
      # 'assets/components/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/tooltip.js'
      # 'assets/components/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/popover.js'
      # 'assets/components/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/scrollspy.js'
      # 'assets/components/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/tab.js'
      'assets/components/twbs-bootstrap-sass/vendor/assets/javascripts/bootstrap/transition.js'
      # vendor
      # 'assets/scripts/vendor/mailchimp_embed.js'
    ]

    # main concat files
    concat_app: ['assets/scripts/**/*.js']
