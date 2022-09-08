<?php 
/* Template Name: Diamonds Template 
*/ 


get_header();


?>

	<main id="primary" class="site-main">
	
			<?php get_template_part( 'template-parts/custom-breadcrumbs' ); ?>

			<section class="lab-diamonds">
				<h1 class="lab-diamonds__title"><?php _e('Lab-Grown Diamonds', 'agada');?></h1>

				<div class="lab-diamonds__mobile-btns">
					<div class="lab-diamonds__mobile-filtering"><span><?php _e('Filters', 'agada');?></span></div>
					<div class="lab-diamonds__mobile-sorting"><span><?php _e('Sort by', 'agada');?></span>
					<ul class="lab-diamonds__mobile-sorting--list hidden">
						<li class="lab-diamonds__mobile-sorting--plh"><?php _e('Sort by price low to high', 'agada');?></li>
						<li class="lab-diamonds__mobile-sorting--phl"><?php _e('Sort by price high to low', 'agada');?></li>
						<li class="lab-diamonds__mobile-sorting--clh"><?php _e('Sort by carat low to high', 'agada');?></li>
						<li class="lab-diamonds__mobile-sorting--chl"><?php _e('Sort by carat high to low', 'agada');?></li>
						<li class="lab-diamonds__mobile-sorting--f"><?php _e('Sort featured', 'agada');?></li>
					</ul>				
					</div>
				</div>

				<div class="container">
					<div class="lab-diamonds__filters filters">
						<div class="lab-diamonds__back"><span>Go back</span></div>

						<div class="filter filters__shape">
							<h3 class="filters__title"><?php _e('Diamond Shape', 'agada');?></h3>

							<fieldset>

								<div>    
									<input id="dround" type="checkbox" name="dround" value="Round"> 
									<label for="dround">
										<img 
											src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/filters/round.svg';?>' 
											alt='agada-diamonds-shape-filters' 
											class="filters__img"
										>
										<?php _e('Round', 'agada');?>
									</label>
								</div>     
								
								<div>    
									<input id="doval" type="checkbox" name="doval" value="Oval"> 
									<label for="doval">
										<img 
											src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/filters/oval.svg';?>' 
											alt='agada-diamonds-shape-filters' 
											class="filters__img"
										>
										<?php _e('Oval', 'agada');?>
									</label>
								</div>  

								<div>    
									<input id="dcushion" type="checkbox" name="dcushion" value="Cushion"> 
									<label for="dcushion">
										<img 
											src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/filters/cushion.svg';?>' 
											alt='agada-diamonds-shape-filters' 
											class="filters__img"
										>
										<?php _e('Cushion', 'agada');?>
									</label>
								</div>     
								
								<div>    
									<input id="dprincess" type="checkbox" name="dprincess" value="Princess"> 
									<label for="dprincess">
										<img 
											src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/filters/princess.svg';?>' 
											alt='agada-diamonds-shape-filters' 
											class="filters__img"
										>
										<?php _e('Princess', 'agada');?>
									</label>
								</div>   

								<div>    
									<input id="dpear" type="checkbox" name="dpear" value="Pear"> 
									<label for="dpear">
										<img 
											src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/filters/pear.svg';?>' 
											alt='agada-diamonds-shape-filters' 
											class="filters__img"
										>
										<?php _e('Pear', 'agada');?>
									</label>
								</div>     
								
								<div>    
									<input id="demerald" type="checkbox" name="demerald" value="Emerald"> 
									<label for="demerald">
										<img 
											src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/filters/emerald.svg';?>' 
											alt='agada-diamonds-shape-filters' 
											class="filters__img"
										>
										<?php _e('Emerald', 'agada');?>
									</label>
								</div>     
								
								<div>    
									<input id="dmarquise" type="checkbox" name="dmarquise" value="Marquise"> 
									<label for="dmarquise">
										<img 
											src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/filters/marquise.svg';?>' 
											alt='agada-diamonds-shape-filters' 
											class="filters__img"
										>
										<?php _e('Marquise', 'agada');?>
									</label>
								</div>     
								
								<div>    
									<input id="dasscher" type="checkbox" name="dasscher" value="Asscher"> 
									<label for="dasscher">
										<img 
											src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/filters/asscher.svg';?>' 
											alt='agada-diamonds-shape-filters' 
											class="filters__img"
										>
										<?php _e('Asscher', 'agada');?>
									</label>
								</div>     
								
								<div>    
									<input id="dradiant" type="checkbox" name="dradiant" value="Radiant"> 
									<label for="dradiant">
										<img 
											src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/filters/radiant.svg';?>' 
											alt='agada-diamonds-shape-filters' 
											class="filters__img"
										>
										<?php _e('Radiant', 'agada');?>
									</label>
								</div>     
								
								<div>    
									<input id="dheart" type="checkbox" name="dheart" value="Heart"> 
									<label for="dheart">
										<img 
											src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/filters/heart.svg';?>' 
											alt='agada-diamonds-shape-filters' 
											class="filters__img"
										>
										<?php _e('Heart', 'agada');?>
									</label>
								</div>     
								
								<div>    
									<input id="dtrapezoid" type="checkbox" name="dtrapezoid" value="Trapezoid"> 
									<label for="dtrapezoid">
										<img 
											src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/filters/trapezoid.svg';?>' 
											alt='agada-diamonds-shape-filters' 
											class="filters__img"
										>
										<?php _e('Trapezoid', 'agada');?>
									</label>
								</div>     
								
								<div>    
									<input id="dbaguette" type="checkbox" name="dbaguette" value="Baguette"> 
									<label for="dbaguette">
										<img 
											src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/filters/baguette.svg';?>' 
											alt='agada-diamonds-shape-filters' 
											class="filters__img"
										>
										<?php _e('Baguette', 'agada');?>
									</label>
								</div>     
								
								<div>    
									<input id="dtriangle" type="checkbox" name="dtriangle" value="Triangle"> 
									<label for="dtriangle">
										<img 
											src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/filters/triangle.svg';?>' 
											alt='agada-diamonds-shape-filters' 
											class="filters__img"
										>
										<?php _e('Triangle', 'agada');?>
									</label>
								</div>     
								
								<div>    
									<input id="dtaper" type="checkbox" name="dtaper" value="Taper"> 
									<label for="dtaper">
										<img 
											src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/filters/taper.svg';?>' 
											alt='agada-diamonds-shape-filters' 
											class="filters__img"
										>
										<?php _e('Taper', 'agada');?>
									</label>
								</div>     
         
							</fieldset> 
						
						</div>

						<div class="filter filters__price">
							<h3 class="filters__title"><?php _e('Diamond Price', 'agada');?></h3>

								<div class="slider-range-wrapper">

									<div class="slider-range-container">
											<div class="slider-track" id="price-slider-track"></div>
											<input type="range" min="290" max="83961" value="290" id="price-slider-1">
											<input type="range" min="290" max="83961" value="83961" id="price-slider-2">
									</div>

									<div class="slider-range-values">
										
											<label><span class="currency-sign">$</span>
												<input type="number" value="0" id="price-range-1">
											</label>

											<label><span class="currency-sign">$</span>
												<input type="number" value="100" id="price-range-2">
											</label>

									</div>

								</div>
						
						</div>

						<div class="filter filters__carat">
							<h3 class="filters__title"><?php _e('Carat', 'agada');?></h3>

							<div class="slider-range-wrapper">
								<div class="slider-range-container">
										<div class="slider-track" id="carat-slider-track"></div>
										<input type="range" min="0" max="14.76" step="0.01" value="0" id="carat-slider-1">
										<input type="range" min="0" max="14.76" step="0.01" value="14.76" id="carat-slider-2">
								</div>

								<div class="slider-range-values">
										<label><input type="number" step="0.01" value="0.28" id="carat-range-1"></label>
										<label><input type="number" step="0.01" value="14.76" id="carat-range-2"></label>
								</div>

							</div>

						</div>

						<div class="filter filters__color">
							<h3 class="filters__title"><?php _e('Color', 'agada');?></h3>

							<div class="slider-range-wrapper">
								<div class="slider-range-container">
										<div class="slider-track" id="color-slider-track"></div>
										<input type="range" min="0" max="7" step="1" value="0" id="color-slider-1">
										<input type="range" min="0" max="7" step="1" value="7" id="color-slider-2">
									
										<div class="legend-container">
											<div>J</div>
											<div>I</div>
											<div>H</div>
											<div>G</div>
											<div>F</div>
											<div>E</div>
											<div>D</div>
										</div>
									
								</div>

							</div>
						</div>

						<div class="filter filters__cut">
							<h3 class="filters__title"><?php _e('Cut', 'agada');?></h3>
							<div class="slider-range-wrapper">
								<div class="slider-range-container">
										<div class="slider-track" id="cut-slider-track"></div>
										<input type="range" min="0" max="5" step="1" value="0" id="cut-slider-1">
										<input type="range" min="0" max="5" step="1" value="5" id="cut-slider-2">
									
											<div class="legend-container">
												<div><?php _e('Fair', 'agada');?></div>
												<div><?php _e('Good', 'agada');?></div>
												<div><?php _e('Very Good', 'agada');?></div>
												<div><?php _e('Ideal', 'agada');?></div>
												<div><?php _e('Excellent', 'agada');?></div>
											</div>
									
								</div>

							</div>
						</div>

						<div class="filter filters__clarity">
							<h3 class="filters__title"><?php _e('Clarity', 'agada');?></h3>

							<div class="slider-range-wrapper">
								<div class="slider-range-container">
										<div class="slider-track" id="clarity-slider-track"></div>
										<input type="range" min="0" max="8" step="1" value="0" id="clarity-slider-1">
										<input type="range" min="0" max="8" step="1" value="8" id="clarity-slider-2">
									
										<div class="legend-container">
											<div>SI2</div>
											<div>SI1</div>
											<div>VS2</div>
											<div>VS1</div>
											<div>VVS2</div>
											<div>VVS1</div>
											<div>IF</div>
											<div>FL</div>
										</div>
									
								</div>

							</div>

						</div>

						<div class="filter filters__report">
							<h3 class="filters__title"><?php _e('Report', 'agada');?></h3>
							<fieldset>

					   
								<label for="igi" class="checkmark-container">
									IGI
									<input id="igi" type="checkbox" name="igi" value="IGI"> 
									<span class="checkmark"></span>
								</label>

								<label for="gia" class="checkmark-container">
								GIA
									<input id="gia" type="checkbox" name="gia" value="GIA"> 
									<span class="checkmark"></span>
								</label>

								<label for="hrd" class="checkmark-container">
								HRD
									<input id="hrd" type="checkbox" name="hrd" value="HRD"> 
									<span class="checkmark"></span>
								</label>

								<label for="sgl" class="checkmark-container">
								SGL
									<input id="sgl" type="checkbox" name="sgl" value="SGL"> 
									<span class="checkmark"></span>
								</label>

							</fieldset>
						</div>

						<div class="filter filters__lw-ratio">
							<h3 class="filters__title"><?php _e('L:W Ratio', 'agada');?></h3>

							<div class="slider-range-wrapper">
								<div class="slider-range-container">
										<div class="slider-track" id="lw-ratio-slider-track"></div>
										<input type="range" min="0.00" max="2.75" step="0.01" value="0.00" id="lw-ratio-slider-1">
										<input type="range" min="0.00" max="2.75" step="0.01" value="14.76" id="lw-ratio-slider-2">
								</div>

								<div class="slider-range-values">
										<label><input type="number" step="1.00" value="2.75" id="lw-ratio-range-1"></label>
										<label><input type="number" step="1.00" value="2.75" id="lw-ratio-range-2"></label>
								</div>

							</div>

						</div>

						<div class="filter filters__polish">
							<h3 class="filters__title"><?php _e('Polish', 'agada');?></h3>

							<div class="slider-range-wrapper">
								<div class="slider-range-container">
										<div class="slider-track" id="polish-slider-track"></div>
										<input type="range" min="0" max="3" step="1" value="0" id="polish-slider-1">
										<input type="range" min="0" max="3" step="1" value="3" id="polish-slider-2">
									
										<div class="legend-container">
											<div><?php _e('Good', 'agada');?></div>
											<div><?php _e('Very Good', 'agada');?></div>
											<div><?php _e('Excellent', 'agada');?></div>
										</div>
									
								</div>

							</div>
						</div>

						<div class="filter filters__table">
							<h3 class="filters__title"><?php _e('Table', 'agada');?></h3>

							<div class="slider-range-wrapper">

								<div class="slider-range-container">
										<div class="slider-track" id="table-slider-track"></div>
										<input type="range" min="0" max="100" value="0" step="0.01" id="table-slider-1">
										<input type="range" min="0" max="100" value="100" step="0.01" id="table-slider-2">
								</div>

								<div class="slider-range-values">
										<label><span class="percentage-sign">%</span><input type="number" value="0" id="table-range-1"></label>
										<label><span class="percentage-sign">%</span><input type="number" value="100" id="table-range-2"></label>
								</div>

							</div>


						</div>

						<div class="filter filters__fluorescence">
							<h3 class="filters__title"><?php _e('Fluorescence', 'agada');?></h3>

							<div class="slider-range-wrapper">
								<div class="slider-range-container">
										<div class="slider-track" id="fluor-slider-track"></div>
										<input type="range" min="0" max="5" step="1" value="0" id="fluor-slider-1">
										<input type="range" min="0" max="5" step="1" value="5" id="fluor-slider-2">
									
										<div class="legend-container">
											<div><?php _e('Very Strong', 'agada');?></div>
											<div><?php _e('Strong', 'agada');?></div>
											<div><?php _e('Medium', 'agada');?></div>
											<div><?php _e('Faint', 'agada');?></div>
											<div><?php _e('None', 'agada');?></div>

										</div>
									
								</div>

							</div>

						</div>

						<div class="filter filters__symmetry">
							<h3 class="filters__title"><?php _e('Symmetry', 'agada');?></h3>

							<div class="slider-range-wrapper">
								<div class="slider-range-container">
										<div class="slider-track" id="symmetry-slider-track"></div>
										<input type="range" min="0" max="3" step="1" value="0" id="symmetry-slider-1">
										<input type="range" min="0" max="3" step="1" value="3" id="symmetry-slider-2">
									
										<div class="legend-container">
											<div><?php _e('Good', 'agada');?></div>
											<div><?php _e('Very Good', 'agada');?></div>
											<div><?php _e('Excellent', 'agada');?></div>
										</div>
									
								</div>

							</div>

						</div>

						<div class="filter filters__depth">
							<h3 class="filters__title"><?php _e('Depth', 'agada');?></h3>


							<div class="slider-range-wrapper">

								<div class="slider-range-container">
										<div class="slider-track" id="depth-slider-track"></div>
										<input type="range" min="0" max="100" value="0" step="0.01" id="depth-slider-1">
										<input type="range" min="0" max="100" value="100" step="0.01" id="depth-slider-2">
								</div>

								<div class="slider-range-values">
										<label><span class="percentage-sign">%</span><input type="number" value="0" id="depth-range-1"></label>
										<label><span class="percentage-sign">%</span><input type="number" value="100" id="depth-range-2"></label>
								</div>

							</div>

						</div>

						<div class="lab-diamonds__mobile-btn"><button><?php _e('Filter', 'agada'); ?></button></div>

					</div>


					<div class="lab-diamonds__results">
						<div class="lab-diamonds__btns">

							<button class="lab-diamonds__btn lab-diamonds__btn--all active">
							<?php _e('All diamonds', 'agada');?>&nbsp;(<span>0</span>)
							</button>

							<button class="lab-diamonds__btn lab-diamonds__btn--most">
							<?php _e('Most popular', 'agada');?>&nbsp;(<span>0</span>)
							</button>

							<button class="lab-diamonds__btn lab-diamonds__btn--compare">
							<?php _e('Compare', 'agada');?>&nbsp;(<span>0</span>)
							</button>

						</div>

						<div class="lab-diamonds__table table">

									<!-- Table head start -->
									<div class="table__head">
										<div class="table__head--view"><?php _e('Quick View', 'agada');?></div>
										<div class="table__head--compare"><?php _e('Compare', 'agada');?></div>
										<div class="table__head--shape"><?php _e('Shape', 'agada');?>
											<span class="table__sort"><img 
												src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/table/filter-arrow.svg';?>' 
												alt='agada-diamonds-table' 
												class="table__img arrow-icon"
											></span>
										</div>
										<div class="table__head--price"><?php _e('Price', 'agada');?>
										<span class="table__sort"><img 
												src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/table/filter-arrow.svg';?>' 
												alt='agada-diamonds-table' 
												class="table__img arrow-icon"
											></span>
										</div>
										<div class="table__head--carat"><?php _e('Carat', 'agada');?>
											<span class="table__sort"><img 
												src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/table/filter-arrow.svg';?>' 
												alt='agada-diamonds-table' 
												class="table__img arrow-icon"
											></span></div>
										<div class="table__head--cut"><?php _e('Cut', 'agada');?>
										<span class="table__sort"><img 
												src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/table/filter-arrow.svg';?>' 
												alt='agada-diamonds-table' 
												class="table__img arrow-icon"
											></span>
										</div>
										<div class="table__head--color"><?php _e('Color', 'agada');?>
										<span class="table__sort"><img 
												src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/table/filter-arrow.svg';?>' 
												alt='agada-diamonds-table' 
												class="table__img arrow-icon"
											></span>
										</div>
										<div class="table__head--clarity"><?php _e('Clarity', 'agada');?>
										<span class="table__sort"><img 
												src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/table/filter-arrow.svg';?>' 
												alt='agada-diamonds-table' 
												class="table__img arrow-icon"
											></span>
										</div>
										<div class="table__head--report"><?php _e('Report', 'agada');?>
										<span class="table__sort"><img 
												src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/table/filter-arrow.svg';?>' 
												alt='agada-diamonds-table' 
												class="table__img arrow-icon"
											></span>
										</div>
									</div>
									<!-- Table head end -->

								<!-- Loading icon -->
									<div class="loader hidden">
			
											<img src="<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/diamonds/loader.svg';?>" width="64" height="64" alt="loader" />
										

									</div>

								<!-- Table body start -->
								<div class="table__body">


								</div>
								<!-- Table body end -->

						</div>
					</div>

				</div>
			</section>
		

		<?php get_template_part( 'template-parts/benefits' ); ?>
	</main><!-- #main -->

<?php

get_footer();
