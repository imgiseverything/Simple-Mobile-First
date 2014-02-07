<?php
/**
 * The template for displaying attachments.
 *
 * @package WordPress
 */

get_header(); ?>

<div class="primary" role="main">
	<?php get_template_part( 'partials/loop', 'attachment' ); ?>
</div>

<?php get_footer(); ?>