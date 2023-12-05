<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Order;
use App\Models\Order_product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class orderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::insert([
            'email' => 'admin@gmail.com',
            'phoneNumber' => '123456789',
            'user_id' => 1,
            'total_excl' => '100',
            'vat' => '21',
            'total_incl' => '121',
        ]);
        Order_product::insert([
            'order_id' => 1,
            'product_id' => 1,
            'amount' => 1,
            'price_excl' => '100',
            'vat' => '21',
            'price_incl' => '121',
        ]);
        Address::insert([
            'type' => 'billing',
            'firstName' => 'firstName',
            'lastName' => 'lastName',
            'address' => 'street',
            'zipCode' => '1234AB',
            'city' => 'city',
            'order_id' => 1,
        ]);
    }
}
