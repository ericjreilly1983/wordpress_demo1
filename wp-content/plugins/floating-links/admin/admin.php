<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

								//======================================================================
													// Admin Class 
								//======================================================================

class Floating_Links_Admin {

		/*
		* __construct initialize all function of this class.
		* Returns nothing. 
		* Used action_hooks to get things sequentially.
		*/ 
		function __construct(){

		/*
		* admin_menu hooks fires on wp admin load.
		* Add the menu page in wp admin area.
		*/ 		
		add_action('admin_menu', array($this,'fl_menu'));

		/*
		* admin_enqueue_scripts hooks fires for enqueing custom script and styles.
		* Css file will be include in admin area.
		*/ 	
		add_action( 'admin_enqueue_scripts', array($this, 'fl_admin_style'));
		
		/*
		* admin_notices hooks fires for displaying admin notice.
		* xo_admin_notice method will be call.
		*/ 
		add_action( 'admin_notices', array ($this , 'fl_admin_notice' )); 	

		/*
		* wp_ajax_xo_supported hooks fires on Ajax call.
		* fl_supported_func method will be call on click of supported button in admin notice.
		*/ 	
		add_action( 'wp_ajax_fl_supported', array ($this , 'fl_supported_func' ));	

		/*
		* save_fl_next hooks fires on Ajax call.
		* save_fl_next method will save the next icon value.
		*/ 	 
		add_action( 'wp_ajax_fl_save_fl_next', array ($this , 'save_fl_next' ));

		/*
		* save_fl_prev hooks fires on Ajax call.
		* save_fl_prev method will save the previous icon value.
		*/ 	 
		add_action( 'wp_ajax_fl_save_fl_prev', array ($this , 'save_fl_prev' ));

		/*
		* save_fl_random hooks fires on Ajax call.
		* save_fl_random method will save the random icon value.
		*/ 	 
		add_action( 'wp_ajax_fl_save_fl_random', array ($this , 'save_fl_random' ));


		/*
		* fl_top_posts hooks fires on Ajax call.
		* fl_top_posts method will save the top icon posts value.
		*/ 	 
		add_action( 'wp_ajax_fl_save_fl_top_posts', array ($this , 'save_fl_top_posts' ));

		/*
		* fl_top_pages hooks fires on Ajax call.
		* fl_top_pages method will save the top icon pages value.
		*/ 	 
		add_action( 'wp_ajax_fl_save_fl_top_pages', array ($this , 'save_fl_top_pages' ));

		/*
		* fl_top_posts hooks fires on Ajax call.
		* fl_top_posts method will save the bottom icon posts value.
		*/ 	 
		add_action( 'wp_ajax_fl_save_fl_bottom_posts', array ($this , 'save_fl_bottom_posts' ));

		/*
		* save_fl_bottom_pages hooks fires on Ajax call.
		* save_fl_bottom_pages method will save the bottom icon pages value.
		*/ 	 
		add_action( 'wp_ajax_fl_save_fl_bottom_pages', array ($this , 'save_fl_bottom_pages' ));


		/*
		* save_fl_cat hooks fires on Ajax call.
		* save_fl_cat method will save the cat value.
		*/ 	 
		add_action( 'wp_ajax_fl_save_fl_cat', array ($this , 'save_fl_cat' ));

		/*
		* save_fl_minimizer hooks fires on Ajax call.
		* save_fl_minimizer method will save the minimizer value.
		*/ 	 
		add_action( 'wp_ajax_fl_save_fl_minimizer', array ($this , 'save_fl_minimizer' ));

		/*
		* save_fl_post_data hooks fires on Ajax call.
		* save_fl_post_data method will save the post data value.
		*/ 	 
		add_action( 'wp_ajax_fl_save_fl_post_data', array ($this , 'save_fl_post_data' ));
	

		}/* __construct Method ends here. */

