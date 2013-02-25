<?php
/**
 * DEFINE ANY CONSTANTS
 * ========================================
 * Any needed variables
 *
 *
 * @since 1.0
 */

DEFINE ('BSB_ROOT_PATH', get_bloginfo('template_url'));
DEFINE ('BSB_PATH', get_bloginfo('stylesheet_directory'));
DEFINE ('BSB_VERSION', '1.0');



/**
 * LOAD ALL SHORTCODES
 * =========================================
 * Duh...
 *
 *
 * @since 1.0
 */

include_once ('library/includes/bsb-shortcodes.inc.php');



/**
 * LOAD ALL ACTIONS
 * ==========================================
 * Duh...
 *
 *
 * @since 1.0
 */

include_once ('library/includes/bsb-actions.inc.php');



/**
 * LOAD ALL FILTERS
 * =========================================
 * Duh...
 *
 *
 * @since 1.0
 */

include_once ('library/includes/bsb-filters.inc.php');



/**
 * LOAD ALL CLASSES
 * =========================================
 * Duh...
 *
 *
 * @since 1.0
 */

include_once ('library/classes/bsb-walker.class.php');


 
/** 
 * LOAD OPTION TREE
 * =========================================
 * Load the option panel for this theme
 *
 *
 * @since 1.0
 */

//add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );

include_once ('library/includes/bsb-theme-options.inc.php');
include_once ('library/includes/bsb-meta-boxes.inc.php');
include_once ('option-tree/ot-loader.php');



/** 
 * LOAD TGM ACTIVATION
 * =========================================
 * Load the plugin activation module
 *
 *
 * @since 1.0
 */

include_once ('library/vendors/tgm-plugin-activation/class-tgm-plugin-activation.php');



/** 
 * LOAD SUPPORT FUNCTIONS
 * =========================================
 * Load the support functions
 *
 *
 * @since 1.0
 */

include_once ('library/includes/bsb-support.inc.php');



/**
 * REGISTER ALL MENUS
 * ======================================================================================
 * main_nav				-		Main Nav (left or right aligned)
 * main_left_nav		-		Left Nav (center aligned)
 * main_right_nav		-		Right Nav (center aligned)
 * tablet_nav			-		Table Nav
 * mobile_nav			-		Mobile Nav
 * footer_nav			-		Footer Nav
 *
 *
 * @since 1.0
 */

$navmenus = array (
	'main_nav' => 'Main Navigation',
	'main_left_nav' => 'Main Left Navigation',
	'main_right_nav' => 'Main Right Navigation',
	'tablet_nav' => 'Tablet Navigation',
	'mobile_nav' => 'Mobile Navigation',
	'footer_nav' => 'Footer Navigation'
);

register_nav_menus(
	$navmenus
);



/**
 * REGISTER ALL CUSTOM THUMBNAILS
 * ====================================================
 * We will create these thumbnails dynamically from OT
 *
 * @since 1.0
 * @awesome - yes
 */

add_theme_support( 'post-thumbnails' );

$thumbnails = ot_get_option ( 'customthumbnails' );

if ( $thumbnails ) {

	foreach ( $thumbnails as $thumbnail ) {

		if ( $thumbnail['fixedcrop'][0] == 'enabled' )
			$fixedcrop = true;
		else
			$fixedcrop = false;
		
		add_image_size( $thumbnail['thumbnailid'], $thumbnail['thumbnailwidth'], $thumbnail['thumbnailheight'], $fixedcrop );
	}

}

$archive_thumbnail = ot_get_option ( 'archivefeaturedimagesize' );

if ( $archive_thumbnail )
	add_image_size ( 'archive-thumbnail', $archive_thumbnail[0], $archive_thumbnail[0], true );



/**
 * REGISTER ANY SIDEBARS
 * ==========================================
 * right-sidebar - Single / Blog pages
 * footer-left - Duh...
 * footer-right - Duh...
 * more-footer-left - Duh...
 * more-footer-right - Duh...
 *
 *
 * @since 1.0
 */

$morefooterlayout = ot_get_option('morefooterlayout');

