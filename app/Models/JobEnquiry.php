<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class JobEnquiry extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        // 'gender',
        'resume',
        'message',
        'status',
        'city',
        'post',
        'pincode',
    ];

     /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap();
    }

}
