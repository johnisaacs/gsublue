<div style="clear:both;"></div>
<section id="bottom_bar" class="mobile-hide">
<?php dynamic_sidebar( 'Footer' ); ?>
</section>

	</div><!-- container -->
<!-- End Document
================================================== -->

<?php wp_footer(); ?>


<script type="text/javascript">
jQuery(document).ready(function($){

	/* prepend menu icon */
	$('#mainmenu').prepend('<div id="menu-icon">Menu</div>');
	
	/* toggle nav */
	$("#menu-icon").on("click", function(){
		$("#main-menu").slideToggle();
		$(this).toggleClass("active");
	});

});
</script>

<?php include('../web_templates/global/includes/wp/footer.php');?>


