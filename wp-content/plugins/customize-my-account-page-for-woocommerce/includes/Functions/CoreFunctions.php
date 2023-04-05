<?php

use ThemeGrill\WoocommerceCustomizer\Icon;

if ( ! function_exists( 'tgwc_define' ) ) {
	/**
	 * Define a constant only when it is not set.
	 *
	 * @since 0.1.0
	 * @return void
	 */
	function tgwc_define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}
}

if ( ! function_exists( 'tgwc_get_default_endpoint_options' ) ) {
	/**
	 * Default endpoint options.
	 *
	 * @since 0.1.0
	 *
	 * @param string $endpoint Endpoint label.
	 * @return array
	 */
	function tgwc_get_default_endpoint_options( $endpoint = '' ) {
		$options = array(
			'type'             => 'endpoint',
			'enable'           => true,
			'label'            => $endpoint,
			'slug'             => '',
			'icon'             => '',
			'class'            => array(),
			'user_role'        => array(),
			'content_position' => 'after',
			'content'          => '',
		);

		return apply_filters( 'tgwc_get_default_endpoint_options', $options, $endpoint );
	}
}

if ( ! function_exists( 'tgwc_get_default_link_options' ) ) {
	/**
	 * Default link options.
	 *
	 * @since 0.1.0
	 *
	 * @param string $link
	 * @return array
	 */
	function tgwc_get_default_link_options( $link = '' ) {
		$options = array(
			'type'      => 'link',
			'enable'    => true,
			'url'       => '',
			'label'     => $link,
			'icon'      => '',
			'class'     => array(),
			'user_role' => array(),
			'new_tab'   => false,
		);

		return apply_filters( 'tgwc_get_default_link_options', $options, $link );
	}
}

if ( ! function_exists( 'tgwc_get_default_group_options' ) ) {
	/**
	 * Default group options.
	 *
	 * @since 0.1.0
	 *
	 * @param string $group
	 *
	 * @return array
	 */
	function tgwc_get_default_group_options( $group = '' ) {
		$options = array(
			'type'      => 'group',
			'enable'    => true,
			'label'     => $group,
			'icon'      => '',
			'class'     => array(),
			'user_role' => array(),
			'show_open' => false,
			'children'  => array(),
		);

		return apply_filters( 'tgwc_get_default_group_options', $options, $group );
	}
}

if ( ! function_exists( 'tgwc_is_default_endpoint' ) ) {
	/**
	 * Check whether the endpoint is a default one.
	 *
	 * @since 0.1.0
	 * @param $endpoint
	 * @return bool
	 */
	function tgwc_is_default_endpoint( $endpoint ) {
		$default_endpoints = TGWC()->account_menu->get_default_endpoints();

		return isset( $default_endpoints[ $endpoint ] );
	}
}


if ( ! function_exists( 'tgwc_get_endpoint' ) ) {
	/**
	 * Get endpoint or link or group by endpoint.
	 *
	 * @since 0.1.0
	 *
	 * @param string $slug Endpoint slug.
	 *
	 * @return array Endpoint.
	 */
	function tgwc_get_endpoint( $slug ) {
		$endpoints = tgwc_get_endpoints_flat();
		$endpoint  = isset( $endpoints[ $slug ] ) ? $endpoints[ $slug ] : false;

		return apply_filters( 'tgwc_get_endpoint', $endpoint, $slug );
	}
}

if ( ! function_exists( 'tgwc_get_endpoints_by_type' ) ) {
	/**
	 * Get endpoints by type.
	 *
	 * @since 0.1.0
	 *
	 * @param string $type Endpoint type. (e.g. link, endpoint or group).
	 *
	 * @return array List of endpoints
	 */
	function tgwc_get_endpoints_by_type( $type ) {
		$endpoints = tgwc_get_endpoints_flat();

		$endpoints = array_filter(
			$endpoints,
			function( $endpoint ) use ( $type ) {
				return $type === $endpoint['type'];
			}
		);

		return apply_filters( 'tgwc_get_endpoints_by_type', $endpoints, $type );
	}
}

if ( ! function_exists( 'tgwc_is_link' ) ) {
	/**
	 * Check whether the endpoint is of link type.
	 *
	 * @since 0.1.0
	 *
	 * @param string $endpoint Endpoint slug.
	 *
	 * @return boolean
	 */
	function tgwc_is_link( $endpoint ) {
		$endpoints = tgwc_get_endpoints_flat();

		if ( isset( $endpoints[ $endpoint ] )
			&& 'link' === $endpoints[ $endpoint ]['type'] ) {
			$is_link = true;
		} else {
			$is_link = false;
		}

		return apply_filters( 'tgwc_is_link', $is_link, $endpoint );
	}
}

