<?php
/**
 * Restore defaults modal dialog.
 *
 * @since 0.1.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div id="tgwc-dialog-restore-defaults" style="display: none;"
	title="<?php esc_html_e( 'Are you sure want to restore the settings?', 'customize-my-account-page-for-woocommerce' ); ?>">
	<div class="tgwc-dialog-content">
		<span class="ui-icon ui-icon-alert">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
		</span>

		<form>
			<div>
				<input type="checkbox" id="tgwc-restore-defaults-settings" />
				<label for="tgwc-restore-defaults-settings">
					<?php esc_html_e( 'Settings', 'customize-my-account-page-for-woocommerce' ); ?>
				</label>
			</div>
			<div>
				<input type="checkbox" id="tgwc-restore-defaults-customization" />
				<label for="tgwc-restore-defaults-customization">
					<?php esc_html_e( 'Design Customization', 'customize-my-account-page-for-woocommerce' ); ?>
				</label>
			</div>
		</form>
	</div>
	<div class="tgwc-dialog-notice"></div>
</div>
