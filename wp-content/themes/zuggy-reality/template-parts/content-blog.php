
<!--This template is displayed on the page with slug 'blog' -->



<div class = "wrapper columns"> 
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class = "column-item">
			<h1 class = "title"><a href= "<?php the_permalink(); ?>"><?php the_title() ?></a></h1>
			<div class = "post-thumbnail"><div class = "image-wrap"><?php the_post_thumbnail('custom-size-2') ?></div></div>
			<br/>
			<em>Posted on - <?php echo get_the_date(); ?></em>
			<br/>
			<em>Written by - <?php the_author(); ?></em>
			<br/>
			
			

			<div class = "article"><?php the_excerpt(); ?></div>
		</div>

<?php endwhile; ?>
<?php endif; ?>	
</div>
