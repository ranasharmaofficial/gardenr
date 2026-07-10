<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'route',
        'icon',
        'permission',
        'parent_id',
        'sort_order',
        'status',
    ];

    //  public function children()
    // {
    //     return $this->hasMany(Menu::class, 'parent_id')->orderBy('sort_order');
    // }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')
                    ->with('children')
                    ->orderBy('sort_order');
    }

     /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap();

        // static::created(function ($post) {
        //     $post->slug = $post->createSlug($post->name);
        //     $post->save();
        // });
    }

    /**
     * create slug
     *
     * @return response()
     */


}
