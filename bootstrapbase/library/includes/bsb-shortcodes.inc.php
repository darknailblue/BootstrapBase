<?php
/**
 * ALL SHORTCODE DECLARATIONS
 * =============================================
 * youtubefeed - bsb_youtube_feed
 */
add_shortcode( 'youtubefeed', 'bsb_youtube_feed' );
add_shortcode( 'socialicons', 'bsb_social_icons' );
add_shortcode( 'postitem', 'bsb_post_item' );



function bsb_post_item ( $atts ) {
	extract ( shortcode_atts( array (
		'posttype'	=>	'post',
		'status'	=>	'publish',
		'num'		=>	'1'
	), $atts ) );
	
	$args = "post_type=$post_type&status=$status&showposts=$num";
	
	$the_query = new WP_Query( $args );
	
	if ( $the_query->have_posts() ) : 
	
		ob_start();
		
		?>
	
		<div class="bsb-postitems">

			<?php
			
			while ( $the_query->have_posts() ) : $the_query->the_post();
			
			?>
		
				<div class="postitem">
					<a href="<?php the_permalink() ?>" title="<?php the_title() ?>" class="pull-left"><?php the_post_thumbnail('thumbnail') ?></a>
					<h3><a href="<?php the_permalink() ?>" title="<?php the_title() ?>" ><?php the_title() ?></a></h3>
					<p><?php the_excerpt() ?></p>
				</div><!-- .postitem -->

			<?php
			
			endwhile;

			wp_reset_postdata();
			
			?>
			
		</div><!-- .bsb-postitems" -->
		
		<?php
		
	endif;	
	
	$output = ob_get_contents();

	ob_end_clean();
	
	return $output;

}


/**
 * BSB_SOCIAL_ICONS
 * =============================================
 * Displays social icons
 *
 *
 * @since 1.0
 * @author chriscarvache
 */

function bsb_social_icons( $atts ) {
	/**
	 * PRE-SECTION LOGIC
	 * ===============================================
	 * Display the social icons if there is a profile
	 * associated with it.
	 */

	extract( shortcode_atts( array(
		'width' => '64'
	), $atts ) );
	
	$feed				=		ot_get_option('feed');
	$feed				=		$feed[0];
	$twitter			=		ot_get_option('twitter');
	$facebook			=		ot_get_option('facebook');
	$linkedin			=		ot_get_option('linkedin');
	$googleplus			=		ot_get_option('googleplus');
	$youtube			=		ot_get_option('youtube');
	$vimeo				=		ot_get_option('vimeo');
	$instagram			=		ot_get_option('instagram');
	
	$prefix				=		ot_get_option('iconset');
		
	if ( $feed || $facebook || $twitter || $linkedin || $googleplus || $youtube || $vimeo || $instagram ) :

		// We must do this via Output buffering so it works correctly.

		ob_start();

		?>
		<div class="socialicons">
			<?php if ( $feed ) : ?>
				<a href="<?php bloginfo('siteurl') ?>/feed" title="Subscribe to <?php bloginfo('name') ?> Feed" class="socialicon"><img src="<?php echo BSB_ROOT_PATH ?>/library/img/social/<?php echo $prefix ?>-rss.png" alt="Subscribe to <?php bloginfo('name') ?> Feed" width="<?php echo $width ?>" height="<?php echo $height ?>"></a>
			<?php endif ?>

			<?php if ( $twitter ) : ?>
				<a href="http://twitter.com/<?php echo $twitter ?>" title="Follow <?php bloginfo('name') ?> on Twitter" class="socialicon" target="_blank"><img src="<?php echo BSB_ROOT_PATH ?>/library/img/social/<?php echo $prefix ?>-twitter.png" alt="Follow <?php bloginfo('name') ?> on Twitter" width="<?php echo $width ?>" height="<?php echo $height ?>"></a>
			<?php endif ?>
			
			<?php if ( $facebook ) : ?>
				<a href="<?php echo $facebook ?>" title="Visit <?php bloginfo('name') ?> on Facebook" class="socialicon" target="_blank"><img src="<?php echo BSB_ROOT_PATH ?>/library/img/social/<?php echo $prefix ?>-facebook.png" alt="Visit <?php bloginfo('name') ?> on Facebook" width="<?php echo $width ?>" height="<?php echo $height ?>"></a>
			<?php endif ?>
			
			<?php if ( $linkedin ) : ?>
				<a href="<?php echo $linkedin ?>" title="Visit <?php bloginfo('name') ?> on LinkedIn" class="socialicon" target="_blank"><img src="<?php echo BSB_ROOT_PATH ?>/library/img/social/<?php echo $prefix ?>-linkedin.png" alt="Visit <?php bloginfo('name') ?> on LinkedIn" width="<?php echo $width ?>" height="<?php echo $height ?>"></a>
			<?php endif ?>
			
			<?php if ( $googleplus ) : ?>
				<a href="https://plus.google.com/<?php echo $googleplus ?>" title="Visit <?php bloginfo('name') ?> on Google+" class="socialicon" target="_blank"><img src="<?php echo BSB_ROOT_PATH ?>/library/img/social/<?php echo $prefix ?>-google.png" alt="Visit <?php bloginfo('name') ?> on Google+" width="<?php echo $width ?>" height="<?php echo $height ?>"></a>
			<?php endif ?>
			
			<?php if ( $youtube ) : ?>
				<a href="http://www.youtube.com/<?php echo $youtube ?>" title="Visit <?php bloginfo('name') ?> on YouTube" class="socialicon" target="_blank"><img src="<?php echo BSB_ROOT_PATH ?>/library/img/social/<?php echo $prefix ?>-youtube.png" alt="Visit <?php bloginfo('name') ?> on YouTube" width="<?php echo $width ?>" height="<?php echo $height ?>"></a>
			<?php endif ?>
			
			<?php if ( $vimeo ) : ?>
				<a href="<?php echo $vimeo ?>" title="Visit <?php bloginfo('name') ?> on Vimeo" class="socialicon" target="_blank"><img src="<?php echo BSB_ROOT_PATH ?>/library/img/social/<?php echo $prefix ?>-viemo.png" alt="Visit <?php bloginfo('name') ?> on Vimeo" width="<?php echo $width ?>" height="<?php echo $height ?>"></a>
			<?php endif ?>
			
			<?php if ( $instagram ) : ?>
				<a href="http://instagram.com/<?php echo $instagram ?>" title="Visit <?php bloginfo('name') ?> on Instagram" class="socialicon" target="_blank"><img src="<?php echo BSB_ROOT_PATH ?>/library/img/social/<?php echo $prefix ?>-instagram.png" alt="Visit <?php bloginfo('name') ?> on Instagram" width="<?php echo $width ?>" height="<?php echo $height ?>"></a>
			<?php endif ?>

		</div><!-- .socialicons -->
		
		<?php
		
		$output = ob_get_contents();
		
		ob_end_clean();
		
		return $output;
		
	endif;
}



