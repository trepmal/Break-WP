<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package stripay
 * @since stripay 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		
		<?php
			/* A sidebar in the footer? Yes. You can can customize
			 * your footer with four columns of widgets.
			 */
			get_sidebar( 'footer' );
		?>

		<div class="site-info">
			<?php do_action( 'stripay_credits' ); ?>
			
			<?php echo date('Y'); ?> <?php bloginfo('name'); ?> <span class="sep">|</span> <?php _e( 'Powered by', 'stripay' ); ?> <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'stripay' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'stripay' ); ?>"><?php printf( 'WordPress' ); ?></a> <span class="sep">|</span> <?php _e( 'Stripay Theme by', 'stripay' ); ?> <a href="<?php echo esc_url( __( 'http://bluelimemedia.com/', 'stripay' ) ); ?>" title="<?php esc_attr_e( 'Bluelime Media', 'stripay' ); ?>"><?php printf( 'Bluelime Media' ); ?></a>
			

		</div><!-- .site-info -->
	</footer><!-- .site-footer .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>
</body>
</html>