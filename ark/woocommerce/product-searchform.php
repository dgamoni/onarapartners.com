<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<form role="search" method="get" class="woocommerce-product-search searchform input-group" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<input type="hidden" name="post_type" value="product" />

	<label class="screen-reader-text" for="woocommerce-product-search-field"><?php _e( 'Search for:', 'ark' ); ?></label>
	<input
		type="search"
		id="woocommerce-product-search-field"
		class="search-field form-control"
		placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'ark' ); ?>"
		value="<?php echo get_search_query(); ?>"
		name="s"
		title="<?php echo esc_attr_x( 'Search for:', 'label', 'ark' ); ?>"
	/>
	<span class="input-group-btn">
		<button type="submit" class="btn" id="searchsubmit">
			<i class="ff-font-awesome4 icon-search"></i>
		</button>
	</span>
</form>
