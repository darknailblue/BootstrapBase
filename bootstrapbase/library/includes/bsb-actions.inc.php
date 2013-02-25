<?php
/** 
 * ALL FRONT-END ACTION DECLARATIONS
 * =================================================================================
 * bsb_enqueue_scripts			- handles scripts the nice way
 * bsb_header					- header hook
 * bsb_head_scripts				- all <head> script logic
 * bsb_head_overrides			- will add any inline *shutters* CSS if needed
 * bsb_footer_above				- social icons
 * bsb_footer					- entire footer logic
 * bsb_more_footer				- more footer logic
 * bsb_blog_archive				- main blog template
 * bsb_title					- action hook for the title
 * bsb_display_social_icons		- display any social icons
 *
 *
 * @since 1.0
 */
 
if( !is_admin() ) {

	add_action('wp_enqueue_scripts', 'bsb_enqueue_scripts');
	add_action('bsb_header', 'bsb_header', 20);
	add_action('bsb_head_scripts', 'bsb_head_scripts');
	add_action('bsb_head_overrides', 'bsb_head_overrides');
	add_action('bsb_footer', 'bsb_footer');
	add_action('bsb_more_footer', 'bsb_more_footer');
	add_action('bsb_blog_archive', 'bsb_blog_archive');
	add_action('bsb_title', 'bsb_title');
	add_action('bsb_display_social_icons', 'bsb_display_social_icons');
	
}



/** 
 * ALL BACK-END ACTION DECLARATIONS
 * ================================================================================= 
 * bsb_admin_head				- admin <head> script logic
 * bsb_install_plugins			- Install any needed plugins
 * bsb_theme_setup				- Theme activation stuff
 *
 *
 * @since 1.0
 */

else {

	add_action('admin_head', 'bsb_admin_head');
	add_action('tgmpa_register', 'bsb_install_plugins');
	add_action('after_setup_theme', 'bsb_theme_setup');

}



/**
 * BSB_HEAD_OVERRIDES
 * ===================================================
 * Adds any CSS if needed... Gross
 *
 *
 * @since			1.0
 * @author			chriscarvache
 */

if ( !function_exists('bsb_head_overrides') ) {
	function bsb_head_overrides() {
		global $post;
		$blog_archive = is_home();
		
		if ( $blog_archive ) {
			$id = get_option('page_for_posts', true);
		}
		
		else
			$id = $post->ID;
			
		$bodybackground = bsb_process_background('bodybackground', $id, 'pm');
		$layer1background = bsb_process_background('layer1background', $id, 'pm');
		$layer2background = bsb_process_background('layer2background', $id, 'pm');
		
		
		if ( $bodybackground || $layer1background || $layer2background ) {
		
			$output = '<style type="text/css">';
			
			if ( $bodybackground ) {
				$output.= 'body {';
				
				$output.= $bodybackground;
				
				$output.= '}';
			}
			
			if ( $layer1background ) {
				$output.= '#layer1 {';
				
				$output.= $layer1background;
				
				$output.= '}';
			}
			
			if ( $layer2background ) {
				$output.= '#layer2 {';
				
				$output.= $layer2background;
				
				$output.= '}';
			}
				
			$output.= '</style>';
			
			
			echo $output;
		
		}
	}
}



/**
 * BSB_BLOG_ARCHIVE
 * ===================================================
 * Blog archive layout
 *
 *
 * @since			1.0
 * @author			chriscarvache
 */

if ( !function_exists('bsb_blog_archive') ) {
	function bsb_blog_archive() {
		/**
		 * PRE-SECTION LOGIC
		 * =========================================
		 */
		
		$blogpage_id = get_option('page_for_posts', true);
		$blogpage_post = get_post( $blogpage_id );
		$blogpage_title = $blogpage_post->post_title;
		$blogpage_content = $blogpage_post->post_content;
		
		$blogsidebarposition = ot_get_option('blogsidebarposition');
		$blogsidebarcolumnwidth = ot_get_option('blogsidebarcolumnwidth');
		
		$archivethumbnailposition = ot_get_option('archivethumbnailposition');
	
		switch ( $archivethumbnailposition ) {

			case 'left':
				$archivethumbnailposition = 'left';
				break;
			
			case 'right':
				$archivethumbnailposition = 'right';
				break;

		}
		
		$contentcolumnwidth = 12 - $blogsidebarcolumnwidth;
		
		$sidebar_output.= '<div class="span' . $blogsidebarcolumnwidth . '">';

		ob_start();		
		?>
		<ul id="mainsidebar" class="widgetarea">
			<?php if ( !dynamic_sidebar('Main Sidebar') ) : ?>
				<li>
					<div class="alert alert-block">
						<p>
							There are no widgets in this region.&nbsp; <a href="<?php echo admin_url( 'widgets.php' ) ?>" target="_blank">Add some here</a>.
						</p>
					</div>
				</li>

			<?php endif ?>
		</ul><!-- #main.widgetarea -->
		<?php
		
		$sidebar_output.= ob_get_contents();
		$sidebar_output.= '</div>';
		
		ob_end_clean();
		?>
		
		<div class="row">
			<?php if ( $blogsidebarposition == 'left' ) echo $sidebar_output; ?>

			<div class="span<?php echo $contentcolumnwidth ?>">
				<div class="content-wrap">
					<?php
					/**
					 * Output the page title if there is one
					 * TODO: Make this a configurable option
					 */
					
					if ( $blogpage_id !== '0' ) {
					
						if ( $blogpage_title )
							echo '<h1 class="entry-title">' . $blogpage_title . '</h1>';
							
						if ( $blogpage_content )
							echo $blogpage_content;

					}
						
					// Start the loop
					if ( have_posts() ) :
					
						while ( have_posts() ) :
						
							the_post();
							
							?>

							<article class="entry-content">

								<div class="entry-header">
									<?php do_action('bsb_title') ?>
									<?php get_template_part ('loop', 'meta') ?>
								</div>
								
								<a href="<?php the_permalink() ?>" title="<?php the_title() ?>" class="pull-<?php echo $archivethumbnailposition ?> archive-post-thumbnail">
									<?php the_post_thumbnail('thumbnail'); ?>
								</a>


								<?php the_excerpt() ?>
								
								<div class="read-more">
									<a href="<?php the_permalink() ?>" title="<?php the_title() ?>">Read Full Article &raquo;</a>
								</div>
								
								<div class="clear-left"></div>

							</article>

						<?php endwhile; ?>
							
						<ul class="pager">
							<li class="previous">
								<?php previous_posts_link('&laquo; Recent Entries') ?>
							</li>
							
							<li class="next">
								<?php next_posts_link('Older Entries &raquo;','') ?>
							</li>
							
						</ul>	
						
					<?php endif; ?>
				</div><!-- .content-wrap -->
			</div>

			<?php if ( $blogsidebarposition == 'right' ) echo $sidebar_output; ?>
		</div>
	
		<?php
	
	}
}



/**
 * BSB_MORE_FOOTER
 * ===================================================
 * More footer layout control
 *
 *
 * @since			1.0
 * @author			chriscarvache
 */

if ( !function_exists('bsb_more_footer') ) {
	function bsb_more_footer(){
		/**
		 * PRE-SECTION LOGIC
		 * ===========================================
		 * All we need to do is output the correct
		 * layout.  Pretty simple eh?  That's right!
		 */
		
		$morefooterlayout = ot_get_option('morefooterlayout');
		
		switch ( $morefooterlayout ) {
			case 'full';
				include ('bsb-more-footer-full.inc.php');
				break;

			case '5050';
				include ('bsb-more-footer-5050.inc.php');
				break;

			case '25252525';
				include ('bsb-more-footer-25252525.inc.php');
				break;

			case '255025';
				include ('bsb-more-footer-255025.inc.php');
				break;

			case '252550';
				include ('bsb-more-footer-252550.inc.php');
				break;

			case '502525';
				include ('bsb-more-footer-502525.inc.php');
				break;

			case '333333';
				include ('bsb-more-footer-333333.inc.php');
				break;

			case '6633';
				include ('bsb-more-footer-6633.inc.php');
				break;

			case '3366';
				include ('bsb-more-footer-3366.inc.php');
				break;
		}
		
	
	}
}



