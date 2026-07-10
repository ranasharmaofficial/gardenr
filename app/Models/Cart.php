<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class Cart extends Model
{
    use HasFactory;

     protected $fillable = [
        'session_id',
        'product_id',
        'qty',
        'price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // protected $guarded = [];

      /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap();
    }
}
