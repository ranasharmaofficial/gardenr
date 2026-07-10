<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Models\UserLogin;
use App\Models\Notification;
use App\Models\Course;
use App\Models\SubCourse;
use App\Models\User;
use App\Models\Student;
use App\Models\State;
use App\Models\ManualResult;
use App\Models\ManualResultSubject;
use App\Models\AdmitCard;
use App\Models\AdmitCardSubject;
use App\Models\Session;
use App\Models\MasterSemester;
use App\Models\Result;
use App\Models\ResultSubject;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{
    private $studentRepository;
    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function getSubCourse(Request $request)
    {
        $data['subcourse'] = SubCourse::where("course_id",$request->course)
                    ->get(["title","id"]);
        return response()->json($data);
    }

    public function studentDashboard()
    {
        $data = $this->studentRepository->dashboardDataCount();
        // dd($data);
        return view('student.dashboard.dashboard_view', compact('data'));
    }

    public function studyMaterial(){
        return view('student.student.coming_soon');
    }

    public function viewManualResult(){
        $student_list = $student = session('LoggedStudent');
        return view('student.result.student_manual_result', compact('student_list'));
    }

    public function viewManualResultDetails(Request $request){
        $student_id = $request->student_id;
        $semester = $request->semester;
        $student = Student::find($student_id);

        $result_added = ManualResult::where('student_id', $student_id)->where('semester', $semester)->first();
        // dd($semester);
        // dd($result_subjects);
        if($student && $result_added){
            $result_subjects = ManualResultSubject::where('result_id', $result_added->id)->get();
            $franchise_details = User::where('id', $student->franchise_id)->pluck('partner_code')->first();
            return view('student.result.view_manual_student_result', compact('student', 'result_added', 'result_subjects', 'franchise_details'));
        }else{
            return redirect()->back()->with(session()->flash('alert-danger', 'Result not Added'));
        }
    }



    public function myProfile(){
        $student = session('LoggedStudent');
        return view('student.student.my_profile', compact('student'));
    }

    // public function fundReceived(){
    //     $user_id = session('LoggedStudent')->user_id;
    //     $data = $this->studentRepository->getFundReceived($user_id);
    //     return view('franchise.fund.fund_received', compact('data'));
    // }

    public function viewIdCard(){
        $student_list = $student = session('LoggedStudent');
        return view('student.student.student_id_card', compact('student_list'));
    }

    public function admitCard(){
        $student_list = $student = session('LoggedStudent');
        return view('student.student.admit_card', compact('student_list'));
    }

    public function generateStudentAdmitCard(Request $request){
        // dd($request->all());
        $student = $request->student_id;
        $session = $request->session;
        $semester = $request->semester;
        $course_id = $request->course_id;
        $subcourse_id = $request->subcourse_id;

        $student_details = Student::find($student);
        $semester_details = MasterSemester::find($semester);
        $session_details = Session::find($session);
        $course_details = Course::find($course_id);
        $subcourse_details = SubCourse::find($subcourse_id);

        $check_admit_card = AdmitCard::where('semester', $request->semester)
                                    ->where('session', $request->session)
                                    ->where('course_id', $request->course_id)
                                    ->where('subcourse_id', $request->subcourse_id)
                                    ->first();
        // dd($check_admit_card);
        if($check_admit_card){
            $backgroundImage = public_path('assets/assets_web/certificate/admit_card_template.jpg');
            // dd($backgroundImage);
            $pdf = Pdf::loadView('student.student.admitcard_details_in_template_in_pdf',
             compact('student_details', 'semester_details', 'subcourse_details', 'session_details', 'course_details', 'backgroundImage', 'check_admit_card'))
                    ->setPaper('a4', 'portrait');

            return $pdf->download('student-admitcard_'.$student_details->roll_number.'.pdf');
        }else{
            return redirect()->back()->with(session()->flash('alert-danger',  'Data not found!'));
        }

    }



    /** student result */

    public function viewResult(Request $request){
        $student_list = $student = session('LoggedStudent');

        $check_result = null;

        if ($request->has('submit')) {
            $student = $request->student_id;
            $session = $request->session;
            $semester = $request->semester;
            $course_id = $request->course_id;
            $subcourse_id = $request->subcourse_id;

            $check_result = Result::select('results.*',
                                    'students.english_name',
                                    'students.serial_number',
                                    'students.subcourse_id',
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
                            ->where('results.session', $session)
                            ->where('results.semester', $semester)
                            ->where('results.course_id', $course_id)
                            ->where('results.subcourse_id', $subcourse_id)
                            ->where('results.student_id', $student)
                            ->get();
        }
        return view('student.student.view_result', compact('student_list', 'check_result', 'request'));
    }

    public function generateStudentResult(Request $request){
        // dd($request->all());
        $student = $request->student_id;
        $session = $request->session;
        $semester = $request->semester;
        $course_id = $request->course_id;
        $subcourse_id = $request->subcourse_id;

        $student_details = Student::find($student);
        $semester_details = MasterSemester::find($semester);
        $session_details = Session::find($session);
        $course_details = Course::find($session);
        $subcourse_details = SubCourse::find($subcourse_id);

        $check_admit_card = AdmitCard::where('semester', $request->semester)
                                    ->where('session', $request->session)
                                    ->where('course_id', $request->course_id)
                                    ->where('subcourse_id', $request->subcourse_id)
                                    ->first();

        $backgroundImage = public_path('assets/assets_web/certificate/admit_card_template.jpg');


        // dd($backgroundImage);
        $pdf = Pdf::loadView('student.student.admitcard_details_in_template_in_pdf',
         compact('student_details', 'semester_details', 'subcourse_details', 'session_details', 'course_details', 'backgroundImage', 'check_admit_card'))
                ->setPaper('a4', 'portrait');

        return $pdf->download('admitcard_'.$student_details->roll_number.'.pdf');
    }

    public function downloadStudentResult($id)
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
        $pdf = Pdf::loadView('student.result.result_details_in_template_in_pdf', compact('qrPath', 'result_details', 'result_marksheet', 'backgroundImage'))
                ->setPaper('a4', 'portrait');

        return $pdf->download('student_result_'.$result_details->english_name.'-'.$result_details->roll_number.'.pdf');
    }

    public function downloadStudentCertificate($id)
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

        $backgroundImage = public_path('assets/assets_web/certificate/certificate_template.jpg');
        // dd($backgroundImage);
        $pdf = Pdf::loadView('student.result.certificate_details_in_template_in_pdf', compact('qrPath', 'result_details', 'result_marksheet', 'backgroundImage'))
                ->setPaper('a4', 'portrait');

        return $pdf->download('student_certificate_'.$result_details->english_name.'-'.$result_details->roll_number.'.pdf');
    }

     public function downloadStudentTypingCertificate($id)
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

        $backgroundImage = public_path('assets/assets_web/certificate/typing_certificate_template.jpg');
        // dd($backgroundImage);
        $pdf = Pdf::loadView('student.result.typing_certificate_details_in_template_in_pdf', compact('qrPath', 'result_details', 'result_marksheet', 'backgroundImage'))
                ->setPaper('a4', 'portrait');

        return $pdf->download('student_certificate_'.$result_details->english_name.'-'.$result_details->roll_number.'.pdf');
    }








}
