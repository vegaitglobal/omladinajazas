jQuery(function($) {
	'use strict';

	var file_frame;
	var clicked;
	var attachment;


	jQuery(document).on("click", ".ot-upload-button", function( event ){
	    clicked = jQuery(this);
	    event.preventDefault();
	 
	    if ( file_frame ) {
	        file_frame.open();
	        return;
	    }
	 
	    file_frame = wp.media.frames.file_frame = wp.media({
	        title: jQuery( this ).data( "uploader_title" ),
	        button: {
	            text: jQuery( this ).data( "uploader_button_text" ),
	        },
	        multiple: false  
	    });
	 
	    file_frame.on( "select", function() {
	 
	        attachment = file_frame.state().get("selection").first().toJSON();

	        clicked.parent().find(".ot-upload-field").val(attachment.url);
	        clicked.parent().parent().find(".uploader-photo").addClass("active");
	        clicked.parent().parent().find(".uploader-photo img.preview").attr("src",attachment.url);
	    });
	 
	    file_frame.open();
	 
	});

    function initColorPicker( widget ) {
        widget.find( '.color-picker' ).wpColorPicker( {
            change: _.throttle( function() { // For Customizer
                $(this).trigger( 'change' );
            }, 3000 )
        });
    }

    function onFormUpdate( event, widget ) {
        initColorPicker( widget );
    }

    $( document ).on( 'widget-added widget-updated', onFormUpdate );

    $( document ).ready( function() {
        $( '#widgets-right .widget:has(.color-picker)' ).each( function () {
            initColorPicker( $( this ) );
        } );
    } );
          

});