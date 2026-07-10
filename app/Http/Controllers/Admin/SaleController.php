<?php

namespace App\Http\Controllers\Admin;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\SaleRepositoryInterface;
use App\Models\Course;
use App\Models\Session;
use App\Models\State;
use App\Models\Branch;
use App\Models\User;
use App\Models\UserLogin;
use App\Models\UserType;
use App\Models\District;
use App\Models\MasterDesignation;
use App\Models\MasterVideo;
use App\Models\MasterYearlyBonus;
use App\Models\UserDetail;
use App\Models\Wallet;
use App\Models\EWallet;
use App\Models\MasterVivahmitraCode;
use App\Models\ProductCategory;
use App\Models\Member;
use App\Models\BranchProduct;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class SaleController extends Controller
{

    private $saleRepository;

    public function __construct(SaleRepositoryInterface $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_type_list =  $this->saleRepository->get_user_types();
        $designation_list =  $this->saleRepository->get_master_designations();
        $page_title = 'Employee List';
        $query = User::select([
            'users.*',
            'user_logins.username',
            'user_logins.password',
            'user_types.name as userType',
            'master_designations.name as designation_name',
        ])->where('users.id', '!=', 1)
            ->join('user_logins', 'user_logins.user_id', '=', 'users.id')
            ->leftJoin('user_types', 'user_types.id', '=', 'users.user_type_id')
            ->leftJoin('master_designations', 'master_designations.id', '=', 'users.user_designation_id');

            if ($request->user_type_id) {
                $query->where('users.user_type_id', $request->user_type_id);
            }

            if ($request->user_designation_id) {
                $query->where('users.user_designation_id', $request->user_designation_id);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('users.first_name', 'like', "%$search%")
                    ->orWhere('users.last_name', 'like', "%$search%")
                    ->orWhere('users.email', 'like', "%$search%")
                    ->orWhere('users.mobile', 'like', "%$search%");
                });
            }

            $users = $query->paginate(20);

        return view('admin.staffs.index', compact('users','user_type_list', 'designation_list', 'page_title'));
    }

    public function fetch(Request $request)
    {
        $query = User::select([
            'users.*',
            'user_logins.username',
            'user_logins.password',
            'user_types.name as userType',
            'master_designations.name as designation_name',
        ])->where('users.id', '!=', 1)
            ->join('user_logins', 'user_logins.user_id', '=', 'users.id')
            ->leftJoin('user_types', 'user_types.id', '=', 'users.user_type_id')
            ->leftJoin('master_designations', 'master_designations.id', '=', 'users.user_designation_id');


        if ($request->user_type_id) {
            $query->where('users.user_type_id', $request->user_type_id);
        }

        if ($request->user_designation_id) {
            $query->where('users.user_designation_id', $request->user_designation_id);
        }

        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('users.first_name', 'like', "%$search%")
                ->orWhere('users.last_name', 'like', "%$search%")
                ->orWhere('users.email', 'like', "%$search%")
                ->orWhere('users.mobile', 'like', "%$search%");
            });
        }

        $users = $query->paginate(20);

        if ($request->ajax()) {
            return view('admin.staffs.partials.user_table', compact('users'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $datas = [
            'page_title' => 'Employee',
            'state_list' =>  State::get(),
            'branch_list' =>  Branch::where('status', 1)->get(),
            'session_list' =>  Session::where('status', 1)->get(),
            'user_type_list' =>  $this->saleRepository->get_user_types(),
            'designation_list' =>  $this->saleRepository->get_master_designations(),
        ];
        return view('admin.staffs.create', $datas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){
        // dd($request->all());
        $data = $request->validate([
            'branch' => 'required',
            'session' => 'required',
            'user_type_id' => 'required',
            'user_designation_id' => 'required',
            'name' => 'required',
            'mobile' => 'required',
            // 'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'mobile' => 'required|unique:users',
            'email' => 'required|unique:users',
            'status' => 'required',
            'password' => 'required',
            'address' => 'required',
            'experience' => 'required',
            'state' => 'required',
            'city' => 'required',
            'working_hour' => 'required',
            'salary' => 'required',
        ]);

        $user = new User();
        $user->branch = $data['branch'];
        $user->session = $data['session'];
        $user->first_name = $data['name'];
        $user->mobile = $data['mobile'];
        $user->email = $data['email'];
        $user->state = $data['state'];
        $user->address = $data['address'];
        $user->city = $data['city'];
        $user->salary = $data['salary'];
        $user->working_hour = $data['working_hour'];
        $user->experience = $data['experience'];
        $user->user_type_id = $data['user_type_id'];
        $user->user_designation_id = $data['user_designation_id'];
        $user->save();

        $userType = UserType::find($data['user_type_id'])->name;
        $shortType = strtoupper(substr($userType, 0, 2));
        $prefix = "V2F";
        $year = date('y');
        $idPadded = str_pad($user->id, 3, '0', STR_PAD_LEFT);

        $employeeCode = "{$prefix}-{$shortType}-{$year}-{$idPadded}";
        if ($data['user_type_id'] == 6) {

            do {
                // Generate random 7 digits
                $random = mt_rand(1000000, 9999999);

                // Final 9 digit code starting with 14
                $newCode = "14" . $random;

                // Check if already exists
                $exists = User::where('employee_code', $newCode)->exists();

            } while ($exists); // regenerate if duplicate found

            // Save unique code
            $user->employee_code = $newCode;
            $user->save();

			// -----------------------------
			// CREATE WALLET FOR EMPLOYEE
			// -----------------------------
			Wallet::firstOrCreate(
				[
					'owner_type' => 'employee',
					'owner_id'   => $user->id
				],
				[
					'balance' => 0
				]
			);

            EWallet::firstOrCreate(
                [
                    'owner_type' => 'employee',
                    'owner_id'   => $user->id
                ],
                [
                    'balance' => 0
                ]
            );

        }else{
            $user->employee_code = $employeeCode;
            $user->save();
			// -----------------------------
			// CREATE WALLET FOR EMPLOYEE
			// -----------------------------
			Wallet::firstOrCreate(
				[
					'owner_type' => 'employee',
					'owner_id'   => $user->id
				],
				[
					'balance' => 0
				]
			);

            EWallet::firstOrCreate(
                [
                    'owner_type' => 'employee',
                    'owner_id'   => $user->id
                ],
                [
                    'balance' => 0
                ]
            );
        }


        $userLogin = new UserLogin();
        $userLogin->user_id = $user->id;
        $userLogin->username = $data['mobile'];
        $userLogin->password = $data['password'];
        $userLogin->user_type_id = $data['user_type_id'];
        $userLogin->status = $data['status'];
        $userLogin->save();

        $data['created_by'] = session('LoggedUser')->id;
        // $this->saleRepository->storeStaff($data);
        return redirect()->route('admin.staffs.index')->with(session()->flash('alert-success', 'Added Successfully'));
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
            $staff = $this->saleRepository->findStaff($id);
            // dd($staff);
            if(!$staff){
                return redirect()->route('admin.staffs.index')->with(session()->flash('alert-danger', 'Staff Not Found'));
            }else{
                    if($staff->user_type_id == 1){
                        $pgTitle = 'Admin';
                    }elseif($staff->user_type_id == 2){
                        $pgTitle = 'Branch Manager';
                    }elseif($staff->user_type_id == 5){
                        $pgTitle = 'Employee    ';
                    }elseif($staff->user_type_id == 6){
                        $pgTitle = 'BDM';
                    }else{
                        $pgTitle = 'Vivah Mitra';
                    }

                $datas = [
                'page_title' => $pgTitle,
                'state_list' =>  State::get(),
                'branch_list' =>  Branch::where('status', 1)->get(),
                'session_list' =>  Session::where('status', 1)->get(),
                'user_type_list' =>  $this->saleRepository->get_user_types(),
                'designation_list' =>  $this->saleRepository->get_master_designations(),
                'staff' =>  $staff,
                'city_details' =>  District::where('id', $staff->city)->first(),
                'designation_details' =>  MasterDesignation::where('id', $staff->user_designation_id)->first(),
            ];
            return view('admin.staffs.update', $datas);
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
            'branch' => 'required',
            'session' => 'required',
            'user_type_id' => 'required',
            'user_designation_id' => 'required',
            'name' => 'required',
            'mobile' => 'required',
            'mobile' => [
            'required',
                Rule::unique('users')->ignore($id),
            ],
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'status' => 'required',
            'password' => 'required',
            'address' => 'required',
            'experience' => 'required',
            'state' => 'required',
            'city' => 'required',
            'working_hour' => 'required',
            'salary' => 'required',
            'username' => 'required',
        ]);


        // if($request->has('profile_pic')){
        //     $data['profile_pic'] = upload_asset($request->profile_pic, 'staff');
        // }else{
        //     $data['profile_pic'] = NULL;
        // }
        $this->saleRepository->updateStaff($data, $id);
        return redirect()->route('admin.staffs.index')->with(session()->flash('alert-success', 'Staff Updated Successfully'));
    }


    public function bdmList(Request $request)
    {
        $user_type_list =  $this->saleRepository->get_user_types();
        $designation_list =  $this->saleRepository->get_master_designations();
        $page_title = 'BDM List';
        $query = User::select([
            'users.*',
            'user_logins.username',
            'user_logins.password',
            'user_types.name as userType',
            'master_designations.name as designation_name',
        ])->where('users.id', '!=', 1)->where('users.user_type_id', 6)
            ->join('user_logins', 'user_logins.user_id', '=', 'users.id')
            ->leftJoin('user_types', 'user_types.id', '=', 'users.user_type_id')
            ->leftJoin('master_designations', 'master_designations.id', '=', 'users.user_designation_id');

            if ($request->user_type_id) {
                $query->where('users.user_type_id', $request->user_type_id);
            }

            if ($request->user_designation_id) {
                $query->where('users.user_designation_id', $request->user_designation_id);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('users.first_name', 'like', "%$search%")
                    ->orWhere('users.last_name', 'like', "%$search%")
                    ->orWhere('users.email', 'like', "%$search%")
                    ->orWhere('users.mobile', 'like', "%$search%");
                });
            }

            $users = $query->paginate(20);

        return view('admin.staffs.bdm.index', compact('users','user_type_list', 'designation_list', 'page_title'));
    }

    public function fetchBdmData(Request $request)
    {
        $query = User::select([
            'users.*',
            'user_logins.username',
            'user_logins.password',
            'user_types.name as userType',
            'master_designations.name as designation_name',
        ])->where('users.id', '!=', 1)->where('users.user_type_id', 6)
            ->join('user_logins', 'user_logins.user_id', '=', 'users.id')
            ->leftJoin('user_types', 'user_types.id', '=', 'users.user_type_id')
            ->leftJoin('master_designations', 'master_designations.id', '=', 'users.user_designation_id');


        if ($request->user_type_id) {
            $query->where('users.user_type_id', $request->user_type_id);
        }

        if ($request->user_designation_id) {
            $query->where('users.user_designation_id', $request->user_designation_id);
        }

        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('users.first_name', 'like', "%$search%")
                ->orWhere('users.last_name', 'like', "%$search%")
                ->orWhere('users.email', 'like', "%$search%")
                ->orWhere('users.mobile', 'like', "%$search%");
            });
        }

        $users = $query->paginate(20);

        if ($request->ajax()) {
            return view('admin.staffs.partials.user_table', compact('users'))->render();
        }
    }


    public function verifyEmployee($id){
            $staff = $this->saleRepository->findStaff($id);
            // dd($staff);
            if(!$staff){
                return redirect()->route('admin.staffs.index')->with(session()->flash('alert-danger', 'Staff Not Found'));
            }else{
                    if($staff->user_type_id == 1){
                        $pgTitle = 'Verify Admin';
                    }elseif($staff->user_type_id == 2){
                        $pgTitle = 'Verify Branch Manager';
                    }elseif($staff->user_type_id == 5){
                        $pgTitle = ' Verify Employee    ';
                    }elseif($staff->user_type_id == 6){
                        $pgTitle = 'Verify BDM';
                    }else{
                        $pgTitle = 'Verify Vivah Mitra';
                    }

                $datas = [
                'page_title' => $pgTitle,
                'state_list' =>  State::get(),
                'branch_list' =>  Branch::where('status', 1)->get(),
                'session_list' =>  Session::where('status', 1)->get(),
                'user_type_list' =>  $this->saleRepository->get_user_types(),
                'designation_list' =>  $this->saleRepository->get_master_designations(),
                'staff' =>  $staff,
                'city_details' =>  District::where('id', $staff->city)->first(),
                'designation_details' =>  MasterDesignation::where('id', $staff->user_designation_id)->first(),
                'reporting_officer' =>  User::where('branch', $staff->branch)->where('user_type_id', 5)->where('user_designation_id', 17)->get(),
                'trainer_officer' =>  User::where('branch', $staff->branch)->where('user_type_id', 5)->where('user_designation_id', 16)->get(),
                'home_verification' =>  User::where('branch', $staff->branch)->where('user_type_id', 5)->where('user_designation_id', 18)->get(),
                'junior_office_employee' =>  User::where('branch', $staff->branch)->where('user_type_id', 5)->where('user_designation_id', 15)->get(),
                'video_list' =>  MasterVideo::where('user_type', $staff->user_type_id)->where('user_designation', $staff->user_designation_id)->get(),
                'yearly_bonus_list' =>  MasterYearlyBonus::where('user_type', $staff->user_type_id)->where('user_designation', $staff->user_designation_id)->get(),
            ];
            // dd($datas['video_list']);
            return view('admin.staffs.verify_employee', $datas);
        }
    }

    public function getEmployeeDetails(Request $request){
        $staff = $this->saleRepository->findStaff($request->staff_id);
        return response()->json(['status' => 'success', 'data' => $staff], 200);
    }

    public function SaveEmployeePhoto(Request $request){
        // dd($request->all());
        $request->validate([
            'image_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $staff = User::where('id', $request->staff_id)->first();
        if(!$staff){
            return redirect()->back()->with(session()->flash('alert-danger', 'Staff Not Found'));
        }

        $image_file_name = null;
        $uploadPath = public_path('uploads/staff');

            if ($request->hasFile('image_file')) {
                $image_file_name = 'image_file' . time() . '.' . $request->image_file->getClientOriginalExtension();
                $request->image_file->move($uploadPath, $image_file_name);

                $staff->profile_pic = $image_file_name ? 'uploads/staff/' . $image_file_name : null;
                $staff->save();
            }

            return response()->json([
                'status' => true,
                'message' => 'Photo Saved Successfully',
            ]);

        // return redirect()->back()->with(session()->flash('alert-success', 'Employee Photo Updated Successfully'));

    }


    public function SaveEmployeeDetails(Request $request)
        {
            try {

                // -------------------------
                // VALIDATION
                // -------------------------
                $validated = $request->validate([

                    // Bank & address details
                    'account_number'    => 'required|string|max:255',
                    'ifsc_code'         => 'required|string|max:255',
                    'bank_name'         => 'required|string|max:255',
                    'branch_name'       => 'required|string|max:255',
                    'upi_details'       => 'required|string|max:255',

                    // location verification
                    'branch'    => 'required|string|max:255',
                    'to_city'         => 'required|string|max:255',
                    'km1'         => 'required|string|max:255',

                    'city'       => 'required|string|max:255',
                    'to_village'       => 'required|string|max:255',
                    'km2'       => 'required|string|max:255',

                    'village'       => 'required|string|max:255',
                    'to_home'       => 'required|string|max:255',
                    'km3'       => 'required|string|max:255',

                    'ward_member_name'       => 'required|string|max:255',
                    'near_by'       => 'required|string|max:255',
                    'mark_of_identification'       => 'required|string|max:255',

                    // Upload documents
                    'aadhar_card'               => 'required|mimes:pdf|max:2048',
                    'pan_card'                  => 'required|mimes:pdf|max:2048',
                    'driving_license'           => 'required|mimes:pdf|max:2048',
                    'vehicle_rc'                => 'required|mimes:pdf|max:2048',
                    'matriculation_marksheet'   => 'required|mimes:pdf|max:2048',
                    'intermediate_marksheet'    => 'required|mimes:pdf|max:2048',
                    'graduation_marksheet'      => 'required|mimes:pdf|max:2048',
                    'screenshot_of_payment'     => 'required|mimes:jpg,jpeg,png|max:2048',

                    // Multi selection
                    'video_id'  => 'required|array',
                    'video_id.*' => 'integer|exists:master_videos,id',

                    'bonus_id'  => 'required|array',
                    'bonus_id.*' => 'integer|exists:master_yearly_bonuses,id',

                    // financial fields
                    'security_money'     => 'required|numeric|min:0',
                    'uniform'            => 'required|numeric|min:0',
                    'shoe'               => 'required|numeric|min:0',
                    'sewing_charge'      => 'required|numeric|min:0',
                    'insurance'          => 'required|numeric|min:0',
                    'coat'               => 'required|numeric|min:0',
                    'training'           => 'required|numeric|min:0',
                    'i_card'             => 'required|numeric|min:0',

                    'staff_incentive'             => 'required|numeric|min:0',

                    // officer assignment
                    'reporting_officer'          => 'required|integer',
                    'trainer_officer'            => 'required|integer',
                    'home_verification_officer'  => 'required|integer',
                    'junior_office_employee'     => 'required|integer',
                ]);

                // -------------------------
                // FILE UPLOAD HANDLING
                // -------------------------
                $uploadPath = public_path('uploads/user_documents');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                // Helper Function


                // Upload all files
                $aadhar      = uploadFile($request->aadhar_card, 'aadhar', $uploadPath);
                $pan         = uploadFile($request->pan_card, 'pan', $uploadPath);
                $dl          = uploadFile($request->driving_license, 'driving_license', $uploadPath);
                $vehicle_rc  = uploadFile($request->vehicle_rc, 'vehicle_rc', $uploadPath);
                $matric      = uploadFile($request->matriculation_marksheet, 'matric', $uploadPath);
                $inter       = uploadFile($request->intermediate_marksheet, 'intermediate', $uploadPath);
                $graduation  = uploadFile($request->graduation_marksheet, 'graduation', $uploadPath);
                $payment_ss  = uploadFile($request->screenshot_of_payment, 'payment', $uploadPath);

                // -------------------------
                // SAVE USER DETAILS
                //--------------------------
                $userDetail = new UserDetail();
                $userDetail->user_id = $request->user_id;

                $userDetail->account_number = $request->account_number;
                $userDetail->ifsc_code = $request->ifsc_code;
                $userDetail->bank_name = $request->bank_name;
                $userDetail->branch_name = $request->branch_name;
                $userDetail->upi_details = $request->upi_details;

                // Store uploaded paths
                $userDetail->aadhar_card = $aadhar;
                $userDetail->pan_card = $pan;
                $userDetail->driving_license = $dl;
                $userDetail->vehicle_rc = $vehicle_rc;
                $userDetail->matriculation_marksheet = $matric;
                $userDetail->intermediate_marksheet = $inter;
                $userDetail->graduation_marksheet = $graduation;
                $userDetail->screenshot_of_payment = $payment_ss;

                // Finance
                $userDetail->security_money  = $request->security_money;
                $userDetail->uniform         = $request->uniform;
                $userDetail->shoe            = $request->shoe;
                $userDetail->sewing_charge   = $request->sewing_charge;
                $userDetail->insurance       = $request->insurance;
                $userDetail->coat            = $request->coat;
                $userDetail->training        = $request->training;
                $userDetail->i_card          = $request->i_card;

                // Officers
                $userDetail->reporting_officer        = $request->reporting_officer;
                $userDetail->trainer_officer          = $request->trainer_officer;
                $userDetail->home_verification_officer = $request->home_verification_officer;
                $userDetail->junior_office_employee   = $request->junior_office_employee;

                // location verification
                $userDetail->branch    = $request->branch;
                $userDetail->to_city         = $request->to_city;
                $userDetail->km1         = $request->km1;

                $userDetail->city       = $request->city;
                $userDetail->to_village       = $request->to_village;
                $userDetail->km2       = $request->km2;

                $userDetail->village       = $request->village;
                $userDetail->to_home       = $request->to_home;
                $userDetail->km3       = $request->km3;

                $userDetail->ward_member_name       = $request->ward_member_name;
                $userDetail->near_by       = $request->near_by;
                $userDetail->mark_of_identification       = $request->mark_of_identification;
                $userDetail->staff_incentive   = $request->staff_incentive;

                $userDetail->save();

                // -------------------------
                // SAVE ASSIGNED VIDEOS
                // -------------------------
                if ($request->video_id) {
                    foreach ($request->video_id as $vid) {
                        DB::table('user_assigned_videos')->insert([
                            'user_id' => $request->user_id,
                            'video_id' => $vid,
                            'assigned_date' => date('Y-m-d'),
                            'status' => 1,
                            'created_at' => now(),
                        ]);
                    }
                }

                // -------------------------
                // SAVE ASSIGNED BONUSES
                // -------------------------
                if ($request->bonus_id) {
                    foreach ($request->bonus_id as $bid) {
                        DB::table('user_assigned_bonuses')->insert([
                            'user_id' => $request->user_id,
                            'bonus_id' => $bid,
                            'assigned_date' => date('Y-m-d'),
                            'status' => 1,
                            'created_at' => now(),
                        ]);
                    }
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Employee details saved successfully',
                    'redirect_url' => url('admin/user-list')
                ]);

            } catch (\Illuminate\Validation\ValidationException $e) {

                return response()->json([
                    'status' => false,
                    'errors' => $e->validator->errors()
                ], 422);

            } catch (\Exception $e) {

                return response()->json([
                    'status' => false,
                    'line' => $e->getLine(),
                    'file' => $e->getFile(),
                    'message' => $e->getMessage()
                ], 500);
            }
        }


    public function viewEmployeeDetails($id){
        try {

                // Fetch main details
                $userDetail = UserDetail::where('user_id', $id)->first();
                 $staff = $this->saleRepository->findStaff($id);
                // dd($userDetail);
                // if (!$userDetail) {
                //     return abort(404, "User detail not found");
                // }

                // ------------------------------------------
                // Fetch assigned videos for pre-select
                // ------------------------------------------
                $assignedVideos = DB::table('user_assigned_videos')
                                    ->where('user_id', $id)
                                    ->pluck('video_id')
                                    ->toArray();   // convert to array for checkbox pre-check

                // Fetch all videos
                // ------------------------------------------
                // Fetch assigned bonuses for pre-select
                // ------------------------------------------
                $assignedBonuses = DB::table('user_assigned_bonuses')
                                    ->where('user_id', $id)
                                    ->pluck('bonus_id')
                                    ->toArray();

                // Fetch all bonuses
                // $bonusList = DB::table('master_yearly_bonuses')->select('id', 'bonus_name')->get();

                 if($staff->user_type_id == 1){
                        $pgTitle = 'Update Admin';
                    }elseif($staff->user_type_id == 2){
                        $pgTitle = 'Update Branch Manager';
                    }elseif($staff->user_type_id == 5){
                        $pgTitle = ' Update Employee    ';
                    }elseif($staff->user_type_id == 6){
                        $pgTitle = 'Update BDM';
                    }else{
                        $pgTitle = 'Update Vivah Mitra';
                    }


                // ------------------------------------------
                // Pass data to view
                // ------------------------------------------
                return view('admin.staffs.update_employee_details', [
                    'page_title' => $pgTitle,
                    'reporting_officer' =>  User::where('branch', $staff->branch)->where('user_type_id', 5)->where('user_designation_id', 17)->get(),
                    'trainer_officer' =>  User::where('branch', $staff->branch)->where('user_type_id', 5)->where('user_designation_id', 16)->get(),
                    'home_verification' =>  User::where('branch', $staff->branch)->where('user_type_id', 5)->where('user_designation_id', 18)->get(),
                    'junior_office_employee' =>  User::where('branch', $staff->branch)->where('user_type_id', 5)->where('user_designation_id', 15)->get(),
                    'staff' =>  $staff,
                    'userDetail' => $userDetail,
                    // 'videoList' => $videoList,
                    'video_list' =>  MasterVideo::where('user_type', $staff->user_type_id)->where('user_designation', $staff->user_designation_id)->get(),
                    'assignedVideos' => $assignedVideos,
                    // 'bonusList' => $bonusList,
                    'assignedBonuses' => $assignedBonuses,
                    'yearly_bonus_list' =>  MasterYearlyBonus::where('user_type', $staff->user_type_id)->where('user_designation', $staff->user_designation_id)->get(),
                ]);

        } catch (\Exception $e) {
                dd($e->getMessage());
                return back()->with([
                    'error' => "Something went wrong: " . $e->getMessage(),
                ]);
        }
    }

    public function updateEmployeeDetails(Request $request){

        try {

            // ------------------------------------------
            // VALIDATION
            // ------------------------------------------
            $validated = $request->validate([

                // Basic details
                'account_number'    => 'nullable|string|max:255',
                'ifsc_code'         => 'nullable|string|max:255',
                'bank_name'         => 'nullable|string|max:255',
                'branch_name'       => 'nullable|string|max:255',

                // Documents
                'aadhar_card'               => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
                'pan_card'                  => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
                'driving_license'           => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
                'vehicle_rc'                => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
                'matriculation_marksheet'   => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
                'intermediate_marksheet'    => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
                'graduation_marksheet'      => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
                'screenshot_of_payment'     => 'nullable|mimes:jpg,jpeg,png|max:2048',

                // Multi-select arrays
                'video_id' => 'nullable|array',
                'video_id.*' => 'integer|exists:master_videos,id',

                'bonus_id' => 'nullable|array',
                'bonus_id.*' => 'integer|exists:master_yearly_bonuses,id',

                // Financial details
                'security_money' => 'nullable|numeric|min:0',
                'uniform' => 'nullable|numeric|min:0',
                'shoe' => 'nullable|numeric|min:0',
                'sewing_charge' => 'nullable|numeric|min:0',
                'insurance' => 'nullable|numeric|min:0',
                'coat' => 'nullable|numeric|min:0',
                'training' => 'nullable|numeric|min:0',
                'i_card' => 'nullable|numeric|min:0',

                // location verification
                'branch'    => 'required|string|max:255',
                'to_city'         => 'required|string|max:255',
                'km1'         => 'required|string|max:255',

                'city'       => 'required|string|max:255',
                'to_village'       => 'required|string|max:255',
                'km2'       => 'required|string|max:255',

                'village'       => 'required|string|max:255',
                'to_home'       => 'required|string|max:255',
                'km3'       => 'required|string|max:255',

                'ward_member_name'       => 'required|string|max:255',
                'near_by'       => 'required|string|max:255',
                'mark_of_identification'       => 'required|string|max:255',

                // Officer assignment
                'reporting_officer' => 'nullable|integer',
                'trainer_officer' => 'nullable|integer',
                'home_verification_officer' => 'nullable|integer',
                'junior_office_employee' => 'nullable|integer',
            ]);

            // ------------------------------------------
            // FETCH OLD RECORD
            // ------------------------------------------
            // dd($request->id);
            $userDetail = UserDetail::findOrFail($request->id);

            // ------------------------------------------
            // UPLOAD DIRECTORY
            // ------------------------------------------
            $uploadPath = public_path('uploads/user_documents');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }


            $userDetail->aadhar_card = uploadOrKeep($request->aadhar_card,'aadhar',$uploadPath,$userDetail->aadhar_card);
            $userDetail->pan_card = uploadOrKeep($request->pan_card,'pan',$uploadPath,$userDetail->pan_card);
            $userDetail->driving_license = uploadOrKeep($request->driving_license,'driving_license',$uploadPath, $userDetail->driving_license);
            $userDetail->vehicle_rc = uploadOrKeep($request->vehicle_rc,'vehicle_rc',$uploadPath,$userDetail->vehicle_rc);
            $userDetail->matriculation_marksheet = uploadOrKeep($request->matriculation_marksheet,'matric',$uploadPath,$userDetail->matriculation_marksheet);
            $userDetail->intermediate_marksheet = uploadOrKeep($request->intermediate_marksheet,'intermediate',$uploadPath,$userDetail->intermediate_marksheet);
            $userDetail->graduation_marksheet = uploadOrKeep($request->graduation_marksheet,'graduation',$uploadPath,$userDetail->graduation_marksheet);
            $userDetail->screenshot_of_payment = uploadOrKeep($request->screenshot_of_payment,'payment',$uploadPath,$userDetail->screenshot_of_payment);

            // ------------------------------------------
            // UPDATE FIELDS
            // ------------------------------------------
            $userDetail->account_number = $request->account_number;
            $userDetail->ifsc_code = $request->ifsc_code;
            $userDetail->bank_name = $request->bank_name;
            $userDetail->branch_name = $request->branch_name;
            $userDetail->upi_details = $request->upi_details;

            // Financial
            $userDetail->security_money = $request->security_money;
            $userDetail->uniform = $request->uniform;
            $userDetail->shoe = $request->shoe;
            $userDetail->sewing_charge = $request->sewing_charge;
            $userDetail->insurance = $request->insurance;
            $userDetail->coat = $request->coat;
            $userDetail->training = $request->training;
            $userDetail->i_card = $request->i_card;

            // Officers
            $userDetail->reporting_officer = $request->reporting_officer;
            $userDetail->trainer_officer = $request->trainer_officer;
            $userDetail->home_verification_officer = $request->home_verification_officer;
            $userDetail->junior_office_employee = $request->junior_office_employee;

            // location verification
            $userDetail->branch    = $request->branch;
            $userDetail->to_city         = $request->to_city;
            $userDetail->km1         = $request->km1;

            $userDetail->city       = $request->city;
            $userDetail->to_village       = $request->to_village;
            $userDetail->km2       = $request->km2;

            $userDetail->village       = $request->village;
            $userDetail->to_home       = $request->to_home;
            $userDetail->km3       = $request->km3;

            $userDetail->ward_member_name       = $request->ward_member_name;
            $userDetail->near_by       = $request->near_by;
            $userDetail->mark_of_identification       = $request->mark_of_identification;
            $userDetail->staff_incentive   = $request->staff_incentive;

            $userDetail->save();

            // ------------------------------------------
            // UPDATE ASSIGNED VIDEOS
            // ------------------------------------------
            DB::table('user_assigned_videos')->where('user_id', $userDetail->user_id)->delete();

            if ($request->video_id) {
                foreach ($request->video_id as $vid) {
                    DB::table('user_assigned_videos')->insert([
                        'user_id' => $userDetail->user_id,
                        'video_id' => $vid,
                        'assigned_date' => date('Y-m-d'),
                        'status' => 1,
                        'created_at' => now(),
                    ]);
                }
            }

            // ------------------------------------------
            // UPDATE ASSIGNED BONUSES
            // ------------------------------------------
            DB::table('user_assigned_bonuses')->where('user_id', $userDetail->user_id)->delete();

            if ($request->bonus_id) {
                foreach ($request->bonus_id as $bid) {
                    DB::table('user_assigned_bonuses')->insert([
                        'user_id' => $userDetail->user_id,
                        'bonus_id' => $bid,
                        'assigned_date' => date('Y-m-d'),
                        'status' => 1,
                        'created_at' => now(),
                    ]);
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Employee details updated successfully!',
                'redirect_url' => url('admin/user-list'),
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'status' => false,
                'errors' => $e->validator->errors()
            ], 422);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'message' => $e->getMessage()
            ], 500);

        }

    }

    /** getting user list for setting user roles here */

     public function userRoles(Request $request)
    {
        $user_type_list =  $this->saleRepository->get_user_types();
        $designation_list =  $this->saleRepository->get_master_designations();
        $page_title = 'User/Employee List';
        $query = User::select([
            'users.*',
            'user_logins.username',
            'user_logins.password',
            'user_types.name as userType',
            'master_designations.name as designation_name',
        ])->where('users.id', '!=', 1)
            ->join('user_logins', 'user_logins.user_id', '=', 'users.id')
            ->leftJoin('user_types', 'user_types.id', '=', 'users.user_type_id')
            ->leftJoin('master_designations', 'master_designations.id', '=', 'users.user_designation_id');

            if ($request->user_type_id) {
                $query->where('users.user_type_id', $request->user_type_id);
            }

            if ($request->user_designation_id) {
                $query->where('users.user_designation_id', $request->user_designation_id);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('users.first_name', 'like', "%$search%")
                    ->orWhere('users.last_name', 'like', "%$search%")
                    ->orWhere('users.email', 'like', "%$search%")
                    ->orWhere('users.mobile', 'like', "%$search%");
                });
            }

        $users = $query->paginate(20);
        return view('admin.navigation.user_list', compact('users','user_type_list', 'designation_list', 'page_title'));
    }

    public function fetchUserRoles(Request $request)
    {
        $query = User::select([
            'users.*',
            'user_logins.username',
            'user_logins.password',
            'user_types.name as userType',
            'master_designations.name as designation_name',
        ])->where('users.id', '!=', 1)
            ->join('user_logins', 'user_logins.user_id', '=', 'users.id')
            ->leftJoin('user_types', 'user_types.id', '=', 'users.user_type_id')
            ->leftJoin('master_designations', 'master_designations.id', '=', 'users.user_designation_id');


        if ($request->user_type_id) {
            $query->where('users.user_type_id', $request->user_type_id);
        }

        if ($request->user_designation_id) {
            $query->where('users.user_designation_id', $request->user_designation_id);
        }

        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('users.first_name', 'like', "%$search%")
                ->orWhere('users.last_name', 'like', "%$search%")
                ->orWhere('users.email', 'like', "%$search%")
                ->orWhere('users.mobile', 'like', "%$search%");
            });
        }

        $users = $query->paginate(20);

        if ($request->ajax()) {
            return view('admin.navigation.partials.user_table_ajax', compact('users'))->render();
        }
    }

    public function generateVivahMitraCode(Request $request){
        // MasterVivahmitraCode
        // dd($request);
           $query = MasterVivahmitraCode::select([
                'master_vivahmitra_codes.*',
                'users.first_name as addedByName',
                'vm.first_name as leaderName',
                'vm.id as vivahMitraId',
                'vm.branch as branch',
            ])
            ->join('users', 'users.id', '=', 'master_vivahmitra_codes.created_by')
            ->leftJoin('users as vm', 'vm.id', '=', 'master_vivahmitra_codes.user_id');

            if ($request->branch) {
                $query->where('vm.branch', $request->branch);
            }
            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_vivahmitra_codes.employee_code', 'like', "%$search%")
                    ->orWhere('master_vivahmitra_codes.employee_code', 'like', "%$search%");
                });
            }

            $membership_list = $query
                ->orderBy('master_vivahmitra_codes.id', 'DESC')
                ->paginate(20)
                ->withQueryString();
        $datas = [
            'branch_list' =>  Branch::where('status', 1)->get(),
            'membership_list' => $membership_list,
            'request' => $request,
            'page_title' => 'Generate Vivah Mitra Code',
        ];
        return view('admin.staffs.vivah_mitra.index', $datas);
    }

    public function fetchVivahMitraCodes(Request $request)
    {
        // dd('I am here');
       $query = MasterVivahmitraCode::select([
            'master_vivahmitra_codes.*',
            'users.first_name as addedByName',
            'vm.first_name as leaderName',
            'vm.id as vivahMitraId',
            'vm.branch as branch',
        ])
        ->join('users', 'users.id', '=', 'master_vivahmitra_codes.created_by')
        ->leftJoin('users as vm', 'vm.id', '=', 'master_vivahmitra_codes.user_id');
        if ($request->branch) {
            $query->where('vm.branch', $request->branch);
        }
            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_vivahmitra_codes.employee_code', 'like', "%$search%")
                    ->orWhere('master_vivahmitra_codes.employee_code', 'like', "%$search%");
                });
            }

            $membership_list = $query
                ->orderBy('master_vivahmitra_codes.id', 'DESC')
                ->paginate(20)
                ->withQueryString();
            // dd($membership_list);
        if ($request->ajax()) {
            return view('admin.staffs.vivah_mitra.table_ajax', compact('membership_list'))->render();
        }
    }

    public function saveVivahMitraCode(Request $request){
        $request->validate([
            'number'        => 'required|numeric|min:1|max:5',
            'created_date'  => 'required|date',
        ]);
        $count = (int) $request->number;  // How many membership numbers to generate
        $generated = [];

        for ($i = 0; $i < $count; $i++) {

            do {
                // Generate random 7 digits
                $random = mt_rand(1000000, 9999999);
                // Final 9 digit code starting with 14
                $newCode = "14" . $random;
                // Check if already exists
                $exists = MasterVivahmitraCode::where('employee_code', $newCode)->exists();
            } while ($exists);

            // Save into DB
            MasterVivahmitraCode::create([
                'employee_code' => $newCode,
                'created_date'      => $request->created_date,
                'created_by'        => session('LoggedUser')->id,
            ]);

            $generated[] = $newCode;
        }

        return response()->json([
            'status' => true,
            'message'  => 'Vivah Mitra Code generated successfully!',
            'generated_codes' => $generated  // optional, shows generated numbers
        ]);
    }

    public function addVivahMitra($code){
        // dd($code);
        $datas = [
            'page_title' => 'Vivah Mitra',
            'state_list' =>  State::get(),
            'branch_list' =>  Branch::where('status', 1)->get(),
            'session_list' =>  Session::where('status', 1)->get(),
            'user_type_list' =>  $this->saleRepository->get_user_types(),
            'designation_list' =>  $this->saleRepository->get_master_designations(),
            'employee_code' =>  $code,
        ];
        return view('admin.staffs.vivah_mitra.add_vivah_mitra', $datas);
    }

    public function storeVivahMitraData(Request $request){
        // dd($request->all());

        $data = $request->validate([
            'branch' => 'required',
            'session' => 'required',
            // 'user_type_id' => 'required',
            // 'user_designation_id' => 'required',
            'name' => 'required',
            'mobile' => 'required',
            'mobile' => 'required|unique:users',
            'email' => 'required|unique:users',
            'status' => 'required',
            'password' => 'required',
            'address' => 'required',
            'experience' => 'required',
            'state' => 'required',
            'city' => 'required',
            'working_hour' => 'required',
            // 'salary' => 'required',
            'training_fee' => 'required',
            'employee_code' => 'required',
        ]);

        $user = new User();
        $user->branch = $data['branch'];
        $user->session = $data['session'];
        $user->first_name = $data['name'];
        $user->mobile = $data['mobile'];
        $user->email = $data['email'];
        $user->state = $data['state'];
        $user->address = $data['address'];
        $user->city = $data['city'];
        // $user->salary = $data['salary'];
        $user->training_fee = $data['training_fee'];
        $user->working_hour = $data['working_hour'];
        $user->experience = $data['experience'];
        $user->employee_code = $data['employee_code'];
        $user->user_type_id = 6;
        $user->user_designation_id = 7;
        $user->save();


            // -----------------------------
            // CREATE WALLET FOR EMPLOYEE
            // -----------------------------
            Wallet::firstOrCreate(
                [
                    'owner_type' => 'employee',
                    'owner_id'   => $user->id
                ],
                [
                    'balance' => 0
                ]
            );

            EWallet::firstOrCreate(
                [
                    'owner_type' => 'employee',
                    'owner_id'   => $user->id
                ],
                [
                    'balance' => 0
                ]
            );

        $userLogin = new UserLogin();
        $userLogin->user_id = $user->id;
        $userLogin->username = $data['mobile'];
        $userLogin->password = $data['password'];
        $userLogin->user_type_id = 6;
        $userLogin->status = $data['status'];
        $userLogin->save();

            DB::table('master_vivahmitra_codes')
                ->where('employee_code', $request->employee_code)
                ->update([
                    'is_used' => 1,
                    'status' => 1,
                    'user_id' => $user->id,
                    // 'leader_id' => $request->leader_id,
                    'used_date' => date('Y-m-d')
                ]);

        $data['created_by'] = session('LoggedUser')->id;
        return redirect()->route('admin.staffs.generateVivahMitraCode')->with(session()->flash('alert-success', 'Added Successfully'));
    }

     public function vivahMitraList(Request $request)
    {
        $user_type_list =  $this->saleRepository->get_user_types();
        $designation_list =  $this->saleRepository->get_master_designations();
        $page_title = 'Vivah Miitra List';
        $query = User::select([
            'users.*',
            'user_logins.username',
            'user_logins.password',
            'user_types.name as userType',
            'master_designations.name as designation_name',
        ])->where('users.id', '!=', 1)->where('users.user_type_id', 6)
            ->join('user_logins', 'user_logins.user_id', '=', 'users.id')
            ->leftJoin('user_types', 'user_types.id', '=', 'users.user_type_id')
            ->leftJoin('master_designations', 'master_designations.id', '=', 'users.user_designation_id');

            if ($request->user_type_id) {
                $query->where('users.user_type_id', $request->user_type_id);
            }

            if ($request->user_designation_id) {
                $query->where('users.user_designation_id', $request->user_designation_id);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('users.first_name', 'like', "%$search%")
                    ->orWhere('users.last_name', 'like', "%$search%")
                    ->orWhere('users.email', 'like', "%$search%")
                    ->orWhere('users.mobile', 'like', "%$search%");
                });
            }

            $users = $query->paginate(20);

        return view('admin.staffs.index', compact('users','user_type_list', 'designation_list', 'page_title'));
    }

    public function fetchVivahMitra(Request $request)
    {
        $query = User::select([
            'users.*',
            'user_logins.username',
            'user_logins.password',
            'user_types.name as userType',
            'master_designations.name as designation_name',
        ])->where('users.id', '!=', 1)->where('users.user_type_id', 6)
            ->join('user_logins', 'user_logins.user_id', '=', 'users.id')
            ->leftJoin('user_types', 'user_types.id', '=', 'users.user_type_id')
            ->leftJoin('master_designations', 'master_designations.id', '=', 'users.user_designation_id');

            if ($request->user_type_id) {
                $query->where('users.user_type_id', $request->user_type_id);
            }

            if ($request->user_designation_id) {
                $query->where('users.user_designation_id', $request->user_designation_id);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('users.first_name', 'like', "%$search%")
                    ->orWhere('users.last_name', 'like', "%$search%")
                    ->orWhere('users.email', 'like', "%$search%")
                    ->orWhere('users.mobile', 'like', "%$search%");
                });
            }

            $users = $query->paginate(20);

        if ($request->ajax()) {
            return view('admin.staffs.partials.user_table', compact('users'))->render();
        }
    }

    public function getEmployeesList(Request $request)
    {
        $currentBranch = current_branch();
        // dd($checkBranch);
        $employees = User::where('user_type_id', $request->user_type_id)
            ->where('user_designation_id', $request->designation_id)
            ->where('status', 1)
            ->where('branch', $currentBranch)
            ->select('id', 'first_name', 'employee_code')
            ->get();

        return response()->json($employees);
    }

    public function getBranchManagerList(Request $request)
    {
        $employees = User::where('user_type_id', $request->user_type_id)
            ->where('branch', $request->branch)
            ->where('status', 1)
            ->select('id', 'first_name', 'employee_code')
            ->get();

        return response()->json($employees);
    }

    public function viewVivahMitraMemberships($id){
        dd($id);
    }

    public function checkEmployee(Request $request)
    {
        $request->validate([
            'employee_code' => 'required'
        ]);

        $user = User::select(
                        'users.*',
                        'states.name as state_name',
                        'districts.name as district_name'
                    )
                    ->leftJoin('states', 'states.id', '=', 'users.state')
                    ->leftJoin('districts', 'districts.id', '=', 'users.city')
                    ->where('users.employee_code', $request->employee_code)
                    ->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Vivah Mitra not found'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'name'   => trim($user->first_name . ' ' . $user->last_name),
                'mobile' => $user->mobile,
                'email'  => $user->email,
                'address'   => $user->address,
                'state'     => $user->state_name,
                'district'  => $user->district_name,
                'code'   => $user->employee_code,
                'gender' => $user->gender,
                'photo'  => $user->profile_pic
                            ? static_asset($user->profile_pic)
                            : static_asset('assets/assets_admin/images/faces/user.png'),
            ]
        ]);
    }

    public function checkMembership(Request $request)
    {
        $request->validate([
            'membership_number' => 'required'
        ]);

        $member = Member::where('membership_number', $request->membership_number)->first();

        if (!$member) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Membership Number'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'name' => $member->name,
            ]
        ]);
    }

    public function incentiveSale(){
        $datas = [
            'page_title' => 'Vivah Mitra',
            'state_list' =>  State::get(),
            'branch_list' =>  Branch::where('status', 1)->get(),
            'session_list' =>  Session::where('status', 1)->get(),
            'user_type_list' =>  $this->saleRepository->get_user_types(),
            'designation_list' =>  $this->saleRepository->get_master_designations(),
            // 'employee_code' =>  $code,
            'categories' =>  ProductCategory::whereNull('parent_id')->with('childrenRecursive')->get(),
            'sales_manager' =>  User::where('user_type_id', 5)->where('user_designation_id', 1)->where('status', 1)->get(),
            'assistant_sales_manager' =>  User::where('user_type_id', 5)->where('user_designation_id', 21)->where('status', 1)->get(),
            'field_officer' =>  User::where('user_type_id', 5)->where('user_designation_id', 20)->where('status', 1)->get(),
            'zonal_manager' =>  User::where('user_type_id', 5)->where('user_designation_id', 22)->where('status', 1)->get(),
            'zonal_manager' =>  User::where('user_type_id', 5)->where('user_designation_id', 22)->where('status', 1)->get(),
            'peon' =>  User::where('user_type_id', 5)->where('user_designation_id', 4)->where('status', 1)->get(),
            'district_vivah_mitra' =>  User::where('user_type_id', 6)->where('user_designation_id', 10)->where('status', 1)->get(),
            'prakhand_vivah_mitra' =>  User::where('user_type_id', 6)->where('user_designation_id', 9)->where('status', 1)->get(),
            'panchayat_vivah_mitra' =>  User::where('user_type_id', 6)->where('user_designation_id', 8)->where('status', 1)->get(),
            // 'panchayat_vivah_mitra' =>  User::where('user_type_id', 6)->where('user_designation_id', 8)->where('status', 1)->get(),
        ];
        return view('admin.sale.add_sale_incentive', $datas);
    }

    // public function getProductListTypeBranchWise(Request $request){
    //     $loggedBranch = current_branch();
    //     return BranchProduct::where('branch_id', $loggedBranch)->where('category', $request->category)->get();
    // }


    public function getProductListTypeBranchWise(Request $request)
    {
        $loggedBranch = current_branch();
        // dd($loggedBranch);
        $products = BranchProduct::select(
                'branch_products.*',
                'products.name as product_name',
            )
            ->leftJoin('products', 'products.id', '=', 'branch_products.product_id')
            ->where('branch_products.branch_id', $loggedBranch)
            ->where('branch_products.category', $request->category)
            ->get();

        return $products;
    }

    public function getBranchProductDetails(Request $request)
	{
		$product = DB::table('branch_products')->where('product_id', $request->product_id)->first();
        if ($product) {
			return response()->json([
				'offer_price' => $product->offer_price,
				'price_45' => $product->price_45,
				'price_50' => $product->price_50,
				'price_62' => $product->price_62,
				'price_80' => $product->price_80,
            ]);
		}
        return response()->json(['error' => 'Product not found'], 404);
	}

    public function postIncentiveSaleOld(Request $request){
        DB::beginTransaction();

        try {

            $saleAmount = $request->grand_total;
            $saleType   = 'incentive_sale'; // cash_sale / incentive_sale

            // Logged-in user (company / branch manager)
            $companyId = session('LoggedUser')->user_id;
            $companyWallet = getWallet('branch', $companyId);

            // Employee (Vivah Mitra)
            $employee = User::where('employee_code', $request->employee_code)->firstOrFail();
            $employeeWallet = getWallet('employee', $employee->id);

            $vivah_mitra_incentive = MasterDesignation::where('id', 7)->value('incentive');
            $panchayat_mitra_incentive = MasterDesignation::where('id', 8)->value('incentive');
            $prakhand_mitra_incentive = MasterDesignation::where('id', 9)->value('incentive');
            $district_mitra_incentive = MasterDesignation::where('id', 10)->value('incentive');

            $branch_manager_incentive = MasterDesignation::where('id', 6)->value('incentive');
            $sales_manager_incentive = MasterDesignation::where('id', 1)->value('incentive');
            $assiatant_sales_manager_incentive = MasterDesignation::where('id', 21)->value('incentive');
            $field_officer_incentive = MasterDesignation::where('id', 20)->value('incentive');
            $zonal_manager_incentive = MasterDesignation::where('id', 22)->value('incentive');
            $peon_incentive = MasterDesignation::where('id', 4)->value('incentive');

            /* -----------------------------
            1️⃣ Check Wallet Balance
            ----------------------------- */
            if ($companyWallet->balance < $saleAmount) {
                return response()->json([
                    'status' => false,
                    'message' => 'Insufficient funds available!'
                ]);
            }

            /* -----------------------------
            2️⃣ Incentive Calculation
            ----------------------------- */

            $companyId = session('LoggedUser')->user_id;
            $companyEWallet = getEWallet('branch', $companyId);

            $vivahMitraEWallet = getEWallet('employee', $employee->id);
            $salesManagerEWallet = getEWallet('employee', $request->sales_manager);
            $assistant_salesManagerEWallet = getEWallet('employee', $request->assistant_sales_manager);
            $field_officer_EWallet = getEWallet('employee', $request->field_officer);
            $peon_EWallet = getEWallet('employee', $request->peon);
            $zonal_manager_EWallet = getEWallet('employee', $request->zonal_manager);

            $panchayat_vivah_mitra_EWallet = getEWallet('employee', $request->panchayat_vivah_mitra);
            $prakhand_vivah_mitra_EWallet = getEWallet('employee', $request->prakhand_vivah_mitra);
            $district_vivah_mitra_EWallet = getEWallet('employee', $request->district_vivah_mitra);

            $incentiveAmount = 0;

            if ($saleType === 'incentive_sale') {
                $saleAmount = (float) $saleAmount;
                /** branch manager incentive */
                $branch_manager_incentive = (float) $branch_manager_incentive;
                $branch_manager_incentiveAmount = round(($saleAmount * $branch_manager_incentive) / 100, 2);

                /** sales manager incentive */
                $sales_manager_incentive = (float) $sales_manager_incentive;
                $sales_manager_incentiveAmount = round(($saleAmount * $sales_manager_incentive) / 100, 2);

                /** assistant sales manager incentive */
                $assistant_sales_manager_incentive = (float) $assistant_sales_manager_incentive;
                $assistant_sales_manager_incentiveAmount = round(($saleAmount * $assistant_sales_manager_incentive) / 100, 2);

                /** field officer incentive */
                $field_officer_incentive = (float) $field_officer_incentive;
                $field_officer_incentiveAmount = round(($saleAmount * $field_officer_incentive) / 100, 2);

                /** zonal manager incentive */
                $zonal_manager_incentive = (float) $zonal_manager_incentive;
                $zonal_manager_incentiveAmount = round(($saleAmount * $zonal_manager_incentive) / 100, 2);

                /** peon incentive */
                $peon_incentive = (float) $peon_incentive;
                $peon_incentiveAmount = round(($saleAmount * $peon_incentive) / 100, 2);

                /** vivah mitra incentive */
                $vivah_mitra_incentive = (float) $vivah_mitra_incentive;
                $vivah_mitra_incentiveAmount = round(($saleAmount * $vivah_mitra_incentive) / 100, 2);

                /** panchayat vivah mitra incentive */
                $panchayat_vivah_mitra_incentive = (float) $panchayat_vivah_mitra_incentive;
                $panchayat_vivah_mitra_incentiveAmount = round(($saleAmount * $panchayat_vivah_mitra_incentive) / 100, 2);

                /** prakhand vivah mitra incentive */
                $prakhand_vivah_mitra_incentive = (float) $prakhand_vivah_mitra_incentive;
                $prakhand_vivah_mitra_incentiveAmount = round(($saleAmount * $prakhand_vivah_mitra_incentive) / 100, 2);

                /** district_mitra_incentive vivah mitra incentive */
                $district_mitra_incentive = (float) $district_mitra_incentive;
                $district_mitra_incentiveAmount = round(($saleAmount * $district_mitra_incentive) / 100, 2);

                $incentiveAmount = $branch_manager_incentiveAmount
                                    + $sales_manager_incentiveAmount
                                    + $assistant_sales_manager_incentiveAmount
                                    + $field_officer_incentiveAmount
                                    + $zonal_manager_incentiveAmount
                                    + $peon_incentiveAmount
                                    + $vivah_mitra_incentiveAmount
                                    + $panchayat_vivah_mitra_incentiveAmount
                                    + $prakhand_vivah_mitra_incentiveAmount
                                    + $district_mitra_incentiveAmount;

            }

            /* -----------------------------
            3️⃣ Save Sale
            ----------------------------- */
            $sale = Sale::create([
                'branch'           => current_branch(),
                'sale_type'        => $saleType,
                'employee_id'      => loggedCompany(),
                'vivah_mitra_id'   => $employee->id,
                'panchayat_vivah_mitra'   => $request->panchayat_vivah_mitra,
                'prakhand_vivah_mitra'   => $request->prakhand_vivah_mitra,
                'district_vivah_mitra'   => $request->district_vivah_mitra,
                'sales_manager'   => $request->sales_manager,
                'assistant_sales_manager'   => $request->assistant_sales_manager,
                'field_officer'   => $request->field_officer,
                'zonal_manager'   => $request->zonal_manager,
                'peon'   => $request->peon,
                'member_id'        => $request->membership_number
                                        ? Member::where('membership_number', $request->membership_number)->value('id')
                                        : null,
                'sale_date'        => $request->sale_date,
                'total_amount'     => $saleAmount,
                'incentive_amount' => $incentiveAmount,
            ]);

            /* -----------------------------
            4️⃣ Save Sale Items + Stock Deduction
            ----------------------------- */
            foreach ($request->product_id as $key => $productId) {
                $productName = Product::where('id', $productId)->value('name');
                SaleItem::create([
                    'sale_id'     => $sale->id,
                    'product_id'  => $productId,
                    'price'       => $request->price[$key],
                    'offer_price' => $request->offer_price[$key],
                    'quantity'    => $request->quantity[$key],
                    'total'       => $request->total[$key],
                ]);

                // Deduct stock from branch_products
                BranchProduct::where([
                    'branch_id'  => current_branch(),
                    'product_id' => $productId
                ])->decrement('stock', $request->quantity[$key]);
            }

            /* -----------------------------
            5️⃣ Wallet Transactions
            ----------------------------- */

            // Debit company
            debitWallet(
                $companyWallet,
                $saleAmount,
                "Sale Amount Deducted | Sale ID: {$sale->id}"
            );

            // Credit incentive
            if ($branch_manager_incentiveAmount > 0) {

               $member_details =  Member::where('membership_number', $request->membership_number)->first();

                $credit_type = 'product_sale_incentive';
                creditEWallet($companyEWallet,$branch_manager_incentiveAmount,$credit_type, "Sale Incentive | Member: {$member_details->name} | Membership No: {$member_details->membership_number} | Product: {$productName} | Product Price: {$saleAmount}");
                creditEWallet($vivahMitraEWallet,$vivah_mitra_incentiveAmount,$credit_type, "Sale Incentive | Member: {$member_details->name} | Membership No: {$member_details->membership_number} | Product: {$productName} | Product Price: {$saleAmount}");
                creditEWallet($salesManagerEWallet,$sales_manager_incentiveAmount, "Sale Incentive | Member: {$member_details->name} | Membership No: {$member_details->membership_number} | Product: {$productName} | Product Price: {$saleAmount}");
                creditEWallet($assistant_salesManagerEWallet,$assistant_sales_manager_incentiveAmount,$credit_type, "Sale Incentive | Member: {$member_details->name} | Membership No: {$member_details->membership_number} | Product: {$productName} | Product Price: {$saleAmount}");
                creditEWallet($field_officer_EWallet,$field_officer_incentiveAmount,$credit_type, "Sale Incentive | Member: {$member_details->name} | Membership No: {$member_details->membership_number} | Product: {$productName} | Product Price: {$saleAmount}");
                creditEWallet($zonal_manager_EWallet,$zonal_manager_incentiveAmount,$credit_type, "Sale Incentive | Member: {$member_details->name} | Membership No: {$member_details->membership_number} | Product: {$productName} | Product Price: {$saleAmount}");
                creditEWallet($peon_EWallet,$peon_incentiveAmount,$credit_type, "Sale Incentive | Member: {$member_details->name} | Membership No: {$member_details->membership_number} | Product: {$productName} | Product Price: {$saleAmount}");
                creditEWallet($panchayat_vivah_mitra_EWallet,$panchayat_vivah_mitra_incentiveAmount,$credit_type, "Sale Incentive | Member: {$member_details->name} | Membership No: {$member_details->membership_number} | Product: {$productName} | Product Price: {$saleAmount}");
                creditEWallet($prakhand_vivah_mitra_EWallet,$prakhand_vivah_mitra_incentiveAmount,$credit_type, "Sale Incentive | Member: {$member_details->name} | Membership No: {$member_details->membership_number} | Product: {$productName} | Product Price: {$saleAmount}");
                creditEWallet($district_vivah_mitra_EWallet,$district_mitra_incentiveAmount,$credit_type, "Sale Incentive | Member: {$member_details->name} | Membership No: {$member_details->membership_number} | Product: {$productName} | Product Price: {$saleAmount}");



            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Sale completed successfully',
                'sale_id' => $sale->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Sale failed',
                'error'   => $e->getMessage()
            ]);
        }
    }

    public function postIncentiveSale(Request $request)
    {
        DB::beginTransaction();

        try {

            /* -------------------------------------------------
            1 Basic Setup
            ------------------------------------------------- */

            $saleAmount = (float) $request->grand_total;
            $saleType   = 'incentive_sale';

            $companyId     = session('LoggedUser')->user_id;
            $companyWallet = getWallet('branch', $companyId);

            if ($companyWallet->balance < $saleAmount) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Insufficient funds available!'
                ]);
            }

            /* -------------------------------------------------
            2 Fetch Employee + Member (single queries only)
            ------------------------------------------------- */

            $employee = User::where('employee_code', $request->employee_code)->firstOrFail();

            $member = null;
            if ($request->membership_number) {
                $member = Member::where('membership_number', $request->membership_number)->first();
            }

            /* -------------------------------------------------
            3 Load ALL incentives in ONE query (performance++)
            ------------------------------------------------- */

            $designationIds = [1,4,6,7,8,9,10,20,21,22];

            $designations = MasterDesignation::whereIn('id', $designationIds)
                            ->pluck('incentive', 'id'); // [id => percent]

            /* -------------------------------------------------
            4 Wallet Mapping (SUPER CLEAN)
            ------------------------------------------------- */

            $walletMap = [

                6  => getEWallet('branch', $companyId),

                7  => getEWallet('employee', $employee->id),
                1  => getEWallet('employee', $request->sales_manager),
                21 => getEWallet('employee', $request->assistant_sales_manager),
                20 => getEWallet('employee', $request->field_officer),
                22 => getEWallet('employee', $request->zonal_manager),
                4  => getEWallet('employee', $request->peon),

                8  => getEWallet('employee', $request->panchayat_vivah_mitra),
                9  => getEWallet('employee', $request->prakhand_vivah_mitra),
                10 => getEWallet('employee', $request->district_vivah_mitra),
            ];

            /* -------------------------------------------------
            5 Helper function for percentage
            ------------------------------------------------- */

            $percent = fn($amount, $p) => round(($amount * $p) / 100, 2);

            /* -------------------------------------------------
            6 Calculate Incentives (dynamic)
            ------------------------------------------------- */

            $incentives = [];
            $totalIncentive = 0;

            if ($saleType === 'incentive_sale') {

                foreach ($walletMap as $designationId => $wallet) {

                    $rate   = (float) ($designations[$designationId] ?? 0);
                    $amount = $percent($saleAmount, $rate);

                    if ($amount > 0) {
                        $incentives[] = [
                            'wallet' => $wallet,
                            'amount' => $amount
                        ];

                        $totalIncentive += $amount;
                    }
                }
            }

            /* -------------------------------------------------
            7 Save Sale
            ------------------------------------------------- */

            $sale = Sale::create([
                'branch'           => current_branch(),
                'sale_type'        => $saleType,
                'employee_id'      => loggedCompany(),
                'vivah_mitra_id'   => $employee->id,

                'panchayat_vivah_mitra' => $request->panchayat_vivah_mitra,
                'prakhand_vivah_mitra'  => $request->prakhand_vivah_mitra,
                'district_vivah_mitra'  => $request->district_vivah_mitra,

                'sales_manager'          => $request->sales_manager,
                'assistant_sales_manager'=> $request->assistant_sales_manager,
                'field_officer'          => $request->field_officer,
                'zonal_manager'          => $request->zonal_manager,
                'peon'                   => $request->peon,

                'member_id'      => $member?->id,
                'sale_date'      => $request->sale_date,
                'total_amount'   => $saleAmount,
                'incentive_amount' => $totalIncentive,
            ]);

            /* -------------------------------------------------
            8 Sale Items + Stock Deduction
            ------------------------------------------------- */

            $productNames = [];

            foreach ($request->product_id as $key => $productId) {

                $productName = Product::where('id', $productId)->value('name');
                $productNames[] = $productName;

                SaleItem::create([
                    'sale_id'     => $sale->id,
                    'product_id'  => $productId,
                    'price'       => $request->offer_price[$key],
                    'offer_price' => $request->offer_price[$key],
                    'quantity'    => $request->quantity[$key],
                    'total'       => $request->total[$key],
                ]);

                BranchProduct::where([
                    'branch_id'  => current_branch(),
                    'product_id' => $productId
                ])->decrement('stock', $request->quantity[$key]);

                 // Increase total sales
                Product::where('id', $productId)->increment('num_of_sale', $request->quantity[$key]);



            }

            $productText = implode(', ', $productNames);

            /* -------------------------------------------------
            9 Wallet Transactions
            ------------------------------------------------- */

            debitWallet(
                $companyWallet,
                $saleAmount,
                "Sale Amount Deducted | Sale ID: {$sale->id}"
            );

            $note = "Sale Incentive | Member: "
                    . ($member->name ?? '-')
                    . " | Membership: "
                    . ($member->membership_number ?? '-')
                    . " | Products: {$productText}"
                    . " | Price: {$saleAmount}";

            foreach ($incentives as $data) {
                creditEWallet($data['wallet'], $data['amount'], $note);
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Sale completed successfully',
                'sale_id' => $sale->id
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => 'Sale failed',
                'error'   => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
                'trace'   => $e->getTraceAsString(),
            ]);
        }
    }


    public function incentiveSaleList(Request $request)
    {
        // $user_type_list =  $this->saleRepository->get_user_types();
        // $designation_list =  $this->saleRepository->get_master_designations();
        $loggedBranch = current_branch();
        $loggedUser = loggedCompany();
        // dd($loggedUser);
        $vivah_mitra_list = User::where('user_type_id', 6)->where('branch', $loggedBranch)->get();
        $page_title = 'Incentive Sale List';
        $query = Sale::select([
                'sales.*',
                'branches.name as branchName',
                'vm.first_name as vivahMitraName',
                'emp.first_name as employeeName',
                'members.name as memberName',
            ])
            ->where('sales.branch', $loggedBranch)
            ->where('sales.employee_id', $loggedUser)
            ->where('sales.sale_type', 'incentive_sale')
            ->join('branches', 'branches.id', '=', 'sales.branch')
            ->leftJoin('users as vm', 'vm.id', '=', 'sales.vivah_mitra_id')
            ->leftJoin('users as emp', 'emp.id', '=', 'sales.employee_id')
            ->leftJoin('members', 'members.id', '=', 'sales.member_id');

        /* Vivah Mitra filter */
        if ($request->vivah_mitra) {
            $query->where('sales.vivah_mitra_id', $request->vivah_mitra);
        }

        /* Member filter */
        if ($request->member) {
            $query->where('sales.member_id', $request->member);
        }

        /* Date filters */
        if ($request->date_from && $request->date_to) {
            $query->whereBetween('sales.sale_date', [
                $request->date_from,
                $request->date_to
            ]);
        } elseif ($request->date_from) {
            $query->whereDate('sales.sale_date', '>=', $request->date_from);
        } elseif ($request->date_to) {
            $query->whereDate('sales.sale_date', '<=', $request->date_to);
        }

        /* Search */
        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('members.name', 'like', "%$search%")
                ->orWhere('members.mobile', 'like', "%$search%")
                ->orWhere('members.email', 'like', "%$search%");
            });
        }

        $sales_list = $query->orderBy('sales.id', 'desc')->paginate(20);

        return view('admin.sale.branch_incentive_sale_list', compact('sales_list','vivah_mitra_list', 'page_title'));
    }

   public function fetchincentiveSaleList(Request $request)
    {
        $loggedBranch = current_branch();
        $loggedUser   = loggedCompany();

        $query = Sale::select([
                'sales.*',
                'branches.name as branchName',
                'vm.first_name as vivahMitraName',
                'emp.first_name as employeeName',
                'members.name as memberName',
            ])
            ->where('sales.branch', $loggedBranch)
            ->where('sales.employee_id', $loggedUser)
            ->where('sales.sale_type', 'incentive_sale')
            ->join('branches', 'branches.id', '=', 'sales.branch')
            ->leftJoin('users as vm', 'vm.id', '=', 'sales.vivah_mitra_id')
            ->leftJoin('users as emp', 'emp.id', '=', 'sales.employee_id')
            ->leftJoin('members', 'members.id', '=', 'sales.member_id');

        /* Vivah Mitra filter */
        if ($request->vivah_mitra) {
            $query->where('sales.vivah_mitra_id', $request->vivah_mitra);
        }

        /* Member filter */
        if ($request->member) {
            $query->where('sales.member_id', $request->member);
        }

        /* Date filters */
        if ($request->date_from && $request->date_to) {
            $query->whereBetween('sales.sale_date', [
                $request->date_from,
                $request->date_to
            ]);
        } elseif ($request->date_from) {
            $query->whereDate('sales.sale_date', '>=', $request->date_from);
        } elseif ($request->date_to) {
            $query->whereDate('sales.sale_date', '<=', $request->date_to);
        }

        /* Search */
        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('members.name', 'like', "%$search%")
                ->orWhere('members.mobile', 'like', "%$search%")
                ->orWhere('members.email', 'like', "%$search%");
            });
        }

        $sales_list = $query->orderBy('sales.id', 'desc')->paginate(20);

        if ($request->ajax()) {
            return view('admin.sale.branch_incentive_sale_list_ajax', compact('sales_list'))->render();
        }
    }

    public function getMemberList(Request $request)
    {
        $currentBranch = current_branch();
        $employees = Member::select('*')
            ->where('leader_id', $request->vivah_mitra)
            ->get();

        return response()->json($employees);
    }

    public function viewSaleDetails($saleId)
    {
        // Sale master
        $sale = Sale::findOrFail($saleId);

        // Sale items with product name (JOIN)
        $saleItems = DB::table('sale_items as si')
            ->join('products as p', 'p.id', '=', 'si.product_id')
            ->where('si.sale_id', $saleId)
            ->select(
                'si.*',
                'p.name as product_name'
            )
            ->get();

        return view('admin.sale.view-sale-details', compact('sale', 'saleItems'));
    }

public function viewSaleInvoice($saleId)
{
    // Sale master with Vivah Mitra
    $sale = DB::table('sales as s')
        ->leftJoin('users as vm', 'vm.id', '=', 's.vivah_mitra_id')
        ->where('s.id', $saleId)
        ->select(
            's.*',
            'vm.first_name as vm_name',
            'vm.mobile as vm_mobile',
            'vm.address as vm_address'
        )
        ->first();

    // Sale items with product
    $saleItems = DB::table('sale_items as si')
        ->join('products as p', 'p.id', '=', 'si.product_id')
        ->where('si.sale_id', $saleId)
        ->select(
            'si.*',
            'p.name as product_name'
        )
        ->get();

    return view('admin.sale.view-invoice', compact('sale', 'saleItems'));
}






}
