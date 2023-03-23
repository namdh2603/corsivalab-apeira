<h1>Home Banner Slide</h1>
<?php
echo $form->repeater('List')->setFields([
    $form->image('img')->setLabel('Banner'),
    $form->text('Title'),
    $form->editor('Description'),
	$form->row(
		$form->text('btn_txt')->setLabel('Text Button'),
		$form->text('btn_link')->setLabel('Link Button')->setDefault('#'),
	)
]);