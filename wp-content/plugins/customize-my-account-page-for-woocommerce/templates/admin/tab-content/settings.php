<?php
/**
 * Settings tab content page.
 *
 * @since 0.1.0
 */

defined( 'ABSPATH' ) || exit;

use ThemeGrill\WoocommerceCustomizer\Icon;
?>
<table class="form-table">
	<tbody>
		<!-- Custom avatar -->
		<tr>
			<th scope="row">
				<?php esc_html_e( 'Custom Avatar', 'customize-my-account-page-for-woocommerce' ); ?>
				<span data-toggle="tgwc-tooltip"
					title="<?php esc_attr_e( 'Allow users to upload a custom avatar.', 'customize-my-account-page-for-woocommerce' ); ?>">
					<?php Icon::get_svg_icon( 'question-circle', true ); ?>
				</span>
			</th>
			<td>
				<label for="tgwc_custom_avatar">
					<input type="checkbox" id="tgwc_custom_avatar" <?php checked( $settings['custom_avatar'] ); ?> name="tgwc_settings[custom_avatar]" />
					<span class="description">
						<?php esc_html_e( 'Allow users to upload a custom avatar.', 'customize-my-account-page-for-woocommerce' ); ?>
					</span>
				</label>
			</td>
		</tr>
		<!-- ./ Custom avatar -->

		<!-- Endpoint Icon -->
		<tr>
			<th scope="row">
				<?php esc_html_e( 'Endpoint Icon', 'customize-my-account-page-for-woocommerce' ); ?>
				<span data-toggle="tgwc-tooltip"
					title="<?php esc_attr_e( 'Enable/Disable endpoint icon.', 'customize-my-account-page-for-woocommerce' ); ?>">
					<?php Icon::get_svg_icon( 'question-circle', true ); ?>
				</span>
			</th>
			<td>
				<label for="tgwc_icon">
					<input type="checkbox" id="tgwc_icon" <?php checked( $settings['icon'] ); ?> name="tgwc_settings[icon]" />
					<span class="description">
						<?php esc_html_e( 'Enable/Disable endpoint icon.', 'customize-my-account-page-for-woocommerce' ); ?>
					</span>
				</label>
			</td>
		</tr>
		<!-- ./ Endpoint Icon -->

		<!-- Group Accordion Default State -->
		<tr>
			<th scope="row">
				<?php esc_html_e( 'Group Accordion Default State', 'customize-my-account-page-for-woocommerce' ); ?>
			</th>
			<td>
				<label for="tgwc_group_accordion_default_state">
					<select name="tgwc_settings[group_accordion_default_state]" id="tgwc_group_accordion_default_state">
						<option value="expanded" <?php selected( $settings['group_accordion_default_state'], 'expanded' ); ?>><?php esc_html_e( 'Expanded', 'customize-my-account-page-for-woocommerce' ); ?></option>
						<option value="collapsed" <?php selected( $settings['group_accordion_default_state'], 'collapsed' ); ?>><?php esc_html_e( 'Collapsed', 'customize-my-account-page-for-woocommerce' ); ?></option>
					</select>
					<span class="description">
						<?php esc_html_e( 'Set default state of group accordion.', 'customize-my-account-page-for-woocommerce' ); ?>
					</span>
				</label>
			</td>
		</tr>

		<!-- Group Accordion Icon -->
		<tr>
			<th scope="row">
				<?php esc_html_e( 'Group Accordion Indicator', 'customize-my-account-page-for-woocommerce' ); ?>
				<span data-toggle="tgwc-tooltip"
					title="<?php esc_attr_e( 'Enable/Disable group accordion indicator.', 'customize-my-account-page-for-woocommerce' ); ?>">
					<?php Icon::get_svg_icon( 'question-circle', true ); ?>
				</span>
			</th>
			<td>
				<label for="tgwc_group_accordion_icon">
					<input type="checkbox" id="tgwc_group_accordion_icon" <?php checked( $settings['group_accordion_icon'] ); ?> name="tgwc_settings[group_accordion_icon]" />
					<span class="description">
						<?php esc_html_e( 'Enable/Disable group accordion icon.', 'customize-my-account-page-for-woocommerce' ); ?>
					</span>
				</label>
			</td>
		</tr>
		<!-- ./ Endpoint Icon -->

		<!-- Endpoint icon position -->
		<tr>
			<th scope="row">
				<?php esc_html_e( 'Endpoint Icon Position', 'customize-my-account-page-for-woocommerce' ); ?>
				<span data-toggle="tgwc-tooltip"
					title="<?php esc_attr_e( 'Endpoint icon position.', 'customize-my-account-page-for-woocommerce' ); ?>">
					<?php Icon::get_svg_icon( 'question-circle', true ); ?>
				</span>
			</th>
			<td>
				<select name="tgwc_settings[icon_position]">
					<option value="left"
						<?php selected( $settings['icon_position'], 'left' ); ?>>
						<?php esc_html_e( 'Left', 'customize-my-account-page-for-woocommerce' ); ?>
					</option>
					<option value="right"
						<?php selected( $settings['icon_position'], 'right' ); ?>>
						<?php esc_html_e( 'Right', 'customize-my-account-page-for-woocommerce' ); ?>
					</option>
				</select>
			</td>
		</tr>
		<!-- ./ Endpoint icon position -->

		<!-- Default endpoint -->
		<tr>
			<th scope="row">
				<?php esc_html_e( 'Default Endpoint', 'customize-my-account-page-for-woocommerce' ); ?>
				<span data-toggle="tgwc-tooltip"
					title="<?php esc_attr_e( 'Endpoint that will appear as default when user visits account page.', 'customize-my-account-page-for-woocommerce' ); ?>">
					<?php Icon::get_svg_icon( 'question-circle', true ); ?>
				</span>
			</th>
			<td>
				<select name="tgwc_settings[default_endpoint]">
				<?php
				foreach ( tgwc_get_endpoints_by_type( 'endpoint' ) as $account_key => $account_item ) {
					$selected = selected( $account_key, $settings['default_endpoint'], false );
					printf(
						'<option %s value=%s>%s</option>',
						esc_attr( $selected ),
						esc_attr( $account_key ),
						esc_html( $account_item['label'] )
					);
				}
				?>
				</select>
			</td>
		</tr>
		<!-- ./ Default endpoint -->
	</tbody>
</table>
<?php
