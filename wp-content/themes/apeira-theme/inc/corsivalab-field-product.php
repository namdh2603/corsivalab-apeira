<?php

$addon_product_2 = tr_meta_box('Product Addition Details');
$addon_product_2->addPostType('product');
$addon_product_2->setCallback(function(){
    $form = tr_form();
	
	echo $form->textarea('desc_of_listing')->setLabel('Product description in listing Products');
// 	echo $form->wpEditor('fit_fabric')->setLabel('Fit & Fabric Tab');
// 	echo $form->wpEditor('delivery_returns')->setLabel('Delivery & Returns Tab');
});



$addon_product = tr_meta_box('Product SizeGuide Details');
$addon_product->addPostType('product');
$addon_product->setCallback(function(){
    $form = tr_form();
	
	echo $form->wpEditor('guide_desc')->setLabel('Description');
	echo $form->repeater('guide_list')->setLabel('Size Guide Tabs')->setFields([
			$form->text('title')->setLabel('Tab Title'),
			$form->wpEditor('desc')->setLabel('Tab Content')->setSetting('options', ['teeny' => false, 'tinymce' => true, 'editor_height' => 400]),
		]);
});





	