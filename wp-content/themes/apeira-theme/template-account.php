<?php /* Template Name: Account Page */ ?>
<?php get_header(); ?>
<section class="account-page section-padding">
    <div class="container">
        <div class="head-section">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="title"><?php echo get_the_title(); ?></div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <?php while (have_posts()) : the_post();
                the_content();
            endwhile; ?>
        </div>
    </div>
</section>
<?php get_footer();
