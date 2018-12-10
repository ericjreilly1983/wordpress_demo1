<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

								//======================================================================
													// Floating links Customizer Class 
								//======================================================================

class FLOATING_LINKS_CUSTOMIZER {

		/*
		* __construct initialize all function of this class.
		* Returns nothing. 
		* Used action_hooks to get things sequentially.
		*/ 
		function __construct(){

			/*
			* Will register settings and panel in cutomizer.
			*/ 
			add_action( 'customize_register', array ($this , 'fl_customizer' )); 
			
			/*
			* Print css in wp head.
			*/
			add_action( 'wp_head', array($this, 'fl_customizer_css') );

			/*
			* Will enqueue scripts and css in customizer in cutomizer.
			*/ 
			add_action( 'customize_controls_enqueue_scripts', array ($this , 'fl_customizer_files' ) );
			
			/*
			* Load file on previewing in cutomizer.
			*/
			add_action( 'customize_preview_init', array ($this ,'fl_live_preview'));	

		}/* __construct Method ends here. */

								
		/*
		* fl_customizer Will register settings and panel in cutomizer.
		*/ 
		function fl_customizer( $wp_customize ) {

			/*
			* Adding panel in customizer.
			*/ 
			$wp_customize->add_panel( 'fl_customizer_panel', array(
					'capability' => null,
					'priority'	=> 160,
					'theme_supports' => null,
					'title' => __( 'Floating Links Settings', 'fl' )
							
			) );

			/*
			* Adding icons section in panel.
			*/ 
			$wp_customize->add_section( 'fl_icons_section', array(
					'title' => __( 'Change icons ', 'fl' ),
					'description' => __('Chose any icon from the list below and see the magic live.', 'fl'),
					'priority' => 160,
					'panel' => 'fl_customizer_panel',	
						
			));

			/*
			* Adding desgin section in panel.
			*/		
			$wp_customize->add_section( 'fl_design_section', array(
					'title' => __( 'Design', 'fl' ),
					'description' => __('Customize design of your fancy floating links live.', 'fl'),
					'priority' => 160,
					'panel' => 'fl_customizer_panel'	
						
			));

			/*
			* Adding position section in panel.
			*/	
			$wp_customize->add_section( 'fl_position_section', array(
					'title' => __( 'Change position', 'fl' ),
					'description' => __('Show Floating Links on left, right, top and bottom side.', 'fl'),
					'priority' => 160,
					'panel' => 'fl_customizer_panel'	
						
			));

			/*
			* Adding position setting.
			*/
			$wp_customize->add_setting( 'fl_position', array(
					'default' => 'right',
					'transport' => 'postMessage',
					'type' => 'option'
						
			));
				
			/*
			* Adding position control.
			*/	
			$wp_customize->add_control( 'fl_position', array(
				   'type' => 'radio',
				   'section' => 'fl_position_section', // Add a default or your own section
				   'label' => __( 'Position', 'fl'),
				   'choices' => array(
				    'left' => __( 'Left', 'fl'),
				    'right' => __( 'Right', 'fl'),
				    'top' => __( 'Top', 'fl'),
				    'bottom' => __( 'Bottom', 'fl'),
				  ),
			) );

			/*
			* Adding background color setting.
			*/
			$wp_customize->add_setting('fl_bg_color', array(
					'default' => '#fff',
					'transport' => 'postMessage',
					'type' => 'option'
						
			));

			/*
			* Adding background color control.
			*/	
			$wp_customize->add_control( new WP_Customize_Color_Control(
					$wp_customize, 
					'fl_bg_color',
					$this->cutomizer_values('Background colour.', 'fl_design_section', 'fl_bg_color', null)
					
			));

			/*
			* Adding color setting.
			*/
			$wp_customize->add_setting( 'fl_color', array(
					'default' => '#000',
					'transport' => 'postMessage',
					'type' => 'option'
						
			));
			
			/*
			* Adding color control.
			*/	
			$wp_customize->add_control( new WP_Customize_Color_Control(
					$wp_customize, 
					'fl_color',
					$this->cutomizer_values('Icons colour.', 'fl_design_section', 'fl_color', null)
				
			));

			/*
			* Adding icon hover color setting.
			*/
			$wp_customize->add_setting(
					'fl_icon_hover_color',
					array(
						'default' => '#fff',
						'transport' => 'postMessage',
						'type' => 'option'
						
			));	
			
			/*
			* Adding icon hover color control.
			*/	
			$wp_customize->add_control( new WP_Customize_Color_Control(
					$wp_customize, 
					'fl_icon_hover_color',
					$this->cutomizer_values('Icons hover colour.', 'fl_design_section', 'fl_icon_hover_color', null)
			
			));
		
			/*
			* Adding icon hover background color setting.
			*/
			$wp_customize->add_setting( 'fl_hover_bg_color', array(
					'default' => '#000',
					'transport' => 'postMessage',
					'type' => 'option'
						
			));
				
			/*
			* Adding icon hover background color control.
			*/	
			$wp_customize->add_control( new WP_Customize_Color_Control(
					$wp_customize, 
					'fl_hover_bg_color',
					$this->cutomizer_values('Icons hover background colour.', 'fl_design_section', 'fl_hover_bg_color', null)
				 
			));
			
			/*
			* Adding icon size setting.
			*/		
			$wp_customize->add_setting( 'fl_icon_size', array(
					'default' => '18',
					'transport' => 'postMessage',
					'type' => 'option'
						
			));

			/*
			* Adding icon size control.
			*/	
			$wp_customize->add_control( new WP_Customize_Range_Control(
					$wp_customize,
					'fl_icon_size',
					 array(
						'label'       => __('Icons size.','fl'),
						'section'     => 'fl_design_section',
						'settings'    => 'fl_icon_size',
						'input_attrs' => array(
						'max' => 100,
						),)
			 ));
			
			/*
			* Adding icon seprator color setting.
			*/
			$wp_customize->add_setting( 'fl_seprator_color', array(
					'default' => '#000',
					'transport' => 'postMessage',
					'type' => 'option'
						
			));
			
			/*
			* Adding icon seprator color control.
			*/	
			$wp_customize->add_control(new WP_Customize_Color_Control(
					$wp_customize, 
					'fl_seprator_color',
					$this->cutomizer_values('Icons separator colour.', 'fl_design_section', 'fl_seprator_color', null)
			
			));

			

			/*
			* Adding shadow setting.
			*/
			$wp_customize->add_setting( 'fl_shadow', array(
					'default' => '1',
					'transport' => 'postMessage',
					'type' => 'option'
						
			));

			/*
			* Adding shadow control.
			*/
			$wp_customize->add_control(
					'fl_shadow',
					$this->cutomizer_values('Enable shadow', 'fl_design_section', 'fl_shadow', 'checkbox')
			
			);

			/*
			* Adding Hover Post data background Color.
			*/
			$wp_customize->add_setting( 'fl_hover_post_bg_color', array(
					'default' => '#fff',
					'transport' => 'postMessage',
					'type' => 'option'
						
			)); 
			
			/*
			* Adding Hover Post data background Color control.
			*/	
			$wp_customize->add_control(new WP_Customize_Color_Control(
					$wp_customize, 
					'fl_hover_post_bg_color',
					$this->cutomizer_values('Hover post data background colour.', 'fl_design_section', 'fl_hover_post_bg_color', null)
			
			));

			/*
			* Adding Hover Post data Color.
			*/
			$wp_customize->add_setting( 'fl_hover_post_headings_color', array(
					'default' => '#000',
					'transport' => 'postMessage',
					'type' => 'option'
						
			)); 
			
			/*
			* Adding Hover Post data background Color control.
			*/	
			$wp_customize->add_control(new WP_Customize_Color_Control(
					$wp_customize, 
					'fl_hover_post_headings_color',
					$this->cutomizer_values('Hover post data headings colour.', 'fl_design_section', 'fl_hover_post_headings_color', null)
			
			));

			/*
			* Adding Hover Post data Color.
			*/
			$wp_customize->add_setting( 'fl_hover_post_color', array(
					'default' => '#000',
					'transport' => 'postMessage',
					'type' => 'option'
						
			)); 
			
			/*
			* Adding Hover Post data Color control.
			*/	
			$wp_customize->add_control(new WP_Customize_Color_Control(
					$wp_customize, 
					'fl_hover_post_color',
					$this->cutomizer_values('Hover post data text colour.', 'fl_design_section', 'fl_hover_post_color', null)
			
			));

			/*
			* Adding Hover Post data Color.
			*/
			$wp_customize->add_setting( 'fl_hover_post_seprator_color', array(
					'default' => '#000',
					'transport' => 'postMessage',
					'type' => 'option'
						
			)); 
			
			/*
			* Adding Hover Post data Color control.
			*/	
			$wp_customize->add_control(new WP_Customize_Color_Control(
					$wp_customize, 
					'fl_hover_post_seprator_color',
					$this->cutomizer_values('Hover post data seprator colour.', 'fl_design_section', 'fl_hover_post_seprator_color', null)
			
			));

			/*
			* Making array of left icons to show in customizer.
			* Filter fl_left_icons used to add any custom icons to it.
			*/	
			$iconsleft = apply_filters ( 'fl_left_icons', array('dashicons dashicons-arrow-left-alt',
				'dashicons dashicons-arrow-left-alt2',
				'angle-left',
				'arrow-circle-left',
				'arrow-circle-o-left',
				'arrow-left',
				'caret-left',
				'caret-square-o-left',
				'chevron-circle-left',
				'chevron-left',
				'hand-o-left',
				'long-arrow-left'

			));									

			/*
			* adding left icons setting.
			*/	
			$wp_customize->add_setting( 'fl_left_icon', array('transport' => 'postMessage','type' => 'option') );

			/*
			* adding left icons control.
			*/	
			$wp_customize->add_control(new Fl_Icons_Control(
				$wp_customize, 'fl_left_icon', array(
				'section' => 'fl_icons_section',
				'label' => __( 'Select left icon.', 'fl' ),
				'type' => 'radio',
				'choices' => $iconsleft,

			) ) );


			/*
			* Making array of right icons to show in customizer.
			* Filter fl_right_icons used to add any custom icons to it.
			*/		
			$iconsright = apply_filters('fl_right_icons',array('dashicons dashicons-arrow-right-alt',
				'dashicons dashicons-arrow-right-alt2',
				'angle-right',
				'arrow-circle-right',
				'arrow-circle-o-right',
				'arrow-right',
				'caret-right',
				'caret-square-o-right',
				'chevron-circle-right',
				'chevron-right',
				'hand-o-right',
				'long-arrow-right'

			));							
			
			/*
			* adding right icons setting.
			*/	
			$wp_customize->add_setting( 'fl_right_icon', array('transport' => 'postMessage','type' => 'option') );
			
			/*
			* adding right icons control.
			*/	
			$wp_customize->add_control(new Fl_Icons_Control( $wp_customize, 'fl_right_icon', array(
				'section' => 'fl_icons_section',
				'priority' => 180,
				'label' => __( 'Select right icon.', 'fl' ),
		    	'type' => 'radio',
		    	'choices' => $iconsright,
			)));
				
			/*
			* Making array of random icons to show in customizer.
			* Filter fl_random_icons used to add any custom icons to it.
			*/	
			$iconsrandom = apply_filters('fl_random_icons', array('dashicons dashicons-randomize', 'random'));

			/*
			* adding random icons setting.
			*/	
			$wp_customize->add_setting( 'fl_random_icon', array('transport' => 'postMessage','type' => 'option') );
			
			/*
			* adding random icons control.
			*/	
			$wp_customize->add_control(new Fl_Icons_Control( $wp_customize, 'fl_random_icon', array(
				'section' => 'fl_icons_section',
				'priority' => 180,
				'label' => __( 'Select Random icon.', 'fl' ),
				'type' => 'radio',
				'choices' => $iconsrandom,

			)));
			
			/*
			* Making array of up icons to show in customizer.
			* Filter fl_up_icons used to add any custom icons to it.
			*/	
			$iconsup = apply_filters ('fl_up_icons', array('dashicons dashicons-arrow-up-alt',
				'dashicons dashicons-arrow-up-alt2',
				'angle-up',
				'arrow-circle-up',
				'arrow-circle-o-up',
				'arrow-up',
				'caret-up',
				'caret-square-o-up',
				'chevron-circle-up',
				'chevron-up','hand-o-up','long-arrow-up'
			));

			/*
			* adding up icons setting.
			*/	
			$wp_customize->add_setting( 'fl_up_icon', array('transport' => 'postMessage','type' => 'option') );

			/*
			* adding up icons control.
			*/	
			$wp_customize->add_control(new Fl_Icons_Control( $wp_customize, 'fl_up_icon', array(
				'section' => 'fl_icons_section',
				'priority' => 180,
			    'label' => __( 'Select up icon.', 'fl' ),
			    'type' => 'radio',
				'choices' => $iconsup,

			)));	

			/*
			* Making array of down icons to show in customizer.
			* Filter fl_down_icons used to add any custom icons to it.
			*/		
			$iconsdown = apply_filters ('fl_down_icons', array('dashicons dashicons-arrow-down-alt',
				'dashicons dashicons-arrow-down-alt2',
				'angle-down',
				'arrow-circle-down',
				'arrow-circle-o-down',
				'arrow-down',
				'caret-down',
				'caret-square-o-down',
				'chevron-circle-down',
				'chevron-down',
				'hand-o-down',
				'long-arrow-down'

			));

			/*
			* adding down icons setting.
			*/	
			$wp_customize->add_setting( 'fl_down_icon', array('transport' => 'postMessage','type' => 'option') );
			
			/*
			* adding down icons control.
			*/	 
			$wp_customize->add_control(new Fl_Icons_Control( $wp_customize, 'fl_down_icon', array(
				'section' => 'fl_icons_section',
				'priority' => 180,
				'label' => __( 'Select down icon.', 'fl' ),
				'type' => 'radio',
				'choices' => $iconsdown,

			)));	

		}/* fl_customizer Method ends here. */	

