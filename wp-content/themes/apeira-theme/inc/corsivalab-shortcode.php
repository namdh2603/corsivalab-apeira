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
function shortcode_submenu_content($atts)
{

	
	    extract(shortcode_atts(array(
        'page_id' => 1,
    ), $atts));
	
	
    ob_start();
	?>
	 <div class="row woocommerce">
		<div class="col-12">
	 <div class="row">
		 <?php tr_components_field('builder',$page_id); ?>
		</div>
		</div>
</div>
<?php return ob_get_clean();
}
add_shortcode('submenu-content', 'shortcode_submenu_content');		 


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