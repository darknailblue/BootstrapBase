<?php
/**
 * DYNAMIC.PHP
 * ===============================================
 * Generates the appropriate CSS from the theme
 * options panel
 *
 *
 * @since 1.0
 */

header("Content-type: text/css");



/**
 * LOAD THE WORDPRESS BOOTSTRAP
 * ==============================================
 * Loads WordPress so we can tap into the already
 * available functions.  NOTE:  There might be a
 * cleaner and speedier way to do this.  Think
 * about it son!!
 *
 *
 * @since 1.0
 */
 
if(file_exists('../../../wp-load.php')) {
	require_once("../../../wp-load.php");
} else if(file_exists('../../wp-load.php')) {
	require_once("../../wp-load.php");
} else if(file_exists('../wp-load.php')) {
	require_once("../wp-load.php");
} else if(file_exists('wp-load.php')) {
	require_once("wp-load.php");
} else if(file_exists('../../../../wp-load.php')) {
	require_once("../../../../wp-load.php");
} else if(file_exists('../../../../wp-load.php')) {
	require_once("../../../../wp-load.php");
} else if(file_exists('../../../../../wp-load.php')) {
	require_once("../../../../../wp-load.php");
} else if(file_exists('../../../../../../wp-load.php')) {
	require_once("../../../../../../wp-load.php");
} else {

	if(file_exists('../../../wp-config.php')) {
		require_once("../../../wp-config.php");
	} else if(file_exists('../../wp-config.php')) {
		require_once("../../wp-config.php");
	} else if(file_exists('../wp-config.php')) {
		require_once("../wp-config.php");
	} else if(file_exists('wp-config.php')) {
		require_once("wp-config.php");
	} else if(file_exists('../../../../wp-config.php')) {
		require_once("../../../../wp-config.php");
	} else if(file_exists('../../../../wp-config.php')) {
		require_once("../../../../wp-config.php");
	} else {
		echo '<p>Failed to load bootstrap.</p>';
		exit;
	}
}



/**
 * BODY
 * ===================================================
 * Generate all CSS for the <body> tag
 *
 *
 * @since 1.0
 */

$mainfont = bsb_process_typography('mainfont');
$mainbackground = bsb_process_background('background');

if ( $mainfont || $mainbackground ) {

	$output = 'body {';
	
	if ( $mainfont )
		$output.= $mainfont;
		
	if ( $mainbackground )
		$output.= $mainbackground;
	
	$output.= '}';

	echo $output;

}



/**
 * #LAYER1
 * ===================================================
 * Generate all CSS for the <div id="layer2"> tag
 *
 *
 * @since 1.0
 */

$layer1background = bsb_process_background('backgroundlayer1');

if ( $layer1background ) {

	$output = '#layer1 {';
	
	if ( $layer1background )
		$output.= $layer1background;
		
	if ( $layer1background )
		$output.= $layer1background;
	
	$output.= '}';

	echo $output;

}



/**
 * #LAYER2
 * ===================================================
 * Generate all CSS for the <div id="layer2"> tag
 *
 *
 * @since 1.0
 */

$layer2background = bsb_process_background('backgroundlayer2');

if ( $layer2background ) {

	$output = '#layer2 {';
	
	if ( $layer2background )
		$output.= $layer2background;
		
	if ( $layer2background )
		$output.= $layer2background;
	
	$output.= '}';

	echo $output;

}



/**
 * #MOREFOOTER
 * ===================================================
 * Generate all CSS for the <section id="morefooter">
 * part of the site.
 *
 *
 * @since 1.0
 */

$morefooter = bsb_process_background('morefooterbackground');
$morefooterfont = bsb_process_typography('morefooterfont');

if ( $morefooter || $morefooterfont ) {

	$output = '#morefooter {';
		
	if ( $morefooter )
		$output.= $morefooter;
		
	if ( $morefooterfont )
		$output.= $morefooterfont;
	
	$output.= '}';

	echo $output;

}



/**
 * #ENDFOOTER
 * ===================================================
 * Generate all CSS for the <section id="endfooter">
 * part of the site.
 *
 *
 * @since 1.0
 */

$endfooter = bsb_process_background('endfooterbackground');
$endfooterfont = bsb_process_typography('endfooterfont');

