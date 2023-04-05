<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <?php wp_head(); ?>
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
    } else {
        $cart_count = $cart_total = $cart_link = $account_link = $wishlist_link = '';
    }
    // $social_list =  tr_options_field('corsivalab_options.social_list');
    // $topbar_list =  tr_options_field('corsivalab_options.topbar_list');
    $topbar_list =  get_theme_mod(sanitize_underscores('Topbar List'));
    $logo = get_attachment(get_theme_mod('custom_logo'));
    $home_link = get_home_url();
    ?>
    <!-- Mobile Menu -->
    <div class="corsivalab-overlay"></div>
    <div class="navbar-mobile">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'mobile-menu',
            'container' => 'nav',
        ));
        ?>
    </div>
    <!-- Header -->
    <header class="header">
        <div class="site-header">
            <div class="top-header">
                <!-- Slider main container -->
                <div class="swiper">
                    <!-- Additional required wrapper -->
                    <?php if (!empty($topbar_list)) : ?>
                        <div class="swiper-wrapper">
                            <?php foreach ($topbar_list as $item) {
                                echo '<div class="swiper-slide">' . $item['text'] . '</div>';
                            } ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="middle-header woocommerce">
                <div class="container">
                    <div class="row row-sm justify-content-center align-items-center">
                        <div class="col-4 col-lg-2 text-left">
                            <?php
                            echo '<a href="' . $home_link . '"><img class="logo" src="' . $logo['src'] . '" alt="' . $logo['alt'] . '" /></a>';
                            ?>
                        </div>
                        <div class="col-12 col-lg-8 position-static d-none d-sm-block">
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
                        <div class="col-8 col-lg-2">
                            <div class="header-icon-inner">
                                <div class="header-icon search-icon">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-search.png" />
                                </div>
                                <div class="header-icon account-icon">
                                    <a href="<?php echo $account_link; ?>">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-account.png" />
                                    </a>
                                </div>
                                <div class="header-icon wishlist-icon">
                                    <a href="<?php echo $wishlist_link; ?>">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-wishlist.png" />
                                    </a>
                                </div>
                                <div class="header-icon currency-icon">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-currency.png" />
                                </div>
                                <div class="header-icon cart-icon">
                                    <!-- <a href="<?php echo $cart_link; ?>"> -->
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-cart.png" />
                                    <!-- </a> -->
                                    <div class="cart-count">
                                        <?php echo $cart_count; ?>
                                    </div>
                                </div>


                                <div class="header-icon navbar-toggle">
                                    <i class="fa-solid fa-bars"></i>
                                </div>


                            </div>


                        </div>
                    </div>
                </div>
                <div class="minicart-container woocommerce">
                    <div class="minicart-title"><span>YOUR CART</span><img class="close-minicart" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/close-icon.png" /></div>
                    <div class="minicart-inner">
                        <div class="menu-mini-cart">
                            <div class="minicart-text">You are just $30.00 Away from free UK next day delivery!</div>
                            <div class="wc-minicart-fragment">
                                <?php woocommerce_mini_cart(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>