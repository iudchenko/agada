<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */
defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
<section class="product__details container">
	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="product__images">
		<div class="product__gallery">
		<?php 
			$attachment_ids = $product->get_gallery_image_ids();

			foreach( $attachment_ids as $attachment_id ) {
					// echo wp_get_attachment_image($attachment_id, 'full');
					echo wp_get_attachment_image_no_srcset($attachment_id, 'full');
			}
		?>
		</div>

		<div class="product__main-image" id="product__main-image">
			<?php 
			// echo $product->get_image('full'); 
			echo wp_get_attachment_image_no_srcset($product->get_image_id(), 'full');
			?>
		</div>


  </div>

	<div class="product__summary summary entry-summary">

	<?php 

		//Variables
		$sku = esc_attr($product->get_sku());
		$name = esc_attr($product->get_name());
		$price = esc_attr($product->get_price());

		//Vars from attributes
		$gemstone = esc_attr($product->get_attribute( 'jewelry-gemstone' ));
		$gemstone_shape = esc_attr($product->get_attribute( 'jewelry-gemstone-shape' ));
		$gemstone_color = esc_attr($product->get_attribute( 'jewelry-gemstone-color' ));
		$gemstone_clarity = esc_attr($product->get_attribute( 'jewelry-gemstone-clarity' ));
		$gemstone_treatment = esc_attr($product->get_attribute( 'jewelry-gemstone-treatment' ));
		$metal = esc_attr($product->get_attribute( 'metal' ));
		// $cut_label = esc_attr(wc_attribute_label( 'pa_cut' ));
		// $cut = esc_attr($product->get_attribute( 'cut' ));


		//Vars from ACF
		// $color = esc_attr(get_field('color'));
		$jewelry_average_width = esc_attr(get_field('jewelry_average_width'));
		$gemstones_number = esc_attr(get_field('gemstones_number'));
		$gemstones_min_carat = esc_attr(get_field('gemstones_min_carat'));

	
	?>

		<h1 class="product__title"><?php echo $name; ?></h1>
		<div class="product__short-desc">
			<?php the_excerpt(); ?>
		</div>
		<div class="product__atts">
			<p><?php if($gemstone) echo _e('Center Gemstone', 'agada').':&nbsp;' . $gemstone; ?></p>
			<p><?php if($metal) echo _e('Metal', 'agada').':&nbsp;' . $metal; ?></p>
		</div>
		<div class="product__sku">
			<p><span>#</span><?php echo $sku; ?></p>
		</div>
		<div class="product__price">
			<p><span>$</span><?php echo number_format($price, 0, '', ','); ?></p>
		</div>



		<div class="product__btns">

		<?php
				/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );

		echo do_shortcode('[ti_wishlists_addtowishlist]');
		?>


		</div>

		<div class="product__shipping">
			<p class="product__free-shipping"><?php _e('Free Shipping, Free 30 Day Returns', 'agada');?></p>
			<p class="product__delivery">

				<?php
				$date = date("l, F d");

				$lang = pll_current_language();

				$fmt = datefmt_create(
					$lang, // The output language.
					\IntlDateFormatter::FULL,
					\IntlDateFormatter::FULL,
					pattern: "cccc, LLLL d"// The output formatting.
				);

				$input = strtotime($date ." + 14 day");
				$output = datefmt_format($fmt, $input);

				$future_date = '<span style="text-transform: capitalize">'. $output .'</span>';

					echo sprintf(
						esc_html__( 'Your item can be delivered on %1$s', 'agada' ),
						$future_date);

				?>

			</p>



		</div>

		<div class="toggle-wrapper">
			<div class="product__product-details details">
				<h4><?php _e('Ring Details', 'agada');?></h4>
				<span class="details__arrow">
					<img 
						src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/product-page/arrow.svg';?>' 
						alt='agada-product' 
						class="details__arrow-icon"
					>
				</span>
			</div>

			<div class="product__product-details-tab tab hidden">

				<p class="product-details__subtitle"><?php _e('Ring Information', 'agada'); ?></p>
				<p>
					<?php if($gemstone_shape) {		
					_e('Metal', 'agada')?>:&nbsp;<span><?php echo '<span>'.$metal.'</span>'; } ?></span>

				</p>
				<p><?php 

if($gemstone_shape) {	
				
				echo sprintf( __( 'Average width: <span>%s mm</span>', 'agada' ), $jewelry_average_width );}?></p>
				<br>
				<p class="product-details__subtitle"><?php if($gemstone) _e('Accent Gemstones', 'agada'); ?></p>
				<p>
					<?php if($gemstone) {
					_e('Type', 'agada')?>:&nbsp;<span><?php echo $gemstone; } ?></span>
				</p>

				<p>
					<?php if($gemstone_shape) {
					_e('Shape', 'agada')?>:&nbsp;<span><?php echo $gemstone_shape; } ?></span>
				</p>

				<p>
					<?php if($gemstones_number) {
					_e('Number', 'agada')?>:&nbsp;<span><?php echo $gemstones_number; } ?></span>
				</p>

				<p>
					<?php if($gemstones_min_carat) {
					_e('Min. carat total weight', 'agada')?>:&nbsp;<span><?php echo $gemstones_min_carat; } ?></span>
				</p>

				<p>
					<?php if($gemstone_color) {
					_e('Average Color', 'agada')?>:&nbsp;<span><?php echo $gemstone_color; } ?></span>
				</p>

				<p>
					<?php if($gemstone_clarity) {
					_e('Average Clarity', 'agada')?>:&nbsp;<span><?php echo $gemstone_clarity; } ?></span>
				</p>

				<p>
					<?php if($gemstone_treatment) {
					_e('Treatment', 'agada')?>:&nbsp;<span><?php echo $gemstone_treatment; } ?></span>
				</p>





				


			</div>
		</div>


    
	</div>
</section>



<?php
// get_template_part( 'template-parts/about-diamond' );
// get_template_part( 'template-parts/compare-diamonds' );
?>
  
	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
