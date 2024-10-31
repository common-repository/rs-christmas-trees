(function( $ ) {
	'use strict';
 
	jQuery(document).ready(function() {
 
        // Initial check: if any radio button is checked on page load, add the highlight class to its parent
        jQuery('#rs_christmas_trees_display_set_top .rs_christmas_trees_label_value label input[type=radio]').each(function() { 
            if (jQuery(this).is(':checked')) { 
                jQuery(this).parent().addClass('highlight');
            }
        });

        // Event listener for change
        jQuery('#rs_christmas_trees_display_set_top .rs_christmas_trees_label_value label input[type=radio]').change(function() { 

            // Remove the highlight class from all parent label elements
            jQuery('#rs_christmas_trees_display_set_top .rs_christmas_trees_label_value label').removeClass('highlight');

            // If this radio button is checked, add the highlight class to its parent label
            if (jQuery(this).is(':checked')) {
                jQuery(this).parent().addClass('highlight');
            }
        });
        // footer trees
         // Initial check: if any radio button is checked on page load, add the highlight class to its parent
        jQuery('#rs_christmas_trees_display_set_bottom .rs_christmas_trees_label_value label input[type=radio]').each(function() {
            if (jQuery(this).is(':checked')) { 
                jQuery(this).parent().addClass('highlight');
            }
        });

        // Event listener for change
        jQuery('#rs_christmas_trees_display_set_bottom .rs_christmas_trees_label_value label input[type=radio]').change(function() {
            // Remove the highlight class from all parent label elements
            jQuery('#rs_christmas_trees_display_set_bottom .rs_christmas_trees_label_value label').removeClass('highlight');

            // If this radio button is checked, add the highlight class to its parent label
            if (jQuery(this).is(':checked')) {
                jQuery(this).parent().addClass('highlight');
            }
        }); 

 

	 jQuery('#rs_display_snow').on('click',function () {
	 	if(jQuery(this).prop("checked") == true)
	 	{

	 		var speed = jQuery('input[name=rs_maximum_fall_speed]').val();
	 		var min_size = jQuery('input[name=rs_flake_minimum_size]').val();
	 		var max_size = jQuery('input[name=rs_flake_maximum_size]').val();
	 		if (speed == '')
	 		{
	 			jQuery('input[name=rs_maximum_fall_speed]').val(4000);
	 		}
	 		if (min_size == '')
	 		{
	 			jQuery('input[name=rs_flake_minimum_size]').val(8);
	 		}
	 		if (max_size == '')
	 		{
	 			jQuery('input[name=rs_flake_maximum_size]').val(100);
	 		}
	 	}
	 });
	 
	 
	
	 jQuery( "body" ).delegate( "#rs_christmas_trees_display_set_top_btn", "click", function() {
	 	 
	 	jQuery("#rs_christmas_trees_display_set_top").css('display','block');
	 	jQuery("#rs_christmas_trees_display_set_bottom").css('display','none');
	 	jQuery("#rs_christmas_trees_display_location").css('display','flex');
	 });	 
	 if (jQuery('#rs_christmas_trees_display_set_top_btn').prop('checked')) {
 
	 	jQuery("#rs_christmas_trees_display_set_top").css('display','block');
	 	jQuery("#rs_christmas_trees_display_set_bottom").css('display','none');
	 	jQuery("#rs_christmas_trees_display_location").css('display','flex');
	 };
 
	jQuery( "body" ).delegate( "#rs_christmas_trees_display_set_bottom_btn", "click", function() {
	 
	 	jQuery("#rs_christmas_trees_display_set_top").css('display','none');
	 	jQuery("#rs_christmas_trees_display_set_bottom").css('display','block');
	 	jQuery("#rs_christmas_trees_display_location").css('display','flex');
	});
	 if (jQuery('#rs_christmas_trees_display_set_bottom_btn').prop('checked')) {

	 	jQuery("#rs_christmas_trees_display_set_top").css('display','none');
	 	jQuery("#rs_christmas_trees_display_set_bottom").css('display','block');
	 	jQuery("#rs_christmas_trees_display_location").css('display','flex');
	 }; 
	 
	jQuery( "body" ).delegate( "#rs_christmas_trees_display_set_both_btn", "click", function() {
	 
	 	jQuery("#rs_christmas_trees_display_set_top").css('display','block');
	 	jQuery("#rs_christmas_trees_display_set_bottom").css('display','block');
	 	jQuery("#rs_christmas_trees_display_location").css('display','none');
	 });

	 if (jQuery('#rs_christmas_trees_display_set_both_btn').prop('checked')) {
	 	jQuery("#rs_christmas_trees_display_set_top").css('display','block');
	 	jQuery("#rs_christmas_trees_display_set_bottom").css('display','block');
	 	jQuery("#rs_christmas_trees_display_location").css('display','none');
	 }
    }); 
})( jQuery );
