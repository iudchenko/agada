<?php
global $product;
?>

<section class="compare-diamonds">
  <div class="container">
    <h2 class="compare-diamonds__title">Compare Similar Diamonds</h2>

  <table>
    <thead>
      <tr>
        <th></th>
        <th>
          <h4>Current Diamond</h4>
          <?php echo $product->get_image(); ?>
        </th>
        <th>
          <h4>Less Sparkle</h4>
          <img 
					src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/product-page/compare-diamonds/example-1.jpg';?>' 
					alt='compare-diamonds-img' 
					class="compare-diamonds-img"
				>
      
        </th>
        <th>
          <h4>More Inclusions</h4>
          <img 
            src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/product-page/compare-diamonds/example-2.jpg';?>' 
            alt='compare-diamonds-img' 
            class="compare-diamonds-img"
          >
        </th>
        <th>
          <h4>Fewer Inclusions</h4>
          <img 
            src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/product-page/compare-diamonds/example-3.jpg';?>' 
            alt='compare-diamonds-img' 
            class="compare-diamonds-img"
          >
      </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Price</td>
        <td>$400</td>
        <td>$370</td>
        <td>$370</td>
        <td>$420</td>
      </tr>
      <tr>
        <td>Difference</td>
        <td></td>
        <td>-$30</td>
        <td>-$30</td>
        <td>+$20</td>
      </tr>
      <tr>
        <td>Shape</td>
        <td>Pear</td>
        <td>Pear</td>
        <td>Pear</td>
        <td>Pear</td>
      </tr>
      <tr>
        <td>Carat</td>
        <td>0.32</td>
        <td>0.29</td>
        <td>0.31</td>
        <td>0.3</td>
      </tr>
      <tr>
        <td>Cut</td>
        <td>Super Ideal</td>
        <td>Very Good</td>
        <td>Super Ideal</td>
        <td>Super Ideal</td>
      </tr>
      <tr>
        <td>Color</td>
        <td>D</td>
        <td>D</td>
        <td>D</td>
        <td>D</td>
      </tr>
      <tr>
        <td>Clarity</td>
        <td>VS2</td>
        <td>VS2</td>
        <td>SI2</td>
        <td>VVS2</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td>View</td>
        <td>View</td>
        <td>View</td>
      </tr>
    </tbody>
  </table>
  </div>

</section>
