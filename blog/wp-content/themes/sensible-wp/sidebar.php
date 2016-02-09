<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package sensible-wp  
 */

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		return;
	}
	?>

	<div id="secondary" class="widget-area col-3-12" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #secondary --> 
