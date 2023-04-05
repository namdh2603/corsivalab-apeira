<?php
/**
 * Button configs.
 *
 * @package ThemeGrill\WoocommerceCustomizer\Customizer\Config
 * @since   0.1.0
 */

namespace ThemeGrill\WoocommerceCustomizer\Customizer\Config;

defined( 'ABSPATH' ) || exit;

class Button {
	/**
	 * Instance variable.
	 *
	 * @since 0.1.0
	 * @static
	 *
	 * @var ThemeGrill\WoocommerceCustomizer\Customizer\Config\Button
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
	 * @return ThemeGrill\WoocommerceCustomizer\Customizer\Config\Button
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
			'id'          => 'tgwc_customize[button]',
			'title'       => esc_html__( 'Buttons', 'customize-my-account-page-for-woocommerce' ),
			'description' => esc_html__( 'Buttons description', 'customize-my-account-page-for-woocommerce' ),
			'priority'    => 185,
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
		$controls = array_merge( $controls, $this->general_controls_1() );
		$controls = array_merge( $controls, $this->normal_controls() );
		$controls = array_merge( $controls, $this->hover_controls() );
		$controls = array_merge( $controls, $this->general_controls_2() );

		return $controls;
	}

	/**
	 * Hover controls.
	 *
	 * @since 0.1.0
	 *
	 * @return array Hover controls.
	 */
	private function hover_controls() {
		$controls[] = array(
			'id'      => 'tgwc_customize[button][hover][label]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'   => esc_html__( 'Hover State', 'customize-my-account-page-for-woocommerce' ),
				'section' => 'tgwc_customize[button]',
				'type'    => 'tgwc-label',
				'class'   => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\Label',
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[button][hover][color]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'       => esc_html__( 'Text Color', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Choose text color', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[button]',
				'type'        => 'color',
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[button][hover][background_color]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'       => esc_html__( 'Background Color', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Choose background color', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[button]',
				'type'        => 'color',
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[button][hover][border_style]',
			'setting' => array(
				'default' => 'inherit',
			),
			'control' => array(
				'label'       => esc_html__( 'Border', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Choose background border style', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[button]',
				'type'        => 'select',
				'choices'     => array(
					'none'    => esc_html__( 'None', 'customize-my-account-page-for-woocommerce' ),
					'solid'   => esc_html__( 'Solid', 'customize-my-account-page-for-woocommerce' ),
					'dotted'  => esc_html__( 'Dotted', 'customize-my-account-page-for-woocommerce' ),
					'dashed'  => esc_html__( 'Dashed', 'customize-my-account-page-for-woocommerce' ),
					'double'  => esc_html__( 'Double', 'customize-my-account-page-for-woocommerce' ),
					'groove'  => esc_html__( 'Groove', 'customize-my-account-page-for-woocommerce' ),
					'ridge'   => esc_html__( 'Ridge', 'customize-my-account-page-for-woocommerce' ),
					'inset'   => esc_html__( 'Inset', 'customize-my-account-page-for-woocommerce' ),
					'outset'  => esc_html__( 'Outset', 'customize-my-account-page-for-woocommerce' ),
					'hidden'  => esc_html__( 'hidden', 'customize-my-account-page-for-woocommerce' ),
					'inherit' => esc_html__( 'Inherit', 'customize-my-account-page-for-woocommerce' ),
				),
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[button][hover][border_width]',
			'setting' => array(
				'default' => array(
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
				),
			),
			'control' => array(
				'label'           => esc_html__( 'Border Width', 'customize-my-account-page-for-woocommerce' ),
				'description'     => esc_html__( 'Set border width', 'customize-my-account-page-for-woocommerce' ),
				'section'         => 'tgwc_customize[button]',
				'type'            => 'tgwc-dimension',
				'class'           => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\Dimension',
				'input_attrs'     => array(
					'min'  => 0,
					'max'  => 250,
					'step' => 1,
				),
				'custom_args'     => array(
					'anchor'     => true,
					'input_type' => 'number',
				),
				'active_callback' => function( $control ) {
					$manager = $control->setting->manager;
					$border_control = $manager->get_control( 'tgwc_customize[button][hover][border_style]' );
					$border = $border_control->value();
					return 'none' !== $border;
				},
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[button][hover][border_color]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'           => esc_html__( 'Border Color', 'customize-my-account-page-for-woocommerce' ),
				'description'     => esc_html__( 'Border color description', 'customize-my-account-page-for-woocommerce' ),
				'section'         => 'tgwc_customize[button]',
				'type'            => 'color',
				'active_callback' => function( $control ) {
					$manager = $control->setting->manager;
					$border_control = $manager->get_control( 'tgwc_customize[button][hover][border_style]' );
					$border = $border_control->value();
					return 'none' !== $border;
				},
			),
		);

		return $controls;
	}

	/**
	 * Normal controls.
	 *
	 * @since 0.1.0
	 *
	 * @return array Normal controls.
	 */
	private function normal_controls() {
		$controls[] = array(
			'id'      => 'tgwc_customize[button][normal][label]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'   => esc_html__( 'Normal State', 'customize-my-account-page-for-woocommerce' ),
				'section' => 'tgwc_customize[button]',
				'type'    => 'tgwc-label',
				'class'   => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\Label',
			),
		);
		$controls[] = array(
			'id'      => 'tgwc_customize[button][normal][color]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'       => esc_html__( 'Text Color', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Choose text color', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[button]',
				'type'        => 'color',
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[button][normal][background_color]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'       => esc_html__( 'Background Color', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Choose background color', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[button]',
				'type'        => 'color',
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[button][normal][border_style]',
			'setting' => array(
				'default' => 'none',
			),
			'control' => array(
				'label'       => esc_html__( 'Border', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Choose border style', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[button]',
				'type'        => 'select',
				'choices'     => array(
					'none'    => esc_html__( 'None', 'customize-my-account-page-for-woocommerce' ),
					'solid'   => esc_html__( 'Solid', 'customize-my-account-page-for-woocommerce' ),
					'dotted'  => esc_html__( 'Dotted', 'customize-my-account-page-for-woocommerce' ),
					'dashed'  => esc_html__( 'Dashed', 'customize-my-account-page-for-woocommerce' ),
					'double'  => esc_html__( 'Double', 'customize-my-account-page-for-woocommerce' ),
					'groove'  => esc_html__( 'Groove', 'customize-my-account-page-for-woocommerce' ),
					'ridge'   => esc_html__( 'Ridge', 'customize-my-account-page-for-woocommerce' ),
					'inset'   => esc_html__( 'Inset', 'customize-my-account-page-for-woocommerce' ),
					'outset'  => esc_html__( 'Outset', 'customize-my-account-page-for-woocommerce' ),
					'hidden'  => esc_html__( 'hidden', 'customize-my-account-page-for-woocommerce' ),
					'inherit' => esc_html__( 'Inherit', 'customize-my-account-page-for-woocommerce' ),
				),
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[button][normal][border_width]',
			'setting' => array(
				'default' => array(
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
				),
			),
			'control' => array(
				'label'           => esc_html__( 'Border Width', 'customize-my-account-page-for-woocommerce' ),
				'description'     => esc_html__( 'Border width description', 'customize-my-account-page-for-woocommerce' ),
				'section'         => 'tgwc_customize[button]',
				'type'            => 'tgwc-dimension',
				'class'           => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\Dimension',
				'input_attrs'     => array(
					'min'  => 0,
					'max'  => 250,
					'step' => 1,
				),
				'custom_args'     => array(
					'anchor'     => true,
					'input_type' => 'number',
				),
				'active_callback' => function( $control ) {
					$manager = $control->setting->manager;
					$border_control = $manager->get_control( 'tgwc_customize[button][normal][border_style]' );
					$border = $border_control->value();
					return 'none' !== $border;
				},
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[button][normal][border_color]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'           => esc_html__( 'Border Color', 'customize-my-account-page-for-woocommerce' ),
				'description'     => esc_html__( 'Border color description', 'customize-my-account-page-for-woocommerce' ),
				'section'         => 'tgwc_customize[button]',
				'type'            => 'color',
				'active_callback' => function( $control ) {
					$manager = $control->setting->manager;
					$border_control = $manager->get_control( 'tgwc_customize[button][normal][border_style]' );
					$border = $border_control->value();
					return 'none' !== $border;
				},
			),
		);

		return $controls;
	}

	/**
	 * General controls set 1.
	 *
	 * @since 0.1.0
	 *
	 * @return array General controls.
	 */
	private function general_controls_1() {
		$controls[] = array(
			'id'      => 'tgwc_customize[button][general][label1]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'   => esc_html__( 'General', 'customize-my-account-page-for-woocommerce' ),
				'section' => 'tgwc_customize[button]',
				'type'    => 'tgwc-label',
				'class'   => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\Label',
			),
		);
		$controls[] = array(
			'id'      => 'tgwc_customize[button][general][font_size]',
			'setting' => array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			),
			'control' => array(
				'label'       => esc_html__( 'Font Size', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Choose font size', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[button]',
				'type'        => 'tgwc-slider',
				'class'       => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\Slider',
				'input_attrs' => array(
					'min'  => 12,
					'max'  => 120,
					'step' => 1,
				),
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[button][general][line_height]',
			'setting' => array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			),
			'control' => array(
				'label'       => esc_html__( 'Line Height', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Choose line height', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[button]',
				'type'        => 'tgwc-slider',
				'class'       => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\Slider',
				'input_attrs' => array(
					'min'  => 1,
					'max'  => 10,
					'step' => .01,
				),
			),
		);

		return $controls;
	}

	/**
	 * General controls set 2.
	 *
	 * @since 0.1.0
	 *
	 * @return array General controls.
	 */
	private function general_controls_2() {
		$controls[] = array(
			'id'      => 'tgwc_customize[button][general][label2]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'   => esc_html__( 'General', 'customize-my-account-page-for-woocommerce' ),
				'section' => 'tgwc_customize[button]',
				'type'    => 'tgwc-label',
				'class'   => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\Label',
			),
		);
		$controls[] = array(
			'id'      => 'tgwc_customize[button][general][padding]',
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
				'description' => esc_html__( 'Set Padding', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[button]',
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
			'id'      => 'tgwc_customize[button][general][margin]',
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
				'description' => esc_html__( 'Set Margin', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[button]',
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