if ( ! function_exists( 'tgwc_is_new_tab' ) ) {
	/**
	 * Check whether the endpoint new tab is set or not.
	 *
	 * @since 0.1.0
	 *
	 * @param string $endpoint Endpoint slug.
	 *
	 * @return boolean.
	 */
	function tgwc_is_new_tab( $endpoint ) {
		$endpoint = tgwc_get_endpoint( $endpoint );
		$new_tab  = isset( $endpoint['new_tab'] ) ? $endpoint['new_tab'] : false;

		return apply_filters( 'tgwc_is_new_tab', $new_tab, $endpoint );
	}
}

if ( ! function_exists( 'tgwc_get_link_url' ) ) {
	/**
	 * Get endpoint url.
	 *
	 * @since 0.1.0
	 *
	 * @param string $endpoint Endpoint slug.
	 *
	 * @return string Endpoint url.
	 */
	function tgwc_get_link_url( $endpoint ) {
		$endpoint = tgwc_get_endpoint( $endpoint );
		$url      = isset( $endpoint['url'] ) ? $endpoint['url'] : '';

		return apply_filters( 'tgwc_get_link_url', $url, $endpoint );
	}
}

if ( ! function_exists( 'tgwc_get_endpoint_class' ) ) {
	/**
	 * Get endpoint class.
	 *
	 * @since 0.1.0
	 *
	 * @param string $endpoint Endpoint slug.
	 *
	 * @return string Endpoint class.
	 */
	function tgwc_get_endpoint_class( $endpoint ) {
		$endpoint = tgwc_get_endpoint( $endpoint );

		$class = ! empty( $endpoint['class'] ) ? $endpoint['class'] : array();

		return apply_filters( 'tgwc_get_endpoint_class', $class, $endpoint );
	}
}

if ( ! function_exists( 'tgwc_get_endpoint_content_position' ) ) {
	/**
	 * Get endpoint class.
	 *
	 * @since 0.1.0
	 *
	 * @param string $endpoint Endpoint slug.
	 *
	 * @return string Endpoint class.
	 */
	function tgwc_get_endpoint_content_position( $endpoint ) {
		$endpoint = tgwc_get_endpoint( $endpoint );

		$position = ! empty( $endpoint['content_position'] ) ? $endpoint['content_position'] : 'after';

		return apply_filters( 'tgwc_get_endpoint_content_position', $position, $endpoint );
	}
}

if ( ! function_exists( 'tgwc_get_endpoint_icon' ) ) {
	/**
	 * Get endpoint icon.
	 *
	 * @since 0.1.0
	 *
	 * @param string $endpoint Endpoint slug.
	 *
	 * @return string Endpoint icon.
	 */
	function tgwc_get_endpoint_icon( $endpoint ) {
		$endpoint = tgwc_get_endpoint( $endpoint );

		$icon = $endpoint ? $endpoint['icon'] : '';

		return apply_filters( 'tgwc_get_endpoint_icon', $icon, $endpoint );
	}
}

if ( ! function_exists( 'tgwc_get_icon_list' ) ) {
	/**
	 * Get icon list.
	 *
	 * @since 0.1.0
	 *
	 * @return array Icon list.
	 */
	function tgwc_get_icon_list() {
		if ( file_exists( TGWC_ABSPATH . 'includes/icon-list.php' ) ) {
			return include TGWC_ABSPATH . 'includes/icon-list.php';
		}

		return array();
	}
}

if ( ! function_exists( 'tgwc_get_endpoints_flat' ) ) {
	/**
	 * Get the endpoints flat (One Dimensional).
	 *
	 * @since 0.1.0
	 *
	 * @param array Endpoints.
	 * @return array
	 */
	function tgwc_get_endpoints_flat( $endpoints = array() ) {
		if ( empty( $endpoints ) ) {
			$endpoints = TGWC()->get_settings()->get_endpoints();
		}
		$flat_endpoints = array();
		foreach ( $endpoints as $slug => $endpoint ) {
			$flat_endpoints[ $slug ] = $endpoint;
			if ( isset( $endpoint['children'] ) ) {
				foreach ( $endpoint['children'] as $slug => $child ) {
					$flat_endpoints[ $slug ] = $child;
				}
				unset( $flat_endpoints[ $slug ]['children'] );
			}
		}

		return $flat_endpoints;
	}
}

