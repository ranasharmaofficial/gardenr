<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class AdmitCard extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'session',
    //     'student_id',
    //     'franchise_id',
    //     'course_id',
    //     'subcourse_id',
    //     'result',
    //     'passing_year',
    //     'semester',
    //     'total_marks_obtained',
    //     'total_percentage',
    //     'examination',
    // ];

    protected $guarded = [];

      /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap();
    }
}
