<?php
namespace App\Components;
use TypeRocket\Template\Component;
class SubMenuFeature extends Component
{
	protected $title = 'SubMenu Feature';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->image('img')->setLabel('Image');
		echo $form->text('title')->setLabel('Title');
		echo $form->wpEditor('desc')->setLabel('Description');
		echo $form->text('btn_link')->setLabel('Link Button')->setDefault('#');
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

<div class="col-3 text-start <?php echo $info['hash']; ?>" data-id="<?php echo $info['component_id']; ?>">
	<a class="" href="<?php echo $data['btn_link']; ?>">
		
		<div class="sub-img"><?php if (!empty($data['img'])) : echo wp_get_attachment_image($data['img'], 'full', "", array( "class" => "w-100" )); endif; ?></div>
                        
		<?php if (!empty($data['title'])) : ?><div class="sub-title"><?php echo $data['title']; ?></div><?php endif; ?>
		<?php if (!empty($data['desc'])) : ?><div class="sub-desc"><?php echo $data['desc']; ?></div><?php endif; ?>
             
	</a>

</div>



<?php
	}
}