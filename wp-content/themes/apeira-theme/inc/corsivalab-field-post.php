<?php
$careers_additional = tr_meta_box('Careers Additional');
$careers_additional->addPostType('career');
$careers_additional->setCallback(function(){
    $form = tr_form();
    echo $form->text('Country');
    echo $form->text('Career Type');
    echo $form->text('Career Link');
});
$careers_additional->setPriority('default');



$sustainability_additional = tr_meta_box('Sustainability Additional');
$sustainability_additional->addPostType('sustainability');
$sustainability_additional->setCallback(function () {
    $form = tr_form();
		echo $form->textarea('desc')->setLabel('Sustainability Short Description');
    echo $form->image('banner')->setLabel('Banner Post');
});
$sustainability_additional->setPriority('default');


$post_additional = tr_meta_box('Post Additional');
$post_additional->addPostType('post');
$post_additional->setCallback(function () {
    $form = tr_form();
		echo $form->textarea('desc')->setLabel('Post Short Description');

    echo $form->image('banner')->setLabel('Banner Post');
});
$post_additional->setPriority('default');