jQuery(function($) {
	"use strict";


  	// tab switcher
	jQuery( ".ot-control-panel" ).tabs();

	/* check if there are recomended actions */
    var recomended_actions = asterion.action_count;

    if ( (typeof recomended_actions !== 'undefined') && (recomended_actions != '0') ) {
        jQuery('li.ot-actions a').append('<span class="ot-actions-count">' + recomended_actions + '</span>');
    }

    //importing front page
    jQuery(".ot-import-front-page").not('.ot-disabled').on('click', function() {
        var clicked_button = jQuery(this);

        clicked_button.addClass('ot-disabled');
        clicked_button.html(clicked_button.data('importing'));

        jQuery.ajax({
            url: asterion.admin_url,
            type: 'POST',
            data: {
                'action':'asterion_import_front_page',
                'nonce' : asterion.security,
            },
            success:function(results) { 

                if( results == 'ok' ) {
                    jQuery('.ot-import-font-page').hide();
                    jQuery('.ot-imported-font-page').show();
                    clicked_button.html(clicked_button.data('imported'));
                } else {
                    jQuery('.ot-error p').html( results );
                    jQuery('.ot-error').show();
                }

            }
        });
        
        return false;
    });


    //resteing settings
    jQuery(".ot-setting-reset").not('.ot-disabled').on('click', function() {
        var clicked_button = jQuery(this);
        clicked_button.html(clicked_button.data('reseting'));
        clicked_button.addClass('ot-disabled');
        jQuery.ajax({
            url: asterion.admin_url,
            type: 'POST',
            data: {
                'action':'asterion_reset_settings',
                'nonce' : asterion.security,
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
        jQuery.ajax({
            url: asterion.admin_url,
            type: 'POST',
            data: {
                'action':'asterion_import_widgets',
                'nonce' : asterion.security,
            },
            success:function(results) { 
           		clicked_button.html(clicked_button.data('imported'));
            }
        });
		
		return false;
	});
});
