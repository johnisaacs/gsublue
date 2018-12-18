<?php
/*
 404 Page Not Found Template 
*/
?>


<?php get_header(); ?>
<div id="post-<?php the_ID(); ?>">
	<?php get_template_part( 'banner' ); ?>

		<div class="row remove-bottom">
			<div class="sixteen columns">
				<?php get_template_part( 'navigation' ); ?>
			</div>
			<div id="contentwrap-dept" class="eleven columns">
				
				<div id="contentpad-dept" class="clearfix inset">
				
					<h1>Page Not Found</h1>
					<p>Sorry, but we're not able to find the page you're looking for - try using your back button or visit the <a href="<?php echo home_url()?>">home page</a>.</p>		
						
					
				</div>
			
			</div>
		
		<?php get_sidebar(); ?>

			
		</div>
</div> <!-- end #post-id -->	

<?php get_footer(); ?>