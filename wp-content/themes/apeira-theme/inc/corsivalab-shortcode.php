<?php
function shortcode_list_social()
{
    $social_list =  get_theme_mod('social_list');
    ob_start();
    if ($social_list) :
        echo '<div class="social-footer-section d-flex align-items-center"><ul class="social-list">';
        foreach ($social_list as $value) {
            $img_ID = $value['social_icon'];
            echo '<li><a href="' . $value['social_link'] . '">' . wp_get_attachment_image($img_ID, 'full') . '</a></li>';
        }
        echo '</ul></div>';
    endif;
    return ob_get_clean();
}
add_shortcode('corsivalab-social-icons', 'shortcode_list_social');
function shortcode_info_company()
{
    $info_company =  tr_options_field('corsivalab_options.info_company');
    ob_start();
    echo '<div class="info-company">';
    foreach ($info_company as $value) {
        // $img_ID = $value['icon'];
        // $img_alt = get_post_meta($img_ID, '_wp_attachment_image_alt', true);
        echo '<div class="item-company">
        <em>' . $value['title'] . '</em>
        <span>' . $value['description_item'] . '</span>
        </div>';
    }
    echo '</div>';
    return ob_get_clean();
}
add_shortcode('contact-info', 'shortcode_info_company');
function shortcode_menu_content()
{
    ob_start();
    //$shop_page = wc_get_page_permalink('shop');
    $sub_menu_1 =  get_theme_mod(sanitize_underscores('Sub Menu Column 1'));
    $sub_menu_2 =  get_theme_mod(sanitize_underscores('Sub Menu Column 2'));
    $sub_menu_3 =  get_theme_mod(sanitize_underscores('Sub Menu Column 3'));
    $sub_right =  get_theme_mod(sanitize_underscores('Sub Menu Right Item'));
?>
    <div class="row">
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <?php
                    if(!empty($sub_menu_1)):
            $sub_menu_1_obj = wp_get_nav_menu_object($sub_menu_1);
            $sub_menu_1_items = wp_get_nav_menu_items($sub_menu_1);
                    ?>
                    <h4 class="title-sub-block"><?php echo wp_kses_post($sub_menu_1_obj->name); ?></h4>
                    <ul>
                        <?php foreach ($sub_menu_1_items as $menu_item) {
                            if ($menu_item->menu_item_parent == 0) {
                                echo '<li><a href="' . $menu_item->url . '">' . $menu_item->title . '</a></li>';
                            }
                        } ?>
                    </ul>
                    <?php endif; ?>
                </div>
                <div class="col-4">
                    <?php
                    if(!empty($sub_menu_2)):
                    
            $sub_menu_2_obj = wp_get_nav_menu_object($sub_menu_2);
            $sub_menu_2_items = wp_get_nav_menu_items($sub_menu_2);
                    ?>
                    <h4 class="title-sub-block"><?php echo wp_kses_post($sub_menu_2_obj->name); ?></h4>
                    <ul>
                        <?php foreach ($sub_menu_2_items as $menu_item) {
                            if ($menu_item->menu_item_parent == 0) {
                                echo '<li><a href="' . $menu_item->url . '">' . $menu_item->title . '</a></li>';
                            }
                        } ?>
                    </ul>
                    <?php endif; ?>
                </div>
                <div class="col-4">
                    <?php
                    if(!empty($sub_menu_3)):
            $sub_menu_3_obj = wp_get_nav_menu_object($sub_menu_3);
            $sub_menu_3_items = wp_get_nav_menu_items($sub_menu_3);
                    ?>
                    <h4 class="title-sub-block"><?php echo wp_kses_post($sub_menu_3_obj->name); ?></h4>
                    <ul>
                        <?php foreach ($sub_menu_3_items as $menu_item) {
                            if ($menu_item->menu_item_parent == 0) {
                                echo '<li><a href="' . $menu_item->url . '">' . $menu_item->title . '</a></li>';
                            }
                        } ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <?php foreach ($sub_right as $item) { ?>
                    <div class="col-6">
                        <div class="sub-img"><img src="<?php echo get_attachment($item['image'])['src']; ?>" /></div>
                        <div class="sub-title"><?php echo $item['text']; ?></div>
                        <div class="sub-desc"><?php echo $item['desc']; ?></div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php return ob_get_clean();
}
add_shortcode('menu-shop-content', 'shortcode_menu_content');
function shortcode_similar_blogposts()
{
    ob_start();
    echo '<ul class="list post-list">';
    $args = array(
        'post_type'    => 'post',
        'posts_per_page' => 4,
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
            <li class="sb-post-item">
                <div class="sb-post-image">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>
                </div>
                <div class="sb-post-name">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                    <div class="small-text"><?php echo wp_trim_words(get_the_content(), 10, '...'); ?></div>
                </div>
            </li>
        <?php endwhile;
        wp_reset_postdata();
    endif;
    echo '</ul>';
    return ob_get_clean();
}
add_shortcode('similar-blogposts', 'shortcode_similar_blogposts');
function shortcode_feature_list()
{
    ob_start();
    $feature_item =  tr_options_field('corsivalab_options.feature_item');
    if (!empty($feature_item)) : ?>
        <div class="default-section feature-list-section" style="background-color: #F3F8EF">
            <div class="container">
                <div class="feature-list-inner">
                    <div class="row row-eq-height">
                        <?php foreach ($feature_item as $item) {
                            $title = $item['title'];
                            $description = $item['description'];
                            $description = str_replace("|", "<br>", $description);
                            $image = $item['icon'];
                            $image_data = get_attachment($image);
                        ?>
                            <div class="col-4 col-lg-4">
                                <div class="feature-item text-left">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-lg-4">
                                            <div class="feature-icon">
                                                <?php echo '<img src="' . $image_data['src'] . '" alt="' . $image_data['alt'] . '" title="' . $image_data['title'] . '" />'; ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-8">
                                            <div class="feature-info">
                                                <div class="name"><?php echo $title; ?></div>
                                                <div class="address"><?php echo $description; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
<?php endif;
    return ob_get_clean();
}
add_shortcode('feature-list', 'shortcode_feature_list');
