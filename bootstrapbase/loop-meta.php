<?php
/**
 * LOOP-META.PHP
 * =====================================================
 * Decides how to build the meta part of the page
 *
 *
 * @since 1.0
 */
?>

<div class="meta">
	Posted On <span class="date"><?php the_date() ?></span> | Filed Under <span class="categories"><?php the_category( ',' ); ?></span><?php edit_post_link('Edit This Post', ' | ', ''); ?>
</div>

<?php do_action ('bsb_meta_after'); ?>