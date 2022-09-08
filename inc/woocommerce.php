<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package AgAdA
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function agada_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 400,
			'single_image_width'    => 400,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'agada_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function agada_woocommerce_scripts() {
	// wp_enqueue_style( 'agada-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'agada-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'agada_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function agada_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'agada_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function agada_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 4,
		'columns'        => 4,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'agada_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'agada_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function agada_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'agada_woocommerce_wrapper_before' );

if ( ! function_exists( 'agada_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function agada_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'agada_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'agada_woocommerce_header_cart' ) ) {
			agada_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'agada_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function agada_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		agada_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'agada_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'agada_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function agada_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'agada' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'agada' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'agada_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function agada_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php agada_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}


/* Custom mini cart */

add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );

function iconic_cart_count_fragments( $fragments ) {

		$cart_count = WC()->cart->get_cart_contents_count(); 
		
		if ( $cart_count !== 0 ) { 
			$fragments['div.header-cart-count'] = '<div class="header-cart-count">' . $cart_count . '</div>';
		
		} else {
			$fragments['div.header-cart-count'] = '<div class="header-cart-count"></div>';
		}
  
    
    return $fragments;
    
}

/**
 * Disable WooCommerce block styles (front-end).
 */
function agada_disable_woocommerce_block_styles() {
  wp_dequeue_style( 'wc-blocks-style' );
}
add_action( 'wp_enqueue_scripts', 'agada_disable_woocommerce_block_styles' );


/**
 * Disable WooCommerce block styles (back-end).
 */
function agada_disable_woocommerce_block_editor_styles() {
  wp_deregister_style( 'wc-block-editor' );
  wp_deregister_style( 'wc-blocks-style' );
}
add_action( 'enqueue_block_assets', 'agada_disable_woocommerce_block_editor_styles', 1, 1 );

/**
 * Change the breadcrumb separator
 */
// add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
// function wcc_change_breadcrumb_delimiter( $defaults ) {

// 	$defaults['delimiter'] = ' ';
// 	return $defaults;
// }

/**
 * Change several of the breadcrumb defaults
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );
function jk_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => ' ',
            'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
            'wrap_after'  => '</nav>',
            'before'      => '<span>',
            'after'       => '</span>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}


/**
 * Recently viewed products
 */


add_shortcode( 'recently_viewed_products', 'agada_recently_viewed_shortcode' );
 
function agada_recently_viewed_shortcode() {

  $viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) : array();
   $viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );
 
  if ( empty( $viewed_products ) ) return;
    
  $title = '<h3>Recently Viewed Products</h3>';

	$product_ids = implode( ",", $viewed_products );	 

   return $title . do_shortcode("[products ids='$product_ids']");
   
}


/**
 * Recently viewed diamonds
 */


add_shortcode( 'recently_viewed_diamonds', 'agada_recently_viewed_diamonds_shortcode' );
 
function agada_recently_viewed_diamonds_shortcode() {
 
  $viewed_diamonds = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) : array();
	
	//Filter diamonds category only
	if ( empty( $viewed_diamonds ) ) return;

	$viewed_diamonds = array_filter($viewed_diamonds, function($id) {
		$diamonds_cat =  array( 81, 83, 86, 88 );
			return has_term($diamonds_cat, 'product_cat', $id );

	});

	//Filter out current product
	$viewed_diamonds = array_filter($viewed_diamonds, function($id) {
			$current_id = intval(get_the_ID());
			return intval($id) !== $current_id;

	});
	
  $viewed_diamonds = array_reverse( array_filter( array_map( 'absint', $viewed_diamonds ) ) );
	
	//Filter only 4 most recent items
	$viewed_diamonds = array_slice($viewed_diamonds, 0, 4);
	

	$title = '<h2>'. esc_attr( __('Recently Viewed', 'agada')) .'</h2>';
	$cur_lang = pll_current_language();
	$content = '';

	foreach($viewed_diamonds as $diamond) {

		$lang = pll_get_post_language($diamond);
		$product = wc_get_product( $diamond );

		if( $lang == $cur_lang ) {
			$content .= '<div class="recently-viewed-diamond">';
			$content .= '<a href="' . esc_url(get_the_permalink($diamond)) . '">';
			$content .= $product->get_image('single-post-thumbnail');
			$content .= '</a>';
			$content .= '<p>'.esc_attr(__('Carat', 'agada')). ':&nbsp;' .esc_attr(get_field('carat')).'</p>';
			$content .= '<p>'.esc_attr(wc_attribute_label( 'pa_shape' )). ':&nbsp;' .esc_attr($product->get_attribute( 'shape' )).'</p>';
			$content .= '<p>'.esc_attr(wc_attribute_label( 'pa_cut' )). ':&nbsp;' .esc_attr($product->get_attribute( 'cut' )).'</p>';
			$content .= '<p>'.esc_attr(__('Color', 'agada')). ':&nbsp;' . esc_attr(get_field('color')) .'</p>';
			$content .= '<p>'.esc_attr(__('Clarity', 'agada')). ':&nbsp;' . esc_attr(get_field('clarity')) .'</p>';
			$content .= '<p class="recently-viewed-diamond__price">$'.esc_attr($product->get_price()).'</p>';
			$content .= '</div>';
		}
}

	if ( !empty( $content ) ) {
		return '<section class="recently-viewed-diamonds container">' . $title .'<div class="recently-viewed-wrapper">'. $content .'</div></section>';
	}

}


/**
 * Recently viewed jewelry
 */


add_shortcode( 'recently_viewed_jewelry', 'agada_recently_viewed_jewelry_shortcode' );
 
function agada_recently_viewed_jewelry_shortcode() {
 
  $viewed_jewelry = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) : array();
	
	//Filter diamonds category only
	if ( empty( $viewed_jewelry ) ) return;

	$viewed_jewelry = array_filter($viewed_jewelry, function($id) {
		$jewelry_cat =  array( 443, 569, 504, 542 );
			return has_term($jewelry_cat, 'product_cat', $id );

	});

	//Filter out current product
	$viewed_jewelry = array_filter($viewed_jewelry, function($id) {
			$current_id = intval(get_the_ID());
			return intval($id) !== $current_id;

	});
	
  $viewed_jewelry = array_reverse( array_filter( array_map( 'absint', $viewed_jewelry ) ) );
	
	//Filter only 4 most recent items
	$viewed_jewelry = array_slice($viewed_jewelry, 0, 4);
	

	$title = '<h2>'. esc_attr( __('Recently Viewed', 'agada')) .'</h2>';
	$cur_lang = pll_current_language();
	$content = '';

	foreach($viewed_jewelry as $jewelry) {

		$lang = pll_get_post_language($jewelry);
		$product = wc_get_product( $jewelry );

		$metal = esc_attr($product->get_attribute( 'metal' ));
		$metal_array = explode(',',$metal);

		if( $lang == $cur_lang ) {
			$content .= '<div class="recently-viewed-jewelry-item">';
			$content .= '<a href="' . esc_url(get_the_permalink($jewelry)) . '">';
			$content .= $product->get_image('single-post-thumbnail');
			$content .= '</a>';

			if($metal) {
				// $content .= '<p>'.$metal.'</p>';
				// var_dump($metal_array);

				$content .= '
				<ul role="radiogroup" aria-label="Metal" class="variable-items-wrapper color-variable-items-wrapper wvs-style-rounded custom-color-swatch-buttons" >';

				foreach($metal_array as $metal_att) {
					$metal_att_short =  str_replace(" ","-",strtolower(trim($metal_att)));

					$content .= '<li aria-checked="false" tabindex="-1" data-wvstooltip="'.$metal_att.'" class="variable-item color-variable-item color-variable-item-'.$metal_att_short.'" title="'.$metal_att.'" data-title="'.$metal_att.'" role="radio">
					</li>';

				}
					

				$content .= '</ul>';



			} 
			$content .= '<p class="recently-viewed-jewelry__title">'.esc_attr($product->get_title()).'</p>';
			$content .= '<p class="recently-viewed-jewelry__price">$'.number_format(esc_attr($product->get_price())).'</p>';
			$content .= '</div>';
		}
}

	if ( !empty( $content ) ) {
		return '<section class="recently-viewed-jewelry container">' . $title .'<div class="recently-viewed-wrapper">'. $content .'</div></section>';
	}

}



/**
 * Related products jewelry
 */


add_shortcode( 'custom_related_products_jewelry', 'agada_custom_related_products_jewelry_shortcode' );
 
function agada_custom_related_products_jewelry_shortcode() {
	
	

	// $related_jewelry = array_filter($viewed_jewelry, function($id) {
	// 	$jewelry_cat =  array( 443, 569, 504, 542 );
	// 		return has_term($jewelry_cat, 'product_cat', $id );

	// });

	


	global $product;

if( ! is_a( $product, 'WC_Product' ) ){
    $product = wc_get_product(get_the_id());
}

$related_jewelry = woocommerce_related_products( array(
    'posts_per_page' => 2,
    'columns'        => 4,
    'orderby'        => 'rand'
) );

var_dump($related_jewelry);



// 	if ( empty( $related_jewelry ) ) return;

// 	//Filter out current product
// 	$viewed_jewelry = array_filter($viewed_jewelry, function($id) {
// 			$current_id = intval(get_the_ID());
// 			return intval($id) !== $current_id;

// 	});
	
//   $viewed_jewelry = array_reverse( array_filter( array_map( 'absint', $viewed_jewelry ) ) );
	
// 	//Filter only 4 most recent items
// 	$viewed_jewelry = array_slice($viewed_jewelry, 0, 4);
	

// 	$title = '<h2>'. esc_attr( __('Recently Viewed', 'agada')) .'</h2>';
// 	$cur_lang = pll_current_language();
// 	$content = '';

// 	foreach($viewed_jewelry as $jewelry) {

// 		$lang = pll_get_post_language($jewelry);
// 		$product = wc_get_product( $jewelry );
// 		$metal = esc_attr($product->get_attribute( 'metal' ));
// 		$metal_array = explode(',',$metal);

// 		if( $lang == $cur_lang ) {
// 			$content .= '<div class="recently-viewed-jewelry-item">';
// 			$content .= '<a href="' . esc_url(get_the_permalink($jewelry)) . '">';
// 			$content .= $product->get_image('single-post-thumbnail');
// 			$content .= '</a>';

// 			if($metal) {
// 				// $content .= '<p>'.$metal.'</p>';
// 				// var_dump($metal_array);

// 				$content .= '
// 				<ul role="radiogroup" aria-label="Metal" class="variable-items-wrapper color-variable-items-wrapper wvs-style-rounded custom-color-swatch-buttons" >';

// 				foreach($metal_array as $metal_att) {
// 					$metal_att_short =  str_replace(" ","-",strtolower(trim($metal_att)));

// 					$content .= '<li aria-checked="false" tabindex="-1" data-wvstooltip="'.$metal_att.'" class="variable-item color-variable-item color-variable-item-'.$metal_att_short.'" title="'.$metal_att.'" data-title="'.$metal_att.'" role="radio">
// 					</li>';

// 				}
					

// 				$content .= '</ul>';



// 			} 
// 			$content .= '<p class="recently-viewed-jewelry__title">'.esc_attr($product->get_title()).'</p>';
// 			$content .= '<p class="recently-viewed-jewelry__price">$'.esc_attr($product->get_price()).'</p>';
// 			$content .= '</div>';
// 		}
// }

// 	if ( !empty( $content ) ) {
// 		return '<section class="recently-viewed-jewelry container">' . $title .'<div class="recently-viewed-wrapper">'. $content .'</div></section>';
// 	}

}

