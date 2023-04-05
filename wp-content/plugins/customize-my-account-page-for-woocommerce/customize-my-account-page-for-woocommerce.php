<?php
/**
 * Plugin Name: Customize My Account Page For Woocommerce
 * Plugin URI: https://woocommerce.com/products/customize-my-account-page-for-woocommerce/
 * Description: Allows you to register custom WooCommerce tabs on my-account page and customize the design.
 * Author: WPEverest
 * Author URI: https://wpeverest.com
 * Version: 0.4.6
 * Text Domain: customize-my-account-page-for-woocommerce
 * Domain Path: /languages
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * Woo: 6142928:76e57b430b40fc0f2eaa53c78092333d
 * WC requires at least: 3.5.0
 * WC tested up to: 7.1.0
 */

use ThemeGrill\WoocommerceCustomizer\WoocommerceCustomizer;

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'TGWC_PLUGIN_FILE' ) ) {
	define( 'TGWC_PLUGIN_FILE', __FILE__ );
}

if ( ! defined( 'TGWC_VERSION' ) ) {
	define( 'TGWC_VERSION', '0.4.6' );
}

if ( ! defined( 'TGWC_ABSPATH' ) ) {
	define( 'TGWC_ABSPATH', dirname( TGWC_PLUGIN_FILE ) . '/' );
}

if ( ! defined( 'TGWC_PLUGIN_BASENAME' ) ) {
	define( 'TGWC_PLUGIN_BASENAME', dirname( TGWC_PLUGIN_FILE ) );
}

if ( ! defined( 'TGWC_TEMPLATE_PATH' ) ) {
	define( 'TGWC_TEMPLATE_PATH', dirname( TGWC_PLUGIN_FILE ) . '/templates/' );
}

require_once dirname( __FILE__ ) . '/vendor/autoload.php';


/**
 * Returns the main instance of Themegrill WooCommerce Customizer.
 *
 * @since 0.1.0
 * @return ThemeGrill\WoocommerceCustomizer\WoocommerceCustomizer
 */
// phpcs:ignore
function TGWC() {
	return WoocommerceCustomizer::instance();
}

TGWC();
