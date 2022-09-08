<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AgAdA
 */

get_header();
?>

	<main id="primary" class="site-main">
	<!-- <div class="container">
	<?php
		while ( have_posts() ) :
			the_post();

			the_content();

		endwhile; // End of the loop.
		?>

	</div> -->


	<?php get_template_part( 'template-parts/home/home-slider' ); ?>
	
	<?php get_template_part( 'template-parts/home/home-reasons' ); ?>


	<section class="what-are-lab-diamonds">
		<div class="container col-2">
			<img src="<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/front-page/agada-lab-grown-diamonds.jpg';?>" alt="agada-lab-grown-diamonds">

			<div class="what-are-lab-diamonds__text">
					<h2 class="what-are-lab-diamonds__title"><?php esc_html_e( 'What Are Lab Grown Diamonds?', 'agada' ); ?></h2>
					<p class="what-are-lab-diamonds__desc"><?php esc_html_e( 'Lab grown diamonds (also known as lab created diamonds, man made diamonds, engineered diamonds, and cultured diamonds) are grown in highly controlled laboratory environments using advanced technological processes that duplicate the conditions under which diamonds naturally develop when they form in the mantle, beneath the Earth’s crust. These lab created diamonds consist of actual carbon atoms arranged in the characteristic diamond crystal structure. Since they are made of the same material as natural diamonds, they exhibit the same optical and chemical properties.', 'agada' ); ?></p>

					<p class="what-are-lab-diamonds__desc"><?php esc_html_e( 'Our lab created diamonds are readily available in a variety of colorless ranges. Our lab created diamonds are also available in fancy colors that are considered very rare in nature, including popular hues of vivid yellow. Fancy colored lab created diamonds sell at comparatively reasonable prices compared to their natural colored diamond counterparts.', 'agada' ); ?></p>
			</div>

		</div>
	</section>

	<?php get_template_part( 'template-parts/home/home-diamonds-types' ); ?>

	<section class="lab-vs-simulants">
		<div class="container col-2">
		

			<div class="lab-vs-simulants__text">
					<h2 class="lab-vs-simulants__title"><?php esc_html_e( 'LAB GROWN DIAMONDS vs. DIAMOND SIMULANTS', 'agada' ); ?></h2>
					<p class="lab-vs-simulants__desc"><?php esc_html_e( 'It is important to note the major distinction between lab grown diamonds and diamond simulants. Diamond simulants, such as cubic zirconia and moissanite, look similar to diamonds but are not true carbon crystals. Simulants do not have the same chemical and physical properties as natural diamonds and therefore sell at much lower prices than lab created diamonds. Simulants can be distinguished from natural or lab created diamonds using only the naked eye.', 'agada' ); ?></p>

					<p class="lab-vs-simulants__desc"><?php esc_html_e( 'Natural and lab created diamonds have thermal conductivity properties that differentiate them from cubic zirconia with a handheld diamond tester. Some lab created diamonds, along with some natural colored diamonds, may be mistakenly identified as moissanites when using certain diamond testers due to similarity in their electrical conductivity. However, gemologists can typically distinguish between diamond and moissanite due to their differing refractive properties, with moissanites being double refractive and diamonds being single refractive.', 'agada' ); ?></p>
			</div>

			<img class="lab-vs-simulants__img" src="<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/front-page/agada-lab-vs-simulants-diamonds.jpg';?>" alt="agada-lab-grown-vs-simulants-diamonds">

		</div>
	</section>


	<?php get_template_part( 'template-parts/home/home-key-benefits' ); ?>

	<section class="the-secret-banner">
		<div class="container">
			<div class="the-secret-banner__content">
				<div class="the-secret-banner__box">
					<span>THE</span>
					<h2 class="the-secret-banner__title"><?php esc_html_e( 'Secret', 'agada' ); ?></h2>
				</div>

				<h3 class="the-secret-banner__desc"><?php esc_html_e( 'A New diamond jewelry sets collection', 'agada' ); ?></h3>

				<a class="the-secret-banner__btn btn-link" href="<?php echo get_permalink(wc_get_page_id( 'shop' )); ?>">Shop now</a>

			</div>
		</div>
	</section>

	<section class="featured">
		<div class="container">
		<h2 class="featured__title"><?php esc_html_e( 'Featured lab grown diamonds rings', 'agada' ); ?></h2>
	<div class="featured__items">

	<?php
	// Tax query
	$tax_query = array(
		'relation' => 'AND',

		array(
			'taxonomy'      => 'product_cat',
			'field' 				=> 'term_id', //This is optional, as it defaults to 'term_id'
			'terms'         => array( 79, 77, 75 ), // Filtering diamonds category
			'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
		),

	);


