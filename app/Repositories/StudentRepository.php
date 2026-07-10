<?php
namespace App\Repositories;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Models\Category;
use App\Models\User;
use App\Models\Blog;
use App\Models\ImageCategory;
use App\Models\Gallery;
use App\Models\CmsPage;
use App\Models\MasterProduct;
use App\Models\MasterService;
use App\Models\CustomerLead;
use App\Models\JobEnquiry;
use App\Models\Subscriber;
use App\Models\Testimonial;
use App\Models\HireTeam;
use App\Models\OnlineEnquiry;
use App\Models\Notification;
use App\Models\Tender;
use App\Models\Fund;
use App\Models\Student;

class StudentRepository implements StudentRepositoryInterface
{
    public function dashboardDataCount(){
        $user_id = session('LoggedStudent')->user_id;
        $total_fund_received = Fund::where('user_id', $user_id)->sum('amount');
        $data = [
            'total_fund_received' => $total_fund_received,
        ];
        return $data;
    }

    public function notificationList(){
        return Notification::latest()->get();
    }

    public function getFundReceived($user_id){
        return Fund::where('user_id', $user_id)->orderBy('id', 'DESC')->get();
    }

    public function storeStudentDetails($data){
        $students = new Student();
        $students->enrollment_number = $data['enrollment_number'];
        $students->fee = $data['fee'];
        $students->franchise_id = $data['franchise_id'];
        $students->course_id = $data['course_id'];
        $students->subcourse_id = $data['subcourse_id'];
        $students->image = $data['image'];
        $students->english_name = $data['english_name'];
        $students->hindi_name = $data['hindi_name'];
        $students->fathers_name = $data['fathers_name'];
        $students->mothers_name = $data['mothers_name'];
        $students->dob = $data['dob'];
        $students->gender = $data['gender'];
        $students->marital_status = $data['marital_status'];
        $students->nationality = $data['nationality'];
        $students->category = $data['category'];
        $students->whether_handicapped = $data['whether_handicapped'];
        $students->aadhar_no = $data['aadhar_no'];
        $students->pan_no = $data['pan_no'];
        $students->blood_group = $data['blood_group'];
        $students->email = $data['email'];
        $students->mobile = $data['mobile'];
        $students->matric_subject = $data['matric_subject'];
        $students->matric_year = $data['matric_year'];
        $students->matric_org = $data['matric_org'];
        $students->matric_board = $data['matric_board'];
        $students->matric_score = $data['matric_score'];
        $students->matric_percent = $data['matric_percent'];
        $students->inter_subject = $data['inter_subject'];
        $students->inter_passing_year = $data['inter_passing_year'];
        $students->inter_org = $data['inter_org'];
        $students->inter_board = $data['inter_board'];
        $students->inter_score = $data['inter_score'];
        $students->inter_percent = $data['inter_percent'];
        $students->grad_subject = $data['grad_subject'];
        $students->grad_year = $data['grad_year'];
        $students->grad_org = $data['grad_org'];
        $students->grad_board = $data['grad_board'];
        $students->grad_score = $data['grad_score'];
        $students->grad_percent = $data['grad_percent'];
        $students->other_subject = $data['other_subject'];
        $students->other_year = $data['other_year'];
        $students->other_org = $data['other_org'];
        $students->other_board = $data['other_board'];
        $students->other_score = $data['other_score'];
        $students->other_percent = $data['other_percent'];
        $students->father_husband_occupation = $data['father_husband_occupation'];
        $students->name_address_guardian = $data['name_address_guardian'];
        $students->save();
    }

    public function getStudentList($user_id,$status){
        return Student::where('franchise_id', $user_id)->where('status', $status)->get();
    }

    public function findStudent($id){
        return Student::find($id);

    }


}
