<?php

namespace App\Components;

use TypeRocket\Template\Component;

class Quote extends Component
{
	protected $title = 'Quote';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->wpEditor('desc')->setLabel('Content');
		echo $form->image('img')->setLabel('Author Image');
		echo $form->text('title')->setLabel('Name');
		echo $form->text('sub_title')->setLabel('Sub Name');
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
		<section class="section-<?php echo $info['component_id']; ?> section-padding" data-id="<?php echo $info['component_id']; ?>">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-sm-9 col-md-9 col-lg-9 text-center">
						<?php if (!empty($data['desc'])) : ?><div class="desc"><?php echo apply_filters('the_content', $data['desc']); ?></div><?php endif; ?>
						<img src="<?php echo get_attachment($data['img'])['src']; ?>" class="author-img" />
						<?php if (!empty($data['title'])) : ?><div class="author-name"><?php echo $data['title']; ?></div><?php endif; ?>
						<?php if (!empty($data['sub_title'])) : ?><div class="author-sub"><?php echo $data['sub_title']; ?></div><?php endif; ?>
					</div>

				</div>
			</div>
		</section>
<?php
	}
}
