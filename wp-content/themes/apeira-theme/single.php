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
    <img class="single-post-img w-100" src="<?php the_post_thumbnail_url(); ?>" alt="" />
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
<?php
corsivalab_maincontent_loop_end();
get_footer();
