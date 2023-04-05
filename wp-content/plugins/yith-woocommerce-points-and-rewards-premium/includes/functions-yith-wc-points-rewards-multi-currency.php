<?php
/**
 * Implements helper functions for YITH WooCommerce Points and Rewards
 *
 * @package YITH WooCommerce Points and Rewards
 * @since   1.0.0
 * @author  YITH
 */

defined( 'ABSPATH' ) || exit;


/**
 * WooCommerce Multilingual - MultiCurrency
 */
if ( function_exists( 'wcml_is_multi_currency_on' ) && wcml_is_multi_currency_on() ) {
	add_filter( 'ywpar_multi_currency_current_currency', 'ywpar_multi_currency_current_currency', 10 );
	add_filter( 'ywpar_get_active_currency_list', 'ywpar_get_active_currency_list' );
	add_action( 'woocommerce_coupon_loaded', 'remove_wcml_filter', 1 );
	add_action( 'wcml_switch_currency', 'ywpar_wcml_remove_ywpar_coupons' );

	if ( ! function_exists( 'ywpar_multi_currency_current_currency' ) ) {
		/**
		 * Get current currency.
		 *
		 * @param string $currency Currency.
		 *
		 * @return mixed
		 */
		function ywpar_multi_currency_current_currency( $currency ) {
			global $woocommerce_wpml;
			$client_currency = $woocommerce_wpml->multi_currency->get_client_currency();
			return ! empty( $client_currency ) ? $client_currency : $currency;
		}
	}

	if ( ! function_exists( 'ywpar_get_active_currency_list' ) ) {
		/**
		 * Return the list of active currencies.
		 *
		 * @param array $currencies List of currencies.
		 *
		 * @return array
		 */
		function ywpar_get_active_currency_list( $currencies ) {
			global $woocommerce_wpml;
			$multi_currencies = $woocommerce_wpml->multi_currency->get_currencies( 'include_default = true' );
			if ( $multi_currencies ) {
				$currencies = array_keys( $multi_currencies );
			}

			return $currencies;
		}
	}

	if ( ! function_exists( 'remove_wcml_filter' ) ) {
		/**
		 * Remove wcml filter when a coupon is loaded
		 *
		 * @param string $coupon Coupon.
		 */
		function remove_wcml_filter( $coupon ) {
			global $woocommerce_wpml;

			if ( ywpar_is_redeeming_coupon( $coupon ) ) {
				remove_action(
					'woocommerce_coupon_loaded',
					array(
						$woocommerce_wpml->multi_currency->coupons,
						'filter_coupon_data',
					),
					10
				);
			}
		}
	}

	if ( ! function_exists( 'ywpar_wcml_remove_ywpar_coupons' ) ) {
		/**
		 * Remove wcml filter when a coupon is loaded
		 *
		 * @param string $coupon Coupon.
		 */
		function ywpar_wcml_remove_ywpar_coupons( $code = '', $cookie_lang = '', $original = '' ) {
			$action = current_action();

			switch ( $action ) {

				case 'wcml_user_switch_language':
					if ( ! empty( $code ) && $code != $cookie_lang ) {
						ywpar_remove_redeeming_coupon();
					}

					break;
				case 'wcml_switch_currency':
					ywpar_remove_redeeming_coupon();
					break;

			}
		}
	}
}