/**
 * BSB_ENQUEUE_SCRIPTS
 * ===================================================
 * Handles scripts and styles the preferred way.
 *
 *
 * @since 1.0
 */

if ( !function_exists('bsb_enqueue_scripts') ) {
	function bsb_enqueue_scripts() {
		/**
		 * PRE-SECTION LOGIC
		 */
		
		// We're getting this first because it will determine how we render
		// our initial Bootstrap.css
		$fontawesome = ot_get_option ('font_awesome');
		$fontawesome = $fontawesome[0];

		/**
		 * BOOTSTRAP CSS
		 */

		$bootstrap_css = get_stylesheet_directory() . '/bootstrap/css/bootstrap.min.css';
		
		if ( is_child_theme() && file_exists($bootstrap_css) ) {
		
			$bootstrap_custom_url = BSB_PATH . '/bootstrap/css/bootstrap.min.css';

			wp_register_style('bootstrap-custom', $bootstrap_custom_url);
			wp_enqueue_style('bootstrap-custom');
			
		}
		
		else {
		
			if ( $fontawesome )
				$bootstrap_min_url = 'http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.0/css/bootstrap.no-icons.min.css';
			
			else
				$bootstrap_min_url = 'http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.0/css/bootstrap-combined.min.css';
			
			wp_register_style('bootstrap-min', $bootstrap_min_url, NULL, BSB_VERSION);
			wp_enqueue_style('bootstrap-min');

		}
		
		
		/**
		 * BSB CORE
		 */
		
		$bsb_core_url = BSB_ROOT_PATH . '/library/css/core.css';
		
		if ( is_child_theme() && file_exists($bootstrap_css) )
			$bsb_core_deps = array(
				'bootstrap-custom'
			);
		
		else
			$bsb_core_deps = array(
				'bootstrap-min'
			);
		
		wp_register_style('bsb-core', $bsb_core_url, $bsb_core_deps, BSB_VERSION);
		wp_enqueue_style('bsb-core');
		
		
		
		/**
		 * STYLESHEET
		 */
		 
		$bsb_stylesheet_url = get_bloginfo('stylesheet_url');
		$bsb_stylesheet_deps = array (
			'bsb-core'
		);
		
		wp_register_style('bsb-stylesheet', $bsb_stylesheet_url, $bsb_stylesheet_deps, BSB_VERSION);
		wp_enqueue_style('bsb-stylesheet');
		

		
		/**
		 * DYNAMIC
		 */
		
		$bsb_dynamic_url = BSB_ROOT_PATH . '/library/css/dynamic.php';
		$bsb_dynamic_deps = array (
			'bsb-stylesheet'
		);
		
		wp_register_style('bsb-dynamic', $bsb_dynamic_url, $bsb_dynamic_deps, BSB_VERSION);
		wp_enqueue_style('bsb-dynamic');



		/**
		 * FONT AWESOME
		 */
		
		if ( $fontawesome ) {

			$fontawesome_url = 'http://netdna.bootstrapcdn.com/font-awesome/2.0/css/font-awesome.css';
			$fontawesome_deps = array (
				'bsb-dynamic'
			);
			
			wp_register_style('bsb-font-awesome', $fontawesome_url, $fontawesome_deps, BSB_VERSION);
			wp_enqueue_style('bsb-font-awesome');

		}



		/**
		 * ANIMATE
		 */

		$animate = ot_get_option('animate');
		$animate = $animate[0];

		if ( $animate ) {
		
			$animate_url = 'http://cdn.jsdelivr.net/animatecss/0.1/animate.min.css';
			$animate_deps = array (
				'bsb-dynamic'
			);
			
			wp_register_style('bsb-animate', $animate_url, $animate_deps, BSB_VERSION);
			wp_enqueue_style('bsb-animate');

		}



		/**
		 * PRICING TABLES
		 */

		$pricing = ot_get_option('pricing');
		$pricing = $pricing[0];
		
		if ( $pricing ) {
		
			$pricing_url = BSB_ROOT_PATH . '/library/css/pricing.css';
			$pricing_deps = array(
				'bsb-dynamic'
			);
			
			wp_register_style('bsb-pricing', $pricing_url, $pricing_deps, BSB_VERSION);
			wp_enqueue_style('bsb-pricing');
		
		}



		/**
		 * ADD CUSTOM FONTS
		 * ==========================================
		 * This needs some help.  Right now this will
		 * load ALL custom fonts... Ideally the custom
		 * font process should only load the fonts when
		 * in use
		 */
		
		global $custom_fonts;
		$fontkeys = array_keys($custom_fonts);
		
		if ( $fontkeys ) {

			foreach ( $fontkeys as $font ) {

				$font_base = '/library/fonts/' . $font . '/stylesheet.css';
				$font_css_file = get_template_directory() . $font_base;
				$font_css_url = BSB_ROOT_PATH . $font_base;
				$font_deps = array(
					'bsb-dynamic'
				);
				
				if ( file_exists($font_css_file) ) {
					
					$font_id = 'bsb-' . $font;
					wp_register_style($font_id, $font_css_url, $font_deps, BSB_VERSION);
					wp_enqueue_style($font_id);
					
				}

			}
		}
		
		
		
		/**
		 * JQUERY DONE THE RIGHT WAY
		 * ======================================
		 * WordPress is weird with this so we'll
		 * just do it better
		 *
		 *
		 * @link - http://code.jquery.com/jquery-latest.min.js
		 */
		
		if ( is_page('portfolio') )
			$jquery_url = 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js';

		else
			$jquery_url = 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js';


		wp_deregister_script('jquery');
		wp_register_script('jquery', $jquery_url, NULL, BSB_VERSION, true );
		wp_enqueue_script('jquery');
		
		
		
		/**
		 * FIRE UP MODERNIZR
		 */
		
		$modernizr_url = 'http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js';
		$modernizr_deps = array (
			'jquery'
		);
		wp_register_script('bsb-modernizr', $modernizr_url, $modernizr_deps, BSB_VERSION, true);
		wp_enqueue_script('bsb-modernizr');


		
		/**
		 * BOOTSTRAP
		 */
		 
		$bootstrap_url = 'http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.0/js/bootstrap.min.js';
		$bootstrap_deps = array (
			'jquery'
		);
		 
		wp_register_script('bootstrap', $bootstrap_url, $bootstrap_deps, BSB_VERSION);
		wp_enqueue_script('bootstrap');
		 
		 
		 
		/**
		 * DYNAMIC BSB JAVASCRIPT
		 */
		 
		$bsb_dynamic_url = BSB_ROOT_PATH . '/library/js/vendor/bootstrapbase.js.php';
		$bsb_dynamic_deps = array(
			'bootstrap'
		);
		
		wp_register_script('bsb-dynamic', $bsb_dynamic_url, $bsb_dynamic_deps, BSB_VERSION);
		wp_enqueue_script('bsb-dynamic');

	}

}
 
 
/**
 * BSB_DISPLAY_SOCIAL_ICONS
 * ===================================================
 * Sets up the title for our pages.  We'll do this
 * using a hook so we ultimately have more control
 * over the logic and will keep the template files
 * cleaner.
 *
 *
 * @since 1.0
 */

