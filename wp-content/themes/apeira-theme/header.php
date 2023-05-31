<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <?php wp_head(); ?>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PPRPCYHK4Z"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-PPRPCYHK4Z');
    </script>

</head>

<body <?php body_class(); ?>>
<?php


if (class_exists('woocommerce')) {
    global $woocommerce;
    $cart_count = $woocommerce->cart->get_cart_contents_count();
    $cart_total = $woocommerce->cart->get_total();
    $cart_link = wc_get_cart_url();
    $account_link = get_permalink(get_option('woocommerce_myaccount_page_id'));
    $wishlist_link = get_permalink(get_option('yith_wcwl_wishlist_page_id'));

// 		$shipping_price = get_free_shipping_minimum('Singapore')
    $shipping_price = get_shipping_price('Singapore', 'Standard Delivery');
    $minicart_txt = sprintf(get_theme_mod(sanitize_underscores('Minicart Add Custom Text')), $shipping_price);


} else {
    $cart_count = $cart_total = $cart_link = $account_link = $wishlist_link = '';
}
// $social_list =  tr_options_field('corsivalab_options.social_list');
// $topbar_list =  tr_options_field('corsivalab_options.topbar_list');
$topbar_list = get_theme_mod(sanitize_underscores('Topbar List'));
$logo = wp_get_attachment_image(get_theme_mod('custom_logo'), 'medium', "", array( "class" => "logo" ));
$home_link = get_home_url();
?>
<!-- Mobile Menu -->
<div class="corsivalab-overlay"></div>
<div class="navbar-mobile">
    <div class="header-icon-inner">
        <div class="header-icon search-icon">
            <div class="dropdown">
                <div class="dropdown-toggle" data-bs-toggle="dropdown"><img
                            src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-search.png"/></div>
                <div class="dropdown-menu dropdown-menu-end  corsivalab-dropdown">
                    <?php echo do_shortcode('[fibosearch]'); ?>
                </div>
            </div>
        </div>
        <div class="header-icon account-icon">
            <a href="<?php echo $account_link; ?>">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-account.png"/>
            </a>
        </div>
        <div class="header-icon wishlist-icon">
            <a href="<?php echo $wishlist_link; ?>">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-wishlist.png"/>
            </a>
        </div>
        <div class="header-icon currency-icon">
            <div class="dropdown">
                <div class="dropdown-toggle" data-bs-toggle="dropdown"><img
                            src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-currency.png"/></div>
                <div class="dropdown-menu dropdown-menu-end  corsivalab-dropdown">
                    <?php echo do_shortcode('[woo_multi_currency_layout3]'); ?>
                </div>
            </div>
        </div>
        <div class="header-icon cart-icon">
            <a href="<?php echo $cart_link; ?>">
                <img src="<?php echo esc_url(get_stylesheet_directory_uri(). '/assets/images/icon-cart.png'); ?>"/>
            </a>
            <div class="cart-count">
                <?php echo $cart_count; ?>
            </div>
        </div>
    </div>
    <?php
    wp_nav_menu(array(
        'theme_location' => 'main-menu',
        'container' => 'nav',
//         'depth' => 0,
		'walker' => new Default_Mobile_Walker(),
    ));
    ?>
</div>
<!-- Header -->
<div id="header-sticky-element">


    <div class="top-header">
        <!-- Slider main container -->
        <!--                 <div class="swiper"> -->
        <!-- Additional required wrapper -->
        <?php if (!empty($topbar_list)) : ?>
            <div class="mq-Marquee" style="--Marquee_Gap:80px;--Marquee_Speed:35s;">
                <div class="hd-AnnouncementBar_Items mq-Marquee_Items">
                    <?php foreach ($topbar_list as $item) {
                        echo '<div class="hd-AnnouncementBar_Item mq-Marquee_Item"><a href="' . $item['link'] . '">' . $item['text'] . '</a></div>';
                    } ?>
                </div>
                <div class="hd-AnnouncementBar_Items mq-Marquee_Items">
                    <?php foreach ($topbar_list as $item) {
                        echo '<div class="hd-AnnouncementBar_Item mq-Marquee_Item"><a href="' . $item['link'] . '">' . $item['text'] . '</a></div>';
                    } ?>
                </div>
                <div class="hd-AnnouncementBar_Items mq-Marquee_Items">
                    <?php foreach ($topbar_list as $item) {
                        echo '<div class="hd-AnnouncementBar_Item mq-Marquee_Item"><a href="' . $item['link'] . '">' . $item['text'] . '</a></div>';
                    } ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <header class="header">
        <div class="site-header">

            <div class="middle-header woocommerce">
                <div class="container-custom">
                    <div class="row flex-row-reverse flex-lg-row justify-content-center align-items-center">
                        <div class="col-3 d-block d-lg-none">
                            <div class="header-icon cart-icon d-flex justify-content-end me-0">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-cart.png"/>
                                <div class="cart-count">
                                    <?php echo $cart_count; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-2 text-center">
                            <?php
                            echo '<a href="' . $home_link . '">'.$logo.'</a>';
                            ?>
                        </div>
                        <div class="col-12 col-lg-8 position-static d-none d-lg-block">
                            <?php wp_nav_menu(
                                array(
                                    'theme_location' => 'main-menu',
                                    'container' => false,
                                    //'container_class' => 'menu',
                                    'menu_class' => 'navmenu',
                                    'walker' => new Default_Walker(),
                                )
                            );
                            ?>
                        </div>
                        <div class="col-3 col-lg-2">
                            <div class="header-icon-inner">
                                <div class="header-icon search-icon">
                                    <div class="dropdown">
                                        <div class="dropdown-toggle" data-bs-toggle="dropdown"><img
                                                    src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-search.png"/>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-end  corsivalab-dropdown">
                                            <?php echo do_shortcode('[fibosearch]'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="header-icon account-icon">
                                    <a href="<?php echo $account_link; ?>">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-account.png"/>
                                    </a>
                                </div>
                                <div class="header-icon wishlist-icon">
                                    <a href="<?php echo $wishlist_link; ?>">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-wishlist.png"/>
                                    </a>
                                </div>
                                <div class="header-icon currency-icon">
                                    <div class="dropdown">
                                        <div class="dropdown-toggle" data-bs-toggle="dropdown"><img
                                                    src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-currency.png"/>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-end  corsivalab-dropdown">
                                            <?php echo do_shortcode('[woo_multi_currency_layout3]'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="header-icon cart-icon">
                                    <!-- <a href="<?php echo $cart_link; ?>"> -->
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-cart.png"/>
                                    <!-- </a> -->
                                    <div class="cart-count">
                                        <?php echo $cart_count; ?>
                                    </div>
                                </div>
                                <div class="header-icon navbar-toggle">
                                    <!--                                     <i class="fa-solid fa-bars"></i> -->
                                    <i class="fa fa-bars"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="minicart-container woocommerce">
                    <div class="minicart-title"><span>YOUR CART</span><img class="close-minicart"
                                                                           src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/close-icon.png"/>
                    </div>
                    <div class="minicart-inner">
                        <div class="menu-mini-cart">
                            <div class="minicart-text"><?php echo $minicart_txt; ?></div>
                            <div class="wc-minicart-fragment">
                                <?php woocommerce_mini_cart(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

</div>