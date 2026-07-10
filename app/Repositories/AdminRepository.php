<?php
namespace App\Repositories;
use App\Repositories\Interfaces\AdminRepositoryInterface;
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
use App\Models\Subject;

class AdminRepository implements AdminRepositoryInterface
{
    public function dashboardDataCount(){
        $user_count = User::where(['user_type_id' => 3, 'status' => 1])->count();
        $category_count = Category::where('parent_id', 0)->where('status', 1)->count();
        $subcategory_count = Category::where('parent_id', '!=', 0)->where('status', 1)->count();
        $blog_count = Blog::where('status', 1)->count();
        $blog_like_count = Blog::where('status', 1)->sum('total_like');
        $blog_comment_count = Blog::where('status', 1)->sum('total_comment');
        $blog_view_count = Blog::sum('total_view');
        $image_category_count = ImageCategory::count();
        $gallery_count = Gallery::count();
        $page_count = CmsPage::where('status', 1)->count();
        $product_count = MasterProduct::where('status', 1)->count();
        $service_count = MasterService::where('status', 1)->count();
        $customer_lead = CustomerLead::count();
        $job_enquiry_count = JobEnquiry::count();
        $hire_request_count = HireTeam::count();
        $subscriber_count = Subscriber::count();
        $testimonial_count = Testimonial::count();
        $product_enquiry_count = OnlineEnquiry::where('page', null)->count();
        $homepage_enquiry_count = OnlineEnquiry::where('page', 'home_enquiry_form')->count();
        $complain_count = OnlineEnquiry::where('page', 'complain_enquiry_form')->count();
        $total_tender = Tender::count();
        $total_student = Student::count();
        $total_fund_disbursed = Fund::sum('amount');

        $data = [
            'user_count' => $user_count,
            'category_count' => $category_count,
            'subcategory_count' => $subcategory_count,
            'blog_count' => $blog_count,
            'blog_like_count' => $blog_like_count,
            'blog_comment_count' => $blog_comment_count,
            'blog_view_count' => $blog_view_count,
            'image_category_count' => $image_category_count,
            'gallery_count' => $gallery_count,
            'page_count' => $page_count,
            'product_count' => $product_count,
            'service_count' => $service_count,
            'customer_lead' => $customer_lead,
            'job_enquiry_count' => $job_enquiry_count,
            'hire_request_count' => $hire_request_count,
            'subscriber_count' => $subscriber_count,
            'testimonial_count' => $testimonial_count,
            'product_enquiry_count' => $product_enquiry_count,
            'homepage_enquiry_count' => $homepage_enquiry_count,
            'complain_count' => $complain_count,
            'total_tender' => $total_tender,
            'total_student' => $total_student,
            'total_fund_disbursed' => $total_fund_disbursed,
        ];
        return $data;
    }

    public function notificationList(){
        return Notification::latest()->get();
    }

    public function storeFund($data){
        $fund = new Fund;
        $fund->user_id = $data['user_id'];
        $fund->amount = $data['amount'];
        $fund->currentdate = $data['amount'];
        $fund->currenttime = $data['amount'];
        $fund->save();
    }

    public function getFundList(){
      return Fund::get();
    //   $funds = Fund::select('funds.*', 'users.first_name as FirstName')
    //         ->leftJoin('users', 'funds.user_id', '=', 'users.id')
    //         // ->leftJoin('user_types', 'users.user_type_id', '=', 'user_types.id')
    //         // ->orderBy('funds.id', 'DESC')
    //         ->paginate(1000);
            // ->get();
        return $funds;
    }

    public function updateStudentDetails($data){
        $students = Student::where('id', $data['student_id'])->first();
        $students->course_id = $data['course_id'];
        $students->subcourse_id = $data['subcourse_id'];
        if($data['image']!=null){
            $students->image = $data['image'];
        }
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

    public function getSubjectList($data)
    {
        // dd($data);
        $query = Subject::select('subjects.*', 'courses.courseTitle', 'sub_courses.title')
            ->leftJoin('courses', 'courses.id', '=', 'subjects.course_id')
            ->leftJoin('sub_courses', 'sub_courses.id', '=', 'subjects.sub_course_id');

        if ($data['course_id']!=null) {
            $query->where('subjects.course_id', $data['course_id']);
        }

        if (!is_null($data['course_id']) && !is_null($data['subcourse_id'])) {
            $query->where('subjects.sub_course_id', $data['subcourse_id']);
        }

        return $query->orderBy('subjects.id', 'desc')->paginate(1000);

    }


}
