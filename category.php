<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 */

get_header(); ?>

<div class="primary" role="main">
	<h1 class="page-title">Category archives: <?php echo single_cat_title('', false); ?></h1>
	<?php
		$category_description = category_description();
		
		if (!empty($category_description)):
			echo '<div class="archive-meta">' . wpautop($category_description) . '</div>';
		endif;
		
		get_template_part('partials/loop', 'category');
	?>

</div>

<?php get_sidebar(); ?>
<?php get_footer();