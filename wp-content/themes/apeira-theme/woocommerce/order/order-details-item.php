<?php

/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */
if (!defined('ABSPATH')) {
	exit;
}
if (!apply_filters('woocommerce_order_item_visible', true, $item)) {
	return;
}
?>

<tr class="<?php echo esc_attr(apply_filters('woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order)); ?>">
	<td class="product-name">
		<?php
		$is_visible        = $product && $product->is_visible();
		$product_permalink = apply_filters('woocommerce_order_item_permalink', $is_visible ? $product->get_permalink($item) : '', $item, $order);
		?>
		<div class="product-detail">
			<?php
			$is_visible        = $product && $product->is_visible();
			$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );
			echo wp_kses_post(apply_filters('woocommerce_order_item_name', $product_permalink ? sprintf('<a class="title" href="%s">%s</a>', $product_permalink, $item->get_name()) : $item->get_name(), $item, $is_visible));
			$qty          = $item->get_quantity();
			$refunded_qty = $order->get_qty_refunded_for_item($item_id);

			do_action('woocommerce_order_item_meta_start', $item_id, $item, $order, false);
			wc_display_item_meta($item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			do_action('woocommerce_order_item_meta_end', $item_id, $item, $order, false);
			?>
			<!-- <?php if ($product->get_sku()) : ?><div class="sku">SKU: <?php echo $product->get_sku(); ?></div><?php endif; ?> -->
			<ul>
				<li>
					<p>Quantity</p>
					<span>x
						<?php
						if ($refunded_qty) {
							$qty_display = '<del>' . esc_html($qty) . '</del> <ins>' . esc_html($qty - ($refunded_qty * -1)) . '</ins>';
						} else {
							$qty_display = esc_html($qty);
						}
						echo apply_filters('woocommerce_order_item_quantity_html', '' . sprintf('%s', $qty_display) . '', $item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

						?>
					</span>
				</li>
				<?php if (!empty(get_post_meta($product->get_id(), 'quantitative', true))) { ?>
					<li>
						<p>Quantitative</p>
						<span><?php echo  get_post_meta($product->get_id(), 'quantitative', true); ?></span>
					</li>
				<?php } ?>
				<li>
					<p>Price</p>
					<span><?php echo $product->get_price();
							?></span>
				</li>
			</ul>
		</div>
	</td>
</tr>
<?php if ($show_purchase_note && $purchase_note) : ?>
	<tr class="woocommerce-table__product-purchase-note product-purchase-note">
		<td colspan="2"><?php echo wpautop(do_shortcode(wp_kses_post($purchase_note))); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
						?></td>
	</tr>
<?php endif; ?>