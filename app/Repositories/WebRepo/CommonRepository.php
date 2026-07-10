<?php
namespace App\Repositories\WebRepo;
use App\Repositories\Interfaces\WebInterface\CommonRepositoryInterface;
use App\Models\CmsPage;
use App\Models\PageSection;
use App\Models\IndustryCmsPage;
use App\Models\IndustryPageSection;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\Category;
use App\Models\Blog;
use App\Models\BlogLike;
use App\Models\BlogComment;
use App\Models\BlogView;
use App\Models\CustomerLead;
use App\Models\ImageCategory;
use App\Models\Faq;
use App\Models\Career;
use App\Models\Staff;
use App\Models\JobEnquiry;
use App\Models\Subscriber;
use App\Models\Quote;
use App\Models\ScheduleMeeting;
use App\Models\PricingEnq;
use App\Models\Pricing;
use App\Models\MasterPartner;
use App\Models\PartnerSection;
use App\Models\MasterSolution;
use App\Models\SolutionSection;
use App\Models\MasterProduct;
use App\Models\HireTeam;
use App\Models\OnlineEnquiry;
use App\Models\Video;
use App\Models\EventCategory;
use App\Models\Tender;
use App\Models\Student;
use App\Models\Course;
use App\Models\RecruitedStudent;

use App\Mail\SendEnquiry;
use Illuminate\Support\Facades\Mail;


class CommonRepository implements CommonRepositoryInterface
{
    public function getImageCategory(){
        return ImageCategory::select('id', 'title', 'slug', 'image', 'created_at', 'description')->where('status', 1)->get();
    }

    public function getCourse(){
        return Course::select('*')->where('status', 1)->get();
    }

    public function getVideoList(){
        return Video::select('*')->where('status', 1)->get();
    }

    public function getHomePageBanner(){
        return Gallery::select('category_id', 'description', 'image')->where('category_id', 1)->where('status', 1)->get();
    }

    public function getPage($page_id){
        return CmsPage::select('*')->find($page_id);
    }

    public function getPageSectionData($page_id){
        return PageSection::select('id', 'page_id', 'section_name', 'title_green', 'title', 'description', 'image')->where('page_id', $page_id)->where('status', 1)->get();
    }

    // public function getStaffData($staff_type){
    //     return Staff::select('*')->where('type', $staff_type)->where('status', 1)->get();
    // }

    function getTeamList(){
        $staff_list = Staff::latest()->where('status', 1)->where('type', 'Main Staff')
        ->get();
        return $staff_list;
    }

    public function getPartnerList(){
        return Gallery::where('category_id',3)->get();
    }

    public function getIndustryPage($slug){
        return IndustryCmsPage::select('*')->where('page_url', $slug)->first();
    }

    public function getIndustryPageSections($page_id){
        return IndustryPageSection::select('id', 'page_id', 'section_name', 'title', 'description', 'image')->where('page_id', $page_id)->where('status', 1)->get();
    }

    public function storeContactEnquiry($data){
        $store_data = new CustomerLead;
        $store_data->first_name = $data['name'];
        // $store_data->last_name = $data['last_name'];
        $store_data->email = $data['email'];
        $store_data->phone = $data['phone'];
        $store_data->message = $data['message'];
        $store_data->project = $data['project'];
        $store_data->save();
        return $store_data;
    }

    public function postOnlineEnquiry($data){
        $save_d = new OnlineEnquiry;
        $save_d->first_name = $data['name'];
        // $save_d->last_name = $data['last_name'];
        $save_d->email = $data['email'];
        $save_d->phone = $data['phone'];
        $save_d->subject = '';
        $save_d->message = $data['message'];
        // $save_d->address = $data['address'];
        // $save_d->datetimee = $data['datetime'];
        // $save_d->page = 'registration';
        $save_d->save();
        return $save_d;
    }

    public function posthomePageEnquiry($data){
        $save_d = new OnlineEnquiry;
        $save_d->first_name = $data['name'];
        $save_d->email = $data['email'];
        $save_d->phone = $data['phone'];
        // $save_d->subject = $data['subject'];
        $save_d->message = $data['message'];
        $save_d->page = 'home_enquiry_form';
        $save_d->save();
        return $save_d;
    }

    public function poststoreComplain($data){
        $save_d = new OnlineEnquiry;
        $save_d->first_name = $data['name'];
        $save_d->email = $data['email'];
        $save_d->phone = $data['phone'];
        // $save_d->subject = $data['subject'];
        $save_d->message = $data['message'];
        $save_d->page = 'complain_enquiry_form';
        $save_d->save();
        return $save_d;
    }



    public function studentOnlineEnquiry($data){
        $save_d = new OnlineEnquiry;
        $save_d->first_name = $data['name'];
        // $save_d->last_name = $data['last_name'];
        $save_d->email = $data['email'];
        $save_d->phone = $data['phone'];
        $save_d->project = $data['department'];
        $save_d->message = $data['message'];
        $save_d->address = $data['address'];
        // $save_d->datetimee = $data['datetime'];
        $save_d->gender = $data['gender'];
        $save_d->page = 'student_enquiry';
        $save_d->save();
        return $save_d;
    }

