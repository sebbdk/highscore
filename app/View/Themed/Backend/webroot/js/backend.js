(function() {

	$(window).on('beforeunload', function() {
 		$('.container').removeClass('load');
 		$('.container').addClass('unload');
	});

})();