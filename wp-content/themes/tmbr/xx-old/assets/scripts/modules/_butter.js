var Butter = (function($) {

	'use strict';

	var ShowApp = {

		// Initialization the functions
		init: function() {

			ShowApp.Preloader();
			ShowApp.Slideheight()
			ShowApp.AffixMenu();
			ShowApp.SmoothScroll();
			ShowApp.Carousel();
			//ShowApp.Lightbox();

			// Call this to show all animited items
			// ShowApp.ShowAnimated();
		},



		// Page loading process
		Preloader: function() {
			$(window).load(function() {
				$('#preloader .spinner').delay(100).fadeOut(300, function() {
					$('.body').animate({
						opacity: 1
					}, 300);
					$(this).parent().delay(300).fadeOut(500, function() {
						ShowApp.Animated();
					});
				});
			});
		},

		// set homepage slider height
		Slideheight: function() {

			var lg_heroHeight = (($(window).height())-130);
			var heroHeight = (($(window).height())-171);

			//Height of hero = window height - height of nav (115px))
			if($(window).width() > 768){

				if($(window).height() > 700){
					$('#s1').css({'height': lg_heroHeight + 'px' });
				} else {
					$('#s1').addClass('shorty');
				}

			}
			else {

				if($(window).height() > 700){
					$('#s1').css({'height': heroHeight + 'px' });
				} else {
					$('#s1').addClass('shorty');
				}
			}
		},

		// Navigation menu affix
		AffixMenu: function() {
			var navMenu	= '<nav id="navigation_affix">';
			navMenu		+= $('#navigation').html();
			navMenu		+= '</nav>';

			$('#header').before(navMenu);

			$('#navigation').waypoint(function() {
				$('#navigation_affix').removeClass('show');
			}, {
				offset: -89
			});

			$('#navigation').waypoint(function() {
				$('#navigation_affix').addClass('show');
			}, {
				offset: -90
			});
		},

		// Smooth scrolling to anchor section
		SmoothScroll: function() {
			$('a.smooth-scroll').on('click','', function( e ){
			      e.preventDefault();
			    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
			        || location.hostname == this.hostname) {
			        var target = $(this.hash);
			        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			           if (target.length) {
			             $('html,body').animate(
			                {scrollTop: target.offset().top},
			                {duration: 600});
			            return false;
			        }
			    }
			});
		},

		// Slider with Slick carousel
		Carousel: function() {
			// Gallery slider
			$('.carousel-slider.gallery-slider').each(function() {
				$(this).slick({
					dots: true,
					slidesToShow: 4,
					slidesToScroll: 1,
					draggable: false,
					responsive: [
						{
							breakpoint: 768,
							settings: {
								slidesToShow: 2,
								draggable: true
							}
						},
						{
							breakpoint: 480,
							settings: {
								slidesToShow: 1,
								draggable: true
							}
						}
					]
				});
			});
		},

		// Preview images popup gallery with Fancybox
		// Lightbox: function() {
		// 	$('.imagepop').magnificPopup({type:'image'});
		// },

		// Embed animation effects to HTML elements with CSS3
		Animated: function() {
			$('.animation, .animation-visible').each(function() {
				var $element = $(this);
				$element.waypoint(function() {
					var delay = 0;
					if ($element.attr('data-delay')) delay = parseInt($element.attr('data-delay'), 0);
					if (!$element.hasClass('animated')) {
						setTimeout(function() {
							$element.addClass('animated ' + $element.attr('data-animation'));
						}, delay);
					}
					delay = 0;
				}, {
					offset: '70%'
				});
			});
		},

		// Show All Animated Items
		ShowAnimated: function() {
			$('.animation, .animation-visible').each(function() {
				$(this).addClass('animated');
			});
		}

	};

	// Run the main function
	//$(function() {
		return ShowApp;
	//});

})(window.jQuery);