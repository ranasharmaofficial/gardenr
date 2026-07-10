<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class UserAssignedVideo extends Model
{
    use HasFactory;
    protected $fillable = [
        'video_id',
        'user_id',
        'assigned_date',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap(); //Used for pagination
    }
}
