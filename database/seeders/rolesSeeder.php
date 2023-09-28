<?php

namespace Database\Seeders;

use App\Models\roles;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class rolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = ['beheeder', 'developer', 'designer'];
        for ($i = 0; $i < count($arr); $i++) {
            roles::insert(
                [
                    'name' => $arr[$i],
                    'created_at' => date('y/m/d'),
                    'updated_at' => date("Y/m/d"),
                ]
            );
        }
    }
}
