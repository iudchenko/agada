<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>


	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
	


		<?php while ( have_posts() ) :
		the_post(); 

		//Different content for lab-grown diamonds category products
		$diamonds_cat =  array( 81, 83, 86, 88 );

		//Different content for jewelry category products
		$jewelry_cat =  array( 443, 569, 504, 542 );


		if( has_term($diamonds_cat, 'product_cat' )) {

			get_template_part( 'template-parts/content-diamonds' );

		} else {

			// wc_get_template_part( 'content', 'single-product' );
			get_template_part( 'template-parts/content-jewelry' );
			
		}

 endwhile; // end of the loop. ?>

		<?php 

if( has_term($diamonds_cat, 'product_cat' )) {

	echo do_shortcode('[recently_viewed_diamonds]'); 

} else if ( has_term($jewelry_cat, 'product_cat' )) {

	// echo do_shortcode('[custom_related_products_jewelry]'); 
	echo do_shortcode('[recently_viewed_jewelry]'); 

} else {

	echo '<section class="recently-viewed container">'. do_shortcode('[recently_viewed_products]') . '</section>'; 

}
		
		?>

	
	<?php get_template_part( 'template-parts/benefits' ); ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

		

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>

<?php
get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
