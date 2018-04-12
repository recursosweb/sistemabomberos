/*
Scripts initialization
*/

(function($) {
	"use strict";
	
	/*START PRELOADER JS*/
	$(window).load(function() { 
		$('#status').fadeOut();
		$('#preloader').delay(350).fadeOut('slow'); 
	}); 
	/*END PRELOADER JS*/


	/* COUNTDOWN JS */
	$('#counter_item').bind('inview', function(event, visible, visiblePartX, visiblePartY) {
			if (visible) {
				$(this).find('.time_counter').each(function () {
					var $this = $(this);
					$({ Counter: 0 }).animate({ Counter: $this.text() }, {
						duration: 2000,
						easing: 'swing',
						step: function () {
							$this.text(Math.ceil(this.Counter));
						}
					});
				});
				$(this).unbind('inview');
			}
		});
	/* END COUNTDOWN JS */
	
	
	/*START PROGRESS BAR JS*/
	$('.progress-bar > span').each(function(){
		var $this = $(this);
		var width = $(this).data('percent');
		$this.css({
			'transition' : 'width 2s'
		});
		
		setTimeout(function() {
			$this.appear(function() {
					$this.css('width', width + '%');
			});
		}, 500);
	});
	/*END PROGRESS BAR JS*/
	

	/*START WOW ANIMATION*/
		new WOW().init();	
	/*END WOW ANIMATION*/
	

	/*START TOOLTIP*/
	$('[data-toggle="tooltip"]').tooltip()
	/*END TOOLTIP*/	
	
	
	/* START CAROUSEL*/
	$(document).ready(function() {	
	$('.carousel').carousel({
		interval:5000,
		pause:"false",
	});
	});
	/*END CAROUSEL*/
	

})(jQuery);


