<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\WebInterface\MemberRepositoryInterface;
use App\Models\UserLogin;
use App\Models\User;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use App\Models\Panchayat;
use App\Models\Member;
use App\Models\MemberDocument;
use App\Models\AffiliatedCenter;
use App\Models\BranchProduct;
use App\Models\VivahmitraCategory;
use App\Models\VivahmitraProduct;
use App\Models\VivahmitraProductImage;
use App\Models\EWallet;
use App\Models\EWalletTransaction;
use App\Models\Transaction;
use App\Models\ExpenseTermsAndCondition;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\MasterMembership;
use App\Models\MasterNotice;
use App\Models\MasterVideo;
use App\Models\VivahAppSlider;
use App\Models\UserType;
use App\Models\UserDetail;
use App\Models\PrakhandVmBox;
use App\Models\MemberMessage;
use App\Models\CardStock;
use App\Models\CardTransaction;
use App\Models\MasterDesignation;
use App\Models\MasterOffer;
use App\Models\MVideoCategory;
use App\Models\UserTarget;
use App\Models\TrainingDetail;
use App\Models\SeminarGuestMettingDetail;
use App\Models\HomeMeetingDetail;
use App\Models\UserDistrict;
use App\Models\EmployeeTarget;
use App\Models\KitStock;
use App\Models\KitTransaction;
use App\Models\TempKitStock;
use App\Models\TempKitTransaction;
use App\Models\PaymentSubmission;
use App\Models\PaymentScreenshot;
use App\Models\TempCashEntryDetail;
use App\Models\TempCashEntry;
use App\Models\CashEntryDetail;
use App\Models\CashEntry;
use App\Models\MonthlyRoutine;
use Illuminate\Support\Facades\Validator;   // ← ADD THIS
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class MemberController extends Controller
{
    private $memberRepository;
    public function __construct(MemberRepositoryInterface $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function customerDashboard()
    {
        // dd(session('LoggedVivahMitra'));
        // $data = $this->memberRepository->dashboardDataCount();
        $logged_vivah_mitra = loggedVivahMitra();
        // dd($logged_vivah_mitra);
        $vivah_mitra_details = vivahMitraDetails();
        $vivahMitraEWallet = getEWallet('employee', $logged_vivah_mitra);
        $e_wallet = EWallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $todayIncome = EWalletTransaction::where('type', 'credit')
            ->where('wallet_id', $e_wallet->id)
            ->whereDate('created_at', now())
            ->sum('amount');

        $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $fund_transactions = WalletTransaction::where('wallet_id', $fund_wallet->id)->orderBy('id', 'ASC')->get();

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();

        $totalReceivedInBank = Transaction::where('type', 'credit')->where('user_id', $logged_vivah_mitra)->where('type', 'credit')->sum('amount');
        $total_available_physical_card_received = CardStock::where('user_id', $logged_vivah_mitra)->value('quantity');

        $employee_districts = \DB::table('user_districts as ud')
                                ->join('districts as d', 'd.id', '=', 'ud.district_id')
                                ->where('ud.user_id', $logged_vivah_mitra)
                                ->select('ud.*', 'd.name as district_name', 'd.id as district_id')
                                ->get();

        $employee_allotted_shops = \DB::table('user_shops as us')
                                ->join('master_shops as ms', 'ms.id', '=', 'us.master_shop_id')
                                ->where('us.user_id', $logged_vivah_mitra)
                                ->select('us.*', 'ms.name as shop_name', 'ms.id as master_shop_id')
                                ->get();


        $Case_count = '0';
        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'todayIncome' => $todayIncome,
            'vivah_mitra_ewallet' => $vivahMitraEWallet->balance,
            'vivah_mitra_fundWallet' => $vivahMitraFundWallet->balance,
            'vivah_mitra_categories' => VivahmitraCategory::whereNull('parent_id')->where('status', 1)->with('children')->orderBy('id', 'ASC')->get(),
            'vivah_mitra_app_sliders' => VivahAppSlider::where('status', 1)->orderBy('id', 'DESC')->get(),
            'total_physical_card' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'physical')->count(),
            'total_digital_card' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'digital')->count(),
            'totalReceivedInBank' => $totalReceivedInBank,
            'total_available_physical_card_received' => $total_available_physical_card_received,
            'employee_districts' => $employee_districts,
            'employee_allotted_shops' => $employee_allotted_shops,
        ];
        return view('vivah_mitra.dashboard.dashboard_view', $datas);
    }

    public function vivahMitraSubCategory($slug)
    {
        // dd(session('LoggedVivahMitra'));
        // $data = $this->memberRepository->dashboardDataCount();
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        $category_details = VivahmitraCategory::where('slug', $slug)->first();
        // dd($vivah_mitra_details);

        if($category_details->id==6){
            $video_Offer = MasterOffer::where('offer_type', 'video')->where('user_type', $vivah_mitra_details->user_type_id)->where('user_designation', $vivah_mitra_details->user_designation_id)->where('status', 1)->get();
            $image_Offer_list = MasterOffer::where('offer_type', 'image')->where('user_type', $vivah_mitra_details->user_type_id)->where('user_designation', $vivah_mitra_details->user_designation_id)->where('status', 1)->get();

            $days1 = 15; /** 15 days offer */
            $days2 = 30; /** 30 days offer */

            $startDate1 = Carbon::parse($vivah_mitra_details->verify_date);
            $endDate1 = $startDate1->copy()->addDays($days1);

            // dd($endDate1);

            $startDate2 = Carbon::parse($vivah_mitra_details->verify_date);
            $endDate2 = $startDate2->copy()->addDays($days2);



            $count = User::where('parent_id', $vivah_mitra_details->id)
                ->whereBetween('verify_date', [$startDate1, $endDate1])
                ->count();

            $count2 = User::where('parent_id', $vivah_mitra_details->id)
                ->whereBetween('verify_date', [$startDate2, $endDate2])
                ->count();

            // मान लो target = 10
            $target1 = 10;
            $target2 = 16;

            /** 15 days target */
            if ($count >= $target1) {

                DB::table('user_targets')->updateOrInsert(
                    [
                        'user_id' => $vivah_mitra_details->id,
                        'duration_days' => $days1
                    ],
                    [
                        'target_count' => $count,
                        'start_date' => $startDate1,
                        'end_date' => $endDate1,
                        'amount' => 5000,
                        'message' => 'Achieved Rs 5000/- Mixer Grinder',
                        'is_achieved' => 1,
                        'updated_at' => now(),
                        'created_at' => now()
                    ]
                );
            }

            /** 30 days offer */
            if ($count2 >= $target2) {

                DB::table('user_targets')->updateOrInsert(
                    [
                        'user_id' => $vivah_mitra_details->id,
                        'duration_days' => $days2
                    ],
                    [
                        'target_count' => $count,
                        'start_date' => $startDate2,
                        'end_date' => $endDate2,
                        'amount' => 0,
                        'message' => 'Achieved Keypad Mobile Phone',
                        'is_achieved' => 1,
                        'updated_at' => now(),
                        'created_at' => now()
                    ]
                );
            }

            $datas = [
                    'vivah_mitra_details' => $vivah_mitra_details,
                    'category_details' => $category_details,
                    'video_Offer' => $video_Offer,
                    'image_Offer_list' => $image_Offer_list,
                    'user_target_in_10_days' => UserTarget::where('user_id', $vivah_mitra_details->id)->where('duration_days', 15)->where('is_achieved', 1)->count(),
                    'user_target_in_30_days' => UserTarget::where('user_id', $vivah_mitra_details->id)->where('duration_days', 30)->where('is_achieved', 1)->count(),
                ];
                return view('vivah_mitra.dashboard.offer_view', $datas);
        }else{
            if ($category_details) {
                $Case_count = '0';
                $datas = [
                    'vivah_mitra_details' => $vivah_mitra_details,
                    'category_details' => $category_details,
                    'vivah_mitra_subcategories' => VivahmitraCategory::where('parent_id', $category_details->id)->where('status', 1)->orderBy('id', 'ASC')->get(),
                ];
                return view('vivah_mitra.dashboard.subcategory_view', $datas);
            } else {
                return redirect()->back();
            }
        }

    }

    public function vivahMitraProducts($slug)
    {

        // dd(session('LoggedVivahMitra'));
        // $data = $this->memberRepository->dashboardDataCount();
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        $category_details = VivahmitraCategory::where('slug', $slug)->first();
        dd($category_details);
        $Case_count = '0';
        if ($category_details) {
            $datas = [
                'vivah_mitra_details' => $vivah_mitra_details,
                'category_details' => $category_details,
                'vivah_mitra_subcategories' => VivahmitraCategory::where('parent_id', $category_details->id)->where('status', 1)->orderBy('id', 'ASC')->get(),
            ];
            return view('vivah_mitra.dashboard.subcategory_view', $datas);
        } else {
            return redirect()->back();
        }
    }

    public function listingByCategory(Request $request, $category_slug)
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        $category = VivahmitraCategory::where('slug', $category_slug)
            ->where('status', 1)
            ->with('products')
            ->firstOrFail();
        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'category' => $category,
        ];
        return view('vivah_mitra.products.listing', $datas);
    }

    public function productDetails($product_slug)
    {

        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        $product = VivahmitraProduct::where('slug', $product_slug)->where('status', 1)->firstOrFail();
        $category = VivahmitraCategory::where('id', $product->category_id)->where('status', 1)->first();
        $product_images = VivahmitraProductImage::where('product_id', $product->id)->get();
        // dd($product_images);
        $datas = [
            'logged_vivah_mitra' => $logged_vivah_mitra,
            'vivah_mitra_details' => $vivah_mitra_details,
            'category' => $category,
            'product' => $product,
            'product_images' => $product_images,
        ];
        return view('vivah_mitra.products.detail', $datas);
    }

    public function applyDigitalMembership()
    {
        $datas = [
            'logged_vivah_mitra' => loggedVivahMitra(),
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
        ];
        return view('vivah_mitra.member.apply_digital_membership', $datas);
    }

    public function storeDigitalCardMemberData(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                // 'membership_number' => 'required|exists:master_memberships,membership_number',
                'leader_id' => 'required',
                'name' => 'required',
                'father_husband' => 'required',
                'mobile' => 'required',
                'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $logged_vivah_mitra = loggedVivahMitra();
            $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);
            $deduct_amount = 49;

            /* -----------------------------
            1️⃣ Check Wallet Balance
            ----------------------------- */
            if ($vivahMitraFundWallet->balance < $deduct_amount) {
                return response()->json([
                    'status' => false,
                    'message' => 'पर्याप्त बैलेंस उपलब्ध नहीं है। कृपया पहले अपने वॉलेट में राशि जोड़ें।!'
                ]);
            }

            do {
                // Generate remaining 12 digits (since 50 + 12 digits = 14 digits total)
                $random = str_pad(mt_rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
                // Final code: 50 + 12 digits = 14 digits
                $newMembershipCode = '50' . $random;
                // Check uniqueness in DB
                $exists = MasterMembership::where('membership_number', $newMembershipCode)->exists();
            } while ($exists);

            $logged_vivah_mitra = loggedVivahMitra();



            // Save into DB
            $saveNewMembership = new MasterMembership();
            $saveNewMembership->membership_number = $newMembershipCode;
            $saveNewMembership->created_date = date('Y-m-d');
            $saveNewMembership->created_by = $logged_vivah_mitra;
            $saveNewMembership->save();

			$image_file_name = null;
            $uploadPath = public_path('uploads/members');

            $profile_pic = null; // default value

            if ($request->hasFile('profile_pic')) {

                $image_file_name = 'profile_pic_' . time() . '.' .
                    $request->profile_pic->getClientOriginalExtension();

                $request->profile_pic->move($uploadPath, $image_file_name);

                $profile_pic = 'uploads/members/' . $image_file_name;
            }

            // Create Member
            $member = new Member();
            $member->leader_id = $logged_vivah_mitra;
            $member->membership_number = $newMembershipCode;
            $member->name = $request->name;
            $member->father_husband = $request->father_husband;
            $member->address = $request->address;
            $member->post = $request->post;
            $member->state = $request->state;
            $member->district = $request->district;
            $member->pincode = $request->pincode;
            $member->mobile = $request->mobile;
            $member->whatsapp = $request->whatsapp;

            // Ayushmati Details
            $member->ayushmati_girl_name = $request->ayushmati_girl_name;
            $member->ayushmati_age = $request->ayushmati_age;
            $member->ayushmati_qualification = $request->ayushmati_qualification;
            $member->ayushmati_father_occupation = $request->ayushmati_father_occupation;
            $member->ayushmati_father_husband_name = $request->ayushmati_father_husband_name;
            $member->ayushmati_expected_marriage_month = $request->ayushmati_expected_marriage_month;
            $member->ayushmati_expected_marriage_year = $request->ayushmati_expected_marriage_year;

            // Sister Details
            $member->sister_name_1 = $request->sister_name_1;
            $member->sister_qualification_1 = $request->sister_qualification_1;
            $member->sister_age_1 = $request->sister_age_1;

            $member->sister_name_2 = $request->sister_name_2;
            $member->sister_qualification_2 = $request->sister_qualification_2;
            $member->sister_age_2 = $request->sister_age_2;

            $member->sister_name_3 = $request->sister_name_3;
            $member->sister_qualification_3 = $request->sister_qualification_3;
            $member->sister_age_3 = $request->sister_age_3;

            $member->expected_marriage_package = $request->expected_marriage_package;
            $member->status = 1;
            $member->card_type = 'digital';
			$member->profile_pic     = $profile_pic;

            $member->save(); // save member

            // Update master membership
            DB::table('master_memberships')
                ->where('membership_number', $newMembershipCode)
                ->update([
                    'is_used' => 1,
                    'member_id' => $member->id,
                    'leader_id' => $logged_vivah_mitra,
                    'vivah_mitra_id' => $logged_vivah_mitra,
                    'used_date' => date('Y-m-d')
                ]);

                $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);
                $deduct_amount = 49;
                $incentiveAmount = 0;
                if ($member) {
                    debitWallet(
                        $vivahMitraFundWallet,
                        $deduct_amount,
                        "Membership Amount Deducted | Membership Number: {$newMembershipCode}"
                    );

                    $incentivePercent = 42.857142857143;

                    $incentiveAmount = round(($deduct_amount * $incentivePercent) / 100, 2);

                    $vivahMitraEWallet = getEWallet('employee', $logged_vivah_mitra);

                    $credit_type = 'digital_card_credit';
                    $vivah_mitra_details = vivahMitraDetails();
                $vivahMitraDistrict = $vivah_mitra_details->city;
                    // Credit incentive
                    creditEWallet(
                        $vivahMitraEWallet,
                        $incentiveAmount,
                        $credit_type,
                        "{$incentivePercent}% Incentive | Membership: {$newMembershipCode} | Name: {$request->name} | Father/Husband: {$request->father_husband} | Address: {$request->address} | Post: {$request->post} | Mobile: {$request->mobile}",
                        $vivahMitraDistrict
                    );

                    // Upline Incentives
                    creditUplineIncentiveforDigitalCard(
                        $logged_vivah_mitra,
                        $deduct_amount,
                        $newMembershipCode,
                        $request->name,
                        $request->father_husband,
                        $request->address,
                        $request->post,
                        $request->mobile
                    );

                }

            $message = "प्रिय {$request->name}, आपका आयुष्मति मेंबरशिप डिजिटल कार्ड सफलतापूर्वक जारी कर दिया गया है। आपकी आयुष्मति मेंबरशिप संख्या : {$newMembershipCode} कुल प्राप्त राशि : ₹{$deduct_amount}/-";

            $memberMessage = new MemberMessage();
            $memberMessage->member_id = $member->id;
            $memberMessage->messages = $message;
            $memberMessage->membership_number = $newMembershipCode;
            $memberMessage->user_id = $logged_vivah_mitra;
            $memberMessage->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'member' => $member->id,
                'message' => 'Digital Membership Applied Successfully!'
            ], 200);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function digitalMemberApplied($id)
    {
        $member =  Member::findOrFail($id);
        if ($member) {
            $datas = [
                'logged_vivah_mitra' => loggedVivahMitra(),
                'vivah_mitra_details' => vivahMitraDetails(),
                'member' =>  $member,
            ];
            return view('vivah_mitra.member.digital_membership_applied', $datas);
        } else {
            return redirect('member/dashboard');
        }
    }

    public function applyPhysicalMembership()
    {
        $datas = [
            'logged_vivah_mitra' => loggedVivahMitra(),
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
        ];
        return view('vivah_mitra.member.apply_physical_membership', $datas);
    }

    public function checkVivahMitraMembership(Request $request)
    {
        $membership = DB::table('master_memberships')
            ->where('membership_number', $request->membership_number)
            // ->where('vivah_mitra_id', loggedVivahMitra())
            ->first();

        if (!$membership) {
            return response()->json(['status' => 'not_found']);
        }

        // If membership is already used
        if ($membership->is_used == 1) {

            // Get member name from members table
            $member = DB::table('members')
                ->where('id', $membership->member_id)
                ->first();

            return response()->json([
                'status' => 'used',
                'member_name' => $member ? $member->name : 'Unknown'
            ]);
        }

        // Not used
        return response()->json(['status' => 'unused']);
    }


    public function storePhysicalCardMemberData(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'membership_number' => 'required|exists:master_memberships,membership_number',
                'leader_id' => 'required',
                'name' => 'required',
                'father_husband' => 'required',
                'mobile' => 'required',
                'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $logged_vivah_mitra = loggedVivahMitra();
            $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);
            $deduct_amount = 999;

            /* -----------------------------
            1️⃣ Check Wallet Balance
            ----------------------------- */
            if ($vivahMitraFundWallet->balance < $deduct_amount) {
                return response()->json([
                    'status' => false,
                    'message' => 'पर्याप्त बैलेंस उपलब्ध नहीं है। कृपया पहले अपने वॉलेट में राशि जोड़ें।!'
                ]);
            }

			$image_file_name = null;
            $uploadPath = public_path('uploads/members');

            $profile_pic = null; // default value

            if ($request->hasFile('profile_pic')) {

                $image_file_name = 'profile_pic_' . time() . '.' .
                    $request->profile_pic->getClientOriginalExtension();

                $request->profile_pic->move($uploadPath, $image_file_name);

                $profile_pic = 'uploads/members/' . $image_file_name;
            }


            $logged_vivah_mitra = loggedVivahMitra();
            // Create Member
            $member = new Member();
            $member->leader_id = $logged_vivah_mitra;
            $member->membership_number = $request->membership_number;
            $member->name = $request->name;
            $member->father_husband = $request->father_husband;
            $member->address = $request->address;
            $member->post = $request->post;
            $member->state = $request->state;
            $member->district = $request->district;
            $member->pincode = $request->pincode;
            $member->mobile = $request->mobile;
            $member->whatsapp = $request->whatsapp;

            // Ayushmati Details
            $member->ayushmati_girl_name = $request->ayushmati_girl_name;
            $member->ayushmati_age = $request->ayushmati_age;
            $member->ayushmati_qualification = $request->ayushmati_qualification;
            $member->ayushmati_father_occupation = $request->ayushmati_father_occupation;
            $member->ayushmati_father_husband_name = $request->ayushmati_father_husband_name;
            $member->ayushmati_expected_marriage_month = $request->ayushmati_expected_marriage_month;
            $member->ayushmati_expected_marriage_year = $request->ayushmati_expected_marriage_year;

            // Sister Details
            $member->sister_name_1 = $request->sister_name_1;
            $member->sister_qualification_1 = $request->sister_qualification_1;
            $member->sister_age_1 = $request->sister_age_1;

            $member->sister_name_2 = $request->sister_name_2;
            $member->sister_qualification_2 = $request->sister_qualification_2;
            $member->sister_age_2 = $request->sister_age_2;

            $member->sister_name_3 = $request->sister_name_3;
            $member->sister_qualification_3 = $request->sister_qualification_3;
            $member->sister_age_3 = $request->sister_age_3;

            $member->expected_marriage_package = $request->expected_marriage_package;
            $member->status = 1;
            $member->card_type = 'physical';
			$member->profile_pic     = $profile_pic;

            $member->save(); // save member

            // Update master membership
            DB::table('master_memberships')
                ->where('membership_number', $request->membership_number)
                ->update([
                    'is_used' => 1,
                    'member_id' => $member->id,
                    'leader_id' => $logged_vivah_mitra,
                    'vivah_mitra_id' => $logged_vivah_mitra,
                    'used_date' => date('Y-m-d')
                ]);

            // use this in physical membership card

            $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);
            $deduct_amount = 999;
            $incentiveAmount = 0;
            if ($member) {
                debitWallet(
                    $vivahMitraFundWallet,
                    $deduct_amount,
                    "Membership Amount Deducted | Membership Number: {$request->membership_number}"
                );

                // $incentivePercent = 20.02;
                $incentivePercent = 15.02;

                $asmIncentivePercent = 14.29;

                $incentiveAmount = round(($deduct_amount * $incentivePercent) / 100, 2);

                $vivahMitraEWallet = getEWallet('employee', $logged_vivah_mitra);
                $credit_type = 'physical_card_credit';
                // Credit incentive
                $vivah_mitra_details = vivahMitraDetails();
                $vivahMitraDistrict = $vivah_mitra_details->city;
                creditEWallet(
                    $vivahMitraEWallet,
                    $incentiveAmount,
                    $credit_type,
                    "{$incentivePercent}% Incentive | Membership: {$request->membership_number} | Name: {$request->name} | Father/Husband: {$request->father_husband} | Address: {$request->address} | Post: {$request->post} | Mobile: {$request->mobile}",
                    $vivahMitraDistrict
                );



                $getAsmID = UserDistrict::where('district_id', $vivahMitraDistrict)->value('user_id');

                $asMEWallet = getEWallet('employee', $getAsmID);
                $credit_type = 'physical_card_credit';
                $asMincentiveAmount = round(($deduct_amount * $asmIncentivePercent) / 100, 2);
                // Credit incentive
                $vivah_mitra_details = vivahMitraDetails();
                $vivahMitraDistrict = $vivah_mitra_details->city;
                creditEWallet(
                    $asMEWallet,
                    $asMincentiveAmount,
                    $credit_type,
                    "{$asmIncentivePercent}% Incentive | Membership: {$request->membership_number} | Name: {$request->name} | Father/Husband: {$request->father_husband} | Address: {$request->address} | Post: {$request->post} | Mobile: {$request->mobile}",
                    $vivahMitraDistrict
                );

                // Upline Incentives
                creditUplineIncentive(
                    $logged_vivah_mitra,
                    $deduct_amount,
                    $request->membership_number,
                    $request->name,
                    $request->father_husband,
                    $request->address,
                    $request->post,
                    $request->mobile
                );

            }

            /** set message here */

            $message = "प्रिय {$request->name}, आपका आयुष्मति मेंबरशिप फिजिकल कार्ड सफलतापूर्वक जारी कर दिया गया है। आपकी आयुष्मति मेंबरशिप संख्या : {$request->membership_number} कुल प्राप्त राशि : ₹{$deduct_amount}/-";

            $memberMessage = new MemberMessage();
            $memberMessage->member_id = $member->id;
            $memberMessage->messages = $message;
            $memberMessage->membership_number = $request->membership_number;
            $memberMessage->user_id = $logged_vivah_mitra;
            $memberMessage->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'member' => $member->id,
                'message' => 'Physical Membership Applied Successfully!'
            ], 200);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function physicalMemberApplied($id)
    {
        $member =  Member::findOrFail($id);
        if ($member) {
            $datas = [
                'logged_vivah_mitra' => loggedVivahMitra(),
                'vivah_mitra_details' => vivahMitraDetails(),
                'member' =>  $member,
            ];
            return view('vivah_mitra.member.physical_membership_applied', $datas);
        } else {
            return redirect('member/dashboard');
        }
    }

    public function trainingVideo(Request $request)
    {
        // dd(session('LoggedVivahMitra'));
        // $data = $this->memberRepository->dashboardDataCount();
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $video_category = MVideoCategory::where('parent_id', null)->where('status', 1)->get();
        // dd($vivah_mitra_details);
        $query = MasterVideo::where('master_videos.user_type', $vivah_mitra_details->user_type_id)
            ->where('master_videos.user_designation', $vivah_mitra_details->user_designation_id)->select([
                'master_videos.*',
                'user_types.name as userType',
                'master_designations.name as userDesignation',
            ])->join('user_types', 'user_types.id', '=', 'master_videos.user_type')
            ->leftJoin('master_designations', 'master_designations.id', '=', 'master_videos.user_designation');

        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('master_videos.video_title', 'like', "%$search%")
                    ->orWhere('master_videos.video_url', 'like', "%$search%");
            });
        }

        $video_list = $query->paginate(10);
        // dd($video_list);

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'video_list' => $video_list,
            'video_category' => $video_category,
        ];
        return view('vivah_mitra.dashboard.training_video_category', $datas);
    }



    public function trainingVideoSubcategory($id)
    {
        // dd(session('LoggedVivahMitra'));
        // $data = $this->memberRepository->dashboardDataCount();
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $video_sub_category = MVideoCategory::where('parent_id', $id)->where('status', 1)->get();
        // dd($vivah_mitra_details);


        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            // 'video_list' => $video_list,
            'video_sub_category' => $video_sub_category,
        ];
        return view('vivah_mitra.dashboard.training_video_sub_category', $datas);
    }

    public function viewTrainingVideo(Request $request)
    {
        // dd(session('LoggedVivahMitra'));
        // $data = $this->memberRepository->dashboardDataCount();
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $query = MasterVideo::select([
                'master_videos.*',
                'user_types.name as userType',
                'master_designations.name as userDesignation',
            ])
            ->join('user_types', 'user_types.id', '=', 'master_videos.user_type')
            ->leftJoin('master_designations', 'master_designations.id', '=', 'master_videos.user_designation')
            ->where('master_videos.user_type', $vivah_mitra_details->user_type_id)
            ->where('master_videos.user_designation', $vivah_mitra_details->user_designation_id);

        // Apply category & subcategory only if present
        if (!empty($request->category) && !empty($request->subcategory)) {
            $query->where('master_videos.category_id', $request->category)
                ->where('master_videos.sub_category_id', $request->subcategory);
        }

        // Search filter
        if (!empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('master_videos.video_title', 'like', "%$search%")
                ->orWhere('master_videos.video_url', 'like', "%$search%");
            });
        }

        // Get result
        $video_list = $query->latest()->paginate(10);

        // 👉 If category/subcategory applied but no data found → return empty
        if (!empty($request->category) && !empty($request->subcategory) && $video_list->isEmpty()) {
            $video_list = [];
        }

        // dd($video_list);


        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'video_list' => $video_list,
        ];
        return view('vivah_mitra.dashboard.view_training_video', $datas);
    }

    public function updateKyc()
    {
        $customer_logged = session('LoggedCustomer');
        $customer_details = User::where('id', session('LoggedCustomer')->user_id)->first();
        $state_list = State::get();
        return view('customer.profile.update-profile', compact('state_list', 'customer_details'));
    }

    public function getLetter()
    {
        $member_logged = session('LoggedMember');
        $details = Member::where('id', session('LoggedMember')->id)->first();
        $member_document = MemberDocument::where('member_id', session('LoggedMember')->id)->first();

        if ($member_document) {
            $state_list = State::get();
            return view('member.dashboard.appointment_letter', compact('state_list', 'member_document', 'details'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Letter not Generated'));
        }
    }

    public function getCertificate()
    {
        $member_logged = session('LoggedMember');
        $details = Member::select('members.*', 'states.name as state_name', 'cities.name as city_name')
            ->leftJoin('states', 'states.id', '=', 'members.state')
            ->leftJoin('cities', 'cities.id', '=', 'members.district')
            ->where('members.id', session('LoggedMember')->id)
            ->first();
        $member_document = MemberDocument::where('member_id', session('LoggedMember')->id)->first();
        $state_list = State::get();
        if ($member_document) {
            return view('member.dashboard.certificate_letter', compact('state_list', 'member_document', 'details'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'Certificate not Generated'));
        }
    }



    public function getIdCard()
    {
        $member_logged = session('LoggedMember');
        $details = Member::where('id', session('LoggedMember')->id)->first();
        $member_document = MemberDocument::where('member_id', session('LoggedMember')->id)->first();
        $state_list = State::get();
        return view('member.dashboard.id_card', compact('state_list', 'member_document', 'details'));
    }

    public function downloadAppointmentLetter($id)
    {
        $member_logged = session('LoggedMember');
        $details = Member::select('members.*', 'states.name as state_name', 'districts.name as city_name')
            ->leftJoin('states', 'states.id', '=', 'members.state')
            ->leftJoin('districts', 'districts.id', '=', 'members.district')
            ->where('members.id', session('LoggedMember')->id)
            ->first();
        $member_document = MemberDocument::where('member_id', session('LoggedMember')->id)->first();
        $affiliated_center = AffiliatedCenter::where('state', $details->state)->where('city', $details->district)->first();

        $backgroundImage = public_path('assets/assets_member/certificate/appointment.jpg');

        // Create folder if not exists
        $qrDir = public_path('qrcodes');
        if (!file_exists($qrDir)) {
            mkdir($qrDir, 0777, true);
        }

        // File path
        $qrPath = $qrDir . '/' . $details->id . '.png';

        // ✅ Generate and save QR code
        $qrImage = \QrCode::format('png')
            ->size(200)
            ->errorCorrection('H')
            ->generate(url('member/' . $details->id));

        file_put_contents($qrPath, $qrImage); // <-- save to file system

        // Pass path to PDF
        $pdf = Pdf::loadView('member.certificate.appointment_letter_template_in_pdf', compact('details', 'member_document', 'backgroundImage', 'member_logged', 'qrPath', 'affiliated_center'))
            ->setPaper('a4', 'portrait');

        $filename = 'appointment-letter-'
            . preg_replace('/[\/\\\\:*?"<>|]/', '-', $details->name)
            . '-'
            . preg_replace('/[\/\\\\:*?"<>|]/', '-', $member_document->membership_number)
            . '.pdf';

        return $pdf->download($filename);
    }

    public function downloadCertificate($id)
    {
        $member_logged = session('LoggedMember');
        // $details = Member::select('members.*', 'states.name as state_name', 'cities.name as city_name')
        //                 ->leftJoin('states', 'states.id', '=', 'members.state')
        //                 ->leftJoin('cities', 'cities.id', '=', 'members.district')
        //                 ->where('members.id', session('LoggedMember')->id)
        //                 ->first();

        $details = Member::select('members.*', 'states.name as state_name', 'districts.name as city_name')
            ->leftJoin('states', 'states.id', '=', 'members.state')
            ->leftJoin('districts', 'districts.id', '=', 'members.district')
            ->where('members.id', session('LoggedMember')->id)
            ->first();
        $member_document = MemberDocument::where('member_id', session('LoggedMember')->id)->first();
        $affiliated_center = AffiliatedCenter::where('state', $details->state)->where('city', $details->district)->first();

        $backgroundImage = public_path('assets/assets_member/certificate/certificate.jpg');

        // Create folder if not exists
        $qrDir = public_path('qrcodes');
        if (!file_exists($qrDir)) {
            mkdir($qrDir, 0777, true);
        }

        // File path
        $qrPath = $qrDir . '/' . $details->id . '.png';

        // ✅ Generate and save QR code
        $qrImage = \QrCode::format('png')
            ->size(200)
            ->errorCorrection('H')
            ->generate(url('member/' . $details->id));

        file_put_contents($qrPath, $qrImage); // <-- save to file system

        // Pass path to PDF
        $pdf = Pdf::loadView('member.certificate.certificates_template_in_pdf', compact('details', 'member_document', 'backgroundImage', 'member_logged', 'qrPath', 'affiliated_center'))
            ->setPaper('a4', 'landscape');

        $filename = 'ihrcc-certificate-'
            . preg_replace('/[\/\\\\:*?"<>|]/', '-', $details->name)
            . '-'
            . preg_replace('/[\/\\\\:*?"<>|]/', '-', $member_document->membership_number)
            . '.pdf';

        return $pdf->download($filename);
    }

    public function myProfile()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        $datas = [
            'logged_vivah_mitra' => $logged_vivah_mitra,
            'vivah_mitra_details' => $vivah_mitra_details,
        ];
        return view('vivah_mitra.profile.my_profile', $datas);
    }

    public function editProfile()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        $datas = [
            'logged_vivah_mitra' => $logged_vivah_mitra,
            'vivah_mitra_details' => $vivah_mitra_details,
        ];
        return view('vivah_mitra.profile.edit_profile', $datas);
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $logged_vivah_mitra = loggedVivahMitra();
        $user = User::where('id', $logged_vivah_mitra)->first();
        if (!$user) {
            return response()->json([
                'status'  => true,
                'message' => 'Not a valid user'
            ]);
        }



        $image_file_name = null;
        $uploadPath = public_path('uploads/staff');

        if ($request->hasFile('profile_pic')) {
            $image_file_name = 'profile_pic' . time() . '.' . $request->profile_pic->getClientOriginalExtension();
            $request->profile_pic->move($uploadPath, $image_file_name);

            $user->profile_pic = $image_file_name ? 'uploads/staff/' . $image_file_name : null;
            $user->save();
        }


        return response()->json([
            'status'  => true,
            'message' => 'Profile updated successfully'
        ]);
    }

    /** case details */

    // public function todayIncome()
    // {
    //     $logged_vivah_mitra = loggedVivahMitra();
    //     $vivah_mitra_details = vivahMitraDetails();
    //     $vivahMitraEWallet = getEWallet('employee', $logged_vivah_mitra);
    //     $e_wallet = EWallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
    //     $todayIncome = EWalletTransaction::where('type', 'credit')
    //         ->where('wallet_id', $e_wallet->id)
    //         ->whereDate('created_at', now())
    //         ->get();

    //     $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);

    //     $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
    //     $fund_transactions = WalletTransaction::where('wallet_id', $fund_wallet->id)->orderBy('id', 'ASC')->get();

    //     $datas = [
    //         'vivah_mitra_details' => $vivah_mitra_details,
    //         'todayIncome' => $todayIncome,
    //         'vivah_mitra_ewallet' => $vivahMitraEWallet->balance,
    //         'vivah_mitra_fundWallet' => $vivahMitraFundWallet->balance,
    //     ];
    //     return view('vivah_mitra.income.today_income', $datas);
    // }

    public function todayIncome()
    {
        $vivah_mitra_details = vivahMitraDetails();
        // dd($vivah_mitra_details);
        $designation = $vivah_mitra_details->designation_name;

        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        $vivahMitraEWallet = getEWallet('employee', $logged_vivah_mitra);
        $e_wallet = EWallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        // dd($e_wallet->id);
        $today_physical_card_income = EWalletTransaction::where('credit_type', 'physical_card_credit')
            ->where('wallet_id', $e_wallet->id)
            ->whereDate('created_at', now())
            ->sum('amount');

        $today_digital_card_income = EWalletTransaction::where('credit_type', 'digital_card_credit')
            ->where('wallet_id', $e_wallet->id)
            ->whereDate('created_at', now())
            ->sum('amount');

        $today_welcome_income = EWalletTransaction::where('credit_type', 'welcome_bonus')
            ->where('wallet_id', $e_wallet->id)
            ->whereDate('created_at', now())
            ->sum('amount');

        $today_training_income = EWalletTransaction::where('credit_type', 'trainer_meeting_incentive')
            ->where('wallet_id', $e_wallet->id)
            ->whereDate('created_at', now())
            ->sum('amount');

        $today_seminar_guest_income = EWalletTransaction::where('credit_type', 'seminar_guest_meeting_incentive')
            ->where('wallet_id', $e_wallet->id)
            ->whereDate('created_at', now())
            ->sum('amount');

        $today_home_meeting_income = EWalletTransaction::where('credit_type', 'home_meeting_incentive')
            ->where('wallet_id', $e_wallet->id)
            ->whereDate('created_at', now())
            ->sum('amount');

        $datas = [
            'today_physical_card_income' => $today_physical_card_income,
            'today_digital_card_income' => $today_digital_card_income,
            'today_welcome_income' => $today_welcome_income,
            'today_training_income' => $today_training_income,
            'today_seminar_guest_income' => $today_seminar_guest_income,
            'today_home_meeting_income' => $today_home_meeting_income,
            'designation' => $designation,
            'vivah_mitra_details' => $vivah_mitra_details,
        ];

        return view('vivah_mitra.income.today_income', $datas);
    }

    public function myIncome()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        $vivahMitraEWallet = getEWallet('employee', $logged_vivah_mitra);
        $e_wallet = EWallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $myIncome = EWalletTransaction::where('type', 'credit')
            ->where('wallet_id', $e_wallet->id)
            ->get();

        $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $fund_transactions = WalletTransaction::where('wallet_id', $fund_wallet->id)->orderBy('id', 'ASC')->get();

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'myIncomeList' => $myIncome,
            'vivah_mitra_ewallet' => $vivahMitraEWallet->balance,
            'vivah_mitra_fundWallet' => $vivahMitraFundWallet->balance,
        ];
        return view('vivah_mitra.income.my_income', $datas);
    }

    public function fundWallet()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        $vivahMitraEWallet = getEWallet('employee', $logged_vivah_mitra);
        $e_wallet = EWallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $myIncome = EWalletTransaction::where('type', 'credit')
            ->where('wallet_id', $e_wallet->id)
            ->get();

        $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $fund_transactions = WalletTransaction::where('wallet_id', $fund_wallet->id)->orderBy('id', 'ASC')->get();
        // dd($fund_transactions);
        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'fund_transactions' => $fund_transactions,
            'vivah_mitra_ewallet' => $vivahMitraEWallet->balance,
            'vivah_mitra_fundWallet' => $vivahMitraFundWallet->balance,
        ];
        return view('vivah_mitra.income.fund_wallet', $datas);
    }

    public function incomeStatement()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        $vivahMitraEWallet = getEWallet('employee', $logged_vivah_mitra);
        $e_wallet = EWallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $myIncome = EWalletTransaction::where('type', 'credit')
            ->where('wallet_id', $e_wallet->id)
            ->get();

        $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $fund_transactions = WalletTransaction::where('wallet_id', $fund_wallet->id)->orderBy('id', 'ASC')->get();
        // dd($fund_transactions);
        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'fund_transactions' => $fund_transactions,
            'vivah_mitra_ewallet' => $vivahMitraEWallet->balance,
            'vivah_mitra_fundWallet' => $vivahMitraFundWallet->balance,
        ];
        return view('vivah_mitra.income.income_statement', $datas);
    }

    public function incomeStatementFilter(Request $request)
    {
        $logged_vivah_mitra = loggedVivahMitra();

        $fund_wallet = Wallet::where('owner_type', 'employee')
            ->where('owner_id', $logged_vivah_mitra)
            ->first();

        if (!$fund_wallet) {
            return response()->json([
                'html' => '<tr><td colspan="5" class="text-center">No records found</td></tr>',
                'total' => '0.00'
            ]);
        }

        // Date range parsing
        $startDate = Carbon::createFromFormat('d/m/Y', $request->start_date)
            ->startOfDay();
        $endDate = Carbon::createFromFormat('d/m/Y', $request->end_date)
            ->endOfDay();

        $fund_transactions = WalletTransaction::where('wallet_id', $fund_wallet->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('id', 'ASC')
            ->get();

        $total = 0;
        $html = '';

        if ($fund_transactions->count() > 0) {
            foreach ($fund_transactions as $key => $val) {

                $total += $val->amount;

                $html .= '
                    <tr>
                        <td>' . ($key + 1) . '</td>
                        <td>
                            ' . ($val->type == "credit"
                    ? '<span class="badge bg-success">Credit</span>'
                    : '<span class="badge bg-danger">Debit</span>') . '
                        </td>
                        <td>' . $val->remarks . '</td>
                        <td>₹ ' . number_format($val->amount, 2) . '</td>
                        <td>' . date("d-M-Y", strtotime($val->created_at)) . '</td>
                    </tr>
                ';
            }

            $html .= '
                <tr>
                    <td colspan="4" class="text-end"><b>Total : ₹ ' . number_format($total, 2) . '</b></td>
                </tr>
            ';
        } else {
            $html = '<tr><td colspan="5" class="text-center">No records found</td></tr>';
        }

        return response()->json([
            'html' => $html,
            'total' => number_format($total, 2)
        ]);
    }

    public function getNotice()
    {
        $notices = MasterNotice::where('status', 1)->get();
        $vivah_mitra_details = session('LoggedUser');
        return view('vivah_mitra.notice.notice-list', compact('notices', 'vivah_mitra_details'));
    }

    public function getNotification()
    {
        $loggedId = loggedVivahMitra();
        $notification_list = MemberMessage::where('user_id', $loggedId)->orderBy('id', 'DESC')->get();
        $vivah_mitra_details = session('LoggedUser');
        return view('vivah_mitra.notice.notification-list', compact('notification_list', 'vivah_mitra_details'));
    }

    public function getRulesAndGuidelines()
    {
        $terms = TermsAndCondition::where('status', 1)->get();
        return view('vivah_mitra.term_and_conditions.rules-and-guidelines', compact('terms'));
    }
    public function ProductList(Request $request)
    {
        // $branchId = current_branch();

        // if (!$branchId) {
        //     return redirect()->back()->with('error', 'Branch not assigned to your account!');
        // }

        $branchId = loggedVivahMitraBranch();
        $query = BranchProduct::where('branch_products.branch_id', $branchId)->select([
            'branch_products.*',
            'products.name as product_name',
            'products.thumbnail as product_photo',
            'pc.name as category_name',
            'b.name as branch_name',
        ])
            ->join('products', 'products.id', '=', 'branch_products.product_id')
            ->leftJoin('product_categories as pc', 'pc.id', '=', 'branch_products.category')
            ->leftJoin('branches as b', 'b.id', '=', 'branch_products.branch_id');
        // ->;

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
            'product_list' => $product_list,
            'request'      => $request,
            'page_title'   => 'Product List',
            // 'branch_id'    => $branchId,
        ];

        return view('vivah_mitra.member.product.product_list', $datas);
    }

    public function physicalCardMembers()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();


        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'physical_card_list' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'physical')->get(),
        ];
        return view('vivah_mitra.card.physical_card_members', $datas);
    }

    public function digitalCardMembers()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();


        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'physical_card_list' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'digital')->get(),
        ];
        return view('vivah_mitra.card.digital_card_members', $datas);
    }

    public function vivahMitraCard()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();


        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'physical_card_list' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'digital')->get(),
        ];
        return view('vivah_mitra.card.vivah_mitra_card', $datas);
    }

    public function digitalICard()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();


        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'designation_name' => MasterDesignation::where('id', $vivah_mitra_details->user_designation_id)->pluck('name')->first(),
            'physical_card_list' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'digital')->get(),
        ];
        return view('vivah_mitra.card.digital_i_card', $datas);
    }

    public function panchayatVivahMitraAavedan()
    {
        $remainingDays = 0;
        $loggedVivahMitra = vivahMitraDetails();
        if ($loggedVivahMitra->created_at) {

            $applyDate = Carbon::parse($loggedVivahMitra->created_at)->startOfDay();
            $expiryDate = $applyDate->copy()->addDays(30)->subDay();
            // subDay isliye kyunki 13 Feb se 12 March = 30 days

            $today = Carbon::now()->startOfDay();

            if ($today->lessThanOrEqualTo($expiryDate)) {
                $remainingDays = $today->diffInDays($expiryDate) + 1;
            } else {
                $remainingDays = 0; // Expired
            }
        }
        $datas = [
            'logged_vivah_mitra' => loggedVivahMitra(),
            'remaining_days' => $remainingDays,
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
            'prakhand_vivah_mitra_box_first10' =>  PrakhandVmBox::where('user_id', loggedVivahMitra())->orderBy('id', 'ASC')->limit(10)->get(),
            'prakhand_vivah_mitra_box_next_6' =>  PrakhandVmBox::where('user_id', loggedVivahMitra())->orderBy('id', 'ASC')->limit(6)->offset(10)->get(),
        ];
        // dd($datas['prakhand_vivah_mitra_box_first10']);
        return view('vivah_mitra.member.panchayat_vivah_mitra_aavedan', $datas);
    }

    public function panchayatVivahMitraTandC()
    {
        $datas = [
            'logged_vivah_mitra' => loggedVivahMitra(),
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
        ];
        return view('vivah_mitra.member.panchayat_vivah_mitra_t_and_c', $datas);
    }

    public function applyPanchayatVivahMitra()
    {
        $loggedVivahMitra = vivahMitraDetails();

        // 1️⃣ Check 30 days expiry
        if($loggedVivahMitra->verify_date){

            $applyDate = Carbon::parse($loggedVivahMitra->verify_date);
            $expiryDate = $applyDate->addDays(30);

            // Count total Vibhag Mitra (children)
            $parentCount = User::where('parent_id', $loggedVivahMitra->id)->count();

            // dd($loggedVivahMitra->id);
            // Check expiry
            if(Carbon::now()->greaterThan($expiryDate) && $parentCount < 10){

                $loggedVivahMitra->update([
                    'status' => 0   // Blocked
                ]);

                $userLogin = UserLogin::where('user_id', $loggedVivahMitra->id)->first();
                $userLogin->status = 0;
                $userLogin->save();
            }
        }

        $datas = [
            // 'cardKey' => $cardKey,
            'logged_vivah_mitra' => loggedVivahMitra(),
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
        ];
        return view('vivah_mitra.member.apply_panchayat_vivah_mitra_reg', $datas);
    }

    public function savePanchayatVivahMitra(Request $request)
    {
        $boxKey = session('selected_box_key');
        // dd($boxKey);

		$data = $request->validate([
            'name'           => 'required|string|max:255',
            'mobile'         => 'required|digits:10|unique:users,mobile',
            'aadhar_card'    => 'required|digits:12|numeric',
            'password'       => 'required|min:6',
            'address'        => 'required|string',
            'state'           => 'required',
            'city'           => 'required',
            'block'           => 'required',
            'panchayat'           => 'required',
            'ward_no'           => 'required',
            'account_number' => 'required|digits_between:9,18',
            'ifsc_code'      => 'required|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            'bank_name'      => 'required|string',
            'branch_name'    => 'required|string',
            'upi_details'    => 'required|string',
            'terms_and_conditions' => 'required|accepted',
            'profile_pic' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'signature' => 'required|image|mimes:png,jpg,jpeg|max:2048|dimensions:min_width=200,min_height=100'
        ],[
            'signature.dimensions' => 'Signature size must be at least 200x100 pixels.',
            'signature.image' => 'Signature must be a valid image file.',
            'terms_and_conditions.accepted' => 'You must accept the terms and conditions.'
        ]);

        DB::beginTransaction();

        try {

         // Lock box row to avoid race condition
            $box = PrakhandVmBox::where('box_key', $boxKey)
                ->where('is_filled', 0)
                ->lockForUpdate()
                ->firstOrFail();

            $logged_vivah_mitra  = loggedVivahMitra();
            $vivah_mitra_details = vivahMitraDetails();

			$vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);
            // dd($vivahMitraFundWallet);
            $deduct_amount = 1101;
            if ($vivahMitraFundWallet->balance < $deduct_amount) {
                return response()->json([
                    'status' => false,
                    'message' => 'पर्याप्त बैलेंस उपलब्ध नहीं है। कृपया पहले अपने वॉलेट में राशि जोड़ें।!'
                ]);

            }

            $state        = 5;
            $user_type_id = 6;

			$image_file_name = null;
			$signature_file_name = null;
            $uploadPath = public_path('uploads/staff');

            $profile_pic = null; // default value
			$signature = null; // default value

			if ($request->hasFile('profile_pic')) {

				$image_file_name = 'profile_pic_' . time() . '.' .
					$request->profile_pic->getClientOriginalExtension();

				$request->profile_pic->move($uploadPath, $image_file_name);

				$profile_pic = 'uploads/staff/' . $image_file_name;
			}

			if ($request->hasFile('signature')) {
				$signature_file_name = 'signature' . time() . '.' .
					$request->signature->getClientOriginalExtension();
				$request->signature->move($uploadPath, $signature_file_name);
				$signature = 'uploads/staff/' . $signature_file_name;
			}

            /* --------------------------
            CREATE USER 'box_key' => $boxKey,
            --------------------------- */
            $user = new User();
            $user->box_key              = $boxKey;
            $user->branch              = $vivah_mitra_details->branch;
            $user->state               = $state;
            $user->session             = $vivah_mitra_details->session;
            $user->first_name          = $data['name'];
            $user->mobile              = $data['mobile'];
            $user->email        = null;
            $user->aadhar_card         = $data['aadhar_card'];
            $user->address             = $data['address'];
            $user->state                = $data['state'];
            $user->city                 = $data['city'];
            $user->block                = $data['block'];
            $user->panchayat            = $data['panchayat'];
            $user->ward_no              = $data['ward_no'];
            // $user->card_key            = $data['card_key'];

            $user->user_type_id        = $user_type_id;
            $user->user_designation_id = 8;
            $user->parent_id           = $logged_vivah_mitra;
            $user->profile_pic           = $profile_pic;
			$user->signature     = $signature;
            $user->save();



            /* --------------------------
            GENERATE UNIQUE CODE
            --------------------------- */
            if ($user_type_id == 6) {

                do {
                    $random  = mt_rand(1000000, 9999999);
                    $newCode = "14" . $random;
                    $exists = User::where('employee_code', $newCode)->exists();
                } while ($exists);

                $user->employee_code = $newCode;
            } else {

                $userType   = UserType::find($user_type_id)->name;
                $shortType  = strtoupper(substr($userType, 0, 2));
                $prefix     = "V2F";
                $year       = date('y');
                $idPadded   = str_pad($user->id, 3, '0', STR_PAD_LEFT);
                $user->employee_code = "{$prefix}-{$shortType}-{$year}-{$idPadded}";
            }

            $user->save();

            /* --------------------------
            CREATE WALLETS
            --------------------------- */
            Wallet::firstOrCreate(
                [
                    'owner_type' => 'employee',
                    'owner_id'   => $user->id
                ],
                ['balance' => 0]
            );

            $vivahMitraEWallet = EWallet::firstOrCreate(
                [
                    'owner_type' => 'employee',
                    'owner_id'   => $user->id
                ],
                [
                    'balance' => 0
                ]
            );

            // $vivahMitraEWallet = getEWallet('employee', $logged_vivah_mitra);

            $credit_type = 'welcome_bonus';
            $walletId = $vivahMitraEWallet;
            $welcome_bonus = 101;


            $vivah_mitra_details = vivahMitraDetails();
                $vivahMitraDistrict = $vivah_mitra_details->city;
            // Credit incentive
            creditEWallet(
                $walletId,
                $welcome_bonus,
                $credit_type,
                "Welcome Bonus for Panchayat Vivah Mitra Registration (Mobile: {$user->mobile})",
                $vivahMitraDistrict
            );

            /* --------------------------
            LOGIN CREDENTIALS
            --------------------------- */
            $userLogin = new UserLogin();
            $userLogin->user_id      = $user->id;
            $userLogin->username     = $data['mobile'];
            $userLogin->password     = $data['password'];
            $userLogin->user_type_id = $user_type_id;
            $userLogin->status       = 1;
            $userLogin->save();

            /* --------------------------
            USER BANK DETAILS
            --------------------------- */
            $userDetail = new UserDetail();
            $userDetail->user_id        = $user->id;
            $userDetail->account_number = $data['account_number'];
            $userDetail->ifsc_code      = $data['ifsc_code'];
            $userDetail->bank_name      = $data['bank_name'];
            $userDetail->branch_name    = $data['branch_name'];
            $userDetail->upi_details    = $data['upi_details'];
            $userDetail->save();

             /* --------------------------
            CREATE CHILD BOXES
            --------------------------- */
            $boxes = [];
            for ($i = 1; $i <= 20; $i++) {
                $boxes[] = [
                    'user_id' => $user->id,
                    'box_key' => 'BOX_' . $user->id . '_' . $i,
                ];
            }
            PrakhandVmBox::insert($boxes);

            // Mark box as filled
            $box->update([
                'is_filled' => 1
            ]);

            session()->forget('selected_box_key');

			/** fund deduction */
            $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);
            $deduct_amount = 1101; // Example amount to deduct
            debitWallet(
                        $vivahMitraFundWallet,
                        $deduct_amount,
                        "Panchayat Vivah Mitra Registration | Name: {$data['name']} | Mobile: {$data['mobile']}"
                    );

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Panchayat Vivah Mitra Registration Applied Successfully',
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'message' => $e->getMessage(),
                // 'message' =>'Something Went Wrong'
            ], 500);
        }
    }

    public function selectBox(Request $request)
    {
        $request->validate([
            'box_key' => 'required|exists:prakhand_vm_boxes,box_key'
        ]);

        $box = PrakhandVmBox::where('box_key', $request->box_key)
            ->where('is_filled', 0)
            ->firstOrFail();

        session([
            'selected_box_key' => $box->box_key
        ]);

        return redirect()->route('member.panchayatVivahMitraTandC');
    }

    public function panchayatVivahMitraList()
    {
        $datas = [
            'logged_vivah_mitra' => loggedVivahMitra(),
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
            'vivah_mitra_list' =>  User::where('parent_id', loggedVivahMitra())->orderBy('id', 'DESC')->get(),
        ];
        return view('vivah_mitra.member.panchayat_vivah_mitra_list', $datas);
    }

    public function prakhandVivahMitraAavedan()
    {

        $loggedVivahMitra = vivahMitraDetails();
        $remainingDays = 0;

        if ($loggedVivahMitra->verify_date) {

            $applyDate = Carbon::parse($loggedVivahMitra->verify_date)->startOfDay();
            $expiryDate = $applyDate->copy()->addDays(30)->subDay();
            // subDay isliye kyunki 13 Feb se 12 March = 30 days

            $today = Carbon::now()->startOfDay();

            if ($today->lessThanOrEqualTo($expiryDate)) {
                $remainingDays = $today->diffInDays($expiryDate) + 1;
            } else {
                $remainingDays = 0; // Expired 2026-03-30
            }
        }


        $datas = [
            'logged_vivah_mitra' => loggedVivahMitra(),
            'remaining_days' => $remainingDays,
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
            'prakhand_vivah_mitra_box_first10' =>  PrakhandVmBox::where('user_id', loggedVivahMitra())->orderBy('id', 'ASC')->limit(10)->get(),
            'prakhand_vivah_mitra_box_next_6' =>  PrakhandVmBox::where('user_id', loggedVivahMitra())->orderBy('id', 'ASC')->limit(6)->offset(10)->get(),
        ];
        return view('vivah_mitra.member.prakhand_vivah_mitra_aavedan', $datas);
    }

    public function jilaSelectBox(Request $request)
    {
        $request->validate([
            'box_key' => 'required|exists:prakhand_vm_boxes,box_key'
        ]);

        $box = PrakhandVmBox::where('box_key', $request->box_key)
            ->where('is_filled', 0)
            ->firstOrFail();

        session([
            'selected_box_key' => $box->box_key
        ]);

        return redirect()->route('member.prakhandVivahMitraTandC');
    }

    public function jilaSBox(Request $request)
    {
        $request->validate([
            'box_key' => 'required|exists:prakhand_vm_boxes,box_key'
        ]);

        $box = PrakhandVmBox::where('box_key', $request->box_key)
            ->where('is_filled', 0)
            ->firstOrFail();

        session([
            'selected_box_key' => $box->box_key
        ]);

        return redirect()->route('member.jilaVivahMitraTandC');
    }

    public function prakhandVivahMitraTandC()
    {
        $datas = [
            'logged_vivah_mitra' => loggedVivahMitra(),
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
        ];
        return view('vivah_mitra.member.prakhand_vivah_mitra_t_and_c', $datas);
    }

    public function applyPrakhandVivahMitra()
    {
        $loggedVivahMitra = vivahMitraDetails();

        // 1️⃣ Check 30 days expiry
        if($loggedVivahMitra->verify_date){

            $applyDate = Carbon::parse($loggedVivahMitra->verify_date);
            $expiryDate = $applyDate->addDays(30);

            // Count total Vibhag Mitra (children)
            $parentCount = User::where('parent_id', $loggedVivahMitra->id)->count();

            // dd($loggedVivahMitra->id);
            // Check expiry
            if(Carbon::now()->greaterThan($expiryDate) && $parentCount < 10){

                $loggedVivahMitra->update([
                    'status' => 0   // Blocked
                ]);

                $userLogin = UserLogin::where('user_id', $loggedVivahMitra->id)->first();
                $userLogin->status = 0;
                $userLogin->save();
            }
        }

        $datas = [
            'logged_vivah_mitra' => loggedVivahMitra(),
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
        ];
        return view('vivah_mitra.member.apply_prakhand_vivah_mitra_reg', $datas);
    }

    /** सेव प्रखण्ड विवाह मित्र  */

    public function savePrakhandVivahMitra(Request $request)
    {
        $boxKey = session('selected_box_key');

        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'mobile'         => 'required|digits:10|unique:users,mobile',
            'aadhar_card'    => 'required|digits:12|numeric',
            'password'       => 'required|min:6',
            'address'        => 'required|string',
            'state'           => 'required',
            'city'           => 'required',
            'block'           => 'required',
            'panchayat'           => 'required',
            'ward_no'           => 'required',
            'account_number' => 'required|digits_between:9,18',
            'ifsc_code'      => 'required|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            'bank_name'      => 'required|string',
            'branch_name'    => 'required|string',
            'upi_details'    => 'required|string',
            'terms_and_conditions' => 'required|accepted',
            'profile_pic' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'signature' => 'required|image|mimes:png,jpg,jpeg|max:2048|dimensions:min_width=200,min_height=100'
        ],[
            'signature.dimensions' => 'Signature size must be at least 200x100 pixels.',
            'signature.image' => 'Signature must be a valid image file.',
            'terms_and_conditions.accepted' => 'You must accept the terms and conditions.'
        ]);

        DB::beginTransaction();

        try {



            // 🔒 Lock box row
            $box = PrakhandVmBox::where('box_key', $boxKey)
                ->where('is_filled', 0)
                ->lockForUpdate()
                ->firstOrFail();

            $logged_vivah_mitra  = loggedVivahMitra();
            $vivah_mitra_details = vivahMitraDetails();
            $state        = 5;
            $user_type_id = 6;

            $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);
            $deduct_amount = 1101;
            if ($vivahMitraFundWallet->balance < $deduct_amount) {
                return response()->json([
                    'status' => false,
                    'message' => 'पर्याप्त बैलेंस उपलब्ध नहीं है। कृपया पहले अपने वॉलेट में राशि जोड़ें।!'
                ]);

            }

            /* --------------------------
            CREATE USER (MAIN STEP)
            --------------------------- */

            $image_file_name = null;
            $signature_file_name = null;
            $uploadPath = public_path('uploads/staff');

            $profile_pic = null; // default value
            $signature = null; // default value

            if ($request->hasFile('profile_pic')) {

                $image_file_name = 'profile_pic_' . time() . '.' .
                    $request->profile_pic->getClientOriginalExtension();

                $request->profile_pic->move($uploadPath, $image_file_name);

                $profile_pic = 'uploads/staff/' . $image_file_name;
            }

            if ($request->hasFile('signature')) {
                $signature_file_name = 'signature' . time() . '.' .
                    $request->signature->getClientOriginalExtension();
                $request->signature->move($uploadPath, $signature_file_name);
                $signature = 'uploads/staff/' . $signature_file_name;
            }

            $user = new User();
            $user->box_key       = $boxKey;
            $user->branch        = $vivah_mitra_details->branch;
            $user->state         = 5;
            $user->session       = $vivah_mitra_details->session;
            $user->first_name    = $data['name'];
            $user->mobile        = $data['mobile'];
            $user->email        = null;
            $user->aadhar_card         = $data['aadhar_card'];
            $user->address       = $data['address'];
            $user->state                = $data['state'];
            $user->city                 = $data['city'];
            $user->block                = $data['block'];
            $user->panchayat            = $data['panchayat'];
            $user->ward_no              = $data['ward_no'];
            $user->user_type_id  = 6;
            $user->user_designation_id = 9;
            $user->parent_id     = $logged_vivah_mitra;
            $user->profile_pic     = $profile_pic;
            $user->signature     = $signature;

             /* --------------------------
            GENERATE UNIQUE CODE
            --------------------------- */
            if ($user_type_id == 6) {

                do {
                    $random  = mt_rand(1000000, 9999999);
                    $newCode = "14" . $random;
                    $exists = User::where('employee_code', $newCode)->exists();
                } while ($exists);

                $user->employee_code = $newCode;
            } else {

                $userType   = UserType::find($user_type_id)->name;
                $shortType  = strtoupper(substr($userType, 0, 2));
                $prefix     = "V2F";
                $year       = date('y');
                $idPadded   = str_pad($user->id, 3, '0', STR_PAD_LEFT);
                $user->employee_code = "{$prefix}-{$shortType}-{$year}-{$idPadded}";
            }

            if (!$user->save()) {
                throw new \Exception('User not saved');
            }



            /* --------------------------
            CREATE WALLETS
            --------------------------- */
            Wallet::create([
                'owner_type' => 'employee',
                'owner_id'   => $user->id,
                'balance'    => 0
            ]);

            $ewallet = EWallet::create([
                        'owner_type' => 'employee',
                        'owner_id'   => $user->id,
                        'balance'    => 0
                    ]);

            $walletId = $ewallet->id;

            /* --------------------------
            CREATE CHILD BOXES
            --------------------------- */
            $boxes = [];
            for ($i = 1; $i <= 20; $i++) {
                $boxes[] = [
                    'user_id' => $user->id,
                    'box_key' => 'BOX_' . $user->id . '_' . $i,
                ];
            }
            PrakhandVmBox::insert($boxes);

            /* --------------------------
            USER LOGIN (HASH PASSWORD)
            --------------------------- */
            UserLogin::create([
                'user_id'      => $user->id,
                'username'     => $data['mobile'],
                'password'     => $data['password'], // ✅ SECURE
                'user_type_id' => 6,
                'status'       => 1
            ]);

            /* --------------------------
            USER BANK DETAILS
            --------------------------- */
            UserDetail::create([
                'user_id'        => $user->id,
                'account_number' => $data['account_number'],
                'ifsc_code'      => $data['ifsc_code'],
                'bank_name'      => $data['bank_name'],
                'branch_name'    => $data['branch_name'],
                'upi_details'    => $data['upi_details'],
            ]);




			/* -------------------------
				MESSAGE SAVE HERE
			----------------------------*/

			$message = implode("\n", [
                    "प्रिय {$data['name']},",
                    "",
                    "आपका प्रखंड विवाह मित्र पद हेतु आवेदन सफलतापूर्वक प्राप्त हो गया है।",
                    "",
                    "🔹 प्रखंड विवाह मित्र कोड : {$newCode}",
                    "",
                    "📲 ऐप डाउनलोड करें :",
                    "https://play.google.com/store/apps/details?id=com.growciti.vivahmitra",
                    "",
                    "🔑 लॉग-इन विवरण:",
                    "आईडी : {$data['mobile']}",
                    "पासवर्ड : {$data['password']}",
                    "",
                    "⏳ ऑनबोर्डिंग 24–48 घंटे में पूर्ण कर दी जाएगी।",
                    "कृपया धैर्यपूर्वक प्रतीक्षा करें।"
                ]);

            $memberMessage = new MemberMessage();
            // $memberMessage->member_id = $member->id;
            $memberMessage->messages = $message;
            // $memberMessage->membership_number = $newMembershipCode;
            $memberMessage->user_id = $logged_vivah_mitra;
            $memberMessage->save();

            $bonusIncome = 101;
            $prakhandMitraEWallet = getEWallet('employee', $user->id);
            $credit_type = 'welcome_bonus';

            $vivah_mitra_details = vivahMitraDetails();
            $vivahMitraDistrict = $vivah_mitra_details->city;
            // Credit incentive
            creditEWallet(
                $prakhandMitraEWallet,
                $bonusIncome,
                $credit_type,
                "{$bonusIncome}% Rs 101/- Amount received as Bonus for Prakhand Vivah Mitra Registration of {$data['name']} (ID: {$user->employee_code})",
                $vivahMitraDistrict
            );

            /** fund deduction */
            $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);
            $deduct_amount = 1101; // Example amount to deduct
            debitWallet(
                        $vivahMitraFundWallet,
                        $deduct_amount,
                        "Prakhand Vivah Mitra Registration | Name: {$data['name']} | Mobile: {$data['mobile']}"
                    );

            DB::commit();

            /* --------------------------
            MARK BOX AS FILLED
            --------------------------- */
            $box->update(['is_filled' => 1]);

            session()->forget('selected_box_key');

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'प्रखण्ड विवाह मित्र का सफलतापूर्वक पंजीकरण हो गया है |'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /** prakhandVivahMitraList */

    public function prakhandVivahMitraList()
    {
        $datas = [
            'logged_vivah_mitra' => loggedVivahMitra(),
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
            'prakhand_mitra_list' =>  User::where('parent_id', loggedVivahMitra())->orderBy('id', 'DESC')->get(),
        ];
        return view('vivah_mitra.member.prakhand_vivah_mitra_list', $datas);
    }

    /** vivah mitra aavedan */

    public function vivahMitraAavedan()
    {
        $remainingDays = 0;
        $loggedVivahMitra = vivahMitraDetails();
        if ($loggedVivahMitra->verify_date) {

            $applyDate = Carbon::parse($loggedVivahMitra->verify_date)->startOfDay();
            $expiryDate = $applyDate->copy()->addDays(30)->subDay();
            // subDay isliye kyunki 13 Feb se 12 March = 30 days

            $today = Carbon::now()->startOfDay();

            if ($today->lessThanOrEqualTo($expiryDate)) {
                $remainingDays = $today->diffInDays($expiryDate) + 1;
            } else {
                $remainingDays = 0; // Expired
            }
        }
        $datas = [
            'remaining_days' => $remainingDays,
            'logged_vivah_mitra' => loggedVivahMitra(),
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
            'prakhand_vivah_mitra_box_first10' =>  PrakhandVmBox::where('user_id', loggedVivahMitra())->orderBy('id', 'ASC')->limit(10)->get(),
            'prakhand_vivah_mitra_box_next_6' =>  PrakhandVmBox::where('user_id', loggedVivahMitra())->orderBy('id', 'ASC')->limit(6)->offset(10)->get(),
        ];
        return view('vivah_mitra.member.vivah_mitra_aavedan', $datas);
    }

    public function vivahmitraSelectBox(Request $request)
    {
        $request->validate([
            'box_key' => 'required|exists:prakhand_vm_boxes,box_key'
        ]);

        $box = PrakhandVmBox::where('box_key', $request->box_key)
            ->where('is_filled', 0)
            ->firstOrFail();

        session([
            'selected_box_key' => $box->box_key
        ]);

        return redirect()->route('member.vivahMitraTandC');
    }

    public function vivahMitraTandC()
    {
        $datas = [
            'logged_vivah_mitra' => loggedVivahMitra(),
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
        ];
        return view('vivah_mitra.member.vivah_mitra_t_and_c', $datas);
    }

    public function applyVivahMitra()
    {

        $loggedVivahMitra = vivahMitraDetails();

        // 1️⃣ Check 30 days expiry
        if($loggedVivahMitra->verify_date){

            $applyDate = Carbon::parse($loggedVivahMitra->verify_date);
            $expiryDate = $applyDate->addDays(30);

            // Count total Vibhag Mitra (children)
            $parentCount = User::where('parent_id', $loggedVivahMitra->id)->count();

            // dd($loggedVivahMitra->id);
            // Check expiry
            if(Carbon::now()->greaterThan($expiryDate) && $parentCount < 10){

                $loggedVivahMitra->update([
                    'status' => 0   // Blocked
                ]);

                $userLogin = UserLogin::where('user_id', $loggedVivahMitra->id)->first();
                $userLogin->status = 0;
                $userLogin->save();
            }
        }

        $datas = [
            'logged_vivah_mitra' => loggedVivahMitra(),
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
        ];
        return view('vivah_mitra.member.apply_vivah_mitra_reg', $datas);
    }

    /** सेव प्रखण्ड विवाह मित्र  */

    public function saveVivahMitra(Request $request)
    {
        $boxKey = session('selected_box_key');

        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'mobile'         => 'required|digits:10|unique:users,mobile',
            'aadhar_card'    => 'required|digits:12|numeric',
            'password'       => 'required|min:6',
            'address'        => 'required|string',
            'state'           => 'required',
            'city'           => 'required',
            'block'           => 'required',
            'panchayat'           => 'required',
            'ward_no'           => 'required',
            'account_number' => 'required|digits_between:9,18',
            'ifsc_code'      => 'required|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            'bank_name'      => 'required|string',
            'branch_name'    => 'required|string',
            'upi_details'    => 'required|string',
            'terms_and_conditions' => 'required|accepted',
            'profile_pic' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'signature' => 'required|image|mimes:png,jpg,jpeg|max:2048|dimensions:min_width=200,min_height=100'
        ],[
            'signature.dimensions' => 'Signature size must be at least 200x100 pixels.',
            'signature.image' => 'Signature must be a valid image file.',
            'terms_and_conditions.accepted' => 'You must accept the terms and conditions.'
        ]);

        DB::beginTransaction();

        try {

            // 🔒 Lock box row
            $box = PrakhandVmBox::where('box_key', $boxKey)
                ->where('is_filled', 0)
                ->lockForUpdate()
                ->firstOrFail();

            $logged_vivah_mitra  = loggedVivahMitra();
            $vivah_mitra_details = vivahMitraDetails();
             $state        = 5;
            $user_type_id = 6;

            $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);
            $deduct_amount = 1101;
            if ($vivahMitraFundWallet->balance < $deduct_amount) {
                return response()->json([
                    'status' => false,
                    'message' => 'पर्याप्त बैलेंस उपलब्ध नहीं है। कृपया पहले अपने वॉलेट में राशि जोड़ें।!'
                ]);

            }

            /* --------------------------
            CREATE USER (MAIN STEP)
            --------------------------- */
			$image_file_name = null;
			$signature_file_name = null;
            $uploadPath = public_path('uploads/staff');

            $profile_pic = null; // default value
			$signature = null; // default value

			if ($request->hasFile('profile_pic')) {
				$image_file_name = 'profile_pic_' . time() . '.' .$request->profile_pic->getClientOriginalExtension();
				$request->profile_pic->move($uploadPath, $image_file_name);
				$profile_pic = 'uploads/staff/' . $image_file_name;
			}

			if ($request->hasFile('signature')) {
                $signature_file_name = 'signature' . time() . '.' .
                    $request->signature->getClientOriginalExtension();
                $request->signature->move($uploadPath, $signature_file_name);
                $signature = 'uploads/staff/' . $signature_file_name;
            }

            $user = new User();
            $user->box_key       = $boxKey;
            $user->branch        = $vivah_mitra_details->branch;
            $user->state         = 5;
            $user->session       = $vivah_mitra_details->session;
            $user->first_name    = $data['name'];
            $user->mobile        = $data['mobile'];
            $user->email        = null;
            $user->aadhar_card         = $data['aadhar_card'];
            $user->address       = $data['address'];
            $user->state                = $data['state'];
            $user->city                 = $data['city'];
            $user->block                = $data['block'];
            $user->panchayat            = $data['panchayat'];
            $user->ward_no              = $data['ward_no'];
            $user->user_type_id  = 6;
            $user->user_designation_id = 7;
            $user->parent_id     = $logged_vivah_mitra;
            $user->profile_pic     = $profile_pic;
			$user->signature     = $signature;

             /* --------------------------
            GENERATE UNIQUE CODE
            --------------------------- */
            if ($user_type_id == 6) {

                do {
                    $random  = mt_rand(1000000, 9999999);
                    $newCode = "14" . $random;
                    $exists = User::where('employee_code', $newCode)->exists();
                } while ($exists);

                $user->employee_code = $newCode;
            } else {

                $userType   = UserType::find($user_type_id)->name;
                $shortType  = strtoupper(substr($userType, 0, 2));
                $prefix     = "V2F";
                $year       = date('y');
                $idPadded   = str_pad($user->id, 3, '0', STR_PAD_LEFT);
                $user->employee_code = "{$prefix}-{$shortType}-{$year}-{$idPadded}";
            }

            if (!$user->save()) {
                throw new \Exception('User not saved');
            }



            /* --------------------------
            CREATE WALLETS
            --------------------------- */
            Wallet::create([
                'owner_type' => 'employee',
                'owner_id'   => $user->id,
                'balance'    => 0
            ]);



            $vivahMitraEWallet = EWallet::firstOrCreate(
                [
                    'owner_type' => 'employee',
                    'owner_id'   => $user->id
                ],
                [
                    'balance' => 0
                ]
            );

            $credit_type = 'welcome_bonus';
            // $walletId = $vivahMitraEWallet->id;
            $welcome_bonus = 101;
                $vivah_mitra_details = vivahMitraDetails();
                $vivahMitraDistrict = $vivah_mitra_details->city;
            // Credit incentive
            creditEWallet(
                $vivahMitraEWallet,
                $welcome_bonus,
                $credit_type,
                "Welcome Bonus for Vivah Mitra Registration (Mobile: {$user->mobile})",
                $vivahMitraDistrict
            );

            /* --------------------------
            CREATE CHILD BOXES
            --------------------------- */
            // $boxes = [];
            // for ($i = 1; $i <= 20; $i++) {
            //     $boxes[] = [
            //         'user_id' => $user->id,
            //         'box_key' => 'BOX_' . $user->id . '_' . $i,
            //     ];
            // }
            // PrakhandVmBox::insert($boxes);

            /* --------------------------
            USER LOGIN (HASH PASSWORD)
            --------------------------- */
            UserLogin::create([
                'user_id'      => $user->id,
                'username'     => $data['mobile'],
                'password'     => $data['password'], // ✅ SECURE
                'user_type_id' => 6,
                'status'       => 1
            ]);

            /* --------------------------
            USER BANK DETAILS
            --------------------------- */
            UserDetail::create([
                'user_id'        => $user->id,
                'account_number' => $data['account_number'],
                'ifsc_code'      => $data['ifsc_code'],
                'bank_name'      => $data['bank_name'],
                'branch_name'    => $data['branch_name'],
                'upi_details'    => $data['upi_details'],
            ]);

            /* --------------------------
            MARK BOX AS FILLED
            --------------------------- */
            $box->update(['is_filled' => 1]);

            session()->forget('selected_box_key');

            /** fund deduction */
            $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);
            $deduct_amount = 1101; // Example amount to deduct
            debitWallet(
                        $vivahMitraFundWallet,
                        $deduct_amount,
                        "Vivah Mitra Registration | Name: {$data['name']} | Mobile: {$data['mobile']}"
                    );

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'विवाह मित्र का सफलतापूर्वक पंजीकरण हो गया है |'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function vivahMitraList()
    {
        $datas = [
            'logged_vivah_mitra' => loggedVivahMitra(),
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
            'vivah_mitra_list' =>  User::where('parent_id', loggedVivahMitra())->orderBy('id', 'DESC')->get(),
        ];

        return view('vivah_mitra.member.vivah_mitra_list', $datas);
    }

    public function prakhandVivahMitraSeIncome()
    {
            // dd(loggedVivahMitra());
        $datas = [
            'logged_vivah_mitra' => loggedVivahMitra(),
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
            'prakhand_vivah_mitra_box_first10' =>  PrakhandVmBox::where('user_id', loggedVivahMitra())->orderBy('id', 'ASC')->limit(10)->get(),
            'prakhand_vivah_mitra_box_next_6' =>  PrakhandVmBox::where('user_id', loggedVivahMitra())->orderBy('id', 'ASC')->limit(6)->offset(10)->get(),
        ];
        return view('vivah_mitra.member.prakhand_vivah_mitra_se_income', $datas);
    }

    public function checkMembershipNumber(Request $request)
    {
        $request->validate([
            'membership_number' => 'required'
        ]);

        $user = Member::select('members.*',
                        'states.name as state_name',
                        'districts.name as district_name'
                    )
                    ->leftJoin('states', 'states.id', '=', 'members.state')
                    ->leftJoin('districts', 'districts.id', '=', 'members.district')
                    ->where('members.membership_number', $request->membership_number)
                    ->where('members.card_type', 'physical')
                    ->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Membership not found'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'name'   => trim($user->name),
                'father_husband' => $user->father_husband,
                'mobile'   => $user->mobile,
                'address'   => $user->address,
                'state'     => $user->state_name,
                'district'  => $user->district_name,
                'membership_number'   => $user->membership_number,
                'pincode' => $user->pincode,
                'post' => $user->post,
                'district' => $user->district,
            ]
        ]);
    }

    public function fundRecharge(){
        $vivah_mitra_details = session('LoggedUser');
        return view('vivah_mitra.fund-recharge', compact('vivah_mitra_details'));
    }

    public function receivedIncome()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        $vivahMitraEWallet = getEWallet('employee', $logged_vivah_mitra);
        $e_wallet = EWallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $myIncome = EWalletTransaction::where('type', 'credit')
            ->where('wallet_id', $e_wallet->id)
            ->get();

        $receivedIncome = Transaction::where('type', 'credit')->where('user_id', $logged_vivah_mitra)->where('type', 'credit')->get();

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'myIncomeList' => $myIncome,
            'receivedIncomeList' => $receivedIncome,
            'vivah_mitra_ewallet' => $vivahMitraEWallet->balance,
        ];
        return view('vivah_mitra.income.received_income', $datas);
    }

    public function physicalCardReceived()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $user = User::findOrFail($logged_vivah_mitra);
        // dd( $user);
        $userStock = CardStock::where('user_id', $logged_vivah_mitra)->first();

        // $totalCards = CardStock::sum('quantity');

        $transactions = CardTransaction::where(function ($q) use ($logged_vivah_mitra) {
            $q->where('from_user_id', $logged_vivah_mitra)
                ->orWhere('to_user_id', $logged_vivah_mitra);
        })
            ->latest()
            ->paginate(10);

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'transactions' => $transactions,
            'userStock' => $userStock,
        ];
        return view('vivah_mitra.physical_card_received', $datas);
    }

    public function physicalCardTransferHistory()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $user = User::findOrFail($logged_vivah_mitra);
        // dd( $user);
        $userStock = CardStock::where('user_id', $logged_vivah_mitra)->first();

        // $totalCards = CardStock::sum('quantity');

        $transactions =  CardTransaction::where('from_user_id', $logged_vivah_mitra)
                                        ->where('type', 'transfer')
                                        ->latest()
                                        ->get();
        $employee_districts = \DB::table('user_districts as ud')
                                ->join('districts as d', 'd.id', '=', 'ud.district_id')
                                ->where('ud.user_id', $logged_vivah_mitra)
                                ->select('ud.*', 'd.name as district_name', 'd.id as district_id')
                                ->get();

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'transactions' => $transactions,
            'userStock' => $userStock,
            'employee_districts' => $employee_districts,
        ];
        return view('vivah_mitra.physical_card_transfer_history', $datas);
    }

    public function physicalCardTransfer()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $user = User::findOrFail($logged_vivah_mitra);
        // dd( $user);

        $user_list = User::where('parent_id', $logged_vivah_mitra)->get();
         $userStock = CardStock::where('user_id', $logged_vivah_mitra)->first();

		$employee_districts = \DB::table('user_districts as ud')
                                ->join('districts as d', 'd.id', '=', 'ud.district_id')
                                ->where('ud.user_id', $logged_vivah_mitra)
                                ->select('ud.*', 'd.name as district_name', 'd.id as district_id')
                                ->get();

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'user_list' => $user_list,
            'userStock' => $userStock,
            'employee_districts' => $employee_districts,
        ];
        return view('vivah_mitra.physical_card_transfer', $datas);
    }

    public function transferCard1(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'to_user_id' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1'
        ]);

         $logged_vivah_mitra = loggedVivahMitra();

        $fromUser = $logged_vivah_mitra;

        DB::transaction(function () use ($request, $fromUser) {

            $fromStock = CardStock::where('user_id', $fromUser)->first();

            if (!$fromStock || $fromStock->quantity < $request->quantity) {
                // throw new \Exception('Insufficient cards');
                return response()->json([
                    'status' => false,
                    'message' => 'Insufficient cards'
                ]);
            }

            // minus
            $fromStock->decrement('quantity', $request->quantity);

            // plus
            $toStock = CardStock::firstOrCreate(
                ['user_id' => $request->to_user_id],
                ['quantity' => 0]
            );

            $toStock->increment('quantity', $request->quantity);

            CardTransaction::create([
                'from_user_id' => $fromUser,
                'to_user_id' => $request->to_user_id,
                'quantity' => $request->quantity,
                'type' => 'transfer',
                'note' => 'Card transfer'
            ]);
        });


        return response()->json([
            'status' => true,
            'message' => 'Cards transferred successfully'
        ]);
    }

    public function transferCard(Request $request)
    {
        $request->validate([
            'to_user_id' => 'required|exists:users,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        $logged_vivah_mitra = loggedVivahMitra();
        $fromUser = $logged_vivah_mitra;

        try {

            DB::transaction(function () use ($request, $fromUser) {

                $fromStock = CardStock::where('user_id', $fromUser)->lockForUpdate()->first();

                if (!$fromStock || $fromStock->quantity < $request->quantity) {
                    throw new \Exception('Insufficient cards');
                }

                // minus
                $fromStock->decrement('quantity', $request->quantity);

                // plus
                $toStock = CardStock::firstOrCreate(
                    ['user_id' => $request->to_user_id],
                    ['quantity' => 0]
                );

                $toStock->increment('quantity', $request->quantity);

                CardTransaction::create([
                    'from_user_id' => $fromUser,
                    'to_user_id'   => $request->to_user_id,
                    'quantity'     => $request->quantity,
                    'type'         => 'transfer',
                    'note'         => 'Card transfer'
                ]);
            });

            return response()->json([
                'status'  => true,
                'message' => 'Cards transferred successfully'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /** fund Transfer */

    public function getVivahMitraByDistrict11($district_id)
    {
        $vivah_mitra = User::where('city', $district_id)->get(['id', 'first_name', 'last_name']);
        return response()->json($vivah_mitra);
    }

    public function getVivahMitraByDistrict($district_id)
    {
        $vivah_mitra = User::where('users.user_type_id', 6)->select(
                'users.id',
                'users.first_name',
                'users.last_name',
                'user_types.name as user_type_name',
                'master_designations.name as designation_name'
            )
            ->leftJoin('user_types', 'user_types.id', '=', 'users.user_type_id')
            ->leftJoin('master_designations', 'master_designations.id', '=', 'users.user_designation_id')
            ->where('users.city', $district_id)
            ->get();

        return response()->json($vivah_mitra);
    }

    public function fundTransfer()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $employee_districts = \DB::table('user_districts as ud')
                                ->join('districts as d', 'd.id', '=', 'ud.district_id')
                                ->where('ud.user_id', $logged_vivah_mitra)
                                ->select('ud.*', 'd.name as district_name', 'd.id as district_id')
                                ->get();

        $user = User::findOrFail($logged_vivah_mitra);
        $user_list = User::where('parent_id', $logged_vivah_mitra)->get();
        $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'user_list' => $user_list,
            'vivahMitraFundWallet' => $vivahMitraFundWallet->balance,
            'employee_districts' => $employee_districts,
        ];
        return view('vivah_mitra.fund_transfer', $datas);
    }

    public function storeFundTransfer(Request $request){
        // dd($request->all());
        $logged_vivah_mitra = loggedVivahMitra();

        $request->validate([
            // 'user_type' => 'required|exists:user_types,id',
            // 'user_designation' => 'required|exists:master_designations,id',
            'user_id' => 'required|exists:users,id',
            'amount'    => 'required|numeric|min:1',
            // 'type'    => 'required|in:credit,debit',
            // 'added_date'    => 'required|date',
        ]);

        $amount = $request->amount;

        // Company wallet
        // $companyId = session('LoggedUser')->user_id;
        $branchManagerWallet = getWallet('employee', $logged_vivah_mitra);

        // employee wallet
        $employeeWallet = getWallet('employee', $request->user_id);

        // Check balance
        if ($branchManagerWallet->balance < $amount) {
            return response()->json([
                'status'  => false,
                'message' => 'Insufficient funds available!'
            ]);
        }
        $employee_details = User::where('id', $request->user_id)->first();

        $received_fromName = User::where('id', $logged_vivah_mitra)->first();
        // Debit company
        $debit_type = 'transfer_to_vivah_mitra';
        $designationName = MasterDesignation::where('id', $employee_details->user_designation_id)->pluck('name')->first();

        $designationName2 = MasterDesignation::where('id', $received_fromName->user_designation_id)->pluck('name')->first();

        debitWallet($branchManagerWallet, $amount, "Transfer to : {$employee_details->first_name} ({$designationName})", $debit_type);

        // Credit branch
        creditWallet($employeeWallet, $amount, "Received from : {$received_fromName->first_name} ({$designationName2})");

        return response()->json([
            'status'  => true,
            'message' => 'Fund transferred successfully!'
        ]);
    }

    /** fund transfer hisory */

    public function fundTransferHistory(){
        $logged_vivah_mitra = loggedVivahMitra();

        $branchManagerWallet = getWallet('employee', $logged_vivah_mitra);
        // dd($branchManagerWallet);
        $transfer_history = WalletTransaction::where('type', 'debit')->where('debit_type', 'transfer_to_vivah_mitra')->where('wallet_id', $branchManagerWallet->id)->get();
        $datas = [
            'logged_vivah_mitra' => loggedVivahMitra(),
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
            'vivah_mitra_list' =>  User::where('parent_id', loggedVivahMitra())->orderBy('id', 'DESC')->get(),
            'transfer_history' =>  $transfer_history,
        ];

        return view('vivah_mitra.fund_transfer_history', $datas);
    }



    // physicalCardTransfer

    public function incomeSources()
    {
        $datas = [
            'logged_vivah_mitra' => loggedVivahMitra(),
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
            'vivah_mitra_list' =>  User::where('parent_id', loggedVivahMitra())->orderBy('id', 'DESC')->get(),
        ];

        return view('vivah_mitra.income_sources.index', $datas);
    }

    public function allApplicationApply()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        $vivahMitraEWallet = getEWallet('employee', $logged_vivah_mitra);
        $e_wallet = EWallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $todayIncome = EWalletTransaction::where('type', 'credit')
            ->where('wallet_id', $e_wallet->id)
            ->whereDate('created_at', now())
            ->sum('amount');

        $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $fund_transactions = WalletTransaction::where('wallet_id', $fund_wallet->id)->orderBy('id', 'ASC')->get();

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();

        $totalReceivedInBank = Transaction::where('type', 'credit')->where('user_id', $logged_vivah_mitra)->where('type', 'credit')->sum('amount');
        $total_available_physical_card_received = CardStock::where('user_id', $logged_vivah_mitra)->value('quantity');

        $Case_count = '0';
        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'todayIncome' => $todayIncome,
            'vivah_mitra_ewallet' => $vivahMitraEWallet->balance,
            'vivah_mitra_fundWallet' => $vivahMitraFundWallet->balance,
            'vivah_mitra_categories' => VivahmitraCategory::whereNull('parent_id')->where('status', 1)->with('children')->orderBy('id', 'ASC')->get(),
            'vivah_mitra_app_sliders' => VivahAppSlider::where('status', 1)->orderBy('id', 'DESC')->get(),
            'total_physical_card' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'physical')->count(),
            'total_digital_card' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'digital')->count(),
            'totalReceivedInBank' => $totalReceivedInBank,
            'total_available_physical_card_received' => $total_available_physical_card_received,
        ];

        return view('vivah_mitra.application.index', $datas);
    }

    public function workDetails()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        // dd($logged_vivah_mitra);
        $vivah_mitra_details = vivahMitraDetails();
        $vivahMitraEWallet = getEWallet('employee', $logged_vivah_mitra);
        $e_wallet = EWallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $todayIncome = EWalletTransaction::where('type', 'credit')
            ->where('wallet_id', $e_wallet->id)
            ->whereDate('created_at', now())
            ->sum('amount');

        $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $fund_transactions = WalletTransaction::where('wallet_id', $fund_wallet->id)->orderBy('id', 'ASC')->get();

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();

        $totalReceivedInBank = Transaction::where('type', 'credit')->where('user_id', $logged_vivah_mitra)->where('type', 'credit')->sum('amount');
        $total_available_physical_card_received = CardStock::where('user_id', $logged_vivah_mitra)->value('quantity');

        $Case_count = '0';
        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'todayIncome' => $todayIncome,
            'vivah_mitra_ewallet' => $vivahMitraEWallet->balance,
            'vivah_mitra_fundWallet' => $vivahMitraFundWallet->balance,
            'vivah_mitra_categories' => VivahmitraCategory::whereNull('parent_id')->where('status', 1)->with('children')->orderBy('id', 'ASC')->get(),
            'vivah_mitra_app_sliders' => VivahAppSlider::where('status', 1)->orderBy('id', 'DESC')->get(),
            'total_physical_card' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'physical')->count(),
            'total_digital_card' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'digital')->count(),
            'totalReceivedInBank' => $totalReceivedInBank,
            'total_available_physical_card_received' => $total_available_physical_card_received,
        ];

        return view('vivah_mitra.work_details.index', $datas);
    }


    public function allTypesOfTransfer()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        // dd($logged_vivah_mitra);
        $vivah_mitra_details = vivahMitraDetails();
        $vivahMitraEWallet = getEWallet('employee', $logged_vivah_mitra);
        $e_wallet = EWallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $todayIncome = EWalletTransaction::where('type', 'credit')
            ->where('wallet_id', $e_wallet->id)
            ->whereDate('created_at', now())
            ->sum('amount');

        $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $fund_transactions = WalletTransaction::where('wallet_id', $fund_wallet->id)->orderBy('id', 'ASC')->get();

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();

        $totalReceivedInBank = Transaction::where('type', 'credit')->where('user_id', $logged_vivah_mitra)->where('type', 'credit')->sum('amount');
        $total_available_physical_card_received = CardStock::where('user_id', $logged_vivah_mitra)->value('quantity');

        $Case_count = '0';
        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'todayIncome' => $todayIncome,
            'vivah_mitra_ewallet' => $vivahMitraEWallet->balance,
            'vivah_mitra_fundWallet' => $vivahMitraFundWallet->balance,
            'vivah_mitra_categories' => VivahmitraCategory::whereNull('parent_id')->where('status', 1)->with('children')->orderBy('id', 'ASC')->get(),
            'vivah_mitra_app_sliders' => VivahAppSlider::where('status', 1)->orderBy('id', 'DESC')->get(),
            'total_physical_card' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'physical')->count(),
            'total_digital_card' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'digital')->count(),
            'totalReceivedInBank' => $totalReceivedInBank,
            'total_available_physical_card_received' => $total_available_physical_card_received,
        ];

        return view('vivah_mitra.types_of_transfer.index', $datas);
    }

    public function otherDetails()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        // dd($logged_vivah_mitra);
        $vivah_mitra_details = vivahMitraDetails();
        $vivahMitraEWallet = getEWallet('employee', $logged_vivah_mitra);
        $e_wallet = EWallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $todayIncome = EWalletTransaction::where('type', 'credit')
            ->where('wallet_id', $e_wallet->id)
            ->whereDate('created_at', now())
            ->sum('amount');

        $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $fund_transactions = WalletTransaction::where('wallet_id', $fund_wallet->id)->orderBy('id', 'ASC')->get();

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();

        $totalReceivedInBank = Transaction::where('type', 'credit')->where('user_id', $logged_vivah_mitra)->where('type', 'credit')->sum('amount');
        $total_available_physical_card_received = CardStock::where('user_id', $logged_vivah_mitra)->value('quantity');

        $Case_count = '0';
        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'todayIncome' => $todayIncome,
            'vivah_mitra_ewallet' => $vivahMitraEWallet->balance,
            'vivah_mitra_fundWallet' => $vivahMitraFundWallet->balance,
            'vivah_mitra_categories' => VivahmitraCategory::whereNull('parent_id')->where('status', 1)->with('children')->orderBy('id', 'ASC')->get(),
            'vivah_mitra_app_sliders' => VivahAppSlider::where('status', 1)->orderBy('id', 'DESC')->get(),
            'total_physical_card' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'physical')->count(),
            'total_digital_card' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'digital')->count(),
            'totalReceivedInBank' => $totalReceivedInBank,
            'total_available_physical_card_received' => $total_available_physical_card_received,
        ];

        return view('vivah_mitra.other_details.index', $datas);
    }

    public function photoGallery(){
        $gallery_category =  $this->memberRepository->getImageCategory();
        return view('vivah_mitra.photo_gallery', compact('gallery_category'));
    }

    public function photoGalleryDetails($slug){
        $cat_details =  $this->memberRepository->getGalleryDetails($slug);
        if($cat_details){
            $gallery_details =  $this->memberRepository->photoGalleryDetails($cat_details->id);
            return view('vivah_mitra.gallery_details', compact('gallery_details','cat_details'));
        }else{
           return redirect('');
        }
    }

    public function kitTrainingCharge()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        // dd($logged_vivah_mitra);
        $vivah_mitra_details = vivahMitraDetails();
        // dd($vivah_mitra_details);
        $vivahMitraEWallet = getEWallet('employee', $logged_vivah_mitra);
        $e_wallet = EWallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $todayIncome = EWalletTransaction::where('type', 'credit')
            ->where('wallet_id', $e_wallet->id)
            ->whereDate('created_at', now())
            ->sum('amount');

        $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $fund_transactions = WalletTransaction::where('wallet_id', $fund_wallet->id)->orderBy('id', 'ASC')->get();

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();

        $totalReceivedInBank = Transaction::where('type', 'credit')->where('user_id', $logged_vivah_mitra)->where('type', 'credit')->sum('amount');
        $get_transaction = Transaction::where('type', 'credit')->where('user_id', $logged_vivah_mitra)->get();
        $total_available_physical_card_received = CardStock::where('user_id', $logged_vivah_mitra)->value('quantity');

        $Case_count = '0';
        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'todayIncome' => $todayIncome,
            'vivah_mitra_ewallet' => $vivahMitraEWallet->balance,
            'vivah_mitra_fundWallet' => $vivahMitraFundWallet->balance,
            'vivah_mitra_categories' => VivahmitraCategory::whereNull('parent_id')->where('status', 1)->with('children')->orderBy('id', 'ASC')->get(),
            'vivah_mitra_app_sliders' => VivahAppSlider::where('status', 1)->orderBy('id', 'DESC')->get(),
            'total_physical_card' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'physical')->count(),
            'total_digital_card' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'digital')->count(),
            'totalReceivedInBank' => $totalReceivedInBank,
            'total_available_physical_card_received' => $total_available_physical_card_received,
            'get_transaction' => $get_transaction,
        ];

        return view('vivah_mitra.other_details.kit_training_charge', $datas);
    }

    public function welcomeLetter()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        // dd($logged_vivah_mitra);
        $vivah_mitra_details = vivahMitraDetails();
        // dd($vivah_mitra_details);
        $vivahMitraEWallet = getEWallet('employee', $logged_vivah_mitra);
        $e_wallet = EWallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $todayIncome = EWalletTransaction::where('type', 'credit')
            ->where('wallet_id', $e_wallet->id)
            ->whereDate('created_at', now())
            ->sum('amount');

        $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $fund_transactions = WalletTransaction::where('wallet_id', $fund_wallet->id)->orderBy('id', 'ASC')->get();

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();

        $totalReceivedInBank = Transaction::where('type', 'credit')->where('user_id', $logged_vivah_mitra)->where('type', 'credit')->sum('amount');
        $get_transaction = Transaction::where('type', 'credit')->where('user_id', $logged_vivah_mitra)->get();
        $total_available_physical_card_received = CardStock::where('user_id', $logged_vivah_mitra)->value('quantity');

        $Case_count = '0';
        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'todayIncome' => $todayIncome,
            'vivah_mitra_ewallet' => $vivahMitraEWallet->balance,
            'vivah_mitra_fundWallet' => $vivahMitraFundWallet->balance,
            'vivah_mitra_categories' => VivahmitraCategory::whereNull('parent_id')->where('status', 1)->with('children')->orderBy('id', 'ASC')->get(),
            'vivah_mitra_app_sliders' => VivahAppSlider::where('status', 1)->orderBy('id', 'DESC')->get(),
            'total_physical_card' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'physical')->count(),
            'total_digital_card' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'digital')->count(),
            'totalReceivedInBank' => $totalReceivedInBank,
            'total_available_physical_card_received' => $total_available_physical_card_received,
            'get_transaction' => $get_transaction,
        ];

        return view('vivah_mitra.other_details.welcome_letter', $datas);
    }

    public function joiningLetter()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        // dd($logged_vivah_mitra);
        $vivah_mitra_details = vivahMitraDetails();
        // dd($vivah_mitra_details);
        $vivahMitraEWallet = getEWallet('employee', $logged_vivah_mitra);
        $e_wallet = EWallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $todayIncome = EWalletTransaction::where('type', 'credit')
            ->where('wallet_id', $e_wallet->id)
            ->whereDate('created_at', now())
            ->sum('amount');

        $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $fund_transactions = WalletTransaction::where('wallet_id', $fund_wallet->id)->orderBy('id', 'ASC')->get();

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();

        $totalReceivedInBank = Transaction::where('type', 'credit')->where('user_id', $logged_vivah_mitra)->where('type', 'credit')->sum('amount');
        $get_transaction = Transaction::where('type', 'credit')->where('user_id', $logged_vivah_mitra)->get();
        $total_available_physical_card_received = CardStock::where('user_id', $logged_vivah_mitra)->value('quantity');

        $Case_count = '0';
        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'todayIncome' => $todayIncome,
            'vivah_mitra_ewallet' => $vivahMitraEWallet->balance,
            'vivah_mitra_fundWallet' => $vivahMitraFundWallet->balance,
            'vivah_mitra_categories' => VivahmitraCategory::whereNull('parent_id')->where('status', 1)->with('children')->orderBy('id', 'ASC')->get(),
            'vivah_mitra_app_sliders' => VivahAppSlider::where('status', 1)->orderBy('id', 'DESC')->get(),
            'total_physical_card' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'physical')->count(),
            'total_digital_card' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'digital')->count(),
            'totalReceivedInBank' => $totalReceivedInBank,
            'total_available_physical_card_received' => $total_available_physical_card_received,
            'get_transaction' => $get_transaction,
        ];

        return view('vivah_mitra.other_details.joining_letter', $datas);
    }

    public function myInvoice()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        // dd($logged_vivah_mitra);
        $vivah_mitra_details = vivahMitraDetails();
        // dd($vivah_mitra_details);
        $vivahMitraEWallet = getEWallet('employee', $logged_vivah_mitra);
        $e_wallet = EWallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $todayIncome = EWalletTransaction::where('type', 'credit')
            ->where('wallet_id', $e_wallet->id)
            ->whereDate('created_at', now())
            ->sum('amount');

        $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();
        $fund_transactions = WalletTransaction::where('wallet_id', $fund_wallet->id)->orderBy('id', 'ASC')->get();

        $fund_wallet = Wallet::where('owner_type', 'employee')->where('owner_id', $logged_vivah_mitra)->first();

        $totalReceivedInBank = Transaction::where('type', 'credit')->where('user_id', $logged_vivah_mitra)->where('type', 'credit')->sum('amount');
        $get_transaction = Transaction::where('type', 'credit')->where('user_id', $logged_vivah_mitra)->get();
        $total_available_physical_card_received = CardStock::where('user_id', $logged_vivah_mitra)->value('quantity');

        $Case_count = '0';
        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'todayIncome' => $todayIncome,
            'vivah_mitra_ewallet' => $vivahMitraEWallet->balance,
            'vivah_mitra_fundWallet' => $vivahMitraFundWallet->balance,
            'vivah_mitra_categories' => VivahmitraCategory::whereNull('parent_id')->where('status', 1)->with('children')->orderBy('id', 'ASC')->get(),
            'vivah_mitra_app_sliders' => VivahAppSlider::where('status', 1)->orderBy('id', 'DESC')->get(),
            'total_physical_card' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'physical')->count(),
            'total_digital_card' => Member::where('leader_id', $logged_vivah_mitra)->where('card_type', 'digital')->count(),
            'totalReceivedInBank' => $totalReceivedInBank,
            'total_available_physical_card_received' => $total_available_physical_card_received,
            'get_transaction' => $get_transaction,
        ];

        return view('vivah_mitra.other_details.my_invoice', $datas);
    }

    public function prakhandList()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        // dd($logged_vivah_mitra);
        $vivah_mitra_details = vivahMitraDetails();

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'prakhand_list' => Block::where('district_id', $vivah_mitra_details->city)->get(),

        ];
        return view('vivah_mitra.other_details.prakhand_list', $datas);
    }

    /** apply trainer list */

    public function applyTrainerMeet()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        // dd($logged_vivah_mitra);
        $vivah_mitra_details = vivahMitraDetails();

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'prakhand_list' => Block::where('district_id', $vivah_mitra_details->city)->get(),

        ];
        return view('vivah_mitra.application.apply_trainer_meet', $datas);
    }

    public function storeTrainerMeet(Request $request){
        $logged_vivah_mitra = loggedVivahMitra();
        $data = $request->validate([
            'photo1' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'photo2' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'training_place' => 'required|string|max:255',
            'training_address' => 'required|string',
            'district_name' => 'required|string|max:150',
            'training_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'supported_by' => 'nullable|string|max:255',
            'total_vivah_mitra' => 'required|integer|min:0',
            'total_panchayat_mitra' => 'required|integer|min:0',
            'total_block_vivah_mitra' => 'required|integer|min:0',
            'total_district_vivah_mitra' => 'required|integer|min:0',
        ]);

        // ✅ Upload Images
        // $photo1 = $request->file('photo1')->store('training', 'public');
        // $photo2 = $request->file('photo2')->store('training', 'public');

        $photo1_name = null;
        $photo2_name = null;
        $uploadPath = public_path('uploads/members');
        $photo1 = null; // default value
        $photo2 = null; // default value
        if ($request->hasFile('photo1')) {
            $photo1_name = 'photo1' . time() . '.' .
            $request->photo1->getClientOriginalExtension();
            $request->photo1->move($uploadPath, $photo1_name);
            $photo1_name = 'uploads/members/' . $photo1_name;
        }

        if ($request->hasFile('photo2')) {
            $photo2_name = 'photo2' . time() . '.' .
            $request->photo2->getClientOriginalExtension();
            $request->photo2->move($uploadPath, $photo2_name);
            $photo2_name = 'uploads/members/' . $photo2_name;
        }

        // ✅ Save Data
        $data = new TrainingDetail();
        $data->photo1 = $photo1_name;
        $data->photo2 = $photo2_name;

        $data->training_place = $request->training_place;
        $data->training_address = $request->training_address;
        $data->district_name = $request->district_name;

        $data->training_date = $request->training_date;
        $data->start_time = $request->start_time;
        $data->end_time = $request->end_time;

        $data->supported_by = $request->supported_by;

        $data->total_vivah_mitra = $request->total_vivah_mitra;
        $data->total_panchayat_mitra = $request->total_panchayat_mitra;
        $data->total_block_vivah_mitra = $request->total_block_vivah_mitra;
        $data->total_district_vivah_mitra = $request->total_district_vivah_mitra;
        $data->user_id = $logged_vivah_mitra;

        $data->save();

        if (!$data) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong!",
            ]);
        } else {
            return response()->json([
                "status" => true,
                "message" => "Training details saved successfully!",
            ]);
        }

    }

    public function seminarGuestMeet()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'prakhand_list' => Block::where('district_id', $vivah_mitra_details->city)->get(),

        ];
        return view('vivah_mitra.application.seminar_guest_meet', $datas);
    }

    public function storeSeminarGuestMeet(Request $request){
        $logged_vivah_mitra = loggedVivahMitra();
        $data = $request->validate([
            'photo1' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'photo2' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'training_place' => 'required|string|max:255',
            'training_address' => 'required|string',
            'district_name' => 'required|string|max:150',
            'training_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'supported_by' => 'nullable|string|max:255',
            'total_vivah_mitra' => 'required|integer|min:0',
            'total_panchayat_mitra' => 'required|integer|min:0',
            'total_block_vivah_mitra' => 'required|integer|min:0',
            'total_district_vivah_mitra' => 'required|integer|min:0',
        ]);

        // ✅ Upload Images

        $photo1_name = null;
        $photo2_name = null;
        $uploadPath = public_path('uploads/members');
        $photo1 = null; // default value
        $photo2 = null; // default value
        if ($request->hasFile('photo1')) {
            $photo1_name = 'photo1' . time() . '.' .
            $request->photo1->getClientOriginalExtension();
            $request->photo1->move($uploadPath, $photo1_name);
            $photo1_name = 'uploads/members/' . $photo1_name;
        }

        if ($request->hasFile('photo2')) {
            $photo2_name = 'photo2' . time() . '.' .
            $request->photo2->getClientOriginalExtension();
            $request->photo2->move($uploadPath, $photo2_name);
            $photo2_name = 'uploads/members/' . $photo2_name;
        }

        // ✅ Save Data
        $data = new SeminarGuestMettingDetail();
        $data->photo1 = $photo1_name;
        $data->photo2 = $photo2_name;

        $data->training_place = $request->training_place;
        $data->training_address = $request->training_address;
        $data->district_name = $request->district_name;

        $data->training_date = $request->training_date;
        $data->start_time = $request->start_time;
        $data->end_time = $request->end_time;

        $data->supported_by = $request->supported_by;

        $data->total_vivah_mitra = $request->total_vivah_mitra;
        $data->total_panchayat_mitra = $request->total_panchayat_mitra;
        $data->total_block_vivah_mitra = $request->total_block_vivah_mitra;
        $data->total_district_vivah_mitra = $request->total_district_vivah_mitra;
        $data->user_id = $logged_vivah_mitra;

        $data->save();

        if (!$data) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong!",
            ]);
        } else {
            return response()->json([
                "status" => true,
                "message" => "Seminar Guest Meeting details saved successfully!",
            ]);
        }

    }


    public function companyBankDetails()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
        ];
        return view('vivah_mitra.company_bank_details', $datas);
    }


    public function appliedTrainerMeetingList()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'training_meeting_list' => TrainingDetail::where('user_id', $logged_vivah_mitra)->get(),
        ];
        return view('vivah_mitra.application.training_meeting_list', $datas);
    }

    public function appliedSeminarMeetingList()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'training_meeting_list' => SeminarGuestMettingDetail::where('user_id', $logged_vivah_mitra)->get(),
        ];
        return view('vivah_mitra.application.seminar_guest_meeting_list', $datas);
    }

    public function appliedHomeMeetingList()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'home_meeting_list' => HomeMeetingDetail::where('user_id', $logged_vivah_mitra)->get(),
        ];
        return view('vivah_mitra.application.home_meeting_list', $datas);
    }


    // applyHomeMeeting

    public function applyHomeMeeting()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'prakhand_list' => Block::where('district_id', $vivah_mitra_details->city)->get(),
        ];
        return view('vivah_mitra.application.apply_home_meeting', $datas);
    }

    /** store home meeting */

    public function storeHomeMeeting(Request $request){
        $logged_vivah_mitra = loggedVivahMitra();
        $data = $request->validate([
            'photo1' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'photo2' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'training_place' => 'required|string|max:255',
            'training_address' => 'required|string',
            'district_name' => 'required|string|max:150',
            'training_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'supported_by' => 'nullable|string|max:255',
            'total_vivah_mitra' => 'required|integer|min:0',
            'total_panchayat_mitra' => 'required|integer|min:0',
            'total_block_vivah_mitra' => 'required|integer|min:0',
            'total_district_vivah_mitra' => 'required|integer|min:0',
        ]);

        // ✅ Upload Images

        $photo1_name = null;
        $photo2_name = null;
        $uploadPath = public_path('uploads/members');
        $photo1 = null; // default value
        $photo2 = null; // default value
        if ($request->hasFile('photo1')) {
            $photo1_name = 'photo1' . time() . '.' .
            $request->photo1->getClientOriginalExtension();
            $request->photo1->move($uploadPath, $photo1_name);
            $photo1_name = 'uploads/members/' . $photo1_name;
        }

        if ($request->hasFile('photo2')) {
            $photo2_name = 'photo2' . time() . '.' .
            $request->photo2->getClientOriginalExtension();
            $request->photo2->move($uploadPath, $photo2_name);
            $photo2_name = 'uploads/members/' . $photo2_name;
        }

        // ✅ Save Data
        $data = new HomeMeetingDetail();
        $data->photo1 = $photo1_name;
        $data->photo2 = $photo2_name;

        $data->training_place = $request->training_place;
        $data->training_address = $request->training_address;
        $data->district_name = $request->district_name;

        $data->training_date = $request->training_date;
        $data->start_time = $request->start_time;
        $data->end_time = $request->end_time;

        $data->supported_by = $request->supported_by;

        $data->total_vivah_mitra = $request->total_vivah_mitra;
        $data->total_panchayat_mitra = $request->total_panchayat_mitra;
        $data->total_block_vivah_mitra = $request->total_block_vivah_mitra;
        $data->total_district_vivah_mitra = $request->total_district_vivah_mitra;
        $data->user_id = $logged_vivah_mitra;

        $data->save();

        if (!$data) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong!",
            ]);
        } else {
            return response()->json([
                "status" => true,
                "message" => "Home Meeting details saved successfully!",
            ]);
        }

    }

    public function showDataForEmployee($id){
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        $check_district = District::where('id', $id)->first();
        if(!$check_district){
            return redirect()->back()->with('error', 'Invalid district ID');
        }else{
            $datas = [
                'vivah_mitra_details' => $vivah_mitra_details,
                'check_district' => $check_district,
                'prakhand_list' => Block::where('district_id', $vivah_mitra_details->city)->get(),
                'physical_membership' => Member::where('district', $id)->where('card_type', 'physical')->count(),
                'digital_membership' => Member::where('district', $id)->where('card_type', 'digital')->count(),
                'jila_vivah_mitra' => User::where('user_type_id', 6)->where('user_designation_id', 10)->where('city', $id)->count(),
                'prakhand_vivah_mitra' => User::where('user_type_id', 6)->where('user_designation_id', 9)->where('city', $id)->count(),
                'panchayat_vivah_mitra' => User::where('user_type_id', 6)->where('user_designation_id', 8)->where('city', $id)->count(),
                'vivah_mitra' => User::where('user_type_id', 6)->where('user_designation_id', 7)->where('city', $id)->count(),

            ];
            return view('vivah_mitra.dashboard.show_data_for_employee', $datas);
        }

    }

    public function incentiveDistrictWise(){


        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        $employee_districts = \DB::table('user_districts as ud')
                                ->join('districts as d', 'd.id', '=', 'ud.district_id')
                                ->where('ud.user_id', $logged_vivah_mitra)
                                ->select('ud.*', 'd.name as district_name', 'd.id as district_id')
                                ->get();
        $Case_count = '0';
        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'employee_districts' => $employee_districts,
        ];
        return view('vivah_mitra.dashboard.incentive_district_wise', $datas);
    }

    public function showIncentiveDistrictWise($id){
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        $check_district = District::where('id', $id)->first();
        if(!$check_district){
            return redirect()->back()->with('error', 'Invalid district ID');
        }else{
            $employee_districts = \DB::table('user_districts as ud')
                                    ->join('districts as d', 'd.id', '=', 'ud.district_id')
                                    ->where('ud.user_id', $logged_vivah_mitra)
                                    ->select('ud.*', 'd.name as district_name', 'd.id as district_id')
                                    ->get();
            $asMEWallet = getEWallet('employee', $logged_vivah_mitra);
            // dd($asMEWallet);
            $datas = [
                'vivah_mitra_details' => $vivah_mitra_details,
                'employee_districts' => $employee_districts,
                'check_district' => $check_district,
                'asMEWallet' => $asMEWallet,
                'asm_ewallet_transactions' => EWalletTransaction::where('wallet_id', $asMEWallet->id)->where('type', 'credit')->where('district', $id)->get(),
            ];
            return view('vivah_mitra.dashboard.incentive_district_wise_list', $datas);
        }
    }

    public function employeeTarget(){


        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        // dd($vivah_mitra_details) ;
        $employee_targets = EmployeeTarget::where('user_type', $vivah_mitra_details->user_type_id)
                                            ->where('user_designation', $vivah_mitra_details->user_designation_id)
                                            ->where('status', 1)
                                            ->get();
        $Case_count = '0';
        $asMEWallet = getEWallet('employee', $logged_vivah_mitra);
        // dd($asMEWallet);
        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'employee_targets' => $employee_targets,
            'asMEWallet' => $asMEWallet,
            'e_wallet_balance' => $asMEWallet->balance,
        ];
        return view('vivah_mitra.dashboard.employee_targets', $datas);
    }


    public function sendOnlinePayment(){


        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'logged_vivah_mitra' => $logged_vivah_mitra,
        ];
        DB::table('payment_temps')->where('user_id', $logged_vivah_mitra)->delete();
        return view('vivah_mitra.dashboard.send_online_payment', $datas);
    }

    public function sendOnlinePaymentPreview(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'screenshots.*' => 'required|image|max:2048'
        ]);

        $logged_vivah_mitra = loggedVivahMitra();

        // पहले पुराना temp delete करो (optional but recommended)
        DB::table('payment_temps')->where('user_id', $logged_vivah_mitra)->delete();

        $tempImages = [];

        if ($request->hasFile('screenshots')) {
            foreach ($request->file('screenshots') as $file) {

                $path = $file->store('temp', 'public');

                DB::table('payment_temps')->insert([
                    'user_id' => $logged_vivah_mitra,
                    'amount' => $request->amount,
                    'image' => $path,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                $tempImages[] = $path;
            }
        }


        return view('vivah_mitra.dashboard.send_online_payment_preview', [
            'amount' => $request->amount,
            'images' => $tempImages
        ]);
    }

    public function onlinePaymentStore()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $tempData = DB::table('payment_temps')->where('user_id', $logged_vivah_mitra)->get();

        if ($tempData->isEmpty()) {
            return back()->with('error', 'No Data Found');
        }

        // main entry
        $payment = PaymentSubmission::create([
            'user_id' => $logged_vivah_mitra,
            'name' => $vivah_mitra_details->first_name,
            'date' => now()->toDateString(),
            'day' => now()->format('l'),
            'time' => now()->format('H:i:s'),
            'total_amount' => $tempData->first()->amount,
            'no_of_screenshot' => $tempData->count(),
            'status' => 'pending'
        ]);

        foreach ($tempData as $temp) {

            $oldPath = storage_path('app/public/' . $temp->image);

            // new folder path
            $newFolder = public_path('uploads/pay_screenshots/');

            // folder create if not exist
            if (!file_exists($newFolder)) {
                mkdir($newFolder, 0777, true);
            }

            // new file name (unique)
            $fileName = time() . '_' . basename($temp->image);

            $newPath = $newFolder . $fileName;

            // move file
            if (file_exists($oldPath)) {
                rename($oldPath, $newPath);
            }

            // save in DB
            PaymentScreenshot::create([
                'payment_id' => $payment->id,
                'image' => 'uploads/pay_screenshots/' . $fileName
            ]);
        }

        // temp delete
        DB::table('payment_temps')->where('user_id', $logged_vivah_mitra)->delete();

        return redirect()->route('member.payment.list')->with('success', 'Payment Submitted');
    }

    /** cash payment send details */

    public function cashPaymentSendDetails(){


        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'logged_vivah_mitra' => $logged_vivah_mitra,
        ];
        DB::table('payment_temps')->where('user_id', $logged_vivah_mitra)->delete();
        return view('vivah_mitra.dashboard.send_cash_payment_details', $datas);
    }

    public function saveTempCashPaymentDetails(Request $request){
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        // Step 1: Create main entry
        $entry = TempCashEntry::create([
            'user_id'  => $logged_vivah_mitra,
            'subtotal' => $request->subtotal,
            // 'amount'   => $request->amount
        ]);

        // Step 2: Save details
        foreach ($request->notes as $noteValue => $data) {

            $qty = $data['qty'] ?? 0;

            // skip empty rows
            if ($qty <= 0) continue;

            $total = $noteValue * $qty;

            TempCashEntryDetail::create([
                'temp_cash_entry_id' => $entry->id,
                'note_value'    => $noteValue,
                'quantity'      => $qty,
                'total'         => $total
            ]);
        }



        return redirect('member/cash-payment-send-details-preview/' . $entry->id)->with('alert-success', 'Saved successfully');
    }

    public function cashPaymentSendDetailsPreview($id){
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $entry = TempCashEntry::with('details')->where('id', $id)->where('user_id', $logged_vivah_mitra)->first();

        if (!$entry) {
            return back()->with('alert-danger', 'No Data Found');
        }

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'entry' => $entry,
        ];

        return view('vivah_mitra.dashboard.send_cash_payment_details_preview', $datas);
    }

    public function finalCashPaymentSave(Request $request)
    {
        $user_id = loggedVivahMitra();

        // 1. Create main entry
        $entry = CashEntry::create([
            'user_id'  => $user_id,
            'subtotal' => 0, // calculate below
            'date'   => $request->date,
            'day'   => $request->day,
        ]);

        $subtotal = 0;

        // 2. Save details
        foreach ($request->notes as $noteValue => $data) {

            $qty = $data['qty'] ?? 0;

            if ($qty <= 0) continue;

            $total = $noteValue * $qty;

            $subtotal += $total;

            CashEntryDetail::create([
                'cash_entry_id' => $entry->id,
                'note_value'    => $noteValue,
                'quantity'      => $qty,
                'total'         => $total
            ]);
        }

        // 3. Update subtotal safely
        $entry->update([
            'subtotal' => $subtotal
        ]);

        // 4. Optional: delete temp entry
        TempCashEntry::where('id', $request->temp_id)->delete();

        if (!$entry) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong!",
            ]);
        } else {
            return response()->json([
                "status" => true,
                "message" => "Cash details saved successfully!",
            ]);
        }
        // return redirect()->route('member.dashboard')->with('alert-success', 'Cash saved successfully');
    }

    public function cashPaymentHistory()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $cash_entries = CashEntry::with('details')->where('user_id', $logged_vivah_mitra)->orderBy('id', 'DESC')->get();

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'cash_entries' => $cash_entries,
        ];

        return view('vivah_mitra.dashboard.cash_payment_history', $datas);
    }

    public function onlinePaymentSentReport()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        $payment_submission = PaymentSubmission::where('user_id', $logged_vivah_mitra)->orderBy('id', 'DESC')->get();
        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'payment_submission' => $payment_submission,
        ];
        return view('vivah_mitra.dashboard.online_payment_sent_report', $datas);
    }

    public function monthlyRoutineWorkList()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();
        $monthly_routine_works = MonthlyRoutine::where('user_id', $logged_vivah_mitra)->orderBy('id', 'DESC')->get();
        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'monthly_routine_works' => $monthly_routine_works,
        ];
        return view('vivah_mitra.dashboard.monthly_routine_work_list', $datas);
    }

    /** kit transfer */

    public function kitTransfer()
    {
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $user = User::findOrFail($logged_vivah_mitra);
        // dd( $user);

        $user_list = User::where('parent_id', $logged_vivah_mitra)->get();
        $userStock = KitStock::where('user_id', $logged_vivah_mitra)->first();

		$employee_districts = \DB::table('user_districts as ud')
                                ->join('districts as d', 'd.id', '=', 'ud.district_id')
                                ->where('ud.user_id', $logged_vivah_mitra)
                                ->select('ud.*', 'd.name as district_name', 'd.id as district_id')
                                ->get();
        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'user_list' => $user_list,
            'userStock' => $userStock,
            'employee_districts' => $employee_districts,
        ];
        return view('vivah_mitra.kit_transfer', $datas);
    }

    public function transferKits(Request $request)
    {
        $request->validate([
            'to_user_id' => 'required|exists:users,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        $logged_vivah_mitra = loggedVivahMitra();
        $fromUser = $logged_vivah_mitra;

        try {

            // DB::transaction(function () use ($request, $fromUser) {

            //     $fromStock = CardStock::where('user_id', $fromUser)->lockForUpdate()->first();

            //     if (!$fromStock || $fromStock->quantity < $request->quantity) {
            //         throw new \Exception('Insufficient cards');
            //     }

            //     // minus
            //     $fromStock->decrement('quantity', $request->quantity);

            //     // plus
            //     $toStock = CardStock::firstOrCreate(
            //         ['user_id' => $request->to_user_id],
            //         ['quantity' => 0]
            //     );

            //     $toStock->increment('quantity', $request->quantity);

            //     CardTransaction::create([
            //         'from_user_id' => $fromUser,
            //         'to_user_id'   => $request->to_user_id,
            //         'quantity'     => $request->quantity,
            //         'type'         => 'transfer',
            //         'note'         => 'Card transfer'
            //     ]);
            // });

            DB::transaction(function () use ($request, $fromUser) {

                $fromStock = KitStock::where('user_id', $fromUser)->lockForUpdate()->first();

                if (!$fromStock || $fromStock->quantity < $request->quantity) {
                    throw new \Exception('Insufficient Kits');
                }

                // Only HOLD (optional: you can deduct now or later)
                $fromStock->decrement('quantity', $request->quantity);

                KitTransaction::create([
                    'from_user_id' => $fromUser,
                    'to_user_id'   => $request->to_user_id,
                    'quantity'     => $request->quantity,
                    'type'         => 'transfer',
                    'status'       => 'pending',
                    'note'         => 'Waiting for approval'
                ]);
            });

            return response()->json([
                'status'  => true,
                'message' => 'Kits transferred successfully'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ]);
        }
    }


    public function pendingKitReceived(){
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $user = User::findOrFail($logged_vivah_mitra);
        // dd( $user);

        $user_list = User::where('parent_id', $logged_vivah_mitra)->get();
        $userStock = KitStock::where('user_id', $logged_vivah_mitra)->first();

        $kit_received_list = KitTransaction::where('to_user_id', $logged_vivah_mitra)->where('type', 'issue')->get();

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'user_list' => $user_list,
            'userStock' => $userStock,
            'kit_received_list' => $kit_received_list,
        ];
        return view('vivah_mitra.pending_kit_transfer', $datas);
    }

    public function pendingCardReceived(){
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $user = User::findOrFail($logged_vivah_mitra);
        // dd( $user);

        $user_list = User::where('parent_id', $logged_vivah_mitra)->get();
        $userStock = CardStock::where('user_id', $logged_vivah_mitra)->first();

        $kit_received_list = CardTransaction::where('to_user_id', $logged_vivah_mitra)->where('type', 'issue')->get();

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'user_list' => $user_list,
            'userStock' => $userStock,
            'kit_received_list' => $kit_received_list,
        ];
        return view('vivah_mitra.pending_card_received', $datas);
    }


    public function acceptKitHere($id){
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $user = User::findOrFail($logged_vivah_mitra);
        // dd( $user);

        $user_list = User::where('parent_id', $logged_vivah_mitra)->get();
        $userStock = KitStock::where('user_id', $logged_vivah_mitra)->first();

        $kit_received_details = KitTransaction::where('id', $id)->first();

        if($kit_received_details){
            $datas = [
                'vivah_mitra_details' => $vivah_mitra_details,
                'user_list' => $user_list,
                'userStock' => $userStock,
                'kit_received_details' => $kit_received_details,
            ];
            return view('vivah_mitra.accept_kit_view', $datas);
        }else{
            return redirect()->back()->with('error', 'No Data Found');
        }

    }

    public function acceptPhysicalCardHere($id){
        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $user = User::findOrFail($logged_vivah_mitra);
        // dd( $user);

        $user_list = User::where('parent_id', $logged_vivah_mitra)->get();
        $userStock = CardStock::where('user_id', $logged_vivah_mitra)->first();

        $kit_received_details = CardTransaction::where('id', $id)->first();

        if($kit_received_details){
            $datas = [
                'vivah_mitra_details' => $vivah_mitra_details,
                'user_list' => $user_list,
                'userStock' => $userStock,
                'kit_received_details' => $kit_received_details,
            ];
            return view('vivah_mitra.accept_physical_card', $datas);
        }else{
            return redirect()->back()->with('error', 'No Data Found');
        }

    }


    public function acceptTransfer(Request $request)
    {
        $id = $request->id;
        if($request->status=='accepted'){
                DB::transaction(function () use ($id) {

                $transaction = KitTransaction::lockForUpdate()->findOrFail($id);

                if ($transaction->status != 'pending') {
                    throw new \Exception('Already processed');
                }

                // Add stock to receiver
                $toStock = KitStock::firstOrCreate(
                    ['user_id' => $transaction->to_user_id],
                    ['quantity' => 0]
                );

                // $toStock->increment('quantity', $transaction->quantity);

                // Update status
                $transaction->update(['status' => 'accepted']);
            });
            return response()->json(['status' => true, 'message' => 'Accepted']);
        }

        if($request->status=='rejected'){
                DB::transaction(function () use ($id) {

                $transaction = KitTransaction::lockForUpdate()->findOrFail($id);

                if ($transaction->status != 'pending') {
                    throw new \Exception('Already processed');
                }

                // Add stock to receiver
                $toStock = KitStock::firstOrCreate(
                    ['user_id' => $transaction->to_user_id],
                    ['quantity' => 0]
                );

                $toStock->decrement('quantity', $transaction->quantity);

                // Update status
                $transaction->update(['status' => 'rejected']);
            });
            return response()->json(['status' => true, 'message' => 'Rejected']);
        }


    }

    public function acceptPhysicalCardTransfer(Request $request)
    {
        $id = $request->id;
        if($request->status=='accepted'){
                DB::transaction(function () use ($id) {

                $transaction = CardTransaction::lockForUpdate()->findOrFail($id);

                if ($transaction->status != 'pending') {
                    throw new \Exception('Already processed');
                }

                // Add stock to receiver
                $toStock = CardStock::firstOrCreate(
                    ['user_id' => $transaction->to_user_id],
                    ['quantity' => 0]
                );

                // $toStock->increment('quantity', $transaction->quantity);

                // Update status
                $transaction->update(['status' => 'accepted']);
            });
            return response()->json(['status' => true, 'message' => 'Accepted']);
        }

        if($request->status=='rejected'){
                DB::transaction(function () use ($id) {

                $transaction = CardTransaction::lockForUpdate()->findOrFail($id);

                if ($transaction->status != 'pending') {
                    throw new \Exception('Already processed');
                }

                // Add stock to receiver
                $toStock = CardStock::firstOrCreate(
                    ['user_id' => $transaction->to_user_id],
                    ['quantity' => 0]
                );

                $toStock->decrement('quantity', $transaction->quantity);

                // Update status
                $transaction->update(['status' => 'rejected']);
            });
            return response()->json(['status' => true, 'message' => 'Rejected']);
        }


    }



    public function sendMonthlyRoutineWork(){


        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'logged_vivah_mitra' => $logged_vivah_mitra,
        ];
        DB::table('payment_temps')->where('user_id', $logged_vivah_mitra)->delete();
        return view('vivah_mitra.dashboard.send_monthly_routine_work', $datas);
    }

    public function monthlyRoutineWorkSave(Request $request)
    {
        $request->validate(
            [
                'month' => 'required',
                'routing' => 'required|array',

                'routing.*.day'   => 'required',
                'routing.*.date'  => 'required|date',
                'routing.*.place' => 'required',
                'routing.*.work'  => 'required',
            ],
            [
                'month.required' => 'Please select month.',

                'routing.required' => 'Please add routine details.',
                'routing.array'    => 'Invalid routine data.',

                'routing.*.day.required'   => 'Please select day.',
                'routing.*.date.required'  => 'Please select date.',
                'routing.*.date.date'      => 'Please enter valid date.',
                'routing.*.place.required' => 'Please enter visit place.',
                'routing.*.work.required'  => 'Please enter type of work.',
            ]
        );

        $logged_vivah_mitra = loggedVivahMitra();

        foreach ($request->routing as $row) {

            MonthlyRoutine::create([
                'user_id' => $logged_vivah_mitra,
                'month'   => $request->month,
                'day'     => $row['day'],
                'date'    => $row['date'],
                'place'   => $row['place'],
                'work'    => $row['work'],
            ]);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Routine submitted successfully'
        ]);
    }

    public function importantWork(){


        $logged_vivah_mitra = loggedVivahMitra();
        $vivah_mitra_details = vivahMitraDetails();

        $datas = [
            'vivah_mitra_details' => $vivah_mitra_details,
            'logged_vivah_mitra' => $logged_vivah_mitra,
        ];
        return view('vivah_mitra.dashboard.important_work', $datas);
    }


     public function jilaVivahMitraAavedan()
    {
        $remainingDays = 0;
        $loggedVivahMitra = vivahMitraDetails();
        if ($loggedVivahMitra->created_at) {

            $applyDate = Carbon::parse($loggedVivahMitra->created_at)->startOfDay();
            $expiryDate = $applyDate->copy()->addDays(30)->subDay();
            // subDay isliye kyunki 13 Feb se 12 March = 30 days

            $today = Carbon::now()->startOfDay();

            if ($today->lessThanOrEqualTo($expiryDate)) {
                $remainingDays = $today->diffInDays($expiryDate) + 1;
            } else {
                $remainingDays = 0; // Expired
            }
        }
        $datas = [
            'logged_vivah_mitra' => loggedVivahMitra(),
            'remaining_days' => $remainingDays,
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
            'prakhand_vivah_mitra_box_first10' =>  PrakhandVmBox::where('user_id', loggedVivahMitra())->orderBy('id', 'ASC')->limit(10)->get(),
            'prakhand_vivah_mitra_box_next_6' =>  PrakhandVmBox::where('user_id', loggedVivahMitra())->orderBy('id', 'ASC')->limit(6)->offset(10)->get(),
        ];
        // dd($datas['prakhand_vivah_mitra_box_first10']);
        return view('vivah_mitra.member.jila_vivah_mitra_aavedan', $datas);
    }

    public function applyJilaVivahMitra()
    {
        $loggedVivahMitra = vivahMitraDetails();

        // 1️⃣ Check 30 days expiry
        if($loggedVivahMitra->verify_date){

            $applyDate = Carbon::parse($loggedVivahMitra->verify_date);
            $expiryDate = $applyDate->addDays(30);

            // Count total Vibhag Mitra (children)
            $parentCount = User::where('parent_id', $loggedVivahMitra->id)->count();

            // dd($loggedVivahMitra->id);
            // Check expiry
            if(Carbon::now()->greaterThan($expiryDate) && $parentCount < 10){

                $loggedVivahMitra->update([
                    'status' => 0   // Blocked
                ]);

                $userLogin = UserLogin::where('user_id', $loggedVivahMitra->id)->first();
                $userLogin->status = 0;
                $userLogin->save();
            }
        }

        $datas = [
            // 'cardKey' => $cardKey,
            'logged_vivah_mitra' => loggedVivahMitra(),
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
        ];
        return view('vivah_mitra.member.apply_jila_vivah_mitra_reg', $datas);
    }

    public function saveJilaVivahMitra(Request $request)
    {
        $boxKey = session('selected_box_key');

        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'mobile'         => 'required|digits:10|unique:users,mobile',
            'aadhar_card'    => 'required|digits:12|numeric',
            'password'       => 'required|min:6',
            'address'        => 'required|string',
            'state'           => 'required',
            'city'           => 'required',
            'block'           => 'nullable',
            'panchayat'           => 'nullable',
            'ward_no'           => 'nullable',
            'account_number' => 'required|digits_between:9,18',
            'ifsc_code'      => 'required|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            'bank_name'      => 'required|string',
            'branch_name'    => 'required|string',
            'upi_details'    => 'required|string',
            'terms_and_conditions' => 'required|accepted',
            'profile_pic' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'signature' => 'required|image|mimes:png,jpg,jpeg|max:2048|dimensions:min_width=200,min_height=100'
        ],[
            'signature.dimensions' => 'Signature size must be at least 200x100 pixels.',
            'signature.image' => 'Signature must be a valid image file.',
            'terms_and_conditions.accepted' => 'You must accept the terms and conditions.'
        ]);

        DB::beginTransaction();

        try {



            // 🔒 Lock box row
            $box = PrakhandVmBox::where('box_key', $boxKey)
                ->where('is_filled', 0)
                ->lockForUpdate()
                ->firstOrFail();

            $logged_vivah_mitra  = loggedVivahMitra();
            $vivah_mitra_details = vivahMitraDetails();
            $state        = 5;
            $user_type_id = 6;

            $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);
            $deduct_amount = 1101;
            if ($vivahMitraFundWallet->balance < $deduct_amount) {
                return response()->json([
                    'status' => false,
                    'message' => 'पर्याप्त बैलेंस उपलब्ध नहीं है। कृपया पहले अपने वॉलेट में राशि जोड़ें।!'
                ]);

            }

            /* --------------------------
            CREATE USER (MAIN STEP)
            --------------------------- */

            $image_file_name = null;
            $signature_file_name = null;
            $uploadPath = public_path('uploads/staff');

            $profile_pic = null; // default value
            $signature = null; // default value

            if ($request->hasFile('profile_pic')) {

                $image_file_name = 'profile_pic_' . time() . '.' .
                    $request->profile_pic->getClientOriginalExtension();

                $request->profile_pic->move($uploadPath, $image_file_name);

                $profile_pic = 'uploads/staff/' . $image_file_name;
            }

            if ($request->hasFile('signature')) {
                $signature_file_name = 'signature' . time() . '.' .
                    $request->signature->getClientOriginalExtension();
                $request->signature->move($uploadPath, $signature_file_name);
                $signature = 'uploads/staff/' . $signature_file_name;
            }

            $user = new User();
            $user->box_key       = $boxKey;
            $user->branch        = $vivah_mitra_details->branch;
            $user->state         = 5;
            $user->session       = $vivah_mitra_details->session;
            $user->first_name    = $data['name'];
            $user->mobile        = $data['mobile'];
            $user->email        = null;
            $user->aadhar_card         = $data['aadhar_card'];
            $user->address       = $data['address'];
            $user->state                = $data['state'];
            $user->city                 = $data['city'];
            $user->block                = null;
            $user->panchayat            = null;
            $user->ward_no              = null;
            $user->user_type_id  = 6;
            $user->user_designation_id = 10;
            $user->parent_id     = $logged_vivah_mitra;
            $user->profile_pic     = $profile_pic;
            $user->signature     = $signature;

             /* --------------------------
            GENERATE UNIQUE CODE
            --------------------------- */
            if ($user_type_id == 6) {

                do {
                    $random  = mt_rand(1000000, 9999999);
                    $newCode = "14" . $random;
                    $exists = User::where('employee_code', $newCode)->exists();
                } while ($exists);

                $user->employee_code = $newCode;
            } else {

                $userType   = UserType::find($user_type_id)->name;
                $shortType  = strtoupper(substr($userType, 0, 2));
                $prefix     = "V2F";
                $year       = date('y');
                $idPadded   = str_pad($user->id, 3, '0', STR_PAD_LEFT);
                $user->employee_code = "{$prefix}-{$shortType}-{$year}-{$idPadded}";
            }

            if (!$user->save()) {
                throw new \Exception('User not saved');
            }



            /* --------------------------
            CREATE WALLETS
            --------------------------- */
            Wallet::create([
                'owner_type' => 'employee',
                'owner_id'   => $user->id,
                'balance'    => 0
            ]);

            $ewallet = EWallet::create([
                        'owner_type' => 'employee',
                        'owner_id'   => $user->id,
                        'balance'    => 0
                    ]);

            $walletId = $ewallet->id;

            /* --------------------------
            CREATE CHILD BOXES
            --------------------------- */
            $boxes = [];
            for ($i = 1; $i <= 20; $i++) {
                $boxes[] = [
                    'user_id' => $user->id,
                    'box_key' => 'BOX_' . $user->id . '_' . $i,
                ];
            }
            PrakhandVmBox::insert($boxes);

            /* --------------------------
            USER LOGIN (HASH PASSWORD)
            --------------------------- */
            UserLogin::create([
                'user_id'      => $user->id,
                'username'     => $data['mobile'],
                'password'     => $data['password'], // ✅ SECURE
                'user_type_id' => 6,
                'status'       => 1
            ]);

            /* --------------------------
            USER BANK DETAILS
            --------------------------- */
            UserDetail::create([
                'user_id'        => $user->id,
                'account_number' => $data['account_number'],
                'ifsc_code'      => $data['ifsc_code'],
                'bank_name'      => $data['bank_name'],
                'branch_name'    => $data['branch_name'],
                'upi_details'    => $data['upi_details'],
            ]);




			/* -------------------------
				MESSAGE SAVE HERE
			----------------------------*/

			$message = implode("\n", [
                    "प्रिय {$data['name']},",
                    "",
                    "आपका प्रखंड विवाह मित्र पद हेतु आवेदन सफलतापूर्वक प्राप्त हो गया है।",
                    "",
                    "🔹 प्रखंड विवाह मित्र कोड : {$newCode}",
                    "",
                    "📲 ऐप डाउनलोड करें :",
                    "https://play.google.com/store/apps/details?id=com.growciti.vivahmitra",
                    "",
                    "🔑 लॉग-इन विवरण:",
                    "आईडी : {$data['mobile']}",
                    "पासवर्ड : {$data['password']}",
                    "",
                    "⏳ ऑनबोर्डिंग 24–48 घंटे में पूर्ण कर दी जाएगी।",
                    "कृपया धैर्यपूर्वक प्रतीक्षा करें।"
                ]);

            $memberMessage = new MemberMessage();
            // $memberMessage->member_id = $member->id;
            $memberMessage->messages = $message;
            // $memberMessage->membership_number = $newMembershipCode;
            $memberMessage->user_id = $logged_vivah_mitra;
            $memberMessage->save();

            $bonusIncome = 101;
            $prakhandMitraEWallet = getEWallet('employee', $user->id);
            $credit_type = 'welcome_bonus';

            $vivah_mitra_details = vivahMitraDetails();
            $vivahMitraDistrict = $vivah_mitra_details->city;
            // Credit incentive
            creditEWallet(
                $prakhandMitraEWallet,
                $bonusIncome,
                $credit_type,
                "{$bonusIncome}% Rs 101/- Amount received as Bonus for Prakhand Vivah Mitra Registration of {$data['name']} (ID: {$user->employee_code})",
                $vivahMitraDistrict
            );

            /** fund deduction */
            $vivahMitraFundWallet = getWallet('employee', $logged_vivah_mitra);
            $deduct_amount = 1101; // Example amount to deduct
            debitWallet(
                        $vivahMitraFundWallet,
                        $deduct_amount,
                        "Prakhand Vivah Mitra Registration | Name: {$data['name']} | Mobile: {$data['mobile']}"
                    );

            DB::commit();

            /* --------------------------
            MARK BOX AS FILLED
            --------------------------- */
            $box->update(['is_filled' => 1]);

            session()->forget('selected_box_key');

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'जिला विवाह मित्र का सफलतापूर्वक पंजीकरण हो गया है |'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function jilaVivahMitraTandC()
    {
        $datas = [
            'logged_vivah_mitra' => loggedVivahMitra(),
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
        ];
        return view('vivah_mitra.member.jila_vivah_mitra_t_and_c', $datas);
    }

    public function jilaVivahMitraList()
    {
        $datas = [
            'logged_vivah_mitra' => loggedVivahMitra(),
            'vivah_mitra_details' => vivahMitraDetails(),
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
            'jila_vivah_mitra_list' =>  User::where('parent_id', loggedVivahMitra())->orderBy('id', 'DESC')->get(),
        ];
        return view('vivah_mitra.member.jila_vivah_mitra_list', $datas);
    }







}