if ( $endfooter || $endfooterfont ) {

	$output = '#endfooter {';
		
	if ( $endfooter )
		$output.= $endfooter;
		
	if ( $endfooterfont )
		$output.= $endfooterfont;
	
	$output.= '}';

	echo $output;

}



/**
 * .ENTRY-TITLE
 * ============================================
 * This class controls the main heading.  While
 * this can be accomplished via semantic coding,
 * it is a better SEO approach to keep the styles
 * in a class as opposed to their native tags
 *
 *
 * @since 1.0
 */
 
$entrytitle = bsb_process_typography('entrytitle');

if ( $entrytitle ) {

	$output = '.entry-title, .entry-title a {';
	
	$output.= $entrytitle;
	
	$output.= '}';
	
	echo $output;
	
}



/**
 * .ENTRY-SUBHEADER
 * ============================================
 * This class controls the subheader.  Typically,
 * the subheader is found INSIDE the page / post
 * header in <h1> or <h2> tags
 *
 *
 * @since 1.0
 */
 
$subheader = bsb_process_typography('subheader');

if ( $subheader ) {

	$output = '.entry-subheader {';
	
	$output.= $subheader;
	
	$output.= '}';
	
	echo $output;
	
}



/**
 * <H2>
 * ============================================
 * This class controls the secondary headings.  While
 * this can be accomplished via semantic coding,
 * it is a better SEO approach to keep the styles
 * in a class as opposed to their native tags
 *
 *
 * @since 1.0
 */
 
$secondarytitle = bsb_process_typography('secondarytitle');

if ( $secondarytitle ) {

	$output = 'h2 {';
	
	$output.= $secondarytitle;
	
	$output.= '}';
	
	echo $output;
	
}



/**
 * <H2.ARCHIVE-ITEM-TITLE>
 * ============================================
 * This class controls the blog item's headers
 *
 *
 * @since 1.0
 */

$blogarchiveitemtitle = bsb_process_typography('blogarchiveitemtitle');

if ( $blogarchiveitemtitle ) {

	$output = 'h2.archive-item-title a{';
	
	$output.= $blogarchiveitemtitle;
	
	$output.= '}';
	
	echo $output;
}



/**
 * <H3>
 * ============================================
 * This class controls the tertiary headings.  While
 * this can be accomplished via semantic coding,
 * it is a better SEO approach to keep the styles
 * in a class as opposed to their native tags
 *
 *
 * @since 1.0
 */
 
$tertiarytitle = bsb_process_typography('tertiarytitle');

if ( $tertiarytitle ) {

	$output = 'h3,';

	$output.= '.gfield_label,';

	$output.= '.widgetarea h3 {';
	
	$output.= $tertiarytitle;
	
	$output.= '}';
	
	echo $output;
	
}


/**
 * A
 * ================================
 * Generates <a> tag CSS
 *
 *
 * @since 1.0
 */

$links = bsb_process_typography('links');

if ( $links ) {

	$output = 'a {';
	
	$output.= $links;
	
	$output.= '}';
	
	echo $output;
	
}



/**
 * .YOUTUBEVIDEOITEM
 * ================================
 * Generates .youtubevideoitem class
 * border-color property
 *
 *
 * @since 1.0
 */

$youtubevideoitem = ot_get_option('links');

if ( $youtubevideoitem && $youtubevideoitem['font-color'] ) {

	$output = '.youtubevideoitem {';
	
	$output.= 'border-color: ' . $youtubevideoitem['font-color'];
	
	$output.= '}';
	
	echo $output;
	
}



/**
 * .YOUTUBEVIDEOITEM:HOVER
 * ================================
 * Generates .youtubevideoitem:hover
 * class border-color property
 *
 *
 * @since 1.0
 */

$youtubevideoitemhover = ot_get_option('linkhover');

if ( $youtubevideoitemhover && $youtubevideoitemhover['font-color'] ) {

	$output = '.youtubevideoitem:hover {';
	
	$output.= 'border-color: ' . $youtubevideoitemhover['font-color'];
	
	$output.= '}';
	
	echo $output;
	
}



/**
 * A:HOVER
 * ================================
 * Generates <a>:hover tag CSS
 *
 *
 * @since 1.0
 */

$linkhover = bsb_process_typography('linkhover');

if ( $linkhover ) {

	$output = 'a:hover {';

	$output.= $linkhover;

	$output.= '}';

	echo $output;

}



