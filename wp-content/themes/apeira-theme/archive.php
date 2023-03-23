<?php
get_header();
$description = get_the_archive_description();
corsivalab_maincontent_loop_start();
?>
<header class="page-header">
    <?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
    <?php if ($description) : ?>
        <div class="archive-description"><?php echo wp_kses_post(wpautop($description)); ?></div>
    <?php endif; ?>
</header>
<?php if (have_posts()) : ?>
    <div class="row list-post-inner">
        <?php while (have_posts()) : the_post();
            get_template_part('template-parts/content');
        endwhile;
        corsivalab_posts_nav();
        wp_reset_postdata(); ?>
    </div>
<?php else :
    get_template_part('template-parts/content', 'none');
endif;
corsivalab_maincontent_loop_end();
get_footer();