		/*
		* fl_admin_style will enqueue style and js files.
		* Returns hook name of the current page in admin.
		* $hook will contain the hook name.
		*/
		public function fl_admin_style($hook) {

			/*
			* Load only on ?page=floating_links
			*/ 
       		if('toplevel_page_floating_links' == $hook):
          	
          	/*
			* Base css file.
			*/
			wp_enqueue_style('materialize.min', FLOATING_LINKS_URL . '/css/materialize.min.css' );

			/*
			* Custom css file for admin area.
			*/
			wp_enqueue_style('floating_admin_style', FLOATING_LINKS_URL . 'css/floating_admin_style.css' );

			/*
			* Base js file.
			*/
			wp_enqueue_script( 'materialize.min', FLOATING_LINKS_URL . 'js/materialize.min.js', array( 'jquery' ) );

			/*
			* Custom js file for admin area.
			*/
			wp_enqueue_script( 'floating_admin_js', FLOATING_LINKS_URL . 'js/floating_admin_js.js', array( 'jquery' ) );

			/*
			* Localizing script to get admin-ajax url dynamically.
			*/
			wp_localize_script( 'floating_admin_js', 'fl', array(
				'ajax_url' => admin_url( 'admin-ajax.php' )
			));

       		endif;
			
		}/* fl_admin_style Method ends here. */
		
