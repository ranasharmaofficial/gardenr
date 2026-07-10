<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\ProductCategoryRepositoryInterface;
use App\Models\ProductCategory;
use App\Models\SpecialitySection;
use Illuminate\Support\Facades\DB;
class ProductCategoryController extends Controller
{
    private $productCategoryRepository;

    public function __construct(ProductCategoryRepositoryInterface $productCategoryRepository){
        $this->productCategoryRepository = $productCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){
         $page_title = 'Category List';
        $categories =  $this->productCategoryRepository->allCategories($request);
        return view('admin.product.category.index', compact('categories', 'request', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        // $categories =  $this->productCategoryRepository->allCategories($request);
        $categories = ProductCategory::whereNull('parent_id')
                    ->with('childrenRecursive')
                    ->get();
        $page_title = 'Add Category';
        return view('admin.product.category.create', compact('categories','request', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name',
            'status' => 'required',
            'image' => 'nullable',
            'parent_id' => 'nullable',
            'description' => 'nullable',
            // 'slug' => 'required|string|max:255|unique:product_categories,slug',
        ]);

        $data['created_by'] = session('LoggedUser')->id;
        if($request->has('image')){
            $name = $request->image->getClientOriginalName();
            $imageName = time().rand(1,999).'.'.$name;
            $request->image->move(public_path('uploads/category'), $imageName);
            $data['image'] = 'uploads/category/'.$imageName;
        }else{
            $data['image'] = NULL;
        }
        $speciality_store = $this->productCategoryRepository->storeCategory($request, $data);

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
        $data = $this->productCategoryRepository->findCategory($id);
        if($data){
            $categories = ProductCategory::whereNull('parent_id')
                    ->with('childrenRecursive')
                    ->get();
            $page_title = 'Edit Category';
           return view('admin.product.category.update', compact('data', 'categories','page_title'));
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
            'name' => 'required|string|max:255|unique:product_categories,name,' . $id,
            'status' => 'required',
            'slug' => 'required',
            'parent_id' => 'nullable',
            'description' => 'nullable',
        ]);

        $data['updated_by'] = session('LoggedUser')->id;
        if($request->has('image')){
            $name = $request->image->getClientOriginalName();
            $imageName = time().rand(1,999).'.'.$name;
            $request->image->move(public_path('uploads/category'), $imageName);
            $data['image'] = 'uploads/category/'.$imageName;
        }else{
            $data['image'] = NULL;
        }

        // $product_category = ProductCategory::where('id', $id)->first();
        // $product_category->name = $data['name'];
        // $product_category->parent_id = $data['parent_id'];
        // $product_category->status = $data['status'];
        // // $product_category->image = $data['image'];
        // $product_category->description = $data['description'];
        // $product_category->slug = $data['slug'];
        // if($request->has('image')){
        //     $product_category->image = $data['image'];
        // }
        // $product_category->save();


        $category_update = $this->productCategoryRepository->updateCategory($data, $id);

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
        $this->slug = SlugService::createSlug(ProductCategory::class, 'slug', $this->name);
    }



}
