<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Likes;
use App\Models\Views;
use App\Models\Comments;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(400)->create();
        // Comments::factory(2399)->create();
        // Likes::factory(2822)->create();
        // Views::factory(3106)->create();
        // Admin::factory(10)->create();
        // Post::factory(153)->create();

        //seeding the super user .
        // Admin::create([
        //     'status'=>'active',
        //     'fullname'=>'Haitham Alabdullah',
        //     'username'=>'Mocha16995',
        //     'position'=>'Super Admin',
        //     'email'=>'haithamahmad16995@gmail.com',
        //     'phone'=>'0548765456',
        //     'password'=>Hash::make('12345678'),
        // ]);
    }
}
