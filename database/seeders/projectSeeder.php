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
        Project::insert([
            'name' => 'Revolutionize Retail: E-commerce Website Redesign',
            'intro' => "In the digital age, having a strong online presence is crucial for businesses of all sizes. As consumers increasingly turn to the internet for their shopping needs, it's imperative that retailers have an engaging and user-friendly e-commerce website. Our project, titled 'Revolutionize Retail: E-commerce Website Redesign,' aims to transform the online shopping experience for both customers and businesses.",
            'description' => "User-Centric Design: We will prioritize user experience (UX) by implementing intuitive navigation, clear product categorization, and a seamless checkout process. Responsive design will ensure a consistent experience across all devices.

            Performance Optimization: Slow loading times and site glitches can deter potential customers. We will optimize the website's performance to ensure fast loading speeds and reliable operation.

            Mobile-Friendly: With the increasing use of smartphones for online shopping, we'll ensure the website is fully mobile-responsive, offering a smooth shopping experience on all screen sizes.",
            'updated_at' => date("Y/m/d"),
            'created_at' => date("Y/m/d")
        ]);
        for ($i = 0; $i < count($arr); $i++) {

            Project::insert(
                [
                    'name' => $arr[$i],
                    'intro' => 'dit is een test',
                    'description' => 'description',
                    'updated_at' => date("Y/m/d"),
                    'created_at' => date("Y/m/d")
                ]
            );
        }
    }
}
