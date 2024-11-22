
jQuery(document).ready(function() {
	$('.product-box-inner,.bike-image').magnificPopup({
		delegate: '.product-img',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] 
		}
	});
});




var TopSlider = new Swiper(".home-slider .slider", {
   speed: 2000,
   loop: true,
   autoplay: {
      delay: 2000,
      waitForTransition: true,
      disableOnInteraction: false,
   },
   //   flipEffect: {
   //   rotate: 30,
   //   slideShadows: false,
   // },
   effect: 'fade',
   navigation: {
      nextEl: ".home-next",
      prevEl: ".home-prev",
   },
   pagination: {
      el: '.slider-fullscreen-home',
      clickable: true,
   },
   breakpoints: {
      0: {
         slidesPerView: 1,
         spaceBetween: 0,
         clickable: true,
      },
      575: {
         slidesPerView: 1,
         spaceBetween: 0,
      },
      768: {
         slidesPerView: 1,
         spaceBetween: 0,
      },
      1024: {
         slidesPerView: 1,
         spaceBetween: 0,
      },
      1200: {
         slidesPerView: 1,
         spaceBetween: 0,
      }
   }
});