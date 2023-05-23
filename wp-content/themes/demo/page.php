<?php get_header();
corsivalab_maincontent_loop_start();
if (tr_posts_field("use_builder") == '1') {
    tr_components_field('builder');
} else {
    get_template_part('standard');
}
corsivalab_maincontent_loop_end();
get_footer();