if ( ! function_exists( 'tgwc_get_default_endpoint' ) ) {
	/**
	 * Get the default endpoint from settings.
	 *
	 * @since 0.1.0
	 * @return string
	 */
	function tgwc_get_default_endpoint() {
		$settings = TGWC()->get_settings()->get_settings();

		return apply_filters( 'tgwc_default_endpoint', $settings['default_endpoint'] );
	}
}

if ( ! function_exists( 'tgwc_get_custom_endpoints' ) ) {
	/**
	 * Get list of custom endpoints.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	function tgwc_get_custom_endpoints() {
		$endpoints         = \tgwc_get_endpoints_by_type( 'endpoint' );
		$endpoints         = array_keys( $endpoints );
		$default_endpoints = TGWC()->account_menu->get_default_endpoints();

		$endpoints = array_filter(
			$endpoints,
			function( $endpoint ) use ( $default_endpoints ) {
				return ! isset( $default_endpoints[ $endpoint ] );
			}
		);

		return apply_filters( 'tgwc_custom_endpoints', $endpoints );
	}
}

if ( ! function_exists( 'tgwc_get_upload_error_messages' ) ) {
	/**
	 * Get upload error messages.
	 *
	 * @param int $error_code
	 * @return array|string|boolean Retrun a list of error message if not error code
	 *                              is passed, error message on error code and false
	 *                              on invalid error code.
	 */
	function tgwc_get_upload_error_messages( $error_code = null ) {
		$errors = apply_filters(
			'tgwc_upload_validation_errors',
			array(
				UPLOAD_ERR_OK         => UPLOAD_ERR_OK,
				UPLOAD_ERR_INI_SIZE   => sprintf(
					/* translators: The upload_max_filesize directive in php.ini */
					esc_html__( 'The uploaded file exceeds the upload_max_filesize (%s) directive in php.ini.', 'customize-my-account-page-for-woocommerce' ),
					size_format( wp_max_upload_size() )
				),
				UPLOAD_ERR_FORM_SIZE  => esc_html__( 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.', 'customize-my-account-page-for-woocommerce' ),
				UPLOAD_ERR_PARTIAL    => esc_html__( 'The uploaded file was only partially uploaded.', 'customize-my-account-page-for-woocommerce' ),
				UPLOAD_ERR_NO_FILE    => esc_html__( 'No file was uploaded.', 'customize-my-account-page-for-woocommerce' ),
				UPLOAD_ERR_NO_TMP_DIR => esc_html__( 'Missing a temporary folder.', 'customize-my-account-page-for-woocommerce' ),
				UPLOAD_ERR_CANT_WRITE => esc_html__( 'Failed to write file to disk.', 'customize-my-account-page-for-woocommerce' ),
				UPLOAD_ERR_EXTENSION  => esc_html__( 'File upload stopped by extension.', 'customize-my-account-page-for-woocommerce' ),
			)
		);

		if ( null === $error_code ) {
			return $errors;
		}

		if ( isset( $errors [ $error_code ] ) ) {
			return $errors[ $error_code ];
		}

		return false;
	}
}

if ( ! function_exists( 'tgwc_get_avatar_image_size' ) ) {
	/**
	 * Get the avatar image size.
	 *
	 * @since 0.1.0
	 *
	 * @return array Avatar image size.
	 */
	function tgwc_get_avatar_image_size() {
		$image_size            = apply_filters( 'tgwc_myaccount_image_size', 'thumbnail' );
		$available_image_sizes = tgwc_get_image_sizes();

		// Default size.
		$size = $available_image_sizes[ $image_size ];

		// If the custom image size is present, return it.
		if ( isset( $available_image_sizes[ $image_size ] ) ) {
			$size = $available_image_sizes[ $image_size ];
		}

		return $size;
	}
}

if ( ! function_exists( 'tgwc_get_image_sizes' ) ) {
	/**
	 * Get information about available image sizes.
	 *
	 * @since 0.1.0
	 *
	 * @param string $size Image size.
	 *
	 * @return array|bool
	 */
	function tgwc_get_image_sizes( $size = '' ) {
		$wp_additional_image_sizes = wp_get_additional_image_sizes();

		$sizes                        = array();
		$get_intermediate_image_sizes = get_intermediate_image_sizes();

		// Create the full array with sizes and crop info
		foreach ( $get_intermediate_image_sizes as $_size ) {
			if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ), true ) ) {
				$sizes[ $_size ]['width']  = get_option( $_size . '_size_w' );
				$sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
				$sizes[ $_size ]['crop']   = (bool) get_option( $_size . '_crop' );
			} elseif ( isset( $wp_additional_image_sizes[ $_size ] ) ) {
				$sizes[ $_size ] = array(
					'width'  => $wp_additional_image_sizes[ $_size ]['width'],
					'height' => $wp_additional_image_sizes[ $_size ]['height'],
					'crop'   => $wp_additional_image_sizes[ $_size ]['crop'],
				);
			}
		}

		// Get only 1 size if found
		if ( $size ) {
			if ( isset( $sizes[ $size ] ) ) {
				return $sizes[ $size ];
			} else {
				return false;
			}
		}
		return $sizes;
	}
}

