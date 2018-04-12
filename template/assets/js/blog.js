/*
Scripts initialization
*/

(function($) {
	"use strict";

	/*START HOMW BLOG CAROUSEL*/
	$(document).ready(function() {
		  var owl = $("#blog-carousel");
		  owl.owlCarousel({
		 
			  pagination: false,
			  items : 2, //10 items above 1000px browser width
			  itemsDesktop : [1000,2], //5 items between 1000px and 901px
			  itemsDesktopSmall : [900,2], // betweem 900px and 601px
			  itemsTablet: [600,1], //2 items between 600 and 0
			  itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
			  addClassActive : true,
			
		  });
		 
		  // Custom Navigation Events
		  $(".read_next_story").click(function(){
			owl.trigger('owl.next');
			return false;
		  })
		  $(".read_prev_story").click(function(){
			owl.trigger('owl.prev');
			return false;
		  })

		});
	/*END HOMW BLOG CAROUSEL*/

})(jQuery);


