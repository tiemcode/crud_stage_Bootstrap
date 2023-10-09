<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\attribute_product;
use App\Models\Product;
use Illuminate\Database\Seeder;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = ['gewicht', 'hoogte', 'lengte', 'breedte', 'kleur'];
        $arr2 = ['brood', 'kaas', 'fiets'];
        for ($i = 0; $i < count($arr2); $i++) {
            Product::insert(
                [
                    'title' => $arr2[$i],
                    'description' => 'een kalou lekker ' . $arr2[$i],
                    'stock' => 10,
                    'price' => 10,
                    'vat' => 9,
                    'img' => 'img-placeholder.png',
                    'updated_at' => date("Y/m/d"),
                    'created_at' => date("Y/m/d")
                ]
            );
        }
        for ($i = 0; $i < count($arr); $i++) {
            # code...
            Attribute::insert(
                [
                    'title' => $arr[$i],
                    'updated_at' => date("Y/m/d"),
                    'created_at' => date("Y/m/d")
                ]
            );
        }
        attribute_product::insert(
            [
                'attribute_id' => 1,
                'product_id' => 1,
                'value' => '500g',
                'updated_at' => date("Y/m/d"),
                'created_at' => date("Y/m/d")
            ]
        );
    }
}
