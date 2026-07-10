<?php

namespace App\Http\Controllers\Admin;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use App\Models\Course;
use App\Models\Session;
use App\Models\State;
use App\Models\Branch;
use App\Models\CallLog;
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
use App\Models\EWalletTransaction;
use App\Models\MasterVivahmitraCode;
use App\Models\Member;
use App\Models\PrakhandVmBox;
use App\Models\MemberMessage;
use App\Models\PhysicalCardGiven;
use App\Models\VivahMitraTeam;
use App\Models\HomeMeetingDetail;
use App\Models\TrainingDetail;
use App\Models\SeminarGuestMettingDetail;
use App\Models\MonthlyRoutine;
use App\Models\CashEntry;
use App\Models\CashEntryDetail;
use App\Models\PaymentSubmission;
use App\Models\PaymentScreenshot;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class StaffController extends Controller
{

    private $staffRepository;

    public function __construct(StaffRepositoryInterface $staffRepository)
    {
        $this->staffRepository = $staffRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_type_list =  $this->staffRepository->get_user_types();
        $designation_list =  $this->staffRepository->get_master_designations();
        $page_title = 'Employee List';
        $total_employee = User::where('user_type_id', 5)->count();
        $total_branch = Branch::count();
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

        return view('admin.staffs.index', compact('users', 'user_type_list', 'designation_list', 'page_title', 'total_employee', 'total_branch'));
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
    public function create()
    {
        $datas = [
            'page_title' => 'Employee',
            'state_list' =>  State::get(),
            'branch_list' =>  Branch::where('status', 1)->get(),
            'session_list' =>  Session::where('status', 1)->get(),
            'user_type_list' =>  $this->staffRepository->get_user_types(),
            'designation_list' =>  $this->staffRepository->get_master_designations(),
        ];
        return view('admin.staffs.create', $datas);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
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
        } else {
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

        if ($data['user_designation_id'] == 8 || $data['user_designation_id'] == 9 || $data['user_designation_id'] == 10|| $data['user_designation_id'] == 13|| $data['user_designation_id'] == 14) {
            // PrakhandVmBox
            $dt = [];
            for ($i = 0; $i < 20; $i++) {
                $dt[] = [
                    'user_id' => $user->id,
                    'box_key' => 'BOX_' . $user->id . '_' . ($i + 1),
                ];
            }
            PrakhandVmBox::insert($dt);
        }

        $userLogin = new UserLogin();
        $userLogin->user_id = $user->id;
        $userLogin->username = $data['mobile'];
        $userLogin->password = $data['password'];
        $userLogin->user_type_id = $data['user_type_id'];
        $userLogin->status = $data['status'];
        $userLogin->save();

        $data['created_by'] = session('LoggedUser')->id;
        // $this->staffRepository->storeStaff($data);
        return redirect()->route('admin.staffs.index')->with(session()->flash('alert-success', 'Added Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = $this->staffRepository->findStaff($id);
        // dd($staff);
        if (!$staff) {
            return redirect()->route('admin.staffs.index')->with(session()->flash('alert-danger', 'Staff Not Found'));
        } else {
            if ($staff->user_type_id == 1) {
                $pgTitle = 'Admin';
            } elseif ($staff->user_type_id == 2) {
                $pgTitle = 'Branch Manager';
            } elseif ($staff->user_type_id == 5) {
                $pgTitle = 'Employee    ';
            } elseif ($staff->user_type_id == 6) {
                $pgTitle = 'BDM';
            } else {
                $pgTitle = 'Vivah Mitra';
            }

            $datas = [
                'page_title' => $pgTitle,
                'state_list' =>  State::get(),
                'branch_list' =>  Branch::where('status', 1)->get(),
                'session_list' =>  Session::where('status', 1)->get(),
                'user_type_list' =>  $this->staffRepository->get_user_types(),
                'designation_list' =>  $this->staffRepository->get_master_designations(),
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
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'branch' => 'required',
            'session' => 'required',
            'user_type_id' => 'required',
            'user_designation_id' => 'required',
            'name' => 'required',
            'mobile' => 'required',
            'in_time' => 'required',
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
        $this->staffRepository->updateStaff($data, $id);
        return redirect()->route('admin.staffs.index')->with(session()->flash('alert-success', 'Staff Updated Successfully'));
    }


    public function bdmList(Request $request)
    {
        $user_type_list =  $this->staffRepository->get_user_types();
        $designation_list =  $this->staffRepository->get_master_designations();
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

        return view('admin.staffs.bdm.index', compact('users', 'user_type_list', 'designation_list', 'page_title'));
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


    public function verifyEmployee($id)
    {
        $staff = $this->staffRepository->findStaff($id);
        // dd($staff);
        if (!$staff) {
            return redirect()->route('admin.staffs.index')->with(session()->flash('alert-danger', 'Staff Not Found'));
        } else {
            if ($staff->user_type_id == 1) {
                $pgTitle = 'Verify Admin';
            } elseif ($staff->user_type_id == 2) {
                $pgTitle = 'Verify Branch Manager';
            } elseif ($staff->user_type_id == 5) {
                $pgTitle = ' Verify Employee    ';
            } elseif ($staff->user_type_id == 6) {
                $pgTitle = 'Verify BDM';
            } else {
                $pgTitle = 'Verify Vivah Mitra';
            }

            $datas = [
                'page_title' => $pgTitle,
                'state_list' =>  State::get(),
                'branch_list' =>  Branch::where('status', 1)->get(),
                'session_list' =>  Session::where('status', 1)->get(),
                'user_type_list' =>  $this->staffRepository->get_user_types(),
                'designation_list' =>  $this->staffRepository->get_master_designations(),
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

    public function getEmployeeDetails(Request $request)
    {
        $staff = $this->staffRepository->findStaff($request->staff_id);
        return response()->json(['status' => 'success', 'data' => $staff], 200);
    }

    public function SaveEmployeePhoto(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'image_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $staff = User::where('id', $request->staff_id)->first();
        if (!$staff) {
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
            // $userDetail->verify_date   = $request->verify_date;

            $userDetail->save();

            $user_table = User::where('id', $request->user_id)->first();
            $user_table->verify_date = $request->verify_date;;
            $user_table->save();

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


    public function viewEmployeeDetails($id)
    {
        try {

            // Fetch main details
            $userDetail = UserDetail::where('user_id', $id)->first();
            $staff = $this->staffRepository->findStaff($id);
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

            if ($staff->user_type_id == 1) {
                $pgTitle = 'Update Admin';
            } elseif ($staff->user_type_id == 2) {
                $pgTitle = 'Update Branch Manager';
            } elseif ($staff->user_type_id == 5) {
                $pgTitle = ' Update Employee    ';
            } elseif ($staff->user_type_id == 6) {
                $pgTitle = 'Update BDM';
            } else {
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

    public function updateEmployeeDetails(Request $request)
    {

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


            $userDetail->aadhar_card = uploadOrKeep($request->aadhar_card, 'aadhar', $uploadPath, $userDetail->aadhar_card);
            $userDetail->pan_card = uploadOrKeep($request->pan_card, 'pan', $uploadPath, $userDetail->pan_card);
            $userDetail->driving_license = uploadOrKeep($request->driving_license, 'driving_license', $uploadPath, $userDetail->driving_license);
            $userDetail->vehicle_rc = uploadOrKeep($request->vehicle_rc, 'vehicle_rc', $uploadPath, $userDetail->vehicle_rc);
            $userDetail->matriculation_marksheet = uploadOrKeep($request->matriculation_marksheet, 'matric', $uploadPath, $userDetail->matriculation_marksheet);
            $userDetail->intermediate_marksheet = uploadOrKeep($request->intermediate_marksheet, 'intermediate', $uploadPath, $userDetail->intermediate_marksheet);
            $userDetail->graduation_marksheet = uploadOrKeep($request->graduation_marksheet, 'graduation', $uploadPath, $userDetail->graduation_marksheet);
            $userDetail->screenshot_of_payment = uploadOrKeep($request->screenshot_of_payment, 'payment', $uploadPath, $userDetail->screenshot_of_payment);

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
            // $userDetail->verify_date   = $request->verify_date;
            $userDetail->save();

            $user_table = User::where('id', $request->user_id)->first();
            $user_table->verify_date = $request->verify_date;;
            $user_table->save();

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

            /** set message */
            $user = User::find($userDetail->user_id);

            $message = "बधाई हो {$user->first_name} जी, आपकी ऑनबोर्डिंग प्रक्रिया सफलतापूर्वक पूर्ण कर दी गई है। अब आपको अगले 30 दिनों के भीतर 10 + 6 = 16 प्रखंड विभाग मित्र की बहाली सुनिश्चित करनी है। आपके उज्ज्वल एवं सफल कार्यकाल के लिए शुभकामनाएँ। धन्यवाद।";

            $userIds = [
                $user->parent_id,
                $userDetail->user_id
            ];

            // dd($userIds);

            foreach ($userIds as $uid) {
                MemberMessage::create([
                    'messages' => $message,
                    'user_id'  => $uid
                ]);
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

    public function printEmployeeFullProfile($id)
    {
        $user = DB::table('users as u')
            ->leftJoin('user_details', 'u.id', '=', 'user_details.user_id')

            ->leftJoin('users as ro', 'user_details.reporting_officer', '=', 'ro.id')
            ->leftJoin('users as to', 'user_details.trainer_officer', '=', 'to.id')
            ->leftJoin('users as ho', 'user_details.home_verification_officer', '=', 'ho.id')
            ->leftJoin('users as jo', 'user_details.junior_office_employee', '=', 'jo.id')
            ->leftJoin('user_types', 'u.user_type_id', '=', 'user_types.id')
            ->leftJoin('sessions', 'u.session', '=', 'sessions.id')

            ->leftJoin('branches', 'u.branch', '=', 'branches.id')
            ->leftJoin('states', 'u.state', '=', 'states.id')
            ->leftJoin('districts', 'u.city', '=', 'districts.id')

            ->where('u.id', $id)
            ->select(
                'u.*',
                'user_details.*',
                'branches.name as branch_name',
                'states.name as state_name',
                'districts.name as city_name',
                'user_types.name as user_type_name',
                'sessions.title as session_name',

                'ro.first_name as reporting_officer_name',
                'to.first_name as trainer_officer_name',
                'ho.first_name as home_verification_officer_name',
                'jo.first_name as junior_office_employee_name'
            )
            ->first();


        if (!$user) abort(404);
        $officers = DB::table('users')
            ->where('branch', $user->branch)
            ->where('user_type_id', 5)
            ->select('id', 'first_name', 'user_designation_id')
            ->get();
        $videos = DB::table('user_assigned_videos')
            ->join('master_videos', 'user_assigned_videos.video_id', '=', 'master_videos.id')
            ->where('user_assigned_videos.user_id', $id)
            // ->select('master_videos.video_name')
            ->get();

        $bonuses = DB::table('user_assigned_bonuses')
            ->join('master_yearly_bonuses', 'user_assigned_bonuses.bonus_id', '=', 'master_yearly_bonuses.id')
            ->where('user_assigned_bonuses.user_id', $id)
            // ->select('master_yearly_bonuses.bonus_name')
            ->get();

        return view('admin.staffs.print_full_profile', compact('user', 'officers', 'videos', 'bonuses'));
    }
    public function vivahMitraIncentive(Request $request)
    {
        $query = DB::table('users as u')
            ->join('master_designations as md', 'u.user_designation_id', '=', 'md.id')
            ->join('user_types as ut', 'u.user_type_id', '=', 'ut.id')
            ->leftJoin('e_wallets as w', function ($join) {
                $join->on('u.id', '=', 'w.owner_id')
                    ->where('w.owner_type', 'employee');
            })
            ->where('u.user_type_id', 6)
            ->where('u.user_designation_id', 7);

        if ($request->name) {
            $query->where('u.first_name', 'LIKE', '%' . $request->name . '%');
        }

        $users = $query->select(
            'u.id',
            'u.first_name',
            'u.mobile',
            'u.address',
            'u.employee_code',
            'w.id as wallet_id',

            'md.name as designation_name',

            DB::raw('IFNULL(w.balance,0) as wallet_balance')

        )->paginate(10);

        if ($request->ajax()) {
            return view('admin.staffs.incentives.vivahMitra.ajax_vivah_mitra', compact('users'))->render();
        }

        return view('admin.staffs.incentives.vivahMitra.vivah_mitra_incentive', compact('users'));
    }

    public function walletTransactionDetails(Request $request, $wallet_id)
    {
        $page_title = 'Incentive Transactions';
        $user = DB::table('e_wallets as w')
            ->join('users as u', 'u.id', '=', 'w.owner_id')
            ->select(
                'u.first_name',
                'u.mobile',
                'u.address',
                'w.balance as wallet_balance'
            )
            ->where('w.id', $wallet_id)
            ->where('w.owner_type', 'employee')
            ->first();
        $transactions = EWalletTransaction::where('wallet_id', $wallet_id)
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view(
                'admin.staffs.incentives.vivahMitra.partials.transaction_table',
                compact('transactions')
            );
        }

        return view(
            'admin.staffs.incentives.vivahMitra.details',
            compact('transactions', 'wallet_id', 'page_title', 'user')
        );
    }


    public function printUserPaymentStatement(Request $request, $wallet_id)
    {
        $page_title = 'Payment Statement';
        $user = DB::table('e_wallets as w')
            ->join('users as u', 'u.id', '=', 'w.owner_id')
            ->leftJoin('states', 'states.id', '=', 'u.state')
            ->leftJoin('districts', 'districts.id', '=', 'u.city')
            ->leftJoin('blocks', 'blocks.id', '=', 'u.block')
            ->leftJoin('panchayats', 'panchayats.id', '=', 'u.panchayat')
            ->leftJoin('master_designations', 'master_designations.id', '=', 'u.user_designation_id')
            ->select(
                'u.first_name',
                'u.mobile',
                'u.email',
                'u.employee_code',
                'u.state',
                'u.city',
                'u.block',
                'u.address',
                'u.panchayat',
                'u.created_at',
                'w.balance as wallet_balance',
                'states.name as state_name',
                'districts.name as district_name',
                'blocks.name as block_name',
                'panchayats.name as panchayat_name',
                'master_designations.name as designation_name',
            )
            ->where('w.id', $wallet_id)
            ->where('w.owner_type', 'employee')
            ->first();
        // dd($user);
        $transactions = EWalletTransaction::where('wallet_id', $wallet_id)
            ->orderBy('id', 'desc')
            ->get();

        return view(
            'admin.staffs.incentives.vivahMitra.payment_details_print', compact('transactions', 'wallet_id', 'page_title', 'user')
        );
    }


    public function panchayatVivahMitraIncentive(Request $request)
    {
        $query = DB::table('users as u')
            ->join('master_designations as md', 'u.user_designation_id', '=', 'md.id')
            ->join('user_types as ut', 'u.user_type_id', '=', 'ut.id')
            ->leftJoin('e_wallets as w', function ($join) {
                $join->on('u.id', '=', 'w.owner_id')
                    ->where('w.owner_type', 'employee');
            })
            ->where('u.user_type_id', 6)
            ->where('u.user_designation_id', 8);

        if ($request->name) {
            $query->where('u.first_name', 'LIKE', '%' . $request->name . '%');
        }

        $users = $query->select(
            'u.id',
            'u.first_name',
            'u.mobile',
            'u.address',
            'u.employee_code',
            'w.id as wallet_id',

            'md.name as designation_name',
            DB::raw('IFNULL(w.balance,0) as wallet_balance')

        )->paginate(10);

        if ($request->ajax()) {
            return view('admin.staffs.incentives.vivahMitra.ajax_panchayat_vivah_mitra', compact('users'))->render();
        }

        return view('admin.staffs.incentives.vivahMitra.panchayat_vivah_mitra', compact('users'));
    }
    public function prakhandVivahMitraIncentive(Request $request)
    {
        $query = DB::table('users as u')
            ->join('master_designations as md', 'u.user_designation_id', '=', 'md.id')
            ->join('user_types as ut', 'u.user_type_id', '=', 'ut.id')
            ->leftJoin('e_wallets as w', function ($join) {
                $join->on('u.id', '=', 'w.owner_id')
                    ->where('w.owner_type', 'employee');
            })
            ->where('u.user_type_id', 6)
            ->where('u.user_designation_id', 9);

        if ($request->name) {
            $query->where('u.first_name', 'LIKE', '%' . $request->name . '%');
        }

        $users = $query->select(
            'u.id',
            'u.first_name',
            'u.mobile',
            'u.address',
            'u.employee_code',
            'w.id as wallet_id',

            'md.name as designation_name',
            DB::raw('IFNULL(w.balance,0) as wallet_balance')

        )->paginate(10);

        if ($request->ajax()) {
            return view('admin.staffs.incentives.vivahMitra.ajax_prakhand_vivah_mitra', compact('users'))->render();
        }

        return view('admin.staffs.incentives.vivahMitra.prakhand_vivah_mitra', compact('users'));
    }
    public function jilaVivahMitraIncentive(Request $request)
    {
        $query = DB::table('users as u')
            ->join('master_designations as md', 'u.user_designation_id', '=', 'md.id')
            ->join('user_types as ut', 'u.user_type_id', '=', 'ut.id')
            ->leftJoin('e_wallets as w', function ($join) {
                $join->on('u.id', '=', 'w.owner_id')
                    ->where('w.owner_type', 'employee');
            })
            ->where('u.user_type_id', 6)
            ->where('u.user_designation_id', 10);

        if ($request->name) {
            $query->where('u.first_name', 'LIKE', '%' . $request->name . '%');
        }

        $users = $query->select(
            'u.id',
            'u.first_name',
            'u.mobile',
            'u.address',
            'u.employee_code',
            'w.id as wallet_id',

            'md.name as designation_name',
            DB::raw('IFNULL(w.balance,0) as wallet_balance') //  wallet

        )->paginate(10);

        if ($request->ajax()) {
            return view('admin.staffs.incentives.vivahMitra.ajax_jila_vivah_mitra', compact('users'))->render();
        }

        return view('admin.staffs.incentives.vivahMitra.jila_vivah_mitra', compact('users'));
    }


    /** getting user list for setting user roles here */

    public function userRoles(Request $request)
    {
        $user_type_list =  $this->staffRepository->get_user_types();
        $designation_list =  $this->staffRepository->get_master_designations();
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
        return view('admin.navigation.user_list', compact('users', 'user_type_list', 'designation_list', 'page_title'));
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

    public function generateVivahMitraCode(Request $request)
    {
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
            ->paginate(40)
            ->withQueryString();
        // dd($membership_list);
        $vivah_mitra = User::where('user_type_id', 6)->where('user_designation_id', 7)->count();
        $panchayat_mitra = User::where('user_type_id', 6)->where('user_designation_id', 8)->count();
        $prakhand_mitra = User::where('user_type_id', 6)->where('user_designation_id', 9)->count();
        $jila_mitra = User::where('user_type_id', 6)->where('user_designation_id', 10)->count();
        $datas = [
            'branch_list' =>  Branch::where('status', 1)->get(),
            'membership_list' => $membership_list,
            'request' => $request,
            'vivah_mitra' => $vivah_mitra,
            'panchayat_mitra' => $panchayat_mitra,
            'prakhand_mitra' => $prakhand_mitra,
            'jila_mitra' => $jila_mitra,
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
            ->paginate(40)
            ->withQueryString();
        // dd($membership_list);
        if ($request->ajax()) {
            return view('admin.staffs.vivah_mitra.table_ajax', compact('membership_list'))->render();
        }
    }

    public function saveVivahMitraCode(Request $request)
    {
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

    public function addVivahMitra($code)
    {
        // dd($code);
        $datas = [
            'page_title' => 'Vivah Mitra',
            'state_list' =>  State::get(),
            'branch_list' =>  Branch::where('status', 1)->get(),
            'session_list' =>  Session::where('status', 1)->get(),
            'user_type_list' =>  $this->staffRepository->get_user_types(),
            'designation_list' =>  $this->staffRepository->get_master_designations(),
            'employee_code' =>  $code,
        ];
        return view('admin.staffs.vivah_mitra.add_vivah_mitra', $datas);
    }

    public function storeVivahMitraData(Request $request)
    {
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
        $user_type_list =  $this->staffRepository->get_vivah_mitra_user_types();
        $designation_list =  $this->staffRepository->get_master_designations();
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

        $vivah_mitra = User::where('user_type_id', 6)->where('user_designation_id', 7)->count();
        $panchayat_mitra = User::where('user_type_id', 6)->where('user_designation_id', 8)->count();
        $prakhand_mitra = User::where('user_type_id', 6)->where('user_designation_id', 9)->count();
        $jila_mitra = User::where('user_type_id', 6)->where('user_designation_id', 10)->count();

        return view('admin.staffs.vivah_mitra.vivahmitra.index',
        compact('vivah_mitra','panchayat_mitra','prakhand_mitra','jila_mitra', 'users', 'user_type_list', 'designation_list', 'page_title'));
    }

    public function fetchVivahMitra(Request $request)
    {
        $query = User::select([
            'users.*',
            'user_logins.username',
            'user_logins.password',
            'user_types.name as userType',
            'master_designations.name as designation_name',
        ])->where('users.id', '!=', 1)->whereIn('users.user_type_id', [5, 6])
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
            return view('admin.staffs.vivah_mitra.vivahmitra.user_table', compact('users'))->render();
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

    public function getAllEmployeesList(Request $request)
    {
        $currentBranch = current_branch();
        // dd($checkBranch);
        $employees = User::where('user_type_id', $request->user_type_id)
            ->where('user_designation_id', $request->designation_id)
            ->where('status', 1)
            // ->where('branch', $currentBranch)
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

    public function viewVivahMitraMemberships($id)
    {
        dd($id);
    }

    public function promoteVivahMitra($id)
    {
        try {
            $staff = $this->staffRepository->findStaff($id);
            // dd($staff);
            $datas = [
                'page_title' => 'Promote Vivah Mitra',
                'state_list' =>  State::get(),
                'branch_list' =>  Branch::where('status', 1)->get(),
                'session_list' =>  Session::where('status', 1)->get(),
                'user_type_list' =>  $this->staffRepository->get_user_types(),
                'designation_list' =>  $this->staffRepository->get_master_designations(),
                'next_designation_list' =>  MasterDesignation::where('status', 1)->where('user_type', 6)->where('id', '!=', 7)->get(),
                'staff' =>  $staff,
            ];
            return view('admin.staffs.vivah_mitra.promote_vivah_mitra', $datas);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with([
                'error' => "Something went wrong: " . $e->getMessage(),
            ]);
        }
    }

    public function updateVivahMitraPromotion(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'user_id' => 'required',
                'user_designation_id' => 'required',
            ]);

            $staff = User::findOrFail($request->user_id);
            $staff->user_designation_id = $request->user_designation_id;
            $staff->save();

            return redirect()->back()->with(session()->flash('alert-success', 'Vivah Mitra promoted successfully'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with([
                'error' => "Something went wrong: " . $e->getMessage(),
            ]);
        }
    }

    public function viewTeam($id)
    {
        // manager
        $manager = User::findOrFail($id);
        $page_title = 'Team Details of ' . $manager->first_name;
        // team members (children)
        $teamMembers = User::where('parent_id', $id)
            ->orderBy('user_type_id')
            ->orderBy('first_name')
            ->get();

        return view('admin.staffs.vivah_mitra.vivahmitra.team-details', compact('manager', 'teamMembers', 'page_title'));
    }

    public function getChildren($id)
    {
        $users = User::where('parent_id', $id)
            ->select('id', 'first_name', 'last_name', 'employee_code')
            ->orderBy('first_name')
            ->get();

        return response()->json($users);
    }

    public function searchTeam(Request $request)
    {
        $keyword = $request->q;

        $users = User::where('first_name', 'like', "%$keyword%")
            ->orWhere('last_name', 'like', "%$keyword%")
            ->orWhere('employee_code', 'like', "%$keyword%")
            ->limit(20)
            ->get();

        return response()->json($users);
    }

    public function updateBlockStatus(Request $request)
    {
        // dd($request->all());


        $status = $request->status;
        $block_reason = $request->block_reason;
        $block_date = $request->block_date;
        $unblock_reason = $request->unblock_reason;
        $unblock_date = $request->unblock_date;

        $staff = User::where('id', $request->staff_id)->first();
        if (!$staff) {
            return redirect()->back()->with(session()->flash('alert-danger', 'Staff Not Found'));
        }

        $image_file_name = null;
        $uploadPath = public_path('uploads/staff');

        if ($status == 1) {
            $staff->status = 1;
            $staff->unblock_reason = $unblock_reason;
            $staff->unblock_date = $unblock_date;
        } else {
            $staff->status = 0;
            $staff->block_reason = $block_reason;
            $staff->block_date = $block_date;
        }

        $staff->save();

        $user_login = UserLogin::where('user_id', $request->staff_id)->first();
        if ($user_login) {
            $user_login->status = $status;
            $user_login->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Staff Status Updated Successfully',
        ]);

        // return redirect()->back()->with(session()->flash('alert-success', 'Employee Photo Updated Successfully'));

    }

    public function updateUnBlockDateStatus(Request $request)
    {
        // dd($request->all());


        $status = $request->unb_status;
        $created_at = $request->created_at;


        $staff = User::where('id', $request->staff_id)->first();
        if (!$staff) {
            return redirect()->back()->with(session()->flash('alert-danger', 'Staff Not Found'));
        }

        $image_file_name = null;
        $uploadPath = public_path('uploads/staff');

        if ($status == 1) {
            $staff->status = 1;
            $staff->created_at = $created_at;
        } else {
            $staff->status = 0;
            $staff->created_at = $created_at;
        }

        $staff->save();

        $user_login = UserLogin::where('user_id', $request->staff_id)->first();
        if ($user_login) {
            $user_login->status = $status;
            $user_login->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Staff Status Updated Successfully',
        ]);

        // return redirect()->back()->with(session()->flash('alert-success', 'Employee Photo Updated Successfully'));

    }

    public function adminVivahMitraLoginPost(Request $request)
    {
        $request->validate([
            'username' => 'required|numeric',
            'password' => 'required',
        ]);
        $token = Str::random(60);
        $user = UserLogin::where('username', $request->username)->first();
        // dd($user);
        if ($user) {
            //  If passwords are plain text in DB (like in your screenshot)
            if ($user->password === $request->password) {
                //  Update last login
                $user->update([
                    'last_login_time' => now(),
                    'status' => 1
                ]);

                $check = User::where('id', $user->user_id)->first();
                $user->remember_token = $token;
                $user->save();

                Cookie::queue('creator_remember', $token, 43200); // 30 days

                $request->session()->put('LoggedVivahMitra', $check);

                // return response()->json([
                //     'status' => true,
                //     'message' => 'Login successful',
                //     'redirect_url' => url('member/dashboard'),
                // ]);
                return redirect('member/dashboard')->with(session()->flash('alert-success', 'Login successful'));
            }
        }
        //  Invalid credentials
        return response()->json([
            'status' => false,
            'message' => 'Invalid username or password',
        ], 401);
    }

    public function saveCardGiven(Request $request)
    {
        dd($request->all());
        $request->validate([
            'staff_id' => 'required',
            'card_given' => 'required',
            'date' => 'required|date',
        ]);

        $card_given = new PhysicalCardGiven();
        $card_given->user_id = $request->staff_id;
        $card_given->card = $request->card_given;
        $card_given->date = $request->date;
        $card_given->save();

        return response()->json([
            'status' => true,
            'message' => 'Physical Card Given Saved Successfully',
        ]);
    }

    public function memberList(Request $request)
    {
        $page_title = 'Member List';

        $query = Member::query()->orderBy('id', 'desc');

        if ($request->membership_number) {
            $query->where('membership_number', 'like', '%' . $request->membership_number . '%');
        }

        if ($request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->mobile) {
            $query->where('mobile', 'like', '%' . $request->mobile . '%');
        }

        if ($request->status !== null && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $members = $query->paginate(10);

        if ($request->ajax()) {
            return view('admin.membership.member.partials.member_table', compact('members'));
        }

        return view('admin.membership.member.list', compact('members', 'page_title'));
    }

    public function CallMemberList(Request $request)
    {
        $page_title = 'Member List';

        $query = Member::query()->orderBy('id', 'desc');

        if ($request->membership_number) {
            $query->where('membership_number', 'like', '%' . $request->membership_number . '%');
        }

        if ($request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->mobile) {
            $query->where('mobile', 'like', '%' . $request->mobile . '%');
        }

        if ($request->status !== null && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $members = $query->paginate(10);

        if ($request->ajax()) {
            return view('admin.call_management.member.partials.member_table', compact('members'));
        }

        return view('admin.call_management.member.list', compact('members', 'page_title'));
    }
    // public function showCallRemarkForm($id)
    // {
    //     $member = Member::findOrFail($id);
    //     return view('admin.call_management.call_logs.create', compact('member'));
    // }

    public function storeCallRemark(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'call_start_time' => 'required',
            'call_end_time' => 'required',
            'remarks' => 'required'
        ]);

        $loggedUser = session('LoggedUser');

        if (!$loggedUser) {
            return redirect()->back()->with('error', 'Session expired. Please login again.');
        }

        $start = Carbon::parse($request->call_start_time);
        $end   = Carbon::parse($request->call_end_time);

        CallLog::create([
            'member_id' => $request->member_id,
            'called_by' => $loggedUser->id,
            'call_start_time' => $start,
            'call_end_time' => $end,
            'call_duration' => $end->diffInSeconds($start),
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('admin.call.details', $request->member_id)->with('success', 'Call remark saved successfully');
    }


    public function showCallDetails($id)
    {
        $member = Member::findOrFail($id);

        $calls = CallLog::where('member_id', $id)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.call_management.call_logs.details', compact('member', 'calls'));
    }

    public function upcomingAayushmatiDataByMonth($offset)
    {
        $page_title = 'Aayushmati Data';
        $targetMonth = Carbon::now()->addMonths($offset)->format('Y-m');

        $members = Member::where('ayushmati_expected_marriage_month', $targetMonth)
            ->orderBy('ayushmati_expected_marriage_month')
            ->get();

        $count = $members->count();
        $monthName = Carbon::now()->addMonths($offset)->format('F Y');
        return view('admin.call_management.member.ayushmati_list', compact('members', 'count',  'page_title', 'monthName'));
    }

    public function probablyAayushmatiData(Request $request)
    {
        $page_title = 'Member List';
         $counts = [];

        for ($i = 0; $i <= 3; $i++) {

            $targetMonth = Carbon::now()->addMonths($i)->format('Y-m');

            $counts[$i] = Member::where('ayushmati_expected_marriage_month', $targetMonth)
                ->count();
        }
        return view('admin.call_management.member.aayushmati-data', compact('page_title', 'counts'));
    }


    public function vivahMitraPayoutList(Request $request)
    {
        $user_type_list =  $this->staffRepository->get_vivah_mitra_user_types();
        $designation_list =  $this->staffRepository->get_master_designations();
        $page_title = 'Vivah Miitra List';
        $query = User::select([
            'users.*',
            'user_logins.username',
            'user_logins.password',
            'user_types.name as userType',
            'master_designations.name as designation_name',
            'w.id as wallet_id',
            DB::raw('IFNULL(w.balance,0) as wallet_balance')
        ])->where('users.id', '!=', 1)->where('users.user_type_id', 6)
            ->join('user_logins', 'user_logins.user_id', '=', 'users.id')
            ->leftJoin('e_wallets as w', function ($join) {
                $join->on('users.id', '=', 'w.owner_id')
                    ->where('w.owner_type', 'employee');
            })
            ->leftJoin('user_types', 'user_types.id', '=', 'users.user_type_id')
            ->leftJoin('master_designations', 'master_designations.id', '=', 'users.user_designation_id')
            ->whereRaw('IFNULL(w.balance,0) >= ?', [500]);

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

        // dd($users);

        return view('admin.staffs.vivah_mitra.payout.index', compact('users', 'user_type_list', 'designation_list', 'page_title'));
    }

    public function fetchVivahMitraPayout(Request $request)
    {
        $query = User::select([
            'users.*',
            'user_logins.username',
            'user_logins.password',
            'user_types.name as userType',
            'master_designations.name as designation_name',
            'w.id as wallet_id',
            DB::raw('IFNULL(w.balance,0) as wallet_balance')
        ])->where('users.id', '!=', 1)->where('users.user_type_id', 6)
            ->join('user_logins', 'user_logins.user_id', '=', 'users.id')
            ->leftJoin('e_wallets as w', function ($join) {
                $join->on('users.id', '=', 'w.owner_id')
                    ->where('w.owner_type', 'employee');
            })
            ->leftJoin('user_types', 'user_types.id', '=', 'users.user_type_id')
            ->leftJoin('master_designations', 'master_designations.id', '=', 'users.user_designation_id')
            ->whereRaw('IFNULL(w.balance,0) >= ?', [500]);

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
            return view('admin.staffs.vivah_mitra.payout.user_table', compact('users'))->render();
        }
    }

    public function vivahMitraPaymentSentList(Request $request){
         $page_title = 'Payment Sent List';
         $transactions = DB::table('transactions as t')
            ->select(
                't.*',
                'users.first_name',
                'users.last_name',
                'users.email',
                'users.mobile',
                'users.employee_code',
            )
            ->join('users', 'users.id', '=', 't.user_id')
            // ->where('t.type', 'admin_payment')   // payout
            ->where('t.status', 'paid')          // sent
            ->orderBy('t.id', 'desc')
            ->paginate(30);

        return view('admin.staffs.vivah_mitra.payout.payout_sent_list', compact('transactions', 'page_title'));
    }

    /** vivah mitra agreement download */

    public function printVivahMitraAgreement($id)
    {
        $user = DB::table('users as u')
            ->leftJoin('user_details', 'u.id', '=', 'user_details.user_id')

            ->leftJoin('users as ro', 'user_details.reporting_officer', '=', 'ro.id')
            ->leftJoin('users as to', 'user_details.trainer_officer', '=', 'to.id')
            ->leftJoin('users as ho', 'user_details.home_verification_officer', '=', 'ho.id')
            ->leftJoin('users as jo', 'user_details.junior_office_employee', '=', 'jo.id')
            ->leftJoin('user_types', 'u.user_type_id', '=', 'user_types.id')
            ->leftJoin('master_designations', 'u.user_designation_id', '=', 'master_designations.id')
            ->leftJoin('sessions', 'u.session', '=', 'sessions.id')

            ->leftJoin('branches', 'u.branch', '=', 'branches.id')
            ->leftJoin('states', 'u.state', '=', 'states.id')
            ->leftJoin('districts', 'u.city', '=', 'districts.id')

            ->where('u.id', $id)
            ->select(
                'u.*',
                'user_details.*',
                'branches.name as branch_name',
                'states.name as state_name',
                'districts.name as city_name',
                'user_types.name as user_type_name',
                'master_designations.name as user_designation',
                'sessions.title as session_name',

                'ro.first_name as reporting_officer_name',
                'to.first_name as trainer_officer_name',
                'ho.first_name as home_verification_officer_name',
                'jo.first_name as junior_office_employee_name'
            )
            ->first();


        if (!$user) abort(404);
        $officers = DB::table('users')
            ->where('branch', $user->branch)
            ->where('user_type_id', 5)
            ->select('id', 'first_name', 'user_designation_id')
            ->get();
        $videos = DB::table('user_assigned_videos')
            ->join('master_videos', 'user_assigned_videos.video_id', '=', 'master_videos.id')
            ->where('user_assigned_videos.user_id', $id)
            // ->select('master_videos.video_name')
            ->get();

        $bonuses = DB::table('user_assigned_bonuses')
            ->join('master_yearly_bonuses', 'user_assigned_bonuses.bonus_id', '=', 'master_yearly_bonuses.id')
            ->where('user_assigned_bonuses.user_id', $id)
            // ->select('master_yearly_bonuses.bonus_name')
            ->get();

        return view('admin.staffs.print_vivah_mitra_agreement', compact('user', 'officers', 'videos', 'bonuses'));
    }

    /** vivah Mitra in App */

    public function vivahMitraListInApp(Request $request)
    {
        $user_type_list =  $this->staffRepository->get_vivah_mitra_user_types();
        $designation_list =  $this->staffRepository->get_master_designations();
        $page_title = 'Vivah Mitra List in App';
        $query = VivahMitraTeam::select([
            'vivah_mitra_teams.*',
            'user_types.name as userType',
            'master_designations.name as designation_name',
        ])->where('vivah_mitra_teams.id', '!=', 1)->where('vivah_mitra_teams.user_type_id', 6)
            ->join('user_types', 'user_types.id', '=', 'vivah_mitra_teams.user_type_id')
            ->leftJoin('master_designations', 'master_designations.id', '=', 'vivah_mitra_teams.user_designation_id');

        if ($request->user_type_id) {
            $query->where('vivah_mitra_teams.user_type_id', $request->user_type_id);
        }

        if ($request->user_designation_id) {
            $query->where('vivah_mitra_teams.user_designation_id', $request->user_designation_id);
        }

        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('vivah_mitra_teams.first_name', 'like', "%$search%")
                    ->orWhere('vivah_mitra_teams.last_name', 'like', "%$search%")
                    ->orWhere('vivah_mitra_teams.email', 'like', "%$search%")
                    ->orWhere('vivah_mitra_teams.mobile', 'like', "%$search%");
            });
        }

        $users = $query->paginate(20);

        $vivah_mitra = VivahMitraTeam::where('user_type_id', 6)->where('user_designation_id', 7)->count();
        $panchayat_mitra = VivahMitraTeam::where('user_type_id', 6)->where('user_designation_id', 8)->count();
        $prakhand_mitra = VivahMitraTeam::where('user_type_id', 6)->where('user_designation_id', 9)->count();
        $jila_mitra = VivahMitraTeam::where('user_type_id', 6)->where('user_designation_id', 10)->count();

        return view('admin.staffs.vivah_mitra.vivahmitraapp.index',
        compact('vivah_mitra','panchayat_mitra','prakhand_mitra','jila_mitra', 'users', 'user_type_list', 'designation_list', 'page_title'));
    }

    public function fetchVivahMitraInApp(Request $request)
    {
        $query = VivahMitraTeam::select([
            'vivah_mitra_teams.*',
            'user_types.name as userType',
            'master_designations.name as designation_name',
        ])->where('vivah_mitra_teams.id', '!=', 1)->where('vivah_mitra_teams.user_type_id', 6)
            ->join('user_types', 'user_types.id', '=', 'vivah_mitra_teams.user_type_id')
            ->leftJoin('master_designations', 'master_designations.id', '=', 'vivah_mitra_teams.user_designation_id');

        if ($request->user_type_id) {
            $query->where('vivah_mitra_teams.user_type_id', $request->user_type_id);
        }

        if ($request->user_designation_id) {
            $query->where('vivah_mitra_teams.user_designation_id', $request->user_designation_id);
        }

        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('vivah_mitra_teams.first_name', 'like', "%$search%")
                    ->orWhere('vivah_mitra_teams.last_name', 'like', "%$search%")
                    ->orWhere('vivah_mitra_teams.email', 'like', "%$search%")
                    ->orWhere('vivah_mitra_teams.mobile', 'like', "%$search%");
            });
        }

        $users = $query->paginate(20);

        if ($request->ajax()) {
            return view('admin.staffs.vivah_mitra.vivahmitraapp.user_table', compact('users'))->render();
        }
    }

    public function addVivahMitraTeam()
    {
        $datas = [
            'page_title' => 'Add Vivah Mitra Team',
            'state_list' =>  State::get(),
            'branch_list' =>  Branch::where('status', 1)->get(),
            'session_list' =>  Session::where('status', 1)->get(),
            'user_type_list' =>   $this->staffRepository->get_vivah_mitra_user_types(),
            'designation_list' =>  $this->staffRepository->get_master_designations(),
        ];
        return view('admin.staffs.add-vivah-mitra-team', $datas);
    }

    public function storeVivahMitraTeam(Request $request)
    {
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
            'state' => 'required',
            'city' => 'required',

        ]);

        $user = new VivahMitraTeam();
        $user->branch = $data['branch'];
        $user->session = $data['session'];
        $user->first_name = $data['name'];
        $user->mobile = $data['mobile'];
        $user->email = $data['email'];
        $user->state = $data['state'];
        $user->address = $data['address'];
        $user->city = $data['city'];
        $user->user_type_id = $data['user_type_id'];
        $user->user_designation_id = $data['user_designation_id'];
        $user->save();

        // $this->staffRepository->storeStaff($data);
        return redirect()->route('admin.staffs.vivahMitraListInApp')->with(session()->flash('alert-success', 'Added Successfully'));
    }


    /** home meeting */
    public function homeMeetingList(Request $request)
    {
        $query = HomeMeetingDetail::query()
            ->join('users as u', 'home_meeting_details.user_id', '=', 'u.id');

        if ($request->user_id) {
            $query->where('home_meeting_details.user_id', $request->user_id);
        }

        $meeting_list = $query->select(
            'home_meeting_details.*',
            'u.first_name',
            'u.mobile',
            'u.address',
            'u.employee_code'
        )->paginate(10);

        // dd($meeting_list);

        if ($request->ajax()) {
            return view('admin.meeting.home_meeting_table_ajax', compact('meeting_list'))->render();
        }

        return view('admin.meeting.home_meeting_list', compact('meeting_list'));
    }

    public function homeMeetingDetails($id)
    {
        $meeting = HomeMeetingDetail::query()
            ->join('users as u', 'home_meeting_details.user_id', '=', 'u.id')
            ->where('home_meeting_details.id', $id)
            ->select(
                'home_meeting_details.*',
                'u.first_name',
                'u.mobile',
                'u.address',
                'u.employee_code'
            )
            ->first();
        $user = User::find($meeting->user_id);
        return view('admin.meeting.home_meeting_details', compact('meeting', 'user'));
    }

    public function updateHomeMeetingStatus(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'status' => 'required|in:0,1,2',
        ]);

        if($request->status == 1){
            $homeMeeting = HomeMeetingDetail::find($request->id);
            if($homeMeeting){
                $homeMeeting->amount = $request->amount;
                $homeMeeting->status = $request->status;
                $homeMeeting->save();

                /** Update related user status if needed */

                $companyId = session('LoggedUser')->user_id;
                // Get wallet
                $wallet = getWallet('company', $companyId);
                $user_details = User::find($homeMeeting->user_id);
                debitWallet($wallet, $request->amount, "Home meeting amount given to : {$user_details->first_name}");
                $vivahMitraEWallet = getEWallet('employee', $homeMeeting->user_id);
                $credit_type = 'home_meeting_incentive';
                $incentiveAmount = $request->amount;
                $user_district = $user_details->city;
                creditEWallet(
                        $vivahMitraEWallet,
                        $incentiveAmount,
                        $credit_type,
                        "Credited for home meeting incentive, Meeting ID: {$homeMeeting->id}",
                        $user_district
                    );
            }

        }

        if($request->status == 2){
            $homeMeeting = HomeMeetingDetail::find($request->id);
            if($homeMeeting){
                $homeMeeting->amount = $request->amount;
                $homeMeeting->status = $request->status;
                $homeMeeting->reason = $request->reason ?? null;
                $homeMeeting->save();

            }
        }



        return redirect()->back()->with('alert-success', 'Status updated successfully');
    }

    /** trainer meeting */

    public function trainerMeetingList(Request $request)
    {
        $query = TrainingDetail::query()
            ->join('users as u', 'training_details.user_id', '=', 'u.id');

        if ($request->user_id) {
            $query->where('training_details.user_id', $request->user_id);
        }

        $meeting_list = $query->select(
            'training_details.*',
            'u.first_name',
            'u.mobile',
            'u.address',
            'u.employee_code'
        )->paginate(10);

        // dd($meeting_list);

        if ($request->ajax()) {
            return view('admin.meeting.trainer_meeting_table_ajax', compact('meeting_list'))->render();
        }

        return view('admin.meeting.trainer_meeting_list', compact('meeting_list'));
    }

    public function trainerMeetingDetails($id)
    {
        $meeting = TrainingDetail::query()
            ->join('users as u', 'training_details.user_id', '=', 'u.id')
            ->where('training_details.id', $id)
            ->select(
                'training_details.*',
                'u.first_name',
                'u.mobile',
                'u.address',
                'u.employee_code'
            )
            ->first();
        $user = User::find($meeting->user_id);
        return view('admin.meeting.training_meeting_details', compact('meeting', 'user'));
    }

    public function updateTrainerMeetingStatus(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'status' => 'required|in:0,1,2',
            'reason' => 'nullable|string|max:255',
        ]);

        if($request->status == 1){
            $homeMeeting = TrainingDetail::find($request->id);
            if($homeMeeting){
                $homeMeeting->amount = $request->amount;
                $homeMeeting->status = $request->status;
                $homeMeeting->save();

                /** Update related user status if needed */

                $companyId = session('LoggedUser')->user_id;
                // Get wallet
                $wallet = getWallet('company', $companyId);
                $user_details = User::find($homeMeeting->user_id);
                debitWallet($wallet, $request->amount, "Trainer meeting amount given to : {$user_details->first_name}");
                $vivahMitraEWallet = getEWallet('employee', $homeMeeting->user_id);
                $credit_type = 'trainer_meeting_incentive';
                $incentiveAmount = $request->amount;
                $user_district = $user_details->city;
                creditEWallet(
                        $vivahMitraEWallet,
                        $incentiveAmount,
                        $credit_type,
                        "Credited for trainer meeting incentive, Meeting ID: {$homeMeeting->id}",
                         $user_district
                );
            }

        }

        if($request->status == 2){
            $homeMeeting = TrainingDetail::find($request->id);
            if($homeMeeting){
                $homeMeeting->amount = $request->amount;
                $homeMeeting->status = $request->status;
                $homeMeeting->reason = $request->reason ?? null;
                $homeMeeting->save();

            }
        }

        return redirect()->back()->with('alert-success', 'Status updated successfully');
    }

    /** seminar guest meeting   */

    public function seminarGuestMeetingList(Request $request)
    {
        $query = SeminarGuestMettingDetail::query()
            ->join('users as u', 'seminar_guest_meeting_details.user_id', '=', 'u.id');

        if ($request->user_id) {
            $query->where('seminar_guest_meeting_details.user_id', $request->user_id);
        }

        $meeting_list = $query->select(
            'seminar_guest_meeting_details.*',
            'u.first_name',
            'u.mobile',
            'u.address',
            'u.employee_code'
        )->paginate(10);

        // dd($meeting_list);

        if ($request->ajax()) {
            return view('admin.meeting.seminar_meeting_table_ajax', compact('meeting_list'))->render();
        }

        return view('admin.meeting.seminar_guest_meeting_list', compact('meeting_list'));
    }

    public function seminarGuestMeetingDetails($id)
    {
        $meeting = SeminarGuestMettingDetail::query()
            ->join('users as u', 'seminar_guest_meeting_details.user_id', '=', 'u.id')
            ->where('seminar_guest_meeting_details.id', $id)
            ->select(
                'seminar_guest_meeting_details.*',
                'u.first_name',
                'u.mobile',
                'u.address',
                'u.employee_code'
            )
            ->first();
        $user = User::find($meeting->user_id);
        return view('admin.meeting.seminar_meeting_details', compact('meeting', 'user'));
    }

    public function updateSeminarGuestMeetingStatus(Request $request)
    {

        $request->validate([
            'amount' => 'required|numeric',
            'status' => 'required|in:0,1,2'
        ]);
//  dd($request->all());
        if($request->status == 1){
            $homeMeeting = SeminarGuestMettingDetail::find($request->id);
            if($homeMeeting){
                $homeMeeting->amount = $request->amount;
                $homeMeeting->status = $request->status;
                $homeMeeting->reason = $request->reason ?? null;
                $homeMeeting->save();

                /** Update related user status if needed */

                $companyId = session('LoggedUser')->user_id;
                // Get wallet
                $wallet = getWallet('company', $companyId);
                $user_details = User::find($homeMeeting->user_id);
                debitWallet($wallet, $request->amount, "Trainer meeting amount given to : {$user_details->first_name}");
                $vivahMitraEWallet = getEWallet('employee', $homeMeeting->user_id);
                $credit_type = 'seminar_guest_meeting_incentive';
                $incentiveAmount = $request->amount;
                 $user_district = $user_details->city;
                creditEWallet(
                        $vivahMitraEWallet,
                        $incentiveAmount,
                        $credit_type,
                        "Credited for seminar guest meeting incentive, Meeting ID: {$homeMeeting->id}",
                        $user_district
                    );
            }

        }

        if($request->status == 2){
            $homeMeeting = SeminarGuestMettingDetail::find($request->id);
            if($homeMeeting){
                $homeMeeting->amount = $request->amount;
                $homeMeeting->status = $request->status;
                $homeMeeting->reason = $request->reason ?? null;
                $homeMeeting->save();

            }
        }

        return redirect()->back()->with('alert-success', 'Status updated successfully');
    }

    /** employee assigning districts */

    public function employeelists(Request $request)
    {
        $user_type_list =  UserType::where('status', 1)->where('id', 5)->get();
        $designation_list =  $this->staffRepository->get_master_designations();
        $page_title = 'User/Employee List';
        $query = User::where('users.user_type_id', 5)->select([
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
        return view('admin.navigation.employee_list', compact('users', 'user_type_list', 'designation_list', 'page_title'));
    }

    public function fetchEmployeeStaff(Request $request)
    {
        $query = User::where('users.user_type_id', 5)->select([
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
            return view('admin.navigation.partials.employee_table_ajax', compact('users'))->render();
        }
    }


    public function employeelists2(Request $request)
    {
        $user_type_list =  UserType::where('status', 1)->where('id', 5)->get();
        $designation_list =  $this->staffRepository->get_master_designations();
        $page_title = 'User/Employee List';
        $query = User::where('users.user_type_id', 5)->select([
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
        return view('admin.navigation.employee_list2', compact('users', 'user_type_list', 'designation_list', 'page_title'));
    }

    public function fetchEmployeeStaff2(Request $request)
    {
        $query = User::where('users.user_type_id', 5)->select([
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
            return view('admin.navigation.partials.employee_table_ajax', compact('users'))->render();
        }
    }

    /** check monthly reports */

    public function checkMonthlyRoutines(Request $request)
    {
        $user_type_list =  UserType::where('status', 1)->where('id', 5)->get();
        $designation_list =  $this->staffRepository->get_master_designations();
        $page_title = 'Monthly Routine List';
        $query = MonthlyRoutine::select([
            'monthly_routines.*',
            'users.first_name',
            'users.last_name',
            'users.employee_code',
            'users.email',
            'users.mobile',
        ])->join('users', 'users.id', '=', 'monthly_routines.user_id');

        if ($request->user_id) {
            $query->where('monthly_routines.user_id', $request->user_id);
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

        $monthly_routines = $query->paginate(20);
        return view('admin.employee.monthly_routine', compact('monthly_routines', 'user_type_list', 'designation_list', 'page_title'));
    }

    public function fetchMonthlyRoutines(Request $request)
    {
        $query = MonthlyRoutine::select([
            'monthly_routines.*',
            'users.first_name',
            'users.last_name',
            'users.employee_code',
            'users.email',
            'users.mobile',
        ])->join('users', 'users.id', '=', 'monthly_routines.user_id');

        if ($request->user_id) {
            $query->where('monthly_routines.user_id', $request->user_id);
        }

        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('users.first_name', 'like', "%$search%")
                    ->orWhere('users.last_name', 'like', "%$search%")
                    ->orWhere('users.email', 'like', "%$search%")
                    ->orWhere('users.employee_code', 'like', "%$search%")
                    ->orWhere('users.mobile', 'like', "%$search%");
            });
        }

        $monthly_routines = $query->paginate(20);

        if ($request->ajax()) {
            return view('admin.employee.partials.monthly_routine_table_ajax', compact('monthly_routines'))->render();
        }
    }

    /** check cash payment reports */

    public function cashPaymentReport(Request $request)
    {
        $user_type_list = UserType::where('status', 1)
            ->where('id', 5)
            ->get();

        $designation_list = $this->staffRepository->get_master_designations();

        $page_title = 'Cash Payment Report';

        $query = CashEntry::with('details')
            ->select([
                'cash_entries.*',
                'users.first_name',
                'users.last_name',
                'users.employee_code',
                'users.email',
                'users.mobile',
            ])
            ->join('users', 'users.id', '=', 'cash_entries.user_id');

        // Filter by user
        if (!empty($request->user_id)) {
            $query->where('cash_entries.user_id', $request->user_id);
        }

        // Search filter
        if (!empty($request->search)) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('users.first_name', 'like', "%{$search}%")
                    ->orWhere('users.last_name', 'like', "%{$search}%")
                    ->orWhere('users.employee_code', 'like', "%{$search}%")
                    ->orWhere('users.email', 'like', "%{$search}%")
                    ->orWhere('users.mobile', 'like', "%{$search}%");
            });
        }

        // Latest first
        $cash_entries = $query->orderBy('cash_entries.id', 'DESC')
            ->paginate(20);

        return view(
            'admin.employee.cash_payment_report',
            compact(
                'cash_entries',
                'user_type_list',
                'designation_list',
                'page_title'
            )
        );
    }

    public function fetchCashPaymentReport(Request $request)
    {
        $query = CashEntry::with('details')
            ->select([
                'cash_entries.*',
                'users.first_name',
                'users.last_name',
                'users.employee_code',
                'users.email',
                'users.mobile',
            ])
            ->join('users', 'users.id', '=', 'cash_entries.user_id');

        // Filter by user
        if (!empty($request->user_id)) {
            $query->where('cash_entries.user_id', $request->user_id);
        }

        // Search filter
        if (!empty($request->search)) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('users.first_name', 'like', "%{$search}%")
                    ->orWhere('users.last_name', 'like', "%{$search}%")
                    ->orWhere('users.employee_code', 'like', "%{$search}%")
                    ->orWhere('users.email', 'like', "%{$search}%")
                    ->orWhere('users.mobile', 'like', "%{$search}%");
            });
        }

        // Latest first
        $cash_entries = $query->orderBy('cash_entries.id', 'DESC')
            ->paginate(20);

        if ($request->ajax()) {
            return view(
                'admin.employee.partials.cash_payment_report_table_ajax',
                compact('cash_entries')
            )->render();
        }
    }

    /** check online payment reports */

    public function empOnlinePaymentReport(Request $request)
    {
        $user_type_list = UserType::where('status', 1)
            ->where('id', 5)
            ->get();

        $designation_list = $this->staffRepository->get_master_designations();

        $page_title = 'Online Payment Sent Report';

        $query = PaymentSubmission::select([
                'payment_submissions.*',
                'users.first_name',
                'users.last_name',
                'users.employee_code',
                'users.email',
                'users.mobile',
            ])
            ->join('users', 'users.id', '=', 'payment_submissions.user_id');

        // Filter by user
        if (!empty($request->user_id)) {
            $query->where('payment_submissions.user_id', $request->user_id);
        }

        // Search filter
        if (!empty($request->search)) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('users.first_name', 'like', "%{$search}%")
                    ->orWhere('users.last_name', 'like', "%{$search}%")
                    ->orWhere('users.employee_code', 'like', "%{$search}%")
                    ->orWhere('users.email', 'like', "%{$search}%")
                    ->orWhere('users.mobile', 'like', "%{$search}%");
            });
        }

        // Latest first
        $online_payments = $query->orderBy('payment_submissions.id', 'DESC')
            ->paginate(20);

        return view(
            'admin.employee.online_payment_report',
            compact(
                'online_payments',
                'user_type_list',
                'designation_list',
                'page_title'
            )
        );
    }

    public function fetchOnlinePaymentReport(Request $request)
    {
        $query = PaymentSubmission::with('details')
            ->select([
                'payment_submissions.*',
                'users.first_name',
                'users.last_name',
                'users.employee_code',
                'users.email',
                'users.mobile',
            ])
            ->join('users', 'users.id', '=', 'payment_submissions.user_id');

        // Filter by user
        if (!empty($request->user_id)) {
            $query->where('payment_submissions.user_id', $request->user_id);
        }

        // Search filter
        if (!empty($request->search)) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('users.first_name', 'like', "%{$search}%")
                    ->orWhere('users.last_name', 'like', "%{$search}%")
                    ->orWhere('users.employee_code', 'like', "%{$search}%")
                    ->orWhere('users.email', 'like', "%{$search}%")
                    ->orWhere('users.mobile', 'like', "%{$search}%");
            });
        }

        // Latest first
        $online_payments = $query->orderBy('payment_submissions.id', 'DESC')
            ->paginate(20);

        if ($request->ajax()) {
            return view(
                'admin.employee.partials.online_payment_report_table_ajax',
                compact('online_payments')
            )->render();
        }
    }

    public function onlinePaymentStatusUpdate(Request $request)
    {
        $payment = PaymentSubmission::find($request->payment_id);

        if (!$payment) {
            return response()->json([
                'status' => false,
                'message' => 'Payment not found'
            ]);
        }

        $payment->status = $request->status;
        $payment->remarks = $request->remarks;
        $payment->verified_by = session('LoggedUser')->id;
        $payment->save();

        return response()->json([
            'status' => true,
            'message' => 'Payment status updated successfully'
        ]);
    }

    public function deleteOnlinePayment($id)
    {
        $notice = PaymentSubmission::find($id);
        if ($notice) {
            $notice->delete();
            $delete_screenshot = PaymentScreenshot::where('payment_id', $id)->delete();
            return redirect()->back()->with('alert-danger', 'Online Payment deleted successfully');
        } else {
            return redirect()->back()->with('alert-danger', 'Something went wrong');
        }
    }

    public function deleteCashPaymentReport($id)
    {
        $notice = CashEntry::find($id);
        if ($notice) {
            $notice->delete();
            $delete_screenshot = CashEntryDetail::where('cash_entry_id', $id)->delete();
            return redirect()->back()->with('alert-danger', 'Cash Payment deleted successfully');
        } else {
            return redirect()->back()->with('alert-danger', 'Something went wrong');
        }
    }

    public function deleteMonthlyRoutines($id)
    {
        $notice = MonthlyRoutine::find($id);
        if ($notice) {
            $notice->delete();
            return redirect()->back()->with('alert-danger', 'Monthly routine deleted successfully');
        } else {
            return redirect()->back()->with('alert-danger', 'Something went wrong');
        }
    }

	public function updateVMBox(Request $request)
	{
		// Example: get user id from request
		$userId = $request->user_id;

		// First check if records already exist for this user
		$checkCount = PrakhandVmBox::where('user_id', $userId)->count();

		// Insert only if count is 0
		if ($checkCount == 0) {

			$dt = [];

			for ($i = 0; $i < 20; $i++) {
				$dt[] = [
					'user_id' => $userId,
					'box_key' => 'BOX_' . $userId . '_' . ($i + 1),
				];
			}

			PrakhandVmBox::insert($dt);

			return response()->json([
				'status' => true,
				'message' => 'VM Boxes inserted successfully'
			]);
		}

		return response()->json([
			'status' => false,
			'message' => 'VM Boxes already exist for this user'
		]);
	}

    public function deleteVmVox($id)
    {
        $delvmbox = PrakhandVmBox::where('user_id', $id)->delete();
        if ($delvmbox) {
            return redirect()->back()->with('alert-danger', 'VM Boxes deleted successfully');
        } else {
            return redirect()->back()->with('alert-danger', 'Something went wrong');
        }
    }




}