		/*
		* fl_menu will add admin page.
		* Returns nothing.
		*/
		public function fl_menu(){

		/*
		* URL of the plugin icon.
		*/	
		$icon_url = FLOATING_LINKS_URL . '/images/plugin_icon.png';

		/*
		* add_menu_page will add menu into the page.
		* string $page_title 
		* string $menu_title 
		* string $capability 
		* string $menu_slug
		* callable $function 
		*/
		add_menu_page('Floating Links Settings', 'Floating Links', 'administrator', 'floating_links', array($this,'fl_func'),$icon_url );
	
		}/* fl_menu Method ends here. */
		

		
		/*
		* fl_func contains the html/markup of the page.
		* Returns html of page.
		*/
		public function fl_func(){
			
			/*
			* Intializing the variable.
			*/
			$returner = null;
			
			/*
			* Getting recent posts.
			*/
			$recent_posts = wp_get_recent_posts( array ('posts_per_page' => 1) );

			/*
			* Getting first post from object's URL.
			*/
			$first_post_url = get_permalink($recent_posts['0']['ID']);

			/*
			* Encoding URL.
			*/
			$c_post_url = urlencode($first_post_url);

			/*
			* Making the customizer area URL.
			*/
			$c_post_url = 'customize.php?url=' . $c_post_url . '&autofocus[panel]=fl_customizer_panel';

			/*
			* Getting next feature option.
			*/
			$enable_next = get_option('fl_next', false);

			/*
			* Getting prev feature option.
			*/
			$enable_prev = get_option('fl_prev', false);

			/*
			* Getting random post feature option.
			*/
			$enable_random = get_option('fl_random', false);

			/*
			* Getting top posts feature option.
			*/
			$enable_top_posts = get_option('fl_top_posts', false);

			/*
			* Getting top pages feature option.
			*/
			$enable_top_pages = get_option('fl_top_pages', false);

			/*
			* Getting bottom feature option.
			*/
			$enable_bottom_pages = get_option('fl_bottom_pages', false);

			/*
			* Getting bottom posts feature option.
			*/
			$enable_bottom_posts = get_option('fl_bottom_posts', false);

			/*
			* Getting bottom pages feature option.
			*/
			$enable_bottom_pages = get_option('fl_bottom_pages', false);

			/*
			* Getting enabilty of floating in category.
			*/
			$enable_cat = get_option('fl_cat', false);

			/*
			* Getting minimizer feature option.
			*/
			$enable_minimizer = get_option('fl_minimizer', false);

			/*
			* Getting post data feature option.
			*/
			$enable_post_data = get_option('fl_post_data', false);

			/*
			* Html of page.
			*/
			$returner = '<div class="fl_wrap  z-depth-1">

						<!-- Main row of page<!-->
						<div class="row">

						<!-- Tabs menu starts here<!-->
					    <div class="col s12 fl_tabs_header">

					    <!-- Sliders starts here<!-->
					    <div class="fl_sliders_wrap">
						 <div id="fl_sliders">
						      <span>
						        <div class="box"></div>
						      </span>
						      <span>
						        <div class="box"></div>
						      </span>
						      <span>
						        <div class="box"></div>
						      </span>
						    </div>
					  </div> <!-- Sliders ends here<!-->

					  	<div class="fl_tabs_main">	
					      <ul class="tabs">
					        <li class="tab"><a class="active tooltipped" data-position="bottom" data-tooltip="'.__('General', 'fl').'" href="#general"><i class="material-icons dp48">settings_applications</i></a></li>	  
					      </ul>

					       <a class="tooltipped" data-position="bottom" data-tooltip="'.__('Design', 'fl').'" href="'.admin_url($c_post_url).'"><i class="material-icons">brush</i></a>

					      </div> <!-- fl_tabs_main ends here<!-->   
					    </div> <!-- Tabs menu ends here<!-->

						<!-- Tabs content wrapper<!-->
					    <div class="fl_tabs_content col s12">	
					   	 <div id="general" class="col s12 fl_general_content">

					   	 	<h5>'.__('Want to show selective floating links?', 'fl').'</h5>

					   	 	<p>'.__('No problem at all. Simply Enable and Disable features from particular tab/section below.', 'fl').'</p>
					   	 	<i class="material-icons fl_down pulse">arrow_downward</i>
					   	 
					   	 <!-- collapsible content wrapper<!-->

					   	 <div class="fl_collapsible_wrap col s12">	
					   	 	<ul class="collapsible" data-collapsible="expandable">
				              <li class="">
				                <div class="collapsible-header"><i class="material-icons">arrow_forward</i>
				                <b>'.__('Next Icon', 'fl').'</b>
				                </div>

				                 <!-- Next Icon content<!-->	
				                <div class="collapsible-body" style="display: none;">

				                	<div class="fl_checkbox_holder col s12">
				                		<input '.checked( 'true', $enable_next, false).' type="checkbox" id="fl_next_icon" data-option="fl_next" class="fl_options"/>
      									<label for="fl_next_icon">'.__('Enable', 'fl').'</label>
      								</div>
      									
				                	<p>'.__('Enable this option to show next icon on posts detail page. Changes will be saved automatically.', 'fl').'</p>

				                </div> <!-- Next Icon content ends here<!-->
				              </li>
				              <li class="">
				                <div class="collapsible-header"><i class="material-icons">arrow_back</i>
				                <b>'.__('Previous Icon', 'fl').'</b>
				                </div>

				                 <!-- Previous Icon content<!-->	
				                <div class="collapsible-body" style="display: none;">

				                	<div class="fl_checkbox_holder col s12">
				                		<input '.checked( 'true', $enable_prev, false).' type="checkbox" id="fl_prev_icon" data-option="fl_prev" class="fl_options"/>
      									<label for="fl_prev_icon">'.__('Enable', 'fl').'</label>
      								</div>
      									
				                	<p>'.__('Enable this option to show Previous icon on posts detail page. Changes will be saved automatically.', 'fl').'</p>

				                </div> <!-- Previous Icon content ends here<!-->
				              </li>
				              <li class="">

				                <div class="collapsible-header"><i class="material-icons">repeat</i>
				                <b>'.__('Random Icon', 'fl').'</b>
				                </div>

				                 <!-- Random Icon content<!-->	
				                <div class="collapsible-body" style="display: none;">

				                	<div class="fl_checkbox_holder col s12">
				                		<input '.checked( 'true', $enable_random, false).' type="checkbox" id="fl_random_icon" data-option="fl_random" class="fl_options"/>
      									<label for="fl_random_icon">'.__('Enable', 'fl').'</label>
      								</div>
      									
				                	<p>'.__('Enable this option to show Random icon on posts detail page. Changes will be saved automatically.', 'fl').'</p>

				                </div> <!-- Random Icon content ends here<!-->
				              </li>

				                <li class="">

				                <div class="collapsible-header"><i class="material-icons">arrow_upward</i>
				                <b>'.__('To Top Icon', 'fl').'</b>
				                </div>

				                 <!-- Top Icon content<!-->	
				                <div class="collapsible-body" style="display: none;">

				                	<h5>'.__('Show on posts', 'fl').' </h5>

				                	<div class="fl_checkbox_holder col s12">
				                		<input '.checked( 'true', $enable_top_posts, false).' type="checkbox" id="fl_top_posts" data-option="fl_top_posts" class="fl_options"/>
      									<label for="fl_top_posts">'.__('Enable', 'fl').'</label>
      								</div>
      									
				                	<p>'.__('Enable this option to show Top icon on posts. Changes will be saved automatically.', 'fl').'</p>

				                		<h5>'.__('Show on pages', 'fl').' </h5>

				                	<div class="fl_checkbox_holder col s12">
				                		<input '.checked( 'true', $enable_top_pages, false).' type="checkbox" id="fl_top_pages" data-option="fl_top_pages" class="fl_options"/>
      									<label for="fl_top_pages">'.__('Enable', 'fl').'</label>
      								</div>
      									
				                	<p>'.__('Enable this option to show Top icon on pages. Changes will be saved automatically.', 'fl').'</p>


				                </div> <!-- Top Icon content ends here<!-->
				              </li>

				              <li class="">

				                <div class="collapsible-header"><i class="material-icons">arrow_downward</i>
				                <b>'.__('To Bottom Icon', 'fl').'</b>
				                </div>

				                 <!-- Bottom Icon content<!-->	
				                <div class="collapsible-body" style="display: none;">

				                	<h5>'.__('Show on posts', 'fl').' </h5>

				                	<div class="fl_checkbox_holder col s12">
				                		<input '.checked( 'true', $enable_bottom_posts, false).' type="checkbox" id="fl_bottom_posts" data-option="fl_bottom_posts" class="fl_options"/>
      									<label for="fl_bottom_posts">'.__('Enable', 'fl').'</label>
      								</div>
      									
				                	<p>'.__('Enable this option to show Bottom icon on posts. Changes will be saved automatically.', 'fl').'</p>

				                	<h5>'.__('Show on pages', 'fl').' </h5>

				                	<div class="fl_checkbox_holder col s12">
				                		<input '.checked( 'true', $enable_bottom_pages, false).' type="checkbox" id="fl_bottom_pages" data-option="fl_bottom_pages" class="fl_options"/>
      									<label for="fl_bottom_pages">'.__('Enable', 'fl').'</label>
      								</div>
      									
				                	<p>'.__('Enable this option to show Bottom icon on pages. Changes will be saved automatically.', 'fl').'</p>


				                </div> <!-- Bottom Icon content ends here<!-->
				              </li>


				              <li class="">

				                <div class="collapsible-header"><i class="material-icons">toys</i>
				                <b>'.__('Navigate in same category', 'fl').'</b>
				                </div>

				                 <!-- Cat content<!-->	
				                <div class="collapsible-body" style="display: none;">

				                	<div class="fl_checkbox_holder col s12">
				                		<input '.checked( 'true', $enable_cat, false).' type="checkbox" id="fl_cat" data-option="fl_cat" class="fl_options"/>
      									<label for="fl_cat">'.__('Enable', 'fl').'</label>
      								</div>
      									
				                	<p>'.__('Enable this option to navigate floating links in same category. Changes will be saved automatically.', 'fl').'</p>

				                </div> <!-- Category ends here<!-->
				              </li>

				              <li class="">

				                <div class="collapsible-header"><i class="material-icons">close</i>
				                <b>'.__('Enable Minimizer', 'fl').'</b>
				                </div>

				                 <!-- Minimizer content<!-->	
				                <div class="collapsible-body" style="display: none;">

				                	<div class="fl_checkbox_holder col s12">
				                		<input '.checked( 'true', $enable_minimizer, false).' type="checkbox" id="fl_minimizer" data-option="fl_minimizer" class="fl_options"/>
      									<label for="fl_minimizer">'.__('Enable', 'fl').'</label>
      								</div>
      									
				                	<p>'.__('Enable this option to show close/minimizer icon. Changes will be saved automatically.', 'fl').'</p>

				                </div> <!-- Minimizer ends here<!-->    

				              </li>

				              <li>
				              	 <div class="collapsible-header"><i class="material-icons">description</i>
				                <b>'.__('Enable Post Data', 'fl').'</b>
				                </div>
				              	  <!-- Post Data content<!-->	
				                <div class="collapsible-body" style="display: none;">

				                	<div class="fl_checkbox_holder col s12">
				                		<input '.checked( 'true', $enable_post_data, false).' type="checkbox" id="fl_post_data" data-option="fl_post_data" class="fl_options"/>
      									<label for="fl_post_data">'.__('Enable', 'fl').'</label>
      								</div>
      									
				                	<p>'.__('Enable this option to show post data which displays on hover of next and previous icon. Changes will be saved automatically.', 'fl').'</p>

				                </div> <!-- Post Data ends here<!-->
				              </li>

				            </ul>
				          </div><!-- collapsible content wrapper ends<!-->
					   	 </div>

					    </div> <!-- Tabs content wrapper ends<!-->
					    
					  </div> <!-- Main row of page ends<!-->
					 
					</div>';

			
		/*
		* Returning back the html.
		*/				
		echo $returner;	
			
	}/* fl_func Method ends here. */ 

