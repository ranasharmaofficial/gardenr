<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class SaleItem extends Model
{
    use HasFactory;
    protected $table = 'sale_items';

    protected $fillable = [
        'sale_id',
        'product_id',
        'price',
        'offer_price',
        'quantity',
        'total',
        'created_at',
        'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap(); //Used for pagination
    }
}
