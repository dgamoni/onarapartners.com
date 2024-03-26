<?php

if( !function_exists('ff_menu_saving') ) {
	function ff_menu_saving(){
		// Main menu item max number fix
		if (ffContainer()->getWPLayer()->is_admin()) {
			if (FALSE !== strpos($_SERVER['REQUEST_URI'], 'nav-menus.php')) {
				ffContainer()->getThemeFrameworkFactory()->getMenuJavascriptSaver()->enableMenuJavascriptSave();
			}
		}
	}
	if ( FF_ARK_ENVIRONMENT_READY ) {
		add_action( 'admin_init', 'ff_menu_saving' );
	}
}
if ( !FF_ARK_ENVIRONMENT_READY ) {
	add_action('the_post', array('ark_Featured_Area', 'addFeaturedAreasHooks'));
}


add_action('post_class', 'ark_post_class');
if( ! function_exists('ark_post_class') ){
	/**
	 * Add post-wrapper class to the classes for the post content wrapper.
	 *
	 * @param array $classes An array of post classes.
	 * @param array $class   An array of additional classes added to the post.
	 * @param int   $post_ID The post ID.
	 * @return array Array of classes.
	 */
	function ark_post_class( $classes, $class = null, $post_ID = null){
		$classes[] = 'post-wrapper';
		return $classes;
	}
}
