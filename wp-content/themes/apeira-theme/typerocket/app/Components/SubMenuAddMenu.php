<?php
namespace App\Components;
use TypeRocket\Template\Component;
class SubMenuAddMenu extends Component
{
	protected $title = 'SubMenu Add Menu';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->text('title')->setLabel('Menu Title');
		echo $form->repeater('List')->setFields([
			$form->text('btn_txt')->setLabel('Text'),
			$form->text('btn_link')->setLabel('Link')->setDefault('#'),
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

<div class="col-12 col-sm-2 col-md-2 col-lg-2 <?php echo $info['hash']; ?>" data-id="<?php echo $info['component_id']; ?>">
	<?php if (!empty($data['title'])) : ?>
    <h4 class="title-sub-block text-uppercase"><?php echo $data['title']; ?></h4>
	<?php endif; ?>
	<?php if (!empty($data['list'])) : ?>
	<ul>
		<?php foreach ($data['list'] as $item) { ?>
		<?php if (!empty($item['btn_txt'])) : ?>
        <li><a href="<?php echo $item['btn_link']; ?>"><?php echo $item['btn_txt']; ?></a></li>
												<?php endif; ?>
		<?php } ?>
  
    </ul>
		<?php endif; ?>
</div>



<?php
	}
}