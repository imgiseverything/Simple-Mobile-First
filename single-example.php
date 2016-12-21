<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 */


$custom_fields = get_post_custom();
//$tags = get_the_terms($post->ID, 'example_tags');

get_header(); ?>
<div class="primary" role="main">

<?php if(have_posts()) while (have_posts()) : the_post(); ?>
	<h1 class="page-title"><?php the_title(); ?></h1>
	<?php the_content(); ?>
<?php endwhile; // end of the loop. ?>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>