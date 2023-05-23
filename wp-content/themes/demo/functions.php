<?php
add_filter('big_image_size_threshold', '__return_false');
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('gutenberg_use_widgets_block_editor', '__return_false');
add_filter('wpcf7_autop_or_not', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');
require('typerocket/init.php');
//require('inc/corsivalab-shortcode.php');
// require('inc/corsivalab-addon.php');
require('inc/corsivalab-pagenavi.php');
// require('inc/menu-navwalker.php');
if (class_exists('woocommerce')) {
    // require('inc/corsivalab-field-product.php');
    // require('inc/corsivalab-field-product-cat.php');
    require('inc/corsivalab-woocommerce.php');
}
//require('inc/corsivalab-field-page.php');
// require('inc/custom-field-post.php');
// require('inc/corsivalab-register-post.php');
// require('inc/ajax-functions.php');
//require('inc/customize.php');
add_filter('tr_theme_options_page', function () {
    return get_template_directory() . '/inc/theme-options.php';
});
add_filter('tr_theme_options_name', function () {
    return 'corsivalab_options';
});
function corsivalab_setup()
{
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    // add_theme_support('wc-product-gallery-lightbox');
    // add_theme_support('wc-product-gallery-slider');
    add_theme_support('html5', array('search-form'));
    add_theme_support('customize-selective-refresh-widgets');
    add_filter('widget_text', 'do_shortcode');
    add_theme_support('custom-logo', array(
        'height' => 250,
        'width' => 250,
        'flex-width' => true,
        'flex-height' => true,
        'header-text' => array('site-title', 'site-description'),
    ));
    register_nav_menus(array(
        'main-menu' => 'Main Menu',
        'mobile-menu' => 'Mobile Menu',
    ));
}
add_action('after_setup_theme', 'corsivalab_setup');
function corsivalab_widgets()
{
    $corsivalab_sidebars = array(
        array(
            'name' => 'Default Sidebar',
            'id' => 'widget-sidebar-default',
        ),
        array(
            'name' => 'Woocommerce Sidebar',
            'id' => 'widget-sidebar-woocommerce',
        ),
        array(
            'name' => 'News Sidebar',
            'id' => 'widget-sidebar-news',
        ),
        array(
            'name' => 'Footer Column 1',
            'id' => 'widget-sidebar-footer1',
        ),
        array(
            'name' => 'Footer Column 2',
            'id' => 'widget-sidebar-footer2',
        ),
        array(
            'name' => 'Footer Column 3',
            'id' => 'widget-sidebar-footer3',
        ),
        array(
            'name' => 'Footer Column 4',
            'id' => 'widget-sidebar-footer4',
        ),
    );
    $defaults = array(
        'name' => 'Default Sidebar',
        'id' => 'widget-sidebar-default',
        'before_widget' => '<div class="widget-content">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>'
    );
    foreach ($corsivalab_sidebars as $sidebar) {
        $args = wp_parse_args($sidebar, $defaults);
        register_sidebar($args);
    }
}
add_action('widgets_init', 'corsivalab_widgets');
function corsivalab_scripts()
{
    $ver = rand();
    //$ver = '1.0';
    // <!-- Enqueue CSS -->
    wp_enqueue_style('corsivalab-fontawesome', get_stylesheet_directory_uri() . '/assets/fontawesome-pro-611/css/all.min.css', '', $ver);
    wp_enqueue_style('corsivalab-swiper', get_stylesheet_directory_uri() . '/assets/swiper-845/swiper-bundle.min.css', '', $ver);
    wp_enqueue_style('corsivalab-core', get_stylesheet_directory_uri() . '/assets/css/main.css', '', $ver);
    wp_enqueue_style('corsivalab-theme', get_stylesheet_uri(), '', $ver);
    // <!-- End Enqueue CSS -->

    // <!-- Enqueue JS -->
    wp_enqueue_script('corsivalab-bootstrap', get_stylesheet_directory_uri() . '/assets/bootstrap-523/dist/js/bootstrap.bundle.min.js', array('jquery'), $ver, false);
    wp_enqueue_script('corsivalab-main', get_stylesheet_directory_uri() . '/assets/js/main.js', array('jquery'), $ver, false);
    wp_enqueue_script('corsivalab-swiper', get_stylesheet_directory_uri() . '/assets/swiper-845/swiper-bundle.min.js', array('jquery'), $ver, false);
    // <!-- End Enqueue JS -->
}
add_action('wp_enqueue_scripts', 'corsivalab_scripts');
if (!function_exists('get_attachment')) {
    function get_attachment($attachment_id)
    {
        if ($attachment_id) {
            $attachment = get_post((int) $attachment_id);
            return array(
                'alt' => (get_post_meta($attachment->ID, '_wp_attachment_image_alt', true)) ? get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) : '',
                'caption' => ($attachment->post_excerpt != '') ? $attachment->post_excerpt : '',
                'description' => ($attachment->post_content != '') ? $attachment->post_content : '',
                'href' => (get_permalink($attachment->ID) != '') ? get_permalink($attachment->ID) : '',
                'src' => (wp_get_attachment_image_url($attachment_id, 'full') != '') ? wp_get_attachment_image_url($attachment_id, 'full') : '',
                'srcset' => (wp_get_attachment_image_srcset($attachment_id, 'post-thumbnail')) ? wp_get_attachment_image_srcset($attachment_id, 'post-thumbnail') : '',
                'title' => ($attachment->post_title != '') ? $attachment->post_title : ''
            );
        } else {
            return array(
                'alt' => '',
                'caption' => '',
                'description' => '',
                'href' => '',
                'src' => '',
                'srcset' => '',
                'title' => ''
            );
        }
    }
}
function disable_wp_responsive_images()
{
    return 1;
}
add_filter('max_srcset_image_width', 'disable_wp_responsive_images');

