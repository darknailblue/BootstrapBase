<?php
/**
 * BOOTSTRAPBASE.JS.PHP
 * ===============================================
 * Generates the appropriate JavaScript from the theme
 * options panel
 *
 *
 * @since 1.0
 */

header("Content-type: text/javascript");



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
 * LOAD ANY JS SPECIFIC VARIABLES
 * =================================================================
 */

$scroller = ot_get_option('3dbackground');

if ( $scroller ) {
	$scroller = $scroller[0];
	//echo $scroller;
	$layer = ot_get_option('3dlayer');
	$offset = ot_get_option('scrolloffset');
}
?>
jQuery(document).ready(function($){
	/**
	 * Enable the mobile select box
	 * =======================================
	 *
	 *
	 * @since 1.0
	 */
	
	$('#mobilemenu').change( function () {
		var url = $(this).val(); // get selected value
		if (url) { // require a URL
			window.location = url; // redirect
		}
		
		return false;
	});
	
	
	
	/**
	 * Resize the tablet menu so that
	 * it will be in the center
	 * ======================================
	 *
	 *
	 * @since 1.0
	 */
	 
	function centerTabletMenu() {
		if (Modernizr.mq('(min-width: 768px) and (max-width: 979px)') ) {
			menusWidth = $('.menu-tablet-container .nav').width();
			$('.menu-tablet-container').width(menusWidth);
		}
	}
	$(window).resize(function (){
		centerTabletMenu();
	});
	 
	<?php if ( $scroller && $layer && $offset ) : ?>
		$(document).scroll(function() {
			var x = $(document).scrollTop();
			$('<?php echo $layer ?>').css('background-position', '0% ' + parseInt(-x / <?php echo $offset ?>) + 'px');
		});	
	<?php endif; ?>
	
	centerTabletMenu();
	
	$('.form-submit #submit').addClass('btn btn-primary');
	$('#searchform #searchsubmit').addClass('btn btn-primary');
});