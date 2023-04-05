<?php
/**
 * Content configs.
 *
 * @package ThemeGrill\WoocommerceCustomizer\Customizer\Config
 * @since   0.4.1
 */

namespace ThemeGrill\WoocommerceCustomizer\Customizer\Config;

defined( 'ABSPATH' ) || exit;

class Content {

	/**
	 * Instance variable.
	 *
	 * @since 0.4.1
	 * @var null
	 */
	private static $instance = null;

	/**
	 * Constructor.
	 *
	 * @since 0.4.1
	 */
	private function __construct() {
		$this->init_hooks();
	}

	/**
	 * Initialize and get instance of the class.
	 *
	 * @since 0.4.1
	 * @return Content|null
	 */
	public static function init() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Initialize hooks.
	 *
	 * @since 0.4.1
	 * @return void
	 */
	private function init_hooks() {
		add_filter( 'tgwc_customizer_sections', array( $this, 'add_sections' ) );
		add_filter( 'tgwc_customizer_controls', array( $this, 'add_controls' ) );
	}

	/**
	 * Add sections.
	 *
	 * @since 0.4.1
	 * @param array $sections List of sections.
	 * @return array Modified list of sections.
	 */
	public function add_sections( $sections ) {
		$sections[] = array(
			'id'          => 'tgwc_customize[content]',
			'title'       => esc_html__( 'Content', 'customize-my-account-page-for-woocommerce' ),
			'description' => esc_html__( 'Content styles.', 'customize-my-account-page-for-woocommerce' ),
			'priority'    => 180,
		);

		return $sections;
	}

	/**
	 * Add controls.
	 *
	 * @since 0.4.1
	 * @param array $controls List of controls.
	 * @return array Modified list of controls.
	 */
	public function add_controls( $controls ) {
		$controls[] = array(
			'id'      => 'tgwc_customize[content][background_color]',
			'setting' => array(
				'default' => '',
			),
			'control' => array(
				'label'       => esc_html__( 'Background color', 'customize-my-account-page-for-woocommerce' ),
				'description' => esc_html__( 'Choose Content Background color', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[content]',
				'class'       => 'ThemeGrill\WoocommerceCustomizer\Customizer\Controls\Color',
				'type'        => 'tgwc-color',
				'custom_args' => array(
					'alpha' => true,
				),
			),
		);

		$controls[] = array(
			'id'      => 'tgwc_customize[content][margin]',
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
				'description' => esc_html__( 'Set Content Margin', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[content]',
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
			'id'      => 'tgwc_customize[content][padding]',
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
				'description' => esc_html__( 'Set Content Padding', 'customize-my-account-page-for-woocommerce' ),
				'section'     => 'tgwc_customize[content]',
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
