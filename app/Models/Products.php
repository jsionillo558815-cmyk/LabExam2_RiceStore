<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
     protected $table = 'products';
     protected $fillable = [
        'rice_name',
        'price_per_kilo',
        'stock_per_kilo',
        'description',
    ];

    public function orders()
    {
        return $this->hasMany(Orders::class);
    }
}
