<?php

namespace App\Components;

use TypeRocket\Template\Component;

class TitleWithShortcode extends Component
{
	protected $title = 'Title With Shortcode';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		// echo $form->color('bg_color')->setLabel('Section Background Color');
		echo $form->text('sub_title')->setLabel('Sub Title');
		echo $form->text('title')->setLabel('Title');
		echo $form->wpEditor('desc')->setLabel('Description');
		echo $form->text('shortcode')->setLabel('Search Shortcode');
	}
	/**
	 * Render
	 *
	 * @var array $data component fields
	 * @var array $info name, item_id, model, first_item, last_item, component_id, hash
	 */
	public function render(array $data, array $info)
	{
		// $bg_color = $data['bg_color'];
?>
		<section class="section-<?php echo $info['component_id']; ?> section-padding pt-0" data-id="<?php echo $info['component_id']; ?>" style="<?php //echo (!empty($bg_color) ? 'background-color:' . $bg_color . ';' : ''); 
																																	?>">
			<div class="container">
				<div class="head-section">
					<div class="row justify-content-center">
						<div class="col-12 col-sm-8 col-md-8 col-lg-8 text-center">
							<?php if (!empty($data['sub_title'])) : ?><div class="sub-title"><?php echo $data['sub_title']; ?></div><?php endif; ?>
							<?php if (!empty($data['title'])) : ?><div class="title"><?php echo $data['title']; ?></div><?php endif; ?>
							<?php if (!empty($data['desc'])) : ?><div class="desc"><?php echo apply_filters('the_content', $data['desc']); ?></div><?php endif; ?>
						</div>
					</div>
				</div>
			</div>

			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-sm-8 col-md-8 col-lg-8">
						<?php echo do_shortcode($data['shortcode']); ?>
					</div>
				</div>
			</div>
		</section>
<?php
	}
}