if ( ! function_exists( 'tgwc_is_endpoint_icon_enabled' ) ) {
	/**
	 * Check if endpoint icon is enabled.
	 *
	 * @return bool
	 */
	function tgwc_is_endpoint_icon_enabled() {
		$settings = TGWC()->settings->get_settings();
		return ! empty( $settings['icon'] );
	}
}

if ( ! function_exists( 'tgwc_is_group_accordion_icon_enabled' ) ) {
	/**
	 * Check if the group accordion icon is enabled.
	 *
	 * @return bool
	 */
	function tgwc_is_group_accordion_icon_enabled() {
		$settings = TGWC()->settings->get_settings();
		return ! empty( $settings['group_accordion_icon'] );
	}
}

if ( ! function_exists( 'tgwc_get_group_accordion_default_state' ) ) {
	/**
	 * Get group accordion default state.
	 *
	 * @return string
	 */
	function tgwc_get_group_accordion_default_state() {
		$settings = TGWC()->settings->get_settings();
		return isset( $settings['group_accordion_default_state'] ) ? $settings['group_accordion_default_state'] : 'expanded';
	}
}

if ( ! function_exists( 'tgwc_parse_args' ) ) {
	/**
	 * A wp_parse_args() for multidimensional array.
	 *
	 * @since 0.1.0
	 *
	 * @see https://developer.wordpress.org/reference/functions/wp_parse_args/
	 *
	 * @param array $args       Value to merge with $defaults.
	 * @param array $defaults   Array that serves as the defaults.
	 * @return array    Merged user defined values with defaults.
	 */
	function tgwc_parse_args( $args, $defaults ) {
		$args     = (array) $args;
		$defaults = (array) $defaults;
		$result   = $defaults;
		foreach ( $args as $k => $v ) {
			if ( is_array( $v ) && isset( $result[ $k ] ) ) {
				$result[ $k ] = tgwc_parse_args( $v, $result[ $k ] );
			} else {
				$result[ $k ] = $v;
			}
		}
		return $result;
	}
}

if ( ! function_exists( 'tgwc_get_customizer_wrapper_defaults' ) ) {
	/**
	 * Customizer wrapper default values.
	 *
	 * @since 0.1.0
	 * @return array
	 */
	function tgwc_get_customizer_wrapper_defaults() {
		return apply_filters(
			'tgwc_get_customizer_wrapper_defaults',
			array(
				'menu_style'       => 'sidebar',
				'sidebar_position' => 'left',
				'font_family'      => '',
				'font_size'        => '',
				'background_color' => '',
				'padding'          => tgwc_get_customize_dimension_defaults(),
				'margin'           => tgwc_get_customize_dimension_defaults(),
			)
		);
	}
}

if ( ! function_exists( 'tgwc_get_customizer_color_defaults' ) ) {
	/**
	 * Customizer color default values.
	 *
	 * @since 0.1.0
	 * @return array
	 */
	function tgwc_get_customizer_color_defaults() {
		return apply_filters(
			'tgwc_get_customizer_color_defaults',
			array(
				'heading'    => '',
				'body'       => '',
				'link'       => '',
				'link_hover' => '',
			)
		);
	}
}

if ( ! function_exists( 'tgwc_get_customizer_avatar_defaults' ) ) {
	/**
	 * Customizer avatar default values.
	 *
	 * @since 0.1.0
	 * @return array
	 */
	function tgwc_get_customizer_avatar_defaults() {
		return apply_filters(
			'tgwc_get_customizer_avatar_defaults',
			array(
				'layout'  => 'vertical',
				'type'    => 'square',
				'padding' => tgwc_get_customize_dimension_defaults(),
			)
		);
	}
}

