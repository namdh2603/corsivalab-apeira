<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerceTemplates
 * @version 3.4.0
 */
defined('ABSPATH') || exit;
get_header('shop');
if (is_shop()) {
	$shop_page_banner =  get_theme_mod('shop_page_banner');
} else {
	$thumbnail_id = get_term_meta(get_queried_object_id(), 'img', true);
	$shop_page_banner = wp_get_attachment_url($thumbnail_id);
}
?>
<section class="section-page-banner-title section-padding" style="background-image: url('<?php echo $shop_page_banner; ?>'); background-size:cover; background-position: center center;">
	<div class="head-section">
		<div class="title">
			<?php if (is_shop()) {
				echo get_theme_mod('shop_page_title');
			} else {
				woocommerce_page_title();
			} ?>
		</div>
	</div>
</section>
<section class="breadcrumb-section">
	<div class="container">
		<?php /**
		 * Hook: woocommerce_before_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 * @hooked WC_Structured_Data::generate_website_data() - 30
		 */
		do_action('woocommerce_before_main_content');  ?>
	</div>
</section>
<?php if (is_shop()) {
	$taxonomy = 'product_cat';
	$taxonomy_list = get_terms($taxonomy, array('hide_empty' => false, 'parent' => 0, 'exclude' => 15));
?>
	<section class="categories-slide-shop">
		<div class="container">
			<div class="categories-slide-inner">
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php
						if ($taxonomy_list) :
							foreach ($taxonomy_list as $term) {
								$thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
								$term_image = wp_get_attachment_url($thumbnail_id);
						?>
								<div class="swiper-slide">
									<?php if ($thumbnail_id) { ?>
										<img class="category-img" src="<?php echo $term_image; ?>" alt="img" />
									<?php } ?>
									<div class="category-title"><a href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo $term->name; ?></a></div>
								</div>
						<?php }
						endif; ?>
					</div>
					<div class="swiper-pagination"></div>
				</div>
				<div class="swiper-button-next-unique"><i class="fal fa-long-arrow-right"></i></div>
				<div class="swiper-button-prev-unique"><i class="fal fa-long-arrow-left"></i></div>
			</div>
		</div>
	</section>
<?php } ?>
<?php
/**
 * Hook: woocommerce_archive_description.
 *
 * @hooked woocommerce_taxonomy_archive_description - 10
 * @hooked woocommerce_product_archive_description - 10
 */
do_action('woocommerce_archive_description');
?>
<section id="layout-product" class="container-product mt-5 mb-5">
	<div class="container">
		<?php do_action('corsivalab_all_notices'); ?>
		<div class="top-header-woo">
			<div class="filter-left">
				<div class="filter-btn">
					<span>FILTER ( <?php echo wc_get_loop_prop('total'); ?> )</span><img class="dropdown-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/arrow-dropdown-icon.png" />
				</div>
				<div class="filter-inner">
					<div class="filter-title">FILTERS<img class="close-filter" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/close-icon.png" /></div>
					<?php if (is_active_sidebar('widget-sidebar-woocommerce')) {
						dynamic_sidebar('widget-sidebar-woocommerce');
					} ?>
				</div>
			</div>
			<div class="filter-right">
				<?php
				/**
				 * Hook: woocommerce_before_shop_loop.
				 *
				 * @hooked woocommerce_output_all_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action('woocommerce_before_shop_loop'); ?>
			</div>
		</div>
		<?php
		do_action('corsivalab_all_notices');
		if (woocommerce_product_loop()) { ?>
		<?php
			woocommerce_product_loop_start();
			if (wc_get_loop_prop('total')) {
				while (have_posts()) {
					the_post();
					/**
					 * Hook: woocommerce_shop_loop.
					 */
					do_action('woocommerce_shop_loop');
					wc_get_template_part('content', 'product');
				}
			}
			woocommerce_product_loop_end();
			/**
			 * Hook: woocommerce_after_shop_loop.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action('woocommerce_after_shop_loop');
		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action('woocommerce_no_products_found');
		}
		?>
	</div>
</section>
<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');
?>
<?php get_footer('shop');