/**
 * Recently viewed cookie setup
 */

function custom_track_product_view() {
	if ( ! is_singular( 'product' ) ) {
			return;
	}

	global $post;

	if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) )
			$viewed_products = array();
	else
			$viewed_products = (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] );

	if ( ! in_array( $post->ID, $viewed_products ) ) {
			$viewed_products[] = $post->ID;
	}

	if ( sizeof( $viewed_products ) > 20 ) {
			array_shift( $viewed_products );
	}

	// Store for session only
	wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );
}

add_action( 'template_redirect', 'custom_track_product_view', 20 );



/**
 * Disable default product page data
 */

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
// remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );


add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'agada_dropdown_variation_attribute_options', 10, 1 );
function agada_dropdown_variation_attribute_options( $args ){

    // For attribute "Sizes"
    if( 'pa_ring-size' == $args['attribute'] )
        $args['show_option_none'] = __( 'Select Size', 'agada' );

    return $args;
}




/**
 * Disable Zoom, Lightbox and Product Gallery Slider @ Single Product Page
 */
  
add_action( 'wp', 'ts_remove_zoom_lightbox_gallery_support', 99 );
   
function ts_remove_zoom_lightbox_gallery_support() { 
   remove_theme_support( 'wc-product-gallery-zoom' );
   remove_theme_support( 'wc-product-gallery-lightbox' );
   remove_theme_support( 'wc-product-gallery-slider' );
}




/**
 * AJAX add to cart
 */

