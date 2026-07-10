<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use Session;
use App\Repositories\Interfaces\WebInterface\CommonRepositoryInterface;
use App\Models\ImageCategory;
use App\Models\Gallery;
use App\Models\Staff;
use App\Models\Video;
use App\Models\Course;
use App\Models\SubCourse;
use App\Models\User;
use App\Models\State;
use App\Models\RecruitedStudent;
use App\Models\ManualResult;
use App\Models\ManualResultSubject;
use App\Models\Result;
use App\Models\Student;
use App\Models\District;
use App\Models\Block;
use App\Models\Panchayat;
use App\Models\HomeBanner;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;
class CommonController extends Controller
{
    private $webRepository;

    public function __construct(CommonRepositoryInterface $webRepository)
    {
        $this->webRepository = $webRepository;
    }

    // getDistrictByState

    public function getDistrictByState($state_id)
    {
        $cities = District::where('state_id', $state_id)->get(['id', 'name']);
        return response()->json($cities);
    }

    public function getBlockByDistrict($state_id)
    {
        $cities = Block::where('district_id', $state_id)->get(['id', 'name', 'status']);
        return response()->json($cities);
    }

    public function getPanchayatByBlock($state_id)
    {
        $cities = Panchayat::where('block_id', $state_id)->get(['id', 'name', 'status']);
        return response()->json($cities);
    }

    public function index(){
        $page = $this->webRepository->getPage(1);
        $datas = [
            'banners' => $this->webRepository->getHomePageBanner(),
            'courses' => $this->webRepository->getCourse(),
            'subcourseList' => SubCourse::where('status',1)->get(),
            'homeBanner' => HomeBanner::where('status',1)->get(),
            'recruited_students' => $this->webRepository->recruitedStudentsList(),
            'gallery_category' =>  $this->webRepository->getImageCategory(),
            'page' => $page,
            'section_lists' => $this->webRepository->getPageSectionData($page->id),
            'featured_products' => Product::where('is_featured', 1)->where('status', 1)->get(),
            'new_products' => Product::where('is_new', 1)->where('status', 1)->latest()->take(10)->get(),
            'all_products' => Product::where('status', 1)->latest()->take(12)->get(),
            'categories' => ProductCategory::where('status', 1)->get(),
        ];
        return view('frontend.index', $datas);
    }

    public function shopPage(Request $request){
        $categories = ProductCategory::where('status', 1)->get();
        $query = Product::where('status', 1);
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        $products = $query->latest()->paginate(12);
        return view('frontend.shop', compact('products', 'categories'));
    }

    public function shopByCategory($slug){
        $category = ProductCategory::where('slug', $slug)->where('status', 1)->first();
        if (!$category) {
            return redirect()->route('shop');
        }
        $categories = ProductCategory::where('status', 1)->get();
        $products = Product::where('category_id', $category->id)->where('status', 1)->latest()->paginate(12);
        return view('frontend.shop', compact('products', 'categories', 'category'));
    }

    public function productDetails($slug){
        $product = Product::where('slug', $slug)->first();
        if($product){
            $datas = [
                'product' => $product,
                'product_images' => ProductImage::where('product_id', $product->id)->get(),
            ];
            return view('frontend.product_details', $datas);
        }
        return redirect()->back();
    }



    public function course(){
        $courses = $this->webRepository->getCourse();
        return view('frontend.course', compact('courses'));
        // $subcourseList = SubCourse::where('status',1)->get();
        // return view('frontend.coursesingle', compact('subcourseList'));
    }

    public function ourFranchise(Request $request){
        if($request->state!=null){
            $approved_franchise = User::where('user_type_id', 2)->where('state', $request->state)->where('city', $request->city)->where('status', 1)->get();
        }else{
            $approved_franchise = null;
        }

        // dd($approved_franchise);
        $state_list = State::get();
        return view('frontend.our_franchise', compact('approved_franchise', 'state_list', 'request'));
    }
    public function ourTeam(){
        $team_list = User::where('user_type_id', 5)->where('status', 1)->get();
        return view('frontend.our_team', compact('team_list'));
    }

