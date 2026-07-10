<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;

class VivahmitraProductImage extends Model
{
    use HasFactory;
    protected $table = 'vivahmitra_product_images';

    protected $fillable = [
        'product_id',
        'image_path',
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
    public function product()
    {
        return $this->belongsTo(VivahmitraProduct::class);
    }

}
