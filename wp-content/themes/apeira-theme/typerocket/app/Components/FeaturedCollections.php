<?php
namespace App\Components;
use TypeRocket\Template\Component;
class FeaturedCollections extends Component
{
	protected $title = 'Featured Collections';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->text('sub_title')->setLabel('Sub Title');
		echo $form->text('title')->setLabel('Title');
		echo $form->wpEditor('desc')->setLabel('Description');
		echo $form->repeater('List')->setLimit(3)->setFields([
			$form->row()
				->withColumn(
					$form->image('img')->setLabel('Banner'),
				)
				->withColumn(
					$form->text('Title'),
					$form->wpEditor('desc')->setLabel('Description'),
					$form->text('btn_txt')->setLabel('Text Button'),
					$form->text('btn_link')->setLabel('Link Button')->setDefault('#'),
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
?>
		<section class="section-<?php echo $info['component_id']; ?> section-padding pb-0" data-id="<?php echo $info['component_id']; ?>">
			<div class="container-fluid">
				<div class="head-section">
					<div class="row justify-content-center">
						<div class="col-12 col-sm-8 col-md-8 col-lg-8">
							<?php if (!empty($data['sub_title'])) : ?><div class="sub-title"><?php echo $data['sub_title']; ?></div><?php endif; ?>
							<?php if (!empty($data['title'])) : ?><div class="title"><?php echo $data['title']; ?></div><?php endif; ?>
							<?php if (!empty($data['desc'])) : ?><div class="desc"><?php echo apply_filters('the_content', $data['desc']); ?></div><?php endif; ?>
						</div>
					</div>
				</div>
				<div class="row g-0">
					<?php
					$i = 0;
					$col = 6;
					foreach ($data['list'] as $item) {
						$i++;
						$extra_class = '';
						if ($i >= 3) $col = 12;
						$extra_class = "last";
					?>
						<div class="col-12 col-sm-<?php echo $col; ?> col-md-<?php echo $col; ?> col-lg-<?php echo $col; ?>">
							<div class="featured-item <?php echo $extra_class; ?>">
								<img src="<?php echo get_attachment($item['img'])['src']; ?>" class="w-100" alt="img" />
								<div class="caption">
									<div class="block-content">
										<?php if (!empty($item['title'])) : ?><div class="title"><?php echo $item['title']; ?></div><?php endif; ?>
										<?php if (!empty($item['desc'])) : ?><div class="desc"><?php echo apply_filters('the_content', $item['desc']); ?></div><?php endif; ?>
										<?php if (!empty($item['btn_txt'])) : ?>
											<div class="btn-wrap">
												<a class="btn-main btn-outline" href="<?php echo $item['btn_link']; ?>"><?php echo $item['btn_txt']; ?></a>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</section>
<?php
	}
}
