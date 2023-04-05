<?php
$sustainability_additional = tr_meta_box('Sustainability Additional');
$sustainability_additional->addPostType('sustainability');
$sustainability_additional->setCallback(function () {
    $form = tr_form();

    echo $form->image('banner')->setLabel('Banner Post');
});
$sustainability_additional->setPriority('default');


$post_additional = tr_meta_box('Post Additional');
$post_additional->addPostType('post');
$post_additional->setCallback(function () {
    $form = tr_form();

    echo $form->image('banner')->setLabel('Banner Post');
});
$post_additional->setPriority('default');