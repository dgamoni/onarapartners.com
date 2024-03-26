<?php

add_action('wp_enqueue_scripts', 'ark_register_styles');
/**
 * Enqueues styles.
 */

function ark_register_styles() {

	// Bootstrap
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/plugins/bootstrap/css/bootstrap.min.css', array(), '3.3.6' );

	// Theme javascript plugins
	wp_enqueue_style('jquery.mCustomScrollbar', get_template_directory_uri() . '/assets/plugins/scrollbar/jquery.mCustomScrollbar.css', array(), '3.1.12' );
	wp_enqueue_style('owl.carousel', get_template_directory_uri() . '/assets/plugins/owl-carousel/assets/owl.carousel.css', array(), '1.3.2' );
	wp_enqueue_style('animate', get_template_directory_uri() . '/assets/css/animate.css', array(), '3.5.1' );
	wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/plugins/magnific-popup/magnific-popup.css', array(), '1.1.0' );
	wp_enqueue_style('cubeportfolio', get_template_directory_uri() . '/assets/plugins/cubeportfolio/css/cubeportfolio.min.css', array(), '3.8.0' );

	// Icon Fonts
	if ( class_exists('ffContainer') ) {
		ark_wp_enqueue_framework_icon_fonts_styles();
	}else{
		wp_enqueue_style('ark-modified-font-awesome', get_template_directory_uri() . '/no-ff/iconfonts/ff-font-awesome4/ff-font-awesome4.css' );
		wp_enqueue_style('ark-modified-font-et-line', get_template_directory_uri() . '/no-ff/iconfonts/ff-font-et-line/ff-font-et-line.css' );
	}

	// Theme Styles
	wp_enqueue_style('ark-one-page-business', get_template_directory_uri() . '/assets/css/one-page-business.css' );
	wp_enqueue_style('ark-landing', get_template_directory_uri() . '/assets/css/landing.css' );

	// Stylesheet from the PARENT theme
	wp_enqueue_style('ark-style', get_template_directory_uri().'/style.css' );

	// Stylesheet from the CHILD theme
	wp_enqueue_style('ark-style-child', get_stylesheet_directory_uri().'/style.css' );

	if ( class_exists('ffContainer') ) {
		ark_wp_enqueue_theme_google_fonts_styles();
	}else{
		wp_enqueue_style( 'ark-fonts', ark_fonts_url(), array(), null );
		wp_enqueue_style( 'ark-fonts-family', get_template_directory_uri() . '/no-ff/no-ff-fonts.css' );
	}

	if( class_exists('WooCommerce') ) {
		wp_enqueue_style('ark-woocommerce', get_template_directory_uri() . '/woocommerce/woocommerce.css');
	}
	$url = ark_get_custom_color_css_url();
	wp_enqueue_style('ark-colors', $url );

	// TwentyTwenty
	wp_enqueue_style('twentytwenty', get_template_directory_uri() . '/assets/plugins/twentytwenty/css/twentytwenty.css', array() );
}

// Disable html in wordpress comments
add_filter( ‘pre_comment_content’, ‘wp_specialchars’);

// Remove Query Strings from Static Resources
function _remove_script_version( $src ){
	$parts = explode( '?ver', $src );
	return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );

// Disable emojis
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * @param    array  $plugins  
 * @return   array  Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

// Remove WP embed script
function speed_stop_loading_wp_embed() {
	if (!is_admin()) {
		wp_deregister_script('wp-embed');
	}
}
add_action('init', 'speed_stop_loading_wp_embed');


