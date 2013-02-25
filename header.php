<?php
/**
 * HEADER.PHP
 * =======================================
 * The main header section of the theme.
 * 
 *
 * @since 1.0
 */

$htmlnamespace = ot_get_option('htmlnamespace');
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php echo $htmlnamespace ?>> <!--<![endif]-->
    <head>
		<?php
		
		do_action('bsb_head_scripts');
		
		wp_head();
		
		do_action('bsb_head_overrides');
		
		?>
    </head>

    <body <?php body_class() ?>>
		<?php do_action('bsb_body_top') ?>
		<div id="layer1">
			<div id="layer2">
				<!--[if lt IE 7]>
					<p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
				<![endif]-->

				<?php do_action('bsb_header') ?>