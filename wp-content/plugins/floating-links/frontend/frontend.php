<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

								//======================================================================
													// Frontend Class 
								//======================================================================

class Floating_Links_Frontend {
	
		/*
		* __construct initialize all function of this class.
		* Returns nothing. 
		* Used action_hooks to get things sequentially.
		*/ 
		function __construct(){

			/*
			* wp_enqueue_scripts hook will include scripts in wp.
			*/
			add_action( 'wp_enqueue_scripts', array($this, 'fl_enqueue_front_files') );

			/*
			* wp_footer hook will show floating links to the footer.
			*/
			add_action( 'wp_footer', array($this, 'fl_func' ) );
			

		}/* __construct Method ends here. */

		/*
		* fl_enqueue_front_files will enqueue all css and js files to the WordPress system.
		*/
		public function fl_enqueue_front_files() {

			/*
			* Font Awesome fonts.
			*/
			wp_enqueue_style('floating_fonts', FLOATING_LINKS_URL . '/css/floating_fonts.css' );

			/*
			* Custom css file.
			*/
			wp_enqueue_style('floating_style', FLOATING_LINKS_URL . '/css/floating_style.css' );

			/*
			* Custom js file.
			*/
			wp_enqueue_script( 'floating_custom', FLOATING_LINKS_URL . 'js/floating_custom.js', array( 'jquery' ) );

			/*
			* Base js file.
			*/
			wp_enqueue_script( 'materialize.min', FLOATING_LINKS_URL . 'js/materialize.min.js', array( 'jquery' ) );

			/*
			* Dashicons of wordpress.
			*/
			wp_enqueue_style( 'dashicons' );

		}/* fl_enqueue_files Method ends here. */

