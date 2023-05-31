<?php

namespace App\Components;

use TypeRocket\Template\Component;

class OurPromise extends Component
{
	protected $title = 'Our Promise';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->row()
			->withColumn(
				$form->text('sub_title')->setLabel('Sub Title'),
				$form->text('title')->setLabel('Title'),
				$form->wpEditor('desc')->setLabel('Description'),
			)
			->withColumn(
				$form->repeater('List')->setFields([
					$form->image('img')->setLabel('Image'),
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
		// $bg_color = $data['bg_color'];
?>
		<section class="section-<?php echo $info['component_id']; ?> section-padding pt-0" data-id="<?php echo $info['component_id']; ?>" style="<?php echo (!empty($bg_color) ? 'background-color:' . $bg_color . ';' : ''); ?>">
			<div class="container">
				<div class="head-section">
					<div class="row">
						<div class="col-12 col-sm-6 col-md-6 col-lg-6 text-start">
							<?php if (!empty($data['sub_title'])) : ?><div class="sub-title"><?php echo $data['sub_title']; ?></div><?php endif; ?>
							<?php if (!empty($data['title'])) : ?><div class="title"><?php echo $data['title']; ?></div><?php endif; ?>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-6 text-start">
							<?php if (!empty($data['desc'])) : ?><div class="desc"><?php echo apply_filters('the_content', $data['desc']); ?></div><?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div class="ourpromise-grid">
					<div class="row g-0">
						<?php
						if (!empty($data['list'])) :
							$i = 0;
							foreach ($data['list'] as $item) {
								$i++;
								if ($i == 4) {
									echo '<div class="col-12 col-sm-6 col-md-6 col-lg-6">';
								} else {
									echo '<div class="col-12 col-sm-2 col-md-2 col-lg-2">';
								}
						?>
								<div class="ourpromise-item">
					<?php if (!empty($item['img'])) : echo wp_get_attachment_image($item['img'], 'full', "", array( "class" => "w-100 h-100" )); endif; ?>
								</div>
						<?php
								echo '</div>';
							}
						endif; ?>
					</div>
				</div>
			</div>
			
		</section>
<?php
	}
}
