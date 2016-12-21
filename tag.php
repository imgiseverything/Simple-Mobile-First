<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 */

get_header(); ?>

<div class="primary" role="main">
	<h1 class="page-title">Tag archives: <?php echo single_tag_title('', false); ?></h1>
	<?php get_template_part('partials/loop', 'tag');?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>