if ( ! function_exists( 'tgwc_get_customizer_navigation_defaults' ) ) {
	/**
	 * Customizer navigation default values.
	 *
	 * @since 0.1.0
	 * @return array
	 */
	function tgwc_get_customizer_navigation_defaults() {
		return apply_filters(
			'tgwc_get_customizer_navigation_defaults',
			array(
				'general' => array(
					'padding'         => tgwc_get_customize_dimension_defaults(),
					'wrapper_padding' => tgwc_parse_args(
						array(
							'desktop' => array(
								'top'    => 0,
								'right'  => 15,
								'bottom' => 0,
								'left'   => 15,
							),
						),
						tgwc_get_customize_dimension_defaults()
					),
					'wrapper_margin'  => tgwc_parse_args(
						array(
							'desktop' => array(
								'top'    => 20,
								'right'  => 0,
								'bottom' => 20,
								'left'   => 0,
							),
						),
						tgwc_get_customize_dimension_defaults()
					),
				),
				'normal'  => array(
					'color'            => '',
					'background_color' => '',
					'border_style'     => 'solid',
					'border_width'     => array(
						'top'    => 1,
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					),
					'border_color'     => '#ced4da',
				),
				'hover'   => array(
					'color'            => '',
					'background_color' => '',
					'border_style'     => 'inherit',
					'border_width'     => tgwc_get_customize_dimension_defaults( false ),
					'border_color'     => '',
				),
				'active'  => array(
					'color'            => '',
					'background_color' => '',
					'border_style'     => 'inherit',
					'border_width'     => tgwc_get_customize_dimension_defaults( false ),
					'border_color'     => '',
				),
			)
		);
	}
}

if ( ! function_exists( 'tgwc_get_customizer_content_defaults' ) ) {

	/**
	 * Customizer content defaults.
	 *
	 * @since 0.4.1
	 * @return mixed|void
	 */
	function tgwc_get_customizer_content_defaults() {
		return apply_filters(
			'tgwc_get_customizer_content_defaults',
			array(
				'background_color' => '',
				'margin'           => tgwc_get_customize_dimension_defaults(),
				'padding'          => tgwc_get_customize_dimension_defaults(),
			)
		);
	}
}

if ( ! function_exists( 'tgwc_get_customizer_input_field_defaults' ) ) {
	/**
	 * Customizer input fields default values.
	 *
	 * @since 0.1.0
	 * @return array
	 */
	function tgwc_get_customizer_input_field_defaults() {
		return apply_filters(
			'tgwc_get_customizer_input_field_defaults',
			array(
				'general' => array(
					'padding' => tgwc_get_customize_dimension_defaults(),
				),
				'normal'  => array(
					'color'            => '',
					'background_color' => '',
					'border_style'     => 'inherit',
					'border_width'     => tgwc_get_customize_dimension_defaults( false ),
					'border_color'     => '',
				),
				'focus'   => array(
					'color'            => '',
					'background_color' => '',
					'border_style'     => 'inherit',
					'border_width'     => tgwc_get_customize_dimension_defaults( false ),
					'border_color'     => '',
				),
			)
		);
	}
}

if ( ! function_exists( 'tgwc_get_customizer_button_defaults' ) ) {
	/**
	 * Customizer button fields default values.
	 *
	 * @since 0.1.0
	 * @return array
	 */
	function tgwc_get_customizer_button_defaults() {
		return apply_filters(
			'tgwc_get_customizer_button_defaults',
			array(
				'general' => array(
					'font_size'   => '',
					'line_height' => '',
					'padding'     => tgwc_get_customize_dimension_defaults(),
					'margin'      => tgwc_get_customize_dimension_defaults(),
				),
				'normal'  => array(
					'color'            => '',
					'background_color' => '',
					'border_style'     => 'inherit',
					'border_width'     => tgwc_get_customize_dimension_defaults( false ),
					'border_color'     => '',
				),
				'hover'   => array(
					'color'            => '',
					'background_color' => '',
					'border_style'     => 'inherit',
					'border_width'     => tgwc_get_customize_dimension_defaults( false ),
					'border_color'     => '',
				),
			)
		);
	}
}

if ( ! function_exists( 'tgwc_get_customizer_values' ) ) {
	/**
	 * Get the customizer values.
	 *
	 * @since 0.1.0
	 *
	 * @return array
	 */
	function tgwc_get_customizer_values() {
		$customize = get_option( 'tgwc_customize' );
		$customize = tgwc_parse_args( $customize, tgwc_get_customizer_defaults() );
		return apply_filters( 'tgwc_get_customizer_values', $customize );
	}
}

if ( ! function_exists( 'tgwc_get_customizer_defaults' ) ) {
	/**
	 * Get customizer default values.
	 *
	 * @since 0.1.0
	 *
	 * @return array
	 */
	function tgwc_get_customizer_defaults() {
		return apply_filters(
			'tgwc_get_customizer_default_values',
			array(
				'wrapper'     => tgwc_get_customizer_wrapper_defaults(),
				'color'       => tgwc_get_customizer_color_defaults(),
				'avatar'      => tgwc_get_customizer_avatar_defaults(),
				'navigation'  => tgwc_get_customizer_navigation_defaults(),
				'content'     => tgwc_get_customizer_content_defaults(),
				'input_field' => tgwc_get_customizer_input_field_defaults(),
				'button'      => tgwc_get_customizer_button_defaults(),
			)
		);
	}
}

