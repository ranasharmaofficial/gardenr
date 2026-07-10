<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterVendor extends Model
{
    protected $table = 'master_vendors';

    use HasFactory;
    protected $fillable = [
        'owner_name',
        'owner_email',
        'shop_name',
        'gst',
        'state_id',
        'district_id',
        'branch_id',
        'address',
        'status',
    ];
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
