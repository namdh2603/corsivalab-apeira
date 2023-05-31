<?php
namespace App\Components;
use TypeRocket\Template\Component;
class OurTeam extends Component
{
	protected $title = 'Our Team';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->row()
			->withColumn(
				$form->image('img')->setLabel('Banner'),
				$form->color('bg_color')->setLabel('Section Background Color'),
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
	 * @var array $info name, data_id, model, first_data, last_data, component_id, hash
	 */
	public function render(array $data, array $info)
	{
		$bg_color = $data['bg_color'];
?>
		<section class="section-<?php echo $info['component_id']; ?>" data-id="<?php echo $info['component_id']; ?>" style="<?php echo (!empty($bg_color) ? 'background-color:' . $bg_color . ';' : ''); ?>">
			<div class="container-fluid">
				<div class="row justify-content-center g-0">
					<div class="col-12 col-sm-6 col-md-6 col-lg-6">
					<?php if (!empty($data['img'])) : echo wp_get_attachment_image($data['img'], 'full', "", array( "class" => "w-100" )); endif; ?>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-6 align-self-center">
						<div class="head-section">
							<?php if (!empty($data['sub_title'])) : ?><div class="sub-title"><?php echo $data['sub_title']; ?></div><?php endif; ?>
							<?php if (!empty($data['title'])) : ?><div class="title"><?php echo $data['title']; ?></div><?php endif; ?>
							<?php if (!empty($data['desc'])) : ?><div class="desc"><?php echo apply_filters('the_content', $data['desc']); ?></div><?php endif; ?>
							<?php if (!empty($data['btn_txt'])) : ?>
								<div class="btn-wrap btn-center">
									<a class="btn-main btn-main-v2" href="<?php echo $data['btn_link']; ?>"><?php echo $data['btn_txt']; ?></a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
<?php
	}
}
