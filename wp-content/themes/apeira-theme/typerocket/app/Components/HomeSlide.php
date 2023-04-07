<?php
namespace App\Components;
use TypeRocket\Template\Component;
class HomeSlide extends Component
{
	protected $title = 'Home Slide';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->repeater('List')->setFields([
			$form->row()
				->withColumn(
					$form->image('img')->setLabel('Banner'),
				)
				->withColumn(
					$form->text('Title'),
					$form->textarea('Description'),
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
		<section class="section-banner-slide slide-<?php echo $info['hash']; ?>" data-id="<?php echo $info['component_id']; ?>">
			<div class="banner-slide-container">
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php
						if (!empty($data['list'])) :
						foreach ($data['list'] as $item) {
						?>
							<div class="swiper-slide">
								<img src="<?php echo get_attachment($item['img'])['src']; ?>" class="w-100" alt="img" />
								<div class="swiper-caption">
									<div class="row">
										<div class="col-12 col-lg-4 mx-auto">
											<div class="block-content">
												<div class="title text-center"><?php echo $item['title']; ?></div>
												<div class="description text-center">
													<?php echo $item['description']; ?>
												</div>
												<?php if (!empty($item['btn_txt'])) : ?>
													<div class="btn-wrap btn-center">
														<a class="btn-main" href="<?php echo $item['btn_link']; ?>"><?php echo $item['btn_txt']; ?></a>
													</div>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php } 
						endif; ?>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			</div>
		</section>
<?php
	}
}
