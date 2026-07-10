<?php
namespace App\Repositories\Interfaces;

Interface VisitRepositoryInterface{
    public function allTender($request);
    public function storeVisitDoctors($data);
    public function findStaff($id);
    public function updateStaff($data, $id);
}
