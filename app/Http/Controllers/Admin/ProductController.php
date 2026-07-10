<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\ProductSection;
use App\Models\ProductCategory;
use App\Models\Brand;
use App\Models\Branch;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Attribute;
use App\Models\AttributeValue;
// use App\Models\ProductStock;
use App\Models\ProductVariant;
use App\Models\ProductVariantValue;
use App\Models\ProductVariation;
// use Combinations;
use Illuminate\Support\Str;
use App\CombinationsHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\BranchProduct;
use App\Models\MasterShop;

class ProductController extends Controller
{
    // protected $productService;
    // protected $productStockService;

    private $productRepository;
    public function __construct(
        ProductRepositoryInterface $productRepository,
    ){
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){
        $products =  $this->productRepository->allProducts($request);
        $categories =  ProductCategory::whereNull('parent_id')
                    ->with('childrenRecursive')
                    ->get();
        $brand_list =  Brand::where('status', 1)->get();
        $shop_list =  MasterShop::where('status', 1)->get();
        $query = Product::select([
            'products.*',
            'product_categories.name as category_name',
            'brands.name as brand_name',
            // 'master_shops.name as shop_name',
        ])->join('product_categories', 'product_categories.id', '=', 'products.category_id')
            ->join('brands', 'brands.id', '=', 'products.brand_id');

        // if ($request->shop_id) {
        //     $query->where('products.shop_id', $request->shop_id);
        // }

        if ($request->category_id) {
            $query->where('products.category_id', $request->category_id);
        }

        if ($request->brand_id) {
            $query->where('products.brand_id', $request->brand_id);
        }

        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('products.name', 'like', "%$search%")
                    ->orWhere('product_categories.name', 'like', "%$search%")
                    ->orWhere('brands.name', 'like', "%$search%")
                    ->orWhere('master_shops.name', 'like', "%$search%");
            });
        }

        $products = $query->paginate(20);


        return view('admin.product.products.index', compact('products', 'request', 'categories', 'brand_list','shop_list'));
    }

    public function fetchProducts(Request $request)
    {
        $query = Product::select([
            'products.*',
            'product_categories.name as category_name',
            'brands.name as brand_name',
            // 'master_shops.name as shop_name',
        ])->leftJoin('product_categories', 'product_categories.id', '=', 'products.category_id')
            ->leftJoin('brands', 'brands.id', '=', 'products.brand_id');

        // if ($request->shop_id) {
        //     $query->where('products.shop_id', $request->shop_id);
        // }

        if ($request->category_id) {
            $query->where('products.category_id', $request->category_id);
        }

        if ($request->brand_id) {
            $query->where('products.brand_id', $request->brand_id);
        }

        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('products.name', 'like', "%$search%")
                    ->orWhere('product_categories.name', 'like', "%$search%")
                    ->orWhere('brands.name', 'like', "%$search%")
                    ->orWhere('master_shops.name', 'like', "%$search%");
            });
        }

        $products = $query->paginate(20);

        if ($request->ajax()) {
            return view('admin.product.products.product_table_ajax', compact('products'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $categories =  ProductCategory::whereNull('parent_id')
                    ->with('childrenRecursive')
                    ->get();
        $brand_list =  Brand::where('status', 1)->get();
        $shop_list =  MasterShop::where('status', 1)->get();
        return view('admin.product.products.create', compact('categories', 'brand_list', 'shop_list'));
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
                'category_id'        => 'required|exists:product_categories,id',
                'brand_id'           => 'required|exists:brands,id',
                // 'shop_id'            => 'required|exists:master_shops,id',
                'name'               => 'required|string|max:255',
                'product_weight'     => 'required|numeric',
                'product_unit'       => 'required|string|max:10',
                'offer_price'        => 'required|numeric|min:0',
                // 'price'              => 'required|numeric|min:0',
                'purchase_price'        => 'required|numeric|min:0',
                // 'price_45'              => 'required|numeric|min:0',
                // 'price_50'              => 'required|numeric|min:0',
                // 'price_62'              => 'required|numeric|min:0',
                // 'price_80'              => 'required|numeric|min:0',

                // 'stock_quantity'     => 'nullable|integer|min:0',
                'short_description'  => 'nullable|string|max:500',
                'description'        => 'required|string',
                'plant_care'         => 'nullable|string',
                'additional_information' => 'nullable|string',
                // 'length'             => 'nullable|numeric',
                // 'width'              => 'nullable|numeric',
                // 'height'             => 'nullable|numeric',
                'meta_title'         => 'required|string|max:255',
                'meta_keywords'      => 'required|string|max:255',
                'meta_description'   => 'required|string|max:255',
                'is_featured'        => 'nullable|boolean',
                'is_new'             => 'nullable|boolean',
                'status'             => 'required|in:0,1',
                'thumbnail'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'images.*'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            // $product->shop_id = $request->shop_id;
            $product->name = $request->name;
            $product->product_weight = $request->product_weight;
            $product->product_unit = $request->product_unit;
            $product->stock_quantity = $request->stock_quantity;
            $product->short_description = $request->short_description;
            $product->description = $request->description;
            $product->plant_care = $request->plant_care;
            $product->additional_information = $request->additional_information;
            $product->length = $request->length;
            $product->width = $request->width;
            $product->height = $request->height;
            $product->meta_title = $request->meta_title;
            $product->meta_keywords = $request->meta_keywords;
            $product->meta_description = $request->meta_description;
            $product->price = $request->purchase_price;
            $product->purchase_price = $request->purchase_price;
            $product->offer_price = $request->offer_price;
            // $product->price_45 = $request->price_45;
            // $product->price_50 = $request->price_50;
            // $product->price_62 = $request->price_62;
            // $product->price_80 = $request->price_80;
            $product->is_featured = $request->has('is_featured') ? 1 : 0;
            $product->is_new = $request->has('is_new') ? 1 : 0;
            $product->status = $request->status;
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

                ProductImage::insert($insert);
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
        // $data = $this->productRepository->findProduct($id);
        $categories =  ProductCategory::whereNull('parent_id')->with('childrenRecursive')->get();
        $brand_list =  Brand::where('status', 1)->get();
        $shop_list =  MasterShop::where('status', 1)->get();
        $product = Product::findOrFail($id);

        // dd($selectedAttributeValues);
        return view('admin.product.products.update', [
            'product' => $product,
            // 'variants' => $product->variants,
            'categories' => $categories,
            'brand_list' => $brand_list,
            'shop_list' => $shop_list,
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
                'category_id'        => 'required|exists:product_categories,id',
                'brand_id'           => 'nullable|exists:brands,id',
                'name'               => 'required|string|max:255',
                'product_weight'     => 'nullable|numeric',
                'product_unit'       => 'nullable|string|max:10',
                'offer_price'        => 'required|numeric|min:0',
                // 'price'              => 'nullable|numeric|min:0',
                // 'stock_quantity'     => 'required|integer|min:0',

                'purchase_price'        => 'required|numeric|min:0',
                // 'price_45'              => 'required|numeric|min:0',
                // 'price_50'              => 'required|numeric|min:0',
                // 'price_62'              => 'required|numeric|min:0',
                // 'price_80'              => 'required|numeric|min:0',

                'short_description'  => 'nullable|string|max:500',
                'description'        => 'nullable|string',
                'plant_care'         => 'nullable|string',
                'additional_information' => 'nullable|string',
                'meta_title'         => 'nullable|string|max:255',
                'meta_keywords'      => 'nullable|string|max:255',
                'meta_description'   => 'nullable|string|max:255',
                'is_featured'        => 'nullable|boolean',
                'is_new'             => 'nullable|boolean',
                'status'             => 'required|in:0,1',
                'thumbnail'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                // 'images.*'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if($request->has('thumbnail')){
                $name = $request->thumbnail->getClientOriginalName();
                $imageName = time().rand(1,999).'.'.$name;
                $request->thumbnail->move(public_path('uploads/products'), $imageName);
                $data['thumbnail'] = 'uploads/products/'.$imageName;
            }else{
                $data['thumbnail'] = NULL;
            }
            $product = Product::where('id', $id)->first();
            // dd($product);
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            // $product->shop_id = $request->shop_id;
            $product->name = $request->name;
            $product->product_weight = $request->product_weight;
            $product->product_unit = $request->product_unit;
            $product->offer_price = $request->offer_price;
            $product->stock_quantity = $request->stock_quantity;
            $product->short_description = $request->short_description;
            $product->description = $request->description;
            $product->plant_care = $request->plant_care;
            $product->additional_information = $request->additional_information;
            // $product->length = $request->length;
            // $product->width = $request->width;
            // $product->height = $request->height;
            $product->price = $request->purchase_price;
            $product->purchase_price = $request->purchase_price;
            $product->offer_price = $request->offer_price;
            // $product->price_45 = $request->price_45;
            // $product->price_50 = $request->price_50;
            // $product->price_62 = $request->price_62;
            // $product->price_80 = $request->price_80;

            $product->meta_title = $request->meta_title;
            $product->meta_keywords = $request->meta_keywords;
            $product->meta_description = $request->meta_description;
            // $product->price = $request->price;
            $product->is_featured = $request->has('is_featured') ? 1 : 0;
            $product->is_new = $request->has('is_new') ? 1 : 0;
            $product->status = $request->status;
            if($request->has('thumbnail')){
                $product->thumbnail = $data['thumbnail'];
            }
            $product->created_by = session('LoggedUser')->id; // or set manually
            $product->save();



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
        $this->productRepository->deleteProduct($id);
        return redirect()->route('admin.product.index')->with(session()->flash('alert-danger', 'Data Deleted Successfully'));
    }

    public function productTransferToBranch(Request $request){
        // dd('Hi iam');
        $categories =  ProductCategory::whereNull('parent_id')->with('childrenRecursive')->get();
        $branch_list =  Branch::where('status', 1)->get();
        // $product_list = Product::findOrFail($id);
        $categories =  ProductCategory::whereNull('parent_id')->with('childrenRecursive')->get();
        return view('admin.product.transfer.transfer_product_to_branch', [
            // 'product' => $product,
            'categories' => $categories,
            'branch_list' => $branch_list,
        ]);
    }

    public function getProductListTypeWise(Request $request){
        return Product::where('status', 1)->where('category_id', $request->category)->get();
    }

    public function getProductDetails(Request $request)
	{
		$product = DB::table('products')->where('id', $request->product_id)->first();
        if ($product) {
			return response()->json([
				'offer_price' => $product->offer_price,
				'price' => $product->purchase_price,
				'price_45' => $product->price_45,
				'price_50' => $product->price_50,
				'price_62' => $product->price_62,
				'price_80' => $product->price_80,
            ]);
		}
        return response()->json(['error' => 'Product not found'], 404);
	}

    public function transferProductsToBranch(Request $request){
        // dd($request->all());
        // ✅ Validation
        $validator = Validator::make($request->all(), [
            'branch'        => 'required|integer',
            'transfer_date' => 'required|date',
            'product_id'    => 'required|array',
            'product_id.*'  => 'required|integer',
            'quantity'      => 'required|array',
            'category'      => 'required|array',
            'stock'      => 'required|array',
            'quantity.*'    => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ]);
        }

        DB::beginTransaction();

        try {

            $branchId = $request->branch;
            $transfer_date = $request->transfer_date;

            foreach ($request->product_id as $index => $productId) {

                // 🔍 Check duplicate (branch + product)
                $exists = BranchProduct::where('branch_id', $branchId)
                            ->where('product_id', $productId)
                            ->exists();

                if ($exists) {

                    // 🔎 Get product name
                    $productName = Product::where('id', $productId)->value('name');

                    DB::rollBack();

                    return response()->json([
                        'status'  => false,
                        'message' => "प्रोडक्ट '{$productName}' पहले ही इस ब्रांच में ट्रांसफर हो चुका है। कृपया स्टॉक अपडेट करें।"
                    ]);
                }

                // ✅ Save
                BranchProduct::create([
                    'transferred_by'   => loggedCompany(),
                    'branch_id'   => $branchId,
                    'transfer_date'   => $transfer_date,
                    'product_id'  => $productId,
                    'category'       => $request->category[$index],
                    'price'       => null,
                    'offer_price' => null,
                    'price_45' => $request->price_45[$index],
                    'price_50' => $request->price_50[$index],
                    'price_62' => $request->price_62[$index],
                    'price_80' => $request->price_80[$index],
                    'stock'       => $request->stock[$index],
                ]);
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Products transferred successfully.'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => 'Server error: ' . $e->getMessage()
            ]);
        }
    }

    public function branchProductList(Request $request){
            // dd(current_branch());
            $query = BranchProduct::select([
                'branch_products.*',
                'products.name as product_name',
                'pc.name as category_name',
                'b.name as branch_name',
            ])
            ->join('products', 'products.id', '=', 'branch_products.product_id')
            ->leftJoin('product_categories as pc', 'pc.id', '=', 'branch_products.category')
            ->leftJoin('branches as b', 'b.id', '=', 'branch_products.branch_id');

            if ($request->branch) {
                $query->where('branch_products.branch_id', $request->branch);
            }
            if(currentUserType()!=1){
                $query->where('branch_products.branch_id', current_branch());
            }
            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('products.name', 'like', "%$search%")
                    ->orWhere('branch_products.stock', 'like', "%$search%");
                });
            }
            $product_list = $query
                ->orderBy('branch_products.id', 'DESC')
                ->paginate(20)
                ->withQueryString();
        $datas = [
            'branch_list' =>  Branch::where('status', 1)->get(),
            'product_list' => $product_list,
            'request' => $request,
            'page_title' => 'Branch Product List',
        ];
        return view('admin.product.transfer.branch_product_list', $datas);
    }

    public function fetchBranchProductsHere(Request $request)
    {
        // dd('I am here');
        $query = BranchProduct::select([
                'branch_products.*',
                'products.name as product_name',
                'pc.name as category_name',
                'b.name as branch_name',
            ])
            ->join('products', 'products.id', '=', 'branch_products.product_id')
            ->leftJoin('product_categories as pc', 'pc.id', '=', 'branch_products.category')
            ->leftJoin('branches as b', 'b.id', '=', 'branch_products.branch_id');

            if ($request->branch) {
                $query->where('branch_products.branch_id', $request->branch);
            }
            if(currentUserType()!=1){
                $query->where('branch_products.branch_id', current_branch());
            }
            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('products.name', 'like', "%$search%")
                    ->orWhere('branch_products.stock', 'like', "%$search%");
                });
            }
            $product_list = $query
                ->orderBy('branch_products.id', 'DESC')
                ->paginate(20)
                ->withQueryString();
            // dd($membership_list);
        if ($request->ajax()) {
            return view('admin.product.transfer.branch_product_list_ajax', compact('product_list'))->render();
        }
    }



    public function updateBranchProductStock(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'offer_price' => 'nullable|numeric|min:0',
        ]);

        BranchProduct::where('id', $request->id)->update([
            'stock' => $request->stock,
            'price' => $request->price,
            'offer_price' => $request->offer_price,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Product updated successfully'
        ]);
    }

    /** product profit list */

    public function productProfitList(){
        // $shop = MasterShop::find($shop_id);
        $products = \DB::table('sale_items')
            ->join('products', 'products.id', '=', 'sale_items.product_id')
            // ->where('products.shop_id', $shop_id)
            ->select(
                'products.name',
                'products.purchase_price',
                'sale_items.offer_price',
                'sale_items.quantity'
            )
            ->selectRaw('
                (sale_items.offer_price - products.purchase_price) as profit_per_product,
                ((sale_items.offer_price - products.purchase_price) * sale_items.quantity) as total_profit
            ')
            ->get();
            $grandProfit = $products->sum('total_profit');
            $datas = [
            'products' => $products,
            'grandProfit' => $grandProfit,
            // 'shop' => $shop,
            'page_title' => 'View Products Profit',
        ];
        return view('admin.product.products.view_sold_products_profit', $datas);

    }

}
