<?php
/*
Template Name: News 
*/
?>

<?php get_header(); ?>
<div id="news-page">
	<?php get_template_part( 'banner' ); ?>

		<div class="row remove-bottom">
			<div class="sixteen columns">
				<?php get_template_part( 'navigation' ); ?>
			</div>
			<div id="contentwrap-dept" class="eleven columns">
				
				<div id="contentpad-dept" class="news clearfix inset">
					<?php get_template_part( 'loop' , 'news' ); ?>
				</div>
		
			</div>
			
		<?php get_sidebar(); ?>
			
		</div>
</div> <!-- end #post-id -->	

<?php get_footer(); ?>	