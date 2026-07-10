<?php
namespace App\Repositories\Interfaces;
use Illuminate\Http\Request;

Interface VivahMitraCategoryRepositoryInterface{
    public function allCategories($data);
    public function storeCategory($request,$data);
    public function findCategory($id);
    public function updateCategory($data, $id);

    /** speciality section */

    // public function allSpecialitySectionList($data);



}
