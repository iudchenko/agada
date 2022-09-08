<?php 
/* Template Name: Jewelry Template 
*/ 


get_header();


?>

	<main id="primary" class="site-main jewelry">
	
			<?php get_template_part( 'template-parts/custom-breadcrumbs' ); ?>

			<h1 class="jewelry__title"><?php _e('Jewelry', 'agada');?></h1>

			<section class="jewelry__section container">
				<div class="jewelry__filters">

				<div class="jewelry__back"><span>Go back</span></div>

					<div class="filter filters__type">
								<h3 class="filters__title"><?php _e('Jewelry type', 'agada');?></h3>

								<fieldset>

									<div>    
										<input id="jrings" type="checkbox" name="jrings" value="rings"> 
										<label for="jrings">
											<img 
												src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/jewelry/jewelry-filters/rings.svg';?>' 
												alt='agada-jewelry-type-rings' 
												class="filters__img"
											>
											<?php _e('Rings', 'agada');?>
										</label>
									</div>     

									<div>    
										<input id="jearrings" type="checkbox" name="jearrings" value="earrings"> 
										<label for="jearrings">
											<img 
												src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/jewelry/jewelry-filters/earrings.svg';?>' 
												alt='agada-jewelry-type-earrings' 
												class="filters__img"
											>
											<?php _e('Earrings', 'agada');?>
										</label>
									</div>     

									<div>    
										<input id="jnecklaces-1" type="checkbox" name="jnecklaces-1" value="necklaces"> 
										<label for="jnecklaces-1">
											<img 
												src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/jewelry/jewelry-filters/necklaces-1.svg';?>' 
												alt='agada-jewelry-type-necklaces' 
												class="filters__img"
											>
											<?php _e('Necklaces', 'agada');?>
										</label>
									</div>     

									<div>    
										<input id="jbracelets" type="checkbox" name="jbracelets" value="bracelets"> 
										<label for="jbracelets">
											<img 
												src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/jewelry/jewelry-filters/bracelets-1.svg';?>' 
												alt='agada-jewelry-type-bracelets' 
												class="filters__img"
											>
											<?php _e('Bracelets', 'agada');?>
										</label>
									</div>     

									<div>    
										<input id="jnecklaces-2" type="checkbox" name="jnecklaces-2" value="necklaces-medallions"> 
										<label for="jnecklaces-2">
											<img 
												src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/jewelry/jewelry-filters/necklaces-2.svg';?>' 
												alt='agada-jewelry-type-necklaces' 
												class="filters__img"
											>
											<?php _e('Necklaces', 'agada');?>
										</label>
									</div>     

									<div>    
										<input id="jbracelets-2" type="checkbox" name="jbracelets-2" value="cuff-bracelets"> 
										<label for="jbracelets-2">
											<img 
												src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/jewelry/jewelry-filters/bracelets-2.svg';?>' 
												alt='agada-jewelry-type-bracelets' 
												class="filters__img"
											>
											<?php _e('Bracelets', 'agada');?>
										</label>
									</div>     
					
								</fieldset> 
							
					</div>
					
					<div class="filter filters__price">
							<h3 class="filters__title"><?php _e('Price', 'agada');?></h3>

								<div class="slider-range-wrapper">

									<div class="slider-range-container">
											<div class="slider-track" id="price-slider-track"></div>
											<input type="range" min="190" max="112920" value="190" id="price-slider-1">
											<input type="range" min="190" max="112920" value="112920" id="price-slider-2">
									</div>

									<div class="slider-range-values">
											<label><span class="currency-sign">$</span><input type="number" value="0" id="price-range-1"></label>
											<label><span class="currency-sign">$</span><input type="number" value="100" id="price-range-2"></label>
									</div>

								</div>
						
					</div>

					<div class="filter filters__metal">
						<h3 class="filters__title"><?php _e('Metal', 'agada');?></h3>
						<fieldset class="metal-fieldset">

							<?php
							
								if( $terms = get_terms( array(
									'taxonomy' => 'pa_metal', // to make it simple I use default categories
									// 'orderby' => 'name',
									'hide_empty' => false,
								) ) )  {

								$content = '';
								$content .= '
								<div role="radiogroup" aria-label="Metal" class="variable-items-wrapper color-variable-items-wrapper wvs-style-rounded custom-color-swatch-buttons metal-filters" >';
				
								foreach($terms as $term) {
									$content .= '<label>';
									$content .= '<input id="' . $term->slug . '" type="checkbox" name="' . $term->name . '" value="' . $term->name . '">';
									$content .= '<span aria-checked="false" tabindex="-1" class="variable-item color-variable-item color-variable-item-'.$term->slug.'" title="'.$term->name.'" data-title="'.$term->name.'" role="radio">
									</span>';
									$content .= '<span>'.$term->name.'</span>';
									$content .= '</label>';
				
								}
									
				
								$content .= '</div>';

								echo $content;
											}
							?>


							</fieldset>
					</div>

					<div class="filter filters__gemstone">
							<h3 class="filters__title"><?php _e('Gemstone', 'agada');?></h3>

							<fieldset class="gemstone-fieldset">

							<?php
								if( $terms = get_terms( array(
									'taxonomy' => 'pa_jewelry-gemstone', // to make it simple I use default categories
									'orderby' => 'name',
									'hide_empty' => false,
								) ) ) : 
								// if categories exist, display the dropdown
					
								foreach ( $terms as $term ) :
									echo '<label for="' . $term->slug . '" class="checkmark-container">
									'. $term->name .'
									<input id="' . $term->slug . '" type="checkbox" name="' . $term->name . '" value="' . $term->name . '"> 
									<span class="checkmark"></span>
								</label>';

								endforeach;
		
								endif;
							?>


							</fieldset>

					</div>

					<div class="jewelry__mobile-btn"><button><?php _e('Filter', 'agada'); ?></button></div>


				</div>


				<div class="jewelry__results">

				<!-- Mobile filtering and sorting -->
				<div class="jewelry__mobile-btns">
					<div class="jewelry__mobile-filtering"><span><?php _e('Filters', 'agada');?></span></div>
					<div class="jewelry__mobile-sorting">
						
					<label for="sortby-mob"><?php _e('Sort by:', 'agada');?>
					</label>
							<select name="sortby" id="sortby-mob" class="sortby jewelry__mobile-sorting--list hidden">
								<option class="jewelry__sorting--b" value="jewelry__sorting--b"><?php _e('Bestsellers', 'agada');?></option>
								<option class="jewelry__sorting--plh" value="jewelry__sorting--plh"><?php _e('Price low to high', 'agada');?></option>
								<option class="jewelry__sorting--phl" value="jewelry__sorting--phl"><?php _e('Price high to low', 'agada');?></option>
								<option class="jewelry__sorting--f" value="jewelry__sorting--f"><?php _e('Featured', 'agada');?></option>
							</select>

					

					</div>
				</div>

				
					<!-- Sorting and results count -->
					<div class="jewelry__loop-header">
						<div class="jewelry__count">
							<span></span>&nbsp;<?php _e("Results", "agada"); ?>
						</div>
						<div class="jewelry__sorting">
						<span><?php _e("Sort by:", "agada"); ?></span>
						<select name="sortby" class="sortby">
							<option class="jewelry__sorting--b" value="jewelry__sorting--b"><?php _e('Bestsellers', 'agada');?></option>
							<option class="jewelry__sorting--plh" value="jewelry__sorting--plh"><?php _e('Price low to high', 'agada');?></option>
							<option class="jewelry__sorting--phl" value="jewelry__sorting--phl"><?php _e('Price high to low', 'agada');?></option>
							<option class="jewelry__sorting--f" value="jewelry__sorting--f"><?php _e('Featured', 'agada');?></option>
						</select>
						</div>
					</div>
					<!-- Loading icon -->
					<div class="loader hidden">

						<img src="<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/loader.svg';?>" width="64" height="64" alt="loader" />

					</div>

					<div class="jewelry__loop">
							
					</div>

					
				</div>
	
			</section>
		

		<?php get_template_part( 'template-parts/benefits' ); ?>
	</main><!-- #main -->

<?php

get_footer();
