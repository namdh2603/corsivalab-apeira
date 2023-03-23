<?php
namespace App\Components;
use TypeRocket\Template\Component;
class Sustainability extends Component
{
	protected $title = 'Sustainability';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->color('bg_color')->setLabel('Section Background Color');
		echo $form->text('sub_title')->setLabel('Sub Title');
		echo $form->text('title')->setLabel('Title');
		echo $form->wpEditor('desc')->setLabel('Description');
		echo $form->search('choose_post')->multiple()->setLabel('Choose Posts')->setPostTypeOptions('post');
	}
	/**
	 * Render
	 *
	 * @var array $data component fields
	 * @var array $info name, item_id, model, first_item, last_item, component_id, hash
	 */
	public function render(array $data, array $info)
	{
		$bg_color = $data['bg_color'];
?>
		<section class="section-<?php echo $info['component_id']; ?> section-padding" data-id="<?php echo $info['component_id']; ?>" style="<?php echo (!empty($bg_color) ? 'background-color:' . $bg_color . ';' : ''); ?>">
			<div class="container">
				<div class="head-section">
					<div class="row">
						<div class="col-12 col-sm-8 col-md-8 col-lg-8 text-start">
							<?php if (!empty($data['sub_title'])) : ?><div class="sub-title"><?php echo $data['sub_title']; ?></div><?php endif; ?>
							<?php if (!empty($data['title'])) : ?><div class="title"><?php echo $data['title']; ?></div><?php endif; ?>
						</div>
					</div>
				</div>
				<div class="posts-carousel">
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php
							foreach ($data['choose_post'] as $item) {
								$post_data   = get_post($item);
								$title = $post_data->post_title;
								$excerpt = wp_trim_words(strip_shortcodes($post_data->post_content), 20, ' ...');
							?>
								<div class="swiper-slide">
									<!-- <div class="post-inner">
										<?php if (has_post_thumbnail($item)) {
											echo get_the_post_thumbnail($item, 'full');
										} else {
											echo wc_placeholder_img();
										} ?>
										<div class="post-information">
											<div class="post-title"><?php echo $title; ?></div>
											<div class="post-excerpt"><?php echo $excerpt; ?></div>
											<div class="btn-wrap btn-left">
												<a class="btn-main btn-outline-v2" href="<?php the_permalink($item); ?>">DISCOVER MORE</a>
											</div>
										</div>
									</div> -->
									<?php get_template_part('template-parts/archive', 'post-item', array('id' => $item, 'col' => 0)); ?>
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="swiper-button-next-unique"><i class="fal fa-long-arrow-right"></i></div>
					<div class="swiper-button-prev-unique"><i class="fal fa-long-arrow-left"></i></div>
				</div>
			</div>
		</section>
<?php
	}
}
