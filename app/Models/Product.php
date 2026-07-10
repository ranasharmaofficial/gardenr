<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
Use App\Models\ProductCategory;
Use App\Models\Brand;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'brand_id',
        'product_weight',
        'product_unit',
        'name',
        'slug',
        'short_description',
        'description',
        'plant_care',
        'additional_information',
        'price',
        'offer_price',
        'tax',
        'stock_quantity',
        // 'stock_status',
        'stock_status',
        'sku',
        'thumbnail',
        'images',
        'weight',
        'length',
        'width',
        'height',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'is_featured',
        'is_new',
        'is_best_seller',
        'num_of_sale',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
        'purchase_price',
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

        static::created(function ($post) {
            $post->slug = $post->createSlug($post->name);
            $post->save();
        });
    }

    private function createSlug($name)
    {
        if (static::whereSlug($slug = Str::slug($name))->exists()) {
            $max = static::where('name', $name)->latest('id')->skip(1)->value('slug');
            if ($max && isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }

            return "{$slug}-2";
        }

        return $slug;
    }


    public function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 2;

        while (static::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    // public function attributeValues()
    // {
    //     return $this->belongsToMany(AttributeValue::class, 'product_attribute_values', 'product_id', 'attribute_value_id');
    // }


    // public function variations()
    // {
    //     return $this->hasMany(ProductVariation::class);
    // }



}
