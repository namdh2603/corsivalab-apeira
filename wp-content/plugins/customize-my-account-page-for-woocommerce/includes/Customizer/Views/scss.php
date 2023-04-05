<?php
/**
 * TG WooCommerce My Account Customizer SCSS
 *
 * @package Woocommerce_My_Account_Style_Customizer
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

// Get values.
$values = tgwc_get_customizer_values(); // phpcs:ignore PHPCompatibility.PHP.NewFunctions.array_replace_recursiveFound

// Font styles.
$font_styles         = array(
	'font-weight'     => 'bold',
	'font-style'      => 'italic',
	'text-decoration' => 'underline',
	'text-transform'  => 'uppercase',
);
$font_styles_default = array(
	'font-weight'     => 'normal',
	'font-style'      => 'normal',
	'text-decoration' => 'none',
	'text-transform'  => 'none',
);
?>

// Wrapper variables.
$wrapper_font_family: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['wrapper']['font_family'] ) ) ); ?>;
$wrapper_font_size: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['wrapper']['font_size'] ), 'px' ) ); ?>;
$wrapper_background_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['wrapper']['background_color'] ) ) ); ?>;

// Global Color variables.
$body_font_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['color']['body'] ) ) ); ?>;
$heading_font_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['color']['heading'] ) ) ); ?>;
$link_font_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['color']['link'] ) ) ); ?>;
$link_hover_font_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['color']['link_hover'] ) ) ); ?>;

// Navigation variables.
$nav_font_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['navigation']['normal']['color'] ) ) ); ?>;
$nav_background_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['navigation']['normal']['background_color'] ) ) ); ?>;
$nav_border_style: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['navigation']['normal']['border_style'] ) ) ); ?>;
$nav_border_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['navigation']['normal']['border_color'] ) ) ); ?>;
$nav_hover_font_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['navigation']['hover']['color'] ) ) ); ?>;
$nav_hover_background_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['navigation']['hover']['background_color'] ) ) ); ?>;
$nav_hover_border_style: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['navigation']['hover']['border_style'] ) ) ); ?>;
$nav_hover_border_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['navigation']['hover']['border_color'] ) ) ); ?>;
$nav_active_font_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['navigation']['active']['color'] ) ) ); ?>;
$nav_active_background_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['navigation']['active']['background_color'] ) ) ); ?>;
$nav_active_border_style: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['navigation']['active']['border_style'] ) ) ); ?>;
$nav_active_border_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['navigation']['active']['border_color'] ) ) ); ?>;

// Content variables.
$content_background_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['content']['background_color'] ) ) ); ?>;

// Form variables.
//Variables for input
$input_font_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['input_field']['normal']['color'] ) ) ); ?>;
$input_background_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['input_field']['normal']['background_color'] ) ) ); ?>;
$input_border_style: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['input_field']['normal']['border_style'] ) ) ); ?>;
$input_border_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['input_field']['normal']['border_color'] ) ) ); ?>;
$input_focus_font_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['input_field']['focus']['color'] ) ) ); ?>;
$input_focus_background_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['input_field']['focus']['background_color'] ) ) ); ?>;
$input_focus_border_style: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['input_field']['focus']['border_style'] ) ) ); ?>;
$input_focus_border_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['input_field']['focus']['border_color'] ) ) ); ?>;

// Button styles variables.
$button_font_size: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['button']['general']['font_size'] ), 'px' ) ); ?>;
$button_line_height: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['button']['general']['line_height'] ) ) ); ?>;
$button_font_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['button']['normal']['color'] ) ) ); ?>;
$button_background_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['button']['normal']['background_color'] ) ) ); ?>;
$button_border_style: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['button']['normal']['border_style'] ) ) ); ?>;
$button_border_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['button']['normal']['border_color'] ) ) ); ?>;
$button_hover_font_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['button']['hover']['color'] ) ) ); ?>;
$button_hover_border_style: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['button']['normal']['border_style'] ) ) ); ?>;
$button_hover_border_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['button']['hover']['border_color'] ) ) ); ?>;
$button_hover_background_color: <?php echo esc_attr( tgwc_format_css_value( tgwc_clean( $values['button']['hover']['background_color'] ) ) ); ?>;

/**
 * Imports.
 */
@import "bourbon";

/**
 * Responsive.
 */
@mixin responsive-media( $property, $device, $values ) {
	@if $device == "desktop" {
		@include _directional-property( $property, null, $values );
	} @else if $device == "tablet" {
		@media only screen and (max-width: 768px) {
			@include _directional-property( $property, null, $values);
		}
	} @else if $device == "mobile" {
		@media only screen and (max-width: 500px) {
			@include _directional-property( $property, null, $values);
		}
	}
}

/**
 * Styling begins.
 */
