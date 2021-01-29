<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserReadTest extends TestCase
{
    use RefreshDatabase;

    // single user listing api
    public function test_show_user_api_should_return_200_with_userprop()
    {
        $user = User::factory()->create();
        
        $response = $this->get('/api/user/'. $user->id );

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
   
    public function test_show_user_api_should_return_empty_obj_for_inexisting_user()
    {
        $response = $this->get('/api/user/'. 22);

        $response->assertStatus(200);
        $response->assertJson([]);
    }
    
    // all user listing api
    public function test_all_users_api_should_return_all_users()
    {
        $users = User::factory()->count(3)->create();

        $response = $this->get('/api/user');

        $response->assertStatus(200);
        $response->assertJson($users->toArray());
    }
    
    public function test_all_user_api_should_return_empty_obj_for_empty_users_table()
    {
        $response = $this->get('/api/user');

        $response->assertStatus(200);
        $response->assertJson([]);
    }
}
