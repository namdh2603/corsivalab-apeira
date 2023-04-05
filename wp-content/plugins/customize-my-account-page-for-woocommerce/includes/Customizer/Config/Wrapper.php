<?php
/**
 * Wrapper configs.
 *
 * @package ThemeGrill\WoocommerceCustomizer\Customizer\Config
 * @since   0.1.0
 */

namespace ThemeGrill\WoocommerceCustomizer\Customizer\Config;

defined( 'ABSPATH' ) || exit;

class Wrapper {
	/**
	 * Instance variable.
	 *
	 * @since 0.1.0
	 * @static
	 *
	 * @var ThemeGrill\WoocommerceCustomizer\Customizer\Config\Wrapper
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
	 * @return ThemeGrill\WoocommerceCustomizer\Customizer\Config\Wrapper
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
			'id'          => 'tgwc_customize[wrapper]',
			'title'       => esc_html__( 'Wrapper', 'customize-my-account-page-for-woocommerce' ),
			'description' => esc_html__( 'Customize the wrapper layout and design.', 'customize-my-account-page-for-woocommerce' ),
			'priority'    => 160,
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
			'id'      => 'tgwc_customize[wrapper][menu_style]',
			'setting' => array(
				'default'           => 'sidebar',
				'sanitize_callback' => 'sanitize_text_field',
			),
			'control' => array(
				'label'       => esc_html__( 'Navigation Style', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Choose Account Tab style ', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[wrapper]',
				'type'        => 'tgwc-buttonset',
				'class'       => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\ButtonSet',
				'choices'     => array(
					'sidebar' => array(
						'name' => esc_html__( 'Sidebar', 'customize-my-account-page-for-woocommerce' ),
					),
					'tab'     => array(
						'name' => esc_html__( 'Tab', 'customize-my-account-page-for-woocommerce' ),
					),
				),
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[wrapper][sidebar_position]',
			'setting' => array(
				'default'           => 'left',
				'sanitize_callback' => 'sanitize_text_field',
			),
			'control' => array(
				'label'           => esc_html__( 'Sidebar Position', 'customize-my-account-page-for-woocommerce' ),
				'description'     => esc_html__( 'Choose Sidebar style', 'customize-my-account-page-for-woocommerce' ),
				'section'         => 'tgwc_customize[wrapper]',
				'type'            => 'tgwc-image_radio',
				'class'           => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\ButtonSet',
				'choices'         => array(
					'left'  => array(
						'name'   => esc_html__( 'Sidebar left', 'customize-my-account-page-for-woocommerce' ),
						'image'  => plugins_url( '/assets/images/sidebar-left.png', TGWC_PLUGIN_FILE ),
						'width'  => 100,
						'height' => 100,
					),
					'right' => array(
						'name'   => esc_html__( 'Sidebar right', 'customize-my-account-page-for-woocommerce' ),
						'image'  => plugins_url( '/assets/images/sidebar-right.png', TGWC_PLUGIN_FILE ),
						'width'  => 100,
						'height' => 100,
					),
				),
				'active_callback' => function( $control ) {
					$manager = $control->setting->manager;
					$border_control = $manager->get_control( 'tgwc_customize[wrapper][menu_style]' );
					$border = $border_control->value();
					return 'sidebar' === $border;
				},
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[wrapper][font_family]',
			'setting' => array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			),
			'control' => array(
				'label'       => esc_html__( 'Font Family', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Select a desire Google font.', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[wrapper]',
				'class'       => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\Select2',
				'type'        => 'tgwc-select2',
				'input_attrs' => array(
					'data-allow_clear' => true,
					'data-placeholder' => _x( 'Select Font Family&hellip;', 'enhanced select', 'customize-my-account-page-for-woocommerce' ),
				),
				'custom_args' => array(
					'google_font' => true,
				),
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[wrapper][font_size]',
			'setting' => array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			),
			'control' => array(
				'label'       => esc_html__( 'Font Size', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Customize the font size.', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[wrapper]',
				'type'        => 'tgwc-slider',
				'class'       => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\Slider',
				'input_attrs' => array(
					'min'  => 12,
					'max'  => 100,
					'step' => 1,
				),
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[wrapper][background_color]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'       => esc_html__( 'Background color', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Choose Wrapper Background color', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[wrapper]',
				'class'       => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\Color',
				'type'        => 'tgwc-color',
				'custom_args' => array(
					'alpha' => true,
				),
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[wrapper][padding]',
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
				'description' => esc_html__( 'Set Wrapper Padding', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[wrapper]',
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

		$controls[] = array(
			'id'      => 'tgwc_customize[wrapper][margin]',
			'setting' => array(
				'default' => array(
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
				),
			),
			'control' => array(
				'label'       => esc_html__( 'Margin', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Set Wrapper Margin', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[wrapper]',
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
