jQuery(document).ready( function(){
    // Uploading files

    var wcp_image_widget;
     
    jQuery('.upload_image_button').live('click', function( event ){
     
        event.preventDefault();

        var this_widget = '#' + jQuery(this).closest('.widget').attr('id');
     
     
        // Create the media frame.
        wcp_image_widget = wp.media.frames.wcp_image_widget = wp.media({
          title: jQuery( this ).data( 'title' ),
          button: {
            text: jQuery( this ).data( 'btntext' ),
          },
          multiple: false  // Set to true to allow multiple files to be selected
        });
     
        // When an image is selected, run a callback.
        wcp_image_widget.on( 'select', function() {
          // We set multiple to false so only get one image from the uploader
          attachment = wcp_image_widget.state().get('selection').first().toJSON();
          	
          	
             jQuery(this_widget).find('.image-url').val(attachment.url);
             jQuery(this_widget).find('.image-title').val(attachment.title);
             jQuery(this_widget).find('.alttext').val(attachment.alt);
             jQuery(this_widget).find('.img-prev').html('<img src="'+attachment.url+'" width="100%">')
        });
     
        // Finally, open the modal
        wcp_image_widget.open();
    });
});