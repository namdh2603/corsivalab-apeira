<h1>How it works</h1>
<?php
echo $form->color('bg_color')->setLabel('Background Color');
echo $form->text('Title');
$options = [
	'Default' => 'default',
	'Carolissa' => 'carolissa',
	'Cherlotte' => 'cherlotte'
];
echo $form->toggle('title_color')->setLabel('Active white color Title');


echo $form->radio('Choose Font')->setOptions($options)->setSetting('default', 'default');
echo $form->repeater('List')->setFields([
	$form->row(
		    $form->image('Icon'),
    $form->text('Title')
	),
]);
    echo $form->row(
        $form->text('Padding Top')->setType('number')->setHelp('rem'),
        $form->text('Padding Bottom')->setType('number')->setHelp('rem'),
        $form->text('Padding Left')->setType('number')->setHelp('rem'),
        $form->text('Padding Right')->setType('number')->setHelp('rem'),
    );