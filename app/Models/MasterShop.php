<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class MasterShop extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'investor_name',
        'opening_date',
        'shop_age',
        'stock',
        'profit',
        'shop_status',
        'created_by'

    ];

    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap(); //Used for pagination
    }
}
