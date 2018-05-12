<?php

namespace Tests\Functional;

use Slim\App;
use Slim\Http\Environment;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * This is an example class that shows how you could set up a method that
 * runs the application. Note that it doesn't cover all use-cases and is
 * tuned to the specifics of this skeleton app, so if your needs are
 * different, you'll need to change it.
 */
class BaseTestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * Use middleware when running application?
     *
     * @var bool
     */
    protected $withMiddleware = true;

    /**
     * Setup before running any test cases
     */
    public static function setUpBeforeClass()
    {
        BaseTestCase::createFreshDB();
    }

    /**
     * static method allow call from anywhere within test framework
     * even before test object is instanciated
     */
    protected static function createFreshDB()
    {
        $source = __DIR__ . '../../db/test_db.db';
        $dest = __DIR__ . '../../db/fresh_test_db.db';
        copy($source, $dest);
    }

    /**
     * Process the application given a request method and URI
     *
     * @param string $requestMethod the request method (e.g. GET, POST, etc.)
     * @param string $requestUri the request URI
     * @param array|object|null $requestData the request data
     * @return \Slim\Http\Response
     */
    public function runApp($requestMethod, $requestUri, $requestData = null, $bearer = null)
    {
        // Create a mock environment for testing with
        $environment = Environment::mock([
            'REQUEST_METHOD' => $requestMethod,
            'REQUEST_URI' => $requestUri,
            'HTTP_AUTHORIZATION' => $bearer
        ]);

        // Set up a request object based on the environment
        $request = Request::createFromEnvironment($environment);

        // Add request data, if it exists
        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }

        // Set up a response object
        $response = new Response();

        // Use the application settings
        $settings = require __DIR__ . '/../../src/settings.php';

        // Except for database
        $settings['settings']['db']['DB_USER'] = '';
        $settings['settings']['db']['DB_PASSWORD'] = '';
        $settings['settings']['db']['DB_NAME'] = '';
        $settings['settings']['db']['DB_HOST'] = 'localhost';
        $settings['settings']['db']['DB_DRIVER'] = 'pdo_sqlite';
        $settings['settings']['db']['DB_PATH'] = __DIR__ . '/../db/fresh_test_db.db';

        // And for Env declaration
        $settings['settings']['version']['env'] = 'test';

        // Instantiate the application
        $app = new App($settings);

        // Set up dependencies
        require __DIR__ . '/../../src/dependencies.php';

        // Register middleware
        if ($this->withMiddleware) {
            require __DIR__ . '/../../src/middleware.php';
        }

        // Register routes
        require __DIR__ . '/../../src/routes.php';

        // Process the application
        $response = $app->process($request, $response);

        // Return the response
        return $response;
    }
}