/**
 * .WP-CAPTION-TEXT
 * ======================================
 * This class is used for the images if a
 * caption is present
 *
 *
 * @since 1.0
 */

$caption = bsb_process_typography('caption');

if ( $caption ) {

	$output = '.wp-caption p.wp-caption-text {';

	$output.= $caption;

	$output.= '}';

	echo $output;

}



/**
 * PRIMARY MENU TREATMENTS
 * ============================================
 * Margin, border-radius and normal state font
 * treatments.  Thank god I don't have to do 
 * this again.
 *
 *
 * @since 1.0
 */

$menuitemtopmargin = bsb_process_measurement('menuitemtopmargin');
$menuitemborderradius = bsb_process_measurement('menuitemborderradius');
$normalstatemenufont = bsb_process_typography('normalstatemenufont');
$normalstatemenubackgroundcolor = ot_get_option('normalstatemenubackgroundcolor');

if ( $menuitemtopmargin || $menuitemborderradius || $normalstatemenufont  || $normalstatemenubackgroundcolor ) {
	$output = '.navbar .nav > li > a, ';
	$output.= '.navbar .nav li.dropdown > .dropdown-toggle {';
	
	if ( $menuitemtopmargin )
		$output.= 'margin-top:' . $menuitemtopmargin . ';';
	
	if ( $menuitemborderradius ) {
		$output.= 'border-radius:' . $menuitemborderradius . ';';
		$output.= '-webkit-border-radius:' . $menuitemborderradius . ';';
		$output.= '-moz-border-radius:' . $menuitemborderradius . ';';
		$output.= '-o-border-radius:' . $menuitemborderradius . ';';
	}
	
	if ( $normalstatemenufont )
		$output.= $normalstatemenufont;
		
	if ( $normalstatemenubackgroundcolor )
		$output.= 'background-color:' . $normalstatemenubackgroundcolor;

	$output.= '}';
	
	echo $output;
}


/**
 * NORMAL CARET TREATMENTS
 * ============================================
 * Normal State Caret Color
 *
 *
 * @since 1.0
 */

$normalstatecaretcolor = ot_get_option('normalstatecaretcolor');

if ( $normalstatecaretcolor ) {

	$output = '.navbar .nav li.dropdown > .dropdown-toggle .caret {';
	$output.= 'border-top-color: ' . $normalstatecaretcolor . ';';
	$output.= 'border-bottom-color: ' . $normalstatecaretcolor;
	$output.= '}';
	
	echo $output;
}



/**
 * HOVER MENU TREATMENTS
 * ============================================
 * Hover state menu treaments
 *
 *
 * @since 1.0
 */

$hoverstatemenufont = bsb_process_typography('hoverstatemenufont');
$hoverstatemenubackgroundcolor = ot_get_option('hoverstatemenubackgroundcolor');

if ( $hoverstatemenufont  || $hoverstatemenubackgroundcolor ) {
	$output = '.navbar .nav > li > a:hover,';
	$output.= '.navbar .nav li.dropdown > .dropdown-toggle:hover {';

	if ( $hoverstatemenufont )
		$output.= $hoverstatemenufont;
		
	if ( $hoverstatemenubackgroundcolor )
		$output.= 'background-color:' . $hoverstatemenubackgroundcolor;

	$output.= '}';
	
	echo $output;
}


/**
 * HOVER CARET TREATMENTS
 * ============================================
 * Hover State Caret Color
 *
 *
 * @since 1.0
 */

$hoverstatecaretcolor = ot_get_option('hoverstatecaretcolor');

if ( $hoverstatecaretcolor ) {

	$output = '.navbar .nav li.dropdown > .dropdown-toggle:hover .caret {';
	$output.= 'border-top-color: ' . $hoverstatecaretcolor . ';';
	$output.= 'border-bottom-color: ' . $hoverstatecaretcolor;
	$output.= '}';
	
	echo $output;
}



/**
 * ACTIVE MENU TREATMENTS
 * ============================================
 * Active state menu treaments
 *
 *
 * @since 1.0
 */

$activestatemenufont = bsb_process_typography('activestatemenufont');
$activestatemenubackgroundcolor = ot_get_option('activestatemenubackgroundcolor');

