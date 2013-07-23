<?php
/*
Take parent page and add subpages and automatically shown as tabs. Then use JavaScript to show/hide the right content

*/
 
/*
Template name: Page (with tabs)
*/

$args = array(
	'child_of' 		=> $post->ID,
	'sort_order' 	=> 'ASC',
	'sort_column' 	=> 'menu_order'
);

$children = get_pages( $args );

get_header(); ?>

<div class="tabs">
	<ul class="tabs-list">
		<?php 
		// Draw out tabs - first item should be highlighted (selected)
		$i = 0; 
		$old_post = $post; 
		foreach($children as $post): 
			setup_postdata($post); 
			$custom_fields = get_post_custom();  // Might not need this
		?>
		<li class="tab<?php echo ($i == 0) ? ' selected' : '' ;?>"><a href="#<?php echo $post->post_name; ?>" data-uri="<?php the_permalink(); ?>" class="tab-link"><?php the_title(); ?></a></li>
		<?php 
			$i++; 
		endforeach; 
		$post = $old_post; // reset the $post in case we need
		?>
	</ul>
	<?php 
	// Draw out tab content - first item should be shown
	$i = 0; 
	$old_post = $post; 
	foreach($children as $post): 
		setup_postdata($post); 
		$custom_fields = get_post_custom(); // Might not need this
	?>
	<div class="tab-content <?php echo ($i == 0) ? 'selected' : 'hidden' ;?>" id="<?php echo $post->post_name; ?>">
		<?php the_content(); ?>
	</div>
	<?php 
		$i++; 
	endforeach; 
	$post = $old_post; // reset the $post in case we need
	?>
</div>

<?php get_footer(); ?>