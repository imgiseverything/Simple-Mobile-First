<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 */
?>
	</div>

	<footer role="contentinfo" class="group site-footer">
		
		<div class="footer-section">
			<?php wp_nav_menu( array( 'container' => '', 'container_class' => '', 'theme_location' => 'primary' ) ); ?>	
			<ul class="social-list">
				<li><a href="mailto:something@something.com" class="social-icon social-icon-email" title="Email">&#x2709;</a></li>
				<li><a href="http://facebook.com" class="social-icon social-icon-facebook" title="Facebook">&#xF610;</a></li>
				<li><a href="http://twitter.com/" class="social-icon social-icon-twitter" title="Twitter">&#xF611;</a></li>
				<li><a href="http://plus.google.com" class="social-icon social-icon-googleplus" title="Google plus">&#xF613;</a></li>
			</ul>
		</div>
		<div class="footer-section">
			<small>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></small>		
		</div>
	</footer>

</div>
<?php wp_footer(); ?>
</body>
</html>