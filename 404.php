<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 */

get_header(); ?>

<div class="primary" role="main">
	<h1 class="page-title">Content not found</h1>
	<p>Apologies, but the page you requested could not be found. Perhaps searching will help.</p>
	<?php get_search_form(); ?>
</div>

<?php get_footer(); ?>