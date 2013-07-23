<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 */
?>

<div class="sidebar widget-area" role="complementary">

<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>

		<div id="search" class="widget-container widget_search">
			<?php get_search_form(); ?>
		</div>

		<div id="archives" class="widget-container">
			<h2 class="widget-title">Archives</h2>
			<ul class="block-list nav">
				<?php echo mo_better_archives('selected', 'blog'); //wp_get_archives( 'type=monthly' ); ?>
			</ul>
		</div>

	<?php endif; // end primary widget area ?>
</div>
