<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class PhysicalCardGiven extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'card',
        'date',
        'remarks'
    ];

    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap(); //Used for pagination
    }
}
