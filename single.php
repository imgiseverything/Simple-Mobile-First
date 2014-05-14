<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 */

get_header(); ?>

<div class="primary" role="main">

<?php get_template_part('partials/loop', 'single'); ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer();
