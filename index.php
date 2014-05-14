<?php
/**
 * The posts listings page.
 *
 * @package WordPress
 */

get_header(); ?>

<div class="primary" role="main">
<?php get_template_part('partials/loop', 'index'); ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer();