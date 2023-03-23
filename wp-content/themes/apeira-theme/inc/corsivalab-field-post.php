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