switch ( $morefooterlayout ) {
	case 'full';
		register_sidebar(
			array(
				'name' => __( 'More Footer Full Sidebar' ),
				'id' => 'more-footer-full',
				'description' => __( 'More Footer Full Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		break;

	case '5050';
		register_sidebar(
			array(
				'name' => __( 'More Footer 50 / 50 Left Sidebar' ),
				'id' => 'more-footer-5050-left',
				'description' => __( 'More Footer 50 / 50 Left Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		register_sidebar(
			array(
				'name' => __( 'More Footer 50 / 50 Right Sidebar' ),
				'id' => 'more-footer-5050-right',
				'description' => __( 'More Footer 50 / 50 Right Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		break;

	case '25252525';
		register_sidebar(
			array(
				'name' => __( 'More Footer 25 / 25 / 25 / 25 Left Sidebar' ),
				'id' => 'more-footer-25252525-left',
				'description' => __( 'More Footer 25 / 25 / 25 / 25 Left Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		register_sidebar(
			array(
				'name' => __( 'More Footer 25 / 25 / 25 / 25 Mid-Left Sidebar' ),
				'id' => 'more-footer-25252525-mid-left',
				'description' => __( 'More Footer 25 / 25 / 25 / 25 Mid-Left Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		register_sidebar(
			array(
				'name' => __( 'More Footer 25 / 25 / 25 / 25 Mid-Right Sidebar' ),
				'id' => 'more-footer-25252525-mid-right',
				'description' => __( 'More Footer 25 / 25 / 25 / 25 Mid-Right Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		register_sidebar(
			array(
				'name' => __( 'More Footer 25 / 25 / 25 / 25 Right Sidebar' ),
				'id' => 'more-footer-25252525-right',
				'description' => __( 'More Footer 25 / 25 / 25 / 25 Right Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		break;

	case '255025';
		register_sidebar(
			array(
				'name' => __( 'More Footer 25 / 50 / 25 Left Sidebar' ),
				'id' => 'more-footer-255025-left',
				'description' => __( 'More Footer 25 / 50 / 25 Left Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		register_sidebar(
			array(
				'name' => __( 'More Footer 25 / 50 / 25 Mid Sidebar' ),
				'id' => 'more-footer-255025-mid',
				'description' => __( 'More Footer 25 / 50 / 25 Mid Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		register_sidebar(
			array(
				'name' => __( 'More Footer 25 / 50 / 25 Right Sidebar' ),
				'id' => 'more-footer-255025-right',
				'description' => __( 'More Footer 25 / 50 / 25 Right Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		break;

	case '252550';
		register_sidebar(
			array(
				'name' => __( 'More Footer 25 / 25 / 50 Left Sidebar' ),
				'id' => 'more-footer-252550-left',
				'description' => __( 'More Footer 25 / 25 / 50 Left Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		register_sidebar(
			array(
				'name' => __( 'More Footer 25 / 25 / 50 Mid Sidebar' ),
				'id' => 'more-footer-252550-mid',
				'description' => __( 'More Footer 25 / 25 / 50 Mid Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		register_sidebar(
			array(
				'name' => __( 'More Footer 25 / 25 / 50 Right Sidebar' ),
				'id' => 'more-footer-252550-right',
				'description' => __( 'More Footer 25 / 25 / 50 Right Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		break;

	case '502525';
		register_sidebar(
			array(
				'name' => __( 'More Footer 50 / 25 / 25 Left Sidebar' ),
				'id' => 'more-footer-502525-left',
				'description' => __( 'More Footer 50 / 25 / 25 Left Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		register_sidebar(
			array(
				'name' => __( 'More Footer 50 / 25 / 25 Mid Sidebar' ),
				'id' => 'more-footer-502525-mid',
				'description' => __( 'More Footer 50 / 25 / 25 Mid Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		register_sidebar(
			array(
				'name' => __( 'More Footer 50 / 25 / 25 Right Sidebar' ),
				'id' => 'more-footer-502525-right',
				'description' => __( 'More Footer 50 / 25 / 25 Right Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		break;

	case '333333';
		register_sidebar(
			array(
				'name' => __( 'More Footer 33 / 33 / 33 / 33 Left Sidebar' ),
				'id' => 'more-footer-333333-left',
				'description' => __( 'More Footer 33 / 33 / 33 / 33 Left Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		register_sidebar(
			array(
				'name' => __( 'More Footer 33 / 33 / 33 / 33 Mid Sidebar' ),
				'id' => 'more-footer-333333-mid',
				'description' => __( 'More Footer 33 / 33 / 33 / 33 Mid Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		register_sidebar(
			array(
				'name' => __( 'More Footer 33 / 33 / 33 / 33 Right Sidebar' ),
				'id' => 'more-footer-333333-right',
				'description' => __( 'More Footer 33 / 33 / 33 / 33 Right Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		break;

	case '6633';
		register_sidebar(
			array(
				'name' => __( 'More Footer 66 / 33 Left Sidebar' ),
				'id' => 'more-footer-6633-left',
				'description' => __( 'More Footer 66 / 33 Left Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		register_sidebar(
			array(
				'name' => __( 'More Footer 66 / 33 Right Sidebar' ),
				'id' => 'more-footer-6633-right',
				'description' => __( 'More Footer 66 / 33 Right Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		break;

	case '3366';
		register_sidebar(
			array(
				'name' => __( 'More Footer 33 / 66 Left Sidebar' ),
				'id' => 'more-footer-3366-left',
				'description' => __( 'More Footer 33 / 66 Left Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		register_sidebar(
			array(
				'name' => __( 'More Footer 33 / 66 Right Sidebar' ),
				'id' => 'more-footer-3366-right',
				'description' => __( 'More Footer 33 / 66 Right Sidebar' ),
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			)
		);
		break;
}
 
register_sidebar(
	array(
		'name' => __( 'Main Sidebar' ),
		'id' => 'main-sidebar',
		'description' => __( 'Widgets in this area will be shown in the sidebar on the blog / single pages' ),
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	)
);

register_sidebar(
	array(
		'name' => __( 'Footer Left' ),
		'id' => 'footer-left',
		'description' => __( 'Left footer section' ),
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	)
);

register_sidebar(
	array(
		'name' => __( 'Footer Right' ),
		'id' => 'footer-right',
		'description' => __( 'Right Footer section' ),
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	)
);