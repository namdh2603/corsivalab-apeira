<?php
$new_post = tr_post_type('Award', 'Awards'); //menu show option right
$new_post->setId('award');
$new_post->setTitlePlaceholder('Enter award name here...');
//$new_post->setIcon('book');
//$new_post->setArchivePostsPerPage(5);
$new_post->setSupports(['title', 'editor', 'thumbnail', 'author']);

$new_post->addColumn('thumbnail', false, 'Thumbnail', function ($value) {
    echo get_the_post_thumbnail(get_the_ID(), 'thumbnail');
});

$new_post->addColumn('award_cat', false, 'Award Category', function ($value) {
    echo get_the_term_list(get_the_ID(), 'award_cat');
});
