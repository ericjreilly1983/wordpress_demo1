jQuery( document ).ready(function($) {

	
	jQuery(document).on("click", "#customize-control-fl_left_icon .fl_bg_holder", function($) {
		jQuery('#customize-control-fl_left_icon .fl_bg_holder').removeClass('floating_icon_slected');
		jQuery(this).addClass('floating_icon_slected');
		
 });
	jQuery(document).on("click", "#customize-control-fl_right_icon .fl_bg_holder", function($) {
		jQuery('#customize-control-fl_right_icon .fl_bg_holder').removeClass('floating_icon_slected');
		jQuery(this).addClass('floating_icon_slected');
		
 });
	jQuery(document).on("click", "#customize-control-fl_random_icon .fl_bg_holder", function($) {
		jQuery('#customize-control-fl_random_icon .fl_bg_holder').removeClass('floating_icon_slected');
		jQuery(this).addClass('floating_icon_slected');
		
 });
	jQuery(document).on("click", "#customize-control-fl_up_icon .fl_bg_holder", function($) {
		jQuery('#customize-control-fl_up_icon .fl_bg_holder').removeClass('floating_icon_slected');
		jQuery(this).addClass('floating_icon_slected');
		
 });
	jQuery(document).on("click", "#customize-control-fl_down_icon .fl_bg_holder", function($) {
		jQuery('#customize-control-fl_down_icon .fl_bg_holder').removeClass('floating_icon_slected');
		jQuery(this).addClass('floating_icon_slected');
		
 });
 });	