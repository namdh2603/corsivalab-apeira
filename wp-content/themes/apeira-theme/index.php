<?php
get_header();
corsivalab_maincontent_loop_start();
$banner =  get_theme_mod(sanitize_underscores('Blog Page Banner'));
if (!empty($banner)) : ?>
    <section class="section-page-banner-title section-padding" style="background-image: url('<?php echo get_attachment($banner)['src']; ?>'); background-size:cover; background-position: center center;">
        <div class="head-section">
            <div class="title"><?php single_post_title(); ?></div>
        </div>
    </section>
<?php endif; ?>
<section class="breadcrumb-section">
    <div class="container">
        <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
            <?php if (function_exists('bcn_display')) {
                bcn_display();
            } ?>
        </div>
    </div>
</section>
<section class="section-blog">
    <div class="container">
        <?php
        $count = $wp_query->found_posts;
        ?>
        <div class="top-header-blog sort-by">
            <div class="filter-left">ALL FOUND - <?php printf(_n('%s post', '%s posts', $count), $count); ?></div>
            <div class="filter-right">

                <div class="dropdown">
                    <div class="dropdown-toggle" data-bs-toggle="dropdown">SORT BY <img class="dropdown-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/arrow-dropdown-icon.png" /></div>
                    <ul class="dropdown-menu dropdown-menu-end">


                        <li><a class="dropdown-item" href="?orderby=desc">Most recent</a></li>
                        <li><a class="dropdown-item" href="?orderby=asc">Oldest</a></li>


                    </ul>
                </div>

            </div>
        </div>
        <?php if (have_posts()) : ?>
            <div class="posts-grid">
                <div class="row">
                    <?php while (have_posts()) : the_post();
                        get_template_part('template-parts/archive', 'post-item', array('col' => 3));
                    endwhile; ?>
                </div>
                <?php corsivalab_posts_nav();
                wp_reset_postdata(); ?>
            </div>
        <?php else : ?>
            <?php get_template_part('template-parts/content-none'); ?>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
    </div>
</section>
<?php
corsivalab_maincontent_loop_end();
get_footer();
