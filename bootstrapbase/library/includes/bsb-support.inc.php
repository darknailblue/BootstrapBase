<?php
/**
 * BSB_PAGE_MENU
 * ======================================
 * This is the default page menu fallback.
 *
 *
 * @since			1.0
 */

if ( !function_exists('bsb_page_menu') ) {

	function bsb_page_menu(){
		$args = array(
			'sort_column' => 'menu_order, post_title',
			'menu_class'  => 'menu-primary-container',
			'include'     => '',
			'exclude'     => '',
			'echo'        => true,
			'show_home'   => false,
			'link_before' => '',
			'link_after'  => ''
		);
		
		wp_page_menu ( $args );
	}

}



/**
 * BSB_SHAPE_COMMENT
 * ======================================
 * Display the comment
 *
 *
 * @since			1.0
 * @link			http://themeshaper.com/2012/11/04/the-wordpress-theme-comments-template/
 */

if ( !function_exists( 'bsb_shape_comment' ) ) {

	function bsb_shape_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			?>
				<li class="post pingback">
					<p><?php _e( 'Pingback:', 'shape' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'shape' ), ' ' ); ?></p>
					
					<?php
				break;
				
			default :
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="comment">

						<?php echo get_avatar( $comment, 50 ); ?>

						<div class="triangle-left"></div>

						<div class="comment-wrap">
							<?php if ( $comment->comment_approved == '0' ) : ?>
								<em><?php _e( 'Your comment is awaiting moderation.', 'shape' ); ?></em>
								<br />
							<?php endif; ?>
							<div class="comment-meta commentmetadata">
								<?php printf( __( '%s <span class="says">says on</span>', 'shape' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
								<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
								<?php
									/* translators: 1: date, 2: time */
									printf( __( '%1$s at %2$s', 'shape' ), get_comment_date(), get_comment_time() ); ?>
								</time></a>
								<?php edit_comment_link( __( '(Edit)', 'shape' ), ' ' );
								?>
							</div><!-- .comment-meta .commentmetadata -->

							<div class="comment-content"><?php comment_text(); ?></div>

							<div class="reply">
								<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
							</div><!-- .reply -->
						</div><!-- .comment-wrap -->

					</article><!-- #comment-## -->
	 
				<?php
				break;
		endswitch;
	}
}



/**
 * BSB_GET_PAGE_BY_NAME
 * ======================================
 * Get a page by its name.  Handy useful stuff eh?
 *
 *
 * @since			1.0
 * @parameter		$pagename - string
 * @returns			string
 */

if ( !function_exists('bsb_get_page_by_name') ) {
	function bsb_get_page_by_name( $pagename ) {

		$pages = get_pages();
		
		foreach ( $pages as $page )
			if ( $page->post_name == $pagename )
				return $page;
		
		return false;

	}
}



/**
 * BSB_HEX2RGB
 * ===========================================
 * This function will convert the HEX value
 * of a string to an RGB value.
 *
 *
 * @since			1.0
 * @parameter		$color - string
 * @returns			array
 */

if ( !function_exists('bsb_hex2rgb') ) {
	function bsb_hex2rgb ( $color ) {

		if ($color[0] == '#')
			$color = substr($color, 1);

		if (strlen($color) == 6)
			list($r, $g, $b) = array($color[0].$color[1],
									 $color[2].$color[3],
									 $color[4].$color[5]);
		elseif (strlen($color) == 3)
			list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
		else
			return false;

		$r = hexdec($r); $g = hexdec($g); $b = hexdec($b);

		return array($r, $g, $b);
		
	}
}



/** 
 * BSB_PROCESS_MEASUREMENT
 * ===============================
 * Outputs a usable measurement
 * 
 *
 * @returns string or false
 * @since 1.0
 * @parameter - $option_name
 * @parameter - $echo = false
 */

if ( !function_exists('bsb_process_measurement') ) {
	function bsb_process_measurement ( $option_name, $echo = false ) {
		$option = ot_get_option($option_name);
		$output = '';
		
		if ( !$option )
			return false;
			
		else {
			if ( !$option[0] )
				return false;
				
			else {
				$output.= $option[0];
				
				if ( !$option[1] )
					$output.= 'px';
					
				else
					$output.= $option[1];
			}

			$output.= ';';

			if ( $echo )
				echo $output;
				
			else
				return $output;
		}
		
	}
}



/** 
 * BSB_PROCESS_BACKGROUND
 * ===============================
 * Generates the necessary CSS code for
 * all backgrounds properties.
 * 
 *
 * @returns string or false
 * @since 1.0
 * @parameter - $option_name
 * @parameter - $echo = false
 */

