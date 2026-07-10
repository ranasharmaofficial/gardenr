<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'sales';

    protected $fillable = [
        'sale_type',
        'branch',
        'employee_id',
        'vivah_mitra_id',
        'panchayat_vivah_mitra',
        'prakhand_vivah_mitra',
        'district_vivah_mitra',
        'sales_manager',
        'assistant_sales_manager',
        'field_officer',
        'zonal_manager',
        'peon',
        'member_id',
        'sale_date',
        'total_amount',
        'incentive_amount',
        'created_at',
        'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap(); //Used for pagination
    }
}
