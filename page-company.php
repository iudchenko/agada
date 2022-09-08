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

	<main id="primary" class="site-main company">

		<?php get_template_part( 'template-parts/custom-breadcrumbs' ); ?>

		<section class="company-saving">
				<h1 class="company-saving__title"><?php _e('Saving Earth', 'agada');?></h1>
		</section>

		<section class="company-mission">
				<h2 class="company-mission__title"><?php _e('Our mission', 'agada');?></h2>
				<p class="company-mission__p"><?php _e('We at AGADA believe that by creating diamonds in the laboratory, we save the environment and improve this world. After all, our diamonds are no different from natural ones and even surpass them in some properties. Therefore, you will not have to compromise when buying our diamonds, choosing between quality and conscience.', 'agada');?></p>
		</section>

		<section class="company-origins col-2">
				<img src="<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/company/origins.jpg';?>" alt="agada-lab-grown-diamonds-origins">
				<div class="company-origins__content">					
					<h2 class="company-origins__title"><?php _e('Origins', 'agada');?></h2>
					<p class="company-origins__p"><?php _e('We were one of the first in Israel to start growing diamonds in a laboratory, and since 2003 we have wholly abandoned working with natural diamonds. As a result, we have become one of the industry leaders, and today our diamonds are in demand not only in Israel but all over the world.', 'agada');?></p>
				</div>
		</section>

		<section class="company-quality col-2">
			<div class="company-quality__content">	
				<h2 class="company-quality__title"><?php _e('Quality', 'agada');?></h2>
				<p class="company-quality__p"><?php _e('Our diamonds are certified by international certification laboratories, so choosing AGADA diamonds gives you unparalleled transparency of their origin.', 'agada');?></p>
			</div>
				<img src="<?php echo esc_url(get_site_url()) . '/wp-content/themes/agada/img/company/quality.jpg';?>" alt="agada-lab-grown-diamonds-quality">
		</section>

	</main><!-- #main -->

<?php
// get_sidebar();
get_template_part( 'template-parts/benefits' ); 
get_footer();
