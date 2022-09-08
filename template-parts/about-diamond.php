<?php

global $product;

$carat = esc_attr(get_field('carat'));
$cut = esc_attr($product->get_attribute( 'cut' ));
$color = esc_attr(get_field('color'));
$clarity = esc_attr(get_field('clarity'));
$post_en = pll_get_post(get_the_ID(), 'en');
$product_en = wc_get_product( $post_en );
$cut_en = esc_attr($product_en->get_attribute( 'cut' ));
?>


<section class="about-diamond container">
  <h2 class="about-diamond__subtitle"><?php _e('About your diamond', 'agada');?></h2>
  <div class="about-diamond__wrapper">

    <div class="about-diamond__item">
      <h3><?php if($carat) echo __('Diamond Size', 'agada') . ':&nbsp;' . $carat . '&nbsp;'. __('Ct', 'agada'); ?></h3>
      <p class="about-diamond__p"><?php _e('The carat is the unit of weight of a diamond. Carat is often confused with size even though it is actually a measure of weight. One carat equals 200 milligrams or 0.2 grams. The scale below illustrates the typical size relationship between diamonds of increasing carat weights. Remember that while the measurements below are typical, every diamond is unique.', 'agada'); ?></p>
      <a class="about-diamond__link" id="learn-more-carat"><?php _e('Learn More', 'agada');?></a>
      <div class="about-diamond__carat-slider" id="carat-slider">

        <div class="about-diamond__diamond-sizes">
          <div class="about-diamond__diamond-size--1"></div>
        </div>
        <div class="about-diamond__diamond-sizes">
          <div class="about-diamond__diamond-sizes about-diamond__diamond-size--2"></div>
        </div>
        <div class="about-diamond__diamond-sizes">
          <div class="about-diamond__diamond-sizes about-diamond__diamond-size--3"></div>
        </div>
        <div class="about-diamond__diamond-sizes">
          <div class="about-diamond__diamond-sizes about-diamond__diamond-size--4"></div>
        </div>
        <div class="about-diamond__diamond-sizes">
          <div class="about-diamond__diamond-sizes about-diamond__diamond-size--5"></div>
        </div>
        <div class="about-diamond__diamond-sizes">
         <div class="about-diamond__diamond-sizes about-diamond__diamond-size--6"></div>
        </div>
        <div class="about-diamond__diamond-sizes">
          <div class="about-diamond__diamond-sizes about-diamond__diamond-size--7"></div>
        </div>
        <div class="about-diamond__diamond-sizes">
          <div class="about-diamond__diamond-sizes about-diamond__diamond-size--8"></div>
        </div>
        <div class="about-diamond__marker marker" id="carat-marker" data-carat="<?php echo $carat; ?>">
          <span class="marker__info">Your Diamond<br><?php echo $carat; ?> Ct</span>
          <span class="marker__line-1"></span>
          <span class="marker__line-2"></span>
          <span class="marker__ellipse"></span>
        </div>
      </div>

      <div class="about-diamond__carat-info">
        <div class="about-diamond__carat-info--1">
        0.25 Ct<br>(4.1 mm)
        </div>
        <div class="about-diamond__carat-info--2">
        0.5 Ct<br>(5.1 mm)
        </div>
        <div class="about-diamond__carat-info--3">
        0.75 Ct<br>(5.8 mm)
        </div>
        <div class="about-diamond__carat-info--4">
        1 Ct<br>(6.4 mm)
        </div>
        <div class="about-diamond__carat-info--5">
        1.25 Ct<br>(6.9 mm)
        </div>
        <div class="about-diamond__carat-info--6">
        1.5 Ct<br>(7.4 mm)
        </div>
        <div class="about-diamond__carat-info--7">
        1.75 Ct<br>(7.8 mm)
        </div>
        <div class="about-diamond__carat-info--8">
        2 Ct+<br>(8.1 mm)
        </div>
      </div>

    </div>

    <div class="about-diamond__item">
      <h3><?php if($cut) echo __('Cut', 'agada') . ':&nbsp;' . $cut; ?></h3>
      <p class="about-diamond__p"><?php _e('The cut refers to the angles and proportions of a diamond. The cut of a diamond - its form and finish, its depth and width, the uniformity of the facets - determines its beauty. The skill with which a diamond is cut determines how well it reflects and refracts light.', 'agada'); ?></p>
      <a class="about-diamond__link" id="learn-more-cut"><?php _e('Learn More', 'agada');?></a>

      <div class="cut-legend__wrapper graph-chart__wrapper">
        <div id="cut-legend" class="graph-chart__legend" data-cut="<?php echo $cut_en; ?>">
          <p><strong>Super Ideal</strong><br>
  Cut to the most exacting standards. These diamonds have the most desirable dimensions and are proportioned to return the maximum possible light.</p>
          <span class="graph-chart__triangle"></span>
        </div>
      </div>
      
      <div class="cut-chart graph-chart">
        <div class="cut-chart--1">Poor</div>
        <div class="cut-chart--2">Fair</div>
        <div class="cut-chart--3">Good</div>
        <div class="cut-chart--4">Very Good</div>
        <div class="cut-chart--5">Ideal</div>
        <div class="cut-chart--5">Super Ideal</div>

      </div>
    </div>






    <div class="about-diamond__item">
      <h3><?php if($color) echo __('Color', 'agada') . ':&nbsp;' . $color; ?></h3>
      <p class="about-diamond__p"><?php _e('Color is the natural color visible in a diamond and does not change over time. Colorless diamonds allow more light to pass through than a colored diamond, releasing more sparkle and fire. Acting as a prism, a diamond divides light into a spectrum of colors and reflects this light as colorful flashes called fire.', 'agada'); ?></p>
      <a class="about-diamond__link" id="learn-more-color"><?php _e('Learn More', 'agada');?></a>

      <div class="color-legend__wrapper graph-chart__wrapper">
        <div id="color-legend" class="graph-chart__legend" data-color="<?php echo $color; ?>">
          <p><strong>D: Absolutely Colorless Or Icy White</strong><br>
  The highest color grade-- extremely rare and most expensive.</p>
          <span class="graph-chart__triangle"></span>
        </div>
      </div>
      <div class="color-chart__scale"></div>
      
      <div class="about-diamond__color-chart color-chart">
        <div class="color-chart--1">Colorless<br>D - F</div>
        <div class="color-chart--2">Near colorless<br>G - J</div>
        <div class="color-chart--3">Noticeable color<br>K - Z</div>

      </div>

    </div>

    <div class="about-diamond__item">
      <h3><?php if($clarity) echo __('Clarity', 'agada') . ':&nbsp;' . $clarity; ?></h3>
      <p class="about-diamond__p"><?php _e('A diamond\'s clarity refers to the presence of impurities on and within the stone. When a rough stone is extracted from carbon deep beneath the earth, tiny traces of natural elements are almost always trapped inside and are called inclusions.', 'agada'); ?></p>
      <a class="about-diamond__link" id="learn-more-clarity"><?php _e('Learn More', 'agada');?></a>


      <div class="clarity-legend__wrapper graph-chart__wrapper">
      <div id="clarity-legend" class="graph-chart__legend" data-clarity="<?php echo $clarity; ?>">
        <p><strong>VS2</strong><br>
Very slightly included 2. Difficult to see inclusions under 10x magnification. Typically cannot see inclusions with the naked eye. Slightly more inclusions than VS1.</p>
        <span class="graph-chart__triangle"></span>
      </div>
</div>
      
      <div class="about-diamond__clarity-chart graph-chart">
        <div class="clarity-chart--1">I1, I2, I3<br>Included</div>
        <div class="clarity-chart--2">SI1, SI2<br>Slightly Included</div>
        <div class="clarity-chart--3">VS1, VS2 <br>Very Slightly Included</div>
        <div class="clarity-chart--4">VVS1, VVS2 <br>Very Very Slightly Included</div>
        <div class="clarity-chart--5">IF <br>Internally Flawless</div>
        <div class="clarity-chart--5">FL <br>Flawless</div>

      </div>


    </div>

  </div>
</section>