    public function courseDetails($courseslug){
        $coursedetails = Course::where('slug',$courseslug)->first();
        $subcourseList = SubCourse::where('course_id',$coursedetails->id)->get();
        return view('frontend.coursesingle', compact('coursedetails', 'subcourseList'));
    }

    public function SubcourseDetails($slug){
        $subcourse = SubCourse::where('slug',$slug)->first();
        $coursedetails = Course::where('id', $subcourse->course_id)->first();
        return view('frontend.sub_course_details', compact('coursedetails', 'subcourse'));
    }

    public function minfertBlk(){
        return view('frontend.pages.minfert-blk');
    }

    public function blkLiquid(){
        return view('frontend.pages.blk-liquid');
    }
    public function gbr(){
        return view('frontend.pages.gbr');
    }

    public function geocare(){
        return view('frontend.pages.geocare');
    }

    public function reskue(){
        return view('frontend.pages.reskue');
    }

    public function humicrons(){
        return view('frontend.pages.humicrons');
    }

    public function thripsKranti(){
        return view('frontend.pages.thripsKranti');
    }

    public function tigerBooster(){
        return view('frontend.pages.tigerBooster');
    }

    // public function index(){
    //     return view('frontend.index');
    // }
    public function aboutUs(){
        return view('frontend.about');
    }

    public function whyChooseUs(){
        return view('frontend.pages.why_choose_us');
    }

    public function qualityPolicy(){
        return view('frontend.pages.quality_policy');
    }

    public function manufacturingMarketing(){
        return view('frontend.manufacturing_marketing');
    }

    public function certificate(){
        return view('frontend.pages.certificate');
    }

    public function enquiry(){
        return view('frontend.enquiry');
    }

    public function career(){
        return view('frontend.career');
    }

    public function contact_us(){
       return view('frontend.contact_us');
    }

    public function complain(){
        return view('frontend.complain');
     }

    public function therapies(){
        return view('frontend.therapies');
    }

    public function photoGallery(){
        $gallery_category =  $this->webRepository->getImageCategory();
        // dd($gallery_category);
        return view('frontend.photo_gallery', compact('gallery_category'));
    }

    public function videoGallery(){
        $videoList =  $this->webRepository->getVideoList();
        return view('frontend.video_gallery', compact('videoList'));
    }

    public function photoGalleryDetails($slug){
        $cat_details =  $this->webRepository->getGalleryDetails($slug);
        if($cat_details){
            $gallery_details =  $this->webRepository->photoGalleryDetails($cat_details->id);
            return view('frontend.gallery_details', compact('gallery_details','cat_details'));
        }else{
           return redirect('');
        }
     // dd($gallery_list);
    }

    public function careerDetails(Request $request){
        $career = $this->webRepository->getCareerDetail($request->career_id);
        if($request->career_id != null && $career != null){
            return view('frontend.insights.career_detail', ['career' => $career]);
        }else{
            abort(404);
        }
    }

    public function postOnlineEnquiry(Request $request){
        $data = $request->validate([
            'name' => 'required',
            // 'last_name' => 'required',
            'subject' => 'nullable',
            'phone' => 'required|digits:10|regex:/^[0-9]{10}$/',
            'email' => 'required|email',
            'message' => 'required',
            // 'address' => 'required',
            // 'datetime' => 'required',
            // 'services' => 'required',
            // 'gender' => 'required',
        ]);
        // dd($data);
        $save_data = $this->webRepository->postOnlineEnquiry($data);
        if (!$save_data) {
            return response()->json([
                "status" => false,
            ]);
        } else {
            return response()->json([
                "status" => true,
            ]);

        }
    }

