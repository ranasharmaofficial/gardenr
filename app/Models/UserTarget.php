<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;

class UserTarget extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'target_count',
        'duration_days',
        'start_date',
        'end_date',
        'amount',
        'message',
        'is_achieved'
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
