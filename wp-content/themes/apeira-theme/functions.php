<?php
add_filter('big_image_size_threshold', '__return_false');
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('gutenberg_use_widgets_block_editor', '__return_false');
add_filter('wpcf7_autop_or_not', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');
require('typerocket/init.php');
require('inc/corsivalab-shortcode.php');
require('inc/corsivalab-rewards.php');

// require('inc/corsivalab-addon.php');
require('inc/corsivalab-pagenavi.php');
require('inc/menu-navwalker.php');
if (class_exists('woocommerce')) {
    require('inc/corsivalab-field-product.php');
    require('inc/corsivalab-field-product-cat.php');
    require('inc/corsivalab-woocommerce.php');
}
//require('inc/corsivalab-field-page.php');
require('inc/corsivalab-field-post.php');
// require('inc/corsivalab-register-post.php');
// require('inc/ajax-functions.php');
//require('inc/customize.php');
// add_filter('tr_theme_options_page', function () {
//     return get_template_directory() . '/inc/theme-options.php';
// });
// add_filter('tr_theme_options_name', function () {
//     return 'corsivalab_options';
// });

if (!class_exists('Kirki')) {
    require('kirki-410/kirki.php');
    require('inc/corsivalab-customize.php');
}

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
    // wp_enqueue_style('corsivalab-bootstrap', get_stylesheet_directory_uri() . '/assets/bootstrap-530/dist/css/bootstrap.min.css', $ver);
    wp_enqueue_style('corsivalab-swiper', get_stylesheet_directory_uri() . '/assets/swiper-845/swiper-bundle.min.css', '', $ver);
    //wp_enqueue_style('corsivalab-fontawesome', get_stylesheet_directory_uri() . '/assets/fontawesome-pro-611/css/all.min.css', '', $ver);
    wp_enqueue_style('corsivalab-core', get_stylesheet_directory_uri() . '/assets/css/main.css', '', $ver);
    wp_enqueue_style('corsivalab-theme', get_stylesheet_uri(), '', $ver);
    wp_enqueue_style('corsivalab-fancybox', get_stylesheet_directory_uri() . '/assets/fancybox/fancybox.css', '', $ver);

    // <!-- End Enqueue CSS -->

    // <!-- Enqueue JS -->
    wp_enqueue_script('corsivalab-bootstrap', get_stylesheet_directory_uri() . '/assets/bootstrap-530/dist/js/bootstrap.bundle.min.js', array('jquery'), $ver, false);
    wp_enqueue_script('corsivalab-swiper', get_stylesheet_directory_uri() . '/assets/swiper-845/swiper-bundle.min.js', array('jquery'), $ver, false);
    wp_enqueue_script('corsivalab-main', get_stylesheet_directory_uri() . '/assets/js/main.js', array('jquery'), $ver, false);
    wp_enqueue_script('corsivalab-fancybox', get_stylesheet_directory_uri() . '/assets/fancybox/fancybox.umd.js', array('jquery'), $ver, false);
    wp_enqueue_script('corsivalab-pushToUrl', get_stylesheet_directory_uri() . '/assets/js/pushToUrl.jQuery.js', array('jquery'), $ver, false);
	
	
    wp_enqueue_script('corsivalab-cookie', get_stylesheet_directory_uri() . '/assets/js/js.cookie.min.js', array('jquery'), $ver, false);
	
	
	
    wp_enqueue_script('corsivalab-iframe-track', get_stylesheet_directory_uri() . '/assets/js/jquery.iframetracker.min.js', array('jquery'), $ver, false);
    wp_enqueue_script('corsivalab-reward', get_stylesheet_directory_uri() . '/assets/js/reward-ajax.js', array('jquery'), $ver, false);
	wp_localize_script( 'corsivalab-reward', 'corsivalab_vars',
					   array(
						   'ajax_url' => admin_url('admin-ajax.php'),
					   ) );
    // <!-- End Enqueue JS -->
}
add_action('wp_enqueue_scripts', 'corsivalab_scripts');

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
function my_pre_get_posts($query)
{
    if (is_admin()) return;
    if (!is_admin() && $query->is_post_type_archive('gallerys') && $query->is_main_query()) {
        if (!$query->is_main_query()) return;
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
    if (!is_admin() && $query->is_post_type_archive('blog') && $query->is_main_query()) {
        if (!$query->is_main_query()) return;
        if (!empty($_GET['sortbox'])) {
            if ($_GET['sortbox'] == 'recent') {
                $query->set('orderby', 'date');
                $query->set('order', 'desc');
            } elseif ($_GET['sortbox'] == 'old') {
                $query->set('orderby', 'date');
                $query->set('order', 'asc');
            } elseif ($_GET['sortbox'] == 'az') {
                $query->set('orderby', 'title');
                $query->set('order', 'asc');
            } elseif ($_GET['sortbox'] == 'za') {
                $query->set('orderby', 'title');
                $query->set('order', 'desc');
            }
        }
        if (!empty($_GET['blogcat'])) {
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


function sanitize_underscores($title)
{
    return str_replace('-', '_', sanitize_title($title));
}


function getYoutubeIdFromUrl($url)
{
    $parts = parse_url($url);
    if (isset($parts['query'])) {
        parse_str($parts['query'], $qs);
        if (isset($qs['v'])) {
            return $qs['v'];
        } else if (isset($qs['vi'])) {
            return $qs['vi'];
        }
    }
    if (isset($parts['path'])) {
        $path = explode('/', trim($parts['path'], '/'));
        return $path[count($path) - 1];
    }
    return false;
}



add_shortcode('wc_reg_form_bbloomer', 'bbloomer_separate_registration_form');
function bbloomer_separate_registration_form()
{
if (is_user_logged_in()){
							echo '<div class="head-section"><div class="title text-center mt-30">You are already registered</div></div>';
						} else {
	echo '<div class="woocommerce">';
							wc_get_template_part( 'myaccount/form-register' );
	echo '</div>';
						}
}

function bbloomer_separate_registration_form2()
{
    if (is_user_logged_in()) return '<div class="head-section"><div class="title text-center mt-30">You are already registered</div></div>';
    ob_start();
    do_action('woocommerce_before_customer_login_form');
    $html = wc_get_template_html('myaccount/form-login.php');
    $dom = new DOMDocument();
    $dom->encoding = 'utf-8';
    $dom->loadHTML(utf8_decode($html));
    $xpath = new DOMXPath($dom);
    $form = $xpath->query('//form[contains(@class,"register")]');
    $form = $form->item(0);
    echo $dom->saveXML($form);
    return ob_get_clean();
}


add_shortcode('wc_login_form_bbloomer', 'bbloomer_separate_login_form');

function bbloomer_separate_login_form()
{
    if (is_user_logged_in()) return '<p>You are already logged in</p>';
    ob_start();
    do_action('woocommerce_before_customer_login_form');
    woocommerce_login_form(array('redirect' => wc_get_page_permalink('myaccount')));
    return ob_get_clean();
}


add_action('template_redirect', 'bbloomer_redirect_login_registration_if_logged_in');

function bbloomer_redirect_login_registration_if_logged_in()
{
    if (is_page() && is_user_logged_in() && (has_shortcode(get_the_content(), 'wc_login_form_bbloomer') || has_shortcode(get_the_content(), 'wc_reg_form_bbloomer'))) {
        wp_safe_redirect(wc_get_page_permalink('myaccount'));
        exit;
    }
}


function wpdocs_my_search_form($form)
{
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url('/') . '" >
	<div class="search-inner">
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="What are you looking for…" />
    <button type="submit" value="Submit"><img src="' . get_stylesheet_directory_uri() . '/assets/images/icon-search-form.png" /></button>
	</div>
	</form>';

    return $form;
}
add_filter('get_search_form', 'wpdocs_my_search_form');

function shortcode_search_form()
{
    return get_search_form(
        array(
            'echo' => false,
        )
    );
}

add_shortcode('search_form', 'shortcode_search_form');



function cptui_register_my_cpts_hnc_block() {
	$labels = [
		"name" => esc_html__( "Menu Blocks", "apeira" ),
		"singular_name" => esc_html__( "Menu Blocks", "apeira" ),
	];
	$args = [
		"label" => esc_html__( "Menu Blocks", "apeira" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "page",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "menu_blocks", "with_front" => true ],
		"query_var" => false,
		"supports" => [ "title", "editor" ],
		"show_in_graphql" => false,
	];

	register_post_type( "menu_blocks", $args );
}

add_action( 'init', 'cptui_register_my_cpts_hnc_block' );


add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
    return array(
        'width'  => 200,
        'height' => 200,
        'crop'   => 0,
    );
} );


function get_free_shipping_minimum($zone_name = 'England') {
  if ( ! isset( $zone_name ) ) return null;

  $result = null;
  $zone = null;

  $zones = WC_Shipping_Zones::get_zones();
  foreach ( $zones as $z ) {
    if ( $z['zone_name'] == $zone_name ) {
      $zone = $z;
    }
  }

  if ( $zone ) {
    $shipping_methods_nl = $zone['shipping_methods'];
    $free_shipping_method = null;
    foreach ( $shipping_methods_nl as $method ) {
      if ( $method->id == 'free_shipping' ) {
        $free_shipping_method = $method;
        break;
      }
    }

    if ( $free_shipping_method ) {
      $result = wc_price($free_shipping_method->min_amount);
		
    }
  }

  return $result;
}



function get_shipping_price($zone_name = 'England', $title) {
  if ( ! isset( $zone_name ) ) return null;

  $result = null;
  $zone = null;

		$zones = WC_Shipping_Zones::get_zones();
  foreach ( $zones as $z ) {
    if ( $z['zone_name'] == $zone_name ) {
      $zone = $z;
    }
  }

  if ( $zone ) {
    $shipping_methods_nl = $zone['shipping_methods'];
    $shipping_method_data = null;
    foreach ( $shipping_methods_nl as $method ) {
		
		
      if ( $method->title == $title ) {
        $shipping_method_data = $method;
        break;
      }
    }
  

    if ( $shipping_method_data ) {
      $result = wc_price($shipping_method_data->cost);
		
    }
  }

  return $result;
}

 
function wp_cookies_popup() {
// $visit_time = date('F j, Y g:i a');
// $day = 30;
// $convert_day = $day * 24 * 60 * 60;
 
// Check if cookie is already set
if(!isset($_COOKIE['wp_visit_time_popup'])) {

    $wel_popup =  get_theme_mod(sanitize_underscores('Welcome Popup'));
	if(!empty($wel_popup)){
    $days =  get_theme_mod(sanitize_underscores('Popup Day'));
    $popup_img =  get_theme_mod(sanitize_underscores('Welcome Popup Image'));
    $popup_title =  get_theme_mod(sanitize_underscores('Welcome Popup Title'));
    $popup_desc =  get_theme_mod(sanitize_underscores('Welcome Popup Desc'));
	
?>
 <div class="modal fade modal-element" id="welcomeModal" tabindex="-1" role="dialog" data-days="<?php echo $days; ?>">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
          <div class="close" data-bs-dismiss="modal"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/close-icon.png" /></div>
            <div class="row">
              <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <?php if ($popup_img) {
                  echo '<img class="w-100" src="' . $popup_img . '" />';
                } ?>
              </div>
              <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="info-modal d-flex justify-content-center align-items-center flex-column text-center">
                  <?php if (!empty($popup_title)) : ?>

                    <div class="title-modal"><?php echo $popup_title; ?></div>
                  <?php endif; ?>

                  <?php if (!empty($popup_desc)) : ?>
                  <div class="desc"><?php echo $popup_desc; ?></div>

                  <?php endif; ?>
					
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
	}
}
}