    public function getTestimonial(){
        return Testimonial::select('*')->where('status', 1)->get();
    }

    public function getGallery(){
        return Gallery::select('*')->where('status', 1)->get();
    }

    public function getGalleryDetails($slug){
        return ImageCategory::select('*')->where('slug', $slug)->where('status', 1)->first();
    }

    public function photoGalleryDetails($id){
        return Gallery::select('*')->where('category_id', $id)->where('status', 1)->get();
    }

    public function getCategories($type){
        return Category::select('id', 'title', 'slug')->where('type', $type)->where('status', 1)->get();
    }

    public function getRecentPost($type, $category){
        return Blog::select('id', 'title','english_title', 'slug', 'blog_image', 'created_at')->where('type', $type)->where('category_id', $category)->where('status', 1)->latest()->limit(5)->get();
    }

    public function getRelatedPost($type, $category_id){
        return Blog::select('id', 'title', 'slug', 'blog_image', 'created_at')->where('category_id', $category_id)
            ->where('type', $type)->where('status', 1)
            ->latest()->limit(5)->get();
    }

    public function getBlogs($type, $cat_slug=null){
        $blogs = Blog::select('blogs.*', 'cat.title as parent_name', 'cat.slug as cat_slug', 'user.first_name')
            ->leftJoin('categories as cat', 'cat.id', '=', 'blogs.category_id')
            ->leftJoin('users as user', 'user.id', '=', 'blogs.created_by')
            ->where('blogs.type', $type)
            ->where('blogs.status', 1);
        if($cat_slug != null){
            $blogs = $blogs->where('cat.slug', $cat_slug);
        }
        $blogs= $blogs->latest()->paginate(10);

        $get_blogs_like = array();
        if(session('LoggedCustomer')){
            $get_blogs_like = BlogLike::select('blog_id', 'status')->where('user_id', session('LoggedCustomer')->user_id)->where('status', 1)->get();
        }

        foreach($blogs as $key => $list){
            $blogs[$key]->is_liked = 0;
            if($get_blogs_like != null){
                foreach($get_blogs_like as $like) {
                    if($like->blog_id == $list->id){
                        $blogs[$key]->is_liked = 1;
                    }
                }
            }
        }

        return $blogs;
    }

    public function getBlogList($category){
        $blog = Blog::where('category_id', $category)->paginate(15);
        return $blog;
    }

    public function getBlogDetail($slug, $ip){
        // dd($slug);
        $blog = Blog::select('*')->where('slug', $slug)->first();
        $this->storeViewBlogUser($blog->id, $ip);
        return $blog;
    }

    public function storeViewBlogUser($blog_id, $ip){
        $today = date('Y-m-d');
        $check_blog = BlogView::where('blog_id', $blog_id)->where('ip_address', $ip)->where('date', $today)->first();
        if(!$check_blog){
            $blog = new BlogView();
            $blog->ip_address = $ip;
            $blog->blog_id = $blog_id;
            $blog->date = $today;
            if($blog->save()){
                $update_blog = Blog::find($blog_id);
                $update_blog->total_view += 1;
                $update_blog->save();
            }
        }
    }

    public function applyBlogAction($data){
        $blog = BlogLike::where('blog_id', $data['blog_id'])->where('user_id', $data['user_id'])->first();
        if($blog){
            if($blog->status == 1){
                $blog->status = 0;
            }else{
                $blog->status = 1;
            }
        }else{
            $blog = new BlogLike();
            $blog->user_id = $data['user_id'];
            $blog->blog_id = $data['blog_id'];
            $blog->status = 1;
        }
        if($blog->save()){
            $update_blog = Blog::find($data['blog_id']);
            if($blog->status == 1){
                $update_blog->total_like += 1;
            }else{
                $update_blog->total_like -= 1;
            }
            $update_blog->save();
        }

        $get_blog = BlogLike::select('blog_likes.*', 'blogs.total_like', 'blogs.total_comment')
            ->leftJoin('blogs', 'blog_likes.blog_id', '=', 'blogs.id')
            ->where('blog_likes.blog_id', $data['blog_id'])
            ->where('blog_likes.user_id', $data['user_id'])
            ->first();

        return $get_blog;
    }

    public function storeBlogComment($data){
        $blog = new BlogComment();
        // $blog->user_id = session('LoggedCustomer')->user_id;
        $blog->blog_id = $data['blog_id'];
        $blog->comment = $data['comment'];
        $blog->name = $data['name'];
        $blog->email = $data['email'];
        $blog->status = 0;
        $blog->save();

        return $blog;

    }

    // public function getBlogComments($blog_id){
    //     $get_blog = BlogComment::select('blog_comments.*', 'users.first_name', 'users.last_name')
    //         ->leftJoin('users', 'users.id', '=', 'blog_comments.user_id')
    //         ->where('blog_comments.blog_id', $blog_id)
    //         ->where('blog_comments.status', 1)
    //         ->latest()
    //         ->get();
    //     return $get_blog;
    // }

