<?php
namespace App\Repositories\Interfaces;
use Illuminate\Http\Request;

Interface LocationRepositoryInterface{
    public function allSpecialities($data);
    public function storeSpeciality($request,$data);
    public function findSpeciality($id);



}
