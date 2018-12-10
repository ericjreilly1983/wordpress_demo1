<?php get_header(); ?>
<div class = "flex-container">
<div id = "primary" class = "content-area">
	<main id = "main" class = "site-main" role= "main">
		<div class = "row-1 trailers"> 
		 <?php 
			$args = array(
			'post_type' => 'trailer',
			'posts_per_page' => 1
			);
			
			$query = new WP_Query($args);
		?>
		<h2>Latest Trailer</h2>
		<hr>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class = "single-post">
					<h1 class = "title"><a href= "<?php the_permalink(); ?>"><?php the_title() ?></a></h1>
					<div class= "trailer"><?php the_content(); ?></div>
					<br/>
				</div><!--.single-post-->	
				


		<?php endwhile; ?>
		<?php endif; ?>	
		</div><!--.row-1 .trailers-->
		<?php wp_reset_postdata(); ?>

		<div class = "row-2 blogs"> 
		<?php $args = array(
			'posts_per_page' => 2
		);

		$the_query = new WP_Query($args); 
		?>
		
		<h2>Latest Blog Posts</h2>
		<hr>
		<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query ->the_post(); ?>
				<div class = "single-post column-item">
					<h1 class = "title"><a href= "<?php the_permalink(); ?>"><?php the_title() ?></a></h1>
					<div class = "post-thumbnail"><div class = "image-wrap"><?php the_post_thumbnail('custom-size-2') ?><div class = "middle"></div></div></div>
					<br/>
					<em>Posted on - <?php echo get_the_date(); ?></em>
					<br/>
					<em>Written by - <?php the_author(); ?></em>
					<br/>
					

					<div class = "article"><?php the_excerpt(); ?></div>
				</div><!-- .single-post .column-item-->

		<?php endwhile; ?>
		<?php endif; ?>	


		</div><!--.row-2 blogs-->
		<?php wp_reset_postdata(); ?>

		<div class = "row-3 books"> 
		<?php $args = array(
			'post_type' => 'books',
			'posts_per_page' => 1
		);

		$the_query = new WP_Query($args); 
		?>

		<h2>Latest Book</h2>
		<hr>
		<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query ->the_post(); ?>
				<div class = "single-post">
					<h1 class = "title"><a href= "<?php the_permalink(); ?>"><?php the_title() ?></a></h1>
					<div class = "post-thumbnail"><div class = "image-wrap"><?php the_post_thumbnail('single-page') ?></div></div>
					<br/>
					<div class = "book-meta">
						<h3>Author: <?php the_field('author'); ?></h3>
						<br/>
						<em>Written by - <?php the_author(); ?></em>
					</div><!--.book-meta-->
					<?php the_tags(); ?>

					<div class = "article"><?php the_excerpt(); ?></div>

					
				</div>

		<?php endwhile; ?>
		<?php endif; ?>	


		</div><!--.row-3 .books -->
		<?php wp_reset_postdata(); ?>
	</main><!-- .main -->
</div><!-- .primary -->
<div class = "home-sidebar" id = "home-sidebar-1">
<?php dynamic_sidebar("Home"); ?>
</div>
</div><!--.flex-container -->
<?php get_footer(); ?>
