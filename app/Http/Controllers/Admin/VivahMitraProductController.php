<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\VivahMitraProductRepositoryInterface;
use App\Models\ProductSection;
use App\Models\ProductCategory;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\VivahmitraProductImage;
use App\Models\VivahmitraCategory;
use App\Models\VivahmitraProduct;
use App\Models\ProductVariation;
// use Combinations;
use Illuminate\Support\Str;
use App\CombinationsHelper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB; // ✅ Add this

class VivahMitraProductController extends Controller
{
    // protected $productService;
    // protected $productStockService;

    private $vivahmitraproductRepository;
    public function __construct(
        VivahMitraProductRepositoryInterface $vivahmitraproductRepository,
    ){
        $this->vivahmitraproductRepository = $vivahmitraproductRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){
        $products =  $this->vivahmitraproductRepository->allProducts($request);
        $categories =  ProductCategory::whereNull('parent_id')
                    ->with('childrenRecursive')
                    ->get();
        $brand_list =  Brand::where('status', 1)->get();
        $data = $request->all();
        return view('admin.vivah_mitra.products.index', compact('products', 'request', 'categories', 'brand_list','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $categories =  VivahmitraCategory::whereNull('parent_id')
                    ->with('childrenRecursive')
                    ->get();
        // $brand_list =  Brand::where('status', 1)->get();
        // $attributes = Attribute::with('values')->get();
        return view('admin.vivah_mitra.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function generateCombinations($attributes)
    {
        $combinations = [[]];

        foreach ($attributes as $attribute) {
            $temp = [];

            foreach ($combinations as $combination) {
                foreach ($attribute['values'] as $value) {
                    $temp[] = array_merge($combination, [[
                        'attribute_id' => $attribute['id'],
                        'name' => $attribute['name'],
                        'value' => $value['value'],
                        'value_id' => $value['id'],
                    ]]);
                }
            }

            $combinations = $temp;
        }

        return $combinations;
    }


    public function store(Request $request){
        // dd($request->all());
        // dd($request-);
        $data = $request->validate([
                'category_id'        => 'required|exists:vivahmitra_categories,id',
                'name'               => 'required|string|max:255',
                'description'        => 'required|string',
                'thumbnail'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                // 'images'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            // dd($request->input('attributes'));

            if($request->has('thumbnail')){
                $name = $request->thumbnail->getClientOriginalName();
                $imageName = time().rand(1,999).'.'.$name;
                $request->thumbnail->move(public_path('uploads/products'), $imageName);
                $data['thumbnail'] = 'uploads/products/'.$imageName;
            }else{
                $data['thumbnail'] = NULL;
            }
            $product = new VivahmitraProduct();
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->status = 1;
            $product->thumbnail = $data['thumbnail'];
            $product->created_by = session('LoggedUser')->id; // or set manually
            $product->save();



            if($request->hasFile('images')) {
                foreach($request->file('images') as $key => $file) {
                    $name = $file->getClientOriginalName();
                    $imageName = time().rand(1,999).'.'.$name;
                    $file->move(public_path('uploads/products'), $imageName);
                    $insert[$key]['image_path'] = 'uploads/products/'.$imageName;
                    $insert[$key]['product_id'] = $product->id;
                }
                VivahmitraProductImage::insert($insert);
            }



        // return redirect()->back()->with(session()->flash('alert-success', 'Created Successfully'));
         if (!$product) {
                return response()->json([
                    "status" => false,
                    "message" => 'Something went wrong',
                ]);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => 'Product Updated.',
                ]);

            }
    }

    public function generateSlug(){
        $this->slug = SlugService::createSlug(Product::class, 'slug', $this->name);
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
        // $data = $this->vivahmitraproductRepository->findProduct($id);
        $categories =  VivahmitraCategory::whereNull('parent_id')->with('childrenRecursive')->get();
        // $brand_list =  Brand::where('status', 1)->get();
        $product = VivahmitraProduct::findOrFail($id);

        // dd($selectedAttributeValues);
        return view('admin.vivah_mitra.products.update', [
            'product' => $product,
            'categories' => $categories,

        ]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        // dd($request);
            $data = $request->validate([
                'category_id'        => 'required|exists:vivahmitra_categories,id',
                'name'               => 'required|string|max:255',
                'description'        => 'required|string',
                'thumbnail'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            if($request->has('thumbnail')){
                $name = $request->thumbnail->getClientOriginalName();
                $imageName = time().rand(1,999).'.'.$name;
                $request->thumbnail->move(public_path('uploads/products'), $imageName);
                $data['thumbnail'] = 'uploads/products/'.$imageName;
            }else{
                $data['thumbnail'] = NULL;
            }
            $product = VivahmitraProduct::where('id', $id)->first();
            // dd($product);
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->description = $request->description;
            if($request->has('thumbnail')){
                $product->thumbnail = $data['thumbnail'];
            }
            $product->created_by = session('LoggedUser')->id; // or set manually
            $product->save();

            /* Delete old images */
            $oldImages = VivahmitraProductImage::where('product_id', $id)->get();
            foreach ($oldImages as $img) {
                $path = public_path($img->image_path);
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
            VivahmitraProductImage::where('product_id', $product->id)->delete();
            /* Upload new images */
            if ($request->hasFile('images')) {
                $insert = [];
                foreach ($request->file('images') as $file) {
                    $imageName = time() . rand(100,999) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/products'), $imageName);
                    $insert[] = [
                        'product_id' => $product->id,
                        'image_path' => 'uploads/products/' . $imageName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                VivahmitraProductImage::insert($insert);
            }



            if (!$product) {
                return response()->json([
                    "status" => false,
                    "message" => 'Something went wrong',
                ]);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => 'Product Updated.',
                ]);

            }
    }

    public function delete($id){
        $this->vivahmitraproductRepository->deleteProduct($id);
        return redirect()->route('admin.product.index')->with(session()->flash('alert-danger', 'Data Deleted Successfully'));
    }

    /** Page Section CRUD Start */
        public function productSectionIndex(Request $request){
            $product_sections =  $this->vivahmitraproductRepository->allProductSectionList($request);
            $cms_pages =  $this->vivahmitraproductRepository->getProductList();
            return view('admin.product.product_section.index', compact('product_sections', 'cms_pages', 'request'));
        }

        public function productSectionCreate(){
            $cms_pages =  $this->vivahmitraproductRepository->getProductList();
            return view('admin.product.product_section.create', compact('cms_pages'));
        }

        public function productSectionStore(Request $request){
            $data = $request->validate([
                'page_id' => 'required|numeric',
                // 'section_name' => 'required|unique:product_sections,section_name',
                'section_name' => 'required',
                'title' => 'required_without:description',
                'description' => 'required_without:title',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'status' => 'required',
            ]);

            if($request->has('image')){
                $data['image'] = upload_asset($request->image, "cms");
            }else{
                $data['image'] = NULL;
            }

            $data['created_by'] = session('LoggedUser')->id;
            $checkSectionAdded = ProductSection::where('page_id', $request->page_id)->where('section_name', $request->section_name)->count();
            if($checkSectionAdded==0){
                $this->vivahmitraproductRepository->storeProductSection($data, 'store');
                return redirect()->route('admin.product_sections.index')->with(session()->flash('alert-success', 'Page Section Created Successfully'));
            }else{
                return redirect()->route('admin.product_sections.index')->with(session()->flash('alert-danger', 'Already Exist!'));
            }


        }

        public function productSectionEdit($id){
            $page_section = $this->vivahmitraproductRepository->findProductSection($id);
            if($page_section){
                $cms_pages =  $this->vivahmitraproductRepository->getProductList();
                return view('admin.product.product_section.update', compact('page_section', 'cms_pages'));
            }
        }

        public function productSectionUpdate(Request $request, $id){
            $data = $request->validate([
                'page_id' => 'required|numeric',
                'section_name' => 'required',
                'title' => 'required_without:description',
                'description' => 'required_without:title',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'status' => 'required',
            ]);

            if($request->has('image')){
                $data['image'] = upload_asset($request->image, "cms");
            }else{
                $data['image'] = NULL;
            }

            $data['id'] = $request->id;
            $data['created_by'] = session('LoggedUser')->id;
            $this->vivahmitraproductRepository->updateProductSection($data, 'update');
            return redirect()->route('admin.product_sections.index')->with(session()->flash('alert-success', 'Page Section Updated Successfully'));
        }

        public function deleteProductSection($id){
            $this->vivahmitraproductRepository->deleteProductSection($id);
            return redirect()->route('admin.product_sections.index')->with(session()->flash('alert-danger', 'Data Deleted Successfully'));
        }
    /** Page Section CRUD End */

    /** Section Data CRUD Start */
        public function productsectionDataIndex(Request $request){
            $page_sections =  $this->vivahmitraproductRepository->allProductSectionDataList($request);
            $cms_pages =  $this->vivahmitraproductRepository->getProductList();
            return view('admin.product.product_section_data.index', compact('page_sections', 'cms_pages', 'request'));
        }

        public function productfetchSection(Request $request){
            $data['sections'] = $this->vivahmitraproductRepository->getProductSectionList($request->page_id);
            return response()->json($data);
        }

        public function productsectionDataCreate(){
            $cms_pages =  $this->vivahmitraproductRepository->getProductList();
            return view('admin.product.product_section_data.create', compact('cms_pages'));
        }

        public function productsectionDataStore(Request $request){
            $data = $request->validate([
                'page_id' => 'required|numeric',
                'section_id' => 'required|numeric',
                'title' => 'required_without:description',
                'description' => 'required_without:title',
                'img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'order_number' => 'required|numeric',
                'other' => 'nullable',
                'status' => 'required|numeric',
            ]);

            if($request->has('img')){
                $data['img'] = upload_asset($request->img, "cms");
            }else{
                $data['img'] = NULL;
            }

            if($request->has('other')){
                $data['other'] = upload_asset($request->other, "cms");
            }else{
                $data['other'] = NULL;
            }

            $data['created_by'] = session('LoggedUser')->id;
            $this->vivahmitraproductRepository->storeProductSectionData($data, 'store');
            return redirect()->route('admin.productsection_data.index')->with(session()->flash('alert-success', 'Section Data Created Successfully'));
        }

        public function productsectionDataEdit($id){
            $section_data = $this->vivahmitraproductRepository->findProductSectionData($id);
            if($section_data){
                $cms_pages =  $this->vivahmitraproductRepository->getProductList();
                $page_sections =  $this->vivahmitraproductRepository->getProductSectionList($section_data->page_id);
                return view('admin.product.product_section_data.update', compact('section_data', 'cms_pages', 'page_sections'));
            }
        }

        public function productsectionDataUpdate(Request $request, $id){
            $data = $request->validate([
                'page_id' => 'required|numeric',
                'section_id' => 'required|numeric',
                'title' => 'required_without:description',
                'description' => 'required_without:title',
                'img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'order_number' => 'required|numeric',
                // 'other' => 'nullable',
                'status' => 'required|numeric',
            ]);
            // dd($request->all());
            if($request->has('img')){
                $data['img'] = upload_asset($request->img, "cms");
            }else{
                $data['img'] = NULL;
            }

            if($request->has('other')){
                $data['other'] = upload_asset($request->other, "cms");
            }else{
                $data['other'] = NULL;
            }

            $data['id'] = $request->id;
            $data['updated_by'] = session('LoggedUser')->id;
            $this->vivahmitraproductRepository->storeProductSectionData($data, 'update');
            return redirect()->route('admin.productsection_data.index')->with(session()->flash('alert-success', 'Page Section Updated Successfully'));
        }

        public function deleteProductSectionData($id){
            $this->vivahmitraproductRepository->deleteProductSectionData($id);
            return redirect()->route('admin.productsection_data.index')->with(session()->flash('alert-danger', 'Data Deleted Successfully'));
        }
    /** Section Data CRUD End */

    public function sku_combination(Request $request)
    {
        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }
        else {
            $colors_active = 0;
        }

        $unit_price = $request->unit_price;
        $product_name = $request->name;

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $data = array();
                // foreach (json_decode($request[$name][0]) as $key => $item) {
                foreach ($request[$name] as $key => $item) {
                    // array_push($data, $item->value);
                    array_push($data, $item);
                }
                array_push($options, $data);
            }
        }

        $combinations = CombinationsHelper::generate($options);
        return view('admin.product.products.sku_combinations', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
    }

    public function add_more_choice_option(Request $request) {
        $all_attribute_values = AttributeValue::with('attribute')->where('attribute_id', $request->attribute_id)->get();

        $html = '';

        foreach ($all_attribute_values as $row) {
            $html .= '<option value="' . $row->value . '">' . $row->value . '</option>';
        }

        echo json_encode($html);
    }

    public function getByAttribute($attributeId)
    {
        $values = AttributeValue::where('attribute_id', $attributeId)->get();

        // return JSON for AJAX
        return response()->json($values);
    }

}
