<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use App\Models\User;

class KitStock extends Model
{
    use HasFactory;
     protected $fillable = ['user_id','quantity'];

     public function user()
    {
        return $this->belongsTo(User::class);
    }
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
