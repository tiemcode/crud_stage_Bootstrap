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
    public function run(): void
    {
        $names = ['admin', 'timo', 'joost'];
        for ($i = 0; $i < count($names); $i++) {
            user::insert(
                [
                    'name' => $names[$i],
                    'email' => $names[$i] . "@gmail.com",
                    'password' => Hash::make($names[$i] . $names[$i]),
                    'updated_at' => date("Y/m/d"),
                    'created_at' => date("Y/m/d")
                ]
            );
        }
    }
}