		/*
		* cutomizer_values holds the control values.
		*/ 
		function cutomizer_values($label, $section,  $settings, $type){
				
				/*
				* Controls indexes array.
				*/
				$array = array (
						'label' => __($label, 'fl' ),
						'section' => $section,
						'settings'   => $settings,
						'type' => $type,
				);

				/*
				* Returning back array.
				*/
				return $array;
			
		}/* cutomizer_values Method ends here. */	

		/*
		 * fl_live_preview will enqeue custom script in live preview.
		*/
		function fl_live_preview(){

			/*
			 * Enqueuing js for customizer live 
			*/
			wp_enqueue_script( 'floating_customizer_live', FLOATING_LINKS_URL . 'js/floating_customizer_live.js',array( 'jquery','customize-preview' ), true );

		}/* fl_live_preview Method ends here. */

		/*
		 * fl_customizer_files will enqeue custom script in customizer.
		*/
		function fl_customizer_files(){

			
			wp_enqueue_style('floating_fonts', FLOATING_LINKS_URL . 'css/floating_fonts.css' );

			wp_enqueue_style( 'dashicons' );	

			/*
			* Custom css file for customizer.
			*/
			wp_enqueue_style('floating_customizer', FLOATING_LINKS_URL . 'css/floating_customizer.css' );

			/*
			 * Enqueuing js for customizer. 
			*/
			wp_enqueue_script( 'floating_customizer_js', FLOATING_LINKS_URL . 'js/floating_customizer_js.js',array( 'jquery' ), true );


		}/* fl_customizer_files Method ends here. */

