<div class="container">

	<div class="logo">
		<a class="brand" href="<?php bloginfo('siteurl') ?>" title="<?php echo $logotitle ?>">
			<?php if ( $logo ) : ?>
				<img src="<?php echo $logo ?>" alt="<?php echo $logotitle ?>">
			<?php else : ?>
				<h1><?php bloginfo('sitename') ?></h1>
			<?php endif; ?>
		</a>
	</div>

	<div class="menus">
		<?php
		$args = array (
			'theme_location'	=>		'main_left_nav',
			'menu_class'		=>		'nav',
			'container_class'	=>		'menu-left-primary-container',
			'walker'			=>		new Bootstrap_Walker_Nav_Menu(),
			'fallback_cb'		=>		'bsb_page_menu'
		);
		
		wp_nav_menu($args);
		
		$args = array (
			'theme_location'	=>		'main_right_nav',
			'menu_class'		=>		'nav',
			'container_class'	=>		'menu-right-primary-container',
			'walker'			=>		new Bootstrap_Walker_Nav_Menu(),
			'fallback_cb'		=>		'bsb_page_menu'
		);

		wp_nav_menu($args); ?>
	</div><!-- .menus -->

</div><!-- .container -->