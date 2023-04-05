<?php
namespace App\Components;
use TypeRocket\Template\Component;
class AboutUsImageTabs extends Component
{
	protected $title = 'About Us Image Tabs';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->repeater('List')->setFields([
			$form->row()
				->withColumn(
					$form->image('img')->setLabel('Image Tab'),
					$form->text('img_title')->setLabel('Image Title Tab'),
				)
				->withColumn(
					$form->text('title')->setLabel('Title'),
					$form->text('sub_title')->setLabel('Sub Title'),
					$form->wpEditor('desc')->setLabel('Description'),
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
		<section class="section-<?php echo $info['component_id']; ?>" data-id="<?php echo $info['component_id']; ?>" style="">
			<div class="nav nav-pills" id="pills-tab" role="tabsize">
				<div class="row">
					<?php if (!empty($data['list'])) {
						$i = 0; ?>
						<?php foreach ($data['list'] as $item) {
							$i++; ?>
							<div class="nav-item col-4" role="presentation">
								<div class="nav-link <?php echo ($i == 1) ? 'active' : ''; ?>" id="pills-<?php echo $info['component_id'] . $i; ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-<?php echo $info['component_id'] . $i; ?>">
									<img src="<?php echo get_attachment($item['img'])['src']; ?>" />
									<div class="tab-title">
										<?php echo $item['img_title']; ?>
									</div>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
		</div>
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-sm-8 col-md-8 col-lg-8">
						<div class="tab-content" id="pills-tabContent">
							<?php if (!empty($data['list'])) {
								$ic = 0; ?>
								<?php foreach ($data['list'] as $item) {
									$ic++; ?>
									<div class="tab-pane fade <?php echo ($ic == 1) ? 'show active' : ''; ?>" id="pills-<?php echo $info['component_id'] . $ic; ?>" role="tabpanel" tabindex="0">
										<?php if (!empty($item['title'])) : ?><div class="tab-content-title"><?php echo $item['title']; ?></div><?php endif; ?>
										<?php if (!empty($item['sub_title'])) : ?><div class="tab-content-subtitle"><?php echo $item['sub_title']; ?></div><?php endif; ?>
										<?php if (!empty($item['desc'])) : ?><div class="desc"><?php echo apply_filters('the_content', $item['desc']); ?></div><?php endif; ?>
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
