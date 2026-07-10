<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class ManualResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'franchise_id',
        'course_id',
        'subcourse_id',
        'result',
        'passing_year',
        'semester'
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
