<?php
// loading env in settings might not be the best place.
// the only other choice is in index.php.
// settings.php is called during UniyTesting, index is not.
try {
    // dotenv now use exceptions instead of return codes
    $dotenv = new Dotenv\Dotenv(__DIR__ . '/..');
    $dotenv->load();
} catch (Exception $e) {
    // Logger not avaliable yet use php error
    //error_log("No environment file, default values for everything (" . $e->getMessage() . ")\n");
}


//  N'affiche pas les erreurs en prod, sinon tout
error_reporting(getenv('TARGET') == 'prod' ? 0 : E_ALL);


return [
    'settings' => [
        'displayErrorDetails' => (getenv('TARGET') == 'prod') ? false : true,
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
