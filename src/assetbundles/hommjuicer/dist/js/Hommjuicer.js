/**
 * hommjuicer plugin for Craft CMS
 *
 * hommjuicer JS
 *
 * @author    Domenik Hofer
 * @copyright Copyright (c) 2018 Domenik Hofer
 * @link      homm.ch
 * @package   Hommjuicer
 * @since     0.0.1
 */

$(document).ready(function(){	
grid();
$('div.bg').lazyload({
	threshold:150,
	effect:'fadeIn'
});

AOS.init();
});
$(window).resize(function(){
grid();
});
function grid(){
	if($('.grid').length > 0){
		var $grid = $('.grid').isotope({
			itemSelector: '.grid-item',
			percentPosition: true,
			masonry: {
				columnWidth: '.grid-sizer',
				gutter: '.gutter-sizer'
			}
		});
	}
}

