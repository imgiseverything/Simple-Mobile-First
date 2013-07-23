<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 */

get_header(); ?>

<div class="primary" role="main">

<?php
	/* Queue the first post, that way we know who
	 * the author is when we try to get their name,
	 * URL, description, avatar, etc.
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	if ( have_posts() )
		the_post();
?>

	<h1 class="page-title author"><?php printf( 'Author Archives: %s', "<span class='vcard'><a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a></span>" ); ?></h1>

<?php
// If a user has filled out their description, show a bio on their entries.
if ( get_the_author_meta( 'description' ) ) : ?>
	<div id="entry-author-info">
		<div id="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' )); ?>
		</div>
		<div id="author-description">
			<h2><?php printf( 'About %s', get_the_author() ); ?></h2>
			<?php the_author_meta( 'description' ); ?>
		</div>
	</div>
<?php endif; ?>

<?php
	/* Since we called the_post() above, we need to
	 * rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	rewind_posts();

	get_template_part( 'loop', 'author' );
	 
?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>