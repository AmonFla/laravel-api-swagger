<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; 

class LoginTest extends TestCase
{
    use RefreshDatabase;

    private function registerUser(){
        $data = [
            "name"=>"Test User",
            "email"=> "test@email.com",
            "password"=>"123456"
        ];

        $this->json('POST', '/api/register', $data);
    }

    /**
     * Unregistered user  login
     * 
     * @return void
     */
    public function testUnRegisterUser(){
        $data = [       
            "email"=> "test@email.com",
            "password"=>"123456"
        ];

        $response = $this->json('POST', '/api/login', $data);
        $response->assertStatus(404);
        $response->assertJson(["success"=>false, "message"=>"Unauthorised."]);
    }

    /**
     * Registered user  login
     * 
     * @return void
     */
    public function testRegisterUser(){

        $this->registerUser();

        $data = [       
            "email"=> "test@email.com",
            "password"=>"123456"
        ];

        $response = $this->json('POST', '/api/login', $data);
        $response->assertStatus(200);
        $response->assertJson(["success"=>true, "message"=>"User login successfully."]);
    }

    /**
     * Wrong data email
     *
     * @return void
     */
    public function testRegisterUserWrongFieldEmail(){
        
        $this->registerUser();

        $data = [ 
            "emai"=> "test@email.com",
            "password"=>"123456"
        ];

        $response = $this->json('POST', '/api/login', $data);
        $response->assertStatus(404);
        $response->assertJson(["success"=>false, "message"=>"Unauthorised."]);
    }
}
