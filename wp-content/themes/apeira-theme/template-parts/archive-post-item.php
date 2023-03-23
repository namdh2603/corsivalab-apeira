<?php if (!empty($args['id'])) {
    $id = $args['id'];
} else {
    $id = get_the_ID();
}
if ($args['col'] == 0) {
    $class = '';
} else {
    $col = (int) (12 / $args['col']);
    $class = 'col-12 col-sm-' . $col . ' col-md-' . $col . ' col-lg-' . $col . ' mb-5';
}
?>
<div class="<?php echo $class; ?>">
    <div class="post-inner">
        <?php if (has_post_thumbnail($id)) {
            echo get_the_post_thumbnail($id, 'full');
        } else {
            echo wc_placeholder_img();
        } ?>
        <div class="post-information">
            <div class="post-title"><?php echo get_the_title($id); ?></div>
            <div class="post-excerpt"><?php echo wp_trim_words(get_post_field('post_content', $id), 24, ' ...'); ?></div>
            <div class="btn-wrap btn-left">
                <a class="btn-main btn-outline-v2" href="<?php the_permalink($id); ?>">DISCOVER MORE</a>
            </div>
        </div>
    </div>
</div>