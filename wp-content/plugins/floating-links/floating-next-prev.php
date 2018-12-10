<?php 
/*
Plugin Name: Floating Links
Plugin URI: https://wordpress.org/plugins/floating-links/
Description: Displays fancy floating top, bottom, next post, previous post and random post links with custom post types support.
Author: Danish Ali Malik
Version: 3.0.2
Author URI: https://profiles.wordpress.org/danish-ali
*/ 

								//======================================================================
													// Floating links Class 
								//======================================================================
								
class Floating_Links{

		/*
		* Plugin Version variable.
		*/
		public $fl_version = '3.0.2';

		/*
		* __construct initialize all function of this class.
		* Returns nothing. 
		* Used action_hooks to get things sequentially.
		*/ 
		function __construct(){

			/*
			* init hooks fires on wp load.
			* Intialize all constants.
			*/ 	
			add_action('init', array($this, 'fl_constants'));

			/*
			* init hooks fires on wp load.
			* Includes all files.
			*/ 	
			add_action('init', array($this, 'fl_includes'));

			/*
			* register_activation_hook fires plugin install.
			*/ 	
			register_activation_hook( __FILE__,  array($this , 'fl_activate'));

			/*
			* register_uninstall_hook fires plugin delete.
			*/ 	
			register_uninstall_hook(__FILE__, array('Floating_Links' ,'fl_uninstall'));


			/*
			* Will add the floating links settings page link in the plugin area.
			*/ 	
			add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array ($this , 'fl_settings_link'));
		}/* __construct Method ends here. */
			
	
		/*
		* fl_includes will add floating links files to the WordPress system.
		*/
		public function fl_includes() {

			/*
			* Holds admin area's code.
			*/
			include (  plugin_dir_path( __FILE__ ) . 'admin/admin.php');

			/*
			* Holds frontend area's code.
			*/
			include (  plugin_dir_path( __FILE__ ) . 'frontend/frontend.php');

			/*
			* Extened customizer classes.
			*/	
			include (  plugin_dir_path( __FILE__ ) . 'admin/customizer-extend.php');

			/*
			* Holds customizer area's code.
			*/	
			include (  plugin_dir_path( __FILE__ ) . 'admin/customizer.php');

		}/* fl_includes Method ends here. */

		/*
		* fl_constants will define all the constants.
		*/
		public function fl_constants() {

			/*
			* FLOATING_LINKS_VERSION constant will be defined.
			* Holds the version of the floating links.
			*/
			if ( ! defined( 'FLOATING_LINKS_VERSION' ) ):
				define( 'FLOATING_LINKS_VERSION', $this->fl_version );
			endif;	

			/*
			* FLOATING_LINKS_DIR constant will be defined.
			* Holds the directory path.
			*/
			if ( ! defined( 'FLOATING_LINKS_DIR' ) ):
				define( 'FLOATING_LINKS_DIR', plugin_dir_path( __FILE__ ) );
			endif;	

			/*
			* FLOATING_LINKS_URL constant will be defined.
			* Holds the main directory URL.
			*/
			if ( ! defined( 'FLOATING_LINKS_URL' ) ):
				define( 'FLOATING_LINKS_URL', plugin_dir_url( __FILE__ ) );
			endif;	

			/*
			* FLOATING_LINKS_FILE constant will be defined.
			* Holds the main floating links file.
			*/
			if ( ! defined( 'FLOATING_LINKS_FILE' ) ):
				define( 'FLOATING_LINKS_FILE', __FILE__ );
			endif;

		}/* fl_constants Method ends here. */

		/*
		* fl_activate will call on plugin activation.
		* adds the installation date and version of the plugin to Database.
		*/
		public function fl_activate(){

			$old_version = get_option('jws_floating_version', false);
			
			if(!empty($old_version)):

				$old_install_date = get_option( 'jws_floating_installDate' );
				update_option('fl_installDate', $old_install_date);
				delete_option('jws_floating_installDate');	
				delete_option('jws_floating_version');

			endif;		
					$left_icon = get_option( 'floating_left', false);
					$right_icon = get_option( 'floating_right', false);
					$random_icon = get_option( 'floating_random', false);
					$top_icon = get_option( 'floating_up', false);
					$bottom_icon = get_option( 'floating_down', false);

					$bg_color = get_option('jws_floating_c_bg_color', false);
					$color = get_option('jws_floating_c_color', false);
					$size = get_option('jws_floating_c_size', false);
					$bcolor = get_option('jws_floating_c_b_color', false);
					$hbcolor = get_option('jws_floating_c_h_bgcolor', false);
					$hcolor = get_option('jws_floating_c_h_color', false);
					$shadow = get_option('jws_floating_c_shadow', false);
					$position = get_option('jws_floating_c_pos', false);

					$enable_random = get_option('jws_floating_random', true);
					$enable_np = get_option('jws_floating_np', true);
					$enable_top = get_option('jws_floating_top', true);
					$enable_bottom = get_option('jws_floating_bottom', true);
					$enable_cat = get_option('jws_floating_cat', true);	

				if(!empty($bg_color)):
					update_option('fl_left_icon', $left_icon);
					update_option('fl_right_icon', $right_icon);
					update_option('fl_random_icon', $random_icon);
					update_option('fl_up_icon', $top_icon);
					update_option('fl_down_icon', $bottom_icon);

					update_option('fl_bg_color', $bg_color);
					update_option('fl_position', $position);
					update_option('fl_color', $color);
					update_option('fl_icon_size', $size);
					update_option('fl_seprator_color', $bcolor);
					update_option('fl_hover_bg_color', $hbcolor);
					update_option('fl_icon_hover_color', $hcolor);
					update_option('fl_shadow', $shadow);

					if($enable_np == 'on'){
						$enable_np = true;
					}
					else{
						$enable_np = false;
					}

					if($enable_random == 'on'){
						$enable_random = true;
					}
					else{
						$enable_random = false;
					}
					if($enable_top == 'on'){
						$enable_top = true;
					}
					else{
						$enable_top = false;
					}
					if($enable_bottom == 'on'){
						$enable_bottom = true;
					}
					else{
						$enable_bottom = false;
					}
					if($enable_cat == 'on'){
						$enable_cat = true;
					}
					else{
						$enable_cat = false;
					}
					update_option('fl_next', $enable_np);
					update_option('fl_prev', $enable_np);
					update_option('fl_random', $enable_random);
					update_option('fl_top_posts', $enable_top);
					update_option('fl_top_pages', $enable_top);
					update_option('fl_bottom_posts', $enable_bottom);
					update_option('fl_bottom_pages', $enable_bottom);
					update_option('fl_cat', $enable_cat);
					update_option('fl_minimizer', true);
					update_option('fl_post_data', true);
				endif;	

					delete_option( 'floating_left' );
					delete_option( 'floating_right');
					delete_option( 'floating_random');
					delete_option( 'floating_up');
					delete_option( 'floating_down');
					delete_option('jws_floating_c_bg_color');
					delete_option('jws_floating_c_color');
					delete_option('jws_floating_c_size');
					delete_option('jws_floating_c_b_color');
					delete_option('jws_floating_c_h_bgcolor');
					delete_option('jws_floating_c_h_color');
					delete_option('jws_floating_c_shadow');	
					delete_option('jws_floating_c_pos');
					delete_option('jws_floating_random');
					delete_option('jws_floating_np');
					delete_option('jws_floating_top');
					delete_option('jws_floating_bottom');
					delete_option('jws_floating_cat');		
			
			/*
			* Gets installed date if exists.
			*/
			$install_date = get_option( 'fl_installDate' );

			/*
			* Update the version of the plugin.
			*/
			update_option('fl_version', $this->fl_version);

			/*
			* By Default all options are true
			*/
			if( empty($install_date)){

					update_option('fl_next', 'true');
					update_option('fl_prev', 'true');
					update_option('fl_random', 'true');
					update_option('fl_top_posts', 'true');
					update_option('fl_minimizer', 'true');
					update_option('fl_post_data', 'true');
					update_option('fl_top_pages', 'true');
					update_option('fl_bottom_posts', 'true');
					update_option('fl_bottom_pages', 'true');
					update_option( 'fl_shadow', '1' );
					add_option( 'fl_installDate', date( 'Y-m-d h:i:s' ) );
				}
		}/* fl_activate Method ends here. */	

		/*
		* fl_uninstall will call on plugin deletion.
		* Removes the values from database.
		*/
		public function fl_uninstall(){

			/*
			* Making array of deletion keys.
			*/
			$deletion_keys = array(
				'floating_left',
				'floating_right',
				'floating_random',
				'floating_up',
				'floating_down',
				'jws_floating_c_bg_color',
				'jws_floating_c_color',
				'jws_floating_c_size',
				'jws_floating_c_b_color',
				'jws_floating_c_h_bgcolor',
				'jws_floating_c_h_color',
				'jws_floating_c_shadow',
				'jws_floating_c_pos',
				'jws_floating_random',
				'jws_floating_np',
				'jws_floating_top',
				'jws_floating_bottom',
				'jws_floating_cat',
				'fl_next',
				'fl_prev',
				'fl_random',
				'fl_top_posts',
				'fl_top_pages',
				'fl_bottom_posts',
				'fl_bottom_pages',
				'fl_cat',
				'fl_minimizer',
				'fl_left_icon',
				'fl_right_icon',
				'fl_random_icon',
				'fl_up_icon',
				'fl_down_icon',
				'fl_bg_color',
				'fl_position',
				'fl_color',
				'fl_icon_size',
				'fl_seprator_color',
				'fl_hover_bg_color',
				'fl_icon_hover_color',
				'fl_shadow'
			);
			
			/*
			* Remove all options from db by loop.
			*/
			foreach ($deletion_keys as $key) {
				delete_option($key);
			}
			
			
	
		}/* fl_uninstall Method ends here. */	
						
		/*
		* fl_settings_link Will add the floating links settings page link in the plugin area.
		*/ 		
		public function fl_settings_link ( $links ) {

		 $fl_link = array(
		 '<a href="' . admin_url( 'admin.php?page=floating_links' ) . '">'.__('Settings', 'fl').'</a>',
		 );

		return array_merge($fl_link, $links);

		}/* fl_settings_link Method ends here. */
	
			
	} // End Class								
$floating_links = new Floating_Links();