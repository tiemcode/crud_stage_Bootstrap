<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [
        'name',
        'description',
        'price',
        'vat',
        'image',
        'category_id',
    ];
    public function attribute_product()
    {
        return $this->hasMany(attribute_product::class);
    }
    public function order_product()
    {
        return $this->belongsTo(Order_product::class);
    }
}
