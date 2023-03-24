<?php

use Kirki\Util\Helper;
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}
// Do not proceed if Kirki does not exist.
if (!class_exists('Kirki')) {
    return;
}
new \Kirki\Panel(
    'corsivalab_panel',
    [
        'priority'    => 10,
        'title'       => 'Corsivalab Option',
    ]
);
$sections = [
    'header'      => 'Header',
    'footer'      => 'Footer',
    'shop'      => 'Woocommerce Shop',
];
foreach ($sections as $section_id => $section) {
    $section_args = [
        'title'       => $section,
        'panel'       => 'corsivalab_panel',
        'type' => 'outer'
    ];
    new \Kirki\Section($section_id, $section_args);
}
new \Kirki\Field\Repeater(
    [
        'settings'    => sanitize_underscores('Topbar List'),
        'label'       => 'Topbar List',
        'section'     => 'header',
        'fields'      => [
            'text'   => [
                'type'        => 'textarea',
                'label'       => 'Text',
                'default'     => '',
            ],
        ],
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => sanitize_underscores('Copyright'),
        'label'       => 'Copyright',
        'section'         => 'footer',
        'default'         => '',
        'priority' => 10,
    ]
);
new \Kirki\Field\Repeater(
    [
        'settings'    => sanitize_underscores('Social List'),
        'label'       => 'Social List',
        'section'     => 'footer',
        'fields'      => [
            'social_icon'   => [
                'type'        => 'image',
                'label'       => 'Icon',
                'default'     => '',
                'choices'     => [
                    'save_as' => 'id',
                ],
            ],
            'social_link'   => [
                'type'        => 'text',
                'label'       => 'Link',
                'default'     => '#',
            ],
        ],
    ]
);

new \Kirki\Field\Text(
    [
        'settings'    => sanitize_underscores('Shop Page Title'),
        'label'       => 'Shop Page Title',
        'section'         => 'shop',
        'default'         => '',
        'priority' => 10,
    ]
);

new \Kirki\Field\Image(
    [
        'settings'    => sanitize_underscores('Shop Page Banner'),
        'label'       => 'Shop Page Banner',
        'section'     => 'shop',
        'default'     => '',
        'priority' => 20,
    ]
);
