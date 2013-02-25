<?php
/**
 * PAGE.PHP
 * ==========================================
 * Regular page template
 *
 *
 * @since 1.0
 */

get_header();

?>
<section id="main">
	<div class="container">

		<div class="row">
			<div class="span12">
			
				<div class="content-wrap">

					<article class="entry-content">

						<?php do_action('bsb_title') ?>

						<?php the_content() ?>

					</article><!-- article.entry-content -->
				
				</div>

			</div>
		</div>

	</div><!-- .container -->
</section><!-- section#main -->
<?php

get_footer();