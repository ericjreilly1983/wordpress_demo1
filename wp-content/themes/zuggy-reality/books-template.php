<?php

/**
 *
 * Template Name: Books
 *
 */
 ?>
 <?php get_header(); ?>
 <div class = "flex-container">
 <div class = "content-area">
 <div class = "wrapper columns"> 
 <?php 
	$args = array(
	'post_type' => 'books'
	);
	
	$query = new WP_Query($args);
?>
<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
		<div class = "column-item">
			<h1 class = "title"><a href= "<?php the_permalink(); ?>"><?php the_title() ?></a></h1>
			<div class = "post-thumbnail"><?php the_post_thumbnail('custom-size') ?></div>
			<br/>
			<div class = "book-meta">
				<h3>Author: <?php the_field('author'); ?></h3>
				<br/>
				<em>Written by - <?php the_author(); ?></em>
			</div><!--.book-meta-->
			<br/>
			<?php the_tags(); ?>

			<div class = "article"><?php the_excerpt(); ?></div>

		</div><!--.column-item-->
<?php endwhile; ?>
<?php endif; ?>	
<?php wp_reset_postdata(); ?>
</div><!--.wrapper .columns -->
</div>
<div class = "home-sidebar" id = "home-sidebar-1"><?php dynamic_sidebar('books-sidebar'); ?></div>
</div>
<?php get_footer(); ?>
