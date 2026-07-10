<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;

class EWallet extends Model
{
    use HasFactory;
    protected $table = 'e_wallets';

    protected $fillable = [
        'owner_type',
        'owner_id',
        'balance',
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