if ( !function_exists('bsb_process_background') ) {
	function bsb_process_background( $option_name, $postid = 0, $how = 'ot', $echo = false ) {
		
		if ( $how == 'ot' )
			$option = ot_get_option($option_name);
			
		else
			$option = get_post_meta($postid, $option_name, true);

		$output = '';
		
		if ( !$option )
			return false;
			
		else {

			if ($option['background-color'])
				$output.= 'background-color:' . $option['background-color'] . ';';
				
			if ($option['background-repeat'])
				$output.= 'background-repeat:' . $option['background-repeat'] . ';';
				
			if ($option['background-attachment'])
				$output.= 'background-attachment:' . $option['background-attachment'] . ';';
				
			if ($option['background-position'])
				$output.= 'background-position:' . $option['background-position'] . ';';
				
			if ($option['background-image'])
				$output.= "background-image:url('" . $option['background-image'] . "');";
				
			if ( $echo )
				echo $output;
				
			else
				return $output;

		}
		
	}
}



/**
 * BSB_PROCESS_TYPOGRAPHY_SIZE
 * ==========================================
 * This will figure out what size to use for
 * the selected font. P.S.  You're welcome
 * internet. 
 *
 *
 * @since 1.0
 * @return string
 * @parameter - $option
 * @parameter - $device
 * @parameter - $echo
 */

if ( !function_exists('bsb_process_typography_size') ) {
	function bsb_process_typography_size($option, $device, $echo = false) {
	
		$minimumthreshold			=		ot_get_option('minimumthreshold');
		$largedesktoppercentage		=		ot_get_option('largedesktoppercentage');
		$normaldesktoppercentage	=		ot_get_option('normaldesktoppercentage');
		$tabletpercentage			=		ot_get_option('tabletpercentage');
		$landscapephonepercentage	=		ot_get_option('landscapephonepercentage');
		$portraitphonepercentage	=		ot_get_option('portraitphonepercentage');	
		$option						=		ot_get_option($option);
		$size						=		$option['font-size'];
		$line_height				=		$option['line-height'];
		$output 					=		'';

		if ( !$size || !$line_height )
			return false;
		
		// This is out percentage formula
		$devicepercentage = array (
			'largedesktop'		=>		$largedesktoppercentage,
			'normaldesktop'		=>		$normaldesktoppercentage,
			'tabs'				=>		$tabletpercentage,
			'landscapephone'	=>		$landscapephonepercentage,
			'portraitphone'		=>		$portraitphonepercentage
		);
		
		
		if ( $size ) {
			// Get our string ready
			$size = str_replace('px', '', $size);
			$size = (int)$size;

			
			// Calculate the new font size
			$newfontsize = $size * $devicepercentage[$device];
			$newfontsize = (int)$newfontsize;

			
			// Establish Threshold
			if ( $newfontsize < $minimumthreshold )
				$newfontsize = $minimumthreshold;


			// Format the string again
			$newfontsize.= 'px;';
			
			$output.= 'font-size: ' . $newfontsize;
		}
		
		
		if ( $line_height ) {
			// Get our string ready
			$line_height = str_replace('px', '', $line_height);
			$line_height = (int)$line_height;

			
			// Calculate the new font size
			$newlineheight = $line_height * $devicepercentage[$device];
			$newlineheight = (int)$newfontsize;

			
			// Establish Threshold
			if ( $newlineheight < 12 )
				$newlineheight = 12;


			// Format the string again
			$newlineheight.= 'px;';
			
			$output.= 'line-height: ' . $newlineheight;
		}


		// Output
		if ( $echo )
			echo $output;
			
		else
			return $output;
	}
}



/** 
 * BSB_PROCESS_TYPOGRAPHY
 * ===========================================
 * Generates the necessary CSS code for
 * all font properties
 * 
 *
 * @returns string or false
 * @since 1.0
 * @parameter - $option_name
 * @parameter - $echo = false
 */

if ( !function_exists('bsb_process_typography') ) {
	function bsb_process_typography( $option_name, $echo = false ) {
		
		$option = ot_get_option($option_name);
		$output = '';
		
		if ( !$option )
			return false;
			
		else {

			if ($option['font-color'])
				$output.= 'color:' . $option['font-color'] . ';';
				
			if ($option['font-family'])
				$output.= 'font-family:' . $option['font-family'] . ';';
				
			if ($option['font-style'])
				$output.= 'font-style:' . $option['font-style'] . ';';
				
			if ($option['font-variant'])
				$output.= 'font-variant:' . $option['font-variant'] . ';';
				
			if ($option['font-weight'])
				$output.= 'font-weight:' . $option['font-weight'] . ';';
				
			if ($option['font-size'])
				$output.= 'font-size:' . $option['font-size'] . ';';
			
			if ($option['text-transform'])
				$output.= 'text-transform:' . $option['text-transform'] . ';';
				
			if ($option['line-height'])
				$output.= 'line-height:' . $option['line-height'] . ';';
				
			if ($option['text-decoration'])
				$output.= 'text-decoration:' . $option['text-decoration'] . ';';
				
			if ($option['letter-spacing'])
				$output.= 'letter-spacing:' . $option['letter-spacing'] . ';';
			
			if ( $echo )
				echo $output;
				
			else
				return $output;

		}
		
	}
}