if ( class_exists( 'WOOCS_STARTER' ) ) {
    if( YITH_WC_Points_Rewards::is_request( 'admin' ) ){
		global $WOOCS;
		remove_filter('woocommerce_currency_symbol', array($WOOCS, 'woocommerce_currency_symbol'), 9999);
	}
	add_filter( 'ywpar_get_active_currency_list', 'ywpar_woocommerce_currency_switcher_currency_list' );
	add_action( 'ywpar_before_currency_loop', 'ywpar_woocommerce_currency_switcher_before_currency_loop' );
	add_action( 'before_return_calculate_price_worth', 'ywpar_woocs_before_rewards_message' );
	add_action( 'ywpar_after_rewards_message', 'ywpar_woocs_after_rewards_message' );

	add_filter( 'ywpar_get_point_earned_price', 'ywpar_woocs_convert_price', 10, 2 );
	add_filter( 'ywpar_calculate_rewards_discount_max_discount_fixed', 'ywpar_woocs_convert_price', 10, 1 );
	add_filter( 'ywpar_calculate_rewards_discount_max_discount_percentual', 'ywpar_woocs_convert_price', 10, 1 );
	add_filter( 'ywpar_hide_value_for_max_discount', 'ywpar_woocs_hide_value_for_max_discount' );

	add_filter( 'ywpar_adjust_discount_value', 'ywpar_woocs_adjust_discount_value' );

	if ( ! function_exists( 'ywpar_woocommerce_currency_switcher_currency_list' ) ) {
		/**
		 * Return the list of active currencies.
		 *
		 * @param array $currencies List of currencies.
		 *
		 * @return array
		 * @since  1.5.3
		 */
		function ywpar_woocommerce_currency_switcher_currency_list( $currencies ) {
			global $WOOCS; //phpcs:ignore
			$enabled_currencies = array_keys( $WOOCS->get_currencies() );
			$currencies         = ! empty( $enabled_currencies ) ? $enabled_currencies : $currencies;

			return $currencies;
		}
	}

	if ( ! function_exists( 'ywpar_woocommerce_currency_switcher_before_currency_loop' ) ) {
		/**
		 * Remove filter.
		 *
		 * @since  1.5.3
		 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
		 */
		function ywpar_woocommerce_currency_switcher_before_currency_loop() {
			global $WOOCS; //phpcs:ignore
			remove_filter( 'woocommerce_currency_symbol', array( $WOOCS, 'woocommerce_currency_symbol' ), 9999 );
		}
	}

	if ( ! function_exists( 'ywpar_woocs_before_rewards_message' ) ) {
		/**
		 * Remove filters before rewards message
		 *
		 * @since 1.5.2
		 */
		function ywpar_woocs_before_rewards_message() {
			global $WOOCS; //phpcs:ignore
			remove_filter( 'wc_price_args', array( $WOOCS, 'wc_price_args' ), 9999 ); //phpcs:ignore
			remove_filter( 'raw_woocommerce_price', array( $WOOCS, 'raw_woocommerce_price' ), 9999 ); //phpcs:ignore
		}
	}

	if ( ! function_exists( 'ywpar_woocs_after_rewards_message' ) ) {
		/**
		 * Add some filters after rewards message.
		 *
		 * @since 1.5.2
		 */
		function ywpar_woocs_after_rewards_message() {
			global $WOOCS; //phpcs:ignore
			add_filter( 'wc_price_args', array( $WOOCS, 'wc_price_args' ), 9999 ); //phpcs:ignore
			if ( ! $WOOCS->is_multiple_allowed ) { //phpcs:ignore
				add_filter( 'raw_woocommerce_price', array( $WOOCS, 'raw_woocommerce_price' ), 9999 ); //phpcs:ignore
			}
		}
	}

	if ( ! function_exists( 'ywpar_woocs_convert_price' ) ) {
		/**
		 * WOOCS Convert price
		 *
		 * @param float       $price Price.
		 * @param string $currency Currency.
		 *
		 * @return float|int
		 * @since  1.5.3
		 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
		 */
		function ywpar_woocs_convert_price( $price, $currency = '' )  {
			global $WOOCS; //phpcs:ignore
			if ( $WOOCS->is_multiple_allowed || ! $WOOCS ) { //phpcs:ignore
				return $price;
			}
			$currencies = $WOOCS->get_currencies(); //phpcs:ignore
			$currency   = empty( $currency ) ? $WOOCS->current_currency : $currency; //phpcs:ignore
			if ( isset( $currencies[ $currency ] ) ) {
				$price = $price * $currencies[ $currency ]['rate'];
			}

			return $price;
		}
	}

	if ( ! function_exists( 'ywpar_woocs_hide_value_for_max_discount' ) ) {
		/**
		 * @param $discount
		 * @return int
		 * @since  1.5.3
		 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
		 */
		function ywpar_woocs_hide_value_for_max_discount( $discount ) {
			global $WOOCS; //phpcs:ignore
			if ( $WOOCS->is_multiple_allowed ) { //phpcs:ignore
				$currencies = $WOOCS->get_currencies(); //phpcs:ignore
				return $WOOCS->back_convert( $discount, $currencies[ $WOOCS->current_currency ]['rate'] ); //phpcs:ignore
			}
			remove_all_filters( 'ywpar_calculate_rewards_discount_max_discount_fixed' );
			remove_all_filters( 'ywpar_calculate_rewards_discount_max_discount_percentual' );

			return YITH_WC_Points_Rewards_Redemption()->calculate_rewards_discount();
		}
	}


	if ( ! function_exists( 'ywpar_woocs_adjust_discount_value' ) ) {
		/**
		 * Adjust the discount
		 *
		 * @param float $discount Discount amount.
		 *
		 * @return int
		 * @since  1.5.3
		 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
		 */
		function ywpar_woocs_adjust_discount_value( $discount ) {
			global $WOOCS; //phpcs:ignore
			if ( $WOOCS->is_multiple_allowed ) { //phpcs:ignore
				$currencies = $WOOCS->get_currencies(); //phpcs:ignore
				$discount   = $WOOCS->back_convert( $discount, $currencies[ $WOOCS->current_currency ]['rate'] ); //phpcs:ignore
			}
			return $discount;
		}
	}
}

