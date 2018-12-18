<div id="fp-banner-dept" class="sixteen columns">		
	<a href="<?php echo home_url()?>"><img id="deptheader" src="<?php header_image(); ?>" class="img-responsive" alt="<?php echo get_bloginfo('name')?>" /></a>
	<div id="fp_titleblock">		
		<?php if (is_front_page() ) {
		?> 
			<div id="row2"><h1><a href="<?php echo home_url()?>"><?php echo get_bloginfo('name')?></a></h1></div>
			<div id="row3" class="clearfix"><h2><?php echo get_bloginfo('description')?></h2></div>
		<?php } 
		else {
		?>
		<div id="row2"><a href="<?php echo home_url()?>"><?php echo get_bloginfo('name')?></a></div>
		<div id="row3" class="clearfix"><?php echo get_bloginfo('description')?></div>
		<?php } 
		?>
	</div>		
</div>