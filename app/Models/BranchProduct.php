<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;

class BranchProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'branch_id',
        'transfer_date',
        'category',
        'product_id',
        'price',
        'offer_price',
        'transferred_by',
        'stock',
        'price_45',
        'price_50',
        'price_62',
        'price_80',
    ];

     /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap();
    }

    /**
     * create slug
     *
     * @return response()
     */


}
