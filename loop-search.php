<?php get_template_part( 'breadcrumbs' ); ?>
<!-- begin loop -->	
	<h1 class="title">Search Results for &quot;<em><?php the_search_query(); ?></em>&quot;</h1>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
	<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>	
	<?php the_excerpt(); ?>
		<p><a class="fp_readmore" href="<?php echo get_permalink(); ?>">Read more</a></p>
		<div class="clearfix"></div>
		<hr class="spacer">
	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>	
	<div class="prevnextpage"><p><?php posts_nav_link(' ', '<span class="next-post">Newer posts --></span>', '<span class="prev-post"><-- Older posts</span>'); ?></p></div>
<!-- end loop -->	

