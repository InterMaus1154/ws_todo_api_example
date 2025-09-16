<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $user = User::factory()->create([
            'username' => 'johndoe',
            'password' => 'password123'
        ]);

        $user->categories()->create([
           'category_name' => 'Work'
        ]);

        $user->categories()->create([
            'category_name' => 'School'
        ]);

        $user->categories()->create([
            'category_name' => 'Garden'
        ]);

        $user->categories()->create([
            'category_name' => 'Family'
        ]);

        $user->categories()->create([
            'category_name' => 'Leisure'
        ]);

        $user->categories()->create([
           'category_name' => 'House'
        ]);
    }
}
