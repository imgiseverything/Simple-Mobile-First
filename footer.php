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
			<?php include('partials/nav-footer.php');	?>
			<ul class="social-list">
				<li><a href="http://facebook.com" class="social-icon social-icon-facebook" title="Facebook"><?php include('assets/images/svg/facebook.svg'); ?></a></li>
				<li><a href="http://twitter.com/" class="social-icon social-icon-twitter" title="Twitter"><?php include('assets/images/svg/twitter.svg'); ?></a></li>
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