if ( class_exists( 'WC_Aelia_CurrencySwitcher' ) ) {

	add_filter( 'ywpar_multi_currency_current_currency', 'ywpar_aelia_current_currency' );
	add_filter( 'ywpar_get_active_currency_list', 'ywpar_aelia_get_active_currency_list' );
	add_action( 'woocommerce_coupon_get_amount', 'remove_aelia_filter_woocommerce_coupon_get_amount', 1, 2 );

	if ( ! function_exists( 'ywpar_aelia_current_currency' ) ) {
		/**
		 * Multi currency
		 *
		 * @param string $currency Currency.
		 * @return mixed
		 */
		function ywpar_aelia_current_currency( $currency ) {

			$instance = isset( $GLOBALS['woocommerce-aelia-currencyswitcher'] ) ? $GLOBALS['woocommerce-aelia-currencyswitcher'] : false;

			if ( $instance ) {
				$currency = $instance->get_selected_currency();
			}

			return $currency;
		}
	}

	if ( ! function_exists( 'ywpar_aelia_get_active_currency_list' ) ) {

		/**
		 * Return the list of active currencies.
		 *
		 * @param array $currencies Currency list.
		 *
		 * @return array
		 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
		 */
		function ywpar_aelia_get_active_currency_list( $currencies ) {
			$settings_controller = WC_Aelia_CurrencySwitcher::settings();
			$enabled_currencies  = $settings_controller->get_enabled_currencies();
			$currencies          = ! empty( $enabled_currencies ) ? $enabled_currencies : $currencies;

			return $currencies;
		}
	}

	if ( ! function_exists( 'remove_aelia_filter_woocommerce_coupon_get_amount' ) ) {
		/**
		 * Remove filter
		 *
		 * @param float     $amount Coupon amount.
		 * @param WC_Coupon $coupon Coupon.
		 *
		 * @return mixed
		 */
		function remove_aelia_filter_woocommerce_coupon_get_amount( $amount, $coupon ) {
			if ( ywpar_is_redeeming_coupon( $coupon ) ) {
				remove_action( 'woocommerce_coupon_get_amount', array( WC_Aelia_CurrencyPrices_Manager::Instance(), 'woocommerce_coupon_get_amount' ), 5, 2 );
			}
			return $amount;
		}
	}
}


/* integration with YITH Multi Currency Switcher for WooCommerce */
if ( function_exists( 'yith_wcmcs_get_enabled_currencies' ) ) {
	add_filter( 'ywpar_get_active_currency_list', 'ywpar_wcmcs_get_active_currency_list' );
	add_filter( 'yith_wcmcs_manual_coupon_amount', 'ywpar_wcmcs_disable_redeeming_coupon_conversion', 10, 3);
	if ( ! function_exists( 'ywpar_wcmcs_get_active_currency_list' ) ) {
		/**
		 * Return the list of active currencies
		 *
		 * @param array $currencies List of currencies.
		 *
		 * @return array
		 * @author Armando Liccardo <armando.liccardo@yithemes.com>
		 */
		function ywpar_wcmcs_get_active_currency_list( $currencies ) {
			$enabled_currencies = yith_wcmcs_get_enabled_currencies();
			$enabled_currencies = array_keys( $enabled_currencies );
			$currencies         = ! empty( $enabled_currencies ) ? $enabled_currencies : $currencies;
			return $currencies;
		}
	}

	if ( ! function_exists( 'ywpar_wcmcs_disable_redeeming_coupon_conversion' ) ) {
		/**
		 * Disable the conversion for redeeming coupons
		 *
		 * @param   string|null     $manual_amount  Amount.
		 * @param   string     $amount  Amount.
		 * @param   WC_Coupon  $coupon  Coupon.
		 */
		function ywpar_wcmcs_disable_redeeming_coupon_conversion( $manual_amount, $amount, $coupon ) {
			if( ywpar_is_redeeming_coupon( $coupon ) ){
				return $coupon->get_amount('edit');
			}

			return $manual_amount;
		}
	}
}
