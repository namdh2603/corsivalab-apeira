<?php
/**
 * Debug tab content page.
 *
 * @since 0.1.0
 */

defined( 'ABSPATH' ) || exit;

use ThemeGrill\WoocommerceCustomizer\Icon;

?>
<table class="form-table">
	<tbody>
	<!-- Enable debug -->
	<tr>
		<th scope="row">
			<?php esc_html_e( 'Enable Debug', 'customize-my-account-page-for-woocommerce' ); ?>
			<span data-toggle="tgwc-tooltip"
				title="<?php esc_attr_e( 'Enabling this option will load unminified JS scripts and CSS styles.', 'customize-my-account-page-for-woocommerce' ); ?>">
				<?php Icon::get_svg_icon( 'question-circle', true ); ?>
			</span>
		</th>
		<td>
			<label for="tgwc_enable_debug">
				<input type="checkbox" id="tgwc_enable_debug" <?php checked( $debug['enable_debug'] ); ?>
						name="tgwc_debug_settings[enable_debug]" value="yes" />
				<span class="description">
						<?php esc_html_e( 'Enable debug mode.', 'customize-my-account-page-for-woocommerce' ); ?>
				</span>
			</label>
		</td>
	</tr>
	<!-- ./ Enable debug -->
	</tbody>
</table>

<h2><?php esc_html_e( 'Frontend Libraries', 'customize-my-account-page-for-woocommerce' ); ?></h2>
<p><?php esc_html_e( 'You can enable/disable javascript libraries which are loaded in WooCommerce MyAccount Page to resolve library conflict with other plugins.', 'customize-my-account-page-for-woocommerce' ); ?></p>

<table class="form-table">
	<tbody>

	<!-- Dropzone -->
	<tr>
		<th scope="row">
			<?php esc_html_e( 'Dropzone', 'customize-my-account-page-for-woocommerce' ); ?>
		</th>
		<td>
			<label for="tgwc-frontend-dropzone-css">
				<input type="checkbox" id="tgwc-frontend-dropzone-css" <?php checked( $debug['frontend']['dropzone']['css'] ); ?> name="tgwc_debug_settings[frontend][dropzone][css]" />
				<span style="margin-right: 25px;">
							<?php esc_html_e( 'CSS', 'customize-my-account-page-for-woocommerce' ); ?>
						</span>
			</label>

			<label for="tgwc-frontend-dropzone-js">
				<input type="checkbox" id="tgwc-frontend-dropzone-js" <?php checked( $debug['frontend']['dropzone']['js'] ); ?> name="tgwc_debug_settings[frontend][dropzone][js]" />
				<span>
							<?php esc_html_e( 'JS', 'customize-my-account-page-for-woocommerce' ); ?>
						</span>
			</label>
		</td>
	</tr>
	<!-- ./ Dropzone -->

	<!-- jQuery Scroll Tabs -->
	<tr>
		<th scope="row">
			<?php esc_html_e( 'jQuery Scroll Tabs', 'customize-my-account-page-for-woocommerce' ); ?>
		</th>
		<td>
			<label for="tgwc-frontend-jqueryscrolltabs-css">
				<input type="checkbox" id="tgwc-frontend-jqueryscrolltabs-css" <?php checked( $debug['frontend']['jqueryscrolltabs']['css'] ); ?> name="tgwc_debug_settings[frontend][jqueryscrolltabs][css]" />
				<span style="margin-right: 25px;">
							<?php esc_html_e( 'CSS', 'customize-my-account-page-for-woocommerce' ); ?>
						</span>
			</label>

			<label for="tgwc-frontend-jqueryscrolltabs-js">
				<input type="checkbox" id="tgwc-frontend-jqueryscrolltabs-js" <?php checked( $debug['frontend']['jqueryscrolltabs']['js'] ); ?> name="tgwc_debug_settings[frontend][jqueryscrolltabs][js]" />
				<span>
							<?php esc_html_e( 'JS', 'customize-my-account-page-for-woocommerce' ); ?>
						</span>
			</label>
		</td>
	</tr>
	<!-- ./ jQuery Scroll Tabs -->
	</tbody>
</table>
<?php