		/*
		* fl_func Will add the floating links to the site.
		*/ 	
		public function fl_func( $content ) {


			/*
			* Getting random post feature option.
			*/
			$enable_random = get_option('fl_random', false);

			/*
			* Getting next feature option.
			*/
			$enable_next = get_option('fl_next', false);

			/*
			* Getting previous feature option.
			*/
			$enable_prev = get_option('fl_prev', false);

			
			/*
			* Getting enabilty of floating in category.
			*/
			$enable_cat = get_option('fl_cat', false);

			if(isset($enable_cat) && 'true' == $enable_cat){
					$enable_cat = true;
				}
			else{
					$enable_cat = false;
				}

			/*
			* Getting left icon.
			*/	
			$left_icon = get_option( 'fl_left_icon', false);

			/*
			* Getting right icon.
			*/
			$right_icon = get_option( 'fl_right_icon', false);
			
			/*
			* Getting random icon.
			*/	
			$random_icon = get_option( 'fl_random_icon', false );
			
			/*
			* Getting up icon.
			*/	
			$up_icon = get_option( 'fl_up_icon', false);
			
			/*
			* Getting down icon.
			*/
			$down_icon = get_option( 'fl_down_icon', false);
			
			/*
			* if left icon is not defined use the default dashicon.
			*/
			if(empty($left_icon)):
				$left_icon = 'dashicons dashicons-arrow-left-alt';
			endif;

			/*
			* if right icon is not defined use the default dashicon.
			*/
			if(empty($right_icon)):
				$right_icon = 'dashicons dashicons-arrow-right-alt';
			endif;

			/*
			* if random icon is not defined use the default dashicon.
			*/	
			if(empty($random_icon)):
				$random_icon = 'dashicons dashicons-randomize';
			endif;			

			/*
			* if next post option is enable show the next post URL.
			*/			
			if(isset($enable_next) && 'true' == $enable_next):


				/*
				* Getting next post object according to in category option.
				*/
				$next_post_object = get_next_post($enable_cat);

				
				/*
				* Getting next post permalink by post ID.
				*/
				$next_post_url = get_permalink($next_post_object->ID);	

				/*
				* Getting next post title.
				*/
				$next_post_title = $next_post_object->post_title;

				/*
				* Getting next post content.
				*/
				$next_post_content = wp_trim_words( $next_post_object->post_content, 20);

				/*
				* If next post not found disable the link.
				*/
				if(!empty($next_post_object)):

					$next_href_html = 'href="'.$next_post_url.'"';

					else: $next_disabled = 'disabled';

				endif;	

				/*
				* if dashicon is selected use following html.
				*/
				if (strpos($right_icon, 'dashicons') !== false) { 

					/*
					* Next Post html with dashicon.
					*/
					$next_post = '<a '.$next_href_html.' class="'.$next_disabled.' fl_icon_holder" rel="next">
						<i class="fl_right_icon '.$right_icon.'"></i>
						<div class="fl_post_details">
							<div class="fl_post_title"><small>'.__('Next Up', 'fl').'</small></div>
							<div class="fl_post_description"><h6>'.$next_post_title.'</h6><p>'.$next_post_content.'</p></div>
						</div>
						</a>';
				}
				else{

					/*
					* Next Post html with font awesome icon.
					*/
					$next_post = '<a '.$next_href_html.' class="'.$next_disabled.' fl_icon_holder" rel="next">
						<i class="fl_right_icon fa fa-'.$right_icon.'"></i>
						<div class="fl_post_details">
							<div class="fl_post_title"><small>'.__('Next Up', 'fl').'</small></div>
							<div class="fl_post_description"><h6>'.$next_post_title.'</h6><p>'.$next_post_content.'</p></div>
						</div></a>';
	
					}
			
			endif;

			/*
			* if random post option is enable show the next post URL.
			*/
			if(isset($enable_random) && 'true' == $enable_random):

				/*
				* Random post object.
				*/
				$rand_post_object = $this->fl_random_post_url();

				/*
				* Random post URL.
				*/
				$rand_post_url = $rand_post_object['random_post_url'];

				/*
				* Random post title.
				*/
				$rand_post_title = $rand_post_object['random_post_title'];

				/*
				* Getting random post content.
				*/
				$rand_post_content = wp_trim_words( $rand_post_object['random_post_content'], 20);

				/*
				* If random post not found disable the link.
				*/
				if(!empty($rand_post_object)):

					$rand_href_html = 'href="'.$rand_post_url.'"';

					else: $rand_disabled = 'disabled';

				endif;	

				/*
				* if dashicon is selected use following html.
				*/
				if (strpos($random_icon, 'dashicons') !== false) { 

					/*
					* Random Post html with dashicon.
					*/
					$random_post = '<a  title="'.$rand_post_title.'" '.$rand_href_html.' class="'.$rand_disabled.' fl_icon_holder"><i class="fl_random_icon '.$random_icon.'"></i>
						<div class="fl_post_details">
								<div class="fl_post_title"><small>'.__('Random', 'fl').'</small></div>
								<div class="fl_post_description"><h6>'.$rand_post_title.'</h6><p>'.$rand_post_content.'</p></div>
							</div>
						</a>';
				}
				else{

					/*
					* Random Post html with font awesome icon.
					*/
					$random_post = '<a  title="'.$rand_post_title.'" '.$rand_href_html.' class="'.$rand_disabled.' fl_icon_holder"><i class="fl_random_icon fa 
							fa-'.$random_icon.'"></i>
						<div class="fl_post_details">
								<div class="fl_post_title"><small>'.__('Random', 'fl').'</small></div>
								<div class="fl_post_description"><h6>'.$rand_post_title.'</h6><p>'.$rand_post_content.'</p></div>
							</div>	
					</a>';
				}
					
			endif;

			/*
			* if previous post option is enable show the previous post URL.
			*/
			if(isset($enable_prev) && 'true' == $enable_prev):


				/*
				* Getting prev post object according to in category option.
				*/
				$previous_post_object = get_previous_post($enable_cat);

				/*
				* Getting prev post permalink by post ID.
				*/
				$previous_post_url = get_permalink($previous_post_object->ID);	

				/*
				* Getting prev post title.
				*/
				$previous_post_title = $previous_post_object->post_title;

				/*
				* Getting previous post content.
				*/
				$previous_post_content = wp_trim_words( $previous_post_object->post_content, 20);

				/*
				* If prev post not found disable the link.
				*/
				if(!empty($previous_post_object)):

					$prev_href_html = 'href="'.$previous_post_url.'"';

					else: $prev_disabled = 'disabled';

				endif;	

				/*
				* if dashicon is selected use following html.
				*/
				if (strpos($left_icon, 'dashicons') !== false) { 

					/*
					* Previous Post html with dashicon.
					*/
					$prev_post = '<a '.$prev_href_html.' class="'.$prev_disabled.' fl_icon_holder" rel="next">
						<i class="fl_left_icon '.$left_icon.'"></i><span class="fl_post_details">Tooltip text</span>
						<div class="fl_post_details">
								<div class="fl_post_title"><small>'.__('Previous', 'fl').'</small></div>
								<div class="fl_post_description"><h6>'.$previous_post_title.'</h6><p>'.$previous_post_content.'</p></div>
							</div>	
						</a>';
				}

				else{

					/*
					* Previous Post html with fontawesome icon.
					*/
					$prev_post = '<a '.$prev_href_html.' class="'.$prev_disabled.' fl_icon_holder" rel="next">
						<i class="fl_left_icon fa fa-'.$left_icon.'"></i>
						<div class="fl_post_details">
								<div class="fl_post_title"><small>'.__('Previous', 'fl').'</small></div>
								<div class="fl_post_description"><h6>'.$previous_post_title.'</h6><p>'.$previous_post_content.'</p></div>
							</div>	
					</a>';
				}

			endif;

			/*
			* $content holds the all html.
			*/
			$content .= '<div class="floating_next_prev_wrap">
									
							<div class="floating_links">
								
							<div class="fl_inner_wrap">';

							/*
							* if the current page is post page.
							*/
							 if (is_single()) {
								$content .= '
								'.$next_post.'
								'.$prev_post.'
								'.$random_post.'';
								}

			/*
			* if up icon is not selected use default one.
			*/					
			if(empty($up_icon)):
				$up_icon = 'dashicons dashicons-arrow-up-alt';
			endif;

			/*
			* if down icon is not selected use default one.
			*/	
			if(empty($down_icon)):
				$down_icon = 'dashicons dashicons-arrow-down-alt';
			endif;	

			/*
			* Getting top pages feature option.
			*/
			$enable_top_pages = get_option('fl_top_pages', false);

			/*
			* Getting top posts feature option.
			*/
			$enable_top_posts = get_option('fl_top_posts',false);
				// echo "<pre>";
				// print_r($top_posts_only);exit();

				

			/*
			* if to top option is enable show the up icon.
			*/
			if('true' == $enable_top_pages or 'true' == $enable_top_posts ):	
				
				if(is_page() or is_home() && 'true' == $enable_top_pages):

					/*
					* if dashicon is selected use following html.
					*/
					if (strpos($up_icon, 'dashicons') !== false) {	
						
						/*
						* Up icon html with dashicon.
						*/
						$content .= '<a title="'.__('Go to top', 'fl').'" href="#" id="fl_to_top"><i class="fl_top_icon '.$up_icon.'" aria-hidden="true"></i></a>';
					}
					else{

						/*
						* Up icon html with fontawesome icon.
						*/
						$content .= '<a title="'.__('Go to top', 'fl').'" href="#" id="fl_to_top"><i class="fl_top_icon fa fa-'.$up_icon.'" aria-hidden="true"></i></a>';	
					}

				endif; 	
		

				if(is_single() && 'true' == $enable_top_posts):

					/*
					* if dashicon is selected use following html.
					*/
					if (strpos($up_icon, 'dashicons') !== false) {	
						
						/*
						* Up icon html with dashicon.
						*/
						$content .= '<a title="'.__('Go to top', 'fl').'" href="#" id="fl_to_top"><i class="fl_top_icon '.$up_icon.'" aria-hidden="true"></i></a>';
					}
					else{

						/*
						* Up icon html with fontawesome icon.
						*/
						$content .= '<a title="'.__('Go to top', 'fl').'" href="#" id="fl_to_top"><i class="fl_top_icon fa fa-'.$up_icon.'" aria-hidden="true"></i></a>';	
					}


				endif;	
	
			endif;

			/*
			* Getting bottom pages feature option.
			*/
			$enable_bottom_pages = get_option('fl_bottom_pages', false);

			/*
			* Getting top posts feature option.
			*/
			$enable_bottom_posts = get_option('fl_bottom_posts',false);

			/*
			* if to bottom option is enable show the bottom icon.
			*/
			if('true' == $enable_bottom_pages or 'true' == $enable_bottom_posts ):

				if(is_page() or is_home() && 'true' == $enable_bottom_pages):
					/*
					* if dashicon is selected use following html.
					*/	
					if (strpos($down_icon, 'dashicons') !== false) {

						/*
						* Bottom icon html with dashicon.
						*/		
						$content .= '<a title="'.__('Go to bottom', 'fl').'" href="#" id="fl_to_bottom"><i class="fl_bottom_icon '.$down_icon.'" aria-hidden="true"></i></a>';
					}
					else{

						/*
						* Bottom icon html with fontawesome icon.
						*/	
						$content .= '<a title="'.__('Go to bottom', 'fl').'" href="#" id="fl_to_bottom"><i class="fl_bottom_icon fa fa-'.$down_icon.'" aria-hidden="true"></i></a>';
					}

				endif;	


				if(is_single() && 'true' == $enable_bottom_posts):

					/*
					* if dashicon is selected use following html.
					*/	
					if (strpos($down_icon, 'dashicons') !== false) {

						/*
						* Bottom icon html with dashicon.
						*/		
						$content .= '<a title="'.__('Go to bottom', 'fl').'" href="#" id="fl_to_bottom"><i class="fl_bottom_icon '.$down_icon.'" aria-hidden="true"></i></a>';
					}
					else{

						/*
						* Bottom icon html with fontawesome icon.
						*/	
						$content .= '<a title="'.__('Go to bottom', 'fl').'" href="#" id="fl_to_bottom"><i class="fl_bottom_icon fa fa-'.$down_icon.'" aria-hidden="true"></i></a>';
					}


				endif;		

			endif;	
				
			$content .= '</div>';

			/*
			* Getting Minimizer feature option.
			*/
			$enable_minimizer = get_option('fl_minimizer', false);

			/*
			* if it's not post page check up and down features in enable then show.
			*/
			if (!is_single() or is_home()){

				/*
				* Making array of top and bottom feature.
				*/
				$expect_post_array = array($enable_top_posts,$enable_top_pages, $enable_bottom_posts, $enable_bottom_pages);

				/*
				* Checking if any of them is enable.
				*/
				$fl_true_pages = in_array('true', $expect_post_array);

				if(!empty($fl_true_pages) && 'true' == $enable_minimizer):

					/*
					* Slimer html
					*/
					$content .= '<div class="fl_slimer_Wrap" title="'.__('Floating Links', 'fl').'">
											<i class="fa fa-close"></i>
										</div>';
					endif;
				}
			else{

				/*
				* Making array of random, next, prev, top, bottom feature.
				*/
				$all_options_array = array($enable_random, $enable_next, $enable_prev, $enable_top_posts,$enable_top_pages, $enable_bottom_posts, $enable_bottom_pages);
				
				/*
				* Checking if any of them is enable.
				*/	
				$fl_true_posts = in_array('true', $all_options_array);

					/*
					* Slimer html
					*/
					if(!empty($fl_true_posts) && 'true' == $enable_minimizer):
						$content .= '<div class="fl_slimer_Wrap" title="'.__('Floating Links', 'fl').'">
											<i class="fa fa-close"></i>
										</div>';
					endif;
			}

			$content .= '</div>
						</div>';
    		
    		/*
			* Showing the content.
			*/
			echo $content;	

		}/* fl_func Method ends here. */	

		/*
		* fl_random_post_url returns the post url randomaly.
		*/
		public function fl_random_post_url(){

			/*
			* Gets current post's post type.
			*/	
			$post_type = get_post_type();

			/*
			* Gets random post with the same post type.
			*/	
			$rand = get_posts(array('posts_per_page' => 1, 'orderby' => 'rand', 'post_type' => $post_type));

			/*
			* Gets random URL.
			*/	
			$rand_url = get_permalink($rand[0]->ID);

			/*
			* Gets random post title.
			*/	
			$rand_post_title = $rand[0]->post_title;

			/*
			* Gets random post title.
			*/	
			$rand_post_content = $rand[0]->post_content;
			/*
			* Returns random URL and Post title.
			*/
			return array('random_post_url' => $rand_url, 'random_post_title' => $rand_post_title, 'random_post_content' => $rand_post_content);

		}/* fl_random_post_url Method ends here. */	

				
}
$Floating_Links_Frontend = new Floating_Links_Frontend();