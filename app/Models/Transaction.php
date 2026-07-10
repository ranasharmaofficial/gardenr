<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'paying_area',
        'utr_no',
        'screenshot',
        'amount',
        'commission',
        'admin_charge',
        'maintenance',
        'total_amount',
        'type',
        'status',
        'paid_by',
        'created_at',
        'updated_at',
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
