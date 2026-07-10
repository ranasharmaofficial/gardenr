<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class Country extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap(); //Used for pagination
    }
}
