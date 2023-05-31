<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Component Registry
    |--------------------------------------------------------------------------
    */
    'registry' => [
        'home-slide' => \App\Components\HomeSlide::class,
        sanitize_title('Featured Collections') => \App\Components\FeaturedCollections::class,
        sanitize_title('New Arrivals') => \App\Components\NewArrivals::class,
        sanitize_title('Home Banner') => \App\Components\HomeBanner::class,
        sanitize_title('Sustainability') => \App\Components\Sustainability::class,
        sanitize_title('Love Us') => \App\Components\LoveUs::class,
        sanitize_title('Subscribe') => \App\Components\Subscribe::class,
        sanitize_title('Instagram Feed') => \App\Components\InstagramFeed::class,
        sanitize_title('Page Banner Title') => \App\Components\PageBannerTitle::class,
        sanitize_title('Page Content Title') => \App\Components\PageContentTitle::class,
        sanitize_title('Page Banner Video') => \App\Components\PageBannerVideo::class,
        sanitize_title('Our Team') => \App\Components\OurTeam::class,
        sanitize_title('Quote') => \App\Components\Quote::class,
        sanitize_title('Our Team Carousel') => \App\Components\OurTeamCarousel::class,
        sanitize_title('Our Promise') => \App\Components\OurPromise::class,
        sanitize_title('We Are Hiring') => \App\Components\WeAreHiring::class,
        sanitize_title('Sustainability Grid') => \App\Components\SustainabilityGrid::class,
        sanitize_title('Reward Form') => \App\Components\RewardForm::class,
        sanitize_title('Reward List') => \App\Components\RewardList::class,
        sanitize_title('Page Search') => \App\Components\PageSearch::class,
        sanitize_title('FAQ') => \App\Components\FAQ::class,
        sanitize_title('Title With Shortcode') => \App\Components\TitleWithShortcode::class,
        sanitize_title('Content') => \App\Components\ContentComponent::class,
        sanitize_title('Content With Image') => \App\Components\ContentWithImage::class,
        sanitize_title('Tabs Section') => \App\Components\TabsSection::class,
        sanitize_title('Contact Us') => \App\Components\ContactUs::class,
        sanitize_title('About Us Image Tabs') => \App\Components\AboutUsImageTabs::class,
        sanitize_title('Impact Count') => \App\Components\ImpactCount::class,
        sanitize_title('Social List') => \App\Components\SocialList::class,
        sanitize_title('Search') => \App\Components\Search::class,
        sanitize_title('Gap') => \App\Components\Gap::class,
        sanitize_title('Sub Menu Add Menu') => \App\Components\SubMenuAddMenu::class,
        sanitize_title('Sub Menu Feature') => \App\Components\SubMenuFeature::class,
        sanitize_title('Sub Menu Product') => \App\Components\SubMenuProduct::class,
		
		
    ],

    /*
    |--------------------------------------------------------------------------
    | Builder
    |--------------------------------------------------------------------------
    |
    | List of components you want included for the builder group.
    |
    */
    'builder' => [
        // 'content',
        // 'image-conponent',
        'home-slide',
        sanitize_title('Featured Collections'),
        sanitize_title('New Arrivals'),
        sanitize_title('Home Banner'),
        sanitize_title('Sustainability'),
        sanitize_title('Love Us'),
        sanitize_title('Subscribe'),
        sanitize_title('Instagram Feed'),
        sanitize_title('Page Banner Title'),
        sanitize_title('Page Content Title'),
        sanitize_title('Page Banner Video'),
        sanitize_title('Our Team'),
        sanitize_title('Quote'),
        sanitize_title('Our Team Carousel'),
        sanitize_title('We Are Hiring'),
        sanitize_title('Sustainability Grid'),
        sanitize_title('Reward Form'),
        sanitize_title('Reward List'),
        sanitize_title('Page Search'),
        sanitize_title('FAQ'),
        sanitize_title('Title With Shortcode'),
        sanitize_title('Content'),
        sanitize_title('Content With Image'),
        sanitize_title('Tabs Section'),
        sanitize_title('Contact Us'),
        sanitize_title('Impact Count'),
        sanitize_title('Social List'),
        sanitize_title('About Us Image Tabs'),
        sanitize_title('Search'),
        sanitize_title('Gap'),
        sanitize_title('Sub Menu Add Menu'),
        sanitize_title('Sub Menu Feature'),
		sanitize_title('Sub Menu Product')
		
		
		
    ]
];