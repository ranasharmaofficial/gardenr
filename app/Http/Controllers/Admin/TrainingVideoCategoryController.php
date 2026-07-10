<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\TrainingVideoCategoryRepositoryInterface;
use App\Models\MVideoCategory;
use App\Models\SpecialitySection;
use Illuminate\Support\Facades\DB;
class TrainingVideoCategoryController extends Controller
{
    private $trainingVideoCategoryRepository;

    public function __construct(TrainingVideoCategoryRepositoryInterface $trainingVideoCategoryRepository){
        $this->trainingVideoCategoryRepository = $trainingVideoCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){
        $page_title = 'Training Video Category List';
        $categories =  $this->trainingVideoCategoryRepository->allCategories($request);
        return view('admin.videos.category.index', compact('categories', 'request', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        // $categories =  $this->trainingVideoCategoryRepository->allCategories($request);
        $categories = MVideoCategory::whereNull('parent_id')
                    ->with('childrenRecursive')
                    ->get();
        $page_title = 'Add Training Video Category';
        return view('admin.videos.category.create', compact('categories','request', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:m_video_categories,name',
            'status' => 'required',
            'image' => 'nullable',
            'parent_id' => 'nullable',
            'description' => 'nullable',
            // 'slug' => 'required|string|max:255|unique:product_categories,slug',
        ]);

        $data['created_by'] = session('LoggedUser')->id;
        // if($request->has('image')){
        //     $name = $request->image->getClientOriginalName();
        //     $imageName = time().rand(1,999).'.'.$name;
        //     $request->image->move(public_path('uploads/category'), $imageName);
        //     $data['image'] = 'uploads/category/'.$imageName;
        // }else{
        //     $data['image'] = NULL;
        // }
        $speciality_store = $this->trainingVideoCategoryRepository->storeCategory($request, $data);

        if (!$speciality_store) {
            return response()->json([
                "status" => false,
                "message" => 'Something went wrong',
            ]);
        } else {
            return response()->json([
                "status" => true,
                "message" => 'Successfully Added.',
            ]);

        }
        // return redirect()->route('admin.pages.index')->with(session()->flash('alert-success', 'CmsPage Created Successfully'));
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
        $data = $this->trainingVideoCategoryRepository->findCategory($id);
        if($data){
            $categories = MVideoCategory::whereNull('parent_id')
                    ->with('childrenRecursive')
                    ->get();
            $page_title = 'Edit Category';
           return view('admin.videos.category.update', compact('data', 'categories','page_title'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        // dd($id);
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:m_video_categories,name,' . $id,
            'status' => 'required',
            'slug' => 'required',
            'parent_id' => 'nullable',
            'description' => 'nullable',
        ]);

        $data['updated_by'] = session('LoggedUser')->id;
        // if($request->has('image')){
        //     $name = $request->image->getClientOriginalName();
        //     $imageName = time().rand(1,999).'.'.$name;
        //     $request->image->move(public_path('uploads/category'), $imageName);
        //     $data['image'] = 'uploads/category/'.$imageName;
        // }else{
        //     $data['image'] = NULL;
        // }



        $category_update = $this->trainingVideoCategoryRepository->updateCategory($data, $id);

        if (!$category_update) {
            return response()->json([
                "status" => false,
                "message" => 'Something went wrong',
            ]);
        } else {
            return response()->json([
                "status" => true,
                "message" => 'Successfully Updated.',
            ]);

        }
        // return redirect()->route('admin.pages.index')->with(session()->flash('alert-success', 'CmsPage Updated Successfully'));
    }

    public function generateSlug(){
        $this->slug = SlugService::createSlug(MVideoCategory::class, 'slug', $this->name);
    }



}