add_action('wp_ajax_agada_woocommerce_ajax_add_to_cart', 'agada_woocommerce_ajax_add_to_cart'); 
add_action('wp_ajax_nopriv_agada_woocommerce_ajax_add_to_cart', 'agada_woocommerce_ajax_add_to_cart');          
function agada_woocommerce_ajax_add_to_cart() {  
    $product_id = apply_filters('agada_woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('agada_woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id); 
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) { 
        do_action('agada_woocommerce_ajax_added_to_cart', $product_id);
            if ('yes' === get_option('agada_woocommerce_cart_redirect_after_add')) { 
                wc_add_to_cart_message(array($product_id => $quantity), true); 
            } 
            WC_AJAX :: get_refreshed_fragments(); 
            } else { 
                $data = array( 
                    'error' => true,
                    'product_url' => apply_filters('agada_woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
                echo wp_send_json($data);
            }
            wp_die();
        }


/**
 * To change add to cart text on single product page
 */

add_filter( 'woocommerce_product_single_add_to_cart_text', 'agada_custom_single_add_to_cart_text' ); 
function agada_custom_single_add_to_cart_text() {
    return __( 'Add to Bag', 'woocommerce' ); 
}


// function agada_woo_rest() {
	
// 	register_rest_field(
// 		'product',
// 		'diamond_shape',
// 		array(
// 				'get_callback'    => function ( $object ) {
// 						// $title  = get_the_title( $object['id']);
// 						$post_en = pll_get_post($object['id'], 'en');
// 						$product_en = wc_get_product( $post_en );
// 						$shape_en = esc_attr($product_en->get_attribute( 'shape' ));

// 						return $shape_en;
// 				},
// 				'update_callback' => null,
// 				'schema'          => null,
// 		)
// );

// 	register_rest_field(
// 		'product',
// 		'diamond_report',
// 		array(
// 				'get_callback'    => function ( $object ) {
// 						$report = esc_attr(get_field( 'report', $object['id']));
// 						return $report;
// 				},
// 				'update_callback' => null,
// 				'schema'          => null,
// 		)
// );
	
// }

// add_action('rest_api_init', 'agada_woo_rest');



/*------------------- REGISTRATION ----------------*/

//Creating new registration fields
add_action('woocommerce_register_form', 'agada_add_register_form_field');

function agada_add_register_form_field()
{

	woocommerce_form_field(
		'billing_first_name',
		array(
			'type'        => 'text',
			'required'    => true, // just adds an "*"
			// 'label'       => 'First Name',
			'placeholder' => __('First Name', 'agada')
		),
		(isset($_POST['billing_first_name']) ? $_POST['billing_first_name'] : '')
	);

	woocommerce_form_field(
		'billing_last_name',
		array(
			'type'        => 'text',
			'required'    => true, // just adds an "*"
			// 'label'       => 'Last Name',
			'placeholder' => __('Last Name', 'agada')
		),
		(isset($_POST['billing_last_name']) ? $_POST['billing_last_name'] : '')
	);

	woocommerce_form_field(
		'news_subscribe_checkbox',
		array(
			'type'        => 'checkbox',
			'class' => array('input-checkbox'),
			'label_class' => array('checkmark-container'), 
			'required'    => false, // remember, this doesn't make the field required, just adds an "*"
			'label'       => __('Email me AGADA news, updates and offers.', 'agada')
		),
		get_user_meta(get_current_user_id(), 'news_subscribe_checkbox', true) // get the data
	);

}

add_filter( 'woocommerce_form_field', 'hackies', 10, 4);
function hackies( $field, $key, $args, $value ) {
    // Wrap all fields except first and last name.
    if ( $key === 'news_subscribe_checkbox' ) {
        $field = str_replace( array('</label>'), array('<span class="checkmark"></span></label>'), $field );
    }
    return $field;
}

// Validation for new fields
add_action('woocommerce_register_post', 'agada_validate_fields', 10, 3);

function agada_validate_fields($username, $email, $errors)
{

	if (empty($_POST['billing_first_name'])) {
		$errors->add('billing_first_name_error', __('Please, enter your First Name', 'agada'));
	}
	if (empty($_POST['billing_last_name'])) {
		$errors->add('billing_last_name_error', __('Please, enter your Last Name', 'agada'));
	}

}

// Saving to the database
add_action('woocommerce_created_customer', 'agada_save_register_fields');

function agada_save_register_fields($customer_id)
{

	if (isset($_POST['billing_first_name'])) {
		update_user_meta($customer_id, 'billing_first_name', wc_clean($_POST['billing_first_name']));
	}

	if (isset($_POST['billing_last_name'])) {
		update_user_meta($customer_id, 'billing_last_name', wc_clean($_POST['billing_last_name']));
	}

	if (isset($_POST['news_subscribe_checkbox'])) {
		update_user_meta($customer_id, 'news_subscribe_checkbox', wc_clean($_POST['news_subscribe_checkbox']));
	}

}


// Adding custom fields from registration to account page
/**
 * Step 1. Add your field
 */
add_action('woocommerce_edit_account_form', 'agada_add_field_edit_account_form');
// or add_action( 'woocommerce_edit_account_form_start', 'misha_add_field_edit_account_form' );
function agada_add_field_edit_account_form()
{

	woocommerce_form_field(
		'billing_first_name',
		array(
			'type'        => 'text',
			'required'    => true, // remember, this doesn't make the field required, just adds an "*"
			'label'       => __('First Name', 'agada'),
			'class' => array('woocommerce-form-row', 'woocommerce-form-row--wide', 'form-row', 'form-row-wide')
		),
		get_user_meta(get_current_user_id(), 'billing_first_name', true) // get the data
	);

	woocommerce_form_field(
		'billing_last_name',
		array(
			'type'        => 'text',
			'required'    => true, // remember, this doesn't make the field required, just adds an "*"
			'label'       => __('Last Name', 'agada'),
			'class' => array('woocommerce-form-row', 'woocommerce-form-row--wide', 'form-row', 'form-row-wide')
		),
		get_user_meta(get_current_user_id(), 'billing_last_name', true) // get the data
	);



}

/**
 * Step 2. Save field value
 */
add_action('woocommerce_save_account_details', 'agada_save_account_details');
function agada_save_account_details($user_id)
{

	update_user_meta($user_id, 'billing_first_name', sanitize_text_field($_POST['billing_first_name']));
	update_user_meta($user_id, 'billing_last_name', sanitize_text_field($_POST['billing_last_name']));
	// update_user_meta($user_id, 'news_subscribe_checkbox', sanitize_text_field($_POST['news_subscribe_checkbox']));
}

/**
 * Step 3. Make it required
 */
add_filter('woocommerce_save_account_details_required_fields', 'agada_make_field_required');
function agada_make_field_required($required_fields)
{

	$required_fields['billing_first_name'] = __('First Name', 'agada');
	$required_fields['billing_last_name'] = __('Last Name', 'agada');;
	return $required_fields;
}

/* Making default account details fields not required */

add_filter('woocommerce_save_account_details_required_fields', 'agada_myaccount_required_fields');

function agada_myaccount_required_fields($account_fields)
{

	unset($account_fields['account_last_name']); // Last name
	unset($account_fields['account_first_name']); // First name
	unset($account_fields['account_display_name']); // Display name

	return $account_fields;
}




/* Account */
/* Unsetting */
add_filter('woocommerce_account_menu_items', 'agada_remove_my_account_links');
function agada_remove_my_account_links($menu_links)
{

	unset($menu_links['edit-address']); // Addresses
	unset($menu_links['dashboard']); // Remove Dashboard
	//unset( $menu_links['payment-methods'] ); // Remove Payment Methods
	// unset($menu_links['orders']); // Remove Orders
	unset($menu_links['downloads']); // Disable Downloads
	// unset($menu_links['edit-account']); // Remove Account details tab
	// unset($menu_links['customer-logout']); // Remove Logout link

	return $menu_links;
}





// Moving the privacy policy text to the bottom of registration form
remove_action( 'woocommerce_register_form', 'wc_registration_privacy_policy_text', 20 );
add_action( 'woocommerce_register_form_end', 'wc_registration_privacy_policy_text', 20 );


//Adding wishlist links

add_filter('woocommerce_get_endpoint_url', 'agada_hook_endpoint', 10, 4);
function agada_hook_endpoint($url, $endpoint, $value, $permalink)
{

	if ($endpoint === 'wishlist') {

		// ok, here is the place for your custom URL, it could be external
		$url = esc_url(home_url('/wishlist/'));
	}

	return $url;
}


/**
 * @snippet       Reorder My Account Menu Links
 * @author        Misha Rudrastyh
 * @url           https://rudrastyh.com/woocommerce/my-account-menu.html#change-order
 */

add_filter( 'woocommerce_account_menu_items', 'agada_menu_links_reorder' );

function agada_menu_links_reorder( $menu_links ){
	
	return array(
		'edit-account' => __( 'Personal Data', 'agada' ),
		'orders' => __( 'Order History', 'agada' ),
		'wishlist' => __('Wishlist', 'agada'),
		'customer-logout' => __( 'Sign Out', 'agada' )
	);

}


// Order history table
function agada_new_orders_columns( $columns = array() ) {

	// Hide the columns
	if( isset($columns['order-total']) ) {
			// Unsets the columns which you want to hide
			unset( $columns['order-number'] );
			// unset( $columns['order-date'] );
			unset( $columns['order-status'] );
			// unset( $columns['order-total'] );
			unset( $columns['order-actions'] );
	}

	// Add new columns
	$columns['order-item'] = __( 'Item', 'agada' );

	return $columns;
}
add_filter( 'woocommerce_account_orders_columns', 'agada_new_orders_columns' );



/**
 * Processing filter requests
 */

add_action('wp_ajax_agada_filter_function', 'agada_filter_function'); 
add_action('wp_ajax_nopriv_agada_filter_function', 'agada_filter_function');

function agada_filter_function(){

	// Tax query
	$tax_query = array(
		'relation' => 'AND',

		array(
			'taxonomy'      => 'product_cat',
			'field' 				=> 'term_id', //This is optional, as it defaults to 'term_id'
			'terms'         => array( 81, 83, 86, 88 ), // Filtering diamonds category
			'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
		),

	);



	if( isset( $_POST['shape'] ) )
	array_push($tax_query, 
			array(
			'taxonomy' => 'pa_shape',
			'field'     => 'slug',
			'terms' => $_POST['shape'],
			'operator'      => 'IN'
		)

	);


if( isset( $_POST['cutMin'] ) && isset( $_POST['cutMax'] )) {

	$cut_array = array(
		'Fair',
		'Good',
		'Very Good',
		'Ideal',
		'Excellent'
	);

	$cut_array_length = intval($_POST['cutMax']) - intval($_POST['cutMin']);

	$query_cut = array_slice($cut_array, intval($_POST['cutMin']), $cut_array_length, true);


array_push($tax_query, 
	array(
		'taxonomy' => 'pa_cut',
		'field'     => 'slug',
		'terms' => $query_cut,
		'operator'      => 'IN'
	)
);
}

if( isset( $_POST['polishMin'] ) && isset( $_POST['polishMax'] )) {

	$polish_array = array(
		'Good',
		'Very Good',
		'Excellent'
	);

	$polish_array_length = intval($_POST['polishMax']) - intval($_POST['polishMin']);

	$query_polish = array_slice($polish_array, intval($_POST['polishMin']), $polish_array_length, true);


array_push($tax_query, 
	array(
		'taxonomy' => 'pa_polish',
		'field'     => 'slug',
		'terms' => $query_polish,
		'operator'      => 'IN'
	)
);
}

if( isset( $_POST['fluorMin'] ) && isset( $_POST['fluorMax'] )) {

	$fluor_array = array(
		'Very Strong',
		'Strong', 
		'Medium', 
		'Faint', 
		'None', 
	);

	$fluor_array_length = intval($_POST['fluorMax']) - intval($_POST['fluorMin']);

	$query_fluor= array_slice($fluor_array, intval($_POST['fluorMin']), $fluor_array_length, true);


array_push($tax_query, 
	array(
		'taxonomy' => 'pa_fluorescence',
		'field'     => 'slug',
		'terms' => $query_fluor,
		'operator'      => 'IN'
	)
);
}


if( isset( $_POST['symMin'] ) && isset( $_POST['symMax'] )) {

	$sym_array = array(
		'Good',
		'Very Good',
		'Excellent'
	);

	$sym_array_length = intval($_POST['symMax']) - intval($_POST['symMin']);

	$query_sym= array_slice($sym_array, intval($_POST['symMin']), $sym_array_length, true);


array_push($tax_query, 
	array(
		'taxonomy' => 'pa_symmetry',
		'field'     => 'slug',
		'terms' => $query_sym,
		'operator'      => 'IN'
	)
);
}



	// Meta query
	$meta_query = array(
		'relation' => 'AND',
	);


	if( isset( $_POST['priceMin'] ) && isset( $_POST['priceMax'] ))
	array_push($meta_query, 
		array(
			'key' => '_price',
			'value' => array(floatval($_POST['priceMin'] ), floatval($_POST['priceMax'] )),
			'compare' => 'BETWEEN',
			'type' => 'NUMERIC',

		)
	);

	if( isset( $_POST['caratMin'] ) && isset( $_POST['caratMax'] ))
	array_push($meta_query, 
		array(
			'key' => 'carat',
			'value' => array(floatval($_POST['caratMin'] ), floatval($_POST['caratMax'] )),
			'compare' => 'BETWEEN',
			// 'type' => 'NUMERIC',
		)
	);



	if( isset( $_POST['lwMin'] ) && isset( $_POST['lwMax'] ))
	array_push($meta_query, 
		array(
			'key' => 'length-to-width_ratio',
			'value' => array(floatval($_POST['lwMin'] ), floatval($_POST['lwMax'] )),
			'compare' => 'BETWEEN',
			// 'type' => 'DECIMAL',
		)
	);

	// if( isset( $_POST['tableMin'] ) && isset( $_POST['tableMax'] ))
	// array_push($meta_query, 
	// 	array(
	// 		'key' => 'table',
	// 		'value' => array($_POST['tableMin'], $_POST['tableMax']),
	// 		'compare' => 'BETWEEN',
	// 		'type' => 'NUMERIC',
	// 	)
	// );

	if( isset( $_POST['tableMin'] ) && isset( $_POST['tableMax'] ))
	array_push($meta_query, 
		array(
			'key' => 'table',
			'value' => array(floatval($_POST['tableMin']), floatval($_POST['tableMax'])),
			'compare' => 'BETWEEN',
			'type' => 'NUMERIC',
		)
	);


	// if( isset( $_POST['depthMin'] ) && isset( $_POST['depthMax'] ))
	// array_push($meta_query, 
	// 	array(
	// 		'key' => 'depth',
	// 		'value' => array(intval($_POST['depthMin'] ), intval($_POST['depthMax'] )),
	// 		'compare' => 'BETWEEN',
	// 		'type' => 'NUMERIC',
	// 	)
	// );

	if( isset( $_POST['depthMin'] ) && isset( $_POST['depthMax'] ))
	array_push($meta_query, 
		array(
			'key' => 'depth',
			'value' => array(floatval($_POST['depthMin'] ), floatval($_POST['depthMax'] )),
			'compare' => 'BETWEEN',
			'type' => 'NUMERIC',
		)
	);


	if( isset( $_POST['colorMin'] ) && isset( $_POST['colorMax'] )) {

		$color_array = array(
			'J',
			'I',
			'H',
			'G',
			'F',
			'E',
			'D'
		);

		$color_array_length = intval($_POST['colorMax']) - intval($_POST['colorMin']);

		$query_color = array_slice($color_array, $_POST['colorMin'], $color_array_length, true);


	array_push($meta_query, 
		array(
			'key'       => 'color',
			'value' 		=> $query_color,
			'compare'   => 'IN'
		)
	);
}


if( isset( $_POST['clarityMin'] ) && isset( $_POST['clarityMax'] )) {

	$clarity_array = array(
		'SI2',
		'SI1',
		'VS2',
		'VS1',
		'VVS2',
		'VVS1',
		'IF',
		'FL',
	);

	$clarity_array_length = intval($_POST['clarityMax']) - intval($_POST['clarityMin']);

	$query_clarity = array_slice($clarity_array, $_POST['clarityMin'], $clarity_array_length, true);

array_push($meta_query, 
	array(
		'key'       => 'clarity',
		'value' 		=> $query_clarity,
		'compare'   => 'IN'
	)
);
}







	if( isset( $_POST['report'] ) )
	array_push($meta_query, 
			array(
			'key' => 'report',
			'value' => $_POST['report'],
			'compare'      => 'IN'
		)

	);





	//Main args
	$args = array(
		'post_type' 		 =>  'product',
		'post_status'    => 'publish',
		'posts_per_page' => 50,
		'paged' => $_POST['page'],
		'tax_query' 		=> $tax_query,
		'meta_query' => $meta_query,
	);


		$result = array();
		$total_featured = 0;

		$wc_query = new WP_Query($args); 

		if ($wc_query->have_posts()) : 
		while ($wc_query->have_posts()) : 
		$wc_query->the_post(); 

		global $product;

		

		if ($product->is_featured()) {

			$total_featured++;
		}

		//Shape
		$post_en = pll_get_post($product->get_id(), 'en');
		$product_en = wc_get_product( $post_en );
		$shape_en = esc_attr($product_en->get_attribute( 'shape' ));

		//Image
		$image = wp_get_attachment_url($product->get_image_id());
	


		array_push($result, array(
			'title' => $product->get_name(),
			'permalink' => $product->get_permalink(),
			'image' => $image ? $image : esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/placeholder.jpg',
			'shape' => $product->get_attribute( 'shape' ),
			'shape_en' => $shape_en,
			'cut' => $product->get_attribute( 'cut' ),
			'polish' => $product->get_attribute( 'polish' ),
			'girdle' => $product->get_attribute( 'girdle' ),
			'gemstone' => $product->get_attribute( 'gemstone' ),
			'culet' => $product->get_attribute( 'culet' ),
			'origin' => $product->get_attribute( 'origin' ),
			'fluorescence' => $product->get_attribute( 'fluorescence' ),
			'symmetry' => $product->get_attribute( 'symmetry' ),
			'price' => $product->get_price(),
			'carat' => get_field('carat'),
			'report' => get_field('report'),
			'lw' => get_field('length-to-width_ratio'),
			'table' => get_field('table'),
			'depth' => get_field('depth'),
			'color' => get_field('color'),
			'clarity' => get_field('clarity'),
			'diamond_length' => get_field('diamond_length'),
			'diamond_width' => get_field('diamond_width'),
			'diamond_height' => get_field('diamond_height'),
			'featured' => $product->is_featured()
		));

		endwhile;

		$total_pages = $wc_query->max_num_pages;
		$current_page = $args["paged"];
		$total_count = $wc_query->found_posts;
		// $total_featured = $wc_query->get_featured();

		wp_reset_postdata(); 
		// _e( 'No Products' ); 

		endif; 

		// echo json_encode(array($current_page, $total_pages));
		header('Content-Type: application/json');
		header('current_page:'. $current_page);
		header('total_pages:'. $total_pages);
		header('total_diamonds:'. $total_count);
		header('total_featured:'. $total_featured);
		// header('x-wp-totalpages $total_pages');
		echo json_encode($result);

	die();
	

}


/**
 * Custom remove item link text in the cart
 */

add_filter('woocommerce_cart_item_remove_link', 'agada_remove_icon_and_add_text', 10, 2);

function agada_remove_icon_and_add_text($string, $cart_item_key) {
    $string = str_replace('class="remove"', '', $string);
    return str_replace('&times;', __('&times; <span>Remove</span>','agada'), $string);
}

/**
 * Q-ty fields
 */


add_filter('wqpmb_on_product_page', '__return_false');
add_filter('wqpmb_on_mini_cart_page', '__return_false');


/**
 * Checkout
 */


add_filter( 'woocommerce_checkout_fields' , 'agada_remove_checkout_fields' ); 

function agada_remove_checkout_fields( $fields ) { 

	unset($fields['billing']['billing_company']);
	unset($fields['billing']['billing_country']);

return $fields; 

}


add_filter("woocommerce_checkout_fields", "agada_custom_override_checkout_fields", 1);
function agada_custom_override_checkout_fields($fields) {
    // $fields['billing']['billing_first_name']['priority'] = 1;
    // $fields['billing']['billing_last_name']['priority'] = 2;
    // $fields['billing']['billing_email']['priority'] = 3;
    // $fields['billing']['billing_phone']['priority'] = 11;
    return $fields;
}


// // WooCommerce Checkout Fields Hook
// add_filter('woocommerce_checkout_fields','agada_custom_wc_checkout_fields_no_label');

// // Our hooked in function - $fields is passed via the filter!
// // Action: remove label from $fields
// function agada_custom_wc_checkout_fields_no_label($fields) {
//     // loop by category
//     foreach ($fields as $category => $value) {
//         // loop by fields
//         foreach ($value as $field => $property) {
//             // remove label property
//             unset($fields[$category][$field]['label']);
//         }
//     }
//      return $fields;
// }


add_filter( 'woocommerce_checkout_fields' , 'override_billing_checkout_fields', 20, 1 );
function override_billing_checkout_fields( $fields ) {
		$first_name_placeholder = $fields['billing']['billing_first_name']['label'];
		$last_name_placeholder = $fields['billing']['billing_last_name']['label'];
		$email_placeholder = $fields['billing']['billing_email']['label'];
		$phone_placeholder = $fields['billing']['billing_phone']['label'];
		$city_placeholder = $fields['billing']['billing_city']['label'];
		$zip_placeholder = $fields['billing']['billing_postcode']['label'];


		$fields['billing']['billing_first_name']['placeholder'] = $first_name_placeholder;
    $fields['billing']['billing_last_name']['placeholder'] = $last_name_placeholder;
    $fields['billing']['billing_email']['placeholder'] = $email_placeholder;
    $fields['billing']['billing_phone']['placeholder'] = $phone_placeholder;
    $fields['billing']['billing_city']['placeholder'] = $city_placeholder;
    $fields['billing']['billing_postcode']['placeholder'] = $zip_placeholder;


		// $fields['order']['order_comments'];

    return $fields;
}


add_action( 'woocommerce_before_shop_loop_item_title', 'agada_woocommerce_shop_loop_item_title' );
function agada_woocommerce_shop_loop_item_title() {
    // echo '<h2>test</h2>';
		global $product;

		$metal = esc_attr($product->get_attribute( 'metal' ));
		$metal_array = explode(',',$metal);
		




			if($metal) {
				$content = '<div>';
				$content .= '
				<ul role="radiogroup" aria-label="Metal" class="variable-items-wrapper color-variable-items-wrapper wvs-style-rounded custom-color-swatch-buttons" >';

				foreach($metal_array as $metal_att) {
					$metal_att_short =  str_replace(" ","-",strtolower(trim($metal_att)));

					$content .= '<li aria-checked="false" tabindex="-1" data-wvstooltip="'.$metal_att.'" class="variable-item color-variable-item color-variable-item-'.$metal_att_short.'" title="'.$metal_att.'" data-title="'.$metal_att.'" role="radio">
					</li>';

				}
				$content .= '</ul></div>';
				echo $content;
			}

}




add_filter('gettext', 'agada_change_relatedproducts_text', 10, 3);

function agada_change_relatedproducts_text($new_text, $related_text, $source)
{
     if ($related_text === 'Related products' && $source === 'woocommerce') {
         $new_text = esc_html__('Shop similar rings', $source);
     }
     return $new_text;
}

/**
 * Remove product content based on category
 */
add_action( 'wp', 'agada_remove_product_content' );
function agada_remove_product_content() {

	$diamonds_cat =  array( 81, 83, 86, 88 );
	if ( is_product() && has_term( $diamonds_cat, 'product_cat') ) {
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	}
}


// add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
// 	return array(
// 	'width' => 400,
// 	'height' => 400,
// 	'crop' => 0,
// 	);
// 	} );




/**
 * Processing filter requests - jewelry template
 */

add_action('wp_ajax_agada_filter_products', 'agada_filter_products'); 
add_action('wp_ajax_nopriv_agada_filter_products', 'agada_filter_products');

function agada_filter_products() {

	// Tax query
	$tax_query = array(
		'relation' => 'AND',

		array(
			'taxonomy'      => 'product_cat',
			'field' 				=> 'term_id', //This is optional, as it defaults to 'term_id'
			'terms'         =>  array( 443, 569, 504, 542 ), // Filtering jewelry category
			'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
		),

	);


	if( isset( $_POST['type'] ) )
	array_push($tax_query, 
			array(
			'taxonomy' => 'product_cat',
			'field'     => 'slug',
			'terms' => $_POST['type'],
			'operator'      => 'IN'
		)
	);


if( isset( $_POST['metal'] )) {

array_push($tax_query, 
	array(
		'taxonomy' => 'pa_metal',
		'field'     => 'slug',
		'terms' => $_POST['metal'],
		'operator'      => 'IN'
	)
);
}


if( isset( $_POST['gemstone'] )) {

array_push($tax_query, 
	array(
		'taxonomy' => 'pa_jewelry-gemstone',
		'field'     => 'slug',
		'terms' => $_POST['gemstone'],
		'operator'      => 'IN'
	)
);
}


	// Meta query
	$meta_query = array(
		'relation' => 'AND',
	);


	if( isset( $_POST['priceMin'] ) && isset( $_POST['priceMax'] ))
	array_push($meta_query, 
		array(
			'key' => '_price',
			'value' => array(floatval($_POST['priceMin'] ), floatval($_POST['priceMax'] )),
			'compare' => 'BETWEEN',
			'type' => 'NUMERIC',

		)
	);



	
	// Sorting

	if( isset( $_POST['sorting'] )) {

		switch ($_POST['sorting']) {

			case "jewelry__sorting--b":
				// unset($args['meta_key']);
				// unset($args['orderby']);
				// unset($args['order']);
				break;

			case "jewelry__sorting--phl":
				$meta_key = '_price';
				$orderby = 'meta_value_num';
				$order = 'DESC';
				break;

			case "jewelry__sorting--plh":
				$meta_key = '_price';
				$orderby = 'meta_value_num';
				$order = 'ASC';
				break;

			case "jewelry__sorting--f":
				// unset($args['meta_key']);
				// unset($args['orderby']);
				// unset($args['order']);

				array_push($tax_query, 
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'featured',
					'operator' => 'IN', // or 'NOT IN' to exclude feature products
				)
			);
				break;
	}
}



	//Main args
	$args = array(
		'post_type' 		 =>  'product',
		'post_status'    => 'publish',
		'posts_per_page' => 18,
		'paged' => $_POST['page'],
		'tax_query' 		=> $tax_query,
		'meta_query' => $meta_query,
		'meta_key' => $meta_key,
		'orderby' => $orderby,
		'order' => $order,


	);


		$result = array();
		$total_featured = 0;

		$wc_query = new WP_Query($args); 

		if ($wc_query->have_posts()) : 
		while ($wc_query->have_posts()) : 
		$wc_query->the_post(); 

		global $product;

		if ($product->is_featured()) $total_featured++;

		$metal = esc_attr($product->get_attribute( 'metal' ));
		$metal_array = explode(',',$metal);
		$metal_array = array_filter($metal_array, fn($value) => !is_null($value) && $value !== '');
		// $metal_final_array = array();

		// foreach($metal_array as $metal) {
		// 	if($metal !== '') {
		// 		array_push($metal_final_array, str_replace(" ","-",strtolower(trim($metal))));
		// 	}
		// }
		

		array_push($result, array(
			'title' => $product->get_name(),
			'permalink' => $product->get_permalink(),
			'price' => $product->get_price(),
			'image' => get_the_post_thumbnail_url($product->get_id()),
			'metal' => $metal_array,
			'featured' => $product->is_featured(),

		));

		endwhile;

		$total_pages = $wc_query->max_num_pages;
		$current_page = $args["paged"];
		$total_count = $wc_query->found_posts;
		// $total_featured = $wc_query->get_featured();

		wp_reset_postdata(); 
		// _e( 'No Products' ); 

		endif; 

		// echo json_encode(array($current_page, $total_pages));
		header('Content-Type: application/json');
		header('current_page:'. $current_page);
		header('total_pages:'. $total_pages);
		header('total_products:'. $total_count);
		header('total_featured:'. $total_featured);
		// header('x-wp-totalpages $total_pages');
		echo json_encode($result);

	die();
	

}


