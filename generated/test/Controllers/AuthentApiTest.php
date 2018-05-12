<?php
/**
 * AuthentApiTest
 * PHP version 5
 *
 * @category Class
 * @package  SwaggerServer
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * API Gastronoslim
 *
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 0.1.0_inProgress
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Please update the test case below to test the endpoint.
 */

namespace Tests\Functional;

/**
 * AuthentApiTest Class Doc Comment
 *
 * @category Class
 * @package  SwaggerServer
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class AuthentApiTest extends BaseTestCase
{

    /**
     * Setup before running any test cases
     */
    public static function setUpBeforeClass()
    {
    }

    /**
     * Setup before running each test case
     */
    public function setUp()
    {
    }

    /**
     * Clean up after running each test case
     */
    public function tearDown()
    {
    }

    /**
     * Clean up after running all test cases
     */
    public static function tearDownAfterClass()
    {
    }

    /**
     * Test case for authentInit
     *
     * Create a temporary account..
     *
     */
        
    public function testauthentInit200()
    {
        $response = $this->runApp('POST', '//authent/init');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Success', (string)$response->getBody());
    }
    public function testauthentInit400()
    {
        $response = $this->runApp('POST', '//authent/init');

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertContains('Bad Request  List of supported error codes: - 20: Invalid URL parameter value - 21: Missing body - 22: Invalid body - 23: Missing body field - 24: Invalid body field - 25: Missing header - 26: Invalid header value - 27: Missing query-string parameter - 28: Invalid query-string parameter value', (string)$response->getBody());
    }
    public function testauthentInit401()
    {
        $response = $this->runApp('POST', '//authent/init');

        $this->assertEquals(401, $response->getStatusCode());
        $this->assertContains('Unauthorized  List of supported error codes: - 40: Missing credentials - 41: Invalid credentials - 42: Expired credentials', (string)$response->getBody());
    }
    public function testauthentInit404()
    {
        $response = $this->runApp('POST', '//authent/init');

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertContains('Not Found  List of supported error codes: - 60: Resource not found', (string)$response->getBody());
    }
    public function testauthentInit422()
    {
        $response = $this->runApp('POST', '//authent/init');

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertContains('Unprocessable entity  Functional error', (string)$response->getBody());
    }

    /**
     * Test case for authentInitconfirm
     *
     * Confirm account creation..
     *
     */
        
    public function testauthentInitconfirm200()
    {
        $response = $this->runApp('POST', '//authent/{token}/initconfirm');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Success', (string)$response->getBody());
    }
    public function testauthentInitconfirm400()
    {
        $response = $this->runApp('POST', '//authent/{token}/initconfirm');

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertContains('Bad Request  List of supported error codes: - 20: Invalid URL parameter value - 21: Missing body - 22: Invalid body - 23: Missing body field - 24: Invalid body field - 25: Missing header - 26: Invalid header value - 27: Missing query-string parameter - 28: Invalid query-string parameter value', (string)$response->getBody());
    }
    public function testauthentInitconfirm401()
    {
        $response = $this->runApp('POST', '//authent/{token}/initconfirm');

        $this->assertEquals(401, $response->getStatusCode());
        $this->assertContains('Unauthorized  List of supported error codes: - 40: Missing credentials - 41: Invalid credentials - 42: Expired credentials', (string)$response->getBody());
    }
    public function testauthentInitconfirm404()
    {
        $response = $this->runApp('POST', '//authent/{token}/initconfirm');

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertContains('Not Found  List of supported error codes: - 60: Resource not found', (string)$response->getBody());
    }
    public function testauthentInitconfirm422()
    {
        $response = $this->runApp('POST', '//authent/{token}/initconfirm');

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertContains('Unprocessable entity  Functional error', (string)$response->getBody());
    }

    /**
     * Test case for authentLogin
     *
     * Get a valid token with credentials..
     *
     */
        
    public function testauthentLogin200()
    {
        $response = $this->runApp('POST', '//authent/login');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Success', (string)$response->getBody());
    }
    public function testauthentLogin400()
    {
        $response = $this->runApp('POST', '//authent/login');

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertContains('Bad Request  List of supported error codes: - 20: Invalid URL parameter value - 21: Missing body - 22: Invalid body - 23: Missing body field - 24: Invalid body field - 25: Missing header - 26: Invalid header value - 27: Missing query-string parameter - 28: Invalid query-string parameter value', (string)$response->getBody());
    }
    public function testauthentLogin401()
    {
        $response = $this->runApp('POST', '//authent/login');

        $this->assertEquals(401, $response->getStatusCode());
        $this->assertContains('Unauthorized  List of supported error codes: - 40: Missing credentials - 41: Invalid credentials - 42: Expired credentials', (string)$response->getBody());
    }
    public function testauthentLogin404()
    {
        $response = $this->runApp('POST', '//authent/login');

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertContains('Not Found  List of supported error codes: - 60: Resource not found', (string)$response->getBody());
    }
    public function testauthentLogin422()
    {
        $response = $this->runApp('POST', '//authent/login');

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertContains('Unprocessable entity  Functional error', (string)$response->getBody());
    }

    /**
     * Test case for authentReset
     *
     * Demande de changement d'un mot de passe utilisateur. (forgot password).
     *
     */
        
    public function testauthentReset200()
    {
        $response = $this->runApp('POST', '//authent/reset');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Success', (string)$response->getBody());
    }
    public function testauthentReset400()
    {
        $response = $this->runApp('POST', '//authent/reset');

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertContains('Bad Request  List of supported error codes: - 20: Invalid URL parameter value - 21: Missing body - 22: Invalid body - 23: Missing body field - 24: Invalid body field - 25: Missing header - 26: Invalid header value - 27: Missing query-string parameter - 28: Invalid query-string parameter value', (string)$response->getBody());
    }
    public function testauthentReset401()
    {
        $response = $this->runApp('POST', '//authent/reset');

        $this->assertEquals(401, $response->getStatusCode());
        $this->assertContains('Unauthorized  List of supported error codes: - 40: Missing credentials - 41: Invalid credentials - 42: Expired credentials', (string)$response->getBody());
    }
    public function testauthentReset404()
    {
        $response = $this->runApp('POST', '//authent/reset');

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertContains('Not Found  List of supported error codes: - 60: Resource not found', (string)$response->getBody());
    }
    public function testauthentReset422()
    {
        $response = $this->runApp('POST', '//authent/reset');

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertContains('Unprocessable entity  Functional error', (string)$response->getBody());
    }

    /**
     * Test case for authentResetconfirm
     *
     * modification du mot de passe d'un utilisateur..
     *
     */
        
    public function testauthentResetconfirm200()
    {
        $response = $this->runApp('POST', '//authent/{token}/resetconfirm');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Success', (string)$response->getBody());
    }
    public function testauthentResetconfirm400()
    {
        $response = $this->runApp('POST', '//authent/{token}/resetconfirm');

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertContains('Bad Request  List of supported error codes: - 20: Invalid URL parameter value - 21: Missing body - 22: Invalid body - 23: Missing body field - 24: Invalid body field - 25: Missing header - 26: Invalid header value - 27: Missing query-string parameter - 28: Invalid query-string parameter value', (string)$response->getBody());
    }
    public function testauthentResetconfirm401()
    {
        $response = $this->runApp('POST', '//authent/{token}/resetconfirm');

        $this->assertEquals(401, $response->getStatusCode());
        $this->assertContains('Unauthorized  List of supported error codes: - 40: Missing credentials - 41: Invalid credentials - 42: Expired credentials', (string)$response->getBody());
    }
    public function testauthentResetconfirm404()
    {
        $response = $this->runApp('POST', '//authent/{token}/resetconfirm');

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertContains('Not Found  List of supported error codes: - 60: Resource not found', (string)$response->getBody());
    }
    public function testauthentResetconfirm422()
    {
        $response = $this->runApp('POST', '//authent/{token}/resetconfirm');

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertContains('Unprocessable entity  Functional error', (string)$response->getBody());
    }
}
