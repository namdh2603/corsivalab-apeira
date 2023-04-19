<?php

/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.3.0
 */
defined('ABSPATH') || exit;
global $product;
if (!comments_open()) {
	return;
}
?>
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments">
		<div class="row">
			<div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3">
				<h2 class="woocommerce-Reviews-title">
					<?php
					$count = $product->get_review_count();
					if ($count && wc_review_ratings_enabled()) {
						/* translators: 1: reviews count 2: product name */
						$reviews_title = sprintf(esc_html(_n('%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'woocommerce')), esc_html($count), '<span>' . get_the_title() . '</span>');
						echo apply_filters('woocommerce_reviews_title', $reviews_title, $count, $product); // WPCS: XSS ok.
					} else {
						esc_html_e('Reviews', 'woocommerce');
					}
					?>
				</h2>
			</div>
			<div class="col-12 col-sm-9 col-md-9 col-lg-9 col-xl-9">
				<?php if (!wc_review_ratings_enabled()) {
					return;
				} ?>
				<div class="row">
					<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<?php
						global $wpdb;
						$rating_count = $product->get_rating_count();
						$review_count = $product->get_review_count();
						$average      = $product->get_average_rating();
						$fits = array(
							1 => 'Too Small',
							2 => 'Small',
							3 => 'True To Size',
							4 => 'Large',
							5 => 'Too Large',
						);
						if ($rating_count > 0) : ?>
							<div class="woocommerce-product-rating">
								<?php echo wc_get_rating_html($average, $rating_count); // WPCS: XSS ok.
								printf('<div>%s | Based on %s reviews</div>', $average, $rating_count);
								?>
							</div>
						<?php endif; ?>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<?php
						if ($rating_count > 0) {
							$ratings = $wpdb->get_var(
								$wpdb->prepare(
									"SELECT SUM(meta_value) FROM $wpdb->commentmeta LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID WHERE meta_key = 'fit' AND comment_post_ID = %d AND comment_approved = '1' AND meta_value > 0",
									$product->get_id()
								)
							);
							$average = round($ratings / $rating_count);
						?>
							<ul class="timeline overview">
								<?php $i = 0;
								foreach ($fits as $key => $value) {
									$i++;
									echo '<li data-fit="' . $key . '"' . ($i == $average ? ' class="active"' : '') . '><span>' . $value . '</span></li>';
								}
								?>
							</ul>
						<?php } ?>
					</div>
				</div>
				<?php if (have_comments()) : ?>
					<ol class="commentlist">
						<?php wp_list_comments(apply_filters('woocommerce_product_review_list_args', array('callback' => 'woocommerce_comments'))); ?>
					</ol>
					<?php
					if (get_comment_pages_count() > 1 && get_option('page_comments')) :
						echo '<nav class="woocommerce-pagination">';
						paginate_comments_links(
							apply_filters(
								'woocommerce_comment_pagination_args',
								array(
									'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
									'next_text' => is_rtl() ? '&larr;' : '&rarr;',
									'type'      => 'list',
								)
							)
						);
						echo '</nav>';
					endif;
					?>
				<?php else : ?>
					<p class="woocommerce-noreviews"><?php esc_html_e('There are no reviews yet.', 'woocommerce'); ?></p>
				<?php endif; ?>
				<div class="btn-wrap btn-left">
					<a class="btn-main" href="#" data-bs-toggle="modal" data-bs-target="#reviewModal">WRITE A REVIEW</a>
				</div>
				<div class="modal fade modal-element" id="reviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-body">
								<div class="close" data-bs-dismiss="modal"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/close-icon.png" /></div>
								<div class="review-modal">
									<div class="title text-start">REVIEW NOW</div>
									<?php if (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id())) : ?>
										<div id="review_form_wrapper">
											<h3 id="reply-title" class="comment-reply-title"><?php echo sprintf(esc_html__('%s', 'woocommerce'), get_the_title()); ?></h3>
											<ul class="timeline">
												<?php $i = 0;
												foreach ($fits as $key => $value) {
													$i++;
													echo '<li data-fit="' . $key . '"' . ($i == 3 ? ' class="active"' : '') . '><span>' . $value . '</span></li>';
												} ?>
											</ul>
											<div id="review_form">
												<!-- 							<div class="mb-5">
								Your email address will not be published. Required fields are marked *
							</div> -->
												<?php
												$commenter    = wp_get_current_commenter();
												$comment_form = array(
													/* translators: %s is product title */
													//'title_reply'         => have_comments() ? esc_html__('Add a review', 'woocommerce') : sprintf(esc_html__('Be the first to review &ldquo;%s&rdquo;', 'woocommerce'), get_the_title()),
													/* translators: %s is product title */
													// 								'title_reply_to'      => esc_html__('Leave a Reply to %s', 'woocommerce'),
													// 								'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
													// 								'title_reply_after'   => '</span>',
													// 								'title_reply'         => sprintf(esc_html__('%s', 'woocommerce'), get_the_title()),
													'title_reply'         => '',
													'comment_notes_after' => '',
													'label_submit'        => esc_html__('Submit', 'woocommerce'),
													'logged_in_as'        => '',
													'comment_field'       => '',
												);
												$name_email_required = (bool) get_option('require_name_email', 1);
												$fields              = array(
													'author' => array(
														'label'    => __('YOUR NAME', 'woocommerce'),
														'type'     => 'text',
														'value'    => $commenter['comment_author'],
														'required' => $name_email_required,
														'placeholder' => 'Type Your Name Here',
													),
													'email'  => array(
														'label'    => __('YOUR EMAIL', 'woocommerce'),
														'type'     => 'email',
														'value'    => $commenter['comment_author_email'],
														'required' => $name_email_required,
														'placeholder' => 'Type Your Email Here',
													),
													// 																'fit' => array(
													// 									'label'    => 'Size',
													// 									'type'     => 'number',
													// 									'value'    => '3',
													// 									'required' => false,
													// 									'placeholder' => '',
													// 								),
												);
												$comment_form['fields'] = array();
												$i = 0;
												// 							var_dump($fields);
												foreach ($fields as $key => $field) {
													$i++;
													$field_html  = '';
													if ($i == 1) {
														$field_html .= '<div class="row">';
													}
													$field_html .= '<div class="col-6"><div class="comment-form-field comment-form-' . esc_attr($key) . '">';
													$field_html .= '<label for="' . esc_attr($key) . '">' . esc_html($field['label']);
													if ($field['required']) {
														$field_html .= '&nbsp;<span class="required">*</span>';
													}
													$field_html .= '</label><input id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" type="' . esc_attr($field['type']) . '" value="' . esc_attr($field['value']) . '" size="30" ' . ($field['required'] ? 'required' : '') . ' placeholder="' . esc_attr($field['placeholder']) . '" /></div></div>';
													$comment_form['fields'][$key] = $field_html;
													if ($i == count($fields)) {
														$field_html .= '</div>';
													}
												}
												$account_page_url = wc_get_page_permalink('myaccount');
												if ($account_page_url) {
													/* translators: %s opening and closing link tags respectively */
													$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf(esc_html__('You must be %1$slogged in%2$s to post a review.', 'woocommerce'), '<a href="' . esc_url($account_page_url) . '">', '</a>') . '</p>';
												}
												if (wc_review_ratings_enabled()) {
													$comment_form['comment_field'] = '<div class="comment-form-field comment-form-rating"><label for="rating">' . esc_html__('Your rating', 'woocommerce') . (wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '') . '</label><select name="rating" id="rating" required>
						<option value="">' . esc_html__('Rate&hellip;', 'woocommerce') . '</option>
						<option value="5">' . esc_html__('Perfect', 'woocommerce') . '</option>
						<option value="4">' . esc_html__('Good', 'woocommerce') . '</option>
						<option value="3">' . esc_html__('Average', 'woocommerce') . '</option>
						<option value="2">' . esc_html__('Not that bad', 'woocommerce') . '</option>
						<option value="1">' . esc_html__('Very poor', 'woocommerce') . '</option>
					</select></div>';
												}
												$comment_form['comment_field'] .= '<div class="comment-form-field comment-form-comment"><label for="comment">' . esc_html__('YOUR REVIEW HERE', 'woocommerce') . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required placeholder="Give Us Some Details About Your Concern"></textarea></div>';
												comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
												?>
											</div>
										</div>
									<?php else : ?>
										<p class="woocommerce-verification-required"><?php esc_html_e('Only logged in customers who have purchased this product may leave a review.', 'woocommerce'); ?></p>
									<?php endif; ?>
									<!--                   <div class="account-btn btn-wrap">
                    <a href="<?php echo $account_link; ?>/?register=true" class="btn-main w-100 text-uppercase">SIGN UP</a>
                    <a href="<?php echo $account_link; ?>" class="register-btn btn-main btn-outline-v2 w-100">ALREADY HAVE AN ACCOUNT? SIGN IN</a>
                  </div> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>