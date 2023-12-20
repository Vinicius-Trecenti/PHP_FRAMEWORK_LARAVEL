<?php

return [
    // ... outras configurações

    'storage' => [
        'enabled' => true,
        'open' => true,
        'driver' => 'sqlite', // ou qualquer outro driver de sua preferência
        'path' => storage_path('debugbar'), // caminho para armazenamento dos dados
    ],
];

