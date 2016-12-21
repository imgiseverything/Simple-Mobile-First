<?php
/**
 * The template for displaying a page.
 *
 * @package WordPress
 */

get_header(); ?>

<div class="primary" role="main">

<?php if(have_posts()) while(have_posts()) : the_post(); ?>
	<h1 class="page-title"><?php the_title(); ?></h1>
	<?php the_content(); ?>
<?php endwhile; // end of the loop. ?>

</div>

<?php get_sidebar('page'); ?>
<?php get_footer(); ?>
