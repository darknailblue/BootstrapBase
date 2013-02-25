<?php
/**
 * SINGLE.PHP
 * ==========================================
 * Single template
 *
 *
 * @since 1.0
 */
	
$blogsidebarposition = ot_get_option('blogsidebarposition');
$blogsidebarcolumnwidth = ot_get_option('blogsidebarcolumnwidth');

$contentcolumnwidth = 12 - $blogsidebarcolumnwidth;

get_header();

?>
<section id="main">
	<div class="container">
		<div class="row">
		
			<div class="span<?php echo $contentcolumnwidth ?>">
				<div class="content-wrap">
					<article class="entry-content">
						<?php do_action('bsb_title') ?>

						<?php get_template_part ('loop', 'meta') ?>

						<?php the_content() ?>

						<?php comments_template() ?>
					</article>
				</div>
			</div>
			
			<div class="span<?php echo $blogsidebarcolumnwidth ?>">
				<ul id="mainsidebar" class="widgetarea">
					<?php if ( !dynamic_sidebar('Main Sidebar') ) : ?>

						<li>
							<div class="alert alert-block">
								<p>
									There are no widgets in this region.&nbsp; <a href="<?php echo admin_url( 'widgets.php' ) ?>" target="_blank">Add some here</a>.
								</p>
							</div>
						</li>

					<?php endif ?>
				</ul><!-- #main.widgetarea -->
			</div>
		
		</div>
	</div><!-- .container -->
</section><!-- section#main -->
<?php

get_footer();