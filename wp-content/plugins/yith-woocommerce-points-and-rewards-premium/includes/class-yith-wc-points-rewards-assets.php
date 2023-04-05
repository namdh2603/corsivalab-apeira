<?php
/**
 * Assets class. This is used to load script and styles.
 *
 * @class   YITH_WC_Points_Rewards_Assets
 * @since   2.2.0
 * @author  YITH
 * @package YITH WooCommerce Points and Rewards
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'YITH_WC_Points_Rewards_Assets' ) ) {

	/**
	 * Class YITH_WC_Points_Rewards_Assets
	 */
	class YITH_WC_Points_Rewards_Assets {


		/**
		 * Single instance of the class
		 *
		 * @var YITH_WC_Points_Rewards_Assets
		 */
		protected static $instance;


		/**
		 * Returns single instance of the class
		 *
		 * @return YITH_WC_Points_Rewards_Assets
		 * @since  2.2.0
		 */
		public static function get_instance() {
			return ! is_null( self::$instance ) ? self::$instance : self::$instance = new self();

		}


		/**
		 * Constructor
		 *
		 * Initialize plugin and registers actions and filters to be used
		 *
		 * @since 2.2.0
		 */
		private function __construct() {

			if ( is_admin() ) {
				add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ), 11 );
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ),11 );
			} else {
				add_action( 'wp_enqueue_scripts', array( $this, 'register_frontend_scripts' ), 11 );
				add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_scripts' ), 11 );
			}

		}

		/**
		 * Register admin scripts
		 */
		public function register_admin_scripts() {
			wp_register_style( 'yith_ywpar_backend', YITH_YWPAR_ASSETS_URL . '/css/admin.css', array( 'yith-plugin-ui' ), YITH_YWPAR_VERSION );
			wp_register_script( 'yith_ywpar_panel', YITH_YWPAR_ASSETS_URL . '/js/admin-panel' . YITH_YWPAR_SUFFIX . '.js', array( 'jquery', 'jquery-ui-dialog' ), YITH_YWPAR_VERSION, true );
			wp_register_script( 'yith_ywpar_customer_panel', YITH_YWPAR_ASSETS_URL . '/js/admin-customer-panel' . YITH_YWPAR_SUFFIX . '.js', array( 'jquery', 'jquery-ui-dialog' ), YITH_YWPAR_VERSION, true );
			wp_register_script( 'yith-ywpar-gutenberg', YITH_YWPAR_ASSETS_URL . '/js/blocks' . YITH_YWPAR_SUFFIX . '.js', array( 'jquery', 'jquery-ui-dialog' ), YITH_YWPAR_VERSION, true );

			wp_localize_script(
				'yith_ywpar_panel',
				'yith_ywpar_panel',
				array(
					'ajax_url'                => admin_url( 'admin-ajax.php' ),
					'apply_wc_points_rewards' => wp_create_nonce( 'apply_wc_points_rewards' ),
				)
			);

			wp_localize_script(
				'yith_ywpar_customer_panel',
				'yith_ywpar_customer_panel',
				array(
					'add_points_title'          => _x( 'Add points to the customer', 'Customer add points title', 'yith-woocommerce-points-and-rewards' ),
					'add_points_save'           => _x( 'Add points', 'Customer add points save button', 'yith-woocommerce-points-and-rewards' ),
					'remove_points_title'       => _x( 'Remove points from the customer', 'Customer remove points title', 'yith-woocommerce-points-and-rewards' ),
					'remove_points_save'        => _x( 'Remove points', 'Customer remove points save button', 'yith-woocommerce-points-and-rewards' ),
					'reset_points_title'        => _x( 'Remove all points ', 'Customer remove points save button', 'yith-woocommerce-points-and-rewards' ),
					'reset_points_message'      => _x( 'Are you sure to remove all points of the customer?', 'Customer remove points confirmation message', 'yith-woocommerce-points-and-rewards' ),
					'reset_points_message_bulk' => _x( 'Are you sure to remove all points of the selected customers?', 'Customer remove points confirmation message for bulk action', 'yith-woocommerce-points-and-rewards' ),
					'ajax_url'                  => admin_url( 'admin-ajax.php' ),
					'import_button_label'       => esc_html__( 'Start Import', 'yith-woocommerce-points-and-rewards' ),
					'export_button_label'       => esc_html__( 'Start Export', 'yith-woocommerce-points-and-rewards' ),
				)
			);
		}

		/**
		 * Enqueue admin scripts
		 */
		public function enqueue_admin_scripts() {

			if ( ywpar_check_valid_admin_page( YITH_WC_Points_Rewards_Post_Types::$banner ) ||
				ywpar_check_valid_admin_page( YITH_WC_Points_Rewards_Post_Types::$level_badge ) ) {
				wp_enqueue_media();
			}

			if ( ywpar_check_valid_admin_page( YITH_WC_Points_Rewards_Post_Types::$banner ) ||
				ywpar_check_valid_admin_page( YITH_WC_Points_Rewards_Post_Types::$redeeming_rule ) ||
				ywpar_check_valid_admin_page( YITH_WC_Points_Rewards_Post_Types::$earning_rule ) ||
				ywpar_check_valid_admin_page( YITH_WC_Points_Rewards_Post_Types::$level_badge ) ||
				ywpar_check_valid_admin_page( 'post' ) ||
				ywpar_check_valid_admin_page( 'page' ) ) {
				wp_enqueue_style( 'yith_ywpar_backend' );
				wp_enqueue_script( 'yith_ywpar_panel' );
				wp_enqueue_style( 'yith-ywpar-gutenberg' );
				wp_enqueue_script( 'yith-ywpar-gutenberg' );

			}

			if ( ( isset( $_GET['page'] ) ) && $_GET['page'] === yith_points()->admin::$panel_page ) { //phpcs:ignore
				wp_enqueue_style( 'yith_ywpar_backend' );
				wp_enqueue_script( 'yith_ywpar_panel' );
				wp_enqueue_script( 'yith_ywpar_customer_panel' );
			}
		}

		/**
		 * Register frontend scripts
		 */
		public function register_frontend_scripts() {

			wp_register_style( 'ywpar-date-picker-style', YITH_YWPAR_ASSETS_URL . '/css/dtsel.css', array(), YITH_YWPAR_VERSION );
			wp_register_style( 'yith-plugin-fw-icon-font', YIT_CORE_PLUGIN_URL . '/assets/css/yith-icon.css', array(), YITH_YWPAR_VERSION );
			wp_register_style( 'ywpar_frontend', YITH_YWPAR_ASSETS_URL . '/css/frontend.css', array(), YITH_YWPAR_VERSION );
			wp_register_style( 'ywpar_frontend_shortcodes', YITH_YWPAR_ASSETS_URL . '/css/shortcodes.css', array(), YITH_YWPAR_VERSION );
			wp_register_style( 'ywpar_icons', YITH_YWPAR_ASSETS_URL . '/css/icons.css', array(), YITH_YWPAR_VERSION );

			wp_register_script( 'jquery-blockui', YITH_YWPAR_ASSETS_URL . '/js/jquery.blockUI.min.js', array( 'jquery' ), YITH_YWPAR_VERSION, true );
			wp_register_script( 'ywpar_frontend', YITH_YWPAR_ASSETS_URL . '/js/frontend' . YITH_YWPAR_SUFFIX . '.js', array( 'jquery', 'wc-add-to-cart-variation' ), YITH_YWPAR_VERSION, true );
			wp_register_script( 'ywpar_frontend_my_account', YITH_YWPAR_ASSETS_URL . '/js/frontend-my-account' . YITH_YWPAR_SUFFIX . '.js', array( 'jquery', 'wc-add-to-cart-variation', 'jquery-blockui' ), YITH_YWPAR_VERSION, true );
			wp_register_script( 'ywpar_datepicker', YITH_YWPAR_ASSETS_URL . '/js/dtsel' . YITH_YWPAR_SUFFIX . '.js', array(), YITH_YWPAR_VERSION, true );
		}

		/**
		 * Enqueue frontend scripts
		 */
		public function enqueue_frontend_scripts() {

			global $post;
			if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'ywpar_customers_points' ) ) {
				wp_enqueue_style( 'ywpar_frontend_shortcodes' );
			}

			/* Hide messages of points for guests if option is enabled. */
			if ( apply_filters( 'ywpar_hide_messages', false ) || ( ywpar_get_option( 'hide_point_system_to_guest' ) === 'yes' && ! is_user_logged_in() && ! is_account_page() ) ) {
				return;
			}

			/* load datepicker for birthday field if the option is active */
			if ( ywpar_get_option( 'enable_points_on_birthday_exp' ) === 'yes' ) {
				wp_enqueue_script( 'ywpar_datepicker' );
				wp_enqueue_style( 'ywpar-date-picker-style' );
			}

			if ( 'yes' === ywpar_get_option( 'enable_points_on_referral_registration_exp' ) ) {
				wp_enqueue_style( 'yith-plugin-fw-icon-font' );
			}

			wp_enqueue_style( 'ywpar_frontend' );



			$script_params = array(
				'ajax_url'             => admin_url( 'admin-ajax' ) . '.php',
				'wc_ajax_url'          => WC_AJAX::get_endpoint( '%%endpoint%%' ),
				'cart_or_checkout'     => is_checkout() ? 'checkout' : 'cart',
				'redeem_uses_ajax'     => apply_filters( 'ywpar_redeem_uses_ajax', false ),
				'reward_message_type'  => ( 'default' === ywpar_get_option( 'enabled_rewards_cart_message_layout_style' ) ) ? 'default-layout' : 'custom-layout',
				'birthday_date_format' => ywpar_get_option( 'birthday_date_format' ),
				'discount_value_nonce' => wp_create_nonce( 'calc_discount_value' ),
			);

			wp_localize_script( 'ywpar_frontend', 'yith_ywpar_general', $script_params );

			$script_params = array(
				'ajax_url'             => admin_url( 'admin-ajax' ) . '.php',
				'birthday_date_format' => ywpar_get_option( 'birthday_date_format' ),
			);

			wp_localize_script( 'ywpar_frontend_my_account', 'yith_ywpar_general', $script_params );

			if ( is_account_page() || apply_filters( 'ywpar_load_account_script_everywhere', false ) ) {
				wp_enqueue_script( 'ywpar_frontend_my_account' );
			} else {
				wp_enqueue_script( 'ywpar_frontend' );
			}
		}


	}

}