	/*
	 * Save fl next icon option value
	*/
	public function save_fl_next() { 

		/* Saving ajax value in variable. */ 
		$fl_value = $_POST['fl_value'];

		/*
		 * Saving value in wp options table.
		*/
		$fl_saved = update_option('fl_next', $fl_value);
		
		/*
		 * Checking if option is saved successfully.
		*/
		if(isset($fl_saved)){

			/*
			 * Return success message and die.
			*/	
			echo wp_send_json_success(__('Successfully Updated', 'fl'));	
			die();	
		}
		else{

			/*
			 * Return error message and die.
			*/
			echo wp_send_json_error(__('Something went wrong', 'fl'));
			die();
		}	
 	
 	}/* save_fl_next Method ends here. */ 

 	/*
	 * Save fl prev icon option value
	*/
	public function save_fl_prev() { 

		/* Saving ajax value in variable. */ 
		$fl_value = $_POST['fl_value'];

		/*
		 * Saving value in wp options table.
		*/
		$fl_saved = update_option('fl_prev', $fl_value);
		
		/*
		 * Checking if option is saved successfully.
		*/
		if(isset($fl_saved)){

			/*
			 * Return success message and die.
			*/	
			echo wp_send_json_success(__('Successfully Updated', 'fl'));	
			die();	
		}
		else{

			/*
			 * Return error message and die.
			*/
			echo wp_send_json_error(__('Something went wrong', 'fl'));
			die();
		}	
 	
 	}/* save_fl_prev Method ends here. */ 

