<?php

class AuthControllerTest extends TestCase
{
    public function testValidation()
    {
        $this->post('/signup');
        $this->assertEquals(422, $this->response->getStatusCode());
        $this->seeJsonEquals([
            'login' => [
                'The login field is required.',
            ],
            'password' => [
                'The password field is required.',
            ],
        ]);

        $this->post('/signup', ['login' => 'a', 'password' => 'b']);
        $this->assertEquals(422, $this->response->getStatusCode());
        $this->seeJsonEquals([
            'login' => [
                'The login must be at least 4 characters.',
            ],
            'password' => [
                'The password must be at least 6 characters.',
            ],
        ]);
    }

    public function testAuth()
    {
        // registration
        $this->post('/signup', ['login' => 'testname', 'password' => 'testpassword']);
        $this->assertEquals(200, $this->response->getStatusCode());
        $this->seeJsonStructure(['token' => []]);
        // repeated registration (error)
        $this->post('/signup', ['login' => 'testname', 'password' => 'testpassword']);
        $this->assertEquals(422, $this->response->getStatusCode());
        $this->seeJsonEquals([
            'login' => [
                'The login has already been taken.',
            ],
        ]);
        // login with wrong credentials
        $this->post('/signin', ['login' => 'wrong_testname', 'password' => 'wrong_testpassword']);
        $this->assertEquals(401, $this->response->getStatusCode());
        // login successfully
        $this->post('/signin', ['login' => 'testname', 'password' => 'testpassword']);
        $this->assertEquals(200, $this->response->getStatusCode());
        $this->seeJsonStructure(['token' => []]);
    }
}
