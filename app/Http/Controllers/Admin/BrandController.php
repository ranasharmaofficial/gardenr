<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use App\Models\ProductCategory;


class BrandController extends Controller
{
    private $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository){
        $this->brandRepository = $brandRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){
        $page_title = 'Brand List';
        $brand_list =  $this->brandRepository->allBrand($request);
        return view('admin.product.brand.index', compact('brand_list', 'request', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $page_title = 'Brand List';
        return view('admin.product.brand.create', compact( 'request', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
            'status' => 'required',
            'logo' => 'nullable',
            // 'slug' => 'required|string|max:255|unique:product_categories,slug',
        ]);

        $data['created_by'] = session('LoggedUser')->id;
        if($request->has('logo')){
            $name = $request->logo->getClientOriginalName();
            $imageName = time().rand(1,999).'.'.$name;
            $request->logo->move(public_path('uploads/brand'), $imageName);
            $data['logo'] = 'uploads/brand/'.$imageName;
        }else{
            $data['logo'] = NULL;
        }
        $speciality_store = $this->brandRepository->storeBrand($request, $data);

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
        $data = $this->brandRepository->findBrand($id);
        if($data){
            $page_title = 'Update Brand';
           return view('admin.product.brand.update', compact('data', 'page_title'));
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
            'name' => 'required|string|max:255|unique:brands,name,' . $id,
            'status' => 'required',
            'slug' => 'required',
        ]);

        $data['updated_by'] = session('LoggedUser')->id;
        if($request->has('logo')){
            $name = $request->logo->getClientOriginalName();
            $imageName = time().rand(1,999).'.'.$name;
            $request->logo->move(public_path('uploads/brand'), $imageName);
            $data['logo'] = 'uploads/brand/'.$imageName;
        }else{
            $data['logo'] = NULL;
        }



        $category_update = $this->brandRepository->updateBrand($data, $id);

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
        $this->slug = SlugService::createSlug(Brand::class, 'slug', $this->name);
    }



}
