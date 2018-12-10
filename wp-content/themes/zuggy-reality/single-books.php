<?php 
/*This is the single custom post type page for the 'books' slug
**
*/
?>
<?php get_header(); ?>
<br>
<div class = "flex-container">
<div id = "primary" class = "content-area">

<!--start The Loop in order to display the_content() -->
<?php
while ( have_posts() ) :
the_post();
?>
	
<?php endwhile ?>
<?php the_post_thumbnail('single-page'); ?>
<?php the_field('synopsis') ?>

<?php the_content(); ?>




</div><!--primary-->
<div class = "home-sidebar" id = "home-sidebar-1">

<?php dynamic_sidebar('books-sidebar'); ?>
</div><!--home-sidebar-->
</div><!--flex-container-->
<?php get_footer(); ?>