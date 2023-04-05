<?php
get_header();
corsivalab_maincontent_loop_start();
?>
<section class="breadcrumb-section">
    <div class="container">
        <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
            <?php if (function_exists('bcn_display')) {
                bcn_display();
            } ?>
        </div>
    </div>
</section>
<div class="container post-container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
            <div class="post-header text-center">
                <h1><?php the_title(); ?></h1>
                <div class="post-date"><?php echo get_the_date(get_option('date_format')); ?></div>
            </div>
        </div>
    </div>
    <?php if (!empty(tr_post_field('banner'))) : ?>
        <img class="single-post-img w-100" src="<?php echo get_attachment(tr_post_field('banner'))['src']; ?>" alt="" />
    <?php endif; ?>
    <!-- <img class="single-post-img w-100" src="<?php the_post_thumbnail_url(); ?>" alt="" /> -->
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
            <div class="post-content">
                <?php the_content(); ?>
                <div class="post-author">
                    <?php
                    global $post;
                    $author_id = $post->post_author;
                    $author_displayname = get_the_author_meta('display_name', $author_id);
                    $author_url = get_the_author_meta('url', $author_id);
                    $author_avatar = get_avatar($author_id);
                    // var_dump($author_avatar);
                    ?>
                    <div class="about-author">
                        <div class="author-avatar">
                            <a href="<?php echo $author_url; ?>">
                                <?php echo $author_avatar; ?>
                            </a>
                        </div>
                        <div class="author-info">
                            <h3 class="author-name"><a href="<?php echo $author_url; ?>"><?php echo $author_displayname; ?></a></h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div id="relatedpost-cat">

    <section class="section-sustainability section-padding" style="background-color:#e8ded3;">
        <div class="container">
            <div class="head-section">
                <div class="row">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 text-start">
                        <div class="sub-title">SUSTAINABILITY</div>
                        <div class="title">SIMILAR POSTS</div>
                    </div>
                </div>
            </div>
            <div class="posts-carousel">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php
                        // $categories = get_the_category($post->ID);
                        // if ($categories) {
                        //     $category_ids = array();
                        //     foreach ($categories as $individual_category) $category_ids[] = $individual_category->term_id;

                        $args = array(
                            // 'category__in' => $category_ids,
                            'post_type' => get_post_type(),
                            'post__not_in' => array($post->ID),
                            'showposts' => 5,
                            // 'caller_get_posts' => 1
                        );
                        $my_query = new WP_Query($args);
                        if ($my_query->have_posts()) {
                            while ($my_query->have_posts()) {
                                $my_query->the_post();
                        ?>

                                <?php
                                $item = get_the_ID();
                                $title = get_the_title();
                                $excerpt = wp_trim_words(strip_shortcodes(get_the_content()), 20, ' ...');
                                ?>
                                <div class="swiper-slide">
                                    <?php get_template_part('template-parts/archive', 'post-item', array('id' => $item, 'col' => 0)); ?>
                                </div>
                            <?php } ?>


                        <?php
                        }
                        // }
                        ?>
                    </div>
                </div>
                <div class="swiper-button-next-unique"><i class="fal fa-long-arrow-right"></i></div>
                <div class="swiper-button-prev-unique"><i class="fal fa-long-arrow-left"></i></div>
            </div>
        </div>
    </section>




</div>


<?php
corsivalab_maincontent_loop_end();
get_footer();
