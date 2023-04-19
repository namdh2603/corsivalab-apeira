<?php

/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
do_action('woocommerce_before_customer_login_form');
            if ('yes' === get_option('woocommerce_enable_myaccount_registration')) { ?>
                <form method="post" class="woocommerce-form woocommerce-form-register corsivalab-form" <?php do_action('woocommerce_register_form_tag'); ?>>
                    <?php do_action('woocommerce_register_form_start'); ?>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-first">
                        <label for="reg_firstname">FIRST NAME&nbsp;<span class="required">*</span></label>
                        <input type="text" placeholder="Your First Name" class="woocommerce-Input woocommerce-Input--text input-text" name="firstname" id="reg_firstname" value="<?php echo (!empty($_POST['firstname'])) ? esc_attr($_POST['firstname']) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
					</p>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-last">
                        <label for="reg_lastname">LAST NAME&nbsp;<span class="required">*</span></label>
                        <input type="text" placeholder="Your Last Name" class="woocommerce-Input woocommerce-Input--text input-text" name="lastname" id="reg_lastname" value="<?php echo (!empty($_POST['lastname'])) ? esc_attr($_POST['lastname']) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
					</p>
					
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-first">
                        <label for="reg_email">Email Address&nbsp;<span class="required">*</span></label>
                        <input type="email" placeholder="email@address.com" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
					</p>
                    <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-last">
                            <label for="reg_username">User Name&nbsp;<span class="required">*</span></label>
                            <input type="text" placeholder="Username" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 																																																																			
                                                                                                                                                                                                                                                                                                    ?>
                        </p>
                    <?php endif; ?>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_dob">DATE OF BIRTH</label>
                        <input type="date" placeholder="" class="woocommerce-Input woocommerce-Input--text input-text" name="dob" id="reg_dob" value="" />
					</p>
                        <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_password">Password&nbsp;<span class="required">*</span></label>
                        <input type="password" placeholder="Enter your password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
                    </p>
					
			
					
					
                <?php else : ?>
                    <p><?php esc_html_e('A password will be sent to your email address.', 'woocommerce'); ?></p>
                <?php endif; ?>
                <?php do_action('woocommerce_register_form'); ?>
                <div class="account-btn btn-wrap">
                    <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                    <button type="submit" class="btn-main w-100 text-uppercase woocommerce-form-register__submit" name="register" value="<?php esc_attr_e('SIGN UP', 'woocommerce'); ?>"><?php esc_html_e('SIGN UP', 'woocommerce'); ?></button>
                    <a href="<?php echo wc_get_page_permalink('myaccount'); ?>" class="register-btn btn-main btn-outline-v2 w-100">ALREADY HAVE AN ACCOUNT? SIGN IN NOW</a>
                </div>
                <?php do_action('woocommerce_register_form_end'); ?>
                </form>
            <?php } ?>
        

<?php do_action('woocommerce_after_customer_login_form'); ?>