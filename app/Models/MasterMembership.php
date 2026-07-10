<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class MasterMembership extends Model
{
    use HasFactory;
    protected $fillable = [
        'membership_number',
        'is_used',
        'member_id',
        'created_by',
        'created_date',
        'vivah_mitra_id',
        'is_old',
    ];

    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap(); //Used for pagination
    }
}
