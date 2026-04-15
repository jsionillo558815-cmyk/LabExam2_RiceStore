<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    protected $fillable = ['rice_name', 'quantity', 'price_per_kilo', 'total_amount', 'products_id'];


    public function product()
    {
        return $this->belongsTo(Products::class, 'products_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'order_id');
    }
}
