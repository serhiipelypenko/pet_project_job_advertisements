<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): User
    {
        $user = User::create([
           'name' => 'Test User',
           'email' => 'test@test.com',
           'email_verified_at' => Carbon::now(),
           'password' => Hash::make('123123123'),
        ]);

        return $user;
    }
}