if ( ! function_exists( 'tgwc_get_customize_dimension_defaults' ) ) {
	/**
	 * Get customize dimension control defaults.
	 *
	 * @since 0.1.0
	 *
	 * @return array
	 */
	function tgwc_get_customize_dimension_defaults( $responsive = true ) {
		$dimension = apply_filters(
			'tgwc_get_dimension_defaults',
			array(
				'top'    => '',
				'right'  => '',
				'bottom' => '',
				'left'   => '',
			)
		);

		if ( $responsive ) {
			$dimension = array(
				'desktop' => $dimension,
				'tablet'  => $dimension,
				'mobile'  => $dimension,
			);
		}

		return apply_filters( 'tgwc_get_customize_dimension_defaults', $dimension );
	}
}


if ( ! function_exists( 'tgwc_is_woocommerce_activated' ) ) {
	/**
	 * Check whether the WooCommerce is activated or not.
	 *
	 * @since 0.1.0
	 *
	 * @return boolean
	 */
	function tgwc_is_woocommerce_activated() {
		return class_exists( 'WooCommerce' );
	}
}

if ( ! function_exists( 'tgwc_get_menu_style' ) ) {
	/**
	 * Get menu style.
	 */
	function tgwc_get_menu_style() {
		$customize  = get_option( 'tgwc_customize' );
		$menu_style = isset( $customize['wrapper']['menu_style'] ) ? $customize['wrapper']['menu_style'] : 'sidebar';

		return apply_filters( 'tgwc_get_menu_style', $menu_style );
	}
}

if ( ! function_exists( 'tgwc_get_avatar_layout' ) ) {
	/**
	 * Get avatar layout.
	 */
	function tgwc_get_avatar_layout() {
		$customize = get_option( 'tgwc_customize' );
		$layout    = isset( $customize['avatar']['layout'] ) ? $customize['avatar']['layout'] : 'left';
		$layout    = 'tgwc-user-avatar--' . $layout . '-aligned';

		return apply_filters( 'tgwc_get_avatar_layout', $layout );
	}
}

if ( ! function_exists( 'tgwc_get_avatar_type' ) ) {
	/**
	 * Get avatar layout.
	 *
	 * @since 0.1.0
	 */
	function tgwc_get_avatar_type() {
		$customize = get_option( 'tgwc_customize' );
		$type      = isset( $customize['avatar']['type'] ) ? $customize['avatar']['type'] : 'square';
		$type      = 'tgwc-user-avatar-image-wrap--' . $type;

		return apply_filters( 'tgwc_get_avatar_type', $type );
	}
}

if ( ! function_exists( 'tgwc_get_wrapper_font_family' ) ) {
	/**
	 * Get avatar layout.
	 *
	 * @since 0.1.0
	 */
	function tgwc_get_wrapper_font_family() {
		$customize   = get_option( 'tgwc_customize' );
		$font_family = isset( $customize['wrapper']['font_family'] ) ? $customize['wrapper']['font_family'] : '';
		return apply_filters( 'tgwc_get_wrapper_font_family', $font_family );
	}
}

if ( ! function_exists( 'tgwc_get_user_roles' ) ) {
	/**
	 * Get the user roles.
	 *
	 * @since 0.1.0
	 *
	 * @param WP_User|int $user User object or user id.
	 *
	 * @return array List of user roles.
	 */
	function tgwc_get_user_roles( $user = null ) {
		if ( ! is_user_logged_in() ) {
			return array();
		}

		$user = null === $user ? wp_get_current_user() : $user;

		if ( is_int( $user ) ) {
			$user = get_user_by( 'id', $user );
		}

		if ( ! is_a( $user, 'WP_User' ) ) {
			return array();
		}

		return (array) $user->roles;
	}
}

if ( ! function_exists( 'tgwc_get_avatar_upload_size' ) ) {
	/**
	 * Get the avatar upload size.
	 *
	 * @since 0.1.0
	 *
	 * @return int Get the file size in bytes.
	 */
	function tgwc_get_avatar_upload_size() {
		$max_file_size = apply_filters( 'tgwc_avatar_max_file_size', 2 * 1024 * 1024 );
		$max_file_size = absint( min( wp_max_upload_size(), $max_file_size ) );

		return $max_file_size;
	}
}