/**
 * BSB_YOUTUBE_FEED
 * =============================================
 * A great little short code but rude and sloppy
 *
 *
 * @since 1.0
 * @author chriscarvache
 */

function bsb_youtube_feed( $atts ) {
	/**
	 * Establish shortcode variables
	 */

	extract( shortcode_atts( array(
		'grid' => '12',
		'columns' => '3',
		'number' => '50'
	), $atts ) );



	/**
	 * First see if there is a YouTube profile set
	 */

	$youtube = ot_get_option('youtube');
	if ( !$youtube ) {
		$errorURL = get_bloginfo('wpurl') . '/wp-admin/themes.php?page=ot-theme-options#section_social';
		$errorMessage = 'You must specify a YouTube profile before using this shortcode.&nbsp; Do so in your <a href="' . $errorURL . '" title="Update Theme Options" target="_blank">Theme Options</a>.';
		return $errorMessage;
	}



	/**
	 * Secondly calculate what class to use.
	 */

	$class = $grid / $columns;
	$class = "span" . $class;
	
	
	
	/**
	 * Now lets get the feed
	 */
	
	include_once(ABSPATH . WPINC . '/rss.php');
	$rss = fetch_rss('http://gdata.youtube.com/feeds/base/users/' . $youtube . '/uploads?alt=rss&v=2&orderby=published&client=ytapi-youtube-profile');
	$items = array_slice($rss->items, 0, $number);
	
	if ( empty($items) )
		return 'There are no videos associated with this YouTube profile.';
		
	else {
		$output = '';
		$i = 0;
		foreach ( $items as $item ) {
			
			//call the embed
			$width = 600;
			$height = 400;
			$shortcode = sprintf('[embed%s%s]%s[/embed]',
				sprintf(' height="%s" ', $height),
				sprintf(' width="%s" ', $width),
				$item['link']);
			$wp_embed = new WP_Embed();
			$post_embed = $wp_embed->run_shortcode($shortcode);

			$i++;
			
			if ( $i == 1 )
				$output.= '<div class="row">' . "\r\n";

			$output.= '<div class="' . $class . '">';
			$output.= '<div class="youtubevideoitem">';
			$output.= $post_embed;
			$output.= '</div>';
			$output.= '</div>' ."\r\n";
			
			if ( $i == $columns ) {
				$output.= '</div>' . "\r\n";
				$i = 0;
			}
		}
		
		if ( $i !== 0 )
			$output.= '</div>';
		
		return $output;
	}
}