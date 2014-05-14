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
			<?php if ( count( get_the_category() ) ) : ?>
				<span class="cat-links">
					<?php printf( '<span class="%1$s">Posted in:</span> %2$s', 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
				</span>
			<?php endif; ?>
			<?php
				$tags_list = get_the_tag_list( '', ', ' );
				if ( $tags_list ):
			?>
				<span class="tag-links">
					<?php printf( '<span class="%1$s">Tagged:</span> %2$s', 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
				</span>
			<?php endif; ?>
		</div>
	</div>
	<div class="group navigation">
		<div class="column nav-previous"><?php previous_post_link('%link', '<span>Previous post:</span> %title'); ?></div>
		<div class="column nav-next"><?php next_post_link('%link', '<span>Next post:</span> %title'); ?></div>
	</div>
	<?php comments_template( '', true ); ?>
<?php endwhile; // end of the loop. ?>