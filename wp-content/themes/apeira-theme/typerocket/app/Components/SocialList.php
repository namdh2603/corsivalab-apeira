<?php
namespace App\Components;
use TypeRocket\Template\Component;
class SocialList extends Component
{
	protected $title = 'Social List';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->repeater('List')->setFields([
			$form->image('img')->setLabel('Icon'),
			$form->text('btn_link')->setLabel('Link Button')->setDefault('#'),
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
			<?php if (!empty($data['list'])) {
				echo '<div class="social-footer-section d-flex align-items-center"><ul class="social-list">';
				foreach ($data['list'] as $item) {
					echo '<li><a href="' . $item['btn_link'] . '">' . wp_get_attachment_image($item['img'], 'full') . '</a></li>';
				}
				echo '</ul></div>';
			} ?>
		</section>
<?php
	}
}
