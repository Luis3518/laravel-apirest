<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'luis',
            'email' => 'luis@ex.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'active' => true
        ]);
        User::factory()->count(10)->create();
    }
}
