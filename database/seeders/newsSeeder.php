<?php

namespace Database\Seeders;

// require_once 'vendor/autoload.php';

use App\Models\category;
use App\Models\Post;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class newsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        category::insert(
            [

                [
                    'name' => 'test',
                    'updated_at' => date("Y/m/d"),
                    'created_at' => date("Y/m/d")
                ],
                [
                    'name' => 'henk',
                    'updated_at' => date("Y/m/d"),
                    'created_at' => date("Y/m/d")
                ]
            ]
        );
        $faker = FakerFactory::create();
        for ($i = 0; $i < 24; $i++) {
            Post::insert([
                'title' => $faker->word(),
                'intro' => $faker->sentence(),
                'description' => $faker->text(),
                'category_id' => mt_rand(1, 2),
                'date_posted' => $faker->date(),
                'created_at' => $faker->date(),
                'updated_at' => $faker->date(),
            ]);
        }
    }
}
