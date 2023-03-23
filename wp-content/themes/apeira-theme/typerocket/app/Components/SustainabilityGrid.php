<?php

namespace App\Components;

use TypeRocket\Template\Component;

class SustainabilityGrid extends Component
{
	protected $title = 'Sustainability Grid';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->text('title')->setLabel('Title');
	}
	/**
	 * Render
	 *
	 * @var array $data component fields
	 * @var array $info name, item_id, model, first_item, last_item, component_id, hash
	 */
	public function render(array $data, array $info)
	{
		$bg_color = $data['bg_color'];
?>
		<section class="section-<?php echo $info['component_id']; ?> section-padding" data-id="<?php echo $info['component_id']; ?>" style="<?php echo (!empty($bg_color) ? 'background-color:' . $bg_color . ';' : ''); ?>">
			<div class="container">
				<!-- <div class="head-section">
					<div class="row">
						<div class="col-12 col-sm-8 col-md-8 col-lg-8 text-start">
							<?php if (!empty($data['sub_title'])) : ?><div class="sub-title"><?php echo $data['sub_title']; ?></div><?php endif; ?>
							<?php if (!empty($data['title'])) : ?><div class="title"><?php echo $data['title']; ?></div><?php endif; ?>
						</div>
					</div>
				</div> -->
				<div class="posts-grid">

					<div class="row">
						<?php
						$args = array('post_type' => 'sustainability', 'posts_per_page' => -1, 'post_status' => 'publish');
						$getposts = new \WP_Query($args);
						while ($getposts->have_posts()) : $getposts->the_post();

							get_template_part('template-parts/archive', 'post-item', array('col' => 3));

						endwhile;
						wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
		</section>
<?php
	}
}
