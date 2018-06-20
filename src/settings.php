<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        // Database settings
        'db' => [
            'DB_USER' => getenv('DB_USER') ?: 'root',
            'DB_PASSWORD' => getenv('DB_PASSWORD') ?: '',
            'DB_NAME' => getenv('DB_NAME') ?: '',
            'DB_HOST' => getenv('DB_HOST') ?: 'localhost',
            'DB_DRIVER' => getenv('DB_DRIVER') ?: 'pdo_sqlite',
            'DB_PATH' => getenv('DB_PATH') ?: 'c:/Users/jerome/PhpstormProjects/Pourmiam/db/pourmiam.db',
        ],
        'email' => [
            'SMTP_SRV' => getenv('SMTP_SRV') ?: 'smtp.gmail.com',
            'SMTP_USER' => getenv('SMTP_USER') ?: 'noreply.pourmiam@gmail.com',
            'SMTP_PWD' => getenv('SMTP_PWD') ?: 'P@ssw0rd123987',
            'SMTP_USE_SSL' => getenv('SMTP_USE_SSL') ?: 'true',
            'SMTP_VERIFY_PEER' => getenv('SMTP_VERIFY_PEER') ?: 'true',
            'SMTP_USE_MOCK' => getenv('SMTP_USE_MOCK') ?: 'true',
        ],
    ],
];
