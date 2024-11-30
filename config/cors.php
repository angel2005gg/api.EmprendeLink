<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:8000',
        'http://localhost:8001',
        'https://127.0.0.1:8000',
        'https://127.0.0.1:8001',
        'https://clienteemprendelink-production.up.railway.app',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false, // Cambia a true si usas cookies o autenticación basada en sesión
];
