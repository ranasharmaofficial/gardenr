<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class MasterVideo extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_type',
        'user_designation',
        'video_title',
        'video_url',
        'status',
        'created_by'

    ];

    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap(); //Used for pagination
    }
}
