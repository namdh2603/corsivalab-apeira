<?php
$addon_product = tr_meta_box('Product SizeGuide Details');
$addon_product->addPostType('product');
$addon_product->setCallback(function(){
    $form = tr_form();
	
	echo $form->wpEditor('desc')->setLabel('Description');
	echo $form->repeater('List')->setLabel('Size Guide Tabs')->setFields([
			$form->text('title')->setLabel('Tab Title'),
			$form->wpEditor('desc')->setLabel('Tab Content')->setSetting('options', ['teeny' => false, 'tinymce' => true, 'editor_height' => 400]),
		]);
});