<?php
/**
 * The template for displaying all of a custom post type - 
 * To use, rename from page-examples.php to page-slug.php and
 * replace $args['post_type'] with the post_type too
 *
 * @package WordPress
 */
 
 
/*
Template name: Examples
*/

get_header(); // get header first to avoid issues of overwriting the $post (if we use query_posts()) instead of get_posts

// Get 'Examples' custom posts
$args = array( 
	'numberposts' 	=> -1, 
	'order'			=> 'ASC',
	'orderby'       => 'title',
	'post_status' 	=> null, 
	'post_type' 	=> 'example'
); 

$custom_posts = get_posts($args);

?>

<div class="primary" role="main">

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<h1 class="page-title"><?php the_title(); ?></h1>
		<?php the_content(); ?>
	<?php endwhile; // end of the loop. ?>


	<?php if(!empty($custom_posts)): ?>
	<ul class="block-list">
	<?php 
		$old_post = $post; 
		foreach($custom_posts as $post): 
			setup_postdata($post);  
			//$custom_fields = get_post_custom();
			$thumbnail = get_the_post_thumbnail($post->ID, 'thumbnail', array('alt' => '', 'title' => ''));
		?>
		<li>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php the_content('Continue'); ?>
		</li>
	<?php endforeach; $post = $old_post;  ?>
	</ul>

	<?php endif; ?>

</div>

<?php get_footer(); ?>