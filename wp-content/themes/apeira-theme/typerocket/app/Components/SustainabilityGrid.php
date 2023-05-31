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
		echo $form->text('sub_title')->setLabel('Sub Title');
		echo $form->text('title')->setLabel('Title');
		echo $form->wpEditor('desc')->setLabel('Description');
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
		<section class="section-<?php echo $info['component_id']; ?> section-padding section-blog" data-id="<?php echo $info['component_id']; ?>" style="<?php //echo (!empty($bg_color) ? 'background-color:' . $bg_color . ';' : ''); 
																																							?>">
			<div class="container">
				<div class="head-section sustainability-head-title">
					<div class="row justify-content-center">
						<div class="col-12 col-sm-8 col-md-8 col-lg-8 text-center">
							<?php if (!empty($data['sub_title'])) : ?><div class="sub-title"><?php echo $data['sub_title']; ?></div><?php endif; ?>
							<?php if (!empty($data['title'])) : ?><div class="title"><?php echo $data['title']; ?></div><?php endif; ?>
							<?php if (!empty($data['desc'])) : ?><div class="desc"><?php echo apply_filters('the_content', $data['desc']); ?></div><?php endif; ?>
						</div>
					</div>
				</div>
				<div class="top-header-blog sort-by">
					<div class="filter-left"></div>
					<div class="filter-right">
						<div class="dropdown">
							<div class="dropdown-toggle" data-bs-toggle="dropdown">SORT BY <img class="dropdown-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/arrow-dropdown-icon.png" /></div>
							<ul class="dropdown-menu dropdown-menu-end">
								<li><a class="dropdown-item" href="?orderby=desc">Most recent</a></li>
								<li><a class="dropdown-item" href="?orderby=asc">Oldest</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="posts-grid">
					<div class="row">
						<?php
						$args = array('post_type' => 'sustainability', 'posts_per_page' => -1, 'post_status' => 'publish');
						if (!empty($_GET['orderby']) && $_GET['orderby'] == 'asc') {
							$args['order'] = 'ASC';
						}
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