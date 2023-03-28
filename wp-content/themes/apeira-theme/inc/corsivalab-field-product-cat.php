<?php
add_action('init', function() {
    $product_cat = tr_taxonomy('product_cat');

    $product_cat->setMainForm(function() {
        $form = tr_form();
		echo $form->image('img')->setLabel('Category Banner');
    });

    $product_cat->register();
}, 2);