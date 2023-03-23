<?php

namespace App\Components;

use TypeRocket\Template\Component;

class PageBannerVideo extends Component
{
	protected $title = 'Page Banner Video';
	/**
	 * Admin Fields
	 */
	public function fields()
	{
		$form = $this->form();
		echo $form->row()
			->withColumn(
				$form->image('img')->setLabel('Banner'),
			)
			->withColumn(
				$form->file('upload')->setLabel('Video Upload'),
				$form->text('video_url')->setLabel('Video Url')->setHelp('Supported Vimeo, Youtube video'),
			);
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
		<section class="section-<?php echo $info['component_id']; ?>" data-id="<?php echo $info['component_id']; ?>">
			<div class="container-fluid">



				<?php
				if (!empty($data['upload'])) {
					$output_link = wp_get_attachment_url($data['upload']);
				} else {

					$video_url = $data['video_url'];
					if (str_contains($video_url, 'vimeo')) {
						$vimeo_id = (int)substr(parse_url($video_url, PHP_URL_PATH), 1);

						$output_link = 'https://vimeo.com/' . $vimeo_id;
					} else {

						$output_link = 'https://www.youtube.com/watch?v=' . getYoutubeIdFromUrl($video_url);
					}
				} ?>

				<div class="banner-video-inner">
					<img src="<?php echo get_attachment($data['img'])['src']; ?>" class="w-100" alt="img" />
					<div class="player-inner">
						<div class="container">
							<div class="row">
								<div class="col-12 col-sm-12 col-md-12 col-lg-12">
									<a class="play-btn" href="<?= $output_link; ?>" data-fancybox="video" data-width="640" data-height="360">
										<img src="<?= get_stylesheet_directory_uri() ?>/assets/images/icon-play.png"> <span>PLAY NOW</span>
									</a>


								</div>
							</div>
						</div>
					</div>

				</div>




			</div>
		</section>
<?php
	}
}
