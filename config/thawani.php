<?php

return [
    'api_key' => env('THAWANI_API_KEY'),
    'publishable_key' => env('THAWANI_PUBLISHABLE_KEY'),
    'mode' => env('THAWANI_MODE', 'test'),
    'base_url' => env('THAWANI_URL', 'https://uatcheckout.thawani.om'),
];