<?php
/**
 * Customize page tabs list.g
 *
 * @since 0.1.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="tgwc-header">
	<div class="tgwc-brand">
		<?php printf( '<img src="%s" />', esc_url( TGWC()->plugin_url() . '/assets/images/wooCommerce-customize-my-account-logo.png' ) ); ?>
		<span class="tgwc-version"><?php echo esc_html( TGWC_VERSION ); ?></span>
	</div>

	<div class="wrap"><?php settings_errors( 'tgwc' ); ?></div>
	<!-- Add empty h2 tag to display fix the move of the notices. -->
	<h2></h2>

	<nav class="nav-tab-wrapper">
	<?php
	foreach ( $tabs as $tab_slug => $tab_name ) {
		$class = ( $tab_selected === $tab_slug ) ? ' nav-tab-active' : '';
		printf(
			'<a class="nav-tab%1$s" href="%2$s" %3$s>%4$s</a>',
			esc_attr( $class ),
			'customizer' !== $tab_slug ? '?page=tgwc-customize-my-account-page&tab=' . esc_attr( $tab_slug ) : esc_url( $customize_url ),
			esc_attr( 'customizer' === $tab_slug ? 'target=_blank' : '' ),
			esc_html( $tab_name )
		);
	}
	?>
	</nav>
</div>
<?php
