<?php
/**
 * Navigation configs.
 *
 * @package ThemeGrill\WoocommerceCustomizer\Customizer\Config
 * @since   0.1.0
 */

namespace ThemeGrill\WoocommerceCustomizer\Customizer\Config;

defined( 'ABSPATH' ) || exit;

class Navigation {
	/**
	 * Instance variable.
	 *
	 * @since 0.1.0
	 * @static
	 *
	 * @var ThemeGrill\WoocommerceCustomizer\Customizer\Config\Navigation
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
	 * @return ThemeGrill\WoocommerceCustomizer\Customizer\Config\Navigation
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
			'id'          => 'tgwc_customize[navigation]',
			'title'       => esc_html__( 'Navigation', 'customize-my-account-page-for-woocommerce' ),
			'description' => esc_html__( 'Navigation menu styles', 'customize-my-account-page-for-woocommerce' ),
			'priority'    => 175,
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
		$controls = array_merge( $controls, $this->normal_controls() );
		$controls = array_merge( $controls, $this->hover_controls() );
		$controls = array_merge( $controls, $this->active_controls() );
		$controls = array_merge( $controls, $this->general_controls() );

		return $controls;
	}

	/**
	 * Active section controls.
	 *
	 * @return array Active section controls.
	 */
	private function active_controls() {
		$controls[] = array(
			'id'      => 'tgwc_customize[navigation][active][label]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'   => esc_html__( 'Active State', 'customize-my-account-page-for-woocommerce' ),
				'section' => 'tgwc_customize[navigation]',
				'type'    => 'tgwc-label',
				'class'   => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\Label',
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[navigation][active][color]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'       => esc_html__( 'Text Color', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Choose tab active text color', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[navigation]',
				'type'        => 'color',
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[navigation][active][background_color]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'       => esc_html__( 'Background Color', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Choose tab active background color', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[navigation]',
				'type'        => 'color',
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[navigation][active][border_style]',
			'setting' => array(
				'default' => 'inherit',
			),
			'control' => array(
				'label'       => esc_html__( 'Border', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Select active background border style', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[navigation]',
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
			'id'      => 'tgwc_customize[navigation][active][border_width]',
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
				'description'     => esc_html__( 'Set tab active border width', 'customize-my-account-page-for-woocommerce' ),
				'section'         => 'tgwc_customize[navigation]',
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
					$border_control = $manager->get_control( 'tgwc_customize[navigation][active][border_style]' );
					$border = $border_control->value();
					return 'none' !== $border;
				},
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[navigation][active][border_color]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'           => esc_html__( 'Border Color', 'customize-my-account-page-for-woocommerce' ),
				'description'     => esc_html__( 'Choose tab active border color', 'customize-my-account-page-for-woocommerce' ),
				'section'         => 'tgwc_customize[navigation]',
				'type'            => 'color',
				'active_callback' => function( $control ) {
					$manager = $control->setting->manager;
					$border_control = $manager->get_control( 'tgwc_customize[navigation][hover][border_style]' );
					$border = $border_control->value();
					return 'none' !== $border;
				},
			),

		);

		return $controls;
	}

	/**
	 * Hover section controls.
	 *
	 * @since 0.1.0
	 *
	 * @return array Hover section controls.
	 */
	private function hover_controls() {
		$controls[] = array(
			'id'      => 'tgwc_customize[navigation][hover][label]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'   => esc_html__( 'Hover State', 'customize-my-account-page-for-woocommerce' ),
				'section' => 'tgwc_customize[navigation]',
				'type'    => 'tgwc-label',
				'class'   => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\Label',
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[navigation][hover][color]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'       => esc_html__( 'Text Color', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Choose tab hover text color', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[navigation]',
				'type'        => 'color',
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[navigation][hover][background_color]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'       => esc_html__( 'Background Color', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Choose tab hover background color', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[navigation]',
				'type'        => 'color',
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[navigation][hover][border_style]',
			'setting' => array(
				'default' => 'inherit',
			),
			'control' => array(
				'label'       => esc_html__( 'Border', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Select hover background border style', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[navigation]',
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
			'id'      => 'tgwc_customize[navigation][hover][border_width]',
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
				'description'     => esc_html__( 'Set tab hover border width', 'customize-my-account-page-for-woocommerce' ),
				'section'         => 'tgwc_customize[navigation]',
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
					$border_control = $manager->get_control( 'tgwc_customize[navigation][hover][border_style]' );
					$border = $border_control->value();
					return 'none' !== $border;
				},
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[navigation][hover][border_color]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'           => esc_html__( 'Border Color', 'customize-my-account-page-for-woocommerce' ),
				'description'     => esc_html__( 'Choose tab hover border color', 'customize-my-account-page-for-woocommerce' ),
				'section'         => 'tgwc_customize[navigation]',
				'type'            => 'color',
				'active_callback' => function( $control ) {
					$manager = $control->setting->manager;
					$border_control = $manager->get_control( 'tgwc_customize[navigation][hover][border_style]' );
					$border = $border_control->value();
					return 'none' !== $border;
				},
			),

		);

		return $controls;
	}

