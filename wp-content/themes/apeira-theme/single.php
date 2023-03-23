<?php
get_header();
corsivalab_maincontent_loop_start();
?>
<div class="container">
    <div class="row pt-5">
        <div class="col-12 col-lg-4">
            <div class="sidebar-news nav-sidebar">
                <?php if (is_active_sidebar('widget-sidebar-news')) :  dynamic_sidebar('widget-sidebar-news'); endif; ?>
            </div>
        </div>
        <div class="col-12 col-lg-8 single-content mb-5">
            <img class="single-post-img w-100" src="<?php the_post_thumbnail_url(); ?>" alt="" />
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
        </div>
    </div>
</div>
</div>
<?php
corsivalab_maincontent_loop_end();
get_footer();