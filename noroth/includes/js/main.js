//Begin Google Analytics Code
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-36411793-1']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
function recordOutboundLink(link, category, action) {
 try {
 var myTracker=_gat._getTrackerByName();
 _gaq.push(['myTracker._trackEvent', category , action ]);
 setTimeout('document.location = "' + link.href + '"', 100)
 }catch(err){}
}
//End Google Analytics Code

$(document).ready(function() {
	var speed = 4800;
	var run = setInterval('rotate()', speed);	
	var item_width = $('#slides li').outerWidth(); 
	var left_value = 10; 
	$('#slides li:first').before($('#slides li:last'));
	$('#slides ul').css({'left' : left_value});
	$('#prev').click(function() {
		var left_indent = parseInt($('#slides ul').css('left')) + item_width;
		$('#slides ul:not(:animated)').animate({'left' : left_indent}, 200,function(){    
			$('#slides li:first').before($('#slides li:last'));           
			$('#slides ul').css({'left' : left_value});
		});
		return false;
	});
	$('#next').click(function() {
		var left_indent = parseInt($('#slides ul').css('left')) - item_width;
		$('#slides ul:not(:animated)').animate({'left' : left_indent}, 200, function () {
			$('#slides li:last').after($('#slides li:first'));                 	
			$('#slides ul').css({'left' : left_value});
		});
		return false;
	});        
	$('#carousel').hover(
		function() {
			clearInterval(run);
		}, 
		function() {
			run = setInterval('rotate()', speed);	
		}
	); 
});

function rotate() {
	$('#next').click();
}

