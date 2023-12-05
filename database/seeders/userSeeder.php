<?php

namespace Database\Seeders;

use App\Models\user;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    /**
     * The function inserts user data into a database table, creating an admin user and additional
     * users with names and email addresses based on an array.
     */
    public function run(): void
    {
        user::insert([
            'is_admin' => 1,
            'name' => 'admin',
            'email' => 'admin' . "@gmail.com",
            'password' => Hash::make('adminadmin'),
            'updated_at' => date("Y/m/d"),
            'created_at' => date("Y/m/d")
        ],);
        $names = ['ige', 'timo', 'joost'];
        for ($i = 0; $i < count($names); $i++) {
            user::insert(
                [
                    'name' => $names[$i],
                    'email' => $names[$i] . "@gmail.com",
                    'password' => Hash::make($names[$i] . $names[$i]),
                    'updated_at' => date("Y/m/d"),
                    'created_at' => date("Y/m/d")
                ],

            );
        }
    }
}
