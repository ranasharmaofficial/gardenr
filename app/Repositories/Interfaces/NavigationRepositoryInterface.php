<?php
namespace App\Repositories\Interfaces;
use Illuminate\Http\Request;

Interface NavigationRepositoryInterface{
    public function allNavigations($data);
    public function storeNavigation($request,$data);
    public function findNavigation($id);
    public function updateNavigation($data, $id);

    /** speciality section */

    // public function allSpecialitySectionList($data);



}
