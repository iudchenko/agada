<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AgAdA
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<!-- <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'agada' ); ?></a> -->

	<header id="masthead" class="site-header sticky-header">
		<div class="container">

		<div class="site-branding">
			<?php
			the_custom_logo();
				?>
				
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="menu-toggle__lines">
					<span class="menu-toggle__line-1"></span>
					<span class="menu-toggle__line-2"></span>
					<span class="menu-toggle__line-3"></span>
				</span>
			</button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'container_class' => 'primary-menu-container'
				)
				);
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'mobile-menu',
					'container_class' => 'mobile-menu-container'
				)
				);

			?>
			<a id="mobile-menu__cartlink" href="<?php echo wc_get_cart_url(); ?>">
			<div class="mobile-menu__cart">
				<img src="<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/menu/cart-icon.svg' ;?>" alt="agada-cart-icon">
				<div class="header-cart-count"></div>
			</div>
			</a>

		</nav><!-- #site-navigation -->

		</div>
	</header><!-- #masthead -->
