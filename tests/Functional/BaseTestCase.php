<?php

namespace Tests\Functional;

use Phinx\Console\PhinxApplication;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\NullOutput;

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
     * Application.
     *
     * @var App
     */
    protected $app;

    /**
     * Phinx Application.
     *
     * @var PhinxApplication
     */
    protected $phinx;

    /**
     * Create Phinx application and run the migrations.
     *
     * @return void
     *
     * @throws \Exception
     */
    protected function setUp()
    {
        parent::setUp();

        // Use the application settings
        $settings = require __DIR__ . '/../../src/settings.php';

        // Instantiate the application
        $app = new App($settings);

        // Set up dependencies
        require __DIR__ . '/../../src/dependencies.php';

        // Register routes
        require __DIR__ . '/../../src/routes.php';

        $this->app = $app;

        $this->phinx = new PhinxApplication();
        $this->phinx->setAutoExit(false);
        $this->phinx->run(new StringInput('migrate'), new NullOutput());
    }

    /**
     * Process the application given a request method and URI
     *
     * @param string $requestMethod the request method (e.g. GET, POST, etc.)
     * @param string $requestUri the request URI
     * @param array|object|null $requestData the request data
     *
     * @return \Slim\Http\Response
     *
     * @throws \Exception
     */
    public function runApp($requestMethod, $requestUri, $requestData = null)
    {
        // Create a mock environment for testing with
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri
            ]
        );

        // Set up a request object based on the environment
        $request = Request::createFromEnvironment($environment);

        // Add request data, if it exists
        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }

        // Set up a response object
        $response = new Response();

        // Process the application
        $response = $this->app->process($request, $response);

        // Return the response
        return $response;
    }
}
