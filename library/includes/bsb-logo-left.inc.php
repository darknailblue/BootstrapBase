<div class="container">

	<div class="logo pull-left">
		<a class="brand" href="<?php bloginfo('siteurl') ?>" title="<?php echo $logotitle ?>">
			<?php if ( $logo ) : ?>
				<img src="<?php echo $logo ?>" alt="<?php echo $logotitle ?>">
			<?php else : ?>
				<h1><?php bloginfo('sitename') ?></h1>
			<?php endif; ?>
		</a>
	</div>
	
	<?php
		wp_nav_menu(array (
			'theme_location'	=>		'main_nav',
			'menu_class'		=>		'nav',
			'container_class'	=>		'menu-primary-container',
			'fallback_cb'		=>		'ter_navbar_fallback',
			'walker'			=>		new TerWalkerNavMenu()
		));
	?>
</div><!-- .container -->


<?php