var currentFeaturedProduct = 1;
$(document).ready(function() {
	var speed = 3000;
	var run = setInterval('rotateFeaturedProducts()', speed);
	$('#featuredProducts #selector1 a').css('color','#fb9d2f');
	$('#selector1').hover(
		function() {
			currentFeaturedProduct = 1;
			$('#featuredProducts #selector1 a').css('color','#fb9d2f');
			$('#featuredProducts #selector2 a').css('color','#242424');
			$('#featuredProducts #selector3 a').css('color','#242424');
			$('#featuredProducts #selector4 a').css('color','#242424');
			$('#featuredProducts #selector5 a').css('color','#242424');
			$('#featuredProducts #selector6 a').css('color','#242424');
			$('#featuredProducts #selector7 a').css('color','#242424');
			$('#featuredProducts #selector8 a').css('color','#242424');
			$('#featuredProducts #selector9 a').css('color','#242424');
			$('#featuredProducts #selector10 a').css('color','#242424');
			$('#featuredProducts #product_slide_wrapper').stop(true, true);
			$('#featuredProducts #product_slide_wrapper').animate({'margin-top' : '0px'}, 200);
			$('#featuredProducts #product_selector_background').stop(true, true);
			$('#featuredProducts #product_selector_background').animate({'top' : '0px'}, 200);
		}, 
		function() {
		}
	); 
	$('#selector2').hover(
		function() {
			currentFeaturedProduct = 2;
			$('#featuredProducts #selector1 a').css('color','#242424');
			$('#featuredProducts #selector2 a').css('color','#fb9d2f');
			$('#featuredProducts #selector3 a').css('color','#242424');
			$('#featuredProducts #selector4 a').css('color','#242424');
			$('#featuredProducts #selector5 a').css('color','#242424');
			$('#featuredProducts #selector6 a').css('color','#242424');
			$('#featuredProducts #selector7 a').css('color','#242424');
			$('#featuredProducts #selector8 a').css('color','#242424');
			$('#featuredProducts #selector9 a').css('color','#242424');
			$('#featuredProducts #selector10 a').css('color','#242424');
			$('#featuredProducts #product_slide_wrapper').stop(true, true);
			$('#featuredProducts #product_slide_wrapper').animate({'margin-top' : '-300px'}, 200);
			$('#featuredProducts #product_selector_background').stop(true, true);
			$('#featuredProducts #product_selector_background').animate({'top' : '30px'}, 200);
		}, 
		function() {
		}
	); 
	$('#selector3').hover(
		function() {
			currentFeaturedProduct = 3;
			$('#featuredProducts #selector1 a').css('color','#242424');
			$('#featuredProducts #selector2 a').css('color','#242424');
			$('#featuredProducts #selector3 a').css('color','#fb9d2f');
			$('#featuredProducts #selector4 a').css('color','#242424');
			$('#featuredProducts #selector5 a').css('color','#242424');
			$('#featuredProducts #selector6 a').css('color','#242424');
			$('#featuredProducts #selector7 a').css('color','#242424');
			$('#featuredProducts #selector8 a').css('color','#242424');
			$('#featuredProducts #selector9 a').css('color','#242424');
			$('#featuredProducts #selector10 a').css('color','#242424');
			$('#featuredProducts #product_slide_wrapper').stop(true, true);
			$('#featuredProducts #product_slide_wrapper').animate({'margin-top' : '-600px'}, 200);
			$('#featuredProducts #product_selector_background').stop(true, true);
			$('#featuredProducts #product_selector_background').animate({'top' : '60px'}, 200);
		}, 
		function() {
		}
	); 
	$('#selector4').hover(
		function() {
			currentFeaturedProduct = 4;
			$('#featuredProducts #selector1 a').css('color','#242424');
			$('#featuredProducts #selector2 a').css('color','#242424');
			$('#featuredProducts #selector3 a').css('color','#242424');
			$('#featuredProducts #selector4 a').css('color','#fb9d2f');
			$('#featuredProducts #selector5 a').css('color','#242424');
			$('#featuredProducts #selector6 a').css('color','#242424');
			$('#featuredProducts #selector7 a').css('color','#242424');
			$('#featuredProducts #selector8 a').css('color','#242424');
			$('#featuredProducts #selector9 a').css('color','#242424');
			$('#featuredProducts #selector10 a').css('color','#242424');
			$('#featuredProducts #product_slide_wrapper').stop(true, true);
			$('#featuredProducts #product_slide_wrapper').animate({'margin-top' : '-900px'}, 200);
			$('#featuredProducts #product_selector_background').stop(true, true);
			$('#featuredProducts #product_selector_background').animate({'top' : '90px'}, 200);
		}, 
		function() {
		}
	); 
	$('#selector5').hover(
		function() {
			currentFeaturedProduct = 5;
			$('#featuredProducts #selector1 a').css('color','#242424');
			$('#featuredProducts #selector2 a').css('color','#242424');
			$('#featuredProducts #selector3 a').css('color','#242424');
			$('#featuredProducts #selector4 a').css('color','#242424');
			$('#featuredProducts #selector5 a').css('color','#fb9d2f');
			$('#featuredProducts #selector6 a').css('color','#242424');
			$('#featuredProducts #selector7 a').css('color','#242424');
			$('#featuredProducts #selector8 a').css('color','#242424');
			$('#featuredProducts #selector9 a').css('color','#242424');
			$('#featuredProducts #selector10 a').css('color','#242424');
			$('#featuredProducts #product_slide_wrapper').stop(true, true);
			$('#featuredProducts #product_slide_wrapper').animate({'margin-top' : '-1200px'}, 200);
			$('#featuredProducts #product_selector_background').stop(true, true);
			$('#featuredProducts #product_selector_background').animate({'top' : '120px'}, 200);
		}, 
		function() {
		}
	); 
	$('#selector6').hover(
		function() {
			currentFeaturedProduct = 6;
			$('#featuredProducts #selector1 a').css('color','#242424');
			$('#featuredProducts #selector2 a').css('color','#242424');
			$('#featuredProducts #selector3 a').css('color','#242424');
			$('#featuredProducts #selector4 a').css('color','#242424');
			$('#featuredProducts #selector5 a').css('color','#242424');
			$('#featuredProducts #selector6 a').css('color','#fb9d2f');
			$('#featuredProducts #selector7 a').css('color','#242424');
			$('#featuredProducts #selector8 a').css('color','#242424');
			$('#featuredProducts #selector9 a').css('color','#242424');
			$('#featuredProducts #selector10 a').css('color','#242424');
			$('#featuredProducts #product_slide_wrapper').stop(true, true);
			$('#featuredProducts #product_slide_wrapper').animate({'margin-top' : '-1500px'}, 200);
			$('#featuredProducts #product_selector_background').stop(true, true);
			$('#featuredProducts #product_selector_background').animate({'top' : '150px'}, 200);
		}, 
		function() {
		}
	); 
	$('#selector7').hover(
		function() {
			currentFeaturedProduct = 7;
			$('#featuredProducts #selector1 a').css('color','#242424');
			$('#featuredProducts #selector2 a').css('color','#242424');
			$('#featuredProducts #selector3 a').css('color','#242424');
			$('#featuredProducts #selector4 a').css('color','#242424');
			$('#featuredProducts #selector5 a').css('color','#242424');
			$('#featuredProducts #selector6 a').css('color','#242424');
			$('#featuredProducts #selector7 a').css('color','#fb9d2f');
			$('#featuredProducts #selector8 a').css('color','#242424');
			$('#featuredProducts #selector9 a').css('color','#242424');
			$('#featuredProducts #selector10 a').css('color','#242424');
			$('#featuredProducts #product_slide_wrapper').stop(true, true);
			$('#featuredProducts #product_slide_wrapper').animate({'margin-top' : '-1800px'}, 200);
			$('#featuredProducts #product_selector_background').stop(true, true);
			$('#featuredProducts #product_selector_background').animate({'top' : '180px'}, 200);
		}, 
		function() {
		}
	); 
	$('#selector8').hover(
		function() {
			currentFeaturedProduct = 8;
			$('#featuredProducts #selector1 a').css('color','#242424');
			$('#featuredProducts #selector2 a').css('color','#242424');
			$('#featuredProducts #selector3 a').css('color','#242424');
			$('#featuredProducts #selector4 a').css('color','#242424');
			$('#featuredProducts #selector5 a').css('color','#242424');
			$('#featuredProducts #selector6 a').css('color','#242424');
			$('#featuredProducts #selector7 a').css('color','#242424');
			$('#featuredProducts #selector8 a').css('color','#fb9d2f');
			$('#featuredProducts #selector9 a').css('color','#242424');
			$('#featuredProducts #selector10 a').css('color','#242424');
			$('#featuredProducts #product_slide_wrapper').stop(true, true);
			$('#featuredProducts #product_slide_wrapper').animate({'margin-top' : '-2100px'}, 200);
			$('#featuredProducts #product_selector_background').stop(true, true);
			$('#featuredProducts #product_selector_background').animate({'top' : '210px'}, 200);
		}, 
		function() {
		}
	); 
	$('#selector9').hover(
		function() {
			currentFeaturedProduct = 9;
			$('#featuredProducts #selector1 a').css('color','#242424');
			$('#featuredProducts #selector2 a').css('color','#242424');
			$('#featuredProducts #selector3 a').css('color','#242424');
			$('#featuredProducts #selector4 a').css('color','#242424');
			$('#featuredProducts #selector5 a').css('color','#242424');
			$('#featuredProducts #selector6 a').css('color','#242424');
			$('#featuredProducts #selector7 a').css('color','#242424');
			$('#featuredProducts #selector8 a').css('color','#242424');
			$('#featuredProducts #selector9 a').css('color','#fb9d2f');
			$('#featuredProducts #selector10 a').css('color','#242424');
			$('#featuredProducts #product_slide_wrapper').stop(true, true);
			$('#featuredProducts #product_slide_wrapper').animate({'margin-top' : '-2400px'}, 200);
			$('#featuredProducts #product_selector_background').stop(true, true);
			$('#featuredProducts #product_selector_background').animate({'top' : '240px'}, 200);
		}, 
		function() {
		}
	); 
	$('#selector10').hover(
		function() {
			currentFeaturedProduct = 10;
			$('#featuredProducts #selector1 a').css('color','#242424');
			$('#featuredProducts #selector2 a').css('color','#242424');
			$('#featuredProducts #selector3 a').css('color','#242424');
			$('#featuredProducts #selector4 a').css('color','#242424');
			$('#featuredProducts #selector5 a').css('color','#242424');
			$('#featuredProducts #selector6 a').css('color','#242424');
			$('#featuredProducts #selector7 a').css('color','#242424');
			$('#featuredProducts #selector8 a').css('color','#242424');
			$('#featuredProducts #selector9 a').css('color','#242424');
			$('#featuredProducts #selector10 a').css('color','#fb9d2f');
			$('#featuredProducts #product_slide_wrapper').stop(true, true);
			$('#featuredProducts #product_slide_wrapper').animate({'margin-top' : '-2700px'}, 200);
			$('#featuredProducts #product_selector_background').stop(true, true);
			$('#featuredProducts #product_selector_background').animate({'top' : '270px'}, 200);
		}, 
		function() {
		}
	);
	
	$('#featuredProductsWrapper').hover(
		function() {
			clearInterval(run);
		}, 
		function() {
			run = setInterval('rotateFeaturedProducts()', speed);	
		}
	); 
});

function rotateFeaturedProducts() {
	if (currentFeaturedProduct == 1) {
		$('#selector2').mouseenter().mouseleave();
	}
	else if (currentFeaturedProduct == 2) {
		$('#selector3').mouseenter().mouseleave();
	}
	else if (currentFeaturedProduct == 3) {
		$('#selector4').mouseenter().mouseleave();
	}
	else if (currentFeaturedProduct == 4) {
		$('#selector5').mouseenter().mouseleave();
	}
	else if (currentFeaturedProduct == 5) {
		$('#selector6').mouseenter().mouseleave();
	}
	else if (currentFeaturedProduct == 6) {
		$('#selector7').mouseenter().mouseleave();
	}
	else if (currentFeaturedProduct == 7) {
		$('#selector8').mouseenter().mouseleave();
	}
	else if (currentFeaturedProduct == 8) {
		$('#selector9').mouseenter().mouseleave();
	}
	else if (currentFeaturedProduct == 9) {
		$('#selector10').mouseenter().mouseleave();
	}
	else if (currentFeaturedProduct == 10) {
		$('#selector1').mouseenter().mouseleave();
	}
}

function changeSwatchImage(liObject) {
	var numberOfImages = document.getElementById('swatch_images_frame').getElementsByTagName('li').length;
	for (var i=0;i<numberOfImages;i++) {
		document.getElementById('swatch_images_frame').getElementsByTagName('li').item(i).className = '';
	}
	liObject.className = 'active';
	document.getElementById('main_picture').innerHTML = liObject.innerHTML;
}

function removeCartItem(cartItemNumber) {
	document.getElementById('cart_quantity'+cartItemNumber).value = 0;
	document.getElementById('shopping_cart_display').submit();
}

$(document).ready(function() {
	$("#updateCartMessageFrame").delay(2000).fadeOut(2000);
	});


function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		document.getElementById(limitCount).innerHTML =  limitField.value.length;
	}
}