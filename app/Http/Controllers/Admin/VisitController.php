<?php

namespace App\Http\Controllers\Admin;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\VisitRepositoryInterface;

class VisitController extends Controller
{

    private $visitRepository;

    public function __construct(VisitRepositoryInterface $visitRepository)
    {
        $this->visitRepository = $visitRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $staffs =  $this->visitRepository->allVisits($request);
        return view('admin.visits.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.visits.create');
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
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            // 'status' => 'required',
            'expertise' => 'required',
            'experience' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'visit_date' => 'required',
            'remarks' => 'required',
        ]);

        if($request->has('picture')){
            $data['picture'] = upload_asset($request->picture, 'staff');
        }else{
            $data['picture'] = NULL;
        }

        $data['created_by'] = session('LoggedUser')->id;
        $this->visitRepository->storeVisitDoctors($data);

        return redirect()->route('admin.visits.index')->with(session()->flash('alert-success', 'Added Successfully'));
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
        $staff = $this->visitRepository->findStaff($id);
        // dd($staff);
        return view('admin.staffs.update', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $data = $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'mobile' => 'required',
            'email' => 'required',
            'status' => 'required',
            'expertise' => 'required',
            'company' => 'required',
            'experience' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        if($request->has('profile_pic')){
            $data['profile_pic'] = upload_asset($request->profile_pic, 'staff');
        }else{
            $data['profile_pic'] = NULL;
        }

        // if($request->has('header_image')){
        //     $data['header_image'] = upload_asset($request->header_image, 'staff');
        // }else{
        //     $data['header_image'] = NULL;
        // }

        $this->visitRepository->updateStaff($data, $id);

        return redirect()->route('admin.staffs.index')->with(session()->flash('alert-success', 'Staff Updated Successfully'));
    }


}
