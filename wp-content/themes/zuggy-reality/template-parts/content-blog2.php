<?php 
	$arg = array(
	'category_name' => 'discourse'
	);
	
	$query = new WP_Query($arg);
?>
<?php if($query->have_posts()) while ( $query->have_posts() ) :
				$query->the_post();?>
<h1><a href= "<?php the_permalink(); ?>"><?php the_title() ?></a></h1>
<?php the_post_thumbnail('blog-image'); ?>
<br/>
<em>Posted on - <?php echo get_the_date(); ?></em>
<br/>
<em>Written by - <?php the_author(); ?></em>
<br/>
<?php the_tags(); ?>

<?php the_excerpt(); ?>
<?php endwhile ?>
