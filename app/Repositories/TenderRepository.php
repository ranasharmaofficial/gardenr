<?php
namespace App\Repositories;
use App\Repositories\Interfaces\TenderRepositoryInterface;
use App\Models\Staff;
use App\Models\User;
use App\Models\UserLogin;
use App\Models\Tender;

class TenderRepository implements TenderRepositoryInterface
{
    public function allTender($request){
        // $staffs = User::select('*')->latest()->paginate(10);
        // return $staffs;
        $tenders = Tender::OrderBy('id', 'DESC');
            $tenders = $tenders->paginate(25);
        return $tenders;
    }

    public function storeTenders($data){
        /** save doctor */
        $tender = new Tender();
        $tender->title = $data['title'];
        $tender->details = $data['details'];
        $tender->upload = $data['file'];
        $tender->uploaddate = $data['uploaddate'];
        $tender->save();
    }

    public function findTender($id){
        return $users =  Tender::where('id', $id)->first();
    }

    public function updateTenders($data, $id){

        $tender = Tender::where('id', $id)->first();
        $tender->title = $data['title'];
        $tender->details = $data['details'];
        if($data['file']!=null){
            $tender->upload = $data['file'];
        }
        $tender->save();
    }


}
