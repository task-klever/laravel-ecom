(function ($) {

	"use strict";

	// Scroll-Top
	$(".scroll-top").hide();
	$(window).on("scroll", function () {
		if ($(this).scrollTop() > 300) {
			$(".scroll-top").fadeIn();
		} else {
			$(".scroll-top").fadeOut();
		}
	});
	$(".scroll-top").on("click", function () {
		$("html, body").animate({
			scrollTop: 0,
		}, 700)
	});


	$(document).ready(function() {

		$('.select2').select2({
			theme: "bootstrap"
		});
	    
	    $('#checkShipping').on('change',function() {
	        $('.shipping-form').toggle();
	    });

	    $('.paypal').hide();
	    $('.stripe').hide();
	    $('.bank').hide();
	    $('.cash-on-delivery').hide();

		$('#paymentMethodChange').on('change',function() {

		    if($('#paymentMethodChange').val() == 'PayPal')
		    {
		        $('.paypal').show();
		        $('.stripe').hide();
		        $('.bank').hide();
		        $('.cash-on-delivery').hide();
		    }
		    else if($('#paymentMethodChange').val() == 'Stripe')
		    {
		        $('.paypal').hide();
		        $('.stripe').show();
		        $('.bank').hide();
		        $('.cash-on-delivery').hide();
		    }
		    else if($('#paymentMethodChange').val() == 'Bank')
		    {
		    	$('.paypal').hide();
		        $('.stripe').hide();
		        $('.bank').show();
		        $('.cash-on-delivery').hide();
		    }
		    else if($('#paymentMethodChange').val() == 'Cash On Delivery')
		    {
		    	$('.paypal').hide();
		        $('.stripe').hide();
		        $('.bank').hide();
		        $('.cash-on-delivery').show();
		    }
		    else if($('#paymentMethodChange').val() == '')
		    {
		    	$('.paypal').hide();
		        $('.stripe').hide();
		        $('.bank').hide();
		        $('.cash-on-delivery').hide();
		    }

		});

		

	});

	// Slider Carousel
	$('.slide-carousel').owlCarousel({
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		margin: 0,
		dots: true,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1,
				nav: false
			},
			576: {
				items: 1
			},
			1000: {
				items: 1
			}
		}
	});

	$('.slide-carousel').on('translate.owl.carousel', function () {
		$('.text-animated h1').removeClass('fadeInDown animated').hide();
		$('.text-animated p').removeClass('fadeInUp animated').hide();
		$('.text-animated li').removeClass('fadeInUp animated').hide();
	});

	$('.slide-carousel').on('translated.owl.carousel', function () {
		$('.text-animated h1').addClass('fadeInDown animated').show();
		$('.text-animated p').addClass('fadeInUp animated').show();
		$('.text-animated li').addClass('fadeInUp animated').show();
	});


	// Service Carousel
	$('.service-carousel').owlCarousel({
	   	loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 700,
		margin: 30,
		nav: false,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			992: {
				items: 3
			}
		}
	});


	// Service Carousel
	$('.project-carousel').owlCarousel({
	   	loop: false,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 700,
		margin: 30,
		nav: false,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			992: {
				items: 3
			}
		}
	});


	// Testimonial Carousel
	$('.testimonial-carousel').owlCarousel({
	   	loop: false,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 700,
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		margin: 30,
		nav: false,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 1
			},
			992: {
				items: 1
			}
		}
	});

	// Team Carousel
	$('.team-carousel').owlCarousel({
		loop: false,
		autoplay: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 700,
		margin: 30,
		mouseDrag: false,
		nav: false,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			992: {
				items: 4
			}
		}
	});

	// Blog Carousel
	$('.blog-carousel').owlCarousel({
		loop: false,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 700,
		margin: 30,
		mouseDrag: false,
		nav: false,
		navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			992: {
				items: 3
			}
		}
	});

	// Partner Carousel
	$('.partner-carousel').owlCarousel({
    	loop: false,
	    autoplay: true,
	    margin: 30,
	    dots: false,
	    nav: false,
	    animateIn: true,
	    responsiveClass: true,
	    navText: [
	    '<i class="fa fa-angle-left"></i>',
	    '<i class="fa fa-angle-right"></i>'
	    ],
    	responsive: {
	        0: {
	            items: 1,
	            nav:false
	        },
	        600: {
	            items: 3,
	            nav:false
	        },
	        992: {
	            items: 5,
	            nav:false,
	            loop:true
	        }
	    }
  	});

  	// Project Photo Carousel
	$('.project-photo-carousel').owlCarousel({
		loop: false,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 700,
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		margin: 0,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 1
			},
			992: {
				items: 1
			}
		}
	});

	// Preloader
	$('#status').fadeOut(); // will first fade out the loading animation
		$('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
		$('body').delay(350).css({
		'overflow': 'visible'
	});

	// Wow Active
	new WOW().init();

	// Mean Menu
	jQuery('.mean-menu').meanmenu({
		meanScreenWidth: "991"
	});

	// Popup
	$('.video-button').magnificPopup({
	  	type: 'iframe'
	});

	$('.magnific').magnificPopup({
		gallery: {
			enabled: true
		},
	  	type: 'image'
	});


    $('#dataTable2').DataTable( {
        "scrollX": true,
        "order": [[ 1, "desc" ]]
    } );


    // Autocomplete Off Globally
    $( document ).on( 'focus', ':input', function(){
        $( this ).attr( 'autocomplete', 'off' );
    });


})(jQuery);