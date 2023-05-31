<?php
namespace App\Components;
use TypeRocket\Template\Component;
class SubMenuProduct extends Component
{
	protected $title = 'SubMenu Product';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->search('p_id')->setLabel('Product Item')->setPostTypeOptions('product');
	}
	/**
	 * Render
	 *
	 * @var array $data component fields
	 * @var array $info name, item_id, model, first_item, last_item, component_id, hash
	 */
	public function render(array $data, array $info)
	{
		$args = array(
			'post_type'             => 'product',
			'post_status'           => 'publish',
			'post__in' => array($data['p_id']),
		);
// 		var_dump($args);
		$products = new \WP_Query($args);
		if ($products->have_posts()) {
			while ($products->have_posts()) {
				$products->the_post();
				wc_get_template_part('content', 'product');
			}
		}
		wp_reset_postdata();
	}
}