    public function homePageEnquiry(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required|digits:10|regex:/^[0-9]{10}$/',
            'email' => 'required|email',
            'message' => 'required',
            'project' => 'nullable',
        ]);
        // dd($data);
        $save_data = $this->webRepository->posthomePageEnquiry($data);
        if (!$save_data) {
            return response()->json([
                "status" => false,
            ]);
        } else {
            return response()->json([
                "status" => true,
            ]);

        }
    }

    public function storeComplain(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required|digits:10|regex:/^[0-9]{10}$/',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        // dd($data);
        $save_data = $this->webRepository->poststoreComplain($data);
        if (!$save_data) {
            return response()->json([
                "status" => false,
            ]);
        } else {
            return response()->json([
                "status" => true,
            ]);

        }
    }

    public function studentOnlineEnquiry(Request $request){
        $data = $request->validate([
            'name' => 'required',
            // 'last_name' => 'required',
            // 'project' => 'required',
            'phone' => 'required|digits:10|regex:/^[0-9]{10}$/',
            'email' => 'required|email',
            'message' => 'required',
            'address' => 'required',
            // 'datetime' => 'required',
            'department' => 'required',
            'gender' => 'required',
        ]);
        // dd($data);
        $save_data = $this->webRepository->studentOnlineEnquiry($data);
        if (!$save_data) {
            return response()->json([
                "status" => false,
            ]);
        } else {
            return response()->json([
                "status" => true,
            ]);

        }
    }

        public function careerEnquiry(Request $request){
            $data = $request->validate([
                'post' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|max:15',
                // 'gender' => 'required',
                'resume'   => 'required|mimes:doc,pdf,docx',
                'message' => 'required',
            ]);

            if($request->has('resume')){
                $data['resume'] = upload_asset($request->resume, "resume");
            }else{
                $data['resume'] = NULL;
            }
            $this->webRepository->storeCareerEnquiry($data);
            return redirect("index")->with(session()->flash('alert-success', 'Thankyou contacting with us. Our Team will contact you soon...'));
        }

        public function storeCareerData(Request $request){

            $data = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|numeric',
                'apply_for' => 'required',
                // 'gender' => 'required',
                'resume'   => 'required|mimes:doc,pdf,docx',
                'message' => 'required',
            ]);
            if ($request->has('resume')) {
                $file = $request->file('resume');
                $extenstion = $file->getClientOriginalExtension();
                $document_name = 'resume-' . time() . '.' . $extenstion;
                $file->move(public_path('uploads/resume'), $document_name);
            } else {
                $document_name = null;
            }
            $data['resume'] = $document_name;
            // return redirect("index")->with(session()->flash('alert-success', 'Thank You. Our Team will contact you soon...'));
            $save_data = $this->webRepository->storeCareerData($data);
            if (!$save_data) {
                return response()->json([
                    "status" => false,
                ]);
            } else {
                return response()->json([
                    "status" => true,
                ]);

            }
        }

        public function hireTeam(){
            return view('frontend.hire_team');
        }

        public function storeHireTeam(Request $request){
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|numeric',
                'gender' => 'required',
                'resume'   => 'nullable|mimes:doc,pdf,docx',
                'message' => 'required',
            ]);

            if($request->has('resume')){
                $data['resume'] = upload_asset($request->resume, "resume", "local");
            }else{
                $data['resume'] = NULL;
            }
            $this->webRepository->storeHireTeam($data);

            return redirect("hire-team")->with(session()->flash('alert-success', 'Thank You. Our Team will contact you soon...'));
        }

        public function faqs(){
            $page = $this->webRepository->getPage(8);
            $datas = [
                'page' => $page,
                'section_lists' => $this->webRepository->getPageSectionData($page->id),
                'faqs' => $this->webRepository->getFaqs(),
            ];
            return view('frontend.insights.faq', $datas);
        }

        public function videos(){
            $page = $this->webRepository->getPage(16);
            $datas = [
                'page' => $page,
                'section_lists' => $this->webRepository->getPageSectionData($page->id),
            ];
            return view('frontend.insights.videos', $datas);
        }

        public function projects(){
            $page = $this->webRepository->getPage(17);
            $datas = [
                'page' => $page,
                'section_lists' => $this->webRepository->getPageSectionData($page->id),
            ];
            return view('frontend.insights.project', $datas);
        }

        public function galleries(){
            $page = $this->webRepository->getPage(18);
            $datas = [
                'page' => $page,
                'section_lists' => $this->webRepository->getPageSectionData($page->id),
                'categories' => $this->webRepository->getImageCategory(),
                'galleries' => $this->webRepository->getGallery(),
            ];
            return view('frontend.insights.gallery', $datas);
        }
    /** Insights Section End */

    /** News Section Start */
        public function newsListing(){
            $data = [
                'news' => $this->webRepository->getBlogs('news'),
                'categories' => $this->webRepository->getCategories('news'),
                'recent_posts' => $this->webRepository->getRecentPost('news'),
            ];
            // dd($data);
            return view('frontend.news.list', $data);
        }

        public function newsSlugListing($cat_slug){
            $data = [
                'news' => $this->webRepository->getBlogs('news', $cat_slug),
                'categories' => $this->webRepository->getCategories('news'),
                'recent_posts' => $this->webRepository->getRecentPost('news'),
            ];
            return view('frontend.news.list', $data);
        }

        public function newsDetail(Request $request, $slug){
            $ip = $request->ip();
            $post = $this->webRepository->getBlogDetail($slug, $ip);
            $data = [
                'post' => $post,
                'categories' => $this->webRepository->getCategories('news'),
                'recent_posts' => $this->webRepository->getRecentPost('news'),
                'related_posts' => $this->webRepository->getRelatedPost('news', $post->category_id),
            ];

            return view('frontend.news.details', $data);
        }
    /** News Section End */


    /** Event Section Start */
        public function eventListing(){
            $data = [
                'event_category' => ImageCategory::latest()->get(),
                'categories' => $this->webRepository->getCategories('event'),
                // 'recent_posts' => $this->webRepository->getRecentPost('event'),
            ];
            // dd($data);
            return view('frontend.events.events', $data);
        }

        public function eventSlugListing($cat_slug){
            $check_gallery_slug = ImageCategory::where('slug', $cat_slug)->first();
            if($check_gallery_slug){
                $data = [
                    'gallery_list' => Gallery::where('category_id', $check_gallery_slug->id)->get(),
                ];
                return view('frontend.events.gallery_list', $data);
            }else{
                return redirect('');
            }

        }

        public function eventDetail(Request $request, $slug){
            $ip = $request->ip();
            $post = $this->webRepository->getBlogDetail($slug, $ip);
            $data = [
                'post' => $post,
                'categories' => $this->webRepository->getCategories('event'),
                'recent_posts' => $this->webRepository->getRecentPost('event'),
                'related_posts' => $this->webRepository->getRelatedPost('event', $post->category_id),
            ];

            return view('frontend.events.details', $data);
        }
    /** Event Section End */

    /** Blog Section Start */
        public function blogListing(){
            $data = [
                'blogs' => $this->webRepository->getBlogs('blog'),
                'categories' => $this->webRepository->getCategories('blog'),
                // 'recent_posts' => $this->webRepository->getRecentPost('blog'),
            ];
            // dd($data);
            return view('frontend.blogs', $data);
        }

        public function blogSlugListing($cat_slug){
            $data = [
                'blogs' => $this->webRepository->getBlogs('blog', $cat_slug),
                'categories' => $this->webRepository->getCategories('blog'),
                // 'recent_posts' => $this->webRepository->getRecentPost('blog'),
            ];
            return view('frontend.blogs', $data);
        }

        public function blogDetail(Request $request, $slug){
            $ip = $request->ip();
            $post = $this->webRepository->getBlogDetail($slug, $ip);
            if($post){
                $data = [
                    'post' => $post,
                    'categories' => $this->webRepository->getCategories('blog'),
                    // 'recent_posts' => $this->webRepository->getRecentPost('blog'),
                    // 'related_posts' => $this->webRepository->getRelatedPost('blog', $post->category_id),
                ];
                return view('frontend.blog_details', $data);
            }else{
                return redirect('');
            }

        }



        public function storeBlogComment(Request $request){
            $data = $request->validate([
                'blog_id' => 'required',
                'comment' => 'required',
                // 'comment' => 'required|max:160',
                'name' => 'required',
                'email' => 'required',
            ]);

            $response = $this->webRepository->storeBlogComment($data);
            if($response){
                return response($response);
            }else{
                return 'false';
            }

        }

        public function showBlogComments(Request $request){
            $data = $request->validate([
                'blog_id' => 'required',
            ]);

            $response = $this->webRepository->getBlogComments($request->blog_id);
            // dd($response);
            $output = '';

            if($response != null){
                foreach($response as $res){
                    //$output .= '<div class="comment"><div class="comment-body"><div class="comment-meta"><div class="comment-meta-author"><a href="#">'.$res->first_name. ' ' .$res->last_name.'</a></div>';
                    //$output .= '<div class="comment-meta-date">'.$res->created_at.'</div></div>';
                   // $output .= ' <div class="comment-content"><p>'.$res->comment.'</p></div></div></div>';

                    $output.='<div class=" d-flex">
                    <div class="commetn-img w-10">
                       <img src="'.static_asset('assets/assets_web/img/blog1.png').'" alt="comment" class="w-50px h-50px p-1 shadow  rounded-circle ">
                    </div>
                    <div class="comment-text w-90">
                       <h2 class="fs-16 lsp-5 text-block fw-bold">'.$res->name.'</h2>
                       <em class="fs-12 lsp-5">'.convert_datetime_to_date_format($res->created_at, 'd M Y').'</em>
                       <p>'.$res->comment.'</p>
                       <a href="javascript:void();" class="bg-sky w-120 h-35px d-block fs-13 lsp-5 text-center lh-35 text-white rounded-1">Reply</a>
                    </div>
                 </div></br>';

                }
            }
            return Response::json([
                'status' => true,
                'data' => $output,
            ], 200);
        }
    /** Blog Section End */
