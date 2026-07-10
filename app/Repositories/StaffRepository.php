<?php
namespace App\Repositories;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use App\Models\Staff;
use App\Models\User;
use App\Models\UserLogin;
use App\Models\Affiliation;
use App\Models\Associate;
use App\Models\RecruitedStudent;
use App\Models\EnrollmentYear;
use App\Models\MasterDesignation;
use App\Models\UserType;

class StaffRepository implements StaffRepositoryInterface
{
    public function allStaffs($request){
        // $staffs = User::select('*')->latest()->paginate(10);
        // return $staffs;
        $users = User::where('users.id', '!=', 1)->where('users.user_type_id', 5)->select('users.*', 'ul.username', 'ul.password')
            ->leftJoin('user_logins as ul', 'ul.user_id', '=', 'users.id');
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

    public function storeStaff($data){
        $user = new User();
        $user->first_name = $data['name'];
        $user->mobile = $data['mobile'];
        $user->email = $data['email'];
        $user->state = $data['state'];
        $user->address = $data['address'];
        $user->city = $data['city'];
        $user->salary = $data['salary'];
        $user->working_hour = $data['working_hour'];
        $user->experience = $data['experience'];
        $user->user_type_id = $data['user_type_id'];
        $user->user_designation_id = $data['user_designation_id'];
        $user->save();


    }

    public function findStaff($id){
        // return $users =  User::where('users.id', $id)->first();
        $users = User::select('users.*', 'ul.username', 'ul.password', 'ut.name as user_type_name', 'md.name as designation_name', 'md.incentive as staff_incentive', 'b.name as branch_name', 's.title as session_name')
                ->leftJoin('user_logins as ul', 'ul.user_id', '=', 'users.id')
                ->leftJoin('user_types as ut', 'ut.id', '=', 'users.user_type_id')
                ->leftJoin('master_designations as md', 'md.id', '=', 'users.user_designation_id')
                ->leftJoin('branches as b', 'b.id', '=', 'users.branch')
                ->leftJoin('sessions as s', 's.id', '=', 'users.session');
        return $users = $users->where('users.id', $id)->first();
    }

    public function updateStaff($data, $id){
        $user = User::where('id', $id)->first();
        $user->branch = $data['branch'];
        $user->session = $data['session'];
        $user->first_name = $data['name'];
        $user->mobile = $data['mobile'];
        $user->email = $data['email'];
        $user->state = $data['state'];
        $user->address = $data['address'];
        $user->city = $data['city'];
        $user->salary = $data['salary'];
        $user->working_hour = $data['working_hour'];
        $user->in_time = $data['in_time'];
        $user->experience = $data['experience'];
        $user->user_type_id = $data['user_type_id'];
        $user->user_designation_id = $data['user_designation_id'];
        $user->save();

        $update_login = UserLogin::where('user_id', $id)->first();
        $update_login->username = $data['username'];
        $update_login->user_type_id = $data['user_type_id'];
        if(!empty($data['password'])){
            $update_login->password = $data['password'];
        }
        $update_login->save();
    }



    public function get_user_types(){
        return UserType::where('status', 1)->where('id', '!=', 1)->get();
    }

    public function get_vivah_mitra_user_types(){
        return UserType::where('status', 1)
            ->whereIn('id', [5, 6])
            ->get();
    }

    public function get_master_designations(){
        return MasterDesignation::where('status', 1)->get();
    }


}
