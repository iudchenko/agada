<?php
  $shop = get_option( 'woocommerce_shop_page_id' ); 
  $banner_desktop = get_field('banner_1_desktop', $shop);
  $banner_mobile = get_field('banner_1_mobile', $shop);
?>

<style>
  .shop-banner {
    background: url("<?php echo esc_url($banner_desktop); ?>") center right/cover no-repeat;
  }

  @media screen and (max-width: 600px) {
  .shop-banner {
    background: url("<?php echo esc_url($banner_mobile); ?>") center center/cover no-repeat;
  }
  }
</style>

<section class="shop-banner">
  <div class="container">
    <div class="shop-banner__content">
      <h1 class="shop-banner__title">Lab-Grown Diamonds</h1>
      <p class="shop-banner__desc">We care about the environment and do not harm nature. Our diamonds are lab-grown, but their properties do not differ and even surpass natural diamonds. Shop a diamond according to your taste, shape, and size.</p>
      <a href="<?php echo esc_url(get_permalink(wc_get_page_id( 'shop' ))); ?>" class="shop-banner__btn btn-link btn-link--white">Shop All Diamonds</a>
    </div>
  </div>
</section>