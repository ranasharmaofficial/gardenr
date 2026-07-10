<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;

class BranchWallet extends Model
{
    use HasFactory;
    protected $table = 'branch_wallets';

    protected $fillable = [
        'company_id',
        'branch_id',
        'type',
        'current_balance',
        'added_date',
        'remarks',
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
