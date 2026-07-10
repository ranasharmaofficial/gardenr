<?php
namespace App\Repositories\Interfaces\WebInterface;
use Illuminate\Http\Request;

Interface MemberRepositoryInterface{
    public function getSpecialityDoctorList($speciality_id);
    
}
