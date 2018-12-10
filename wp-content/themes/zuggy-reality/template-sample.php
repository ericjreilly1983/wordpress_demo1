<?php 
/*
 *
 * Template Name: Sample 1
 *
 */
 ?>
	<?php get_header(); ?>
	<?php the_post_thumbnail(); ?><!--template tag to show featured image -->
<h2><?php the_title("This is the title: ") ?></h2><!-- parameters of the_title show beginning and end of title -->
	<?php get_footer(); ?>
	<?php the_title("and again: "); ?>