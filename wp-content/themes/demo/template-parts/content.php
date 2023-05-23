<div class="col-4 mb-50">
    <div class="post-item">
        <div class="thumbnail">
            <?php if (has_post_thumbnail()) {
                the_post_thumbnail();
            } ?>
        </div>
        <h2 class="title title-25">
            <?php the_title(); ?>
        </h2>
        <div class="excerpt">
            <?php echo wp_trim_words(get_the_content(), 24, ' ...'); ?>
        </div>
        <div class="btn-wrap">
            <a href="<?php the_permalink(); ?>" class="btn-primary">READ MORE</a>
        </div>
    </div>
</div>