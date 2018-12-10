<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ZuGGy_Reality
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

	

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'zuggy-reality' ); ?></a>

	<header id="masthead" class="site-header">
		<div class = "container">
			<div class = "custom-header">
				<?php
				the_custom_logo();
				?>
			</div><!--.custom-header-->
	
				<div class = "after-logo" style = "position: absolute; top: 30px;" >
					<?php 
					if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
					<h1 class = "main-title"><p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p></h1>		
				
					
						<?php
					endif;
					$zuggy_reality_description = get_bloginfo( 'description', 'display' );
					if ( $zuggy_reality_description || is_customize_preview() ) :
						?>
						<h3 class = "main-description"><p class="site-description"><?php echo $zuggy_reality_description; /* WPCS: xss ok. */ ?></p></h3>
					<?php endif; ?>
			    </div><!--.after-logo -->
          	
			<!-- NAVIGATION MENU BENEATH LOGO-->
			<nav class = "main-nav">
				<?php 
					$args = array(
						'theme_location' => 'primary'
					);
				?>
			
				<?php wp_nav_menu($args); ?>
				
			<!-- END OF NAVIGATION MENU -->
			</nav><!--.main-nav -->
			
		 
		</div><!-- .container -->
		
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div class = "container">
			