/**
 *
 * <div class=" d-flex">  */

    // public function contact_us(){
    //     $page = $this->webRepository->getPage(3);
    //         $datas = [
    //             'page' => $page,
    //             'section_lists' => $this->webRepository->getPageSectionData($page->id),
    //         ];
    //     return view('frontend.contact_us', $datas);
    // }

    public function postContactEnquiry(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'project' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10|regex:/^[0-9]{10}$/',
            'message' => 'required',
            // /'course' => 'required',
        ]);
        $save_data = $this->webRepository->storeContactEnquiry($data);
        if (!$save_data) {
            return response()->json([
                "status" => false,
            ]);
        } else {
            return response()->json([
                "status" => true,
            ]);

        }
        // return redirect()->back()->with(session()->flash('alert-success', 'Thankyou contacting with us. Our Team will help you soon...'));
    }

    public function postNewsletter(Request $request){
        $data = $request->validate([
            'email' => 'required|email',
        ]);
        $response = $this->webRepository->storeNewsletter($data);
        return response($response);
    }

    public function testimonial(){
        $page = $this->webRepository->getPage(6);
        return view('frontend.testimonial', compact('page'));
    }


    public function teamDetails($id){
        $details = User::where('id', $id)->where('status',1)->first();
        if($details){
            $team_list = User::where('user_type_id', 5)->where('id', '!=', $id)->where('status', 1)->get();
            return view('frontend.team_details', compact('details', 'team_list'));
        }else{
            return redirect('');
        }
    }

    public function ourClients(){
        return view('frontend.clients');
    }

    public function awards(){
        $awards = $this->webRepository->getAwardList();
        $certificates = $this->webRepository->getCertificateList();
        return view('frontend.awards', compact('awards','certificates'));
    }



    public function profile(){
        return view('frontend.profile.index');
    }

    public function privacyPolicy(){
        return view('frontend.privacy_policy');
    }

    public function termsCondition(){
        return view('frontend.term_condition');
    }

    public function disclaimer(){
        return view('frontend.disclaimer');
    }

    public function refundPolicy(){
        return view('frontend.refund');
    }

    public function getQuote(){
        return view('frontend.get_quote');
    }

    public function scheduleMeeting(){
        return view('frontend.schedule_meeting');
    }

    public function postQuoteData(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'skype' => 'required',
            'message' => 'required',
        ]);
        $this->webRepository->storeQuoteData($data);
        return redirect()->back()->with(session()->flash('alert-success', 'Thankyou contacting with us. Our Team will help you soon...'));
    }

    public function storeScheduleMeetings(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'skype' => 'required',
            'schedule_date' => 'required',
            'schedule_time' => 'required',
            'message' => 'required',
        ]);
        $this->webRepository->storeScheduleMeetings($data);
        return redirect()->back()->with(session()->flash('alert-success', 'Thankyou contacting with us. Our Team will help you soon...'));
    }

    public function storePricingEnquiry(Request $request){
        // $data = [
        //     'transport' => 'smtp',
        //     'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
        //     'port' => env('MAIL_PORT', 587),
        //     'encryption' => env('MAIL_ENCRYPTION', 'null'),
        //     'username' => env('MAIL_USERNAME'),
        //     'password' => env('MAIL_PASSWORD'),
        //     'timeout' => null,
        //     'local_domain' => env('MAIL_EHLO_DOMAIN'),

        //     'auth_mode'  => null,
        //      'verify_peer'       => false,
        // ];
        // dd($data);
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'skype' => 'required',
            'pricing_id' => 'required',
            'message' => 'required',
        ]);

        $this->webRepository->storePricingEnquiries($data);
        return redirect()->back()->with(session()->flash('alert-success', 'Thankyou contacting with us. Our Team will help you soon...'));
    }

    /** Partner details function  */
    public function partnerDetails($slug){
        $partnerDetails = $this->webRepository->getPartnerDetails($slug);
        $datas = [
            'partnerDetails' => $this->webRepository->getPartnerDetails($slug),
            'section_lists' => $this->webRepository->getPartnerSection($partnerDetails->id),
        ];
        return view('frontend.partner.partner_details', $datas);
    }

    /** industry best support */
    public function industryDetails($slug){
        $industryDetails = $this->webRepository->getIndustryDetails($slug);
        $datas = [
            'industryDetails' => $this->webRepository->getIndustryDetails($slug),
            'section_lists' => $this->webRepository->getIndustrySection($industryDetails->id),
        ];
        return view('frontend.industries', $datas);
    }

    public function solutionDetails($slug){
        $solutionDetails = $this->webRepository->getSolutionDetails($slug);
        // dd($solutionDetails);
        $datas = [
            'solutionDetails' => $this->webRepository->getSolutionDetails($slug),
            'section_lists' => $this->webRepository->getSolutionSection($solutionDetails->id),
        ];
        return view('frontend.solution_details', $datas);
    }

    public function showCommonFaqList(Request $request){
        $data = $request->all();
        $faqList = $this->webRepository->getCommonFaqList($data);
        //  dd($faqList);
        // $request->pid  <td>' . $k . '</td> show
        $output = '';
        foreach ($faqList as $key => $row) {

            $k = $key + 1;

            $output .='
            <div class="accordion-item  bg-light-green rounded   overflow-hidden   py-0 mb-2 mt-1 px-2">
                <h2 class="accordion-header">
                    <button  class="accordion-button fs-14 fw-bold text-muted2 text-capitalize px-1 py-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1e'.$k.'" aria-expanded="false" aria-controls="collapse1e'.$k.'"><i class="bi bi-dot fs-1 lh-0"></i> '.$row->question.'</button>
                </h2>
                <div id="collapse1e'.$k.'" class="accordion-collapse collapse px-2" data-bs-parent="#vsaccordion" style="">
                    <div class="accordion-body px-0">
                        '.$row->answer.'
                    </div>
                </div>
            </div> ';

        }


    echo  $output;
    }


    public function testSimpleMail(Request $request){

        $to = "clsupport@cloudwareindia.com";
        $subject = "This is subject";

         $message = "<b>This is HTML message.</b>";
         $message .= "<h1>This is headline.</h1>";

         $header = "from:orrishvikash@gmail.com \r\n";
        //  $header .= "cc:afgh@somedomain.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";

         $retval = mail ($to,$subject,$message,$header);

         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }


        // $msg = "This is a simple text message";

        // // send email
        // $success = mail("avinash.orrish@gmail.com","My subject",$msg);
        // if (!$success) {
        //     $errorMessage = error_get_last()['message'];
        //     dd($errorMessage);
        // }else{
        //     dd("Mail Sent Successfully");
        // }
    }

    public function videoAssembly(){
        $video_list = Video::where('category', 3)->paginate(12);
        return view('frontend.pages.video-assembly', compact('video_list'));
    }

    public function videoList(){
        $video_list = Video::where('category', 4)->paginate(12);
        return view('frontend.pages.video', compact('video_list'));
    }

    public function mediaCoverage(){
        $blog_list = $this->webRepository->getBlogList(2);
        $recent_posts = $this->webRepository->getRecentPost('blog',2);
        return view('frontend.pages.media-coverage', compact('blog_list','recent_posts'));
    }

    public function speechList(){
        $blog_list = $this->webRepository->getBlogList(1);
        $recent_posts = $this->webRepository->getRecentPost('blog',1);
        return view('frontend.pages.speeches', compact('blog_list','recent_posts'));
    }

    public function latestPhotos(){
        $latest_photos = $this->webRepository->getLatestPhotosCategory();
        return view('frontend.pages.gallery', compact('latest_photos'));
    }

    public function latestEvents(){
        $latest_event_cat = $this->webRepository->getLatestEventCategory();
        return view('frontend.event', compact('latest_event_cat'));
    }

    public function tender(){
        $tenderList = $this->webRepository->getLatestTenders();
        return view('frontend.tender', compact('tenderList'));
    }

    public function marksheetVerification(Request $request){
        $enrollment_number = $request->enrollment_number;
        $dob = $request->dob;
        $student = $this->webRepository->checkStudents($enrollment_number, $dob); //724900

        // dd($checkStudent);
        $flag = 0;
        if($student){
            $flag = 1;
            $checkStudent = $student;
            $first_semester = Result::where('student_id', $checkStudent->id)->first();

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
                            ->where('results.id', $first_semester->id)
                            ->first();

        }else{
            $checkStudent = null;
            $first_semester = null;
            $second_semester = null;
            $result_details = null;
        }
        return view('frontend.pages.marksheet-verification', compact('checkStudent', 'request', 'flag', 'first_semester','result_details'));
    }

    public function certificateVerification(Request $request){
        $enrollment_number = $request->enrollment_number;
        $dob = $request->dob;
        $student = $this->webRepository->checkStudents($enrollment_number, $dob); //724900

        // dd($checkStudent);
        $flag = 0;
        if($student){
            $flag = 1;
            $checkStudent = $student;
            $first_semester = Result::where('student_id', $checkStudent->id)->first();

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
                            ->where('results.id', $first_semester->id)
                            ->first();

        }else{
            $checkStudent = null;
            $first_semester = null;
            $second_semester = null;
            $result_details = null;
        }
        return view('frontend.pages.certificate-verification', compact('checkStudent', 'request', 'flag', 'first_semester','result_details'));
    }

    public function certificateVerificationold(Request $request){
        $enrollment_number = $request->enrollment_number;
        $dob = $request->dob;
        $student = $this->webRepository->checkStudents($enrollment_number, $dob); //724900
        // dd($checkStudent);
        $flag = 0;
        if($student){
            $flag = 1;
            $checkStudent = $student;
        }else{
            $checkStudent = null;
        }
        return view('frontend.pages.certificate-verification', compact('checkStudent', 'request', 'flag'));
    }

    // public function checkStudentMarksheet(Request $request){

    // }

    public function checkResult($id){
        $result  = Result::where('id', $id)->first();
        if($result){
            $std = Student::where('id', $result->student_id)->first();
            $student = $this->webRepository->checkStudents($std->enrollment_number, $std->dob);
            return view('frontend.pages.qr_verification', compact('result', 'student'));
        }else{
            return redirect("index")->with(session()->flash('alert-danger', 'Not Foundss!'));
        }

    }






}