.logged-in.woocommerce-account.tgwc-woocommerce-customize-my-account {
	#tgwc-woocommerce.woocommerce {
		font-family: $wrapper_font_family;
		font-size: $wrapper_font_size;

		* {
			<?php ! empty( $values['wrapper']['font_family'] ) && print( 'font-family: inherit;' ); ?>
		}
	}

	#tgwc-woocommerce.woocommerce {
		$self: &;
		color: $body_font_color;
		background-color: $wrapper_background_color;
		<?php foreach ( array( 'margin', 'padding' ) as $separator_type ) : ?>
			<?php foreach ( $values['wrapper'][ $separator_type ] as $device => $value ) : ?>
				<?php if ( in_array( $device, array( 'desktop', 'tablet', 'mobile' ), true ) && tgwc_array_filter_numeric( $value ) ) : ?>
					<?php
						printf(
							'@include responsive-media(%s, %s, %s);',
							esc_attr( $separator_type ),
							esc_attr( $device ),
							esc_attr( tgwc_sanitize_dimension_unit( $value ) )
						);
					?>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endforeach; ?>

		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		.tgwc-user-id {
			color: $heading_font_color;
		}

		a {
			color: $link_font_color;

			&:hover {
				color: $link_hover_font_color;
			}
		}

		.tgwc-user-avatar {
			<?php foreach ( array( 'padding' ) as $separator_type ) : ?>
				<?php foreach ( $values['avatar'][ $separator_type ] as $device => $value ) : ?>
					<?php if ( in_array( $device, array( 'desktop', 'tablet', 'mobile' ), true ) && tgwc_array_filter_numeric( $value ) ) : ?>
						<?php
							printf(
								'@include responsive-media(%s, %s, %s);',
								esc_attr( $separator_type ),
								esc_attr( $device ),
								esc_attr( tgwc_sanitize_dimension_unit( $value, 'px' ) )
							);
						?>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endforeach; ?>
		}

		&[data-menu-style="tab"] {
			.tgwc-woocommerce-MyAccount-navigation-wrap {
				<?php foreach ( $values['navigation']['general']['wrapper_margin'] as $device => $value ) : ?>
					<?php if ( in_array( $device, array( 'desktop', 'tablet', 'mobile' ), true ) && tgwc_array_filter_numeric( $value ) ) : ?>
						<?php
						printf(
							'@include responsive-media(%s, %s, %s);',
							'margin',
							esc_attr( $device ),
							esc_attr( tgwc_sanitize_dimension_unit( $value ) )
						);
						?>
					<?php endif; ?>
				<?php endforeach; ?>
			}
		}
		&[data-menu-style="sidebar"] {
			.tgwc-woocommerce-MyAccount-navigation {
				<?php foreach ( $values['navigation']['general']['wrapper_padding'] as $device => $value ) : ?>
					<?php if ( in_array( $device, array( 'desktop', 'tablet', 'mobile' ), true ) && tgwc_array_filter_numeric( $value ) ) : ?>
						<?php
						printf(
							'@include responsive-media(%s, %s, %s);',
							'padding',
							esc_attr( $device ),
							esc_attr( tgwc_sanitize_dimension_unit( $value ) )
						);
						?>
					<?php endif; ?>
				<?php endforeach; ?>
			}
		}

		.tgwc-woocommerce-MyAccount-navigation {
			.woocommerce-MyAccount-navigation-link {
				a {
					color: $nav_font_color;
					background: $nav_background_color;
					<?php foreach ( array( 'padding' ) as $separator_type ) : ?>
						<?php foreach ( $values['navigation']['general'][ $separator_type ] as $device => $value ) : ?>
							<?php if ( in_array( $device, array( 'desktop', 'tablet', 'mobile' ), true ) && tgwc_array_filter_numeric( $value ) ) : ?>
								<?php
									printf(
										'@include responsive-media(%s, %s, %s);',
										esc_attr( $separator_type ),
										esc_attr( $device ),
										esc_attr( tgwc_sanitize_dimension_unit( $value, 'px' ) )
									);
								?>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endforeach; ?>
					<?php if ( isset( $values['navigation']['normal']['border_style'] ) ) : ?>
						border-style: $nav_border_style;
						<?php if ( 'none' !== $values['navigation']['normal']['border_style'] ) : ?>
							border-color: $nav_border_color;
							<?php tgwc_array_filter_numeric( $values['navigation']['normal']['border_width'] ) && printf( '@include border-width(%s);', esc_attr( tgwc_sanitize_dimension_unit( $values['navigation']['normal']['border_width'], 'px' ) ) ); ?>
						<?php endif; ?>
					<?php endif; ?>

					&:hover {
						color: $nav_hover_font_color;
						background: $nav_hover_background_color;
						<?php if ( isset( $values['navigation']['hover']['border_style'] ) ) : ?>
							border-style: $nav_hover_border_style;
							<?php if ( 'none' !== $values['navigation']['hover']['border_style'] ) : ?>
								border-color: $nav_hover_border_color;
								<?php tgwc_array_filter_numeric( $values['navigation']['hover']['border_width'] ) && printf( '@include border-width(%s);', esc_attr( tgwc_sanitize_dimension_unit( $values['navigation']['hover']['border_width'], 'px' ) ) ); ?>
							<?php endif; ?>
						<?php endif; ?>
					}
				}

				&.is-active {
					a {
						color: $nav_active_font_color;
						background: $nav_active_background_color;
						<?php if ( isset( $values['navigation']['active']['border_style'] ) ) : ?>
							border-style: $nav_active_border_style;
							<?php if ( 'none' !== $values['navigation']['active']['border_style'] ) : ?>
								border-color: $nav_active_border_color;
								<?php tgwc_array_filter_numeric( $values['navigation']['active']['border_width'] ) && printf( '@include border-width(%s);', esc_attr( tgwc_sanitize_dimension_unit( $values['navigation']['active']['border_width'], 'px' ) ) ); ?>
							<?php endif; ?>
						<?php endif; ?>
					}
				}
			}
		}

		.woocommerce-MyAccount-content {
			background-color: $content_background_color;
			<?php foreach ( array( 'margin', 'padding' ) as $separator_type ) : ?>
				<?php foreach ( $values['content'][ $separator_type ] as $device => $value ) : ?>
					<?php if ( in_array( $device, array( 'desktop', 'tablet', 'mobile' ), true ) && tgwc_array_filter_numeric( $value ) ) : ?>
						<?php
						printf(
							'@include responsive-media(%s, %s, %s);',
							esc_attr( $separator_type ),
							esc_attr( $device ),
							esc_attr( tgwc_sanitize_dimension_unit( $value ) )
						);
						?>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endforeach; ?>

			input,
			.woocommerce-Input {
				color: $input_font_color;
				background: $input_background_color;
				<?php if ( isset( $values['input_field']['normal']['border_style'] ) ) : ?>
					border-style: $input_border_style;
					<?php if ( 'none' !== $values['input_field']['normal']['border_style'] ) : ?>
						border-color: $input_border_color;
						<?php tgwc_array_filter_numeric( $values['input_field']['normal']['border_width'] ) && printf( '@include border-width(%s);', esc_attr( tgwc_sanitize_dimension_unit( $values['input_field']['normal']['border_width'], 'px' ) ) ); ?>
					<?php endif; ?>
				<?php endif; ?>
				<?php foreach ( array( 'padding' ) as $separator_type ) : ?>
					<?php foreach ( $values['input_field']['general'][ $separator_type ] as $device => $value ) : ?>
						<?php if ( in_array( $device, array( 'desktop', 'tablet', 'mobile' ), true ) && tgwc_array_filter_numeric( $value ) ) : ?>
							<?php
								printf(
									'@include responsive-media(%s, %s, %s);',
									esc_attr( $separator_type ),
									esc_attr( $device ),
									esc_attr( tgwc_sanitize_dimension_unit( $value, 'px' ) )
								);
							?>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endforeach; ?>

				&:focus {
					color: $input_focus_font_color;
					background: $input_focus_background_color;
					<?php if ( isset( $values['input_field']['focus']['border_style'] ) ) : ?>
						border-style: $input_focus_border_style;
						<?php if ( 'none' !== $values['input_field']['focus']['border_style'] ) : ?>
							border-color: $input_focus_border_color;
							<?php tgwc_array_filter_numeric( $values['input_field']['focus']['border_width'] ) && printf( '@include border-width(%s);', esc_attr( tgwc_sanitize_dimension_unit( $values['input_field']['focus']['border_width'], 'px' ) ) ); ?>
						<?php endif; ?>
					<?php endif; ?>
				}
			}
		}

		button,
		button[type='button'],
		button[type='submit'],
		input[type='button'],
		input[type='submit'],
		a.woocommerce-Button,
		a.button {
			color: $button_font_color;
			font-size: $button_font_size;
			line-height: $button_line_height;
			background-color: $button_background_color;
			<?php if ( 'none' !== $values['button']['normal']['border_style'] ) : ?>
				border-style: $button_border_style;
				border-color: $button_border_color;
				<?php tgwc_array_filter_numeric( $values['button']['normal']['border_width'] ) && printf( '@include border-width(%s);', esc_attr( tgwc_sanitize_dimension_unit( $values['button']['normal']['border_width'], 'px' ) ) ); ?>
			<?php endif; ?>
			<?php
			foreach ( array( 'margin', 'padding' ) as $space ) {
				foreach ( $values['button']['general'][ $space ] as $device => $value ) {
					if ( in_array( $device, array( 'desktop', 'tablet', 'mobile' ), true ) && tgwc_array_filter_numeric( $value ) ) {
						printf(
							'@include responsive-media(%s, %s, %s);',
							esc_attr( $space ),
							esc_attr( $device ),
							esc_attr( tgwc_sanitize_dimension_unit( $value, 'px' ) )
						);
					}
				}
			}
			?>

			&:hover,
			&:active {
				color: $button_hover_font_color;
				background-color: $button_hover_background_color;
				<?php if ( 'none' !== $values['button']['hover']['border_style'] ) : ?>
					border-style: $button_hover_border_style;
					border-color: $button_hover_border_color;
					<?php tgwc_array_filter_numeric( $values['button']['hover']['border_width'] ) && printf( '@include border-width(%s);', esc_attr( tgwc_sanitize_dimension_unit( $values['button']['hover']['border_width'], 'px' ) ) ); ?>
				<?php endif; ?>
			}
		}
	}
}
<?php
