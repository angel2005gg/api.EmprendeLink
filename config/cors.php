<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

'allowed_origins' => [
    'https://clienteemprendelink-production.up.railway.app',
    'http://localhost:8000', // API
    'http://localhost:8001', // Frontend
    'https://127.0.0.1:8000', // API en caso de usar HTTPS
    'https://127.0.0.1:8001', // Frontend en caso de usar HTTPS
    'http://clienteemprendelink-production.up.railway.app',
],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];
