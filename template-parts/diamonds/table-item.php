<?php

$args = array(
    // arguments for your query
    'post_type' 		 =>  'product',
    'post_status'    => 'publish',
    'posts_per_page' =>  40,
    'order'          =>  'ASC',
    'tax_query'      => array(
      array(
          'taxonomy'      => 'product_cat',
          'field' => 'term_id', //This is optional, as it defaults to 'term_id'
          'terms'         => array( 81, 83, 86, 88 ),
          'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
      )
      )
    );

// the query
$products = new WP_Query( $args );

// The Loop
if ( $products->have_posts() ) :  while ( $products->have_posts() ) : $products->the_post() ;

global $product;

//Variables
// $sku = esc_attr($product->get_sku());
$name = esc_attr($product->get_name());
$price = esc_attr($product->get_price());
$link = esc_url(get_permalink( $product->get_id() ));
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


  // contents of the Loop go here
  ?>


<div class="table__item">

  <div class="table__row">
    <div class="table__data table__data--view">
      <?php 
      $post_en = pll_get_post(get_the_ID(), 'en');
      $product_en = wc_get_product( $post_en );
      $shape_en = esc_attr($product_en->get_attribute( 'shape' ));
      $shape_icon;
      
      switch ($shape_en) {

        case 'Asscher':
          $shape_icon = '/wp-content/themes/agada/img/diamonds/table/diamond-icons/asscher.svg';
          break;

        case 'Baguette':
          $shape_icon = '/wp-content/themes/agada/img/diamonds/table/diamond-icons/baguette.svg';
          break;

        case 'Cushion':
          $shape_icon = '/wp-content/themes/agada/img/diamonds/table/diamond-icons/cushion.svg';
          break;

        case 'Emerald':
          $shape_icon = '/wp-content/themes/agada/img/diamonds/table/diamond-icons/emerald.svg';
          break;

        case 'Heart':
          $shape_icon = '/wp-content/themes/agada/img/diamonds/table/diamond-icons/heart.svg';
          break;

        case 'Marquise':
          $shape_icon = '/wp-content/themes/agada/img/diamonds/table/diamond-icons/marquise.svg';
          break;

        case 'Oval':
          $shape_icon = '/wp-content/themes/agada/img/diamonds/table/diamond-icons/oval.svg';
          break;

        case 'Oval':
          $shape_icon = '/wp-content/themes/agada/img/diamonds/table/diamond-icons/oval.svg';
          break;

        case 'Pear':
          $shape_icon = '/wp-content/themes/agada/img/diamonds/table/diamond-icons/pear.svg';
          break;

        case 'Princess':
          $shape_icon = '/wp-content/themes/agada/img/diamonds/table/diamond-icons/princess.svg';
          break;

        case 'Radiant':
          $shape_icon = '/wp-content/themes/agada/img/diamonds/table/diamond-icons/radiant.svg';
          break;

        case 'Round':
          $shape_icon = '/wp-content/themes/agada/img/diamonds/table/diamond-icons/round.svg';
          break;

        case 'Taper':
          $shape_icon = '/wp-content/themes/agada/img/diamonds/table/diamond-icons/taper.svg';
          break;

        case 'Trapezoid':
          $shape_icon = '/wp-content/themes/agada/img/diamonds/table/diamond-icons/trapezoid.svg';
          break;

        case 'Triangle':
          $shape_icon = '/wp-content/themes/agada/img/diamonds/table/diamond-icons/triangle.svg';
          break;

    }

      ?>
      <img 
      src='<?php echo esc_url(get_site_url()) . $shape_icon;?>' 
      alt='agada-diamonds-table' 
      class="table__img diamond-icon"
    >
      <img 
      src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/table/video-icon.svg';?>' 
      alt='agada-diamonds-table' 
      class="table__img video-icon"
    >
      <img 
      src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/table/arrow-down.svg';?>' 
      alt='agada-diamonds-table' 
      class="table__img arrow-icon"
    >
    </div>
    <div class="table__data table__data--compare">

      <label class="checkmark-container">
        <input type="checkbox" name="compare" class="compare-checkbox"> 
        <span class="checkmark"></span>
      </label>

    </div>
    <div class="table__data table__data--shape"><?php if($shape) echo $shape; ?></div>
    <div class="table__data table__data--price">$<?php if($price) echo $price; ?></div>
    <div class="table__data table__data--carat"><?php if($carat) echo $carat; ?></div>
    <div class="table__data table__data--cut"><?php if($cut) echo $cut; ?></div>
    <div class="table__data table__data--color"><?php if($color) echo $color; ?></div>
    <div class="table__data table__data--clarity"><?php if($clarity) echo $clarity; ?></div>
    <div class="table__data table__data--report"><?php if($report) echo $report; ?></div>
  </div>	

  <div class="table__tab tab hidden">
    <div class="tab__img">
      <img 
          src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/table/360-image.jpg';?>' 
          alt='agada-diamonds-table' 
          class="tab__img"
        >
    </div>
    <div class="tab__content">
      <h3 class="tab__title"><?php if($name) echo $name; ?></h3>
      <div class="tab__details">
        <div class="tab__info">
          <p class="tab__info--price">$<span><?php if($price) echo $price; ?></span></p>
          <p class="tab__info--carat"><?php _e('Carat:', 'agada');?>&nbsp;<span><?php if($carat) echo $carat; ?></span></p>
          <p class="tab__info--cut"><?php if($cut_label) echo $cut_label; ?>:&nbsp;<span><?php if($cut) echo $cut; ?></span></p>
          <p class="tab__info--color"><?php _e('Color:', 'agada');?>&nbsp;<span><?php if($color) echo $color; ?></span></p>
          <p class="tab__info--clarity"><?php _e('Clarity:', 'agada');?>&nbsp;<span><?php if($clarity) echo $clarity; ?></span></p>
          <p class="tab__info--additional"><span><?php _e('Additional Details: ', 'agada');?></span>
            <span>
              <img 
              src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/table/add-arrow.svg';?>' 
              alt='agada-diamonds-details' 
              class="tab__info--arrow"
              >
            </span>
          </p>
          

        </div>
        <div class="tab__link">
          <a href="<?php echo $link; ?>" class="tab__btn"><?php _e('View Diamond', 'agada');?></a>
        </div>
      </div>
      <div class="tab__add-details hidden">
      <div class="tab__info--grid">
            <div class="tab__info--lw"><?php _e('L:W:', 'agada');?>&nbsp;<br><span><?php if($lwratio) echo $lwratio; ?></span></div>
            <div class="tab__info--fluor"><?php if($fluor_label) echo $fluor_label; ?>:&nbsp;<br><span><?php if($fluor) echo $fluor; ?></span></div>
            <div class="tab__info--sym"><?php if($symmetry_label) echo $symmetry_label; ?>:&nbsp;<br><span><?php if($symmetry) echo $symmetry; ?></span></div>
            <div class="tab__info--table"><?php _e('Table:', 'agada');?>&nbsp;<br><span><?php if($table) echo $table; ?>%</span></div>
            <div class="tab__info--origin"><?php if($origin_label) echo $origin_label; ?>:&nbsp;<br><span><?php if($origin) echo $origin; ?></span></div>
            <div class="tab__info--meas"><?php _e('Measurements: ', 'agada');?>&nbsp;<br><span><?php if($length && $width && $height) printf( __( '%1smm x %2smm x %3smm', 'agada' ), $length, $width, $height );?>
            </span></div>
            <div class="tab__info--culet"><?php if($culet_label) echo $culet_label; ?>:&nbsp;<br><span><?php if($culet) echo $culet; ?></span></div>
            <div class="tab__info--polish"><?php if($polish_label) echo $polish_label; ?>:&nbsp;<br><span><?php if($polish) echo $polish; ?></span></div>
            <div class="tab__info--girdle"><?php if($girdle_label) echo $girdle_label; ?>:&nbsp;<br><span><?php if($girdle) echo $girdle; ?></span></div>
            <div class="tab__info--depth"><?php _e('Depth:', 'agada');?>&nbsp;<br><span><?php if($depth) echo $depth; ?>%</span></div>
            <div class="tab__info--report"><?php _e('Report:', 'agada');?>&nbsp;<br><span><?php if($report) echo $report; ?></span></div>
            <div class="tab__info--created"><?php _e('Lab Created Diamond Delivery:', 'agada');?>&nbsp;<br><span>Wednesday, May 18</span></div>
          </div>
      </div>
    </div>
  </div>
</div>

<?php
  endwhile; 
  endif;

  
/* Restore original Post Data */
wp_reset_postdata();
?>