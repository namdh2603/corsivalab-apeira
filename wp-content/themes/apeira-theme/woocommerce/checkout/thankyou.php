<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */
defined('ABSPATH') || exit;
?>
<div class="woocommerce-order section-thankyou">
    <?php
    if ($order) :
        do_action('woocommerce_before_thankyou', $order->get_id());
    ?>
        <?php if ($order->has_status('failed')) : ?>
            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed">
                <?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?>
            </p>
            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
                <?php if (is_user_logged_in()) : ?>
                    <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
                <?php endif; ?>
            </p>
        <?php else : ?>
            <!-- <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
				<?php //echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), $order); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                ?>
			</p> -->
            <div class="default-section title-page-woocommerce pb-2 pt-0">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        <div class="head-section">
                            <div class="title">THANK YOU FOR YOUR ORDER!</div>
                            <div class="sub-thankyou"><img class="icon" src='<?php echo get_stylesheet_directory_uri(); ?>/assets/images/check-circle.png' alt=''><span>Thank you. Your order has been received</span></div>
                        </div>
                        <?php
                        $order_id = $order->get_order_number();
                        $order_point = get_post_meta($order_id, 'ywpar_points_from_cart', true);
                        ?>
                        <div class="order-information">
                            <ul>
                                <li><b>Order number: </b><span><?php echo $order_id; ?></span></li>
                                <li><b>Order date: </b><span><?php echo wc_format_datetime($order->get_date_created()); ?></span></li>
                                <li><b>Email: </b><span><?php echo $order->get_billing_email(); ?></span></li>
                                <li><b>Total: </b><span><?php echo wc_price($order->get_total()); ?></span></li>
                                <li><b>Payment method: </b><span><?php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?></span></li>
                            </ul>
                            <?php if (is_user_logged_in()) { ?>
                                <div class="points">
                                    <div class="head">
                                        <div class="txt op-70">Points gained</div>
                                        <div class="point fw-500">
                                            <?php echo $order_point . ' points'; ?>
                                        </div>
                                    </div>
                                    <div class="tfoot">
                                        <div class="txt op-70">Total points</div>
                                        <div class="point fw-500">
                                            <?php echo do_shortcode('[yith_ywpar_points label="" show_worth="0"]'); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php do_action('woocommerce_thankyou', $order->get_id()); ?>
        <div class="btn-wrap">
            <a href="<?php echo home_url(); ?>" class="btn-main w-50">BACK TO HOMEPAGE</a>
        </div>
    <?php else : ?>
        <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
            <?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), null); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped  
            ?>
        </p>
    <?php endif; ?>
</div>