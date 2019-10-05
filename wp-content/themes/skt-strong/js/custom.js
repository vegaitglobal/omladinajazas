jQuery(window).load(function() {
		if(jQuery('#slider') > 0) {
        jQuery('.nivoSlider').nivoSlider({
        	effect:'fade',
    });
		} else {
			jQuery('#slider').nivoSlider({
        	effect:'fade',
    });
		}
});
	

// NAVIGATION CALLBACK
var skt_strong_ww = jQuery(window).width();
jQuery(document).ready(function() { 
	jQuery(".sitenav li a").each(function() {
		if (jQuery(this).next().length > 0) {
			jQuery(this).addClass("parent");
		};
	})
	jQuery(".toggleMenu").click(function(e) { 
		e.preventDefault();
		jQuery(this).toggleClass("active");
		jQuery(".sitenav").slideToggle('fast');
	});
	skt_strong_adjustMenu();
})

// navigation orientation resize callbak
jQuery(window).bind('resize orientationchange', function() {
	skt_strong_ww = jQuery(window).width();
	skt_strong_adjustMenu();
});

var skt_strong_adjustMenu = function() {
	if (skt_strong_ww < 981) {
		jQuery(".toggleMenu").css("display", "block");
		if (!jQuery(".toggleMenu").hasClass("active")) {
			jQuery(".sitenav").hide();
		} else {
			jQuery(".sitenav").show();
		}
		jQuery(".sitenav li").unbind('mouseenter mouseleave');
	} else {
		jQuery(".toggleMenu").css("display", "none");
		jQuery(".sitenav").show();
		jQuery(".sitenav li").removeClass("hover");
		jQuery(".sitenav li a").unbind('click');
		jQuery(".sitenav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
			jQuery(this).toggleClass('hover');
		});
	}
}


jQuery(document).ready(function() {
  	jQuery('.srchicon').click(function() {
			jQuery('.searchtop').toggle();
			jQuery('.topsocial').toggle();
		});	
});

jQuery(document).ready(function() {
        jQuery('h2.section-title, .logo h1, .slide_info h2, .cols-3 h5').each(function(index, element) {
            var heading = jQuery(element);
            var word_array, last_word, first_part;
            word_array = heading.html().split(/\s+/); // split on spaces
            last_word = word_array.pop();             // pop the last word
            first_part = word_array.join(' ');        // rejoin the first words together
            heading.html([first_part, ' <span>', last_word, '</span>'].join(''));
        });
});

// HANDLE WATU QUIZ RESULTS
jQuery(document).ajaxComplete(function () {
    if (jQuery('#watu-achieved-points').get(0)) {
        const percentage = getResultPercentage();
        const bar = jQuery('.bar');
        bar.css('width', `${percentage}%`);
        if (percentage > 67) {
            bar.parent('div:first').addClass('danger');
        } else if (percentage > 33 && percentage < 67) {
            bar.parent('div:first').addClass('warning');
        }
    }
});

const getResultPercentage = function () {
    const achieved = jQuery('#watu-achieved-points').get(0).innerText;
    const maximum = jQuery('#watu-max-points').get(0).innerText;
    const precentage = achieved / maximum * 100;
    return precentage.toFixed(0);
}
