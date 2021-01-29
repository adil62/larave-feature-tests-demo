<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCreateTest extends TestCase
{
    use RefreshDatabase;
 
    public function test_create_api_should_return_200_on_valid_creds()
    {
        $response = $this->post('/api/user', [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => '12345678',
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            'user' => [
                'name' => 'test',
                'email' => 'test@example.com',     
            ],
            'message' => 'success'
        ]); 
    }

    public function test_create_api_should_return_400_on_missing_fields()
    {
        // omitted email field
        $response = $this->post('/api/user', [
            'name' => 'test',
            'password' => '12345678',
        ]);
        $response->assertStatus(400);
    }
}
