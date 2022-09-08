<?php 

		//Variables
			$sku = esc_attr($product->get_sku());
			$name = esc_attr($product->get_name());
			$price = esc_attr($product->get_price());
			$cut_label = esc_attr(wc_attribute_label( 'pa_cut' ));
			$cut = esc_attr($product->get_attribute( 'cut' ));
			// $color_label = wc_attribute_label( 'pa_color' );
			// $color = $product->get_attribute( 'color' );
			// $clarity_label = wc_attribute_label( 'pa_clarity' );
			// $clarity = $product->get_attribute( 'clarity' );
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

		?>