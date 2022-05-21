<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'zay@admin.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
            ]
        ];

        User::insert($users);
    }
}
