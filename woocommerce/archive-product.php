<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

get_template_part( 'template-parts/shop/shop-banner' ); 
get_template_part( 'template-parts/shop/shop-by-cat' ); 

?>

<section class="create-ring">
<h2 class="create-ring__title">Create your own Ring</h2>
	<div class="container col-2--merged">

		<div class="col col--1">
			<h3>Diamond Rings</h3>
			<p>Select a setting and choose lab diamonds to create your dream ring.</p>
			<a class="btn-link btn-link--gray">Start with a Setting</a>
			<a class="btn-link btn-link--gray">Start with a Lab Diamond</a>

		</div>

		<div class="col col--2">
			
			<h3>Gemstone Rings</h3>
			<p>From brilliant emeralds to our colorful array of sapphires, pair a setting with a gemstone for a celebration of self-expression.</p>
			<a class="btn-link btn-link--gray">Start with a Setting</a>
			<a class="btn-link btn-link--gray">Start with a Lab Diamond</a>
		</div>

	</div>
</section>

<section class="redefining-fine-jewelry">

	<div class="redefining-fine-jewelry__content container">
		<h2 class="redefining-fine-jewelry__title">Redefining Fine Jewelry</h2>
		<img 
			src='<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/shop/redefining.svg';?>' 
			alt='redefining-fine-jewelry' 
			class="redefining-fine-jewelry__img"
		>
		<p class="redefining-fine-jewelry__desc">We believe in creating jewelry you can feel good about wearing, without ever compromising between quality and conscience. From recycled and ethically mined gold to jewelry that gives back, shop our mission inspired collections and learn about our story.</p>
	</div>

</section>

<section class="explore-more">
<h2 class="explore-more__title">Explore more Jewelry</h2>

	<?php 
	get_template_part( 'template-parts/shop/jewelery-carousel' ); 
	?>

	<div class="container col-2--merged">

		<div class="col col--1">
			<h3>Create Your Own Earrings</h3>
			<p>Select your favorite setting and diamond pair to create your ideal diamond earrings.</p>
			<a class="btn-link btn-link--gray">Get Started</a>

		</div>

		<div class="col col--2">
			
			<h3>Create Your Own Necklace</h3>
			<p>Personalize a solitaire necklace by selecting your ideal setting and gemstone.</p>
			<a class="btn-link btn-link--white">Get Started</a>
		</div>

	</div>
</section>




<?php

get_template_part( 'template-parts/shop/featured-collection' ); 

get_template_part( 'template-parts/shop/jewelry-by-meaning' ); 

?>

<section class="jewelry-collections">
	<div class="container col-2--merged">

		<div class="col col--1">
			<h3>The Ensemble Collection</h3>
			<p>Inspired by minimalism, sleek profiles, and contoured silhouettes, The Ensemble Collection artfully unites these elements for a fresh take on bridal classics.</p>
			<a class="btn-link btn-link--gray">Shop The Collection</a>

		</div>

		<div class="col col--2">
			
			<h3>The Geometric Fantasy</h3>
			<p>From ultra-thin shanks and hidden accents to curved bands and bold designs, these styles stand beautifully on their own or harmoniously in a stack.</p>
			<a class="btn-link btn-link--gray">Choose Your Own</a>
		</div>

	</div>
</section>

<?php
get_template_part( 'template-parts/benefits' ); 




get_footer();

