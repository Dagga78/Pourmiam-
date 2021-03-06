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
 * API CoBiz
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


    public function testauthentLogin()
    {
        $response = $this->runApp('POST', '/authent/login', [
            'email' => 'jano@lapin.net',
            'password' => 'jano'
        ]);
        $this->assertContains('token', (string)$response->getBody());
        $this->assertEquals(200, $response->getStatusCode());

    }

    public function testauthentLoginNoParams()
    {
        $response = $this->runApp('POST', '/authent/login');

        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testauthentLoginWrongPwd()
    {
        $response = $this->runApp('POST', '/authent/login', [
            'email' => 'jano@lapin.net',
            'password' => 'guest'
        ]);

        $this->assertEquals(401, $response->getStatusCode());
    }

    public function testauthentLoginWrongParam()
    {
        $response = $this->runApp('POST', '/authent/login', [
            'emil' => 'jano@lapin.net',
            'password' => 'guest'
        ]);

        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testauthentLoginUnknownUser()
    {
        $response = $this->runApp('POST', '/authent/login', [
            'email' => 'hacker@root-me.org',
            'password' => 'guesswhat'
        ]);

        $this->assertEquals(401, $response->getStatusCode());
    }

    public function testauthentReset()
    {
        $response = $this->runApp('POST', '/authent/reset', ['email' => 'jano@lapin.net']);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testauthentResetWrongEmail()
    {
        $response = $this->runApp('POST', '/authent/reset', ['email' => 'janete@lapin.net']);

        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testauthentResetNoParams()
    {
        $response = $this->runApp('POST', '/authent/reset');

        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testauthentResetWrongParams()
    {
        $response = $this->runApp('POST', '/authent/reset', ['emil' => 'jano@lapin.net']);

        $this->assertEquals(400, $response->getStatusCode());
    }

    /**
     * Test case for authentResetconfirm
     *
     * Update password after reset.
     *
     */

    public function testauthentResetconfirm()
    {
        $response = $this->runApp('POST', '/authent/reset/b74855e085e4e3b3/confirm', ['password' => 'jjoo']);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testauthentResetconfirmWrongURL()
    {
        $response = $this->runApp('POST', '/authent/reset/3210EXPIRESET/confirm', ['password' => 'jojo']);

        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testauthentResetconfirmNoParams()
    {
        $response = $this->runApp('POST', '/authent/reset/RESETNOEXPI0123/confirm', ['password' => '']);

        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testauthentResetconfirmWrongParams()
    {
        $response = $this->runApp('POST', '/authent/reset/RESETNOEXPI0123/confirm', ['pasword' => 'jjoo']);

        $this->assertEquals(400, $response->getStatusCode());
    }


    public function testauthentInit()
    {
        $response = $this->runApp('POST', '/authent/init', [
            'firstname' => 'Anakin',
            'lastname' => 'Skywalker',
            'email' => 'luke@gmail.com',
            'password' => 'guest'
        ]);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testauthentInitNoParams()
    {
        $response = $this->runApp('POST', '/authent/init');

        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testauthentInitWrongParams()
    {
        $response = $this->runApp('POST', '/authent/init', [
            'firtname' => 'Luke',
            'lastname' => 'Skywalker',
            'email' => 'luke@skywalker.net',
            'password' => 'guest'
        ]);

        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testauthentInitDuplicateUser()
    {
        $response = $this->runApp('POST', '/authent/init', [
            'firstname' => 'jano',
            'lastname' => 'lapin',
            'email' => 'jano@lapin.net',
            'password' => 'guest'
        ]);

        $this->assertEquals(422, $response->getStatusCode());
    }

    public function testauthentConfirm()
    {
        $response = $this->runApp('POST', '/authent/init/ABCDEF0123456789/confirm');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testauthentConfirmWrongURL()
    {
        $response = $this->runApp('POST', '/authent/init/FalseToken/confirm');

        $this->assertEquals(404, $response->getStatusCode());
    }
}
