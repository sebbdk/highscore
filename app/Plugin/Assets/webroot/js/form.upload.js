/* 
* @Author: sebb
* @Date:   2014-06-14 00:18:08
* @Last Modified by:   sebb
* @Last Modified time: 2014-06-14 02:46:17
*/

(function($) {

	$(document).ready(function() {

	});

	$(document).on('change', 'input[type=file]', previewImage);

	function previewImage() {
		var self = this;

		var oFReader = new FileReader();
		oFReader.readAsDataURL($(self)[0].files[0]);

		oFReader.onload = function (oFREvent) {
			$(self).parent().find('input[type=hidden]').val(oFREvent.target.result);
			$(self).parent().find('.preview').css('background-image', 'url('+oFREvent.target.result+')');
			$(self).addClass('selected');
		};
	};
})(jQuery);