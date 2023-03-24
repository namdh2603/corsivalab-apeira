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
		echo $form->text('shortcode')->setLabel('Instagram Shortcode');
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
		<section class="section-<?php echo $info['component_id']; ?> section-padding pb-0" data-id="<?php echo $info['component_id']; ?>" style="<?php echo (!empty($bg_color) ? 'background-color:' . $bg_color . ';' : ''); ?>">
			<div class="container">
				<div class="row">
					<div class="col-12 col-sm-5 col-md-5 col-lg-5">
						<div class="head-section text-start">
							<?php if (!empty($data['sub_title'])) : ?><div class="sub-title"><?php echo $data['sub_title']; ?></div><?php endif; ?>
							<?php if (!empty($data['title'])) : ?><div class="title"><?php echo $data['title']; ?></div><?php endif; ?>
							<?php if (!empty($data['desc'])) : ?><div class="desc"><?php echo apply_filters('the_content', $data['desc']); ?></div><?php endif; ?>
							<?php echo do_shortcode('[corsivalab-social-icons]'); ?>
							<?php echo do_shortcode($data['shortcode']); ?>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-6 offset-lg-1">
						<?php if (!empty($data['img'])) : ?>
							<img src="<?php echo get_attachment($data['img'])['src']; ?>" class="w-100" alt="img" />
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
<?php
	}
}
