<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('P@sser123'),
            'created_at' => now(),
            'updated_at' => now(),
            'role' =>'superadmin',
            'salle_id' => null
        ]);
    }
}
