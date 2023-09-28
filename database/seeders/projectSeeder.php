<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class projectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = [
            'test',
            'henk',
            'pieter',
            'geert',
            'gerda',

        ];
        for ($i = 0; $i < count($arr); $i++) {

            Project::insert(
                [
                    'name' => $arr[$i],
                    'intro' => 'dit is een test',
                    'description' => 'description',
                    'date_started' => date("Y/m/d"),
                    'updated_at' => date("Y/m/d"),
                    'created_at' => date("Y/m/d")
                ]
            );
        }
    }
}
