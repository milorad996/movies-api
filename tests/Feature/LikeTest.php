<?php

namespace Tests\Feature;

use App\Models\Like;
use App\Models\User;
use Error;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class LikeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
       $response[] = $this->postJson('/api/login',[
        "email" => "mips@gmail.com",
        "password" => "milorad123"
       ])->assertOk();
    
       
    
      $response = $this->postJson('/api/movies/3/likes',[
        "likes" => [
            "like" => 1
        ]
      ]);
      $id = Auth::user()->id;

      $like = Like::with('user','movie')->where(['user_id' => $id, 'movie_id' => 3,'like' => true])->get();
      
    
      if($like->isEmpty()){
        throw new Error("You have already liked");
      }
      $response->assertStatus(200);

      
      
    
    }

    
}
