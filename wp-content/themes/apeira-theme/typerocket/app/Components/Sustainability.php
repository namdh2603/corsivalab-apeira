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
		echo $form->search('choose_post')->multiple()->setLabel('Choose Posts')->setPostTypeOptions('sustainability');
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
		$args = array(
			'post_type' => 'sustainability',
			'post__in' => $data['choose_post'],
		);
		$p_query = new \WP_Query($args);
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
					<?php if ($p_query->have_posts()) { ?>
						<div class="swiper">
							<div class="swiper-wrapper">
								<?php while ($p_query->have_posts()) {
									$p_query->the_post();
								?>
									<div class="swiper-slide">
										<?php get_template_part('template-parts/archive', 'post-item', array('col' => 0)); ?>
									</div>
								<?php } ?>
							</div>
						</div>
					<div class="swiper-button-next-unique">
<!-- 						<i class="fal fa-long-arrow-right"></i> -->
						<i class="fa fa-long-arrow-right"></i>
					</div>
					<div class="swiper-button-prev-unique">
<!-- 						<i class="fal fa-long-arrow-left"></i> -->
						<i class="fa fa-long-arrow-left"></i>
					</div>
					<?php	} ?>
				</div>
			</div>
		</section>
<?php
	}
}