if ( $activestatemenufont  || $activestatemenubackgroundcolor ) {
	$output = '.navbar .nav > .active > a,';
	$output.= '.navbar .nav > .active > a:hover,';
	$output.= '.navbar .nav > .active > a:focus, ';
	$output.= '.navbar .nav li.dropdown.open > .dropdown-toggle,';
	$output.= '.navbar .nav li.dropdown.active > .dropdown-toggle,';
	$output.= '.navbar .nav li.current_page_item a,';
	$output.= '.navbar .nav li.dropdown.current-menu-parent > .dropdown-toggle,';
	$output.= '.navbar .nav li.dropdown.open.active > .dropdown-toggle {';
	
	if ( $activestatemenufont )
		$output.= $activestatemenufont;
		
	if ( $activestatemenubackgroundcolor )
		$output.= 'background-color:' . $activestatemenubackgroundcolor;

	$output.= '}';
	
	echo $output;
}



/**
 * ACTIVE CARET TREATMENTS
 * ============================================
 * Active State Caret Color
 *
 *
 * @since 1.0
 */

$activestatecaretcolor = ot_get_option('activestatecaretcolor');

if ( $activestatecaretcolor ) {

	$output = '.navbar .nav li.dropdown.open > .dropdown-toggle .caret,';
	$output.= '.navbar .nav li.dropdown.active > .dropdown-toggle .caret,';
	$output.= '.navbar .nav li.dropdown.current-menu-parent > .dropdown-toggle .caret,';
	$output.= '.navbar .nav li.dropdown.open.active > .dropdown-toggle .caret {';
	$output.= 'border-top-color: ' . $activestatecaretcolor . ';';
	$output.= 'border-bottom-color: ' . $activestatecaretcolor;
	$output.= '}';
	
	echo $output;
}



/**
 * DROP-DOWN MENU TREATMENTS
 * ============================================
 * Margin, border-radius and normal state font
 * treatments.  Thank god I don't have to do 
 * this again.
 *
 *
 * @since 1.0
 */

$dropdownnormalstatemenufont = bsb_process_typography('dropdownnormalstatemenufont');
$dropdownnormalstatemenubackgroundcolor = ot_get_option('dropdownnormalstatemenubackgroundcolor');

if ( $dropdownnormalstatemenufont  || $dropdownnormalstatemenubackgroundcolor ) {
	$output = '.dropdown-menu li > a,';
	$output.= '.dropdown-submenu > a {';
	
	if ( $dropdownnormalstatemenufont )
		$output.= $dropdownnormalstatemenufont;
		
	if ( $dropdownnormalstatemenubackgroundcolor )
		$output.= 'background-color:' . $dropdownnormalstatemenubackgroundcolor;

	$output.= '}';
	
	echo $output;
}



/**
 * DROP-DOWN HOVER MENU TREATMENTS
 * ============================================
 * Hover menu styles for drop-down children
 *
 *
 * @since 1.0
 */

$dropdownhoverstatemenufont = bsb_process_typography('dropdownhoverstatemenufont');
$dropdownhoverstatemenubackgroundcolor = ot_get_option('dropdownhoverstatemenubackgroundcolor');

if ( $dropdownhoverstatemenufont  || $dropdownhoverstatemenubackgroundcolor ) {
	$output = '.dropdown-menu li > a:hover,';
	$output.= '.dropdown-menu li > a:focus,';
	$output.= '.dropdown-submenu:hover > a {';
	
	if ( $dropdownhoverstatemenufont )
		$output.= $dropdownhoverstatemenufont;
		
	if ( $dropdownhoverstatemenubackgroundcolor )
		$output.= 'background-color:' . $dropdownhoverstatemenubackgroundcolor;

	$output.= '}';
	
	echo $output;
}



/**
 * DROP-DOWN ACTIVE MENU TREATMENTS
 * ============================================
 * Active menu styles for drop-down children
 *
 *
 * @since 1.0
 */

$dropdownactivestatemenufont = bsb_process_typography('dropdownactivestatemenufont');
$dropdownactivestatemenubackgroundcolor = ot_get_option('dropdownactivestatemenubackgroundcolor');

