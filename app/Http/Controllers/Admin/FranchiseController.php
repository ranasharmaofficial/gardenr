<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\FranchiseRepositoryInterface;
use App\Models\UserLogin;
use App\Models\Notification;
use App\Models\Course;
use App\Models\SubCourse;
use App\Models\User;
use App\Models\EnrollmentYear;
use App\Models\Student;
use DB;

class FranchiseController extends Controller
{
    private $franchiseRepository;
    public function __construct(FranchiseRepositoryInterface $franchiseRepository)
    {
        $this->franchiseRepository = $franchiseRepository;
    }

    public function getSubCourse(Request $request)
    {
        $data['subcourse'] = SubCourse::where("course_id",$request->course)
                    ->get(["title","id"]);
        return response()->json($data);
    }

    public function franchiseDashboard()
    {
        $data = $this->franchiseRepository->dashboardDataCount();
        return view('franchise.dashboard.dashboard_view', compact('data'));
    }

    public function addStudent(){
        return view('franchise.student.add_student');
    }

    public function fundReceived(){
        $user_id = session('LoggedFranchise')->user_id;
        $data = $this->franchiseRepository->getFundReceived($user_id);
        return view('franchise.fund.fund_received', compact('data'));
    }

    public function saveStudentDetails(Request $request){
        // dd($request->all());
        $data =  $request->validate([
            "course_id" => "required",
            "subcourse_id" => "required",
            "english_name" => "required",
            "hindi_name" => "nullable",
            "fathers_name" => "nullable",
            "mothers_name" => "nullable",
            "dob" => "required",
            "gender" => "nullable",
            "marital_status" => "nullable",
            "nationality" => "nullable",
            "category" => "nullable",
            "whether_handicapped" => "nullable",
            "aadhar_no" => "nullable|numeric",
            "pan_no" => "nullable",
            "blood_group" => "nullable",
            "email" => "nullable",
            "mobile" => "required|numeric",
            "matric_subject" => "nullable",
            "matric_year" => "nullable",
            "matric_org" => "nullable",
            "matric_board" => "nullable",
            "matric_score" => "nullable",
            "matric_percent" => "nullable",
            "inter_subject" => "nullable",
            "inter_passing_year" => "nullable",
            "inter_org" => "nullable",
            "inter_board" => "nullable",
            "inter_score" => "nullable",
            "inter_percent" => "nullable",
            "grad_subject" => "nullable",
            "grad_year" => "nullable",
            "grad_org" => "nullable",
            "grad_board" => "nullable",
            "grad_score" => "nullable",
            "grad_percent" => "nullable",
            "other_subject" => "nullable",
            "other_year" => "nullable",
            "other_org" => "nullable",
            "other_board" => "nullable",
            "other_score" => "nullable",
            "other_percent" => "nullable",
            "father_husband_occupation" => "nullable",
            "name_address_guardian" => "nullable",
            "image" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        // $data['enrollment_number'] = $this->generateUniqueNumber();
		// $get_student_last_id = Student::orderBy('id', 'desc')->limit(1)->first(); // Assuming you have a student with ID 1
		// if($get_student_last_id){
			// $data['enrollment_number'] = $this->generateEnrollmentNumber($get_student_last_id->id);
		// }else{
			// $data['enrollment_number'] = $this->generateEnrollmentNumber(1);
		// }

		$data['enrollment_number'] = $this->generateEnrollmentNumber();
		$data['roll_number'] = $this->generateRollNumber();
		$data['serial_number'] = $this->generateSerialNumber();
        $data['franchise_id'] = session('LoggedFranchise')->user_id;
        if($request->has('image')){
            $name = $request->image->getClientOriginalName();
            $imageName = time().rand(1,999).'.'.$name;
            $request->image->move(public_path('uploads/tender'), $imageName);
            $data['image'] = $imageName;
        }else{
            $data['image'] = NULL;
        }
        $check_subcourse_fee  = SubCourse::where('id', $request->subcourse_id)->first();
        if($check_subcourse_fee){
            $data['fee'] = $check_subcourse_fee->fee;
        }else{
            $data['fee'] = 500;
        }
        $this->franchiseRepository->storeStudentDetails($data);
        return redirect()->route('franchise.pendingStudentList')->with(session()->flash('alert-success', 'Added Successfully'));
    }

    public function generateEnrollmentNumber()
    {
        $prefix = 'BSA';
        $batchCode = '1001'; // you can make this dynamic if needed
        $get_year_active = EnrollmentYear::where('status', 1)->first(); // Get the current year
        $year = $get_year_active->year;
        // Count existing students for the current year + batch
        $count = Student::where('enrollment_number', 'like', "{$prefix}{$year}{$batchCode}%")->count();
        // Increment and pad the last number
        $nextNumber = str_pad($count + 1, 3, '0', STR_PAD_LEFT); // e.g., 001, 002, ...
        // Final enrollment number
        $enrollmentNo = "{$prefix}{$year}{$batchCode}{$nextNumber}";
        return $enrollmentNo;
    }

    public function generateRollNumber()
    {
        $prefix = 'R111555';
        // Count how many roll numbers already exist with this prefix
        $count = Student::where('roll_number', 'like', $prefix . '%')->count();
        // Increment and format as 2-digit number (01, 02, 03...)
        $next = str_pad($count + 1, 2, '0', STR_PAD_LEFT);
        return $prefix . $next;
    }

    public function generateSerialNumber()
    {
        $prefix = '111555';
        // Count how many existing serial numbers start with this prefix
        $count = Student::where('serial_number', 'like', $prefix . '%')->count();
        // Increment the count by 1 to get the next serial number
        $next = $count + 1;
        // Final serial number (e.g., 1115554)
        return $prefix . $next;
    }


/*
	public 	function generateEnrollmentNumber()
	{
		$year = date('Y'); // Get the current year
		$get_year_active = EnrollmentYear::where('status', 1)->first(); // Get the current year
		// Get the latest student record
		$lastStudent = Student::latest('id')->first();

		if ($lastStudent) {
			// Extract the last enrollment number and increment it
			$lastNumber = (int) substr($lastStudent->enrollment_number, -3);
			$nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
		} else {
			// If no students exist, start from 001
			$nextNumber = '001';
		}

		return "ICVT-{$get_year_active->year}-{$nextNumber}";
	}

    public function generateUniqueNumber()
    {
        do {
            // Generate a random number, you can modify the range as per your requirements
            $uniqueNumber = random_int(100000, 999999);
        } while (DB::table('students')->where('enrollment_number', $uniqueNumber)->exists());

        return $uniqueNumber;
    }
	*/

    public function pendingStudentList(Request $request){
        $user_id = session('LoggedFranchise')->user_id;
        $status = 0;
        $student_list = $this->franchiseRepository->getStudentList($user_id,$status);
        return view('franchise.student.pending_student_list', compact('student_list'));
    }

    public function approvedStudentList(Request $request){
        $user_id = session('LoggedFranchise')->user_id;
        $status = 1;
        $student_list = $this->franchiseRepository->getStudentList($user_id,$status);
        return view('franchise.student.approved_student_list', compact('student_list'));
    }

    public function viewstudent($id){
        $student = $this->franchiseRepository->findStudent($id);
        // dd($student);
        if($student){
            return view('franchise.student.view_student', compact('student'));
        }else{
            return redirect()->back()->with(session()->flash('alert-danger', 'Invalid Id'));
        }

    }

}
