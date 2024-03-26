<?php


if( ! function_exists('ark_woocommerce_get__cart_menu_item__content') ) {
	/**
	 * Returns string with shopping basket icon and content in VERTICAL menu
	 *
	 * @return string
	 */
	function ark_woocommerce_get__cart_menu_item__content() {
		ob_start();
		echo '<div class="navbar-actions-shrink shopping-cart">';

			echo '<a href="javascript:void(0);" class="shopping-cart-icon-container ffb-cart-menu-item">';
				echo '<span class="shopping-cart-icon-wrapper" title="' . WC()->cart->get_cart_contents_count() . '">';
				echo '<span class="shopping-cart-menu-title">';
					echo get_the_title( wc_get_page_id('cart') );
					echo '&nbsp;';
				echo '</span>';
				echo '<i class="icon-shopping-cart"></i> ';
				echo '</span>';
			echo '</a>';

			echo '<div class="shopping-cart-menu-wrapper">';
				wc_get_template( 'cart/mini-cart.php', array('list_class' => ''));
			echo '</div>';

		echo '</div>';
		return ob_get_clean();
	}
}

add_filter('add_to_cart_fragments', 'woocommerce_ark__cart_menu_item__fragment');
if( ! function_exists('woocommerce_ark__cart_menu_item__fragment') ) {
	/**
	 * Adds rule after product(s) is added to shopping basket. Rule is that everything with class .shopping-cart is
	 * refreshed / reloaded with ajax
	 *
	 * @param array $fragments
	 * @return array
	 */
	function woocommerce_ark__cart_menu_item__fragment($fragments) {
		$fragments['.shopping-cart'] = ark_woocommerce_get__cart_menu_item__content();
		return $fragments;
	}
}


add_action( 'after_setup_theme', 'ark_woocommerce_support' );
if( ! function_exists('ark_woocommerce_support') ) {
	/**
	 * Declare WooCommerce support in ark theme
	 */
	function ark_woocommerce_support() {
		add_theme_support('woocommerce');
	}
}
