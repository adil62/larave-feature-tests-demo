<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_should_return_200_on_valid_creds()
    {
        $user = User::factory()->create();
      
        $response = $this->put('/api/user/'. $user->id, [
            'name' => 'testEDT',
            'email' => 'testEDT@example.com',
            'password' => '12345678',
        ]);
 
        $response->assertStatus(200); 
        $response->assertJson([
            'user' => [
                'name' => 'testEDT',
                'email' => 'testEDT@example.com',     
            ],
            'message' => 'success'
        ]); 
    }
}
