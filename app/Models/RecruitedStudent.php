<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;

class RecruitedStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'status',
        'course',
        'franchise_code',
        'job_sector',
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
