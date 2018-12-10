<?php 
/**
*
* Template Name: Trailer Page
*/
?>
<?php get_header(); ?>

<div class = "wrapper columns"> 
<h1><?php the_title(); ?></h1>
 <?php 
	$args = array(
	'post_type' => 'trailer'
	);
	
	$query = new WP_Query($args);
?>
<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
		<div class = "column-item">
			<h1 class = "title"><a href= "<?php the_permalink(); ?>"><?php the_title() ?></a></h1>
			<div class= "trailer"><?php the_content(); ?></div>
			<br/>
			<div class = "trailer-meta">
				<h4>Directed By: <?php the_field('director'); ?></h4>
				<br/>
				<h3>Starring: <?php the_field('starring'); ?></h3>
				<!--convert release date field type -->
				<?php 

				// get raw date
				$date = get_field('release_date', false, false);


				// make date object
				$date = new DateTime($date);

				?>
				<p>Release Date: <?php echo $date->format('j M Y'); ?></p>
			</div><!--.trailer-meta-->
			<br/>
			<?php the_tags(); ?>
			
			

			<div class = "article"><?php the_excerpt(); ?></div>
		</div><!--.column-item-->	
		
		<?php wp_reset_postdata(); ?>
	

<?php endwhile; ?>
<?php endif; ?>	
</div>


<?php get_footer(); ?>