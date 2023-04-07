<?php

namespace App\Components;

use TypeRocket\Template\Component;

class FAQ extends Component
{
	protected $title = 'FAQ';
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
			$form->text('Title'),
			$form->wpEditor('desc')->setLabel('Description'),
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
		$bg_color = $data['bg_color'];
?>
		<section class="section-<?php echo $info['component_id']; ?> section-padding" data-id="<?php echo $info['component_id']; ?>" style="<?php echo (!empty($bg_color) ? 'background-color:' . $bg_color . ';' : ''); ?>">
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

						<div class="accordion" id="accordionFAQ">
							<?php if (!empty($data['list'])) {
								$i = 0; ?>
								<?php foreach ($data['list'] as $item) {
									$i++; ?>
									<div class="accordion-item">
										<div class="accordion-button <?php echo ($i==1)?'':'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-faq-<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse-faq-<?php echo $i; ?>"><?php echo $item['title']; ?></div>
										<div id="collapse-faq-<?php echo $i; ?>" class="accordion-collapse collapse <?php echo ($i == 1 ? 'show' : ''); ?>" data-bs-parent="#accordionFAQ">
											<div class="accordion-body"><?php echo $item['desc']; ?></div>
										</div>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
				</div>

			</div>
		</section>
<?php
	}
}
