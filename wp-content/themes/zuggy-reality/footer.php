<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ZuGGy_Reality
 */

?>
			
		</div><!-- #container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class = "container">
			<nav class = "footer-nav">
				<?php 
					$args = array(
						'theme_location' => 'footer'
					);
				?>
				<?php wp_nav_menu($args); ?>
			</nav><!--.main-nav -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->


<?php wp_footer(); ?>



</body>
</html>
