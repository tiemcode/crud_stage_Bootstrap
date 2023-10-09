<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attribute_product extends Model
{
    use HasFactory;
    protected $table = "product_attribute";
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
}
