<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */
if (!defined('ABSPATH')) {
	exit;
}
?>
<form class="woocommerce-ordering" method="get">
	<!-- <select name="orderby" class="orderby" aria-label="<?php esc_attr_e('Shop order', 'woocommerce'); ?>">
		<?php foreach ($catalog_orderby_options as $id => $name) : ?>
			<option value="<?php echo esc_attr($id); ?>" <?php selected($orderby, $id); ?>><?php echo esc_html($name); ?></option>
		<?php endforeach; ?>
	</select> -->



	<div class="dropdown">
		<div class="dropdown-toggle" data-bs-toggle="dropdown">SORT BY <img class="dropdown-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/arrow-dropdown-icon.png" /></div>
		<ul class="dropdown-menu dropdown-menu-end">

		<?php foreach ($catalog_orderby_options as $id => $name) : ?>
			<li><a class="dropdown-item" href="?orderby=<?php echo esc_attr($id); ?>"><?php echo esc_html($name); ?></a></li>
		<?php endforeach; ?>


			<?php
			// foreach ($page_arr as $page_item) {
			// 	echo '<li><a href="' . esc_url(get_page_link($page_item)) . '" class="dropdown-item text-white">' . the_title_trim(get_the_title($page_item)) . '</a></li>';
			// }
			?>
		</ul>
	</div>




	<input type="hidden" name="paged" value="1" />
	<?php wc_query_string_form_fields(null, array('orderby', 'submit', 'paged', 'product-page')); ?>
</form>