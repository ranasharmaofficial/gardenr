<?php
namespace App\Repositories\Interfaces;
use Illuminate\Http\Request;

Interface BrandRepositoryInterface{
    public function allBrand($data);
    public function storeBrand($request,$data);
    public function findBrand($id);
    public function updateBrand($data, $id);

    /** speciality section */

    // public function allSpecialitySectionList($data);



}
