<?php
/**
 * Template Name: Full Width
 * ==========================================
 * Full Width Template, No Sidebars
 * Best use with policy, terms and conditions pages
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

				<article class="entry-content">

					<?php do_action('bsb_title') ?>

					<?php the_content() ?>

				</article><!-- article.entry-content -->

			</div>
		</div>

	</div><!-- .container -->
</section><!-- section#main -->
<?php

get_footer();