<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MasterAgreement;
use App\Models\UserType;
use App\Models\MasterTncVideo;
use App\Models\MasterOffer;
use App\Models\MasterShop;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request){
        $user_type =  UserType::where('status', 1)->where('id', 6)->get();
        $query = MasterShop::select('*');

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_shops.name', 'like', "%$search%")
                    ->orWhere('master_shops.investor_name', 'like', "%$search%");
                });
            }

            $shop_list = $query->orderBy('id', 'DESC')->paginate(30);

        $datas = [
            'shop_list' => $shop_list,
            'request' => $request,
            'page_title' => 'Shop List',
        ];
        return view('admin.master.shop.index', $datas);
    }


    public function viewShop(Request $request){
        $user_type =  UserType::where('status', 1)->where('id', 6)->get();
        $query = MasterShop::select('*');

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_shops.name', 'like', "%$search%")
                    ->orWhere('master_shops.investor_name', 'like', "%$search%");
                });
            }

            $shop_list = $query->orderBy('id', 'DESC')->paginate(30);

        $datas = [
            'shop_list' => $shop_list,
            'request' => $request,
            'page_title' => 'View shop',
        ];
        return view('admin.master.shop.view_shop', $datas);
    }

    public function viewSoldProductsProfit($shop_id){
        $shop = MasterShop::find($shop_id);
        $products = \DB::table('sale_items')
            ->join('products', 'products.id', '=', 'sale_items.product_id')
            ->where('products.shop_id', $shop_id)
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
            'shop' => $shop,
            'page_title' => 'View Sold Products Profit',
        ];
        return view('admin.master.shop.view_sold_products_profit', $datas);

    }


    public function fetchAgreementData(Request $request)
    {
        $query = MasterShop::select('*');

        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('master_shops.name', 'like', "%$search%")
                ->orWhere('master_shops.investor_name', 'like', "%$search%");
            });
        }

        $shop_list = $query->orderBy('id', 'DESC')->paginate(30);


        if ($request->ajax()) {
            return view('admin.master.shop.shop_table_ajax', compact('shop_list'))->render();
        }
    }

    /* Store New Session */
   public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name'                 => 'required|string|max:255',
            'investor_name'        => 'required|string|max:255',
            'opening_date'         => 'required|date',
            'stock'                => 'required|numeric|min:0',
            'profit'               => 'required|numeric|min:0',

            'investor_photo'       => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'investor_agreement'   => 'required|mimes:pdf|max:10240',

        ], [
            // Name
            'name.required' => 'Please enter the name.',

            // Investor Name
            'investor_name.required' => 'Please enter the investor name.',

            // Opening Date
            'opening_date.required' => 'Please select the opening date.',
            'opening_date.date'     => 'Please enter a valid date.',

            // Stock
            'stock.required' => 'Please enter stock amount.',
            'stock.numeric'  => 'Stock must be a number.',
            'stock.min'      => 'Stock cannot be negative.',

            // Profit
            'profit.required' => 'Please enter profit amount.',
            'profit.numeric'  => 'Profit must be a number.',
            'profit.min'      => 'Profit cannot be negative.',

            // Investor Photo
            'investor_photo.required' => 'Please upload investor photo.',
            'investor_photo.image'    => 'The file must be an image.',
            'investor_photo.mimes'    => 'Only JPG, JPEG, PNG images are allowed.',
            'investor_photo.max'      => 'Image size must not exceed 2MB.',

            // Investor Agreement (PDF)
            'investor_agreement.required' => 'Please upload investor agreement PDF.',
            'investor_agreement.mimes'    => 'Only PDF file is allowed.',
            'investor_agreement.max'      => 'PDF size must not exceed 10MB.',
        ]);

        if ($request->hasFile('investor_photo')) {
            $ext = $request->investor_photo->getClientOriginalExtension();
            $fileName1 = time() . rand(1, 999) . '.' . $ext;
            $request->investor_photo->move(public_path('uploads/shops'), $fileName1);
            $data['investor_photo'] = 'uploads/shops/' . $fileName1;
        } else {
            $data['investor_photo'] = NULL;
        }

        if ($request->hasFile('investor_agreement')) {
            $ext = $request->investor_agreement->getClientOriginalExtension();
            $fileName2 = time() . rand(1, 999) . '.' . $ext;
            $request->investor_agreement->move(public_path('uploads/shops'), $fileName2);
            $data['investor_agreement'] = 'uploads/shops/' . $fileName2;
        } else {
            $data['investor_agreement'] = NULL;
        }

        $offer = new MasterShop();
        $offer->name = $request->name;
        $offer->investor_name = $request->investor_name;
        $offer->opening_date = $request->opening_date;
        $offer->stock = $request->stock;
        $offer->profit = $request->profit;
        $offer->shop_status = $request->shop_status;
        $offer->investor_photo = $data['investor_photo'];
        $offer->investor_agreement = $data['investor_agreement'];
        $offer->save();

        return response()->json(['status' => true, 'message' => 'Added successfully!']);
    }


    public function edit($id)
    {
        $shop = MasterShop::find($id);
        $page_title = 'Edit Shop';
        return view('admin.master.shop.edit_shop', compact('shop', 'page_title'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'investor_name' => 'required',
            'opening_date' => 'required',
            'stock' => 'required|numeric|min:0',
            'profit' => 'required|numeric|min:0',
            'shop_status' => 'required',
            'investor_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'investor_agreement' => 'nullable|mimes:pdf|max:10240',
        ], [
            'name.required' => 'Please enter the name.',
            'investor_name.required' => 'Please enter the investor name.',
            'opening_date.required' => 'Please select the opening date.',
            'stock.required' => 'Please enter stock amount.',
            'stock.numeric' => 'Stock must be a number.',
            'stock.min' => 'Stock cannot be negative.',
            'profit.required' => 'Please enter profit amount.',
            'profit.numeric' => 'Profit must be a number.',
            'profit.min' => 'Profit cannot be negative.',
            'shop_status.required' => 'Please select shop status.',
            'investor_photo.image' => 'The file must be an image.',
            'investor_photo.mimes' => 'Only JPG, JPEG, PNG images are allowed.',
            'investor_photo.max' => 'Image size must not exceed 2MB.',
            'investor_agreement.mimes' => 'Only PDF file is allowed.',
            'investor_agreement.max' => 'PDF size must not exceed 10MB.',
        ]);


        if ($request->hasFile('investor_photo')) {
            $ext = $request->investor_photo->getClientOriginalExtension();
            $fileName1 = time() . rand(1, 999) . '.' . $ext;
            $request->investor_photo->move(public_path('uploads/shops'), $fileName1);
            $data['investor_photo'] = 'uploads/shops/' . $fileName1;
        } else {
            $data['investor_photo'] = NULL;
        }

        if ($request->hasFile('investor_agreement')) {
            $ext = $request->investor_agreement->getClientOriginalExtension();
            $fileName2 = time() . rand(1, 999) . '.' . $ext;
            $request->investor_agreement->move(public_path('uploads/shops'), $fileName2);
            $data['investor_agreement'] = 'uploads/shops/' . $fileName2;
        } else {
            $data['investor_agreement'] = NULL;
        }

        $id = $request->shop_id;

        $shop = MasterShop::findOrFail($id);
        $shop->name = $request->name;
        $shop->investor_name = $request->investor_name;
        $shop->opening_date = $request->opening_date;
        $shop->stock = $request->stock;
        $shop->profit = $request->profit;
        $shop->shop_status = $request->shop_status;
        if( $data['investor_photo']!=null){
            $shop->investor_photo = $data['investor_photo'];
        }
        if( $data['investor_agreement']!=null){
            $shop->investor_agreement = $data['investor_agreement'];
        }
        $shop->save();

       return response()->json(['status' => true, 'message' => 'Updated successfully!']);
    }

    public function deleteShopData($id){
        $delete_offer = MasterShop::find($id);
        $delete_offer->delete();
        return back()->with(session()->flash('alert-success', 'Deleted Successfully'));
    }

    /** View Shop Products */

    public function viewShopProducts(Request $request, $shop_id){
        $shop = MasterShop::find($shop_id);
        // $products = $shop->products()->paginate(30);

        $query = Product::where('products.shop_id', $shop_id)->select([
            'products.*',
            'product_categories.name as category_name',
            'brands.name as brand_name',
            'master_shops.name as shop_name',
        ])->join('product_categories', 'product_categories.id', '=', 'products.category_id')
            ->join('brands', 'brands.id', '=', 'products.brand_id')
            ->join('master_shops', 'master_shops.id', '=', 'products.shop_id');

        $products = $query->get();

        $datas = [
            'shop' => $shop,
            'products' => $products,
            'request' => $request,
            'page_title' => 'Shop Products',
        ];
        return view('admin.master.shop.shop_products', $datas);
    }

}
