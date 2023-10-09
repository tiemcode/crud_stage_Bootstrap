<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $table = "attributes";
    public function attribute_product()
    {
        return $this->hasMany(attribute_product::class);
    }
    

}
