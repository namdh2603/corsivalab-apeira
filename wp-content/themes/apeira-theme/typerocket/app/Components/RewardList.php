<?php

namespace App\Components;

use TypeRocket\Template\Component;

class RewardList extends Component
{
	protected $title = 'Reward List';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->text('sub_title')->setLabel('Sub Title');
		echo $form->text('title')->setLabel('Title');
		echo $form->wpEditor('desc')->setLabel('Description');
		echo $form->repeater('List')->setFields([
			$form->row()
				->withColumn(
					$form->image('img')->setLabel('Icon'),
				)
				->withColumn(
					$form->text('Title'),
					$form->input('point')->setTypeNumber()->setLabel('Points'),
					// $form->text('btn_txt')->setLabel('Text Button'),
					// $form->text('btn_link')->setLabel('Link Button')->setDefault('#'),
				),
		]);
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
		<section class="section-<?php echo $info['component_id']; ?> section-padding" data-id="<?php echo $info['component_id']; ?>">
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
				<div class="reward-list">
					<div class="row justify-content-center">
						<?php if (!empty($data['list'])) { ?>
							<?php foreach ($data['list'] as $item) { ?>
								<div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 reward-item">
									<img src="<?php echo get_attachment($item['img'])['src']; ?>" class="w-100" alt="img" />
									<?php if (!empty($item['title'])) : ?>
										<div class='icons-title'><?php echo $item['title']; ?></div>
									<?php endif; ?>
									<?php if (!empty($item['point'])) : ?>
										<div class='icons-point'><?php echo $item['point']; ?> points</div>
									<?php endif; ?>
									<div class="btn-wrap btn-center">
										<a class="btn-main btn-outline-v2" href="#">COMPLETE</a>
									</div>
								</div>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>
<?php
	}
}