    public function getBlogComments($blog_id){
        $get_blog = BlogComment::where('blog_id', $blog_id)
            ->where('blog_comments.status', 1)
            ->latest()
            ->get();
        return $get_blog;
    }

    public function getFaqs(){
        $faq = Faq::where('faq_type', 0)->where('status', 1)->get();
        // dd($faq);
        return $faq;
    }

    public function getCareerList(){
        return Career::select('*')->where('status', 1)->get();
    }

    public function getCareerDetail($career_id){
        return Career::find($career_id);
    }

    public function storeCareerEnquiry($data){
        return JobEnquiry::create($data);
    }

    public function storeCareerData($data){
        // return JobEnquiry::create($data);
        $job_enq = new JobEnquiry;
        $job_enq->first_name = $data['first_name'];
        $job_enq->last_name = $data['last_name'];
        $job_enq->email = $data['email'];
        $job_enq->phone = $data['phone'];
        $job_enq->apply_for = $data['apply_for'];
        $job_enq->message = $data['message'];
        $job_enq->resume = $data['resume'];
        $job_enq->save();
        return $job_enq;
    }

    public function storeHireTeam($data){
        return HireTeam::create($data);
    }

    public function storeNewsletter($data){
        return Subscriber::create($data);
    }

    function getAwardList(){
        return Gallery::where('category_id', 6)->where('status', 1)->get();
    }

    function getCertificateList(){
        return Gallery::where('category_id', 7)->where('status', 1)->get();
    }

    public function storeQuoteData($data){
        return Quote::create($data);
    }

    public function storeScheduleMeetings($data){
        return ScheduleMeeting::create($data);
    }

    public function storePricingEnquiries($data){
        $get_price_data = Pricing::select('id', 'product_id', 'fields', 'price')->where('id', $data['pricing_id'])->first();
        $get_product_fields = MasterProduct::select('id', 'title', 'table_fields')->where('id', $get_price_data->product_id)->first();
        // dd(json_encode($get_product_fields->table_fields));
        $store_price_enq = new PricingEnq();
        $store_price_enq->name = $data['name'];
        $store_price_enq->phone = $data['phone'];
        $store_price_enq->email = $data['email'];
        $store_price_enq->skype = $data['skype'];
        $store_price_enq->pricing_id = $data['pricing_id'];
        $store_price_enq->message = $data['message'];
        $store_price_enq->full_entry = $get_price_data['fields'];
        $store_price_enq->price = $get_price_data['price'];
        if($store_price_enq->save()){
            Mail::to("clenquiry@cloudwareindia.com")->send(new SendEnquiry($data, $get_price_data, $get_product_fields));
        }
    }

    public function getPartnerDetails($slug){
        return MasterPartner::select('*')->where('slug', $slug)->first();
    }

    public function getPartnerSection($page_id){
        return PartnerSection::select('id', 'page_id', 'section_name', 'title', 'description', 'image')->where('page_id', $page_id)->where('status', 1)->get();
    }

    public function getIndustryDetails($slug){
        return IndustryCmsPage::select('*')->where('page_url', $slug)->first();
    }

    public function getIndustrySection($page_id){
        return IndustryPageSection::select('id', 'page_id', 'section_name', 'title', 'description', 'image')->where('page_id', $page_id)->where('status', 1)->get();
    }

    public function getSolutionDetails($slug){
        return MasterSolution::select('*')->where('page_url', $slug)->first();
    }

    public function getSolutionSection($page_id){
        return SolutionSection::select('id', 'page_id', 'section_name', 'title', 'description', 'image')->where('page_id', $page_id)->where('status', 1)->get();
    }

    public function getCommonFaqList($data){
        // dd($data);
        return Faq::where('faq_type', 0)->where('faq_category', $data['product_id'])->where('status', 1)->get();
    }

    public function getLatestPhotosCategory(){
        return ImageCategory::where('status', 1)->latest()->paginate(15);
    }

    public function getLatestEventCategory(){
        return EventCategory::where('status', 1)->latest()->paginate(15);
    }

    public function getLatestTenders(){
        return Tender::orderBy('id', 'DESC')->paginate(25);
    }

    public function checkStudents($enrollment_number, $dob){
        // return Student::where('enrollment_number', $enrollment_number)->where('dob', $dob)->first();
        $students = Student::select('students.*', 'c.courseTitle as course_name', 'sc.title as subcourse_name')
            ->leftJoin('courses as c', 'c.id', '=', 'students.course_id')
            ->leftJoin('sub_courses as sc', 'sc.id', '=', 'students.subcourse_id')
            ->where('enrollment_number', $enrollment_number)
            ->where('dob', $dob)
            ->first();
            return $students;
    }

    public function recruitedStudentsList(){
        return RecruitedStudent::where('status', 1)->get();
    }





}
