<?php
/**
 * Avatar configs.
 *
 * @package ThemeGrill\WoocommerceCustomizer\Customizer\Config
 * @since   0.1.0
 */

namespace ThemeGrill\WoocommerceCustomizer\Customizer\Config;

defined( 'ABSPATH' ) || exit;

class Avatar {
	/**
	 * Instance variable.
	 *
	 * @since 0.1.0
	 * @static
	 *
	 * @var Avatar
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
	 * @return Avatar
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
		add_filter( 'tgwc_customizer_controls', array( $this, 'add_controls' ) );
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
			'id'          => 'tgwc_customize[avatar]',
			'title'       => esc_html__( 'Avatar', 'customize-my-account-page-for-woocommerce' ),
			'description' => esc_html__( 'Customize the Avatar style and layout.', 'customize-my-account-page-for-woocommerce' ),
			'priority'    => 170,
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
			'id'      => 'tgwc_customize[avatar][layout]',
			'setting' => array(
				'default'           => 'left',
				'sanitize_callback' => 'sanitize_text_field',
			),
			'control' => array(
				'label'       => esc_html__( 'Avatar Layout', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Choose Avatar layout', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[avatar]',
				'type'        => 'tgwc-image_radio',
				'class'       => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\ImageRadio',
				'choices'     => array(
					'left'     => array(
						'name'   => esc_html__( 'Avatar left aligned', 'customize-my-account-page-for-woocommerce' ),
						'image'  => plugins_url( '/assets/images/avatar-left-aligned.png', TGWC_PLUGIN_FILE ),
						'width'  => 100,
						'height' => 100,
					),
					'right'    => array(
						'name'   => esc_html__( 'Avatar right aligned', 'customize-my-account-page-for-woocommerce' ),
						'image'  => plugins_url( '/assets/images/avatar-right-aligned.png', TGWC_PLUGIN_FILE ),
						'width'  => 100,
						'height' => 100,
					),
					'center'   => array(
						'name'   => esc_html__( 'Avatar center aligned', 'customize-my-account-page-for-woocommerce' ),
						'image'  => plugins_url( '/assets/images/avatar-center-aligned.png', TGWC_PLUGIN_FILE ),
						'width'  => 100,
						'height' => 100,
					),
					'vertical' => array(
						'name'   => esc_html__( 'Avatar vertical aligned', 'customize-my-account-page-for-woocommerce' ),
						'image'  => plugins_url( '/assets/images/avatar-vertical-aligned.png', TGWC_PLUGIN_FILE ),
						'width'  => 100,
						'height' => 100,
					),
				),
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[avatar][type]',
			'setting' => array(
				'default'           => 'left',
				'sanitize_callback' => 'sanitize_text_field',
			),
			'control' => array(
				'label'       => esc_html__( 'Avatar Type', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Choose Avatar type', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[avatar]',
				'type'        => 'tgwc-image_radio',
				'class'       => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\ImageRadio',
				'choices'     => array(
					'square' => array(
						'name'   => esc_html__( 'Avatar type square', 'customize-my-account-page-for-woocommerce' ),
						'image'  => plugins_url( '/assets/images/avatar-thumb-square.png', TGWC_PLUGIN_FILE ),
						'width'  => 100,
						'height' => 100,
					),
					'circle' => array(
						'name'   => esc_html__( 'Avatar type circle', 'customize-my-account-page-for-woocommerce' ),
						'image'  => plugins_url( '/assets/images/avatar-thumb-circle.png', TGWC_PLUGIN_FILE ),
						'width'  => 100,
						'height' => 100,
					),
				),
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[avatar][padding]',
			'setting' => array(
				'default' => array(
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
				),
			),
			'control' => array(
				'label'       => esc_html__( 'Padding', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Set Avatar Padding', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[avatar]',
				'type'        => 'tgwc-dimension',
				'class'       => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\Dimension',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 250,
					'step' => 1,
				),
				'custom_args' => array(
					'anchor'     => true,
					'responsive' => true,
					'input_type' => 'number',
				),
			),
		);

		return $controls;
	}
}
