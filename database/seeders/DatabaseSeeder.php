<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use App\Models\Profile;
use App\Models\Category;
use App\Models\Permission;
use Illuminate\Support\Str;
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

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal',
        ]);
        Category::create([
            'name' => 'Family',
            'slug' => 'family',
        ]);
        Category::create([
            'name' => 'Hobbies',
            'slug' => 'hobies',
        ]);

        Permission::create([
            'name' => 'Create',
            'slug' => 'create',
        ]);

        Permission::create([
            'name' => 'View',
            'slug' => 'view',
        ]);

         Permission::create([
            'name' => 'Update',
            'slug' => 'update',
        ]);

        Permission::create([
            'name' => 'Delete',
            'slug' => 'delete',
        ]);

        $role = Role::create(['name' => 'Admin','slug'=>'admin']);
        
        foreach (Permission::all() as  $permission) {
            $role->permissions()->attach($permission);
            $role->save();
        }

        $user = User::create([   
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10) 
        ])->each(function($user){
            $post = \App\Models\Post::factory(3)->create(['user_id'=>$user->id,'category_id'=>rand(1,3),'published_at'=>now()]);
            Profile::create(['user_id'=>$user->id]);
            $user->roles()->attach($user->id);
            $user->save();
        });
    }
}
