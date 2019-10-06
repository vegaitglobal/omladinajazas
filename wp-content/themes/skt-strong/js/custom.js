jQuery(window).load(function () {
    if (jQuery('#slider') > 0) {
        jQuery('.nivoSlider').nivoSlider({
            effect: 'fade',
        });
    } else {
        jQuery('#slider').nivoSlider({
            effect: 'fade',
        });
    }
});


// NAVIGATION CALLBACK
var skt_strong_ww = jQuery(window).width();
jQuery(document).ready(function () {
    jQuery(".sitenav li a").each(function () {
        if (jQuery(this).next().length > 0) {
            jQuery(this).addClass("parent");
        }
        ;
    })
    jQuery(".toggleMenu").click(function (e) {
        e.preventDefault();
        jQuery(this).toggleClass("active");
        jQuery(".sitenav").slideToggle('fast');
    });
    skt_strong_adjustMenu();
})

// navigation orientation resize callbak
jQuery(window).bind('resize orientationchange', function () {
    skt_strong_ww = jQuery(window).width();
    skt_strong_adjustMenu();
});

var skt_strong_adjustMenu = function () {
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
        jQuery(".sitenav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function () {
            jQuery(this).toggleClass('hover');
        });
    }
}


jQuery(document).ready(function () {
    jQuery('.srchicon').click(function () {
        jQuery('.searchtop').toggle();
        jQuery('.topsocial').toggle();
    });
});

jQuery(document).ready(function () {
    jQuery('h2.section-title, .logo h1, .slide_info h2, .cols-3 h5').each(function (index, element) {
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

        const hivRiscPercentage = getResultPercentage();
        const hivBar = jQuery('.bar.hiv');
        hivBar.css('width', `${hivRiscPercentage}%`);
        if (hivRiscPercentage > 67) {
            hivBar.parent('div:first').addClass('danger');
        } else if (hivRiscPercentage > 33 && hivRiscPercentage < 67) {
            hivBar.parent('div:first').addClass('warning');
        }

        const stdRiscPercentage = getStdRisckPercentage();
        const stdBar = jQuery('.bar.std');
        stdBar.css('width', `${stdRiscPercentage}%`);
        if (stdRiscPercentage > 67) {
            stdBar.parent('div:first').addClass('danger');
        } else if (stdRiscPercentage > 33 && stdRiscPercentage < 67) {
            stdBar.parent('div:first').addClass('warning');
        }
    }
});

const getResultPercentage = function () {
    const achieved = jQuery('#watu-achieved-points').get(0).innerText;
    const maximum = jQuery('#watu-max-points').get(0).innerText;
    const percentage = achieved / maximum * 100;
    return percentage.toFixed(0);
}

const getStdRisckPercentage = function () {
    const riscPercentage = getResultPercentage();
    const stdRiscPercentage = riscPercentage / 40 * 100;
    return stdRiscPercentage.toFixed(0);
}

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

