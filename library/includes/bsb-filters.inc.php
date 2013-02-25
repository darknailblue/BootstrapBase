<?php
/** 
 * ALL FILTER DECLARATIONS
 * ================================
 * ot_recognized_font_families - adds some more fonts to our stack
 *
 *
 * @since 1.0
 */

add_filter( 'ot_recognized_font_families', 'bsb_filter_fonts', 10, 2 );
add_filter( 'attachment_fields_to_edit', 'bsb_augment_image_sizes', 11, 2 );
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');
add_filter( 'wp_page_menu', 'bsb_add_menu_selectors');


/**
 * BSB_ADD_MENU_SELECTORS
 * =========================================
 * Adds the necessary selectors to the default page menu
 *
 *
 * @since	1.0
 * @link	http://themeshaper.com/2009/02/09/adding-class-wordpress-page-menu/
 */

if ( !function_exists('bsb_add_menu_selectors') ) {
	function bsb_add_menu_selectors( $ulclass ){
	
		$class = 'nav';
		return preg_replace('/<ul>/', '<ul class="' . $class . '">', $ulclass, 1);
	
	}
}



/**
 * BSB_AUGMENT_IMAGE_SIZES
 * =========================================
 * Adds any custom image sizes to the media uploader
 *
 *
 * @since 1.0
 */

if ( !function_exists('bsb_augment_image_sizes') ) {
	function bsb_augment_image_sizes( $fields, $post ) {
		$thumbnails = ot_get_option('customthumbnails');
		
		if ( $thumbnails ) {
		
			/**
			 * This code is taken from the KC Media Enhancements Plugin
			 *
			 * @link	http://kucrut.org/kc-media-enhancements/
			 * @link	http://wordpress.org/extend/plugins/kc-media-enhancements/
			 */

			$items = array();

			foreach ( $thumbnails as $thumbnail ) {
				
				$size = $thumbnail['thumbnailid'];
				$label = $thumbnail['title'];
				$downsize = image_downsize( $post->ID, $size );
				$enabled = $downsize[3];
				$css_id = "image-size-{$size}-{$post->ID}";

				$html  = "<div class='image-size-item'>\n";
				$html .= "\t<input type='radio' " . disabled( $enabled, false, false ) . "name='attachments[{$post->ID}][image-size]' id='{$css_id}' value='{$size}' />";
				$html .= "<label for='{$css_id}'>{$label}</label>";
				if ( $enabled )
					$html .= "<label for='{$css_id}' class='help'>" . sprintf( "(%d&nbsp;&times;&nbsp;%d)", $downsize[1], $downsize[2] ). "</label>";
				$html .= "</div>";

				$items[] = $html;	
				
			}
			
			$items = join( "\n", $items );
			$fields['image-size']['html'] = "{$fields['image-size']['html']}\n{$items}";

		}
		return $fields;
	}
}

/**
 * BSB_FILTER_FONTS
 * =========================================
 * Add some cool fonts to our available font stack
 *
 *
 * @since 1.0
 */

if ( !function_exists('bsb_filter_fonts') ) {
	function bsb_filter_fonts( $array, $field_id ) {  
		global $custom_fonts;
		
		$array = array_merge ($array, $custom_fonts);
		
		asort($array);
		
		return $array;
	}
}