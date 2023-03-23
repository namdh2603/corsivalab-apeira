<?php
// if (current_user_can('administrator')) {
// 	$path = 'data="home-banner-slide.php"';
// 	$name = ' data-name="Home Banner Slide"';
// }
$builder = get_post_meta(get_the_ID(), 'builder', true);
// var_dump($builder);

foreach($builder as $item){
	var_dump($item);
}
if (!empty($data['list'])) { ?>
	<section class="section-banner-slide" <?php echo (!empty($path) ? $path . $name : ''); ?>>
		<div class="banner-slide-container">
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php
					foreach ($data['list'] as $item) {
					?>
						<div class="swiper-slide">
							<img src="<?php echo get_attachment($item['img'])['src']; ?>" class="w-100" alt="img" />
							<div class="swiper-caption">
								<div class="container w-100">
									<div class="row">
										<div class="col-12 col-lg-9 mx-auto">
											<div class="block-content">
												<div class="title-section text-center"><?php echo $item['title']; ?></div>
												<div class="description-section text-center">
													<?php echo $item['description']; ?>
												</div>
												<?php if (!empty($item['btn_txt'])) : ?>
													<div class="btn-wrap btn-center">
														<a class="btn-main" href="<?php echo $item['btn_link']; ?>"><?php echo $item['btn_txt']; ?></a>
													</div>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
				<div class="swiper-button-next d-none d-lg-block">
					<img src="<?php echo get_template_directory_uri();  ?>/assets/images/Home/next-arrow.png" alt="">
				</div>
				<div class="swiper-button-prev d-none d-lg-block">
					<img src="<?php echo get_template_directory_uri();  ?>/assets/images/Home/prev-arrow.png" alt="">
				</div>
			</div>
		</div>
	</section>
<?php } ?>