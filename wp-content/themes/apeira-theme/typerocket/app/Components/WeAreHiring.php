<?php
namespace App\Components;
use TypeRocket\Template\Component;
// use TypeRocket\Models\WPPost;
class WeAreHiring extends Component
{
	protected $title = 'We Are Hiring';
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
	 * @var array $info name, data_id, model, first_data, last_data, component_id, hash
	 */
	public function render(array $data, array $info)
	{
		// $bg_color = $data['bg_color'];
?>
		<section class="section-<?php echo $info['component_id']; ?> section-padding pt-0" id="<?php echo $info['component_id']; ?>" data-id="<?php echo $info['component_id']; ?>" style="<?php echo (!empty($bg_color) ? 'background-color:' . $bg_color . ';' : ''); ?>">
			<div class="container">
				<div class="head-section">
					<div class="row">
						<div class="col-12 col-sm-9 col-md-9 col-lg-9 text-start">
							<?php if (!empty($data['sub_title'])) : ?><div class="sub-title"><?php echo $data['sub_title']; ?></div><?php endif; ?>
							<?php if (!empty($data['title'])) : ?><div class="title"><?php echo $data['title']; ?></div><?php endif; ?>
							<?php if (!empty($data['desc'])) : ?><div class="desc"><?php echo apply_filters('the_content', $data['desc']); ?></div><?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="careers-categories filter-section">
					<div class="filter-tabs d-flex align-items-center">
						<div class="tab-item <?php echo ((empty($_GET['categories'])) ? 'active' : ''); ?>">
							<label>
								<a href="<?php echo get_page_link(get_the_ID()); ?>/#we-are-hiring">
									<span>View All</span>
								</a>
							</label>
						</div>
						<?php $terms = get_terms(array(
							'taxonomy' => 'career_cat',
							'hide_empty' => false,
						));
						if (!empty($terms)) :
							foreach ($terms as $term) {
								echo '<div class="tab-item"><label>
                                <input id="filter_categories-' . $term->term_id . '" class="filter-item" name="cat" type="checkbox" data="categories" value="' . $term->term_id . '" /><span>' . $term->name . '</span>
                                </label></div>';
							}
						endif;
						?>
					</div>
				</div>
				<div class="careers-list">
					<?php
					$args = array('post_type' => 'career', 'posts_per_page' => -1, 'post_status' => 'publish');
					if (!empty($_GET['categories'])) {
						$categories = $_GET['categories'];
						$categories_arr = explode(",", $categories);
						$args['tax_query'] = array(
							array(
								'taxonomy' => 'career_cat',
								'field'    => 'term_id',
								'terms'    => $categories_arr,
							)
						);
					}
					$getposts = new \WP_Query($args);
					while ($getposts->have_posts()) : $getposts->the_post();
						$country = tr_post_field('country');
						$career_type = tr_post_field('career_type');
					?>
						<div class="career-item">
							<div class="career-info">
								<div class="career-title"><?php the_title(); ?></div>
								<div class="career-desc"><?php the_content(); ?></div>
								<div class="career-tags">
									<?php if ($country) { ?>
										<div class="tag"><img src="<?= get_stylesheet_directory_uri() ?>/assets/images/icon-location.png" /><span><?php echo $country; ?></span></div>
									<?php } ?>
									<?php if ($career_type) { ?>
										<div class="tag"><img src="<?= get_stylesheet_directory_uri() ?>/assets/images/icon-clock.png" /><span><?php echo $career_type; ?></span></div>
									<?php } ?>
								</div>
							</div>
							<div class="career-link">
								<div class="btn-wrap">
									<a class="btn-main btn-outline-v2 career-btn" data-bs-toggle="modal" data-bs-target="#sizeApplyModal" data-title="<?php the_title(); ?>">APPLY</a>
									
								</div>
							</div>
						</div>
					
					
					
					
					<?php endwhile;
					wp_reset_postdata(); ?>
					
					
				</div>
				
				<div class="modal fade modal-element" id="sizeApplyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm1 modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
          <div class="close" data-bs-dismiss="modal"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/close-icon.png" /></div>
                <div class="info-modal d-flex justify-content-center align-items-center flex-column text-center">

                    <div class="title-modal">Application Form</div>
					
					<?php echo do_shortcode('[contact-form-7 id="443" title="Careers Form"]'); ?>
					
					
            </div>
          </div>
        </div>
      </div>
    </div>
				
			</div>
			<script>
				jQuery(document).ready(function($) {
					var or_link = '<?php echo get_page_link(get_the_ID()); ?>';
					var arr = [];
					var body = $('body');
					$.fn.getType = function() {
						return this[0].tagName == "input" ? this[0].type.toLowerCase() : this[0].tagName.toLowerCase();
					}
					var getUrlParameter = function getUrlParameter(sParam) {
						var sPageURL = window.location.search.substring(1),
							sURLVariables = sPageURL.split('&'),
							sParameterName,
							i;
						for (i = 0; i < sURLVariables.length; i++) {
							sParameterName = sURLVariables[i].split('=');
							if (sParameterName[0] === sParam) {
								return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
							}
						}
					};
					var getValue = function(index, element) {
						var type = $(this).getType();
						var key_filter = $(this).attr('data');
						
							if ($(this).is(':checked')) { //checked
								body.pushToUrl('removeSelected', {
									url: or_link,
									key: key_filter
								});
								body.pushToUrl('add', {
									url: or_link,
									key: key_filter,
									value: $(this).val()
								});
								
							}
						
						
// 						if (type == 'select') {
// 							var value_filter = $(this).find(":selected").val();
// 							body.pushToUrl('add', {
// 								url: or_link,
// 								key: key_filter,
// 								value: value_filter
// 							});
// 						} else {
// 							var value_filter = $(this).val();
// 							if ($(this).is(':checked')) { //checked

// 								if ($.inArray(value_filter, arr) == -1) arr.push(value_filter);
								
								
								
// 							} else { //not check
// 							}
// 							if (arr.length != 0) {
// 								value_filter_str = arr.join(',');
// 								body.pushToUrl('removeSelected', {
// 									url: or_link,
// 									key: key_filter
// 								});
// 								body.pushToUrl('add', {
// 									url: or_link,
// 									key: key_filter,
// 									value: value_filter_str
// 								});
// 							} else {
// 								body.pushToUrl('removeSelected', {
// 									url: or_link,
// 									key: key_filter
// 								});
// 							}
// 							console.log('check');
// 						}
					};
					var setValue = function() {
						var type = $(this).getType();
						var key_filter = $(this).attr('data');
						var parameter_value = getUrlParameter(key_filter);
						if (parameter_value === undefined) {
							parameter_value = 0;
						} else {
							parameter_value = parameter_value;
							if (type == 'select') {
								$('#filter_' + key_filter).val(parameter_value);
							} else {
								$.each(parameter_value.split(","), function(index, item) {
									$('#filter_' + key_filter + '-' + item).prop("checked", true);
									// alert(item);
								});
							}
						}
					};
					$(".filter-item").change(function() {
						$('.filter-section .filter-item').each(getValue);
						location.reload();
					});
					$('.filter-section .filter-item').each(setValue);
				});
			</script>
		</section>
<?php
	}
}
