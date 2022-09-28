<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Category::create([
        //     'name' => 'Personal',
        //     'slug' => 'personal',
        // ]);
        // Category::create([
        //     'name' => 'Family',
        //     'slug' => 'family',
        // ]);
        // Category::create([
        //     'name' => 'Hobbies',
        //     'slug' => 'hobies',
        // ]);
        $user = \App\Models\User::factory(2)->create()->each(function($user){
            $post = \App\Models\Post::factory(3)->create(['user_id'=>$user->id,'category_id'=>rand(1,3)]);
        });
    }
}