/**
 * Inserts a new key/value after the key in the array.
 *
 * @since 0.2.0
 *
 * @param string $needle      The array key to insert the element after.
 * @param array  $haystack     An array to insert the element into.
 * @param string $new_key     The key to insert.
 * @param array  $new_value    An value to insert.
 *
 * @return array The new array if the $needle key exists, otherwise an unmodified $haystack.
 */
function tgwc_array_insert_after( $needle, $haystack, $new_key, $new_value ) {

	if ( array_key_exists( $needle, $haystack ) ) {

		$new_array = array();

		foreach ( $haystack as $key => $value ) {

			$new_array[ $key ] = $value;

			if ( $key === $needle ) {
				$new_array[ $new_key ] = $new_value;
			}
		}

		return $new_array;
	}

	return $haystack;
}

/**
 * Get directory of my-account.css file.
 *
 * @since 0.1.0
 */
function tgwc_get_my_account_directory() {
	$upload_dir = wp_upload_dir();
	$directory  = $upload_dir['basedir'] . '/customize-my-account-page-for-woocommerce';

	return apply_filters( 'tgwc_get_my_account_directory', $directory );
}

/**
 * Get font directory path.
 *
 * @since 0.4.2
 * @return mixed|void
 */
function tgwc_get_font_directory() {
	$upload_dir = wp_upload_dir();
	$directory  = $upload_dir['basedir'] . '/customize-my-account-page-for-woocommerce/font';

	return apply_filters( 'tgwc_get_font_directory', $directory );
}

/**
 * Get font directory url.
 *
 * @since 0.4.2
 * @return mixed|void
 */
function tgwc_get_font_directory_url() {
	$upload_dir = wp_upload_dir();
	$directory  = $upload_dir['baseurl'] . '/customize-my-account-page-for-woocommerce/font';

	return apply_filters( 'tgwc_get_font_directory', $directory );
}

/**
 * Get directory url of my-account.css file.
 *
 * @since 0.1.0
 */
function tgwc_get_my_account_directory_url() {
	$upload_dir    = wp_upload_dir();
	$directory_url = $upload_dir['baseurl'] . '/customize-my-account-page-for-woocommerce';

	return apply_filters( 'tgwc_get_my_account_directory_url', $directory_url );
}

/**
 * Get my-account.css file if the version is attached as well.
 *
 * @since 0.1.0
 *
 * @return string
 */
function tgwc_get_my_account_file() {
	$directory       = tgwc_get_my_account_directory();
	$my_account_file = "${directory}/my-account.css";
	$version         = get_option( 'tgwc_my_account_file_version', '' );

	if ( ! empty( $version ) ) {
		$my_account_file = "${directory}/my-account-{$version}.css";
	}

	return apply_filters( 'tgwc_get_my_account_file', $my_account_file );
}

/**
 * Get my-account.css file if the version is attached as well.
 *
 * @since 0.1.0
 *
 * @return string
 */
function tgwc_get_my_account_file_url() {
	$directory_url       = tgwc_get_my_account_directory_url();
	$my_account_file_url = "${directory_url}/my-account.css";
	$version             = get_option( 'tgwc_my_account_file_version', '' );

	if ( ! empty( $version ) ) {
		$my_account_file_url = "${directory_url}/my-account-{$version}.css";
	}

	return apply_filters( 'tgwc_get_my_account_file_url', $my_account_file_url );
}


/**
 * Get my-account.css file if the version is attached as well.
 *
 * @since 0.1.0
 *
 * @return string
 */
function tgwc_get_new_my_account_file() {
	$directory       = tgwc_get_my_account_directory();
	$version         = time();
	$my_account_file = "${directory}/my-account-{$version}.css";
	update_option( 'tgwc_my_account_file_version', $version );

	return apply_filters( 'tgwc_get_new_my_account_file', $my_account_file );
}


/**
 * Get debug settings.
 *
 * @since 0.1.0
 *
 * @return array
 */
function tgwc_get_debug_settings() {
	$settings = get_option( 'tgwc_debug_settings' );

	$settings = tgwc_parse_args(
		$settings,
		array(
			'enable_debug' => false,
			'frontend'     => array(
				'fontawesome'      => array(
					'css' => true,
					'js'  => true,
				),
				'dropzone'         => array(
					'css' => true,
					'js'  => true,
				),
				'jqueryscrolltabs' => array(
					'css' => true,
					'js'  => true,
				),
			),
		)
	);

	return apply_filters( 'get_debug_settings', $settings );
}

/**
 * Check whether the debug is enabled or not.
 *
 * @since 0.1.0
 *
 * @return boolean
 */
function tgwc_is_debug_enabled() {
	$settings = tgwc_get_debug_settings();

	return apply_filters( 'tgwc_is_debug_enabled', $settings['enable_debug'] );
}

