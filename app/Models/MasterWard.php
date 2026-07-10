<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class MasterWard extends Model
{
    use HasFactory;

    protected $fillable = ['panchayat_id','total_ward', 'status'];

    // public function district()
    // {
    //     return $this->belongsTo(District::class, 'district_id','id');
    // }

    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap();
    }
}
