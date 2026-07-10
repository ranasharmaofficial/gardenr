<?php
namespace App\Repositories\Interfaces;

Interface TenderRepositoryInterface{
    public function allTender($request);
    public function storeTenders($data);
    public function findTender($id);
    public function updateTenders($data, $id);
}
