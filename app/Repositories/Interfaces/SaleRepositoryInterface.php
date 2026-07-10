<?php
namespace App\Repositories\Interfaces;

Interface SaleRepositoryInterface{
    public function allStaffs($request);
    public function storeStaff($data);
    public function findStaff($id);
    public function updateStaff($data, $id);
}