if ( !function_exists('bsb_display_social_icons') ) {
	function bsb_display_social_icons() {
		echo do_shortcode('[socialicons]');
	}
}

/**
 * BSB_TITLE
 * ===================================================
 * Sets up the title for our pages.  We'll do this
 * using a hook so we ultimately have more control
 * over the logic and will keep the template files
 * cleaner.
 *
 *
 * @since 1.0
 */

if ( !function_exists('bsb_title') ) {
	function bsb_title() {

		global $post;
		$output; $tag; $class;
		$title = get_the_title();
		$permalink = get_permalink();
		$subheader = get_post_meta($post->ID, 'subheader', true);
		
		if ( is_singular() ) {
			$tag = 'h1';
			$class = 'entry-title';
		}
			
		else {
			$tag = 'h2';
			$class = 'archive-item-title';
		}

		// Build the output
		
		$output.= '<' . $tag . ' class="' . $class . '">';

		if ( !is_singular() ) 
			$output.= '<a href="' . $permalink . '" title="' . $title . '">';

		$output.= $title;

		if ( $subheader )
			$output.= '<span class="entry-subheader">' . $subheader . '</span>';

		if ( !is_singular() )
			$output.= '</a>';

		$output.= '</' . $tag . '>';

		echo $output;

	}
}



