<?php

namespace App\Components;

use TypeRocket\Template\Component;

class LoveUs extends Component
{
	protected $title = 'Love Us';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->color('bg_color')->setLabel('Section Background Color');
		echo $form->text('title')->setLabel('Title');
		echo $form->wpEditor('desc')->setLabel('Description');
		echo $form->repeater('List')->setFields([
			$form->row()
				->withColumn(
					$form->image('img')->setLabel('Icon'),
				)
				->withColumn(
					$form->text('Title'),
					$form->text('desc')->setLabel('Description'),
				),
		]);
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
					<div class="row justify-content-center">
						<div class="col-12 col-sm-8 col-md-8 col-lg-8">
							<?php if (!empty($data['title'])) : ?><div class="title"><?php echo $data['title']; ?></div><?php endif; ?>
							<?php if (!empty($data['desc'])) : ?><div class="desc"><?php echo apply_filters('the_content', $data['desc']); ?></div><?php endif; ?>
						</div>
					</div>
				</div>
				<div class="loveus">
					<div class="row justify-content-center">
						<div class="col-12 col-sm-9 col-md-9 col-lg-9">
							<div class="row">
								<?php
								foreach ($data['list'] as $item) {
								?>
									<div class="col-12 col-sm-6 col-md-6 col-lg-3">
										<div class="loveus-item">
											<?php if (!empty($item['img'])) : echo wp_get_attachment_image($item['img'], 'medium', "", array( "class" => "w-100" )); endif; ?>
											<?php if (!empty($item['title'])) : ?><div class="loveus-item-title"><?php echo $item['title']; ?></div><?php endif; ?>
											<?php if (!empty($item['desc'])) : ?><div class="desc"><?php echo apply_filters('the_content', $item['desc']); ?></div><?php endif; ?>

										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
<?php
	}
}
