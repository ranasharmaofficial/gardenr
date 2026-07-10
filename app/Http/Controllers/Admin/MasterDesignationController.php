<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\UserType;
use App\Models\MasterDesignation;

class MasterDesignationController extends Controller
{
    public function getDesignationByUserType($state_id)
    {
        $cities = MasterDesignation::where('user_type', $state_id)->get(['id', 'name']);
        return response()->json($cities);
    }

    public function index(Request $request){
        $user_type =  UserType::where('status', 1)->where('id', '!=', 1)->get();
        // $designayion_list =  MasterDesignation::latest()->get();

        $query = MasterDesignation::select([
                'master_designations.*',
                'user_types.name as userType',
            ])->join('user_types', 'user_types.id', '=', 'master_designations.user_type');

            if ($request->type) {
                $query->where('master_designations.user_type', $request->type);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_designations.user_type', 'like', "%$search%")
                    ->orWhere('master_designations.name', 'like', "%$search%");
                });
            }

            $designayion_list = $query->orderBy('master_designations.id', 'DESC')->paginate(30);

        $datas = [
            'user_type' => $user_type,
            'designayion_list' => $designayion_list,
            'request' => $request,
            'page_title' => 'User Designation List',
        ];
        return view('admin.master.designation.index', $datas);
    }

    public function fetchDesignationData(Request $request)
    {
       $query = MasterDesignation::select([
                'master_designations.*',
                'user_types.name as userType',
            ])->join('user_types', 'user_types.id', '=', 'master_designations.user_type');

            if ($request->type) {
                $query->where('master_designations.user_type', $request->type);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_designations.name', 'like', "%$search%")
                    ->orWhere('master_designations.user_type', 'like', "%$search%");
                });
            }

            $designayion_list = $query->orderBy('master_designations.id', 'DESC')->paginate(30);

        if ($request->ajax()) {
            return view('admin.master.designation.designation_table_ajax', compact('designayion_list'))->render();
        }
    }

    /* Store New Session */
   public function store(Request $request)
    {
        $request->validate([
            'user_type'   => 'required',
            'name'   => 'required|string|max:255',
            'body'   => 'nullable|string',
            'incentive'   => 'required',
            'status' => 'required|in:0,1',
        ]);

        MasterDesignation::create([
            'user_type'  => $request->user_type,
            'name'       => $request->name,
            'body'       => $request->body,
            'incentive'       => $request->incentive,
            'status'     => $request->status,
            // 'created_by' => Auth::id(),
        ]);

        return response()->json(['success' => true, 'message' => 'Designation added successfully!']);
    }


    public function edit($id)
    {
        return response()->json(MasterDesignation::find($id));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'incentive'   => 'required',
            'user_type'   => 'nullable',
            'status' => 'required|in:0,1',
        ]);

        $designation = MasterDesignation::findOrFail($id);

        $designation->update([
            'user_type'       => $request->user_type,
            'name'       => $request->name,
            'body'       => $request->body,
            'incentive'  => $request->incentive,
            'status'     => $request->status,
            // 'updated_by' => Auth::id(),
        ]);

        return response()->json(['success' => true, 'message' => 'Designation updated successfully!']);
    }
}