function corsivalab_maincontent_loop_start()
{
    echo '<div id="main" class="content-area">';
}

function corsivalab_maincontent_loop_end()
{
    echo '</div>';
}

add_action('pre_get_posts', 'my_pre_get_posts', 10, 1);
function my_pre_get_posts( $query ) {
	if( is_admin() ) return;
    if( ! is_admin() && $query->is_post_type_archive( 'gallerys' ) && $query->is_main_query() ){
        if( !$query->is_main_query() ) return;
   if (!empty($_GET['categories'])) {
            $categories = $_GET['categories'];
            $categories_arr = explode(",", $categories);
            $taxquery = array(
                array(
                    'taxonomy' => 'locations_gallery',
                    'field'    => 'term_id',
                    'terms'    => $categories_arr,
                ),
            );
            $query->set('tax_query', $taxquery);
        }
        if (!empty($_GET['type'])) {
            if ($_GET['type'] != 'all') {
                $query->set('meta_key', 'type_md');
                $query->set('meta_value', $_GET['type']);
                $query->set('compare', '==');
            }

        }
        if (!empty($_GET['orderbydate'])) {
            if ($_GET['orderbydate'] == 'asc') {
                $query->set('orderby', 'date');
                $query->set('order', 'ASC');
            }
        }
    }
    if( ! is_admin() && $query->is_post_type_archive( 'blog' ) && $query->is_main_query() ){
        if( !$query->is_main_query() ) return;
            if(!empty($_GET['sortbox'])){
                if($_GET['sortbox'] == 'recent'){
                $query->set('orderby', 'date');
                $query->set('order', 'desc');
                } elseif($_GET['sortbox']=='old'){
                    $query->set('orderby', 'date');
                    $query->set('order', 'asc');
                }
                elseif($_GET['sortbox']=='az'){
                    $query->set('orderby', 'title');
                    $query->set('order', 'asc');
                }
                elseif($_GET['sortbox']=='za'){
                    $query->set('orderby', 'title');
                    $query->set('order', 'desc');
                }
	        }
            if(!empty($_GET['blogcat'])){
                $c = $query->get('tax_query');
                $id_tax =  empty($_GET['blogcat']) ? '' : $_GET['blogcat'];
                $meta_query[] = array(
                        'taxonomy' => 'locations',
                        'field' => 'id',
                        'terms' => $id_tax,
                ); 
                $query->set('tax_query', $meta_query);
	        } 
    }
}