 	/*
	 * Save fl random icon option value
	*/
	public function save_fl_random() { 

		/* Saving ajax value in variable. */ 
		$fl_value = $_POST['fl_value'];

		/*
		 * Saving value in wp options table.
		*/
		$fl_saved = update_option('fl_random', $fl_value);
		
		/*
		 * Checking if option is saved successfully.
		*/
		if(isset($fl_saved)){

			/*
			 * Return success message and die.
			*/	
			echo wp_send_json_success(__('Successfully Updated', 'fl'));	
			die();	
		}
		else{

			/*
			 * Return error message and die.
			*/
			echo wp_send_json_error(__('Something went wrong', 'fl'));
			die();
		}	
 	
 	}/* save_fl_random Method ends here. */ 

 	/*
	 * Save fl top posts option value
	*/
	public function save_fl_top_posts() { 

		/* Saving ajax value in variable. */ 
		$fl_value = $_POST['fl_value'];

		/*
		 * Saving value in wp options table.
		*/
		$fl_saved = update_option('fl_top_posts', $fl_value);
		
		/*
		 * Checking if option is saved successfully.
		*/
		if(isset($fl_saved)){

			/*
			 * Return success message and die.
			*/	
			echo wp_send_json_success(__('Successfully Updated', 'fl'));	
			die();	
		}
		else{

			/*
			 * Return error message and die.
			*/
			echo wp_send_json_error(__('Something went wrong', 'fl'));
			die();
		}	
 	
 	}/* save_fl_top_posts Method ends here. */ 

