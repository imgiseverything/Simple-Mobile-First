<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to twentyten_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 */
?>

<div id="comments" class="group">
<?php if ( post_password_required() ) : ?>
	<p class="nopassword">This post is password protected. Enter the password to view any comments.</p>
</div>
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
	<h2 id="comments-title">Comments</h2>
	
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
	<div class="group navigation">
		<div class="column nav-previous"><?php previous_comments_link(  '<span>&lt;</span> Older Comments' ); ?></div>
		<div class="column nav-next"><?php next_comments_link(  'Newer Comments <span>&gt;</span>' ); ?></div>
	</div>
<?php endif; // check for comment navigation ?>

	<ol class="block-list comment-list">
		<?php wp_list_comments( array( 'callback' => 'nocruft_comment' ) ); ?>
	</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
	<div class="group navigation">
		<div class="column nav-previous"><?php previous_comments_link(  '<span>&lt;</span> Older Comments' ); ?></div>
		<div class="column nav-next"><?php next_comments_link(  'Newer Comments <span>&gt;</span>' ); ?></div>
	</div>
<?php endif; // check for comment navigation ?>

<?php endif; ?>
<?php

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( comments_open() ) :
?>

	<div class="group">
		<?php //comment_form(array('title_reply' => 'Comment', 'label_submit' => 'Post', 'comment_notes_after' => '')); ?>
		<h2>Comment</h2>
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="comment-form<?php if ( is_user_logged_in() ) : ?> logged-in <?php endif; ?>">
			<fieldset>
				<div class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></div>
				<?php if ( is_user_logged_in() ) : ?>
				<div class="group">
					<p>You are currently logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
				</div>
				<?php endif; ?>
				<div class="group comment">
					<div class="field">
						<label for="comment" class="visuallyhidden">Your comment</label>
						<textarea name="comment" id="comment" cols="40" rows="10" required="required" aria-required="true" placeholder="Let us know your thoughts&hellip;"></textarea>
					</div>
				</div>
				
				<?php if ( !is_user_logged_in() ) : ?>
				<div class="group">
					<div class="field">
						<label for="author" class="visuallyhidden">Full name <?php if ($req) echo '<span class="required" title="required">*</span>'; ?></label>
						<input type="text" name="author" id="author" placeholder="Full name" value="<?php echo esc_attr($comment_author); ?>" size="22" <?php if ($req) echo 'aria-required="true" required="required"'; ?> />
					</div>
					
					<div class="field">
						<label for="email" class="visuallyhidden">Email <?php if ($req) echo '<span class="required" title="required">*</span>'; ?></label>
						<input type="email" name="email" id="email" placeholder="Email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" <?php if ($req) echo 'aria-required="true" required="required"'; ?> />
					</div>
					
					<div class="field">
						<label for="url" class="visuallyhidden">Website</label>
						<input type="url" name="url" id="url" placeholder="Website" value="<?php echo esc_attr($comment_author_url); ?>" size="22" />
					</div>
				</div>
				<?php endif; ?>
				<div class="group">
					<button name="submit" type="submit" id="submit">Post your comment</button>
				</div>
				<?php comment_id_fields(); ?>
				
				<?php do_action('comment_form', $post->ID); ?>
			</fieldset>
		</form>

	</div>
<?php else: ?>

	<p class="nocomments">Comments are closed.</p>

<?php endif; // end comments_open() ?>
</div>