$args = array(
    // arguments for your query
		'post_type' 		 =>  'product',
		'post_status'    => 'publish',
		'posts_per_page' =>  '4',
		'post__not_in'   =>  array( $post->ID ),
		'post__in'       =>  wc_get_featured_product_ids(),
		'tax_query' 		=> $tax_query,
		'orderby'        =>  'menu_order',
		'order'          =>  'ASC'
);
// the query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) :  while ( $query->have_posts() ) : $query->the_post() ;
	// contents of the Loop go here
	?>

	<div class="featured__item">

		<a href="<?php esc_url(the_permalink()); ?>"  class="featured__img">
			<?php the_post_thumbnail(); ?>
		</a>

		<a href="<?php esc_url(the_permalink()); ?>" class="featured__name">
			<?php the_title(); ?>
		</a>

		<?php $cat = get_the_terms( $post->ID, 'product_cat' ); ?>
		<p class="featured__cat"><?php echo $cat[0]->name; ?></p>

		<?php $price = get_post_meta( get_the_ID(), '_price', true ); ?>
		<p class="featured__price"><?php echo wc_price( $price ); ?></p>

	</div>

	<?php
	endwhile; 
	endif;

	
/* Restore original Post Data */
wp_reset_postdata();
?>
		</div>
		</div>
	</section>

	<section class="certified-graded">
		<div class="container col-2">

			<img class="certified-graded__img" src="<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/front-page/certified-lab-grown-diamonds.jpg';?>" alt="agada-lab-grown-diamonds-certified-gradedraded">

			<div class="certified-graded__text">
					<h2 class="certified-graded__title"><?php esc_html_e( 'How Are Lab Grown Diamonds Certified And Graded?', 'agada' ); ?></h2>

					<p class="certified-graded__desc"><?php esc_html_e( 'All lab grown diamonds are treated the same as mined diamonds. Once they are ready, they are sent to an independent gem lab to be certified by an expert.', 'agada' ); ?></p>

					<p class="certified-graded__desc"><?php esc_html_e( 'The process for grading lab grown diamonds is the same as traditional diamonds and focuses on the cut, clarity, carat, and color of each gemstone. The cut is responsible for the brilliance of the diamond, and arguably the most important factor. Clarity refers to the appearance and lack of cracks and defects. When referencing clear diamonds, the lack of color makes a higher grade. Finally, carat is the measure of the diamond\'s size and weight. Each diamond is examined carefully and assigned a quality rating.', 'agada' ); ?></p>

			</div>

		</div>
	</section>


	<section class="new-collections">
		<div class="container col-2">

			<div class="new-collections__col">
				<img class="new-collections__img" src="<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/front-page/New-Spring-colorful-collection.jpg';?>" alt="agada-lab-grown-diamonds-new-collections">
				<h2 class="new-collections__title"><?php esc_html_e( 'New Spring colorful collection', 'agada' ); ?></h2>
				<a href="#" class="new-collections__link"><?php esc_html_e( 'Discover more', 'agada' ); ?></a>
			</div>

			<div class="new-collections__col">
				<img class="new-collections__img" src="<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/front-page/Choose-your-jewelry-set.jpg';?>" alt="agada-lab-grown-diamonds-new-collections">
				<h2 class="new-collections__title"><?php esc_html_e( 'Choose your jewelry set', 'agada' ); ?></h2>
				<a href="#" class="new-collections__link"><?php esc_html_e( 'Discover more', 'agada' ); ?></a>
			</div>

		</div>
	</section>


	<?php get_template_part( 'template-parts/benefits' ); ?>

	</main><!-- #main -->

<?php
get_footer();