 	/*
	 * Save fl top pages option value
	*/
	public function save_fl_top_pages() { 

		/* Saving ajax value in variable. */ 
		$fl_value = $_POST['fl_value'];

		/*
		 * Saving value in wp options table.
		*/
		$fl_saved = update_option('fl_top_pages', $fl_value);
		
		/*
		 * Checking if option is saved successfully.
		*/
		if(isset($fl_saved)){

			/*
			 * Return success message and die.
			*/	
			echo wp_send_json_success(__('Successfully Updated', 'fl'));	
			die();	
		}
		else{

			/*
			 * Return error message and die.
			*/
			echo wp_send_json_error(__('Something went wrong', 'fl'));
			die();
		}	
 	
 	}/* save_fl_top_pages Method ends here. */ 

 	/*
	 * Save fl bottom pages icon option value
	*/
	public function save_fl_bottom_pages() { 

		/* Saving ajax value in variable. */ 
		$fl_value = $_POST['fl_value'];

		/*
		 * Saving value in wp options table.
		*/
		$fl_saved = update_option('fl_bottom_pages', $fl_value);
		
		/*
		 * Checking if option is saved successfully.
		*/
		if(isset($fl_saved)){

			/*
			 * Return success message and die.
			*/	
			echo wp_send_json_success(__('Successfully Updated', 'fl'));	
			die();	
		}
		else{

			/*
			 * Return error message and die.
			*/
			echo wp_send_json_error(__('Something went wrong', 'fl'));
			die();
		}	
 	
 	}/* save_fl_bottom_pages Method ends here. */ 

 	/*
	 * Save fl bottom posts option value
	*/
	public function save_fl_bottom_posts() { 

		/* Saving ajax value in variable. */ 
		$fl_value = $_POST['fl_value'];

		/*
		 * Saving value in wp options table.
		*/
		$fl_saved = update_option('fl_bottom_posts', $fl_value);
		
		/*
		 * Checking if option is saved successfully.
		*/
		if(isset($fl_saved)){

			/*
			 * Return success message and die.
			*/	
			echo wp_send_json_success(__('Successfully Updated', 'fl'));	
			die();	
		}
		else{

			/*
			 * Return error message and die.
			*/
			echo wp_send_json_error(__('Something went wrong', 'fl'));
			die();
		}	
 	
 	}/* save_fl_bottom_posts Method ends here. */ 

 	/*
	 * Save fl cat option value
	*/
	public function save_fl_cat() { 

		/* Saving ajax value in variable. */ 
		$fl_value = $_POST['fl_value'];

		/*
		 * Saving value in wp options table.
		*/
		$fl_saved = update_option('fl_cat', $fl_value);
		
		/*
		 * Checking if option is saved successfully.
		*/
		if(isset($fl_saved)){

			/*
			 * Return success message and die.
			*/	
			echo wp_send_json_success(__('Successfully Updated', 'fl'));	
			die();	
		}
		else{

			/*
			 * Return error message and die.
			*/
			echo wp_send_json_error(__('Something went wrong', 'fl'));
			die();
		}	
 	
 	}/* save_fl_cat Method ends here. */ 


 	/*
	 * Save fl minimizer option value
	*/
	public function save_fl_minimizer() { 

		/* Saving ajax value in variable. */ 
		$fl_value = $_POST['fl_value'];

		/*
		 * Saving value in wp options table.
		*/
		$fl_saved = update_option('fl_minimizer', $fl_value);
		
		/*
		 * Checking if option is saved successfully.
		*/
		if(isset($fl_saved)){

			/*
			 * Return success message and die.
			*/	
			echo wp_send_json_success(__('Successfully Updated', 'fl'));	
			die();	
		}
		else{

			/*
			 * Return error message and die.
			*/
			echo wp_send_json_error(__('Something went wrong', 'fl'));
			die();
		}	
 	
 	}/* save_fl_minimizer Method ends here. */ 

