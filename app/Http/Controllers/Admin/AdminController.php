<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Models\UserLogin;
use App\Models\Notification;
use App\Models\Course;
use App\Models\SubCourse;
use App\Models\User;
use App\Models\Student;
use App\Models\State;
use App\Models\ManualResult;
use App\Models\ManualResultSubject;
use App\Models\Result;
use App\Models\ResultSubject;
use App\Models\Subject;
use App\Models\MasterSemester;
use App\Models\Session;
use App\Models\AdmitCard;
use App\Models\AdmitCardSubject;
use DB;
use Barryvdh\DomPDF\Facade\Pdf; // Make sure to import this at the top
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    private $adminRepository;
    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function adminDashboard()
    {
        $data = $this->adminRepository->dashboardDataCount();
        return view('admin.dashboard.dashboard_view', compact('data'));
    }

    public function resetPassword()
    {
        $data = $this->adminRepository->dashboardDataCount();
        return view('admin.dashboard.reset_password', compact('data'));
    }
    // UserLogin
    public function updateAdminPassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
        $user_details = UserLogin::findOrFail(1);
        // dd($user_details);
         #Match The Old Password
        if($request->old_password==$user_details->password){
            UserLogin::where('id', 1)->update([
                'password' => $request->new_password,
            ]);
            return back()->with(session()->flash('alert-success', 'Updated Successfully'));
        }else{
            return back()->with(session()->flash('alert-danger', 'Wrong Old Password'));
        }

    }

    public function addNotification()
    {
        $notificationList = $this->adminRepository->notificationList();
        return view('admin.notification.create', compact('notificationList'));
    }
    public function notificationList()
    {
        $notificationList = $this->adminRepository->notificationList();
        return view('admin.notification.index', compact('notificationList'));
    }

    public function storeNotification(Request $request){
        $request->validate([
            'title' => 'required',
            'links' => 'required',
        ]);
        $save = new Notification;
        $save->title = $request->title;
        $save->links = $request->links;
        $save->status = $request->status;
        $save->save();
        return back()->with(session()->flash('alert-success', 'Notification Added Successfully'));
    }

    public function updateNotification(Request $request){
        $request->validate([
            'title' => 'required',
            'links' => 'required',
            'status' => 'required',
        ]);

        $save = Notification::where('id', $request->id)->first();
        $save->title = $request->title;
        $save->links = $request->links;
        $save->status = $request->status;
        $save->save();
        return back()->with(session()->flash('alert-success', 'Notification Updated Successfully'));
    }

    public function editNotification($id){
        $data = Notification::findOrFail($id);
        return view('admin.notification.update', compact('data'));
    }

    public function deleteNotification($id){
        $delete_notification = Notification::find($id);
        $delete_notification->delete();
        return back()->with(session()->flash('alert-success', 'Notification Deleted Successfully'));
    }

    public function courseList(){
        $courselists = Course::orderBy('id', 'DESC')->paginate(1000);
        return view('admin.course.index', compact('courselists'));
    }

    public function addCourse(){
        return view('admin.course.create');
    }

    public function editCourse($id){
        $course = Course::find($id);
        return view('admin.course.update', compact('course'));
    }

    public function uploadCourseDetails(Request $request)
    {
        $request->validate([
            // 'coursename' => 'required',
            'coursetitle' => 'required',
            // 'coursedetails' => 'required',
            'courseimage' => 'required|max:500',
        ]);

        if ($request->hasfile('courseimage')) {
            $file = $request->file('courseimage');
            $extenstion = $file->getClientOriginalExtension();
            $filename = 'course-' . time() . '.' . $extenstion;
            $file->move(public_path('uploads/courses'), $filename);
        }

        $coursepost = Course::create([
            "courseTitle" => "$request->coursetitle",
            "courseDetails" => "$request->coursedetails",
            "slug" => "$request->coursetitle",
            "courseImage" => "$filename",
        ]);

        if ($coursepost) {
            return redirect()->back()->with(session()->flash('alert-success', 'Course Successfully Uploaded'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
        }
    }

    public function updateCourseDetails(Request $request)
    {
        $request->validate([
           'coursetitle' => 'required',
           'courseid' => 'required',

        ]);

        if ($request->hasfile('courseimage')) {
            $file = $request->file('courseimage');
            $extenstion = $file->getClientOriginalExtension();
            $filename = 'course-' . time() . '.' . $extenstion;
            $file->move(public_path('uploads/courses'), $filename);
        }

        if($request->courseimage!=null){
            $updatecoursedetails = Course::where('id', $request->courseid)
            ->update([
                "courseTitle" => "$request->coursetitle",
                "courseImage" => "$filename"
            ]);
        }else{
            $updatecoursedetails = Course::where('id', $request->courseid)
            ->update([
                "courseTitle" => "$request->coursetitle",
            ]);
        }

                // dd($request->subjects);
                // die;
            // if($request->subjects) {
            //     CourseSubject::where('course_id', $request->courseid)->delete();
            //     foreach ($request->subjects as $key => $bproduct) {
            //         $subjects_name = new CourseSubject;
            //         $subjects_name->subject = $bproduct;
            //         $subjects_name->course_id = $request->courseid;
            //         $subjects_name->save();
            //     }
            // }

        if ($updatecoursedetails) {
            return redirect('admin/course-list')->with(session()->flash('alert-success', 'Course Updated Successfully!'));
        } else {
            return redirect('admin/course-list')->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
        }
    }

    public function addSubCourse()
    {
        return view('admin/subcourse/add_sub_course');
    }

    public function uploadSubCourseDetails(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'details' => 'required',
            'image' => 'required',
        ]);

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = 'course-' . time() . '.' . $extenstion;
            $file->move(public_path('uploads/courses'), $filename);
        }

        $subcoursepost = SubCourse::create([
            "course_id" => $request->course_id,
            "title" => "$request->title",
            "details" => "$request->details",
            "slug" => "$request->title",
            "image" => "$filename",
            "fee" => "$request->fee",
        ]);

        if ($subcoursepost) {
            return redirect()->back()->with(session()->flash('alert-success', 'Added Successfully'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
        }
    }

    public function SubcourseList(){
        $subcourselists = SubCourse::orderBy('id', 'DESC')->paginate(1000);
        return view('admin.subcourse.index', compact('subcourselists'));
    }

    public function editSubCourse($id)
    {
        $subcoursedata = SubCourse::where('id', $id)->first();
        return view('admin/subcourse/edit_sub_course', compact('subcoursedata'));

    }

    public function updateSubCourseDetails(Request $request){
        $request->validate([
            'course_id' => 'required',
            'title' => 'required',
            'details' => 'required',
            'slug' => 'required',
        ]);

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = 'course-' . time() . '.' . $extenstion;
            $file->move(public_path('uploads/courses'), $filename);
        }

        if($request->image!=null){
            $updatecoursedetails = SubCourse::where('id', $request->id)
            ->update([
                "title" => $request->title,
                "image" => $filename,
                "details" => $request->details,
                "fee" => $request->fee,
                "slug" => $request->slug,
            ]);
        }else{
            $updatecoursedetails = SubCourse::where('id', $request->id)
            ->update([
                "title" => $request->title,
                "details" => $request->details,
                "fee" => $request->fee,
                "slug" => $request->slug,
            ]);
        }

        if ($updatecoursedetails) {
            return redirect()->back()->with(session()->flash('alert-success', 'Added Successfully'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
        }

    }

    public function pendingFranchise(){
        $pending_franchise = User::where('user_type_id', 2)->where('status', 0)->get();
        return view('admin.franchise.pending_franchise', compact('pending_franchise'));
    }

    public function approvedFranchise(){
        $approved_franchise = User::where('user_type_id', 2)->where('status', 1)->get();
        return view('admin.franchise.approved_franchise', compact('approved_franchise'));
    }

    public function editFranchise($id){
        $franchise = User::where('id', $id)->first();
        $franchise_login_details = UserLogin::where('user_id', $franchise->id)->first();
        $state_list = State::get();
        return view('admin.franchise.edit_franchise', compact('franchise', 'state_list', 'franchise_login_details'));
    }

    public function updateFranchiseDetails(Request $request){
        // dd($request->all());
        $user = User::where('id', $request->id)->first();
        $user->partner_code = $request->partner_code;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        if($request->state!=null){
            $user->state = $request->state;
        }
        if($request->city!=null){
            $user->city = $request->city;
        }
        if($request->pincode!=null){
            $user->pincode = $request->pincode;
        }
        if($request->institute_name!=null){
            $user->institute_name = $request->institute_name;
        }
        $user->mobile = $request->mobile;
        $user->save();

        $user_login = UserLogin::where('user_id', $request->id)->first();
        $user_login->username = $request->username;
        $user_login->password = $request->password;
        $user_login->save();

        if ($user && $user_login) {
            return redirect()->back()->with(session()->flash('alert-success', 'Updated Successfully'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
        }
    }

    public function updateFranchiseStatus(Request $request){
        $user = User::where('id', $request->user_id)->first();
        $user->status = $request->status;
        $user->save();

        $user_login = UserLogin::where('user_id', $request->user_id)->first();
        $user_login->status = $request->status;
        $user_login->save();

        if ($user && $user_login) {
            return redirect()->back()->with(session()->flash('alert-success', 'Updated Successfully'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
        }
    }



    public function addFund(){
        $approved_franchise = User::where('user_type_id', 2)->where('status', 1)->get();
        return view('admin.fund.add_fund', compact('approved_franchise'));
    }

    public function fundList(){
        $fundList = $this->adminRepository->getFundList();
        // dd($fundList);
        return view('admin.fund.fund_list', compact('fundList'));
    }

    public function storeFund(Request $request){
        $data =  $request->validate([
            'user_id' => 'required',
            'amount' => 'required|numeric',
        ]);
        $this->adminRepository->storeFund($request, $data);
        return redirect()->route('admin.addFund')->with(session()->flash('alert-success', 'Fund Added Successfully'));
    }

    /** students function */

    public function pendingStudent(){
        $pending_student = Student::where('status', 0)->get();
        return view('admin.students.pending_student', compact('pending_student'));
    }

    public function approvedStudent(){
        $approved_student = Student::where('status', 1)->get();
        return view('admin.students.approved_student', compact('approved_student'));
    }

    public function viewstudent($id){
        $student = Student::find($id);
        if($student){
            return view('admin.students.view_student', compact('student'));
        }else{
            return redirect()->back()->with(session()->flash('alert-danger', 'Invalid Id'));
        }

    }

    public function updateStudentStatus(Request $request){
        // dd($request->all());
        $student = Student::where('id', $request->student_id)->first();
        $student->status = $request->status;
        $student->save();
        if ($student) {
            return redirect()->back()->with(session()->flash('alert-success', 'Updated Successfully'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong. Please try again.'));
        }
    }


    public function addManualResult($id){
        $student = Student::find($id);
        if($student){
            return view('admin.students.add_manual_student_result', compact('student'));
        }else{
            return redirect()->back()->with(session()->flash('alert-danger', 'Invalid Id'));
        }
    }

    public function saveManualStudentResult(Request $request){
        // dd($request->all());
        $validatedData = $request->validate([
            'student_id' => 'required',
            'franchise_id' => 'required',
            'course_id' => 'required',
            'subcourse_id' => 'required',
            'result' => 'required|string',
            'passing_year' => 'required|',
            'semester' => 'required|string',
            'subject_code' => 'required|array',
            'subject_name' => 'required|array',
            'full_marks' => 'required|array',
            'pass_marks' => 'required|array',
            'marks_obtained' => 'required|array',
            'grade' => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            // Save the main result record
            $result = ManualResult::create([
                'student_id' => $validatedData['student_id'],
                'franchise_id' => $validatedData['franchise_id'],
                'course_id' => $validatedData['course_id'],
                'subcourse_id' => $validatedData['subcourse_id'],
                'result' => $validatedData['result'],
                'passing_year' => $validatedData['passing_year'],
                'semester' => $validatedData['semester'],
            ]);

            // Save each subject
            foreach ($validatedData['subject_code'] as $index => $subject_code) {
                ManualResultSubject::create([
                    'result_id' => $result->id,
                    'subject_code' => $subject_code,
                    'subject_name' => $validatedData['subject_name'][$index],
                    'full_marks' => $validatedData['full_marks'][$index],
                    'pass_marks' => $validatedData['pass_marks'][$index],
                    'marks_obtained' => $validatedData['marks_obtained'][$index],
                    'grade' => $validatedData['grade'][$index],
                ]);
            }

            DB::commit();
            // return response()->json(['message' => 'Result saved successfully!'], 200);
            return redirect()->back()->with(session()->flash('alert-success', 'Result saved successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            // return response()->json(['error' => $e->getMessage()], 500);
            return redirect()->back()->with(session()->flash('alert-danger',  $e->getMessage()));
        }
    }

    public function viewStudentManualResult($id){
        $student = Student::find($id);
        $result_added = ManualResult::where('student_id', $id)->first();
        // dd($result_subjects);
        if($student && $result_added){
            $result_subjects = ManualResultSubject::where('result_id', $result_added->id)->get();
            $franchise_details = User::where('id', $student->franchise_id)->pluck('partner_code')->first();
            return view('admin.students.view_manual_student_result', compact('student', 'result_added', 'result_subjects','franchise_details'));
        }else{
            return redirect()->back()->with(session()->flash('alert-danger', 'Result not Added'));
        }
    }

    public function editStudentDetails($id){
        $student = Student::find($id);
        // dd($student);
        return view('admin.students.edit_student_details', compact('student'));
    }

    public function updateStudentDetails(Request $request){
        $data =  $request->validate([
            "course_id" => "required",
            "subcourse_id" => "required",
            "english_name" => "required",
            "hindi_name" => "nullable",
            "fathers_name" => "required",
            "mothers_name" => "required",
            "dob" => "required",
            "gender" => "required",
            "marital_status" => "required",
            "nationality" => "required",
            "category" => "required",
            "whether_handicapped" => "nullable",
            "aadhar_no" => "required|numeric",
            "pan_no" => "nullable",
            "blood_group" => "nullable",
            "email" => "nullable",
            "mobile" => "required|numeric",
            "matric_subject" => "nullable",
            "matric_year" => "required",
            "matric_org" => "required",
            "matric_board" => "required",
            "matric_score" => "required",
            "matric_percent" => "required",
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
            "father_husband_occupation" => "required",
            "name_address_guardian" => "required",
        ]);

        $data['student_id'] = $request->student_id;
        if($request->has('image')){
            $name = $request->image->getClientOriginalName();
            $imageName = time().rand(1,999).'.'.$name;
            $request->image->move(public_path('uploads/tender'), $imageName);
            $data['image'] = $imageName;
        }else{
            $data['image'] = NULL;
        }
        $this->adminRepository->updateStudentDetails($data);
        return redirect()->back()->with(session()->flash('alert-success', 'Updated Successfully'));
    }

    public function subjectList(Request $request){
        //$request = $request->all();
        // dd($request);
        // $data['course_id'] = !empty($request->course_id) ? $request->course_id : null;
        // $data['subcourse_id'] = !empty($request->subcourse_id) ? $request->subcourse_id : null;
        $data['course_id'] = isset($request->course_id) ? $request->course_id : null;
        $data['subcourse_id'] = isset($request->subcourse_id) ? $request->subcourse_id : null;
        // dd($data['course_id']);
        $subjectlists = $this->adminRepository->getSubjectList($data);
        return view('admin.subjects.index', compact('subjectlists', 'data'));
    }

    public function addSubject()
    {
        return view('admin/subjects/add_subject');
    }

    public function saveSubjects(Request $request){
        $request->validate([
            "course_id" => "required",
            "subcourse_id" => "required",
            "subject_code" => "required",
            "semester" => "required",
            "name" => "required",
            "full_marks" => "required",
            "pass_marks" => "required",
        ]);

        // Save each subject
        foreach ($request->subject_code as $index => $subject_code) {
            Subject::create([
                'semester' => $request->semester,
                'course_id' => $request->course_id,
                'sub_course_id' => $request->subcourse_id,
                'subject_code' => $request->subject_code[$index],
                'name' => $request->name[$index],
                'full_marks' => $request->full_marks[$index],
                'pass_marks' => $request->pass_marks[$index],
            ]);
        }
        return redirect()->back()->with(session()->flash('alert-success', 'Saved Successfully'));
    }

        public function getSubject($id)
    {
        $subject = Subject::findOrFail($id);
        return response()->json($subject);
    }

    public function updateSubject(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->update([
            'semester' => $request->semester,
            'name' => $request->name,
            'subject_code' => $request->subject_code,
            'full_marks' => $request->full_marks,
            'pass_marks' => $request->pass_marks,
        ]);
        return response()->json(['message' => 'Subject updated successfully']);
    }

    public function generateCertificate(Request $request){
        $query =  Student::where('status', 1);

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('english_name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('enrollment_number', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->course_id) {
            $query->where('course_id', $request->course_id);
        }

        $approved_student = $query->orderBy('id', 'desc')->paginate(10);

        // AJAX request? Return partial
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.documents.student_certificate_ajax_list', compact('approved_student'))->render(),
                'pagination' => (string) $approved_student->links()
            ]);
        }

        $courses = Course::where('status', 1)->get(); // For filter dropdown
        return view('admin.documents.student_certificate', compact('approved_student', 'courses'));
    }

    public function saveSubCourseCertificate(Request $request){
        dd($request->all());
    }

    public function viewCertificateTemplate(){
        return view('admin.documents.certificate_template');
    }

    public function addResult(Request $request){
        $student_id = $request->student_id;
        $semester = $request->semester;
        $student = Student::find($student_id);
        if($student){
            return view('admin.result.add_student_result_view', compact('student', 'student_id', 'semester'));
        }else{
            return redirect('admin/generate-certificate')->with(session()->flash('alert-danger',  'Invalid Id'));
        }

    }


    public function saveStudentResult(Request $request){
        // dd($request->all());

        $validatedData = $request->validate([
            'student_id' => 'required',
            'session' => 'required',
            'remarks' => 'required',
            'total_marks_obtained' => 'required',
            'total_percentage' => 'required',
            'franchise_id' => 'required',
            'course_id' => 'required',
            'subcourse_id' => 'required',
            'result' => 'required|string',
            'examination' => 'required',
            'passing_year' => 'required',
            'issue_date' => 'required',
            'semester' => 'required|string',
            'subject_code' => 'required|array',
            'subject_name' => 'required|array',
            'full_marks' => 'required|array',
            'pass_marks' => 'required|array',
            'theory' => 'required|array',
            'internal' => 'required|array',
            'marks_obtained' => 'required|array',
            'grade' => 'required|array',
        ]);
        // dd($validatedData);
        $check_result = Result::where('semester', $request->semester)->where('session', $request->session)->where('student_id', $request->student_id)->count();

        if($check_result==0){
            DB::beginTransaction();
            try {
                // Save the main result record
                $result = Result::create([
                    'remarks' => $validatedData['remarks'],
                    'issue_date' => $validatedData['issue_date'],
                    'session' => $validatedData['session'],
                    'student_id' => $validatedData['student_id'],
                    'franchise_id' => $validatedData['franchise_id'],
                    'course_id' => $validatedData['course_id'],
                    'subcourse_id' => $validatedData['subcourse_id'],
                    'result' => $validatedData['result'],
                    'passing_year' => $validatedData['passing_year'],
                    'semester' => $validatedData['semester'],
                    'total_marks_obtained' => $validatedData['total_marks_obtained'],
                    'total_percentage' => $validatedData['total_percentage'],
                    'examination' => $validatedData['examination'],
                ]);

                // Save each subject
                foreach ($validatedData['full_marks'] as $index => $full_marks) {
                    ResultSubject::create([
                        'result_id' => $result->id,
                        // 'subject_code' => $subject_code,
                        // 'subject_name' => $subject_name,
                        'subject_name' => $validatedData['subject_name'][$index],
                        'full_marks' => $full_marks,
                        // 'full_marks' => $validatedData['full_marks'][$index],
                        'pass_marks' => $validatedData['pass_marks'][$index],
                        'theory' => 0,
                        'internal' => 0,
                        'marks_obtained' => $validatedData['marks_obtained'][$index],
                        'grade' => $validatedData['grade'][$index],
                    ]);
                }

                DB::commit();
                // return response()->json(['message' => 'Result saved successfully!'], 200);
                return redirect()->back()->with(session()->flash('alert-success', 'Result saved successfully'));
            } catch (\Exception $e) {
                DB::rollBack();
                // return response()->json(['error' => $e->getMessage()], 500);
                return redirect()->back()->with(session()->flash('alert-danger',  $e->getMessage()));
            }
        }else{
            $session_value = Session::where('id', $request->session)->first();
            $semester_value = MasterSemester::where('id', $request->semester)->first();
            return redirect()->back()->with(session()->flash('alert-danger',  'Already added in Semester : '.$semester_value->semester.' and in Session '.$session_value->from_session.' to '.$session_value->to_session.''));
        }

    }

    public function viewResult(Request $request){

        $session_list = Session::get();
        $semester_list = MasterSemester::get();
        $course_list = Course::where('status', 1)->get();
        $subcourse_list = SubCourse::where('status', 1)->get();
        // $get_results = Result::where('course_id', $request->course_id)
        //                     ->where('subcourse_id', $request->subcourse_id)
        //                     ->where('session', $request->session)
        //                     ->where('semester', $request->semester)
        //                     ->get();
                            // dd($get_results);

        $get_results =  Result::select('results.*', 'students.english_name', 'sessions.from_session', 'sessions.to_session', 'master_semesters.semester')
                                    ->leftJoin('students', 'students.id', '=', 'results.student_id')
                                    ->leftJoin('sessions', 'sessions.id', '=', 'results.session')
                                    ->leftJoin('master_semesters', 'master_semesters.id', '=', 'results.semester')
                                    ->where('results.course_id', $request->course_id)
                                    ->where('results.subcourse_id', $request->subcourse_id)
                                    ->where('results.session', $request->session)
                                    ->where('results.semester', $request->semester)
                                    ->latest()
                                    ->paginate(1000);
        return view('admin.result.view_result', compact('session_list', 'semester_list', 'course_list', 'subcourse_list', 'request', 'get_results'));
    }

    public function viewStudentResultDetails($id){
        $result_details =  Result::select('results.*',
                                'students.english_name',
                                'students.serial_number',
                                'students.enrollment_number',
                                'students.fathers_name',
                                'students.mothers_name',
                                'students.franchise_id',
                                'students.roll_number',
                                'sessions.from_session', 'sessions.to_session',
                                'sub_courses.title as subcourse_name',
                                'master_semesters.semester')
                        ->leftJoin('students', 'students.id', '=', 'results.student_id')
                        ->leftJoin('sessions', 'sessions.id', '=', 'results.session')
                        ->leftJoin('master_semesters', 'master_semesters.id', '=', 'results.semester')
                        ->leftJoin('sub_courses', 'sub_courses.id', '=', 'results.subcourse_id')
                        ->where('results.id', $id)
                        ->first();
        $result_marksheet = ResultSubject::where('result_id', $id)->get();
                        // dd($result_marksheet);

        return view('admin.result.result_details_in_template', compact('result_details', 'result_marksheet'));
    }

    public function downloadStudentResultPDF($id)
    {
        $result_details =  Result::select('results.*',
                                    'students.english_name',
                                    'students.serial_number',
                                    'students.enrollment_number',
                                    'students.fathers_name',
                                    'students.mothers_name',
                                    'students.franchise_id',
                                    'students.roll_number',
                                    'students.image',
                                    'sessions.from_session', 'sessions.to_session',
                                    'sub_courses.title as subcourse_name',
                                    'master_semesters.semester','master_semesters.id as semester_id')
                            ->leftJoin('students', 'students.id', '=', 'results.student_id')
                            ->leftJoin('sessions', 'sessions.id', '=', 'results.session')
                            ->leftJoin('master_semesters', 'master_semesters.id', '=', 'results.semester')
                            ->leftJoin('sub_courses', 'sub_courses.id', '=', 'results.subcourse_id')
                            ->where('results.id', $id)
                            ->first();

        $result_marksheet = ResultSubject::where('result_id', $id)->get();

        // Absolute path for background image
        // $backgroundImage = static_asset('assets/assets_web/certificate/icvt_result_template.jpg');
        $backgroundImage = public_path('assets/assets_web/certificate/icvt_result_template.jpg');
        // dd($backgroundImage);

         // Create folder if not exists
        $qrDir = public_path('qrcodes');
        if (!file_exists($qrDir)) {
            mkdir($qrDir, 0777, true);
        }

        // File path
        $qrPath = $qrDir . '/' . $result_details->id . '.png';

        // ✅ Generate and save QR code
        $qrImage = \QrCode::format('png')
            ->size(200)
            ->errorCorrection('H')
            ->generate(url('students/' . $result_details->id));

        file_put_contents($qrPath, $qrImage);


        $pdf = Pdf::loadView('admin.result.result_details_in_template_in_pdf', compact('qrPath', 'result_details', 'result_marksheet', 'backgroundImage'))
                ->setPaper('a4', 'portrait');

        return $pdf->download('Result_'.$result_details->roll_number.'.pdf');
    }

    public function viewCertificate(Request $request){

        $session_list = Session::get();
        $semester_list = MasterSemester::get();
        $course_list = Course::where('status', 1)->get();
        $subcourse_list = SubCourse::where('status', 1)->get();
        $get_results =  Result::select('results.*', 'students.english_name', 'students.subcourse_id', 'sessions.from_session', 'sessions.to_session', 'master_semesters.semester')
                                    ->leftJoin('students', 'students.id', '=', 'results.student_id')
                                    ->leftJoin('sessions', 'sessions.id', '=', 'results.session')
                                    ->leftJoin('master_semesters', 'master_semesters.id', '=', 'results.semester')
                                    ->where('results.course_id', $request->course_id)
                                    ->where('results.subcourse_id', $request->subcourse_id)
                                    ->where('results.session', $request->session)
                                    ->where('results.semester', $request->semester)
                                    ->latest()
                                    ->paginate(1000);
        return view('admin.certificate.view_certificate', compact('session_list', 'semester_list', 'course_list', 'subcourse_list', 'request', 'get_results'));
    }



    public function downloadStudentCertificatePDF($id)
    {
        $result_details =  Result::select('results.*',
                                    'students.english_name',
                                    'students.serial_number',
                                    'students.enrollment_number',
                                    'students.fathers_name',
                                    'students.mothers_name',
                                    'students.franchise_id',
                                    'students.roll_number',
                                    'students.image',
                                    'sessions.from_session', 'sessions.to_session',
                                    'sub_courses.title as subcourse_name',
                                    'master_semesters.semester')
                            ->leftJoin('students', 'students.id', '=', 'results.student_id')
                            ->leftJoin('sessions', 'sessions.id', '=', 'results.session')
                            ->leftJoin('master_semesters', 'master_semesters.id', '=', 'results.semester')
                            ->leftJoin('sub_courses', 'sub_courses.id', '=', 'results.subcourse_id')
                            ->where('results.id', $id)
                            ->first();

        $result_marksheet = ResultSubject::where('result_id', $id)->get();

        // Create folder if not exists
            $qrDir = public_path('qrcodes');
            if (!file_exists($qrDir)) {
                mkdir($qrDir, 0777, true);
            }

        // File path
            $qrPath = $qrDir . '/' . $result_details->id . '.png';

        // ✅ Generate and save QR code
            $qrImage = \QrCode::format('png')
                ->size(200)
                ->errorCorrection('H')
                ->generate(url('students/' . $result_details->id));

            file_put_contents($qrPath, $qrImage);

        // Absolute path for background image
        // $backgroundImage = static_asset('assets/assets_web/certificate/icvt_result_template.jpg');
        $backgroundImage = public_path('assets/assets_web/certificate/certificate_template.jpg');

        $pdf = Pdf::loadView('admin.certificate.certificate_details_in_template_in_pdf', compact('qrPath', 'result_details', 'result_marksheet', 'backgroundImage'))
                ->setPaper('a4', 'portrait');

        return $pdf->download('bihar_skill_certificate_'.$result_details->roll_number.'.pdf');
    }


    public function downloadStudentTypingCertificatePDF($id)
    {
        $result_details =  Result::select('results.*',
                                    'students.english_name',
                                    'students.serial_number',
                                    'students.enrollment_number',
                                    'students.fathers_name',
                                    'students.mothers_name',
                                    'students.franchise_id',
                                    'students.roll_number',
                                    'students.image',
                                    'sessions.from_session', 'sessions.to_session',
                                    'sub_courses.title as subcourse_name',
                                    'master_semesters.semester')
                            ->leftJoin('students', 'students.id', '=', 'results.student_id')
                            ->leftJoin('sessions', 'sessions.id', '=', 'results.session')
                            ->leftJoin('master_semesters', 'master_semesters.id', '=', 'results.semester')
                            ->leftJoin('sub_courses', 'sub_courses.id', '=', 'results.subcourse_id')
                            ->where('results.id', $id)
                            ->first();

        $result_marksheet = ResultSubject::where('result_id', $id)->get();

        // Create folder if not exists
            $qrDir = public_path('qrcodes');
            if (!file_exists($qrDir)) {
                mkdir($qrDir, 0777, true);
            }

        // File path
            $qrPath = $qrDir . '/' . $result_details->id . '.png';

        // ✅ Generate and save QR code
            $qrImage = \QrCode::format('png')
                ->size(200)
                ->errorCorrection('H')
                ->generate(url('students/' . $result_details->id));

            file_put_contents($qrPath, $qrImage);

        // Absolute path for background image
        // $backgroundImage = static_asset('assets/assets_web/certificate/icvt_result_template.jpg');
        $backgroundImage = public_path('assets/assets_web/certificate/typing_certificate_template.jpg');

        $pdf = Pdf::loadView('admin.certificate.typing_certificate_details_in_template_in_pdf', compact('qrPath', 'result_details', 'result_marksheet', 'backgroundImage'))
                ->setPaper('a4', 'portrait');

        return $pdf->download('bihar_skill_typing_certificate_'.$result_details->roll_number.'.pdf');
    }

    /** generate admit card */

    /*
    public function eAdmitCard(Request $request){
        $student_id = $request->student_id;
        $semester = $request->semester;
        $student = Student::find($student_id);
        if($student){
            // return view('admin.result.add_student_result_view', compact('student', 'student_id', 'semester'));
            return view('admin.admitcard.add_student_admitcard_view', compact('student', 'student_id', 'semester'));
        }else{
            return redirect('admin/generate-certificate')->with(session()->flash('alert-danger',  'Invalid Id'));
        }

    }
        */

    public function eAdmitCard(Request $request)
    {
        $check_admit_card = AdmitCard::where('semester', $request->semester)
                                    ->where('session', $request->session)
                                    ->where('course_id', $request->course_id)
                                    ->where('subcourse_id', $request->subcourse_id)
                                    ->first();
        return view('admin/admitcard/add_admitcard', compact('request', 'check_admit_card'));
    }

    public function saveAdmitCardDetails(Request $request){
        // dd($request->all());
        $request->validate([
            'subject_code' => 'required|array',
            'subject_name' => 'required|array',
            'exam_date' => 'required|array',
            'exam_time' => 'required|array',
            'semester' => 'required',
            'session' => 'required',
            'course_id' => 'required',
            'subcourse_id' => 'required',
            'exam_type' => 'required',
        ]);

        // 2. Check if Admit Card already exists for the given combination
            $existing = AdmitCard::where('semester', $request->semester)
            ->where('session', $request->session)
            ->where('course_id', $request->course_id)
            ->where('subcourse_id', $request->subcourse_id)
            ->first();

        if ($existing) {
            return redirect()->back()->with(session()->flash('alert-danger',  'Admit card already exists for this semester, session, course, and subcourse!'));
        }

        // 1. Save main admit card
        $admitCard = AdmitCard::create([
            'semester' => $request->semester,
            'session' => $request->session,
            'course_id' => $request->course_id,
            'subcourse_id' => $request->subcourse_id,
            'exam_type' => $request->exam_type,
        ]);

        // 2. Save subject-wise details
        foreach ($request->subject_code as $index => $code) {
            AdmitCardSubject::create([
                'admit_card_id' => $admitCard->id,
                'subject_code' => $code,
                'subject_name' => $request->subject_name[$index],
                'exam_date' => $request->exam_date[$index],
                'exam_time' => $request->exam_time[$index],
            ]);
        }

        // return back()->with('success', 'Admit card and subjects saved successfully!');
        return redirect()->back()->with(session()->flash('alert-success',  'Admit card and subjects saved successfully!'));
    }

    public function deleteStudentResultPDF($id)
    {
        // Delete ResultSubjects linked to this Result first
        ResultSubject::where('result_id', $id)->delete();
        // Then delete the main Result record
        Result::where('id', $id)->delete();
        return back()->with(session()->flash('alert-success',  'Result Deleted successfully!'));
    }

    

}
