<?php
/**
 * The template for displaying the search form
 *
 * @package WordPress
 */
?>
	<form method="get" class="search" action="<?php echo home_url('/'); ?>">
		<fieldset>
			<label for="s" class="visuallyhidden">Search this site</label>
			<input type="search" class="field" name="s" id="s" placeholder="Search" autocomplete="false">
			<button type="submit" class="submit" name="submit">Search</button>
		</fieldset>
	</form>