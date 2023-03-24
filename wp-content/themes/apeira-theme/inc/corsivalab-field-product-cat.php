<?php
function product_cat_taxonomy()
{
	$product_cat = tr_taxonomy('product_cat');
	$product_cat->setMainForm(function () {
		$form = tr_form();
		echo $form->image('img')->setLabel('Category Banner');
	});
	$product_cat->register();
}
add_action('init', 'product_cat_taxonomy',11);