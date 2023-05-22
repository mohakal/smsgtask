<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\TestDataSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RentsCheckTest extends TestCase
{
    protected $connections = ['mysql_testing'];
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->seed(TestDataSeeder::class);
        $userId = 14; // Replace with the actual user ID you want to authenticate
        $user=User::find($userId);

        // insert a movie
        $movieId=DB::table('movies')->insertGetId([
            'title' => 'Test',
            'release_year' => 'Test',
            'poster_link'=>'Test',
            'subsciption_type_id'=>'2',
            'rent_period'=>'30',
            'rent_price'=>'10',
        ]);
        $response = $this->actingAs($user,'web')
            ->get('/playmovie/'.$movieId);

        $response->assertViewIs('playmovie');
        $response->assertViewHas('show_movie', false);

        $response = $this->actingAs($user,'web')
            ->get('/rentmovie/'.$movieId);

        $response->assertSessionHas('success', 'Movie Rented!');
        $response = $this->actingAs($user,'web')
            ->get('/playmovie/'.$movieId);

        $response->assertViewIs('playmovie');
        $response->assertViewHas('show_movie', true);
    }
}
