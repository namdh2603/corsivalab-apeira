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
do_action('woocommerce_before_customer_login_form'); ?>
<div class="row justify-content-center">
    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 align-self-center">
        <?php
        if (isset($_GET['register']) && $_GET['register'] == 'true') {
            if ('yes' === get_option('woocommerce_enable_myaccount_registration')) { ?>
                <div class="head-section text-start">
                    <div class="title">GET STARTED</div>
                </div>
                <form method="post" class="woocommerce-form woocommerce-form-register corsivalab-form" <?php do_action('woocommerce_register_form_tag'); ?>>
                    <?php do_action('woocommerce_register_form_start'); ?>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-first">
                        <label for="reg_firstname">FIRST NAME&nbsp;<span class="required">*</span></label>
                        <input type="email" placeholder="Your First Name" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_firstname" value="" /><?php // @codingStandardsIgnoreLine 																																																																				
                                                                                                                                                                                    ?>
                    </p>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-last">
                        <label for="reg_lastname">LAST NAME&nbsp;<span class="required">*</span></label>
                        <input type="text" placeholder="Your Last Name" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_lastname" value="" /><?php // @codingStandardsIgnoreLine 																																																																				
                                                                                                                                                                                    ?>
                    </p>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-first">
                        <label for="reg_email">Email Address&nbsp;<span class="required">*</span></label>
                        <input type="email" placeholder="email@address.com" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 																																																																				
                                                                                                                                                                                                                                                                                            ?>
                    </p>
                    <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-last">
                            <label for="reg_username">User Name&nbsp;<span class="required">*</span></label>
                            <input type="text" placeholder="Username" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 																																																																			
                                                                                                                                                                                                                                                                                                    ?>
                        </p>
                    <?php endif; ?>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_dob">DATE OF BIRTH&nbsp;<span class="required">*</span></label>
                        <input type="date" placeholder="" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_dob" value="" />
                        <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_password">Password&nbsp;<span class="required">*</span></label>
                        <input type="password" placeholder="Enter your password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
                    </p>
					
<!-- 								<p class="form-row form-row-wide">
		<label for="reg_password2"><?php _e( 'Confirm password', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
	</p> -->
					
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
        <?php } else { ?>
            <div class="head-section text-start">
                <div class="title">SIGN IN</div>
            </div>
            <form class="woocommerce-form woocommerce-form-login corsivalab-form" method="post">
                <?php do_action('woocommerce_login_form_start'); ?>
                <div class="form-group">
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="username">Email or username&nbsp;<span class="required">*</span></label>
                        <input type="text" placeholder="email@address.com" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
                                                                                                                                                                                                                                                                                                    ?>
                    </p>
                </div>
                <div class="form-group">
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="password">Password&nbsp;<span class="required">*</span></label>
                        <input placeholder="Enter your password" class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
                    </p>
                </div>
                <?php do_action('woocommerce_login_form'); ?>
                <div class="form-remember">
                    <p class="form-row">
                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
                            <span><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
                        </label>
                    <p class="woocommerce-LostPassword lost_password">
                        <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Forgot password?', 'woocommerce'); ?></a>
                    </p>
                </div>
                <div class="account-btn btn-wrap">
                    <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                    <button type="submit" class="btn-main w-100 text-uppercase woocommerce-form-login__submit" name="login" value="<?php esc_attr_e('SIGN IN', 'woocommerce'); ?>"><?php esc_html_e('SIGN IN', 'woocommerce'); ?></button>
                    <a href="<?php echo wc_get_page_permalink('myaccount'); ?>?register=true" class="register-btn btn-main btn-outline-v2 w-100">DON’T HAVE AN ACCOUNT? SIGN UP NOW</a>
                </div>
                <?php do_action('woocommerce_login_form_end'); ?>
            </form>
        <?php } ?>
    </div>
    <?php $image_login =  get_theme_mod('image_login');
    if ($image_login) : ?>
        <div class="col-12 col-sm-5 col-md-5 col-lg-5 col-xl-5 offset-lg-1">
            <div class="box-img-login">
                <div class="image">
                    <img src="<?php echo get_attachment($image_login)['src']; ?>" class="w-100" alt="img" />
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php do_action('woocommerce_after_customer_login_form'); ?>