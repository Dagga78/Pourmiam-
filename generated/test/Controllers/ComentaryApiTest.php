<?php
/**
 * ComentaryApiTest
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
 * ComentaryApiTest Class Doc Comment
 *
 * @category Class
 * @package  SwaggerServer
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ComentaryApiTest extends BaseTestCase
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
     * Test case for comentaryCreate
     *
     * create a commentary.
     *
     */
        
    public function testcomentaryCreate200()
    {
        $response = $this->runApp('POST', '//comentary',[$comentary => '',]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Success', (string)$response->getBody());
    }
    public function testcomentaryCreate400()
    {
        $response = $this->runApp('POST', '//comentary',[$comentary => '',]);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertContains('Bad Request  List of supported error codes: - 20: Invalid URL parameter value - 21: Missing body - 22: Invalid body - 23: Missing body field - 24: Invalid body field - 25: Missing header - 26: Invalid header value - 27: Missing query-string parameter - 28: Invalid query-string parameter value', (string)$response->getBody());
    }
    public function testcomentaryCreate401()
    {
        $response = $this->runApp('POST', '//comentary',[$comentary => '',]);

        $this->assertEquals(401, $response->getStatusCode());
        $this->assertContains('Unauthorized  List of supported error codes: - 40: Missing credentials - 41: Invalid credentials - 42: Expired credentials', (string)$response->getBody());
    }
    public function testcomentaryCreate404()
    {
        $response = $this->runApp('POST', '//comentary',[$comentary => '',]);

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertContains('Not Found  List of supported error codes: - 60: Resource not found', (string)$response->getBody());
    }
    public function testcomentaryCreate422()
    {
        $response = $this->runApp('POST', '//comentary',[$comentary => '',]);

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertContains('Unprocessable entity  Functional error', (string)$response->getBody());
    }

    /**
     * Test case for comentaryDelete
     *
     * delete a comentary.
     *
     */
        
    public function testcomentaryDelete200()
    {
        $response = $this->runApp('DELETE', '//comentary/{comentaryId}');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Success', (string)$response->getBody());
    }
    public function testcomentaryDelete400()
    {
        $response = $this->runApp('DELETE', '//comentary/{comentaryId}');

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertContains('Bad Request  List of supported error codes: - 20: Invalid URL parameter value - 21: Missing body - 22: Invalid body - 23: Missing body field - 24: Invalid body field - 25: Missing header - 26: Invalid header value - 27: Missing query-string parameter - 28: Invalid query-string parameter value', (string)$response->getBody());
    }
    public function testcomentaryDelete401()
    {
        $response = $this->runApp('DELETE', '//comentary/{comentaryId}');

        $this->assertEquals(401, $response->getStatusCode());
        $this->assertContains('Unauthorized  List of supported error codes: - 40: Missing credentials - 41: Invalid credentials - 42: Expired credentials', (string)$response->getBody());
    }
    public function testcomentaryDelete404()
    {
        $response = $this->runApp('DELETE', '//comentary/{comentaryId}');

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertContains('Not Found  List of supported error codes: - 60: Resource not found', (string)$response->getBody());
    }
    public function testcomentaryDelete422()
    {
        $response = $this->runApp('DELETE', '//comentary/{comentaryId}');

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertContains('Unprocessable entity  Functional error', (string)$response->getBody());
    }

    /**
     * Test case for comentaryFind
     *
     * find comentary.
     *
     */
        
    public function testcomentaryFind200()
    {
        $response = $this->runApp('GET', '//comentary');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Success', (string)$response->getBody());
    }
    public function testcomentaryFind400()
    {
        $response = $this->runApp('GET', '//comentary');

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertContains('Bad Request  List of supported error codes: - 20: Invalid URL parameter value - 21: Missing body - 22: Invalid body - 23: Missing body field - 24: Invalid body field - 25: Missing header - 26: Invalid header value - 27: Missing query-string parameter - 28: Invalid query-string parameter value', (string)$response->getBody());
    }
    public function testcomentaryFind401()
    {
        $response = $this->runApp('GET', '//comentary');

        $this->assertEquals(401, $response->getStatusCode());
        $this->assertContains('Unauthorized  List of supported error codes: - 40: Missing credentials - 41: Invalid credentials - 42: Expired credentials', (string)$response->getBody());
    }
    public function testcomentaryFind404()
    {
        $response = $this->runApp('GET', '//comentary');

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertContains('Not Found  List of supported error codes: - 60: Resource not found', (string)$response->getBody());
    }
    public function testcomentaryFind422()
    {
        $response = $this->runApp('GET', '//comentary');

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertContains('Unprocessable entity  Functional error', (string)$response->getBody());
    }

    /**
     * Test case for comentaryUpdate
     *
     * Update a comentary.
     *
     */
        
    public function testcomentaryUpdate200()
    {
        $response = $this->runApp('PUT', '//comentary/{comentaryId}',[$comentary => '',]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Success', (string)$response->getBody());
    }
    public function testcomentaryUpdate400()
    {
        $response = $this->runApp('PUT', '//comentary/{comentaryId}',[$comentary => '',]);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertContains('Bad Request  List of supported error codes: - 20: Invalid URL parameter value - 21: Missing body - 22: Invalid body - 23: Missing body field - 24: Invalid body field - 25: Missing header - 26: Invalid header value - 27: Missing query-string parameter - 28: Invalid query-string parameter value', (string)$response->getBody());
    }
    public function testcomentaryUpdate401()
    {
        $response = $this->runApp('PUT', '//comentary/{comentaryId}',[$comentary => '',]);

        $this->assertEquals(401, $response->getStatusCode());
        $this->assertContains('Unauthorized  List of supported error codes: - 40: Missing credentials - 41: Invalid credentials - 42: Expired credentials', (string)$response->getBody());
    }
    public function testcomentaryUpdate404()
    {
        $response = $this->runApp('PUT', '//comentary/{comentaryId}',[$comentary => '',]);

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertContains('Not Found  List of supported error codes: - 60: Resource not found', (string)$response->getBody());
    }
    public function testcomentaryUpdate422()
    {
        $response = $this->runApp('PUT', '//comentary/{comentaryId}',[$comentary => '',]);

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertContains('Unprocessable entity  Functional error', (string)$response->getBody());
    }
}
