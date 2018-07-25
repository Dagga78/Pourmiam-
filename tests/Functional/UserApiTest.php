<?php
/**
 * UserApiTest
 * PHP version 5
 *
 * @category Class
 * @package  SwaggerServer
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * API CoBiz
 *
 * No description provided (generated by Swagger Codegen
 * https://github.com/swagger-api/swagger-codegen)
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
 * UserApiTest Class Doc Comment
 *
 * @category Class
 * @package  SwaggerServer
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class UserApiTest extends BaseTestCase
{

    /**
     * Test case for usersGet
     *
     * Get information from my account..
     *
     */

    public function testusersGet()
    {
        $response = $this->runApp('GET', '/user', null, "ABCDEF0123456789");
        $this->assertContains('jano', (string)$response->getBody());
        $this->assertEquals(200, $response->getStatusCode());

    }

    public function testusersGetUnknowsUsers()
    {
        $response = $this->runApp('GET', '/user');

        $this->assertEquals(401, $response->getStatusCode());
    }
}
