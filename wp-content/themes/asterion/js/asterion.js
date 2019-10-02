
jQuery(function($) {  

	// hide #back-top first
	$("#back-top").hide();

	// scroll body to 0px on click
	$('#back-top a').on("click", function(){
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});

	// fade in #back-top
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('#back-top').fadeIn();
		} else {
			$('#back-top').fadeOut();
		}
	});

	// Sticky header menu
	function sticky_header() {
		var heightWpadminbar = $("#wpadminbar").height();

		if ($(this).scrollTop() > heightWpadminbar){
			$(".navbar").addClass("navbar-shrink");
		} else {
			$(".navbar").removeClass("navbar-shrink");
		}

	}
 	
	$(window).scroll(function() {
		sticky_header();
	});

	sticky_header();




    // Clone elements to offcanvas
    jQuery(".asterion-primary-nav nav").clone().appendTo(".asterion-offcanvas-nav");

    // Toggle mobile nav
    jQuery(".site-navigation-toggle, .asterion-offcanvas-wrap .close").on("click", function () {
        jQuery(".asterion-offcanvas-wrap").toggleClass("active");
   });

    // Off-canvas menu sub-menus
    jQuery(".asterion-offcanvas-nav .menu-item-has-children a").on("click", function () {
        event.stopPropagation();
        location.href = this.href;
    });
    jQuery(".asterion-offcanvas-nav .menu-item-has-children").on("click", function () {
        jQuery(this).children("ul").toggle();
        jQuery(".asterion-offcanvas-nav nav").resize();
        jQuery(this).toggleClass("show-sub-menu");
        return false;
    }); 
});