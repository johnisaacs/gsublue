<?php
/*
Template Name: Page with 3 Bottom Widgets 
*/
?>

<?php get_header(); ?>

<div id="home">
	<?php get_template_part( 'banner' ); ?>
	
	<div class="row remove-bottom">
		<div class="sixteen columns">
				<?php get_template_part( 'navigation' ); ?>
			</div>
		<div id="contentwrap-dept" class="eleven columns">
				
			<div id="contentpad-dept" class="clearfix inset">
			
			<?php get_template_part( 'loop' ); ?>
				
			</div>
		
		</div>				
		<?php get_sidebar(); ?>

	
	</div>
	<div class="row remove-bottom padtop_25"></div>
	<section id="fp_featurewrap" class="row">
		<div class="one-third column fp_feature">
			<div class="fp_featurepad">				
				<?php dynamic_sidebar( 'Home Bottom Left' ); ?>
			</div>
		</div> <!-- /feature -->
		<div class="one-third column fp_feature">
			<div class="fp_featurepad">
			<?php dynamic_sidebar( 'Home Bottom Middle' ); ?>
			</div>
		</div> <!-- /feature -->
		<div class="one-third column fp_feature">
			<div class="fp_featurepad">					
			<?php dynamic_sidebar( 'Home Bottom Right' ); ?>
			</div>	
		</div> <!-- /feature -->
	</section>	
	
</div> <!-- end #post-id -->

<?php get_footer(); ?>			