	/**
	 * Normal section controls.
	 *
	 * @since 0.1.0
	 *
	 * @return array Normal section controls.
	 */
	private function normal_controls() {
		$controls[] = array(
			'id'      => 'tgwc_customize[navigation][normal][label]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'   => esc_html__( 'Normal State', 'customize-my-account-page-for-woocommerce' ),
				'section' => 'tgwc_customize[navigation]',
				'type'    => 'tgwc-label',
				'class'   => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\Label',
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[navigation][normal][color]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'       => esc_html__( 'Text Color', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Choose Tab text color', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[navigation]',
				'type'        => 'color',
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[navigation][normal][background_color]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'       => esc_html__( 'Background Color', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Choose tab background color', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[navigation]',
				'type'        => 'color',
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[navigation][normal][border_style]',
			'setting' => array(
				'default' => 'solid',
			),
			'control' => array(
				'label'       => esc_html__( 'Border', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Select tab background border', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[navigation]',
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
			'id'      => 'tgwc_customize[navigation][normal][border_width]',
			'setting' => array(
				'default' => array(
					'top'    => 1,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
				),
			),
			'control' => array(
				'label'           => esc_html__( 'Border Width', 'customize-my-account-page-for-woocommerce' ),
				'description'     => esc_html__( 'Set tab border width', 'customize-my-account-page-for-woocommerce' ),
				'section'         => 'tgwc_customize[navigation]',
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
					$border_control = $manager->get_control( 'tgwc_customize[navigation][normal][border_style]' );
					$border = $border_control->value();
					return 'none' !== $border;
				},
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[navigation][normal][border_color]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'           => esc_html__( 'Border Color', 'customize-my-account-page-for-woocommerce' ),
				'description'     => esc_html__( 'Choose tab border color', 'customize-my-account-page-for-woocommerce' ),
				'section'         => 'tgwc_customize[navigation]',
				'type'            => 'color',
				'active_callback' => function( $control ) {
					$manager = $control->setting->manager;
					$border_control = $manager->get_control( 'tgwc_customize[navigation][normal][border_style]' );
					$border = $border_control->value();
					return 'none' !== $border;
				},
			),
		);

		return $controls;
	}

	/**
	 * General section controls.
	 *
	 * @since 0.1.0
	 *
	 * @return array General section controls.
	 */
	private function general_controls() {
		$controls[] = array(
			'id'      => 'tgwc_customize[navigation][general][label]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'   => esc_html__( 'General', 'customize-my-account-page-for-woocommerce' ),
				'section' => 'tgwc_customize[navigation]',
				'type'    => 'tgwc-label',
				'class'   => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\Label',
			),
		);
		$controls[] = array(
			'id'      => 'tgwc_customize[navigation][general][wrapper_margin]',
			'setting' => array(
				'default' => array(
					'desktop' => array(
						'top'    => 20,
						'right'  => 0,
						'bottom' => 20,
						'left'   => 0,
					),
				),
			),
			'control' => array(
				'label'           => esc_html__( 'Wrapper Margin', 'customize-my-account-page-for-woocommerce' ),
				'description'     => esc_html__( 'Navigation wrapper margin', 'customize-my-account-page-for-woocommerce' ),
				'section'         => 'tgwc_customize[navigation]',
				'type'            => 'tgwc-dimension',
				'class'           => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\Dimension',
				'input_attrs'     => array(
					'min'  => 0,
					'max'  => 250,
					'step' => 1,
				),
				'custom_args'     => array(
					'anchor'     => true,
					'responsive' => true,
					'input_type' => 'number',
				),
				'active_callback' => function( $control ) {
					$manager = $control->setting->manager;
					$menu_style = $manager->get_control( 'tgwc_customize[wrapper][menu_style]' )->value();
					return 'tab' === $menu_style;
				},
			),
		);
		$controls[] = array(
			'id'      => 'tgwc_customize[navigation][general][wrapper_padding]',
			'setting' => array(
				'default' => array(
					'desktop' => array(
						'top'    => 0,
						'right'  => 15,
						'bottom' => 0,
						'left'   => 15,
					),
				),
			),
			'control' => array(
				'label'           => esc_html__( 'Wrapper Padding', 'customize-my-account-page-for-woocommerce' ),
				'description'     => esc_html__( 'Navigation wrapper padding.', 'customize-my-account-page-for-woocommerce' ),
				'section'         => 'tgwc_customize[navigation]',
				'type'            => 'tgwc-dimension',
				'class'           => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\Dimension',
				'input_attrs'     => array(
					'min'  => 0,
					'max'  => 250,
					'step' => 1,
				),
				'custom_args'     => array(
					'anchor'     => true,
					'responsive' => true,
					'input_type' => 'number',
				),
				'active_callback' => function( $control ) {
					$manager = $control->setting->manager;
					$menu_style = $manager->get_control( 'tgwc_customize[wrapper][menu_style]' )->value();
					return 'sidebar' === $menu_style;
				},
			),
		);
		$controls[] = array(
			'id'      => 'tgwc_customize[navigation][general][padding]',
			'setting' => array(
				'default' => array(
					'desktop' => array(
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
				),
			),
			'control' => array(
				'label'       => esc_html__( 'Padding', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Set navigation item padding.', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[navigation]',
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
