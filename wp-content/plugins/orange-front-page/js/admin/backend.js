jQuery(function($) {
	"use strict";


  	// tab switcher
	jQuery( ".ot-control-panel" ).tabs();

	/* check if there are recomended actions */
    var recomended_actions = orange_front_page.action_count;

    if ( (typeof recomended_actions !== 'undefined') && (recomended_actions != '0') ) {
        jQuery('li.ot-actions a').append('<span class="ot-actions-count">' + recomended_actions + '</span>');
    }

    //importing front page
	jQuery(".ot-import-front-page").not('.ot-disabled').on('click', function() {
        var clicked_button = jQuery(this);

        clicked_button.addClass('ot-disabled');
        clicked_button.html(clicked_button.data('importing'));

	});


    //export front page
    jQuery(".ot-export-front-page-file").not('.ot-disabled').on('click', function() {
        var clicked_button = jQuery(this);

        clicked_button.addClass('ot-disabled');
        clicked_button.html(clicked_button.data('exported'));

    });




    //resteing settings
    jQuery(".ot-setting-reset").not('.ot-disabled').on('click', function() {
        var clicked_button = jQuery(this);
        clicked_button.html(clicked_button.data('reseting'));
        clicked_button.addClass('ot-disabled');
        jQuery.ajax({
            url: orange_front_page.admin_url,
            type: 'POST',
            data: {
                'action':'orange_front_page_reset_settings',
                'nonce' : orange_front_page.security,
            },
            success:function(results) { 
                clicked_button.html(clicked_button.data('reseted'));
            }
        });
        
        return false;
    });

	//importing widgets
	jQuery(".ot-import-widgets").not('.ot-disabled').on('click', function() {
        var clicked_button = jQuery(this);
        clicked_button.html(clicked_button.data('importing'));
        clicked_button.addClass('ot-disabled');

	});
});


    function loadUploader(element, pathToPhp) {
        var button = element;
        new AjaxUpload(button, {
            action: pathToPhp,
            name: 'ot_import',
            onSubmit: function (file, ext) {

                button.html(button.data('importing'));;

            },
            onComplete: function (file, response) {

                button.html(button.data('imported'));;
                location.reload();
            }
        })
    }