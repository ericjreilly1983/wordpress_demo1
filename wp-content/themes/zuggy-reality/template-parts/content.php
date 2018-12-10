<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ZuGGy_Reality
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<div class = "title-page"><h1 class="entry-title">', '</h1></div>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<div class = "title-page">
				<?php
				zuggy_reality_posted_on();
				zuggy_reality_posted_by();
				?>
				</div>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class = "title-page"><?php the_post_thumbnail('single-page'); ?></div>

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	<div class = "trailer-list">
	<?php the_field('starring') ?>
	</div>
	
	<!--show category and tags -->
	<div class = "category">
		<h3>Categories: <?php the_category(); ?></h3>
		<p><?php the_tags(); ?></p>
	</div>
	<!--end of .category div -->
	<footer class="entry-footer">
		
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

