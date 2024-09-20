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

    'paths' => ['api/*'], // Isso permitirá que o CORS funcione para todas as rotas da API
    'allowed_methods' => ['*'], // Permite todos os métodos (GET, POST, etc.)
    'allowed_origins' => ['http://localhost:3000'], // Permita apenas seu front-end React
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // Permite todos os cabeçalhos
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true, // Necessário para credenciais (cookies, sessões, etc.)
];
