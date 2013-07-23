<?php
/**
 * The template for displaying all pages.
 *
 * @package WordPress
 */
 
 



get_header(); ?>

<div class="primary" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<?php the_content(); ?>
<?php endwhile; // end of the loop. ?>
</div>

<?php get_sidebar('page'); ?>
<?php get_footer(); ?>
