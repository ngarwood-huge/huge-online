/* Functions */

	// Assigns button classes to selected elements
	function assign_class(array, classes, inner_selector){
		for (var i = 0; i <= array.length - 1; i++) {
			if (inner_selector != null) {
				jQuery(array[i]).find(inner_selector).addClass(classes);
			} else {
				jQuery(array[i]).addClass(classes);
			}
		}
	}

	function assign_class_parent(array, classes, inner_selector){
		for (var i = 0; i <= array.length - 1; i++) {
			jQuery(array[i]).find(inner_selector).parent().addClass(classes);
		}
	}

	function equalheight(container){
		var currentTallest = 0,
		    currentRowStart = 0,
		    rowDivs = new Array(),
		    el,
		    topPosition = 0;

		jQuery(container).each(function() {
			el = jQuery(this);
			jQuery(el).height('auto')
			topPostion = el.position().top;

			if (currentRowStart != topPostion) {
				for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
				rowDivs[currentDiv].height(currentTallest);
				}
				rowDivs.length = 0; // empty the array
				currentRowStart = topPostion;
				currentTallest = el.height();
				rowDivs.push(el);
			} else {
				rowDivs.push(el);
				currentTallest = (currentTallest < el.height()) ? (el.height()) : (currentTallest);
			}
			for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
				rowDivs[currentDiv].height(currentTallest);
			}
		});
	}



jQuery(document).ready(function() {
		jQuery('.btn-click').toggle(function() {
		 	 jQuery('.map-home .mod_tm_ajax_contact_form').animate({bottom:'-1520px'});
		 	 jQuery('.map-home .btn-click').addClass('bot');
			 jQuery('.map-home .btn-click').removeClass('top');
		 	 jQuery('.map-home .btn-click i').removeClass('fa-angle-double-down');
		  	 jQuery('.map-home .btn-click i').addClass('fa-angle-double-up');
			}, function() {
			 jQuery('.map-home .mod_tm_ajax_contact_form').animate({bottom:'0px'});
			 jQuery('.map-home .btn-click').addClass('top');
			 jQuery('.map-home .btn-click').removeClass('bot');
			 jQuery('.map-home .btn-click i').addClass('fa-angle-double-down');
		  	 jQuery('.map-home .btn-click i').removeClass('fa-angle-double-up');
		});
		 jQuery("#video-top-un .txt3").click(function(){
			//alert('dsfdfs');
			var height=jQuery("#video-top-un").height();
			//alert(height);
			 jQuery("body,html").animate({"scrollTop":height+100},"slow");
		});
		

	//StickUp menu
	var stickUp_selector = '.navigation';
	var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent);
	if(!isMobile) {
		jQuery(stickUp_selector).tmStickUp();
	}


	// Navigation
	jQuery('.sf-menuW > li.parent > a').append('<i class="fa fa-angle-down"></i>');
	jQuery('.sf-menuW li li.parent.drop-submenu > a').append('<i class="fa fa-angle-right"></i>');
	jQuery('.sf-menuW > li:first-child').addClass('first-child');
	jQuery('.sf-menuW > li:last-child').addClass('last-child');
	//Pagination
	assign_class(paginations, 'pagination');
	assign_class_parent(paginations, 'active', 'li:not([class^="pagination-"]) span.pagenav');
	assign_class_parent(paginations, 'disabled', 'li[class^="pagination-"] span.pagenav');


	

	// Tabs
	jQuery('.nav-tabs li').on('shown.bs.tab', function (e) {
		jQuery(this).addClass('active');
		equalheight('.listing__grid .item');
	});
	
	//Scroll to top
	jQuery.scrollUp();

	
});
jQuery(window).load(function() {
 // equalheight('.listing__grid .item');	
 // equalheight('.listing__carousel .item');	
});
jQuery(document).ready(function(){
	jQuery('.module_title').wrapInner('<span>');
	jQuery('#comments-form-send a, .socialsharing_product a , button.button , .newsflash .readmore , .vm-button-correct').wrapInner('<span><span>');
	jQuery('.cart_buttons .continue_link').wrapInner('<span><span>');
	jQuery('#helpsite-refresh span').wrapInner('<span>');
	jQuery('#helpsite-refresh').addClass('button btn-primary');
	jQuery('#checkoutFormSubmit span span span').unwrap('<span>');
	//jQuery('.sf-menuW > li > a, .sf-menuW > li > span').wrapInner('<em>');

jQuery.noConflict();

// init controller
if(animate =='1') {

	jQuery('.mod_bannersblock li:odd').addClass('wow fadeInLeft');
	jQuery('.mod_bannersblock li:even').addClass('wow fadeInRight');
	
	jQuery('.mod_custom .line1').addClass('wow fadeInLeft');
	jQuery('.mod_custom .line2').addClass('wow fadeInRight');
	
	
	jQuery('.mod_custom .txt1').addClass('wow fadeInLeft');
	jQuery('.mod_custom .txt2').addClass('wow fadeInRight');
	jQuery('.mod_custom .txt3').addClass('wow fadeInLeft');

	 
	jQuery('.newsflash .wrap-column:odd').addClass('wow fadeInLeft');
	jQuery('.newsflash .wrap-column:even').addClass('wow fadeInUp');
	
	jQuery('.footer-row .row >div:odd').addClass('wow fadeInLeft');
	jQuery('.footer-row .row >div:even').addClass('wow fadeInRight');

	
	jQuery('.moduletable__home.mod_virtuemart_manufacturer .item:odd').addClass('wow fadeInLeft');
	jQuery('.moduletable__home.mod_virtuemart_manufacturer .item:even').addClass('wow fadeInRight');
	
	jQuery('.home .mod_virtuemart_product .item:odd').addClass('wow fadeInLeft');
	jQuery('.home .mod_virtuemart_product .item:even').addClass('wow fadeInRight');



	
  if (jQuery('html').hasClass('desktop')) {
		var wow = new WOW(
		  {
			boxClass:     'wow',      // animated element css class (default is wow)
			animateClass: 'animated', // animation css class (default is animated)
			offset:       0,          // distance to the element when triggering the animation (default is 0)
			mobile:       true,       // trigger animations on mobile devices (default is true)
			live:         true        // act on asynchronously loaded content (default is true)
		  }
		);
		wow.init();
	}   
}	
});

