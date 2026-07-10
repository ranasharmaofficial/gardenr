<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class MasterInvestor extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'percentage',
        'status',
        'created_by'

    ];

    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap(); //Used for pagination
    }
}
