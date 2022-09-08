<?php
?>

<section class="home-slider">
<!-- Slider main container -->
<div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">

      <?php
        $slides = new WP_Query(array(
          'posts_per_page' => -1,
          'post_type' => 'slide',
          'orderby' => 'name',
          'order' => 'ASC'
        ));
      
        while($slides->have_posts()) {
          $slides->the_post();
          
          $discount = get_field('discount');
          $slide_text = get_field('slide_text');
          $button_text = get_field('button_text');
          $button_link = get_field('button_link');
          $image_desktop = get_field('image_desktop');
          $image_mobile = get_field('image_mobile');
          
        ?>

        <!-- Slides -->
        <div class="swiper-slide swiper__slide <?php echo 'swiper__slide--'. get_the_ID(); ?> ">

          <picture>            
            <source srcset="<?php if($image_mobile) echo $image_mobile; ?>" media="(max-width: 600px)" />
            <source srcset="<?php if($image_desktop) echo $image_desktop; ?>" media="(min-width: 601px)" />
            <img src="<?php if($image_mobile) echo $image_mobile; ?>"  alt="agada-diamonds-sale" class="swiper-slider-image" />
          </picture>

          <div class="home-slider__content">
            <h2 class="home-slider__discount"><span><?php if($discount) echo $discount; ?></span><span>%</span><span>off</span></h2>
            <p class="home-slider__title"><?php if($slide_text) echo $slide_text; ?></p>
            <a class="home-slider__btn btn-link" href="<?php if($button_link) echo esc_url($button_link); ?>"><?php if($button_text) echo $button_text; ?></a>
          </div>

        </div>
      
          
      <?php
        }
      wp_reset_postdata();
      ?>

      </div>

    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination home-slider__pagination"></div>



</section>