<?php
get_header();
corsivalab_maincontent_loop_start(); ?>
<header class="page-header">
    <h1 class="page-title"><?php the_title(); ?></h1>
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
