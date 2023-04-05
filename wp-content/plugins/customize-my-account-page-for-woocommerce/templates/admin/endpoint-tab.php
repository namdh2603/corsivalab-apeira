<?php
/**
 * Endpoint vertical tab.
 *
 * @since 0.1.0
 */

defined( 'ABSPATH' ) || exit;

$children_count = isset( $children ) ? count( $children ) : 0;
?>
<li class="dd-item <?php echo esc_attr( $type ); ?>"
	data-id="<?php echo esc_attr( $slug ); ?>"
	data-type="<?php echo esc_attr( $type ); ?>"
	<?php ( ! $enable ) && print( esc_attr( 'data-disabled' ) ); ?>
/>
	<span class="dd-handle dd3-handle"></span>
	<a class="dd3-content tgwc-sidenav-tab-anchor" href="#<?php echo esc_attr( $slug ); ?>">
		<span title="<?php echo esc_html( ucfirst( $type ) ); ?>">[<?php echo esc_html( ucwords( substr( $type, 0, 1 ) ) ); ?>]</span>
		<span title="<?php esc_html_e( 'Disabled', 'customize-my-account-page-for-woocommerce' ); ?>">[<?php echo esc_html( 'D' ); ?>]</span>
		<span><?php echo esc_html( $label ); ?></span>
	</a>

	<?php if ( isset( $children ) ) : ?>
	<ul class="dd-list">
		<?php foreach ( $children as $slug => $child ) : ?>
		<li class="dd-item <?php echo esc_attr( $child['type'] ); ?>"
			data-id="<?php echo esc_attr( $slug ); ?>"
			data-type="<?php echo esc_attr( $child['type'] ); ?>"
			<?php ( ! $child['enable'] ) && print( esc_attr( 'data-disabled' ) ); ?>
		>
			<span class="dd-handle dd3-handle"></span>
			<a class="dd3-content tgwc-sidenav-tab-anchor" href="#<?php echo esc_attr( $slug ); ?>">
				<span title="<?php echo esc_html( ucfirst( $child['type'] ) ); ?>">[<?php echo esc_html( ucwords( substr( $child['type'], 0, 1 ) ) ); ?>]</span>
				<span title="<?php esc_html_e( 'Disabled', 'customize-my-account-page-for-woocommerce' ); ?>">[<?php echo esc_html( 'D' ); ?>]</span>
				<span><?php echo esc_html( $child['label'] ); ?></span>
			</a>
		</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
</li>
<?php
