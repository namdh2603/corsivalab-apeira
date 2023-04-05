<?php
/**
 * Frontend group item.
 *
 * @since 0.1.0
 */

defined( 'ABSPATH' ) || exit;

use ThemeGrill\WoocommerceCustomizer\Icon;

?>
<li <?php printf( '%s', 'sidebar' === tgwc_get_menu_style() && 'collapsed' === tgwc_get_group_accordion_default_state() ? esc_attr( 'data-collapsed=true' ) : '' ); ?> class="<?php echo esc_attr( wc_get_account_menu_item_classes( $slug ) ); ?>">
	<a href="#"
		data-endpoint="<?php echo esc_attr( $slug ); ?>"
	>
		<span>
			<?php
			echo esc_html( $label );
			if ( tgwc_is_endpoint_icon_enabled() ) {
				$icon = str_replace( 'fas fa-', '', $icon );
				Icon::get_svg_icon( $icon, true );
			}
			?>
		</span>
		<?php
		if ( isset( $children ) && tgwc_is_group_accordion_icon_enabled() && 'tab' !== tgwc_get_menu_style() ) {
			if ( 'collapsed' === tgwc_get_group_accordion_default_state() ) {
				Icon::get_svg_icon( 'plus', true );
			} else {
				Icon::get_svg_icon( 'minus', true );
			}
		}
		?>
	</a>

<?php if ( isset( $children ) ) : ?>
	<ul>
		<?php
		$children = tgwc_get_account_menu_items( $children );
		foreach ( $children as $child_slug => $child ) {
			do_action( "tgwc_myaccount_menu_item_{$child_slug}", $child_slug );
			do_action( 'tgwc_my_account_menu_item', $child_slug );
		}
		?>
	</ul>
<?php endif; ?>
</li>
<?php

