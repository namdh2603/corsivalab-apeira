<?php
get_header();
corsivalab_maincontent_loop_start();
$s = get_search_query();
?>
<header class="page-header">
    <h1 class="page-title"><?php printf('Search results for: %s', '' . $s); ?></h1>
</header>
<div class="container">
    <?php if (have_posts()) : ?>
        <div class="row list-post-inner">
            <?php while (have_posts()) : the_post();
                get_template_part('template-parts/content', 'search');
            endwhile; ?>
        </div>
        <?php corsivalab_posts_nav(); ?>
        <?php wp_reset_postdata(); ?>
    <?php else :
        get_template_part('template-parts/content', 'none');
    endif; ?>
</div>
<?php
corsivalab_maincontent_loop_end();
get_footer();
