<?php /* Template Name: Cart Page */ ?>
<?php get_header(); ?>
<section class="cart-page">
    <div class="container">
        <section class="breadcrumb-section">
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php if (function_exists('bcn_display')) {
                    bcn_display();
                } ?>
            </div>
        </section>
        <div class="head-section">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="title"><?php echo get_the_title(); ?></div>
                </div>
            </div>
        </div>
        <div class="inner">
            <div class="page-content">
                <?php while (have_posts()) : the_post();
                    the_content();
                endwhile; ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer();