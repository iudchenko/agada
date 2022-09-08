<?php
  $shop = get_option( 'woocommerce_shop_page_id' ); 
  $banner_desktop = get_field('banner_2_desktop', $shop);
  $banner_mobile = get_field('banner_2_mobile', $shop);
?>

<style>
  .featured-collection {
    background: url("<?php echo esc_url($banner_desktop); ?>") center right/cover no-repeat;
  }

  @media screen and (max-width: 600px) {
  .featured-collection {
    background: url("<?php echo esc_url($banner_mobile); ?>") center center/cover no-repeat;
  }
  }
</style>


<section class="featured-collection">
  <div class="container">
    <div class="featured-collection__content">
      <h2 class="featured-collection__title"><span>The</span><br>Butterfly <br>Collection</h2>
      <p class="featured-collection__desc">Inspired by the arrival of summer, we've created a stunning collection of butterflies with lab diamonds and enamel.</p>
      <a href="<?php echo esc_url(get_permalink(wc_get_page_id( 'shop' ))); ?>" class="featured-collection__btn btn-link btn-link--white">Shop The Collection</a>
    </div>
  </div>
</section>