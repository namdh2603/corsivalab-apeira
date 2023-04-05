<?php
/**
 * Color configs.
 *
 * @package ThemeGrill\WoocommerceCustomizer\Customizer\Config
 * @since   0.1.0
 */

namespace ThemeGrill\WoocommerceCustomizer\Customizer\Config;

defined( 'ABSPATH' ) || exit;

class Color {
	/**
	 * Instance variable.
	 *
	 * @since 0.1.0
	 * @static
	 *
	 * @var ThemeGrill\WoocommerceCustomizer\Customizer\Config\Color
	 */
	private static $instance = null;

	/**
	 * Constructor.
	 *
	 * @since 0.1.0
	 */
	private function __construct() {
		$this->init_hooks();
	}

	/**
	 * Initialize and get instance of the class.
	 *
	 * @since 0.1.0
	 * @static
	 *
	 * @return ThemeGrill\WoocommerceCustomizer\Customizer\Config\Color
	 */
	public static function init() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}


	/**
	 * Initialize hooks.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	private function init_hooks() {
		add_filter( 'tgwc_customizer_sections', array( $this, 'add_sections' ) );
		add_filter( 'tgwc_customizer_controls', array( $this, 'add_controls') );
	}

	/**
	 * Add sections.
	 *
	 * @since 0.1.0
	 *
	 * @param array $sections List of sections.
	 * @return array Modified list of sections.
	 */
	public function add_sections( $sections ) {
		$sections[] = array(
			'id'          => 'tgwc_customize[color]',
			'title'       => esc_html__( 'Color', 'customize-my-account-page-for-woocommerce' ),
			'description' => esc_html__( 'Color description', 'customize-my-account-page-for-woocommerce' ),
			'priority'    => 165,
		);

		return $sections;
	}

	/**
	 * Add controls.
	 *
	 * @since 0.1.0
	 *
	 * @param array $controls List of controls.
	 * @return array Modified list of controls.
	 */
	public function add_controls( $controls ) {
		$controls[] = array(
			'id'      => 'tgwc_customize[color][heading]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'       => esc_html__( 'Heading Color', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Select Heading color', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[color]',
				'class'       => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\Color',
				'type'        => 'tgwc-color',
				'custom_args' => array(
					'alpha' => false,
				),
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[color][body]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'       => esc_html__( 'Body Color', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Select Body color', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[color]',
				'type'        => 'color'
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[color][link]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'       => esc_html__( 'Link Color', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Select Link color', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[color]',
				'type'        => 'color'
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[color][link_hover]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'       => esc_html__( 'Link Hover Color', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Select Link hover color', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[color]',
				'type'        => 'color'
			),
		);

		return $controls;
	}
}
