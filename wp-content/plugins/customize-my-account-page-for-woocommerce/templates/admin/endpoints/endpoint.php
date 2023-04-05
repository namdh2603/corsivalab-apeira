<?php
/**
 * Endpoint template.
 *
 * @since 0.1.0
 */

defined( 'ABSPATH' ) || exit;

use ThemeGrill\WoocommerceCustomizer\Icon;
?>

<div id="<?php echo esc_attr( $key ); ?>" class="tgwc-tabs-panel"
	style="<?php echo esc_attr( $initial === $key ? '' : 'display: none;' ); ?> ">
	<div class="tgwc-tabs-panel-header">
		<h2><?php echo esc_html( $endpoint['label'] ); ?></h2>
		<i><?php echo esc_html( ucwords( $endpoint['type'] ) ); ?></i>
	<?php if ( ! tgwc_is_default_endpoint( $key ) ) : ?>
		<button type="button"
			class="tgwc-button tgwc-button--small tgwc-button--danger tgwc-delete-endpoints">
			<?php esc_html_e( 'Remove', 'customize-my-account-page-for-woocommerce' ); ?>
		</button>
	<?php endif; ?>
	</div>

	<input type="hidden"
		name="tgwc_endpoints[<?php echo esc_attr( $key ); ?>][type]"
		value="<?php echo esc_attr( $endpoint['type'] ); ?>" />

	<table class="form-table">
		<tbody>
			<!-- Enable -->
			<tr>
				<th scope="row">
					<?php esc_html_e( 'Enable', 'customize-my-account-page-for-woocommerce' ); ?>
					<span data-toggle="tgwc-tooltip" title="<?php esc_attr_e( 'Enable/Disable endpoint.', 'customize-my-account-page-for-woocommerce' ); ?>">
						<?php Icon::get_svg_icon( 'question-circle', true ); ?>
					</span>
				</th>
				<td>
					<input type="checkbox"
						<?php checked( $endpoint['enable'] ); ?>
						name="tgwc_endpoints[<?php echo esc_attr( $key ); ?>][enable]" />
					<label for="tgwc_endpoints[<?php echo esc_attr( $key ); ?>][enable]">
						<?php
						printf(
							/* translators: %s: Endpoint type. */
							esc_html__( 'Enable %s', 'customize-my-account-page-for-woocommerce' ),
							esc_html( ucwords( $endpoint['type'] ) )
						);
						?>
					</label>
				</td>
			</tr>
			<!-- ./ Enable -->

			<!-- Label -->
			<tr>
				<th scope="row">
					<?php esc_html_e( 'Label', 'customize-my-account-page-for-woocommerce' ); ?>
					<span data-toggle="tgwc-tooltip" title="<?php esc_attr_e( 'Endpoint label.', 'customize-my-account-page-for-woocommerce' ); ?>">
						<?php Icon::get_svg_icon( 'question-circle', true ); ?>
					</span>
				</th>
				<td>
					<input type="text"
						name="tgwc_endpoints[<?php echo esc_attr( $key ); ?>][label]"
						value="<?php echo esc_attr( $endpoint['label'] ); ?>" />
				</td>
			</tr>
			<!-- ./ Label -->

			<!-- Slug -->
		<?php if ( ! empty( $endpoint['slug'] ) ) : ?>
			<tr>
				<th scope="row">
					<?php esc_html_e( 'Slug', 'customize-my-account-page-for-woocommerce' ); ?>
					<span data-toggle="tgwc-tooltip" title="<?php esc_attr_e( 'Endpoint slug.', 'customize-my-account-page-for-woocommerce' ); ?>">
						<?php Icon::get_svg_icon( 'question-circle', true ); ?>
					</span>
				</th>
				<td>
					<input type="text"
						name="tgwc_endpoints[<?php echo esc_attr( $key ); ?>][slug]"
						value="<?php echo esc_attr( $key ); ?>" />

				</td>
			</tr>
			<!-- ./ Slug -->
		<?php endif; ?>

			<!-- Icon -->
			<tr>
				<th scope="row">
					<?php esc_html_e( 'Icon', 'customize-my-account-page-for-woocommerce' ); ?>
					<span data-toggle="tgwc-tooltip" title="<?php esc_attr_e( 'Choose an icon for the endpoint.', 'customize-my-account-page-for-woocommerce' ); ?>">
						<?php Icon::get_svg_icon( 'question-circle', true ); ?>
					</span>
				</th>
				<td>
					<select style="width: 200px;"
						data-selected="<?php echo esc_attr( $endpoint['icon'] ); ?>"
						name="tgwc_endpoints[<?php echo esc_attr( $key ); ?>][icon]">
					</select>
				</td>
			</tr>
			<!-- ./ Icon -->

			<!-- Class -->
			<tr>
				<th scope="row">
					<?php esc_html_e( 'Class', 'customize-my-account-page-for-woocommerce' ); ?>
					<span data-toggle="tgwc-tooltip" title="<?php esc_attr_e( 'Add CSS Class. Use this CSS class to style the endpoint.', 'customize-my-account-page-for-woocommerce' ); ?>">
						<?php Icon::get_svg_icon( 'question-circle', true ); ?>
					</span>
				</th>
				<td>
					<input type="text"
						name="tgwc_endpoints[<?php echo esc_attr( $key ); ?>][class]"
						value="<?php echo esc_attr( $endpoint['class'] ); ?>" />
				</td>
			</tr>
			<!-- ./ Class -->

			<!-- User Roles -->
			<tr>
				<th scope="row">
					<?php esc_html_e( 'User Roles', 'customize-my-account-page-for-woocommerce' ); ?>
					<span data-toggle="tgwc-tooltip" title="<?php esc_attr_e( 'Endpoint will be visible to selected User Roles only. By default, endpoints will be visible to all users.', 'customize-my-account-page-for-woocommerce' ); ?>">
						<?php Icon::get_svg_icon( 'question-circle', true ); ?>
					</span>
				</th>
				<td>
					<select name="tgwc_endpoints[<?php echo esc_attr( $key ); ?>][user_role][]"
						style="width: 50%;"
						data-selected="<?php echo esc_attr( wp_json_encode( $endpoint['user_role'] ) ); ?>">
					</select>
				</td>
			</tr>
			<!-- ./ User Roles -->

			<!-- Custom content -->
			<tr>
				<th scope="row">
					<?php esc_html_e( 'Custom Content', 'customize-my-account-page-for-woocommerce' ); ?>
					<span data-toggle="tgwc-tooltip" title="<?php esc_attr_e( 'Enter custom content for endpoint.', 'customize-my-account-page-for-woocommerce' ); ?>">
						<?php Icon::get_svg_icon( 'question-circle', true ); ?>
					</span>
				</th>
				<td>
				<?php
					wp_editor(
						$endpoint['content'],
						"tgwc_endpoints_{$key}_content",
						array(
							'textarea_rows' => 5,
							'textarea_name' => "tgwc_endpoints[$key][content]",
							'wpautop'       => false,
						)
					);
					?>
				</td>
			</tr>
			<!-- ./ Custom content -->

			<!-- Custom content position -->
			<tr>
				<th scope="row">
					<?php esc_html_e( 'Custom Content Position', 'customize-my-account-page-for-woocommerce' ); ?>
					<span data-toggle="tgwc-tooltip" title="<?php esc_attr_e( 'Choose the location where custom content should appear.', 'customize-my-account-page-for-woocommerce' ); ?>">
						<?php Icon::get_svg_icon( 'question-circle', true ); ?>
					</span>
				</th>
				<td>
					<select name="tgwc_endpoints[<?php echo esc_attr( $key ); ?>][content_position]">
						<option value="before" <?php selected( 'before', $endpoint['content_position'] ); ?>><?php esc_html_e( 'Before default content', 'customize-my-account-page-for-woocommerce' ); ?></option>
						<option value="main" <?php selected( 'main', $endpoint['content_position'] ); ?>><?php esc_html_e( 'Override default content', 'customize-my-account-page-for-woocommerce' ); ?></option>
						<option value="after" <?php selected( 'after', $endpoint['content_position'] ); ?>><?php esc_html_e( 'After default content', 'customize-my-account-page-for-woocommerce' ); ?></option>
					</select>
				</td>
			</tr>
			<!-- ./ Custom content position -->
		</tbody>
	</table>
</div>
<?php