/**
 * Update Cart Automatically on Quantity Change
 *
 * @author Misha Rudrastyh
 * @url https://rudrastyh.com/woocommerce/remove-update-cart-button.html
 */


// add_action( 'wp_footer', function() {
	

add_action( 'wp_head', function() {

		?><style>
		.woocommerce button[name="update_cart"],
		.woocommerce input[name="update_cart"] {
			display: none;
		}</style><?php
		
	} );



add_action( 'wp_footer', 'ts_quantity_plus_minus' );
 
function ts_quantity_plus_minus() {
   // To run this on the single product page
   if ( ! is_cart() ) return;
   ?>
	 
  <script type="text/javascript">
		

		jQuery(document).ready(function ($) {

			//Init
			qtyButtons();
			timeoutQty();
			makeInputReadOnly();

			//Make number input readonly
			function makeInputReadOnly() {
				let qtyFields = $("input.qty");

				qtyFields.each(function() {
					$(this).prop("readonly", true);
				})

			}

			//Update cart on input q-ty change
			function timeoutQty() {

				let timeout;

				$('.woocommerce-cart-form').on('change', 'input.qty', function(){
				// console.log('change');

				if ( timeout !== undefined ) {
					clearTimeout( timeout );
				}
				timeout = setTimeout(function() {
					$("[name='update_cart']").trigger("click"); // trigger cart update
				}, 500 ); // 1 second delay, half a second (500) seems comfortable too
				});
			}
			
			//Repeat scripts after cart total updates
			$( document.body ).on( 'updated_cart_totals', function() {
				qtyButtons();
				timeoutQty();
				makeInputReadOnly();
			});

			//Script for button actions
		function qtyButtons() {
			$(".woocommerce-cart-form").on(
					"click",
					".qty-button-wrapper button.plus, .qty-button-wrapper button.minus",
					updateQuantity
				);
		}

		
		// Action on button click
		function updateQuantity() {
			// console.log('change');
        // Get current quantity values
        let qty = $(this).parents(".product-quantity").find(".qty");
        let val = parseFloat(qty.val());
        let max = parseFloat(qty.attr("max"));
        let min = parseFloat(qty.attr("min"));
        let step = parseFloat(qty.attr("step"));

        // Change the value if plus or minus
        if ($(this).is(".plus")) {
          
          if (max && max <= val) {
            qty.val(max);
          } else {
            qty.val(val + step);
          }
					qty.trigger("change");
        } else {
          if (min && min >= val) {
            qty.val(min);
          } else if (val > 0) {
            qty.val(val - step);
          }
					qty.trigger("change");
        }
      }
  });
	</script>

   <?php
		}