if ( $dropdownactivestatemenufont  || $dropdownactivestatemenubackgroundcolor ) {
	$output = '.dropdown-menu .active > a,';
	$output.= '.dropdown-menu .active > a:hover {';
	
	if ( $dropdownactivestatemenufont )
		$output.= $dropdownactivestatemenufont;
		
	if ( $dropdownactivestatemenubackgroundcolor )
		$output.= 'background-color:' . $dropdownactivestatemenubackgroundcolor;

	$output.= '}';
	
	echo $output;
}

/**
 * MENU ALIGNMENT
 * ==============================================
 * Controls how to main nav will be aligned
 *
 *
 * @since 1.0
 * @awesome - yes
 */
$menuitemalignment = ot_get_option('menuitemalignment');

if ( $menuitemalignment ) {

	$output = '';
	
	if ( $menuitemalignment == 'right' ) {
		$output.= '.logo-left.navbar .nav {';
		$output.= 'float: right;';
		$output.= '}';
	}
	
	echo $output;
}



/**
 * MENU BACKGROUND COLOR
 * ============================================
 * Primary Background Color
 *
 *
 * @since 1.0
 */

$menubackgroundcolor = ot_get_option('menubackgroundcolor');
$menubackgroundopacity = ot_get_option('menubackgroundopacity');

if ( $menubackgroundcolor || $menubackgroundopacity ) {

	// Do nothing if only the opacity is set
	if ( !$menubackgroundcolor && $menubackgroundopacity )
		return false;

	$output = '#header .navbar-inner, .mobile-header {';

	if ( $menubackgroundcolor && !$menubackgroundopacity )
		$output.= 'background-color:' . $menubackgroundcolor;

	if ( $menubackgroundcolor && $menubackgroundopacity ) {

		$rgb = bsb_hex2rgb($menubackgroundcolor);
		$output.= 'background-color:' . $menubackgroundcolor . ';';
		$output.= 'background-color: rgba(' . $rgb[0] . ',' . $rgb[1] . ',' . $rgb[2] . ',' . $menubackgroundopacity . ');';

	}

	$output.= '}';
	
	echo $output;
}



/**
 * HEADER
 * ===================================================
 * Header background graphic and positioning
 *
 *
 * @since 1.0
 */

$header = bsb_process_background('headerbackground');
$menuposition = ot_get_option('menuposition');
$menutopmargin = bsb_process_measurement('menutopmargin');

if ( $header || $menuposition || $menutopmargin ) {

	$output = '#header {';
	
	if ( $menutopmargin )
		$output.= 'margin-top: ' . $menutopmargin;
		
	switch ( $menuposition ) {
		case 'standard' : default :
			
			break;
		case 'absolute' :
			$output.= 'position: absolute;';
			$output.= 'width: 100%;';
			$output.= 'z-index: 1;';
			break;
		case 'fixed' :
			$output.= 'position: fixed;';
			$output.= 'width: 100%;';
			break;
	}
	
	if ( $header )
		$output.= $header;
	
	$output.= '}';

	echo $output;

}



/**
 * COMMENT ITEM STYLES
 * ===================================================
 * Style our comment items
 *
 *
 * @since 1.0
 */

$commentitemborderradius = bsb_process_measurement('commentitemborderradius');
$commentitembackgroundcolor = ot_get_option('commentitembackgroundcolor');

if ( $commentitemborderradius || $commentitembackgroundcolor ) {

	$output = '.comment .comment-wrap {';
	
	if ( $commentitemborderradius ) {
	
		$output.= 'border-radius:' . $commentitemborderradius . ';';
		$output.= '-moz-border-radius:' . $commentitemborderradius . ';';
		$output.= '-webkit-border-radius:' . $commentitemborderradius . ';';
	
	}
	
	if ( $commentitembackgroundcolor ) {
	
		$output.= 'background-color:' . $commentitembackgroundcolor . ';';
	
	}
	
	$output.= '}';
	
	if ( $commentitembackgroundcolor ) {
	
		$output.= '.triangle-left {';
		$output.= 'border-right-color: ' . $commentitembackgroundcolor . ';';
		$output.= '}';
	
	}
	
	echo $output;

}



/**
 * RESPONSIVE FONT TREATMENTS
 * ===================================================
 * Add all of our calculated fonts to media queries
 *
 *
 * @since 1.0
 */
?>

