<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 */
?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title">Not Found</h1>
		<div class="entry-content">
			<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
		</div>
	</div>
<?php endif; ?>

<?php
	/* Start the Loop. */ ?>
<?php while ( have_posts() ) : the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( 'echo=0' ) ; ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				<?php the_date(); ?>
			</div>

	<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div>
	<?php else : ?>
			<div class="entry-content">
				<?php the_content( 'Continue reading <span>&gt;</span>' ); ?>
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
	<?php endif; ?>
		</div>

		<?php comments_template( '', true ); ?>

<?php endwhile; // End the loop. Whew. ?>

<?php
		// Previous/next page navigation.
		// Not make sure your CSS hides the class .screen-reader-text from
		// view (but not screen-readers)
		the_posts_pagination( array(
			'prev_text'          => 'Previous page',
			'next_text'          => 'Next page',
			'before_page_number' => '<span class="visuallyhidden">Page </span>',
		) );
?>
