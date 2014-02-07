<?php
/**
 * The loop that displays a single post.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * @package WordPress
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-meta">
			<?php the_date(); ?>
		</div>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<div class="entry-utility">
			<?php nocruft_posted_in(); ?>
		</div>
	</div>
	<div class="group navigation">
		<div class="column nav-previous"><?php previous_post_link('%link', '<span>Previous post:</span> %title'); ?></div>
		<div class="column nav-next"><?php next_post_link('%link', '<span>Next post:</span> %title'); ?></div>
	</div>
	<?php comments_template( '', true ); ?>
<?php endwhile; // end of the loop. ?>