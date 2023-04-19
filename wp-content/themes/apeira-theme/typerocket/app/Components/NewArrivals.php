<?php
namespace App\Components;
use TypeRocket\Template\Component;
class NewArrivals extends Component
{
	protected $title = 'New Arrivals';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->text('sub_title')->setLabel('Sub Title');
		echo $form->text('title')->setLabel('Title');
		echo $form->wpEditor('desc')->setLabel('Description');
		echo $form->search('choose_product_cat')->multiple()->setLabel('Choose Categories')->setTaxonomyOptions('product_cat');
		echo $form->text('btn_txt')->setLabel('Text Button');
		echo $form->text('btn_link')->setLabel('Link Button')->setDefault('#');
	}
	/**
	 * Render
	 *
	 * @var array $data component fields
	 * @var array $info name, item_id, model, first_item, last_item, component_id, hash
	 */
	public function render(array $data, array $info)
	{
		$choose_product_cat = $data['choose_product_cat'];
?>
		<section class="section-<?php echo $info['component_id']; ?> section-padding bg-white" data-id="<?php echo $info['component_id']; ?>">
			<div class="container">
				<div class="head-section">
					<div class="row justify-content-center">
						<div class="col-12 col-sm-8 col-md-8 col-lg-8">
							<?php if (!empty($data['sub_title'])) : ?><div class="sub-title"><?php echo $data['sub_title']; ?></div><?php endif; ?>
							<?php if (!empty($data['title'])) : ?><div class="title"><?php echo $data['title']; ?></div><?php endif; ?>
							<?php if (!empty($data['desc'])) : ?><div class="desc"><?php echo $data['desc']; ?></div><?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div class="products-list tabs-section">
					<ul class="nav nav-pills" id="pills-tab" role="tabsize">
						<?php if (!empty($choose_product_cat)) {
							$i = 0; ?>
							<?php foreach ($choose_product_cat as $item) {
								$term_id = $item;
								$i++; ?>
								<li class="nav-item" role="presentation">
									<div class="nav-link <?php echo ($i == 1) ? 'active' : ''; ?>" id="pills-<?php echo $i; ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-<?php echo $i; ?>" type="button" role="tab" aria-controls="pills-<?php echo $i; ?>" aria-selected="true"><?php echo get_term($term_id)->name; ?></button>
								</li>
							<?php } ?>
						<?php } ?>
					</ul>
					<div class="tab-content woocommerce" id="pills-tabContent">
						<?php if (!empty($choose_product_cat)) {
							$ic = 0; ?>
							<?php foreach ($choose_product_cat as $item) {
								$ic++;
								$term_id = $item;
								$args = array(
									'post_type'             => 'product',
									'post_status'           => 'publish',
									'ignore_sticky_posts'   => 1,
									'posts_per_page'        => -1,
									'tax_query'             => array(
										array(
											'taxonomy'      => 'product_cat',
											'field' => 'term_id',
											'terms'         => $term_id,
										),
									),
								);
								$products = new \WP_Query($args);
								$num = $products->found_posts;
							?>
								<div class="tab-pane fade <?php echo ($ic == 1) ? 'show active' : ''; ?>" id="pills-<?php echo $ic; ?>" role="tabpanel" aria-labelledby="pills-<?php echo $ic; ?>-tab" tabindex="0">
									<?php
								if($num <= 4){
									woocommerce_product_loop_start();
									if ($products->have_posts()) {
										while ($products->have_posts()) {
											$products->the_post();
											// global $product;
											wc_get_template_part('content', 'product');
										}
									}
									woocommerce_product_loop_end();
								} else { ?>
									
				<div class="products-carousel">
					<div class="swiper">
						<div class="swiper-wrapper">
									<?php if ($products->have_posts()) {
										while ($products->have_posts()) {
											$products->the_post();
											// global $product;
											echo '<div class="swiper-slide">';
											wc_get_template_part('content', 'product-slide');
											echo '</div>';
										}
									} ?>
						</div>
									</div>
							
					<div class="swiper-button-next-unique"><i class="fal fa-long-arrow-right"></i></div>
					<div class="swiper-button-prev-unique"><i class="fal fa-long-arrow-left"></i></div>
					</div>
								<?php }
									?>
								</div>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
				<?php if (!empty($data['btn_txt'])) : ?>
					<div class="btn-wrap btn-center">
						<a class="btn-main btn-main-v2" href="<?php echo $data['btn_link']; ?>"><?php echo $data['btn_txt']; ?></a>
					</div>
				<?php endif; ?>
			</div>
		</section>
<?php
	}
}