/**
 * BSB_THEME_SETUP
 * ============================================
 * Do the initial theme setup
 * TODO: Write this damn function
 *
 *
 * @since 1.0
 */

if ( !function_exists('bsb_theme_setup') ) {
	function bsb_theme_setup() {
		/**
		 * Let's switch the reading settings over
		 * and create a homepage page
		 */

	}
}



/**
 * BSB_ADMIN_HEAD
 * ============================================
 * Process anything that should be in the admin
 * section of the site.  Not too much here ATM
 *
 *
 * @since 1.0
 */
 
if ( !function_exists('bsb_admin_head') ) {
	function bsb_admin_head() {
		echo '<link rel="stylesheet" type="text/css" href="' . BSB_ROOT_PATH . '/library/css/admin.css">';
	}
}



/**
 * BSB_HEAD_SCRIPTS
 * ================================
 * Handles how the theme's scripts are
 * output in the head part of the page
 *
 *
 * @since 1.0
 */

if ( !function_exists('bsb_head_scripts') ) {
	function bsb_head_scripts() {

		/**
		 * PRE-SECTION LOGIC
		 */

		$favicon = ot_get_option ('favicon');
		$favicon57 = ot_get_option ('favicon57');
		$favicon72 = ot_get_option ('favicon72');
		$favicon114 = ot_get_option ('favicon114');
		$favicon144 = ot_get_option ('favicon144');

		$latitude = ot_get_option ('latitude');
		$longitude = ot_get_option ('longitude');
		
		$googleplus = ot_get_option ('googleplus');

		?>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta http-equiv="cleartype" content="on">

		<title><?php wp_title(); ?></title>

		<?php if ($latitude && $longitude) : ?>

			<meta name="geo.placename" content="United States">
			<meta name="geo.position" content="<?php echo $latitude ?>;<?php echo $longitude ?>">
			<meta name="geo.region" content="usa">
			<meta name="ICBM" content="<?php echo $latitude ?>,<?php echo $longitude ?>">

		<?php endif; ?>
		
		<?php if ($favicon) : ?>

			<link rel="shortcut icon" type="image/x-icon" href="<?php echo $favicon ?>" />

		<?php endif; ?>
		
		<?php if ($googleplus) : ?>

			<link href="https://plus.google.com/<?php echo $googleplus ?>" rel="publisher" />

		<?php endif; ?>
		
		<?php if ($favicon57) : ?>

			<link rel="shortcut icon" rel="apple-touch-icon-precomposed" type="image/x-icon" href="<?php echo $favicon57 ?>" />

		<?php endif; ?>
		
		

		<?php if ($favicon72) : ?>

			<link rel="shortcut icon" rel="apple-touch-icon-precomposed" sizes="72x72" type="image/x-icon" href="<?php echo $favicon72 ?>" />

		<?php endif; ?>
		
		

		<?php if ($favicon114) : ?>
		
			<link rel="shortcut icon" rel="apple-touch-icon-precomposed" sizes="114x114" type="image/x-icon" href="<?php echo $favicon114 ?>" />

		<?php endif; ?>
		
		

		<?php if ($favicon144) : ?>

			<link rel="shortcut icon" rel="apple-touch-icon-precomposed" sizes="144x144" type="image/x-icon" href="<?php echo $favicon144 ?>" />

		<?php endif; ?>
		
		
		
		<?php

	}
}



/**
 * BSB_FOOTER
 * ================================
 * Handles what happens in the footer
 *
 *
 * @since 1.0
 */

if ( !function_exists('bsb_footer') ) {
	function bsb_footer() {
		/**
		 * PRE-SECTION LOGIC
		 * ========================================
		 *
		 *
		 * @since 1.0
		 */

		$footertext = ot_get_option('footertext');

		do_action('bsb_footer_above');

		?>
		<footer id="footer">

			<div id="morefooter">

				<?php do_action('bsb_more_footer') ?>

			</div><!-- #morefooter -->

			<div id="endfooter">
				<div class="container">
					<div class="row">

						<div class="span6">
							<ul id="footerleftsidebar" class="widgetarea">
								<?php if ( !dynamic_sidebar('Footer Left') ) : ?>

									<li>
										<div class="alert alert-block">
											<p>
												There are no widgets in this region.&nbsp; <a href="<?php echo admin_url( 'widgets.php' ) ?>" target="_blank">Add some here</a>.
											</p>
										</div>
									</li>

								<?php endif ?>
							</ul><!-- #footerleftsidebar.widgetarea -->
						</div><!-- .span6 -->

						<div class="span6">
							<ul id="footerrightsidebar" class="widgetarea">
								<?php if ( !dynamic_sidebar('Footer Right') ) : ?>

									<li>
										<div class="alert alert-block">
											<p>
												There are no widgets in this region.&nbsp; <a href="<?php echo admin_url( 'widgets.php' ) ?>" target="_blank">Add some here</a>.
											</p>
										</div>
									</li>

								<?php endif ?>
							</ul><!-- #footerrightsidebar.widgetarea -->
						</div><!-- .span6 -->

					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- #endfooter -->

			<div id="creditfooter">
				<div class="container">
					<?php if ( $footertext ) : ?>

						<p><?php echo $footertext ?></p>

					<?php endif; ?>					
				</div><!-- .container -->
			</div><!-- #creditfooter -->

		</footer><!-- footer #footer -->
		<?php

		do_action('bsb_footer_below');

	}
}



/**
 * BSB_HEADER
 * ================================
 * Handles what happens in the header
 *
 *
 * @since 1.0
 */

if ( !function_exists('bsb_header') ) {
	function bsb_header () {
		/**
		 * PRE-SECTION LOGIC
		 * ========================================
		 *
		 *
		 * @since 1.0
		 */

		$logo = ot_get_option('logo');
		$logotitle = ot_get_option('logotitle');
		$logoposition = ot_get_option('logoposition');
		if ( !logoposition )
			$logoposition = 'left';
		
		do_action ('bsb_header_above');
		
		?>
		<header id="header">
			
				<div class="navbar logo-<?php echo $logoposition ?> hidden-phone hidden-tablet">
					<div class="navbar-inner">
						<?php
						
						switch ( $logoposition ) {
							case 'center' :
								include ('bsb-logo-center.inc.php');
								break;

							case 'left' :
								include ('bsb-logo-left.inc.php');
								break;
								
							case 'right' :
								include ('bsb-logo-right.inc.php');
								break;
						}

						?>
					</div><!-- .navbar-inner -->
				</div><!-- .navbar -->
				<div class="mobile-header visible-phone">
					<div class="logo">
						<a href="<?php bloginfo('siteurl') ?>" title="<?php echo $logotitle ?>">
							<?php if ( $logo ) : ?>
								<img src="<?php echo $logo ?>" alt="<?php echo $logotitle ?>">
							<?php else : ?>
								<h1><?php bloginfo('sitename') ?></h1>
							<?php endif; ?>
						</a>
					</div>
					<?php
					
					wp_nav_menu(array(
							'theme_location'	=>		'mobile_nav', // your theme location here
							'walker'			=>		new select_menu_walker(),
							'container_class'	=>		'mobile_menu',
							'menu_id'			=>		'mobilemenu',
							'items_wrap'		=>		'<select id="%1$s">%3$s</select>',
						)
					)
					?>
				</div>
				
				<div class="tablet-header visible-tablet">
					<div class="navbar logo-<?php echo $logoposition ?> hidden-phone hidden-desktop">
						<div class="navbar-inner">
							<div class="container">
								<div class="logo">
									<a href="<?php bloginfo('siteurl') ?>" title="<?php echo $logotitle ?>">
										<?php if ( $logo ) : ?>
											<img src="<?php echo $logo ?>" alt="<?php echo $logotitle ?>">
										<?php else : ?>
											<h1><?php bloginfo('sitename') ?></h1>
										<?php endif; ?>
									</a>
								</div>
								<?php
								$args = array (
									'theme_location'	=>		'tablet_nav',
									'menu_class'		=>		'nav',
									'container_class'	=>		'menu-tablet-container',
									'fallback_cb'		=>		'ter_navbar_fallback',
									'walker'			=>		new Bootstrap_Walker_Nav_Menu()
								);

								wp_nav_menu($args);
								?>
							</div>
						</div><!-- .navbar-inner -->
					</div><!-- .navbar -->
				</div><!-- .tablet-header -->
				
		</header><!-- header#header -->
		<?php
		
		do_action ('bsb_header_below');
	
	}
}



/**
 * BSB_INSTALL_PLUGINS
 * ================================
 * Make the theme install any needed plugins
 *
 *
 * @since 1.0
 */

if ( !function_exists('bsb_install_plugins') ) {
	function bsb_install_plugins() {
	 
		$plugins = array(
			array(
				'name'     				=> 'WordPress SEO', // The plugin name
				'slug'     				=> 'wordpress-seo', // The plugin slug (typically the folder name)
				'source'   				=> BSB_ROOT_PATH . '/library/vendors/tgm-plugin-activation/plugins/wordpress-seo.zip', // The plugin source
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false
			),
			array(
				'name'     				=> 'Advanced Custom Fields', // The plugin name
				'slug'     				=> 'advanced-custom-fields', // The plugin slug (typically the folder name)
				'source'   				=> BSB_ROOT_PATH . '/library/vendors/tgm-plugin-activation/plugins/advanced-custom-fields.zip', // The plugin source
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false
			)
		);
	 
		// Change this to your theme text domain, used for internationalising strings
		$theme_text_domain = 'tgmpa';
	 
		$config = array(
			'domain'            => $theme_text_domain,          // Text domain - likely want to be the same as your theme.
			'default_path'      => '',                          // Default absolute path to pre-packaged plugins
			'parent_menu_slug'  => 'themes.php',         		// Default parent menu slug
			'parent_url_slug'   => 'themes.php',         		// Default parent URL slug
			'menu'              => 'install-required-plugins',  // Menu slug
			'has_notices'       => true,                        // Show admin notices or not
			'is_automatic'      => true,            			// Automatically activate plugins after installation or not
			'message'           => '',               			// Message to output right before the plugins table
			'strings'           => array(
				'page_title'                                => __( 'Install Required Plugins', $theme_text_domain ),
				'menu_title'                                => __( 'Install Plugins', $theme_text_domain ),
				'installing'                                => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
				'oops'                                      => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
				'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                                    => __( 'Return to Required Plugins Installer', $theme_text_domain ),
				'plugin_activated'                          => __( 'Plugin activated successfully.', $theme_text_domain ),
				'complete'                                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ) // %1$s = dashboard link
			)
		);
	 
		tgmpa( $plugins, $config );
	}
}