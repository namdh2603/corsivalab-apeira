<?php

namespace App\Components;

use TypeRocket\Template\Component;

class RewardForm extends Component
{
	protected $title = 'Reward Form';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->row()
			->withColumn(
				$form->image('img')->setLabel('Banner'),
				$form->text('Title'),
				$form->wpEditor('desc')->setLabel('Description'),
				$form->text('shortcode')->setLabel('Register Form'),
			)
			->withColumn(
				$form->repeater('List')->setFields([
					$form->image('img')->setLabel('Icon'),
					$form->text('Title'),
				]),
			);
	}
	/**
	 * Render
	 *
	 * @var array $data component fields
	 * @var array $info name, data_id, model, first_data, last_data, component_id, hash
	 */
	public function render(array $data, array $info)
	{
?>
		<section class="section-<?php echo $info['component_id']; ?> bg-white section-padding" data-id="<?php echo $info['component_id']; ?>">
			<div class="container">
				<div class="row">
					<div class="col-12 col-sm-5 col-md-5 col-lg-5">
						<img src="<?php echo get_attachment($data['img'])['src']; ?>" class="w-100" alt="img" />
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-6 offset-lg-1">
						<div class="head-section">
							<?php if (!empty($data['title'])) : ?><div class="title"><?php echo $data['title']; ?></div><?php endif; ?>
							<?php if (!empty($data['desc'])) : ?><div class="desc"><?php echo apply_filters('the_content', $data['desc']); ?></div><?php endif; ?>
						</div>

						<div class="reward-icons">
							<div class="row">
								<?php if (!empty($data['list'])) { ?>
									<?php foreach ($data['list'] as $item) { ?>
										<div class="col-4">
											<img src="<?php echo get_attachment($item['img'])['src']; ?>" class="w-100" alt="img" />
											<?php if (!empty($item['title'])) : ?>
												<div class='icons-title'><?php echo $item['title']; ?></div>
											<?php endif; ?>
										</div>
									<?php } ?>
								<?php } ?>
							</div>
						</div>

						<?php if (!empty($data['shortcode'])) : ?><div class="shortcode"><?php echo do_shortcode($data['shortcode']); ?></div><?php endif; ?>


					</div>
				</div>
			</div>
		</section>
<?php
	}
}
