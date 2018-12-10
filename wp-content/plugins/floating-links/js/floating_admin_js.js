jQuery( document ).ready(function($) {
/*
* Saving options values by ajax.
*/
jQuery(document).on("click", ".fl_options", function($) {
	
	/*
	* Getting clicked option value.
	*/	
	var fl_option = jQuery(this).data('option');

	/*
	* Intializing value variable.
	*/	
	var fl_value = null;

	/*
	* Checking clicked option status.
	*/
	if(jQuery(this).is(":checked")) {

		/*
		* Value will be true if checked.
		*/	
	    fl_value = true;
   }
	else{

		/*
		* Value will be false if not checked.
		*/	
	   	fl_value = false;
   }
	
	/*
	* Collecting data for ajax call.
	*/
	var data = { action : 'fl_save_'+fl_option,
				fl_value : fl_value
	}	
	/*
	* Making ajax request to save values.
	*/	
	jQuery.ajax({
		url : fl.ajax_url,
		type : 'post',
		data : data,
		dataType: 'json',
		success : function( response ) {

			/*
			* Show the dialog.
			*/
			Materialize.toast(response.data, 3000, null);	
			
				if(response.success){
					
				}
				else{

					}
		}

		});/* Ajax func ends here. */

 });/* fl_options func ends here. */
 });