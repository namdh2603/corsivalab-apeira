<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v16.0&appId=3350248661971130&autoLogAppEvents=1" nonce="IRo53S1m"></script>
<div class="modal fade modal-element" id="likeFacebookModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-md modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="close" data-bs-dismiss="modal"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/close-icon.png" /></div>
				<div class="head-section">
					<div class="title">Like Our Fanpage</div>
				</div>
				<div class="iframetrack">
					<div id="ok" class="fb-page" data-href="https://www.facebook.com/corsivalab" data-tabs="messenger" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
						<blockquote cite="https://www.facebook.com/corsivalab" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/corsivalab">Corsiva Lab</a></blockquote>
					</div>
				</div>
				<div id="consoleDebug"></div>
			</div>
		</div>
	</div>
</div>
<script>
	jQuery(document).ready(function($) {
		$('.fb-page iframe').iframeTracker({
			blurCallback: function() {
				$('<div class="alert alert-info">').html('Click on Facebook iframe').appendTo('#consoleDebug').delay(3000).fadeOut();
			}
		});
	});
</script>