<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table =  'orders';
    public function address()
    {
        return $this->belongsTo(address::class);
    }
    public function orderProduct()
    {
        return $this->belongsTo(Order_product::class);
    }
}
