<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::insert([
            'title' => 'test',
            'description' => 'dit is een test taak voor te testen',
            'finshed' =>  0,
            'project_id' => 1,
            'created_at' => date('y/m/d'),
            'updated_at' => date("Y/m/d"),
        ]);
        DB::table('task_user')->insert([
            'created_at' => date('y/m/d'),
            'updated_at' => date("Y/m/d"),
            'task_id' => 1,
            'user_id' => 1
        ]);
    }
}
