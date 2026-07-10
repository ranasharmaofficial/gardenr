<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\BlogRepositoryInterface;
use JD\Cloudder\Facades\Cloudder;
use App\Models\Category;
use App\Models\VideoCategory;

use Illuminate\Support\Str;
class BlogController extends Controller
{

    private $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $blogs =  $this->blogRepository->allBlogs($request, 1);
        return view('admin.blogs.index', compact('blogs', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $countries =  $this->blogRepository->getCountryList();
        return view('admin.blogs.create', compact('countries'));
    }

    public function generateSlug(){
        $this->slug = SlugService::createSlug(Blog::class, 'slug', $this->title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $data = $request->validate([
            'type' => 'required',
            'category_id' => 'required',
            // 'country' => 'nullable',
            'city' => 'required',
            'title' => 'required|string|max:255',
            // 'english_title' => 'required|string',
            'description' => 'required',
            // 'blog_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'tags' => 'required',
            'meta_title' => 'nullable',
            'meta_tag' => 'nullable',
            'meta_description' => 'nullable',
        ]);
        // dd($request->tags);

        if($request->has('blog_image')){
            $data['blog_image'] = upload_asset($request->blog_image, $request->type);
        }else{
            $data['blog_image'] = NULL;
        }

        $data['created_by'] = session('LoggedUser')->id;
        $this->blogRepository->storeBlog($request, $data);

        return redirect()->route('admin.blogs.index')->with(session()->flash('alert-success', 'Blog Created Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $blog = $this->blogRepository->findBlog($id);
        // json_encode(explode(",", $data['tags']))
        // dd(json_decode($blog->tags));
        if($blog){
            $countries =  $this->blogRepository->getCountryList();
            $categories =  $this->blogRepository->getCategoryList($blog->type);
            return view('admin.blogs.update', compact('blog', 'categories', 'countries'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $data = $request->validate([
            'type' => 'required',
            'category_id' => 'required|not_in:0',
            'country' => 'nullable|not_in:0',
            'title' => 'required|string|max:255',
            'description' => 'required',
            // 'blog_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'city' => 'required',
            'tags' => 'required',
            'meta_title' => 'nullable',
            'meta_tag' => 'nullable',
            'meta_description' => 'nullable',
        ]);

        if($request->has('blog_image')){
            $data['blog_image'] = upload_asset($request->blog_image, $request->type);
        }else{
            $data['blog_image'] = NULL;
        }

        $data['updated_by'] = session('LoggedUser')->id;

        $this->blogRepository->updateBlog($data, $id);
        if($request->category==1){
            return redirect()->route('admin.blogs.index')->with(session()->flash('alert-success', 'Blog Updated Successfully'));
        }else{
            return redirect()->route('admin.mediaCoverage')->with(session()->flash('alert-success', 'Media Coverage Updated Successfully'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $this->blogRepository->destroyBlog($id);
        return redirect()->route('admin.blogs.index')->with(session()->flash('alert-success', 'Blog Delete Successfully'));
    }

    public function fetchCategory(Request $request){
        $data['categories'] = $this->blogRepository->getCategoryList($request->type);
        return response()->json($data);
    }

    // public function fetchSubCategory(Request $request){
    //     $data['sub_categories'] = $this->blogRepository->getSubCategoryList($request->category_id);
    //     return response()->json($data);
    // }

    public function showLikes($id){
        $blogs = $this->blogRepository->getAllLike($id);
        return view('admin.blogs.like', compact('blogs'));
    }

    public function showViews($id){
        $blogs = $this->blogRepository->getAllViews($id);
        return view('admin.blogs.view', compact('blogs'));
    }

    public function showComments($id){
        $blogs = $this->blogRepository->getAllComment($id);
        return view('admin.blogs.comment', compact('blogs'));
    }

    public function changeCommentStatus(Request $request){
        $comment = $this->blogRepository->setCommentStatus($request);
        return response()->json($comment);
    }

    public function delete($id){
        $this->blogRepository->deleteBlog($id);
        return redirect()->route('admin.blogs.index')->with(session()->flash('alert-danger', 'Blog Deleted Successfully'));
    }

    public function videosOfAssembly(){
        $video_list = $this->blogRepository->getVideoList(3);
        return view('admin.blogs.videos_of_assembly.index', compact('video_list'));
    }

    public function videosOfAssemblyAdd(){
        $video_list = $this->blogRepository->getVideoList(3);
        return view('admin.blogs.videos_of_assembly.create', compact('video_list'));
    }

    public function videosOfAssemblyStore(Request $request)
    {
        $data = $request->validate([
            // 'title' => 'required|string|max:255',
            'category' => 'required',
            'link' => 'required',
            'status' => 'required',
        ]);

        $data['created_by'] = session('LoggedUser')->id;
        $this->blogRepository->storeVideos($request, $data);
        return redirect()->route('admin.videosOfAssembly')->with(session()->flash('alert-success', 'Video Added Successfully'));
    }

    public function videosOfAssemblyDelete($id){
        $this->blogRepository->destroyVideo($id);
        return redirect()->route('admin.videosOfAssembly')->with(session()->flash('alert-success', 'Video Deleted Successfully'));
    }

    /** common videos bro */
    public function commonVideos(){
        $video_list = $this->blogRepository->getVideoList(4);
        return view('admin.blogs.common_videos.index', compact('video_list'));
    }

    public function commonVideosAdd(){
        $video_list = $this->blogRepository->getVideoList(4);
        return view('admin.blogs.common_videos.create', compact('video_list'));
    }

    public function commonVideosStore(Request $request)
    {
        $data = $request->validate([
            // 'title' => 'required|string|max:255',
            'category' => 'required',
            'link' => 'required',
            'status' => 'required',
        ]);

        $data['created_by'] = session('LoggedUser')->id;
        $this->blogRepository->storeVideos($request, $data);
        return redirect()->route('admin.commonVideos')->with(session()->flash('alert-success', 'Video Added Successfully'));
    }

    public function commonVideosDelete($id){
        $this->blogRepository->destroyVideo($id);
        return redirect()->route('admin.commonVideos')->with(session()->flash('alert-success', 'Video Deleted Successfully'));
    }

    /** media coverage bro */
    public function mediaCoverage(Request $request){
        $blogs =  $this->blogRepository->allBlogs($request,2);
        return view('admin.media_coverage.index', compact('blogs', 'request'));
    }

    public function mediaCoverageAdd(){
        $video_list = $this->blogRepository->getVideoList(4);
        $category = Category::where('id', 2)->get();
        // dd($category);
        return view('admin.media_coverage.create', compact('video_list','category'));
    }

    public function mediaCoverageStore(Request $request)
    {
        $data = $request->validate([
            'type' => 'required',
            'category_id' => 'required',
            'country' => 'nullable',
            'city' => 'required',
            'title' => 'required|string|max:255',
            'english_title' => 'required|string',
            'description' => 'required',
            // 'blog_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'tags' => 'required',
            'meta_title' => 'nullable',
            'meta_tag' => 'nullable',
            'meta_description' => 'nullable',
        ]);
        // dd($request->tags);

        if($request->has('blog_image')){
            $data['blog_image'] = upload_asset($request->blog_image, $request->type);
        }else{
            $data['blog_image'] = NULL;
        }

        $data['created_by'] = session('LoggedUser')->id;
        $this->blogRepository->storeBlog($request, $data);
        return redirect()->route('admin.mediaCoverage')->with(session()->flash('alert-success', 'Media Coverage Added Successfully'));
    }

    public function mediaCoverageDelete($id){
        $this->blogRepository->destroyVideo($id);
        return redirect()->route('admin.mediaCoverage')->with(session()->flash('alert-success', 'Media Coverage Deleted Successfully'));
    }

    public function videosCategory(){
        $video_Categorylist = $this->blogRepository->getVideoCategory();
        return view('admin.blogs.videos_category.index', compact('video_Categorylist'));
    }

    public function storeVideosCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        $slug = Str::slug($request->title);
        $count = VideoCategory::where('slug', 'LIKE', "{$slug}%")->count();

        if($count > 0){
            $slug = $slug . '-' . ($count + 1);
        }

        $cat = new VideoCategory;
        $cat->title = $request->category_name;
        $cat->status = $request->status;
        $cat->slug  = $slug;
        $cat->save();

        return response()->json(['success' => true, 'message' => 'Category added successfully!']);
    }

    public function editVideoCategory($id)
    {
        $cat = VideoCategory::find($id);
        return response()->json($cat);
    }

    public function updateVideosCategory(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        $cat = VideoCategory::findOrFail($id);

        $slug = Str::slug($request->title);
        $count = VideoCategory::where('slug', 'LIKE', "{$slug}%")
                ->where('id', '!=', $id)
                ->count();

        if($count > 0){
            $slug = $slug . '-' . ($count + 1);
        }

        $cat->title = $request->title;
        $cat->slug = $slug;
        $cat->status = $request->status;
        $cat->save();

        return response()->json(['success' => true, 'message' => 'Category updated successfully!']);
    }



}
