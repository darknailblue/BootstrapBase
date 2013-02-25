<div class="container">
	<div class="row">

		<div class="span12">
			<ul id="morefooterfullsidebar" class="widgetarea">
				<?php if ( !dynamic_sidebar('More Footer Full Sidebar') ) : ?>
					
					<li>
						<div class="alert alert-block">
							<h4>More Footer Full Sidebar</h4>
							There are no widgets in this region.&nbsp; <a href="<?php echo admin_url( 'widgets.php' ) ?>" target="_blank">Add some here</a>.
						</div>
					</li>

				<?php endif ?>
			</ul><!-- #morefooterfullsidebar.widgetarea -->
		</div><!-- .span12 -->

	</div><!-- .row -->
</div><!-- .container -->