@media (min-width: 1200px) {
	<?php

	$entrytitle = bsb_process_typography_size('entrytitle', 'largedesktop');
	if ( $entrytitle )
		echo '.entry-title { ' . $entrytitle . ' } ';

	
	$subheader = bsb_process_typography_size('subheader', 'largedesktop');
	if ( $subheader )
		echo '.entry-subheader { ' . $subheader . ' } ';
		

	$secondarytitle = bsb_process_typography_size('secondarytitle', 'largedesktop');	
	if ( $secondarytitle )
		echo 'h2 { ' . $secondarytitle . ' } ';


	$tertiarytitle = bsb_process_typography_size('tertiarytitle', 'largedesktop');	
	if ( $tertiarytitle )
		echo 'h3 { ' . $tertiarytitle . ' } ';

	?>
}

@media (min-width: 980px) and (max-width: 1199px) {
	<?php

	$entrytitle = bsb_process_typography_size('entrytitle', 'normaldesktop');
	if ( $entrytitle )
		echo '.entry-title { ' . $entrytitle . ' } ';


	$subheader = bsb_process_typography_size('subheader', 'normaldesktop');
	if ( $subheader )
		echo '.entry-subheader { ' . $subheader . ' } ';


	$secondarytitle = bsb_process_typography_size('secondarytitle', 'normaldesktop');	
	if ( $secondarytitle )
		echo 'h2 { ' . $secondarytitle . ' } ';


	$tertiarytitle = bsb_process_typography_size('tertiarytitle', 'normaldesktop');	
	if ( $tertiarytitle )
		echo 'h3 { ' . $tertiarytitle . ' } ';

	?>
}
 
@media (min-width: 768px) and (max-width: 979px) {
	<?php

	$entrytitle = bsb_process_typography_size('entrytitle', 'tabs');
	if ( $entrytitle )
		echo '.entry-title { ' . $entrytitle . ' } ';
		
	
	$subheader = bsb_process_typography_size('subheader', 'tabs');
	if ( $subheader )
		echo '.entry-subheader { ' . $subheader . ' } ';


	$secondarytitle = bsb_process_typography_size('secondarytitle', 'tabs');	
	if ( $secondarytitle )
		echo 'h2 { ' . $secondarytitle . ' } ';


	$tertiarytitle = bsb_process_typography_size('tertiarytitle', 'tabs');	
	if ( $tertiarytitle )
		echo 'h3 { ' . $tertiarytitle . ' } ';

	?>
	
	.navbar .nav > li > a,
	.navbar .nav li.dropdown > .dropdown-toggle {
        margin-top: 10px;
    }
}

@media (max-width: 767px) {
	<?php

	$entrytitle = bsb_process_typography_size('entrytitle', 'landscapephone');
	if ( $entrytitle )
		echo '.entry-title { ' . $entrytitle . ' } ';
		
	$subheader = bsb_process_typography_size('subheader', 'landscapephone');
	if ( $subheader )
		echo '.entry-subheader { ' . $subheader . ' } ';

	$secondarytitle = bsb_process_typography_size('secondarytitle', 'landscapephone');	
	if ( $secondarytitle )
		echo 'h2 { ' . $secondarytitle . ' } ';


	$tertiarytitle = bsb_process_typography_size('tertiarytitle', 'landscapephone');	
	if ( $tertiarytitle )
		echo 'h3 { ' . $tertiarytitle . ' } ';

	?>
}

@media (max-width: 480px) {
	<?php

	$entrytitle = bsb_process_typography_size('entrytitle', 'portraitphone');
	if ( $entrytitle )
		echo '.entry-title { ' . $entrytitle . ' } ';
		
	
	$subheader = bsb_process_typography_size('subheader', 'portraitphone');
	if ( $subheader )
		echo '.entry-subheader { ' . $subheader . ' } ';


	$secondarytitle = bsb_process_typography_size('secondarytitle', 'portraitphone');	
	if ( $secondarytitle )
		echo 'h2 { ' . $secondarytitle . ' } ';


	$tertiarytitle = bsb_process_typography_size('tertiarytitle', 'portraitphone');	
	if ( $tertiarytitle )
		echo 'h3 { ' . $tertiarytitle . ' } ';

	?>
}

<?
/**
 * CUSTOM CSS
 * ===================================================
 * Inserts all Custom CSS via the theme panel
 *
 *
 * @since 1.0
 */

$customCSS = ot_get_option('customcss');

if ( $customCSS )
	echo $customCSS;