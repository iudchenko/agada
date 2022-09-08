<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AgAdA
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="container">
		<!-- Subscribe section -->
		<div class="site-footer__subscribe">
			<p><?php esc_html_e( 'Be the first to know our latest news and special offers', 'agada' ); ?></p>
			<?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]');?>
		</div>

		<!-- Footer info -->
		<div class="site-footer__info">

			<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
			<div class="site-footer__widget footer-1-widget-area">
			<?php dynamic_sidebar( 'footer-1' ); ?>
			</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
			<div class="site-footer__widget footer-2-widget-area">
			<?php dynamic_sidebar( 'footer-2' ); ?>
			</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
			<div class="site-footer__widget footer-3-widget-area">
			<?php dynamic_sidebar( 'footer-3' ); ?>
			</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
			<div class="site-footer__widget footer-4-widget-area">
			<?php dynamic_sidebar( 'footer-4' ); ?>
			</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-5' ) ) : ?>
			<div class="site-footer__widget footer-5-widget-area">
			<?php dynamic_sidebar( 'footer-5' ); ?>
			</div>
			<?php endif; ?>

		</div>

		<!-- Footer bottom -->
		<div class="site-footer__bottom">

			<div class="site-footer__credits">
			<p>
				<?php 
			printf( __( '©%s. AGADA Diamonds Inc. All rights reserved.', 'agada' ), date_i18n( 'Y' ) );	
			?>
			</p>
			</div>

			<div class="site-footer__social">
				<a href="https://www.facebook.com/" target="_blank"><img src="<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/social/facebook.svg' ;?>" alt="agada-facebook"></a>
				<a href="https://www.instagram.com/" target="_blank"><img src="<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/social/instagram.svg' ;?>" alt="agada-instagram"></a>
				<a href="https://www.youtube.com/" target="_blank"><img src="<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/social/youtube.svg' ;?>" alt="agada-youtube"></a>
			</div>

			<div class="site-footer__terms">

				<?php 
					wp_nav_menu(
						array(
							'theme_location' => 'menu-footer-bottom',
							'menu_id'        => 'menu-footer-bottom',
							'container_class' => 'footer-bottom-menu-container'
						)
						);
				?>
			</div>

		</div>

		</div>
		

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
