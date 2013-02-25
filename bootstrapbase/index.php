<?php
/**
 * INDEX.PHP
 * ==========================================
 * Main archive template
 *
 *
 * @since 1.0
 */

get_header();

?>
<section id="main">
	<div class="container">
	
		<?php do_action('bsb_blog_archive') ?>

	</div><!-- .container -->
</section><!-- section#main -->
<?php

get_footer();