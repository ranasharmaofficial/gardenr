<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use App\Models\User;

class HomeMeetingDetail extends Model
{
    use HasFactory;
    protected $table = 'home_meeting_details';

    protected $fillable = [
        'photo1','photo2','training_place','training_address','district_name',
        'training_date','start_time','end_time','supported_by',
        'total_vivah_mitra','total_panchayat_mitra',
        'total_block_vivah_mitra','total_district_vivah_mitra'
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
