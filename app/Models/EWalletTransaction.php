<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;

class EWalletTransaction extends Model
{
    use HasFactory;
    protected $table = 'e_wallet_transactions';

    protected $fillable = [
        'wallet_id',
        'type',
        'amount',
        'balance_after',
        'remarks',
        'credit_type',
        'district',
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
    /**
     * Get the product that owns the image.
     */


}