		/*
		 * fl_customizer_css will print css to the head of wp.
		*/
		function fl_customizer_css(){
		
			?>
			<style type="text/css">

				.floating_next_prev_wrap .floating_links .fl_slimer_Wrap {
					background-color: <?php echo get_option('fl_bg_color') ?> ; 
					color: <?php echo get_option('fl_color') ?>;
				}
				
				.floating_next_prev_wrap .floating_links a, .floating_next_prev_wrap .floating_links .disabled {
					 background-color: <?php echo get_option('fl_bg_color') ?> ; 
					 color: <?php echo get_option('fl_color') ?>;
					 font-size: <?php echo get_option('fl_icon_size') ?>px;
			   	     border-color: <?php echo get_option('fl_seprator_color') ?>;
				}
							
				.floating_next_prev_wrap .floating_links .disabled {
					 color: #ebebe4 !important;
				}

				.floating_next_prev_wrap .floating_links a:hover, .floating_next_prev_wrap .floating_links .fl_slimer_Wrap:hover {
					 background-color: <?php echo get_option('fl_hover_bg_color') ?> ;
					 color: <?php echo get_option('fl_icon_hover_color') ?>;
				}

				.floating_next_prev_wrap .floating_links .fl_inner_wrap .fl_icon_holder .fl_post_details {
					 background-color: <?php echo get_option('fl_hover_post_bg_color') ?> ;
					 border-color: <?php echo get_option('fl_hover_post_seprator_color') ?> ;
				}
				.floating_next_prev_wrap .floating_links .fl_inner_wrap .fl_icon_holder .fl_post_title{
					color: <?php echo get_option('fl_hover_post_headings_color') ?> ;
					border-color: <?php echo get_option('fl_hover_post_seprator_color') ?> ;
				}
				.floating_next_prev_wrap .floating_links .fl_inner_wrap .fl_icon_holder .fl_post_title,.floating_next_prev_wrap .floating_links .fl_inner_wrap .fl_icon_holder .fl_post_description h6{
					color: <?php echo get_option('fl_hover_post_headings_color') ?> ;
				}
				.floating_next_prev_wrap .floating_links .fl_inner_wrap .fl_icon_holder .fl_post_description p{
					color: <?php echo get_option('fl_hover_post_color') ?> ;
				}

				<?php 

					/*
					 * If shadow is enable show shadow
					*/	
					$fl_shadow = get_option('fl_shadow', false);		
					if( isset($fl_shadow) && $fl_shadow  !='1' ) : 

				?>
					.floating_next_prev_wrap .floating_links {
						box-shadow:none;
					}
									
				<?php endif;


					/*
					 * If shadow is enable show shadow
					*/	
					$fl_post_data = get_option('fl_post_data', false);	

					if( isset($fl_post_data) && $fl_post_data  !='1' && $fl_post_data  =='true' ){

				?>
					.floating_next_prev_wrap .floating_links .fl_inner_wrap .fl_icon_holder .fl_post_details {
						display:block;
					}
				<?php 
				}
					else{ ?> .floating_next_prev_wrap .floating_links .fl_inner_wrap .fl_icon_holder .fl_post_details {
						display:none;
						}
				<?php }
				

				/*
				 * Checking the floating links position
				*/	
				$position = get_option('fl_position', false);	
				
				/*
				 * Checking the postion of floating links and showing them accordingly
				*/	
				switch ($position) {

					/*
					 * If floating links position is left.
					*/	
					case 'left': 
				?>
				
				.floating_next_prev_wrap .floating_links {
					left : 0;
				    transform : translate(0px, -50%);
					bottom : auto;
 				    right : auto;
					top : 50%;
				}

				.floating_next_prev_wrap .floating_links a, .floating_next_prev_wrap .floating_links .disabled {
					float : left;
					clear : both;
					width : 100%;
				}

				.floating_next_prev_wrap .floating_links .fl_inner_wrap .fl_icon_holder .fl_post_details {
				left: 105%; 
				}

				<?php 	break;

					/*
					 * If floating links position is right.
					*/	
					case 'right': 
				?>

				.floating_next_prev_wrap .floating_links {
					left : auto;
					transform : translate(0px, -50%);
					bottom : auto;
					right : 0;
					top : 50%;
				}

				.floating_next_prev_wrap .floating_links a, .floating_next_prev_wrap .floating_links .disabled {
					float : left;
					clear : both;
					width : 100%;
				}

				<?php 	break;

					/*
					 * If floating links position is bottom.
					*/	
					case 'bottom': ?>

				.floating_next_prev_wrap .floating_links {
					left : 50%;
					display: inline-table;
					transform : translate(-50%, 0);
					bottom : 0;
					right : 0;
					top : auto;
				}

				.floating_next_prev_wrap .floating_links a, .floating_next_prev_wrap .floating_links .disabled {
					float : left;
					clear : none;
					width : auto;
				}

				.floating_next_prev_wrap .floating_links a:last-child{
					border-bottom : 1px solid <?php echo get_option('fl_seprator_color') ?>;
				}

				.floating_next_prev_wrap .floating_links .fl_inner_wrap .fl_icon_holder .fl_post_details{
					    top: -55px;
				}
										
				<?php 	break;

					/*
					 * If floating links position is top.
					*/	
					case 'top': ?>

				.floating_next_prev_wrap .floating_links{
					left : 50%;
					display: inline-table;
					transform : translate(-50%, 0);
					bottom : auto;
					right : 0;
					top : 0;
				}

				.floating_next_prev_wrap .floating_links a, .floating_next_prev_wrap .floating_links .disabled {
					float : left;
					clear : none;
					width : auto;
				}

				.floating_next_prev_wrap .floating_links a:last-child {
					border-bottom : 1px solid <?php echo get_option('fl_seprator_color') ?>;
				}

				.floating_next_prev_wrap .floating_links .fl_slimer_Wrap {
					float: none;
    				margin: 0px auto;
				}

			<?php 	break;
					
					default:
					# code...
					break;

			}/* Switch statement ends here. */

			/*
			* If floating links position is top and admin bar is showing take some margin.
			*/			
			if ( is_admin_bar_showing() && $position == 'top' ) : ?>
					.floating_next_prev_wrap .floating_links {
						top : 32px;
					}

			<?php endif; 


			/*
			* Getting Minimizer feature option.
			*/
			$enable_minimizer = get_option('fl_minimizer', false);

				/*
				* If floating minimizer is enable show last border.
				*/			
				if ( !isset($enable_minimizer) && 'true' != $enable_minimizer ) : ?>
						.floating_next_prev_wrap .floating_links a:last-child {
							    border: none;
						}

			<?php endif; ?>	
				  

			</style>
			<?php

		}/* fl_customizer_css method ends here. */	

}/* FLOATING_LINKS_CUSTOMIZER class ends here. */	
$GLOBALS['FLOATING_LINKS_CUSTOMIZER'] = new FLOATING_LINKS_CUSTOMIZER();