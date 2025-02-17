<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package School_Theme
 */

?>
	<footer id="colophon" class="site-footer">
				<div class="footer-logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php
					if ( function_exists( 'the_custom_logo' ) ) {
						the_custom_logo();
					}
					?>
				</a>
			</div>
			<section class="credit-section">
				<h3>Credit</h3>
				<p>
					<?php
					printf( esc_html__( 'Theme: %1$s by %2$s.', 'school-theme' ), 'school-theme', '<a href="http://www.kaleblink.com">Kaleb Link</a>' );
					?>
				</p>
				<p>Photo courtesy to <a href="https://www.shopify.com/stock-photos">Burst</a></p>
			</section>
			<section class="link-section">
				<h3>Links</h3>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'footer-menu',));
					?>
			</section>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
