<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class DoctorVisit extends Model
{
    protected $table = 'doctor_visits';
    protected $fillable = [
        'doctor_id',
        'visit_date',
        'visit_time',
        'remarks',
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