/**
 * Check whether specific frontend library is enabled or not.
 *
 * @since 0.1.0
 *
 * @param string $library Library name(e.g. fontawesome, dropzone, jqueryscrolltabs, etc.)
 * @param string $type css or js.
 * @return boolean
 */
function tgwc_is_frontend_library_enabled( $library, $type = '' ) {
	$settings = tgwc_get_debug_settings();
	$result   = false;
	$types    = array( 'css', 'js' );
	$type     = trim( strtolower( $type ) );
	$type     = in_array( $type, $types, true ) ? $type : 'css';

	if ( isset( $settings['frontend'][ $library ] ) ) {
		if ( empty( $type ) ) {
			$setting = $settings['frontend'][ $library ];
			$result  = $setting['css'] || $setting['js'];
		} else {
			$result = $settings['frontend'][ $library ][ $type ];
		}
	}

	return apply_filters( 'tgwc_is_frontend_library_enabled', $result, $library, $type );
}

/**
 * Customizer edit button.
 *
 * @return void
 */
function tgwc_render_customizer_edit_button() {

	if ( ! is_customize_preview() && ! isset( $_GET['tgwc-customizer'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		return;
	}
	?>
	<span class="customize-partial-edit-shortcut" data-id="tgwc-customize">
		<span role="button" tabindex="0" aria-label="<?php esc_attr_e( 'Click to edit this element.', 'customize-my-account-page-for-woocommerce' ); ?>"
			title="<?php esc_attr_e( 'Click to edit this element.', 'customize-my-account-page-for-woocommerce' ); ?>"
			class="customize-partial-edit-shortcut-button"
		>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
				<path fill="currentColor" d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path>
			</svg>
		</span>
	</span>
	<?php
}

/**
 * Register string for translation.
 *
 * @param string $key Key.
 * @param string $string String.
 * @return void
 */
function tgwc_register_single_string( $key, $string ) {
	if ( function_exists( 'pll_register_string' ) ) {
		pll_register_string( $key, $string, 'customize-my-account-page-for-woocommerce' );
	} elseif ( function_exists( 'icl_object_id' ) ) {
		do_action( 'wpml_register_single_string', 'customize-my-account-page-for-woocommerce', $key, $string );
	}
}

/**
 * Get translated string.
 *
 * @param string      $string String.
 * @param string|null $key Key.
 * @return mixed|void
 */
function tgwc_translate_dynamic_string( $string, $key = null ) {
	if ( function_exists( 'pll__' ) ) {
		return pll__( $string );
	}

	if ( function_exists( 'icl_object_id' ) && $key ) {
		return apply_filters(
			'wpml_translate_single_string',
			$string,
			'customize-my-account-page-for-woocommerce',
			$key
		);
	}

	return $string;
}

/**
 * Get account menu items.
 *
 * @since 0.4.1
 * @param array $endpoints Endpoints.
 * @return array Account menu items.
 */
function tgwc_get_account_menu_items( $endpoints = array() ) {

	if ( empty( $endpoints ) ) {
		$endpoints = TGWC()->get_settings()->get_endpoints();
	}

	$roles = tgwc_get_user_roles();

	$endpoints = array_filter(
		$endpoints,
		function( $endpoint ) use ( $roles ) {

			$is_capable = array_reduce(
				$roles,
				function( $previous, $role ) use ( $endpoint ) {
					return $previous || in_array( $role, $endpoint['user_role'], true );
				},
				false
			);

			return $endpoint['enable'] && ( $is_capable || empty( $endpoint['user_role'] ) );
		}
	);

	if (
		function_exists( 'wc_memberships_get_user_memberships' ) &&
		empty( wc_memberships_get_user_memberships() ) &&
		array_key_exists( 'members-area', $endpoints )
	) {
		unset( $endpoints['members-area'] );
	}

	return array_map(
		function( $endpoint ) {
			return $endpoint['label'];
		},
		$endpoints
	);
}

/**
 * Get current endpoint.
 *
 * @since 0.4.2
 * @return mixed|void
 */
function tgwc_get_current_endpoint() {
	global $wp;
	$query_vars = WC()->query->get_query_vars();
	$current    = '';

	if ( isset( $wp->query_vars['page'] ) || empty( $wp->query_vars ) ) {
		$current = 'dashboard';
	}

	if ( empty( $current ) ) {
		foreach ( $query_vars as $key => $value ) {
			if ( isset( $wp->query_vars[ $key ] ) ) {
				$current = $key;
				break;
			}
		}
	}

	return apply_filters( 'tgwc_current_endpoint', $current );
}
