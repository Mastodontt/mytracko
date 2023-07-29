<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        $user = User::create([
            'name' => 'Admintest',
            'email' => 'admin.testowy@localhost',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('qwe12345'),
            'role' => UserRole::ADMIN
        ]);

        $user = User::create([
            'name' => 'UserTest',
            'email' => 'user.testowy@localhost',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('qwe12345'),
        ]);

        Post::factory(50)->create();
    }
}
