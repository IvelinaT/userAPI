<?php

namespace User\Test;

use \User\Test\BaseTestCase;


class UsersTest extends BaseTestCase
{



    /** @test */
    public function check_CRUD_cycle()
    {

        $payload = [
          'forename' => 'Ivelina',
          'surname' => 'Trifonova',
          'email' =>'ivelina_trifonova@yahoo.com'
        ];


        $response = $this->request('POST', '/users', $payload);
        $body = json_decode((string)$response->getBody(), true);

        $newUserId = $body['data']['id'];
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertArrayHasKey('id', $body['data']);
        $this->assertArrayHasKey('forename', $body['data']);
        $this->assertArrayHasKey('surname', $body['data']);
        $this->assertArrayHasKey('email', $body['data']);

        $response = $this->runApp('GET', '/users');
        $this->assertEquals(200, $response->getStatusCode());


        $response = $this->runApp('GET', '/users/'.$newUserId);
        $body = json_decode((string)$response->getBody(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('ivelina_trifonova@yahoo.com', $body['data']['email']);

        $response = $this->runApp('DELETE', '/users/'.$newUserId);
        $this->assertEquals(204, $response->getStatusCode());

    }


    /** @test */
    public function create_new_user_require_email()
    {
        $payload = [
            'forename' => 'Ivelina',
            'surname' => 'Trifonova'
        ];

        $response = $this->request('POST', '/users', $payload);

        $body = json_decode((string)$response->getBody(), true);

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertArrayHasKey('email', $body['errors']);


    }

    /** @test */
    public function create_new_user_require_forename()
    {
        $payload = [
            'surname' => 'Trifonova',
            'email' => 'ivelina_trifonova@yahoo.com'
        ];

        $response = $this->request('POST', '/users', $payload);

        $body = json_decode((string)$response->getBody(), true);

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertArrayHasKey('forename', $body['errors']);

    }
    /** @test */
    public function create_new_user_require_surname()
    {
        $payload = [
          'forename' => 'Ivelina',
          'email' => 'ivelina_trifonova@yahoo.com'
        ];

        $response = $this->request('POST', '/users', $payload);

        $body = json_decode((string)$response->getBody(), true);

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertArrayHasKey('surname', $body['errors']);

    }


}