 	/*
	 * Save fl post data option value
	*/
	public function save_fl_post_data() { 

		/* Saving ajax value in variable. */ 
		$fl_value = $_POST['fl_value'];

		/*
		 * Saving value in wp options table.
		*/
		$fl_saved = update_option('fl_post_data', $fl_value);
		
		/*
		 * Checking if option is saved successfully.
		*/
		if(isset($fl_saved)){

			/*
			 * Return success message and die.
			*/	
			echo wp_send_json_success(__('Successfully Updated', 'fl'));	
			die();	
		}
		else{

			/*
			 * Return error message and die.
			*/
			echo wp_send_json_error(__('Something went wrong', 'fl'));
			die();
		}	
 	
 	}/* save_fl_minimizer Method ends here. */ 

	/**
	 * Display a thank you nag when the plugin has been installed/upgraded.
	 */
	public function fl_admin_notice() { 
 		if ( !current_user_can('install_plugins') ) return;


	$install_date = get_option( 'fl_installDate' );
    $display_date = date( 'Y-m-d h:i:s' );

    $datetime1 = new DateTime( $install_date );
    $datetime2 = new DateTime( $display_date );
    $diff_intrval = round( ($datetime2->format( 'U' ) - $datetime1->format( 'U' )) / (60 * 60 * 24) );
		if ( $diff_intrval >= 7 && get_site_option( 'fl_supported' ) != "yes" ) {
				
		
			$html = sprintf(
					    '<div class="update-nag fl_msg">
					    <p>%s<b>%s</b>%s</p>
					    <p>%s<b>%s</b>%s</p>
					    <p>%s</p>
					    <p>%s</p>
					   ~Danish Ali Malik (@danish-ali)
					   <div class="fl_support_btns">
					<a href="https://wordpress.org/support/plugin/floating-links/reviews/?filter=5#new-post" class="fl_HideRating button button-primary" target="_blank">
						%s	
					</a>
					<a href="javascript:void(0);" class="fl_HideRating button" >
					%s	
					</a>
					<br>
					<a href="javascript:void(0);" class="fl_HideRating" >
					%s	
					</a>
					    </div>
					    </div>',
					    __( 'Awesome, you have been using ', 'fl' ),
					    __( 'Floating Links ', 'fl' ),
					    __( 'for more than 1 week.', 'fl' ),
					     __( 'May I ask you to give it a ', 'fl' ),
					     __( '5-star ', 'fl' ), 
					     __( 'rating on Wordpress? ', 'fl' ), 
					     __( 'This will help to spread its popularity and to make this plugin a better one.', 'fl' ),
					    __( 'Your help is much appreciated. Thank you very much. ', 'fl' ),
					    __( 'I Like Floating Links - It increased engagement on my site', 'fl' ),
					     __( 'I already rated it', 'fl' ),
					    __( 'No, not good enough, I do not like to rate it', 'fl' )
				  
					);
			$script = ' <script>
			    jQuery( document ).ready(function( $ ) {

			    jQuery(\'.fl_HideRating\').click(function(){
			       var data={\'action\':\'fl_supported\'}
			             jQuery.ajax({
			        
			        url: "' . admin_url( 'admin-ajax.php' ) . '",
			        type: "post",
			        data: data,
			        dataType: "json",
			        async: !0,
			        success: function(e ) {
			        	
			            if (e=="success") {
			             	jQuery(\'.fl_msg\').slideUp(\'fast\');
						   
			            }
			        }
			         });
			        })
			    
			    });
    </script>';
		echo $html . $script;	
		} 	
		
 	}/* fl_admin_notice Method ends here. */ 

 	/**
	 * Save the notice closed option.
	 */
 	public function fl_supported_func(){
 		update_site_option( 'fl_supported', 'yes' );
 		echo json_encode( array("success") );
    		exit;

 	}/* fl_supported_func Method ends here. */

 	
									
}
$Floating_Links_Admin = new Floating_Links_Admin();