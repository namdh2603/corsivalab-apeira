<?php

namespace App\Components;

use TypeRocket\Template\Component;

class ContactUs extends Component
{
	protected $title = 'Contact Us';
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

		echo $form->repeater('List')->setFields([
			$form->image('social_img')->setLabel('Icon Social'),
			$form->text('social_link')->setLabel('Link Social')->setDefault('#'),
		]);



		echo $form->text('shortcode')->setLabel('Contact Shortcode');
		echo $form->image('img')->setLabel('Banner');
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
		<section class="section-<?php echo $info['component_id']; ?>" data-id="<?php echo $info['component_id']; ?>" style="<?php echo (!empty($bg_color) ? 'background-color:' . $bg_color . ';' : ''); ?>;background-image: url('<?php echo (!empty($data['img']))?wp_get_attachment_image_url($data['img'], 'full'):""; ?>');">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-md-5">
						<?php if (!empty($data['img'])) : ?>
							<div class="img-full">
								<?php echo wp_get_attachment_image($data['img'], 'full', "", array( "class" => "w-100" )); ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-5 offset-lg-1">
						<div class="head-section text-start">
							<?php if (!empty($data['sub_title'])) : ?><div class="sub-title"><?php echo $data['sub_title']; ?></div><?php endif; ?>
							<?php if (!empty($data['title'])) : ?><div class="title"><?php echo $data['title']; ?></div><?php endif; ?>
							<?php if (!empty($data['desc'])) : ?><div class="desc"><?php echo apply_filters('the_content', $data['desc']); ?></div><?php endif; ?>

							<?php if (!empty($data['list'])) {
								echo '<div class="social-footer-section d-flex align-items-center"><ul class="social-list">';
								foreach ($data['list'] as $item) {
									echo '<li><a href="' . $item['social_link'] . '">'.wp_get_attachment_image($item['social_img'], 'thumbnail' ).'</a></li>';
								}
								echo '</ul></div>';
							} ?>
							<?php echo do_shortcode($data['shortcode']); ?>
						</div>
					</div>
					
				</div>
			</div>
		</section>
<?php
	}
}
