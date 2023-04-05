<?php

namespace App\Components;

use TypeRocket\Template\Component;

class Gap extends Component
{
	protected $title = 'Gap';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->input('gap_number')->setTypeNumber()->setLabel('Gap Pixel');
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
		<?php if (!empty($data['gap_number'])) : ?>
			<section class="section-<?php echo $info['component_id']; ?>" data-id="<?php echo $info['component_id']; ?>" style="<?php echo (!empty($data['gap_number']) ? 'min-height:' . floatval($data['gap_number'] / 10) . 'rem;' : ''); ?>">
			</section>
		<?php endif; ?>
<?php
	}
}
