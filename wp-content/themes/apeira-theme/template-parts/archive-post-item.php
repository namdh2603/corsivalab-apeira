<?php
global $post;
// if (!empty($args['id'])) {
//     $id = $args['id'];
// 	var_dump($id);
// } else {
//     $id = get_the_ID();
// }
if ($args['col'] == 0) {
    $class = '';
} else {
    $col = (int) (12 / $args['col']);
    $class = 'col-12 col-sm-6 col-md-6 col-lg-' . $col . ' mb-5';
}
$desc = tr_field('desc');
?>
<div class="<?php echo $class; ?>">
    <div class="post-inner">
        <?php if (has_post_thumbnail()) {
            echo get_the_post_thumbnail(get_the_ID(), 'large');
        } else {
            echo wc_placeholder_img();
        } ?>
        <div class="post-information">
            <div class="post-title"><?php the_title(); ?></div>
            <?php if(!empty($desc)): ?><div class="post-excerpt"><?php echo $desc; ?></div><?php endif; ?>
            <div class="btn-wrap btn-left">
                <a class="btn-main btn-outline-v3" href="<?php the_permalink(); ?>">DISCOVER MORE</a>
            </div>
        </div>
    </div>
</div>