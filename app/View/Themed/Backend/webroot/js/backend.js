(function() {

	$(document).on('click', '.ellipse', function() {
		$(this).toggleClass('active');
	});

	$(document).ready(function() {
		adjustToFit();
		prepareFancyBox();
	});

	$(window).on('beforeunload', function() {
 		$('.container').removeClass('load');
 		$('.container').addClass('unload');
	});

	function prepareFancyBox() {
		$('td a').fancybox();
	}

	function adjustToFit() {
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
			var ww = ( $(window).width() < window.screen.width ) ? $(window).width() : window.screen.width; //get proper width
			var mw = 320; // min width of site
			var ratio =  ww / mw; //calculate ratio
			if( ww < mw){ //smaller than minimum size
				$('#Viewport').attr('content', 'initial-scale=' + ratio + ', maximum-scale=' + ratio + ', minimum-scale=' + ratio + ', user-scalable=no, width=' + ww);
			}else{ //regular size
				$('#Viewport').attr('content', 'initial-scale=1.0, maximum-scale=2, minimum-scale=1.0, user-scalable=no, width=' + ww);
			}
		}
	}

})();