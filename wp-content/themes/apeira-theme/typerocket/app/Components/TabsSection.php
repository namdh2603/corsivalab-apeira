<?php
namespace App\Components;
use TypeRocket\Template\Component;
class TabsSection extends Component
{
	protected $title = 'Tabs Section';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->text('sub_title')->setLabel('Sub Title');
		echo $form->text('title')->setLabel('Title');
		echo $form->wpEditor('desc')->setLabel('Description');
		echo $form->repeater('List')->setLabel('List Tabs')->setFields([
			$form->text('title')->setLabel('Tab Title'),
			$form->wpEditor('desc')->setLabel('Tab Content')->setSetting('options', ['teeny' => false, 'tinymce' => true, 'editor_height' => 400]),
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
		<section class="section-<?php echo $info['component_id']; ?>" data-id="<?php echo $info['component_id']; ?>">
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
				<div class="tabs-section">
					<div class="row justify-content-center">
						<div class="col-12 col-sm-10 col-md-10 col-lg-10">
							<ul class="nav nav-pills" id="pills-tab" role="tabsize">
								<?php if (!empty($data['list'])) {
									$i = 0; ?>
									<?php foreach ($data['list'] as $item) {
										$i++; ?>
										<li class="nav-item" role="presentation">
											<div class="nav-link <?php echo ($i == 1) ? 'active' : ''; ?>" id="pills-<?php echo $i; ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-<?php echo $i; ?>" type="button" role="tab" aria-controls="pills-<?php echo $i; ?>" aria-selected="true"><?php echo $item['title']; ?></button>
										</li>
									<?php } ?>
								<?php } ?>
							</ul>
							<div class="tab-content" id="pills-tabContent">
								<?php if (!empty($data['list'])) {
									$ic = 0; ?>
									<?php foreach ($data['list'] as $item) {
										$ic++; ?>
										<div class="tab-pane fade <?php echo ($ic == 1) ? 'show active' : ''; ?>" id="pills-<?php echo $ic; ?>" role="tabpanel" aria-labelledby="pills-<?php echo $ic; ?>-tab" tabindex="0">
											<?php if (!empty($item['desc'])) : ?><div class="desc"><?php echo apply_filters('the_content', $item['desc']); ?></div><?php endif; ?>
										</div>
									<?php } ?>
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
