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

/// https://kirki.org/docs/advanced/the-helper-class/
// -> Docs for get terms


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
    'cart'      => 'Woocommerce Cart',
    'login'      => 'Woocommerce Login & Register',
    'blog'      => 'Blogs',
    'reward'      => 'Rewards',
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
		'row_label'    => [
			'type'  => 'field',
			'field' => 'text',
		],
        'section'     => 'header',
        'fields'      => [
            'text'   => [
                'type'        => 'textarea',
                'label'       => 'Text',
                'default'     => '',
            ],
            'link'   => [
                'type'        => 'text',
                'label'       => 'Link',
                'default'     => '',
            ],
        ],
        'priority' => 10,
    ]
);

new \Kirki\Field\Select(
    [
        'settings'    => sanitize_underscores('Sub Menu Column 1'),
        'label'       => 'Sub Menu Column 1',
        'section'     => 'header',
        'placeholder' => 'Select a menu',
        'priority' => 20,
		'choices'     => Kirki\Util\Helper::get_terms( array('taxonomy' => 'nav_menu') ),
    ]
);
new \Kirki\Field\Select(
    [
        'settings'    => sanitize_underscores('Sub Menu Column 2'),
        'label'       => 'Sub Menu Column 2',
        'section'     => 'header',
        'placeholder' => 'Select a menu',
        'priority' => 30,
		'choices'     => Kirki\Util\Helper::get_terms( array('taxonomy' => 'nav_menu') ),
    ]
);
new \Kirki\Field\Select(
    [
        'settings'    => sanitize_underscores('Sub Menu Column 3'),
        'label'       => 'Sub Menu Column 3',
        'section'     => 'header',
        'placeholder' => 'Select a menu',
        'priority' => 40,
		'choices'     => Kirki\Util\Helper::get_terms( array('taxonomy' => 'nav_menu') ),
    ]
);
new \Kirki\Field\Repeater(
    [
        'settings'    => sanitize_underscores('Sub Menu Right Item'),
        'label'       => 'Sub Menu Right Item',
        'section'     => 'header',
        'fields'      => [
            'image'   => [
                'type'        => 'image',
                'label'       => 'Image',
                'default'     => '',
                'choices'     => [
                    'save_as' => 'id',
                ],
            ],
            'text'   => [
                'type'        => 'textarea',
                'label'       => 'Text',
                'default'     => '',
            ],
            'desc'   => [
                'type'        => 'textarea',
                'label'       => 'Text',
                'default'     => '',
            ],
        ],
        'priority' => 50,
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
new \Kirki\Field\Date(
    [
        'settings'    => sanitize_underscores('Countdown Sale'),
        'label'       => 'Countdown Sale Date',
        'section'     => 'footer',
        'default'     => '',
        'priority' => 20,
    ]
);
new \Kirki\Field\Image(
    [
        'settings'    => sanitize_underscores('Countdown Sale Icon'),
        'label'       => 'Countdown Sale Icon',
        'section'     => 'footer',
        'default'     => '',
        'choices'     => [
            'save_as' => 'id',
        ],
        'priority' => 30,
    ]
);
new \Kirki\Field\Repeater(
    [
        'settings'    => sanitize_underscores('Social List'),
        'label'       => 'Social List',
        'section'     => 'footer',
		'row_label'    => [
// 			'type'  => 'field',
// 			'field' => 'title',
			'value' => 'Social Item',
		],
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

add_action( 'init', function() {
new \Kirki\Field\Multicheck(
	[
		'settings' => sanitize_underscores('Shop Categories Filter'),
		'label'    => 'Shop Categories Filter',
		'section'  => 'shop',
		'choices'     => Kirki\Util\Helper::get_terms( array('taxonomy'=>'product_cat', 'hide_empty' => false, 'parent' => 0, 'exclude' => 15) ),
        'priority' => 30,
	]
);
} );
new \Kirki\Field\Image(
    [
        'settings'    => sanitize_underscores('Image Cart Popup'),
        'label'       => 'Image Cart Popup',
        'section'     => 'cart',
        'default'     => '',
        'priority' => 10,
    ]
);
new \Kirki\Field\Text(
    [
        'settings'    => sanitize_underscores('Popup Title'),
        'label'       => 'Popup Title',
        'section'     => 'cart',
        'default'         => '',
        'priority' => 20,
    ]
);
new \Kirki\Field\Textarea(
    [
        'settings'    => sanitize_underscores('Popup Description'),
        'label'       => 'Popup Description',
        'section'     => 'cart',
        'default'         => '',
        'priority' => 30,
    ]
);
new \Kirki\Field\Image(
    [
        'settings'    => sanitize_underscores('Image Login'),
        'label'       => 'Image Login',
        'section'     => 'login',
        'default'     => '',
        'priority' => 10,
        'choices'     => [
            'save_as' => 'id',
        ],
    ]
);
new \Kirki\Field\Image(
    [
        'settings'    => sanitize_underscores('Blog Page Banner'),
        'label'       => 'Blog Page Banner',
        'section'     => 'blog',
        'default'     => '',
        'priority' => 10,
        'choices'     => [
            'save_as' => 'id',
        ],
    ]
);


new \Kirki\Field\Repeater(
    [
        'settings'    => sanitize_underscores('Action Reward List'),
        'label'       => 'Action Reward List',
        'section'     => 'reward',
		'row_label'    => [
			'type'  => 'field',
// 			'value' => esc_html__( 'Your Custom Value', 'kirki' ),
			'field' => 'title',
			
// 			'value' => 'Action Item',
		],
		
		'button_label' => 'Add Action',
        'fields'      => [
            'icon'   => [
                'type'        => 'image',
                'label'       => 'Image',
                'default'     => '',
                'choices'     => [
                    'save_as' => 'id',
                ],
            ],
            'title'   => [
                'type'        => 'text',
                'label'       => 'Title',
                'default'     => '',
            ],
			'slug'   => [
                'type'        => 'text',
                'label'       => 'Slug',
                'default'     => '',
            ],
            'point'   => [
                'type'        => 'number',
                'label'       => 'Point',
                'default'     => '',
            ],
        ],
        'priority' => 10,
    ]
);
