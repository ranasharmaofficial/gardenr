<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\NavigationRepositoryInterface;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use App\Models\Menu;
use App\Models\Session;
use App\Models\State;
use App\Models\Branch;
use App\Models\District;
use App\Models\MasterDesignation;
use App\Models\User;
use App\Models\MasterVideo;
use App\Models\MasterYearlyBonus;
use App\Models\UserNavigation;
use App\Models\MasterShop;

class NavigationController extends Controller
{
    private $navigationRepository;

    public function __construct(NavigationRepositoryInterface $navigationRepository, StaffRepositoryInterface $staffRepository){
        $this->navigationRepository = $navigationRepository;
        $this->staffRepository = $staffRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){
        $page_title = 'Navigation';
        $menus =  $this->navigationRepository->allNavigations($request);
        return view('admin.navigation.index', compact('menus', 'request', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $page_title = 'Navigation';
        $navigationParent = $this->navigationRepository->getNavigationHead($request);
        return view('admin.navigation.create', compact( 'request', 'page_title', 'navigationParent'));
    }

    public function addNavigation(Request $request){
        $page_title = 'Navigation';
        $id = $request->id;
        // dd($id);
        $navigationParent = $this->navigationRepository->getNavigationHead($id);
        // dd($navigationParent);
        return view('admin.navigation.add_navigation', compact( 'request', 'page_title', 'navigationParent'));
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
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'sort_order' => 'required|numeric',
            'parent_id' => 'required|',
            'status' => 'required|in:0,1',
            'route' => 'required',
        ]);

        $data['created_by'] = session('LoggedUser')->id;
        $navigation_store = $this->navigationRepository->storeNavigation($request, $data);

        if (!$navigation_store) {
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

    public function updateNavigationDetails(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'sort_order' => 'required|numeric',
            'parent_id' => 'required|',
            'status' => 'required|in:0,1',
            'route' => 'required',
        ]);

        $data['created_by'] = session('LoggedUser')->id;
        $navigation_store = $this->navigationRepository->updateNavigation($request, $data);

        if (!$navigation_store) {
            return response()->json([
                "status" => false,
                "message" => 'Something went wrong',
            ]);
        } else {
            return response()->json([
                "status" => true,
                "message" => 'Navigation Updated Successfully.',
            ]);

        }
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
        $data = $this->navigationRepository->findBrand($id);
        if($data){
            $page_title = 'Update Navigation';
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
        $category_update = $this->navigationRepository->updateBrand($data, $id);
        if(!$category_update) {
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

    // public function generateSlug(){
    //     $this->slug = SlugService::createSlug(Brand::class, 'slug', $this->name);
    // }  $menus =  $this->navigationRepository->allNavigations($request);


    public function assignUserRoles($id){
            $staff = $this->staffRepository->findStaff($id);
            if(!$staff){
                return redirect()->route('admin.staffs.index')->with(session()->flash('alert-danger', 'Staff Not Found'));
            }else{

                $pgTitle = 'Assign Employee Roles';

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
                'menus' =>  $this->navigationRepository->getAllNavigationList(),
                'assignedMenus' => UserNavigation::where('user_id', $staff->id)->pluck('nav_id')->toArray(),
            ];
            // dd(session('LoggedUser')->user_type_id);
            return view('admin.navigation.assign_user_roles', $datas);
        }
    }

    public function assignEmployeeDistrict($id){
            $staff = $this->staffRepository->findStaff($id);
            if(!$staff){
                return redirect()->route('admin.staff.employeelists')->with(session()->flash('alert-danger', 'Staff Not Found'));
            }else{

                $pgTitle = 'Assign Employee District';

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
                'menus' =>  $this->navigationRepository->getAllNavigationList(),
                'assignedMenus' => UserNavigation::where('user_id', $staff->id)->pluck('nav_id')->toArray(),
                'districts' => District::where('state_id', 5)->where('status', 1)->get(),
            ];
            // dd(session('LoggedUser')->user_type_id);
            return view('admin.navigation.assign_employee_district', $datas);
        }
    }

    public function storeAssignDistrict(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'districts' => 'required|array'
        ]);

        $user = User::findOrFail($request->user_id);

        // Sync districts (auto insert + delete old)
        $user->districts()->sync($request->districts);

        return back()->with('alert-success', 'Districts Assigned Successfully');
    }

    public function storeAssignShop(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'shops' => 'required|array'
        ]);

        $user = User::findOrFail($request->user_id);

        // Sync shops (auto insert + delete old)
        $user->shops()->sync($request->shops);

        return back()->with('alert-success', 'Shops Assigned Successfully');
    }


    public function assignEmployeeShop($id){
            $staff = $this->staffRepository->findStaff($id);
            if(!$staff){
                return redirect()->route('admin.staff.employeelists')->with(session()->flash('alert-danger', 'Staff Not Found'));
            }else{

                $pgTitle = 'Assign Employee Shop';

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
                'menus' =>  $this->navigationRepository->getAllNavigationList(),
                'assignedMenus' => UserNavigation::where('user_id', $staff->id)->pluck('nav_id')->toArray(),
                'shop_list' => MasterShop::where('status', 1)->get(),
            ];
            // dd(session('LoggedUser')->user_type_id);
            return view('admin.navigation.assign_employee_shop', $datas);
        }
    }

    public function toggleNavigationAddRemove(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'nav_id'  => 'required|integer',
            'checked' => 'required|boolean',
        ]);

        if ($request->checked) {
            // ADD if not exists
            UserNavigation::updateOrCreate(
                [
                    'user_id' => $request->user_id,
                    'nav_id'  => $request->nav_id,
                ],
                [
                    'status'   => 1,
                    'added_on' => date('Y-m-d'),
                ]
            );
        } else {
            // REMOVE
            UserNavigation::where('user_id', $request->user_id)
                ->where('nav_id', $request->nav_id)
                ->delete();
        }

        return response()->json([
            'status' => true
        ]);
    }



}
