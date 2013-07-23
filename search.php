<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 */

get_header(); ?>

<div class="primary" role="main">
	<h1 class="page-title">Search results for: <em><?php echo get_search_query(); ?></em></h1>
	<?php 
	if ( have_posts() ) : 
		get_template_part( 'loop', 'search' );
	else : 
	?>
	<p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
	<?php get_search_form(); ?>
	<?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>