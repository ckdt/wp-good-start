$.noConflict();
jQuery(document).ready(function($) {
	
	$('.container').fitVids();

  	$('.video.full').find('.container').attr('class','container-fluid');
  	$('.video.full').find('.row').attr('class','row-fluid');

  	$('.gallery.full').find('.container').attr('class','container-fluid');
  	$('.gallery.full').find('.row').attr('class','row-fluid');

	$('.flexslider').flexslider({
    	animation: "slide"
  	});
});