<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserDeleteTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_delete_user_api_should_return_200_on_successful_delete()
    {
        $user = User::factory()->create();
        // in the db
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);
        
        $response = $this->delete('/api/user/'. $user->id );
        // !in the db
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);

        $response->assertStatus(200);
    }
}
