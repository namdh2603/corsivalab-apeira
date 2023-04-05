<?php

namespace App\Components;

use TypeRocket\Template\Component;

class PageBannerTitle extends Component
{
	protected $title = 'Page Banner Title';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->image('img')->setLabel('Banner');
		echo $form->text('title')->setLabel('Title'); 
		echo $form->color('bg_color')->setLabel('Breadcrumb BG Color');
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
		<?php if (!empty($data['img'])) : ?>
			<section class="section-<?php echo $info['component_id']; ?> section-padding" data-id="<?php echo $info['component_id']; ?>" style="background-image: url('<?php echo get_attachment($data['img'])['src']; ?>'); background-size:cover; background-position: center center;">
				<div class="head-section">
					<?php if (!empty($data['title'])) : ?><div class="title"><?php echo $data['title']; ?></div><?php endif; ?>
				</div>
			</section>
		<?php endif; ?>
		<section class="breadcrumb-section" style="<?php echo (!empty($data['bg_color']) ? 'background-color:' . $data['bg_color'] . ';' : ''); ?>">
			<div class="container">
				<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
					<?php if (function_exists('bcn_display')) {
						bcn_display();
					} ?>
				</div>
			</div>
		</section>
<?php
	}
}
