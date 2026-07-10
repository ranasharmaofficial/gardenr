<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\LocationRepositoryInterface;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\District;
use App\Models\Block;
use App\Models\Panchayat;
use App\Models\MasterPost;
use App\Models\MasterWard;
use Yajra\DataTables\Facades\DataTables;
class LocationController extends Controller
{
    private $locationRepository;

    public function __construct(LocationRepositoryInterface $locationRepository){
        $this->locationRepository = $locationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function country(Request $request){
        $country =  $this->locationRepository->allCountries($request);
        return view('admin.location.country.index', compact('country', 'request'));
    }

    public function posts(Request $request){
        // $states =  $this->locationRepository->allStates($request);
        return view('admin.location.post.index', compact('request'));
    }


    public function getPost(Request $request)
    {
        if ($request->ajax()) {
            $data = MasterPost::select(['id', 'name', 'status'])->orderBy('id', 'DESC');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $checked = $row->status ? 'checked' : '';
                    // return '<input type="checkbox" class="toggle-status" data-id="'.$row->id.'" '.$checked.'>';
                    return '<div class="form-check form-switch">
                                <input class="form-check-input toggle-status" data-id="'.$row->id.'" '.$checked.' type="checkbox" role="switch" id="switchCheckChecked">

                            </div>';
                })
                ->addColumn('action', function($row){
                    return '<button class="btn btn-primary btn-sm editBtn"
                                data-id="'.$row->id.'"
                                data-name="'.$row->name.'"
                                data-status="'.$row->status.'">
                                Edit
                            </button>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    public function storePost(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        MasterPost::create([
            'name' => $request->name,
            'status' => $request->status ? 1 : 0,
        ]);

        return response()->json(['success' => true]);
    }

    public function updatePost(Request $request)
    {
        $state = MasterPost::find($request->id);
        if ($state) {
            $state->name = $request->name;
            $state->status = $request->status ? 1 : 0;
            $state->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function togglePostStatus(Request $request)
    {
        $state = MasterPost::find($request->id);
        $state->status = $request->status;
        $state->save();

        return response()->json(['success' => true]);
    }

    public function states(Request $request){
        $states =  $this->locationRepository->allStates($request);
        return view('admin.location.states.index', compact('states', 'request'));
    }

    // public function cities(Request $request){
    //     $states =  $this->locationRepository->allStates($request);
    //     $biharId = 1;
    //     return view('admin.location.city.index', compact('states', 'request', 'biharId'));
    // }


    public function getStates(Request $request)
    {
        if ($request->ajax()) {
            $data = State::select(['id', 'name', 'status']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $checked = $row->status ? 'checked' : '';
                    // return '<input type="checkbox" class="toggle-status" data-id="'.$row->id.'" '.$checked.'>';
                    return '<div class="form-check form-switch">
                                <input class="form-check-input toggle-status" data-id="'.$row->id.'" '.$checked.' type="checkbox" role="switch" id="switchCheckChecked">

                            </div>';
                })
                ->addColumn('action', function($row){
                    return '<button class="btn btn-primary btn-sm editBtn"
                                data-id="'.$row->id.'"
                                data-name="'.$row->name.'"
                                data-status="'.$row->status.'">
                                Edit
                            </button>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    public function updateState(Request $request)
    {
        $state = State::find($request->id);
        if ($state) {
            $state->name = $request->name;
            $state->status = $request->status ? 1 : 0;
            $state->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function toggleStateStatus(Request $request)
    {
        $state = State::find($request->id);
        $state->status = $request->status;
        $state->save();

        return response()->json(['success' => true]);
    }

    public function cities(Request $request){
        $states =  $this->locationRepository->allStates($request);
        $biharId = 1;
        return view('admin.location.city.index', compact('states', 'request', 'biharId'));
    }

    public function getCities(Request $request)
    {
        if ($request->ajax()) {
            $data = District::select(['districts.id', 'districts.name', 'districts.status', 'states.name as state_name'])
                ->join('states', 'states.id', '=', 'districts.state_id');

            if ($request->state_id) {
                $data->where('districts.state_id', $request->state_id);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $checked = $row->status ? 'checked' : '';
                    return '<div class="form-check form-switch">
                                <input class="form-check-input toggle-status" data-id="'.$row->id.'" '.$checked.' type="checkbox" role="switch">
                            </div>';
                })
                ->addColumn('action', function($row){
                    return '<button class="btn btn-primary btn-sm editBtn"
                                data-id="'.$row->id.'"
                                data-name="'.$row->name.'"
                                data-status="'.$row->status.'">
                                Edit
                            </button>';
                })
                ->filter(function ($query) use ($request) {
                    if ($request->search['value']) {
                        $search = strtolower($request->search['value']);
                        $query->where(function($q) use ($search) {
                            $q->whereRaw('LOWER(cities.name) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(states.name) LIKE ?', ["%{$search}%"]);
                        });
                    }
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    public function updateCity(Request $request)
    {
        $city = District::find($request->id);
        if ($city) {
            $city->name = $request->name;
            $city->status = $request->status ? 1 : 0;
            $city->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function storeCity(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'required|exists:states,id',
        ]);

        District::create([
            'name' => $request->name,
            'state' => $request->state_id,
            'status' => $request->status ? 1 : 0,
        ]);

        return response()->json(['success' => true]);
    }

    public function toggleCityStatus(Request $request)
    {
        $state = District::find($request->id);
        $state->status = $request->status;
        $state->save();
        return response()->json(['success' => true]);
    }

    public function getDistricts(Request $request)
    {
        $districts = District::where('state_id', $request->state_id)->get();
        return response()->json($districts);
    }

    public function getOnlyBlocks(Request $request)
    {
        $block = Block::where('district_id', $request->district_id)->get();
        return response()->json($block);
    }



    public function blocks(Request $request){
        $states =  $this->locationRepository->allStates($request);
        $biharId = 1;
        return view('admin.location.block.index', compact('states', 'request', 'biharId'));
    }

    public function getBlocks(Request $request)
    {
        if ($request->ajax()) {
            $data = Block::select(['blocks.id', 'blocks.name', 'blocks.status', 'districts.name as district_name'])
                ->join('districts', 'districts.id', '=', 'blocks.district_id');

            // if ($request->district_id) {
            //     $data->where('blocks.district_id', $request->district_id);
            // }

            // if ($request->state_id) {
            //     $data->where('state_id', $request->state_id);
            // }

            if ($request->district_id) {
                $data->where('district_id', $request->district_id);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $checked = $row->status ? 'checked' : '';
                    return '<div class="form-check form-switch">
                                <input class="form-check-input toggle-status" data-id="'.$row->id.'" '.$checked.' type="checkbox" role="switch">
                            </div>';
                })
                ->addColumn('action', function($row){
                    return '<button class="btn btn-primary btn-sm editBtn"
                                data-id="'.$row->id.'"
                                data-name="'.$row->name.'"
                                data-status="'.$row->status.'">
                                Edit
                            </button>';
                })
                ->filter(function ($query) use ($request) {
                    if ($request->search['value']) {
                        $search = strtolower($request->search['value']);
                        $query->where(function($q) use ($search) {
                            $q->whereRaw('LOWER(cities.name) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(states.name) LIKE ?', ["%{$search}%"]);
                        });
                    }
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    public function updateBlock(Request $request)
    {
        $city = Block::find($request->id);
        if ($city) {
            $city->name = $request->name;
            $city->status = $request->status ? 1 : 0;
            $city->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function storeBlock(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'district_id' => 'required|exists:districts,id',
        ]);

        Block::create([
            'name' => $request->name,
            'district_id' => $request->district_id,
            'status' => $request->status ? 1 : 0,
        ]);

        return response()->json(['success' => true]);
    }

    public function toggleBlockStatus(Request $request)
    {
        $state = Block::find($request->id);
        $state->status = $request->status;
        $state->save();

        return response()->json(['success' => true]);
    }

    public function panchayat(Request $request){
        $states =  $this->locationRepository->allStates($request);
        $biharId = 1;
        return view('admin.location.panchayat.index', compact('states', 'request', 'biharId'));
    }

    public function getPanchayat(Request $request)
    {
        if ($request->ajax()) {
            $data = Panchayat::select(['panchayats.id', 'panchayats.name', 'panchayats.status', 'blocks.name as block_name'])
                ->join('blocks', 'blocks.id', '=', 'panchayats.block_id')->orderBy('panchayats.id', 'DESC');

            // if ($request->district_id) {
            //     $data->where('blocks.district_id', $request->district_id);
            // }

            // if ($request->state_id) {
            //     $data->where('state_id', $request->state_id);
            // }

            if ($request->block_id) {
                $data->where('block_id', $request->block_id);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $checked = $row->status ? 'checked' : '';
                    return '<div class="form-check form-switch">
                                <input class="form-check-input toggle-status" data-id="'.$row->id.'" '.$checked.' type="checkbox" role="switch">
                            </div>';
                })
                ->addColumn('action', function($row){
                    return '<button class="btn btn-primary btn-sm editBtn"
                                data-id="'.$row->id.'"
                                data-name="'.$row->name.'"
                                data-status="'.$row->status.'">
                                Edit
                            </button>';
                })
                ->filter(function ($query) use ($request) {
                    if ($request->search['value']) {
                        $search = strtolower($request->search['value']);
                        $query->where(function($q) use ($search) {
                            $q->whereRaw('LOWER(blocks.name) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(panchayats.name) LIKE ?', ["%{$search}%"]);
                        });
                    }
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    public function updatePanchayat(Request $request)
    {
        $city = Panchayat::find($request->id);
        if ($city) {
            $city->name = $request->name;
            $city->status = $request->status ? 1 : 0;
            $city->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function storePanchayat(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'block_id' => 'required|exists:blocks,id',
        ]);

        Panchayat::create([
            'name' => $request->name,
            'block_id' => $request->block_id,
            'status' => $request->status ? 1 : 0,
        ]);

        return response()->json(['success' => true]);
    }

    public function togglePanchayatStatus(Request $request)
    {
        $state = Panchayat::find($request->id);
        $state->status = $request->status;
        $state->save();

        return response()->json(['success' => true]);
    }

    /** master wards */

    public function ward(Request $request){
        $states =  $this->locationRepository->allStates($request);
        $biharId = 1;
        return view('admin.location.ward.index', compact('states', 'request', 'biharId'));
    }

    public function getWard(Request $request)
    {
        if ($request->ajax()) {
            $data = MasterWard::select(['master_wards.id', 'master_wards.total_ward', 'master_wards.status', 'panchayats.name as panchayat_name'])
                ->join('panchayats', 'panchayats.id', '=', 'master_wards.panchayat_id')->orderBy('master_wards.id', 'DESC');

            // if ($request->district_id) {
            //     $data->where('blocks.district_id', $request->district_id);
            // }

            // if ($request->state_id) {
            //     $data->where('state_id', $request->state_id);
            // }

            if ($request->panchayat_id) {
                $data->where('panchayat_id', $request->panchayat_id);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $checked = $row->status ? 'checked' : '';
                    return '<div class="form-check form-switch">
                                <input class="form-check-input toggle-status" data-id="'.$row->id.'" '.$checked.' type="checkbox" role="switch">
                            </div>';
                })
                ->addColumn('action', function($row){
                    return '<button class="btn btn-primary btn-sm editBtn"
                                data-id="'.$row->id.'"
                                data-total_ward="'.$row->total_ward.'"
                                data-status="'.$row->status.'">
                                Edit
                            </button>';
                })
                ->filter(function ($query) use ($request) {
                    if ($request->search['value']) {
                        $search = strtolower($request->search['value']);
                        $query->where(function($q) use ($search) {
                            $q->whereRaw('LOWER(blocks.name) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(panchayats.name) LIKE ?', ["%{$search}%"]);
                        });
                    }
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    public function updateWard(Request $request)
    {
        $city = MasterWard::find($request->id);
        if ($city) {
            $city->total_ward = $request->total_ward;
            $city->status = $request->status ? 1 : 0;
            $city->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function storeWard(Request $request){
        $request->validate([
            'total_no' => 'required|integer',
            'panchayat_id' => 'required|exists:panchayats,id',
        ]);

        MasterWard::create([
            'total_ward' => $request->total_no,
            'panchayat_id' => $request->panchayat_id,
            'status' => $request->status ? 1 : 0,
        ]);

        return response()->json(['success' => true]);
    }

    public function toggleWardStatus(Request $request)
    {
        $state = MasterWard::find($request->id);
        $state->status = $request->status;
        $state->save();

        return response()->json(['success' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $categories =  $this->locationRepository->getCmsPageList();
        return view('admin.speciality.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:specialities,name',
            'status' => 'required',
            'icons' => 'required',
        ]);

        $data['created_by'] = session('LoggedUser')->id;
        if($request->has('icons')){
            $name = $request->icons->getClientOriginalName();
            $imageName = time().rand(1,999).'.'.$name;
            $request->icons->move(public_path('uploads/speciality'), $imageName);
            $data['icons'] = $imageName;
        }else{
            $data['icons'] = NULL;
        }
        $speciality_store = $this->locationRepository->storeSpeciality($request, $data);

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
        $data = $this->locationRepository->findSpeciality($id);
        if($data){
           return view('admin.speciality.update', compact('data'));
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
            'name' => 'required|string|max:255|unique:specialities,name,' . $id,
            'status' => 'required'
        ]);

        $data['updated_by'] = session('LoggedUser')->id;
        if($request->has('icons')){
            $name = $request->icons->getClientOriginalName();
            $imageName = time().rand(1,999).'.'.$name;
            $request->icons->move(public_path('uploads/speciality'), $imageName);
            $data['icons'] = $imageName;
        }else{
            $data['icons'] = NULL;
        }
        $speciality_update = $this->locationRepository->updateSpeciality($data, $id);

        if (!$speciality_update) {
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
        $this->slug = SlugService::createSlug(Spciality::class, 'slug', $this->name);
    }

    public function getCitiesByState($state_id)
    {
        $cities = City::where('state_id', $state_id)->where('status', 1)->get(['id', 'name', 'status']);
        return response()->json($cities);
    }

    public function getDistrictByState($state_id)
    {
        $cities = District::where('state_id', $state_id)->get(['id', 'name', 'status']);
        return response()->json($cities);
    }

    public function getBlockByDistrict($state_id)
    {
        $cities = Block::where('district_id', $state_id)->get(['id', 'name', 'status']);
        return response()->json($cities);
    }

    public function getPanchayatByBlock($state_id)
    {
        $cities = Panchayat::where('block_id', $state_id)->get(['id', 'name', 'status']);
        return response()->json($cities);
    }



}
