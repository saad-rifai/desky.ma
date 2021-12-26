<?php

return [
    'secret' => env('NOCAPTCHA_SECRET'),
    'sitekey' => env('NOCAPTCHA_SITEKEY'),
    'options' => [
        'timeout' => 30,
    ],
    'default'   => [
        'length'    => 6,
        'width'     => 200,
        'height'    => 45,
        'quality'   => 100,
        'math'      => false, //Enable Math Captcha
    ],
];
