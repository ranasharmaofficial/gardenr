<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class UserDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_type',
        'user_id',
        'account_number',
        'ifsc_code',
        'bank_name',
        'branch_name',
        'upi_details',
        'branch',
        'to_city',
        'km1',
        'city',
        'to_village',
        'km2',
        'village',
        'to_home',
        'km3',
        'ward_member_name',
        'near_by',
        'mark_of_identification',
        'aadhar_card',
        'pan_card',
        'driving_license',
        'vehicle_rc',
        'matriculation_marksheet',
        'intermediate_marksheet',
        'graduation_marksheet',
        'security_money',
        'screenshot_of_payment',
        'uniform',
        'shoe',
        'sewing_charge',
        'insurance',
        'coat',
        'training',
        'i_card',
        'reporting_officer',
        'trainer_officer',
        'home_verification_officer',
        'junior_office_employee',
        'staff_incentive',
        'status'

    ];

    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap(); //Used for pagination
    }
}
