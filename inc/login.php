<?php 

/**
 * Login page styling
 */


function agada_login_logo()
{ ?>
	<style type="text/css">
		#login h1 a,
		.login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg);
			width: 320px;
			background-size: contain;
			background-repeat: no-repeat;
			padding-bottom: 30px;
		}

		body {
			background: #fff !important;
		}

		.login form {
			border-radius: 4px;
			background: #F8F8F8 !important;
		}

		.login .language-switcher form {
			background: #fff !important;
		}
	</style>
	<?php }
add_action('login_enqueue_scripts', 'agada_login_logo');

function agada_login_logo_url()
{
	return home_url();
}
add_filter('login_headerurl', 'agada_login_logo_url');

function agada_login_logo_url_title()
{
	return 'AGADA';
}
add_filter('login_headertitle', 'agada_login_logo_url_title');