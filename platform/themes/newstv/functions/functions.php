<?php

require_once __DIR__ . '/../vendor/autoload.php';

register_page_template([
    'no-sidebar' => __('No Sidebar'),
]);

register_sidebar([
    'id'          => 'footer_sidebar',
    'name'        => 'Footer sidebar',
    'description' => 'This is footer sidebar section',
]);

add_shortcode('google-map', 'Google map', 'Custom map', 'add_google_map_shortcode');

/**
 * @param $shortcode
 * @return mixed
 *
 * @throws \Botble\Theme\Exceptions\UnknownPartialFileException
 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
 */
function add_google_map_shortcode($shortcode)
{
    return Theme::partial('google-map', ['address' => $shortcode->content]);
}

shortcode()->setAdminConfig('google-map', Theme::partial('google-map-admin-config'));

add_shortcode('youtube-video', 'Youtube video', 'Add youtube video', 'add_youtube_video_shortcode');

/**
 * @param $shortcode
 * @return mixed
 *
 * @throws \Botble\Theme\Exceptions\UnknownPartialFileException
 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
 */
function add_youtube_video_shortcode($shortcode)
{
    return Theme::partial('video', ['url' => $shortcode->content]);
}

shortcode()->setAdminConfig('youtube-video', Theme::partial('youtube-admin-config'));

theme_option()
    ->setArgs(['debug' => config('app.debug')])
    ->setSection([
        'title'      => __('General'),
        'desc'       => __('General settings'),
        'id'         => 'opt-text-subsection-general',
        'subsection' => true,
        'icon'       => 'fa fa-home',
    ])
    ->setSection([
        'title'      => __('Logo'),
        'desc'       => __('Change logo'),
        'id'         => 'opt-text-subsection-logo',
        'subsection' => true,
        'icon'       => 'fa fa-image',
        'fields'     => [
            [
                'id'         => 'logo',
                'type'       => 'mediaImage',
                'label'      => __('Logo'),
                'attributes' => [
                    'name'  => 'logo',
                    'value' => null,
                ],
            ],
        ],
    ])
    ->setField([
        'id'         => 'copyright',
        'section_id' => 'opt-text-subsection-general',
        'type'       => 'text',
        'label'      => __('Copyright'),
        'attributes' => [
            'name'    => 'copyright',
            'value'   => __('© 2019 Botble Technologies. All right reserved. Designed by Nghia Minh'),
            'options' => [
                'class'        => 'form-control',
                'placeholder'  => __('Change copyright'),
                'data-counter' => 255,
            ],
        ],
        'helper'     => __('Copyright on footer of site'),
    ])
    ->setField([
        'id'         => 'theme-color',
        'section_id' => 'opt-text-subsection-general',
        'type'       => 'select',
        'label'      => __('Theme color'),
        'attributes' => [
            'name'    => 'theme_color',
            'list'    => [
                'red'   => 'Red',
                'green' => 'Green',
                'blue'  => 'Blue',
            ],
            'value'   => 'red',
            'options' => [
                'class' => 'form-control',
            ],
        ],
        'helper'     => __('Primary theme color'),
    ])
    ->setField([
        'id'         => 'top-banner',
        'section_id' => 'opt-text-subsection-general',
        'type'       => 'mediaImage',
        'label'      => __('Top banner'),
        'attributes' => [
            'name'       => 'top_banner',
            'value'      => '',
            'attributes' => [
                'allow_thumb' => false,
            ],
        ],
    ])
    ->setSection([
        'title'      => __('Social'),
        'desc'       => __('Social links'),
        'id'         => 'opt-text-subsection-social',
        'subsection' => true,
        'icon'       => 'fa fa-share-alt',
    ])
    ->setField([
        'id'         => 'facebook',
        'section_id' => 'opt-text-subsection-social',
        'type'       => 'text',
        'label'      => 'Facebook',
        'attributes' => [
            'name'    => 'facebook',
            'value'   => null,
            'options' => [
                'class' => 'form-control',
            ],
        ],
    ])
    ->setField([
        'id'         => 'twitter',
        'section_id' => 'opt-text-subsection-social',
        'type'       => 'text',
        'label'      => 'Twitter',
        'attributes' => [
            'name'    => 'twitter',
            'value'   => null,
            'options' => [
                'class' => 'form-control',
            ],
        ],
    ])
    ->setField([
        'id'         => 'youtube',
        'section_id' => 'opt-text-subsection-social',
        'type'       => 'text',
        'label'      => 'Youtube',
        'attributes' => [
            'name'    => 'youtube',
            'value'   => null,
            'options' => [
                'class' => 'form-control',
            ],
        ],
    ]);

RvMedia::addSize('featured', 560, 380)->addSize('medium', 540, 360);
