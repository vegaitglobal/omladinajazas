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

// 'Test Znanja'

jQuery(document).ready(function() {
	setTimeout(function(){
		const watu = window.Watu;
		//Todo: Hide 'introText' on second step!
		const introText = jQuery('.quiz-area').addClass('introText');

		const questionElements = jQuery('.watu-question');
		questionElements.hide();
		const questions = jQuery('.question-content');
		var otherQuestions = [];
		jQuery.each(questionElements, function (index, value) {
			if (value.innerText.indexOf('*') >= 0) {
				value.classList.add("firstStep");
				// console.log(value)
				jQuery(value).show();
			} else {
				otherQuestions.push(jQuery(value));
			}
		});
		// Question randomizer
		const parent = questionElements.parent();
		var result = [];
		const count = otherQuestions.length;
		for (var i = 0; i < 10; i++) {
			var randomNo = Math.floor((Math.random() * count) + 1);
			while (true) {
				if (jQuery.inArray(randomNo, result) != -1) {
					randomNo = Math.floor((Math.random() * count) + 1);
					console.log('test')
				} else {
					result.push(randomNo);
					break;
				}
			}
		}
		var randomQuestions = [];
		jQuery.each(result, function(key, value) {
			randomQuestions.push(otherQuestions[value]);
		});
		console.log(randomQuestions);
		// randomQuestions[0].show();
	}, 100);
});
