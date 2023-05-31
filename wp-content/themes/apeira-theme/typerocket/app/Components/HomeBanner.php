<?php

namespace App\Components;

use TypeRocket\Template\Component;

class HomeBanner extends Component
{
	protected $title = 'Home Banner';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->row()
			->withColumn(
				$form->image('img')->setLabel('Banner'),
			)
			->withColumn(
				$form->text('sub_title')->setLabel('Sub Title'),
				$form->text('Title'),
				$form->wpEditor('desc')->setLabel('Description'),
				$form->text('btn_txt')->setLabel('Text Button'),
				$form->text('btn_link')->setLabel('Link Button')->setDefault('#'),
			);
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
		<section class="section-<?php echo $info['component_id']; ?>" data-id="<?php echo $info['component_id']; ?>">
			<div class="container-fluid">
				<div class="banner-inner" style="background-image: url('<?php echo (!empty($data['img']))?wp_get_attachment_image_url($data['img'], 'full'):""; ?>'); background-position: center center; background-repeat: no-repeat;">
					<?php if (!empty($data['img'])) : echo wp_get_attachment_image($data['img'], 'full', "", array( "class" => "w-100" )); endif; ?>
					<div class="caption">
						<div class="row">
							<div class="mx-auto">
								<div class="block-content">
									<?php if (!empty($data['sub_title'])) : ?><div class="sub-title"><?php echo $data['sub_title']; ?></div><?php endif; ?>
									<?php if (!empty($data['title'])) : ?><div class="title"><?php echo $data['title']; ?></div><?php endif; ?>
									<?php if (!empty($data['desc'])) : ?><div class="desc"><?php echo apply_filters( 'the_content', $data['desc'] ); ?></div><?php endif; ?>
									<?php if (!empty($data['btn_txt'])) : ?>
										<div class="btn-wrap">
											<a class="btn-main" href="<?php echo $data['btn_link']; ?>"><?php echo $data['btn_txt']; ?></a>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
<?php
	}
}
