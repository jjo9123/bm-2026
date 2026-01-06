/*
 * b4st JS
 */

(function ($) {

	'use strict';


	$(window).load(function() {

		$('.home-slider').slick({
			arrows: true,
    	dots: true,
			infinite: true,
			autoplay: true,
			autoplaySpeed: 4000
  	});

		$('.quotes-slider').slick({
			arrows: true,
    	dots: false,
			infinite: true
  	});

		$('.highlights-slider').slick({
			arrows: true,
    	dots: true,
			infinite: true
  	});
	});

	$(document).ready(function() {

		// Comments
		$('.commentlist li').addClass('card mb-3');
		$('.comment-reply-link').addClass('btn btn-secondary');


		// Forms
		$('select, input[type=text], input[type=email], input[type=password], textarea').addClass('form-control');
		$('input[type=submit]').addClass('btn btn-primary');


		// Pagination fix for ellipsis
		$('.pagination .dots').addClass('page-link').parent().addClass('disabled');


		// You can put your own code in here
    // video pop-up
    var $videoSrc;
    $('.btn-herovid').click(function() {
        $videoSrc = $(this).data( "src" );
    });

    $('#myModalvideo').on('shown.bs.modal', function (e) {
        $(".vimeo").attr('src',$videoSrc + "?rel=0&amp;showinfo=0&amp;modestbranding=1&amp;autoplay=1" );
    });

    $('#myModalvideo').on('hidden.bs.modal', function () {
        var url = $('.vimeo').attr('src');
        $('.vimeo').attr('src', '');
        $('#video').attr('src', $videoSrc );
    });

	});

}(jQuery));
