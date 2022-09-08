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
		$cut_label = esc_attr(wc_attribute_label( 'pa_cut' ));
		$cut = esc_attr($product->get_attribute( 'cut' ));
		$gemstone_label = esc_attr(wc_attribute_label( 'pa_gemstone' ));
		$gemstone = esc_attr(esc_attr($product->get_attribute( 'gemstone' )));
		$origin_label = esc_attr(wc_attribute_label( 'pa_origin' ));
		$origin = esc_attr($product->get_attribute( 'origin' ));
		$shape_label = esc_attr(wc_attribute_label( 'pa_shape' ));
		$shape = esc_attr($product->get_attribute( 'shape' ));
		$symmetry_label = esc_attr(wc_attribute_label( 'pa_symmetry' ));
		$symmetry = esc_attr($product->get_attribute( 'symmetry' ));
		$polish_label = esc_attr(wc_attribute_label( 'pa_polish' ));
		$polish = esc_attr($product->get_attribute( 'polish' ));
		$girdle_label = esc_attr(wc_attribute_label( 'pa_girdle' ));
		$girdle = esc_attr($product->get_attribute( 'girdle' ));
		$culet_label = esc_attr(wc_attribute_label( 'pa_culet' ));
		$culet = esc_attr($product->get_attribute( 'culet' ));
		$fluor_label = esc_attr(wc_attribute_label( 'pa_fluorescence' ));
		$fluor = esc_attr($product->get_attribute( 'fluorescence' ));
		//Vars from ACF
		$color = esc_attr(get_field('color'));
		$clarity = esc_attr(get_field('clarity'));
		$carat = esc_attr(get_field('carat'));
		$length = esc_attr(get_field('diamond_length'));
		$width = esc_attr(get_field('diamond_width'));
		$height = esc_attr(get_field('diamond_height'));
		$height = esc_attr(get_field('diamond_height'));
		$table = esc_attr(get_field('table'));
		$depth = esc_attr(get_field('depth'));
		$lwratio = esc_attr(get_field('length-to-width_ratio'));
		$report = esc_attr(get_field('report'));
		$report_image = esc_attr(get_field('report-image'));
	
	?>

		<h1 class="product__title"><?php echo $name; ?></h1>
		<div class="product__atts">
			<p><?php if($cut) echo $cut_label . ':&nbsp;' . $cut; ?></p>
			<p><?php if($color) echo _e('Color', 'agada') .':&nbsp;' . $color; ?></p>
			<p><?php if($clarity) echo _e('Clarity', 'agada').':&nbsp;' . $clarity; ?></p>
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

		

		?>

		<button class="add-to-ring-btn btn--transparent"><?php _e('Add to Ring', 'agada');?></button>
		<?php echo do_shortcode('[ti_wishlists_addtowishlist]'); ?>
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
						esc_html__( 'Your lab created diamond can be delivered on %1$s', 'agada' ),
						$future_date);

				?>
		
		</p>
		</div>

		<div class="toggle-wrapper">
		<div class="product__product-details details">
			<h4><?php _e('Diamond Details', 'agada');?></h4>
			<span class="details__arrow">
				<img 
					src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/product-page/arrow.svg';?>' 
					alt='agada-diamonds-product' 
					class="details__arrow-icon"
				>
			</span>
		</div>

		<div class="product__product-details-tab tab hidden">

			<p><?php _e('Stock number: ', 'agada')?>&nbsp;<span><?php echo $sku; ?></span></p>
			<p><?php if($gemstone) echo $gemstone_label .':&nbsp;'; ?><span><?php echo $gemstone; ?></span></p>
			<p><?php if($origin) echo $origin_label .':&nbsp;'; ?><span><?php echo $origin; ?></span></p>
			<p><?php _e('Price:', 'agada')?><span>&nbsp;$<?php echo $price; ?></span></p>
			<p><?php if($carat) _e('Carat Weight:', 'agada')?>&nbsp;<span><?php echo $carat; ?></span></p>
			<p><?php if($shape) echo $shape_label .':&nbsp;'; ?><span><?php echo $shape; ?></span></p>
			<p><?php if($cut) echo $cut_label .':&nbsp;'; ?><span><?php echo $cut; ?></span></p>
			<p><?php if($color) _e('Color:', 'agada')?>&nbsp;<span><?php echo $color; ?></span></p>
			<p><?php if($clarity) _e('Clarity:', 'agada')?>&nbsp;<span><?php echo $clarity; ?></span></p>
			<p><?php if($length && $width && $height) _e('Measurements: ', 'agada')?>
			<span>
				<?php printf( __( '%1smm x %2smm x %3smm', 'agada' ), $length, $width, $height );?>
			</span></p>
			<p><?php if($table) _e('Table:', 'agada')?>&nbsp;<span><?php echo $table; ?></span>%</p>
			<p><?php if($depth) _e('Depth:', 'agada')?>&nbsp;<span><?php echo $depth; ?></span>%</p>
			<p><?php if($symmetry) echo $symmetry_label .':&nbsp;'; ?><span><?php echo $symmetry; ?></span></p>
			<p><?php if($polish) echo $polish_label .':&nbsp;'; ?><span><?php echo $polish; ?></span></p>
			<p><?php if($girdle) echo $girdle_label .':&nbsp;'; ?><span><?php echo $girdle; ?></span></p>
			<p><?php if($culet) echo $culet_label .':&nbsp;'; ?><span><?php echo $culet; ?></span></p>
			<p><?php if($fluor) echo $fluor_label .':&nbsp;'; ?><span><?php echo $fluor; ?></span></p>
			<p><?php if($lwratio) _e('Length-To-Width Ratio:', 'agada')?>&nbsp;<span><?php echo $lwratio; ?></span></p>

		</div>
		</div>
		<?php if($report) { ?>

			<div class="toggle-wrapper">
				<div class="product__product-cert details">
					<h4><?php echo sprintf( __( 'Certified by %s', 'agada' ), $report );?></h4>
					
					<span class="details__arrow">
						<img 
							src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/product-page/arrow.svg';?>' 
							alt='agada-diamonds-product' 
							class="details__arrow-icon"
						>
					</span>
				</div>

				<div class="product__product-cert-tab tab hidden">
				<?php if($report_image) { ?>
				<img src="<?php echo esc_url($report_image);?>" alt="agada report">
				<?php } ;?>
				</div>
		</div>

	<?php } ;?>


    
	</div>
</section>



<?php
get_template_part( 'template-parts/about-diamond' );
get_template_part( 'template-parts/compare-diamonds' );
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
