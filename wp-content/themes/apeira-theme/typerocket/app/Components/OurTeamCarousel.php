<?php
namespace App\Components;
use TypeRocket\Template\Component;
class OurTeamCarousel extends Component
{
	protected $title = 'Our Team Carousel';
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
					$form->image('img')->setLabel('Author Image'),
				)
				->withColumn(
					$form->text('title')->setLabel('Name'),
					$form->text('sub_title')->setLabel('Sub Name'),
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
		// $bg_color = $data['bg_color'];
?>
		<section class="section-<?php echo $info['component_id']; ?> section-padding pt-0" data-id="<?php echo $info['component_id']; ?>" style="<?php echo (!empty($bg_color) ? 'background-color:' . $bg_color . ';' : ''); ?>">
			<div class="container">
				<div class="head-section">
					<div class="row justify-content-center">
						<div class="col-12 col-sm-8 col-md-8 col-lg-8">
							<?php if (!empty($data['sub_title'])) : ?><div class="sub-title"><?php echo $data['sub_title']; ?></div><?php endif; ?>
							<?php if (!empty($data['title'])) : ?><div class="title"><?php echo $data['title']; ?></div><?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid">
			<div class="ourteam-carousel">
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php
						if (!empty($data['list'])) :
							foreach ($data['list'] as $item) {
						?>
								<div class="swiper-slide text-center">
									<img src="<?php echo get_attachment($item['img'])['src']; ?>" class="w-100" alt="img" />
									<?php if (!empty($item['title'])) : ?><div class="author-name"><?php echo $item['title']; ?></div><?php endif; ?>
									<?php if (!empty($item['sub_title'])) : ?><div class="author-sub"><?php echo $item['sub_title']; ?></div><?php endif; ?>
								</div>
						<?php }
						endif; ?>
					</div>
				</div>
			</div>
			</div>
		</section>
<?php
	}
}
