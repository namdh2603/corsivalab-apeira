<?php
/**
 * Endpoints tab content page.
 *
 * @since 0.1.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div id="tgwc-endpoints">
	<div class="tgwc-endpoints-header">
		<h3><?php esc_html_e( 'Manage Endpoints', 'customize-my-account-page-for-woocommerce' ); ?></h3>
		<div id="tgwc-endpoint-actions" class="actions">
			<button type="button" class="button" data-type="group">
				<?php esc_html_e( 'Add group', 'customize-my-account-page-for-woocommerce' ); ?>
			</button>
			<button type="button" class="button" data-type="endpoint">
				<?php esc_html_e( 'Add endpoint', 'customize-my-account-page-for-woocommerce' ); ?>
			</button>
			<button type="button" class="button" data-type="link">
				<?php esc_html_e( 'Add link', 'customize-my-account-page-for-woocommerce' ); ?>
			</button>
		</div>
	</div>

	<div id="tgwc-tabs" class="tgwc-tabs-with-sidenav">
		<div class="dd tgwc-sidenav">
			<ul class="dd-list">
			<?php
			foreach ( $endpoints as $slug => $endpoint ) {
				$endpoint['slug'] = $slug;
				wc_get_template(
					'admin/endpoint-tab.php',
					$endpoint,
					TGWC_TEMPLATE_PATH,
					TGWC_TEMPLATE_PATH
				);
			}
			?>
			</ul>
		</div>
		<?php
		$initial = current( array_keys( $endpoints ) );
		foreach ( $endpoints as $slug => $endpoint ) {
			do_action( "tgwc_endpoints_content_{$endpoint['type']}", $slug, $endpoint, $initial );
			do_action( 'tgwc_endpoints_content', $slug, $endpoint, $initial );

			if ( isset( $endpoint['children'] ) ) {
				foreach ( $endpoint['children'] as $slug => $child ) {
					do_action( "tgwc_endpoints_content_{$child['type']}", $slug, $child, $initial );
					do_action( 'tgwc_endpoints_content', $slug, $child, $initial );
				}
			}
		}
		?>
	</div>
</div>
<div id="tgwc-dialog-delete" style="display: none;"
	title="<?php esc_html_e( 'Do you want to delete?', 'customize-my-account-page-for-woocommerce' ); ?>">
	<div class="tgwc-dialog-content">
		<span class="ui-icon ui-icon-alert">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
		</span>
		<p>
			<?php esc_html_e( 'It will be permanently deleted and cannot be recovered. Are you sure?', 'customize-my-account-page-for-woocommerce' ); ?>
		</p>
	</div>
</div>
<?php

