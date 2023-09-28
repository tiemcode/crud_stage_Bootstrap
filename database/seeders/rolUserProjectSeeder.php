<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class rolUserProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 3; $i++) {
            # code...
            DB::table('project_user')->insert([
                'updated_at' => date("Y/m/d"),
                'created_at' => date("Y/m/d"),
                'project_id' => 1,
                'user_id' => $i,
                'role_id' => $i
            ]);
        }
    }
}
