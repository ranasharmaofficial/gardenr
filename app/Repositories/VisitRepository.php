<?php
namespace App\Repositories;
use App\Repositories\Interfaces\VisitRepositoryInterface;
use App\Models\Staff;
use App\Models\User;
use App\Models\UserLogin;
use App\Models\DoctorVisit;

class VisitRepository implements VisitRepositoryInterface
{
    public function allVisits($request){
        // $staffs = User::select('*')->latest()->paginate(10);
        // return $staffs;
        $users = User::where('users.id', '!=', 1)->where('users.user_type_id', 4)->select('users.*', 'dv.remarks', 'dv.picture', 'dv.visit_date', 'dv.visit_time')
            ->leftJoin('doctor_visits as dv', 'dv.doctor_id', '=', 'users.id');
            // $users = $users->where('users.id', '!=' 1);
            if($request['mobile']){
                $users = $users->where('users.mobile', $request['mobile']);
            }
            if($request['email']){
                $users = $users->where('users.email', $request['email']);
            }
            $users = $users->latest()->paginate(25);
        return $users;
    }

    public function storeVisitDoctors($data){
        /** save doctor */
        $doctor = new User();
        $doctor->first_name = $data['name'];
        $doctor->mobile = $data['mobile'];
        $doctor->email = $data['email'];
        $doctor->state = $data['state'];
        $doctor->address = $data['address'];
        $doctor->city = $data['city'];
        $doctor->pincode = $data['pincode'];
        $doctor->expertise = $data['expertise'];
        // $doctor->designation = $data['designation'];
        $doctor->experience = $data['experience'];
        $doctor->user_type_id = 4;
        $doctor->user_designation_id = 2;
        $doctor->save();

        /** save doctor visit */
        $doctorVisit  = new DoctorVisit;
        $doctorVisit->doctor_id = $doctor->id;
        $doctorVisit->visit_date = $data['visit_date'];
        $doctorVisit->visit_time = date('h:i A');
        $doctorVisit->remarks = $data['remarks'];
        $doctorVisit->picture = $data['picture'];
        $doctorVisit->save();
    }

    public function findStaff($id){
        return $users =  User::where('users.id', '!=', 1)->where('users.id', $id)->select('users.*', 'ul.username', 'ul.password')
            ->leftJoin('user_logins as ul', 'ul.user_id', '=', 'users.id')->first();
            // $users = $users->first();
    }

    public function updateStaff($data, $id){

        $user = User::where('id', $id)->first();
        $user->first_name = $data['name'];
        $user->mobile = $data['mobile'];
        $user->email = $data['email'];
        if($data['profile_pic']!=null){
            $user->profile_pic = $data['profile_pic'];
        }
        $user->state = $data['state'];
        $user->address = $data['address'];
        $user->city = $data['city'];
        $user->pincode = $data['pincode'];
        $user->expertise = $data['expertise'];
        $user->designation = $data['designation'];
        $user->company = $data['company'];
        $user->experience = $data['experience'];
        $user->user_type_id = 3;
        $user->user_designation_id = 2;
        $user->save();

        $userLogin  = UserLogin::where('user_id', $id)->first();
        $userLogin->user_type_id = 3;
        $userLogin->username = $data['username'];
        $userLogin->password = $data['password'];
        $userLogin->status = 1;
        $userLogin->save();
    }


}
