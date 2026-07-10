<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Pagination\Paginator;
use App\Models\Attendance;
use App\Models\District;
use App\Models\MasterShop;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
        'role',
        'kyc_status',
        'first_name',
        'last_name',
        'mobile',
        'email',
        'status',
        'user_type_id',
        'user_designation_id',
        'ip_address',
        'institute_name',
        'state',
        'city',
        'block',
        'panchayat',
        'ward_no',
        'pincode',
        'director_higher_qualifications',
        'center_photo',
        'director_photo',
        'aadhar_card',
        'course_id',
        'in_time',
        'parent_id',
        'box_key',
        'block_reason',
        'block_date',
        'block_by',
        'unblock_reason',
        'unblock_date',
        'unblock_by',
        'profile_pic',
        'signature',
        'verify_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        Paginator::useBootstrap(); //Used for pagination
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function districts()
    {
        return $this->belongsToMany(District::class, 'user_districts');
    }

    public function shops()
    {
        return $this->belongsToMany(MasterShop::class, 'user_shops');
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
