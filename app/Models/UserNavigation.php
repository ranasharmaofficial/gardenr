<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
class UserNavigation extends Model
{
    use HasFactory;
     protected $table = 'user_navigations';
    protected $fillable = [
        'user_id',
        'nav_id',
        'added_on',
        'status',
    ];

    // public function children()
    // {
    //     return $this->hasMany(Menu::class, 'parent_id')
    //                 ->with('children')
    //                 ->orderBy('sort_order');
    // }

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
