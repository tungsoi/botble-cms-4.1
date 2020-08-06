<?php

return [
    /* ------------------------------------------------------------------------------------------------
     |  Credentials
     | ------------------------------------------------------------------------------------------------
     */
    'secret'     => env('CAPTCHA_SECRET', 'no-captcha-secret'),
    'site_key'   => env('CAPTCHA_SITE_KEY', 'no-captcha-site-key'),

    /* ------------------------------------------------------------------------------------------------
     |  Localization
     | ------------------------------------------------------------------------------------------------
     */
    'lang'       => app()->getLocale(),

    /* ------------------------------------------------------------------------------------------------
     |  Attributes
     | ------------------------------------------------------------------------------------------------
     */
    'attributes' => [
        'data-theme' => null, // 'light', 'dark'
        'data-type'  => null, // 'image', 'audio'
        'data-size'  => null, // 'normal', 'compact'
    ],
];
