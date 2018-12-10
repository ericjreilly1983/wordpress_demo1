<?php get_header(); ?>

<div class = "wrapper columns"> 

 <?php 
	$args = array(
	'post_type' => 'authors'
	);
	
	$query = new WP_Query($args);
?>
<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
		<div class = "column-item">
			<h1 class = "title"><a href= "<?php the_permalink(); ?>"><?php the_title() ?></a></h1>
			
			<br/>
			<div>
				<?php the_post_thumbnail('custom-size'); ?>
				<br/>
				<h3><?php the_field('bio'); ?></h3>
				
				
			
			</div>
			<br/>
			<?php the_tags(); ?>
			
			

			<div class = "article"><?php the_excerpt(); ?></div>
		</div><!--.column-item-->	
		
	
	

<?php endwhile; ?>
<?php endif; ?>	
</div>

<?php get_footer(); ?>