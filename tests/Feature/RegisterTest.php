<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    private function registerUser(){
        $data = [
            "name"=>"Test User",
            "email"=> "test4@email.com",
            "password"=>"123456"
        ];

        $this->json('POST', '/api/register', $data);
    }

    /**
     * Adding user to the API
     *
     * @return void
     */
    public function testRegisterUser(){
        $data = [
            "name"=>"Test User",
            "email"=> "test4@email.com",
            "password"=>"123456"
        ];

        $response = $this->json('POST', '/api/register', $data);
        $response->assertStatus(200);
        $response->assertJson(["success"=>true, "message"=>"User register successfully."]);
    }

    /**
     * Adding same user to the API
     *
     * @return void
     */
    public function testRegisterSameUser(){
        $this->registerUser();
        
        $data = [
            "name"=>"Test User",
            "email"=> "test4@email.com",
            "password"=>"123456"
        ];

        $response = $this->json('POST', '/api/register', $data);
        $response->assertStatus(400);
        $response->assertJson(["success"=>false, "message"=>"Email already in use"]);
    }

    /**
     * Wrong data name
     *
     * @return void
     */
    public function testRegisterWrongDataName(){
        $data = [
            "nam"=>"Test User",
            "email"=> "test4@email.com",
            "password"=>"123456"
        ];

        $response = $this->json('POST', '/api/register', $data);
        $response->assertStatus(404);
        $response->assertJson(["success"=>false, "message"=>"Validation Error."]);
    }

    /**
     * Wrong data email
     *
     * @return void
     */
    public function testRegisterWrongDataEmail(){
        $data = [
            "name"=>"Test User",
            "emai"=> "test4@email.com",
            "password"=>"123456"
        ];

        $response = $this->json('POST', '/api/register', $data);
        $response->assertStatus(404);
        $response->assertJson(["success"=>false, "message"=>"Validation Error."]);
    }

    /**
     * Wrong data name
     *
     * @return void
     */
    public function testRegisterWrongDataPassword(){
        $data = [
            "name"=>"Test User",
            "email"=> "test4@email.com",
            "passwor"=>"123456"
        ];

        $response = $this->json('POST', '/api/register', $data);
        $response->assertStatus(404);
        $response->assertJson(["success"=>false, "message"=>"Validation Error."]);
    }

    /**
     * Wrong email format
     *
     * @return void
     */
    public function testRegisterWrongEmail(){
        $data = [
            "name"=>"Test User",
            "email"=> "test4email.com",
            "password"=>"123456"
        ];

        $response = $this->json('POST', '/api/register', $data);
        $response->assertStatus(404);
        $response->assertJson(["success"=>false, "message"=>"Validation Error."]);
    }
}
