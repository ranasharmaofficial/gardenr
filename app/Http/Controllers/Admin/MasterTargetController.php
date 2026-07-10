<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MasterTarget;
use App\Models\UserType;
use App\Models\MasterDesignation;

class MasterTargetController extends Controller
{
    public function index(Request $request){
        $user_type =  UserType::where('status', 1)->where('id', '!=', 1)->get();
        // dd($user_type);
            $query = MasterTarget::select([
                'master_targets.*',
                'user_types.name as userType',
                'master_designations.name as userDesignation',
            ])->join('user_types', 'user_types.id', '=', 'master_targets.user_type')
              ->leftJoin('master_designations', 'master_designations.id', '=', 'master_targets.user_designation');

            if ($request->type) {
                $query->where('master_targets.user_type', $request->type);
            }

            if ($request->user_designation) {
                $query->where('master_targets.user_designation', $request->user_designation);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_targets.target', 'like', "%$search%")
                    ->orWhere('master_targets.target_value', 'like', "%$search%");
                });
            }

            $target_list = $query->paginate(30);

        $datas = [
            'target_list' => $target_list,
            'user_type' => $user_type,
            'request' => $request,
            'page_title' => 'Target List',
        ];
        return view('admin.master.target.index', $datas);
    }

    public function fetchAgreementData(Request $request)
    {
         $query = MasterTarget::select([
                'master_targets.*',
                'user_types.name as userType',
                'master_designations.name as userDesignation',
            ])->join('user_types', 'user_types.id', '=', 'master_targets.user_type')
              ->leftJoin('master_designations', 'master_designations.id', '=', 'master_targets.user_designation');

            if ($request->type) {
                $query->where('master_targets.user_type', $request->type);
            }

            if ($request->user_designation) {
                $query->where('master_targets.user_designation', $request->user_designation);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_targets.target', 'like', "%$search%")
                    ->orWhere('master_targets.target_value', 'like', "%$search%");
                });
            }

            $target_list = $query->paginate(30);

        if ($request->ajax()) {
            return view('admin.master.target.target_table_ajax', compact('target_list'))->render();
        }
    }

    /* Store New Session */
   public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'target' => 'required',
            'target_value' => 'required',
            'type' => 'required',
            'user_designation_id' => 'required',
            'status' => 'required',

        ]);

        // if ($request->hasFile('file')) {
        //     $ext = $request->file->getClientOriginalExtension();
        //     $fileName = time() . rand(1, 999) . '.' . $ext;
        //     $request->file->move(public_path('uploads/agreement'), $fileName);
        //     $data['file'] = 'uploads/agreement/' . $fileName;
        // } else {
        //     $data['file'] = NULL;
        // }

        $target = new MasterTarget();
        $target->target = $request->target;
        $target->target_value = $request->target_value;
        $target->status = $request->status;
        $target->user_type = $request->type;
        $target->user_designation = $request->user_designation_id;
        $target->created_by = session('LoggedUser')->id;
        $target->save();

        return response()->json(['status' => true, 'message' => 'Target Added successfully!']);
    }


    public function edit($id)
    {
        $target = MasterTarget::find($id);
        $user_type =  UserType::where('status', 1)->where('id', '!=', 1)->get();
        $user_designation_details =  MasterDesignation::where('id', $target->user_designation)->first();
        $page_title = 'Edit Target';
        return view('admin.master.target.edit_target', compact('target', 'page_title', 'user_type', 'user_designation_details'));
    }


    public function update(Request $request, $id)
    {
         $request->validate([
            'target' => 'required',
            'target_value' => 'required',
            'type' => 'required',
            'user_designation_id' => 'required',
            'status' => 'required',
        ]);



        $target = MasterTarget::findOrFail($id);
        $target->target = $request->target;
        $target->target_value = $request->target_value;
        $target->status = $request->status;
        $target->user_type = $request->type;
        $target->user_designation = $request->user_designation_id;
        $target->created_by = session('LoggedUser')->id;
        $target->save();
        return response()->json(['status' => true, 'message' => 'Target Updated successfully!']);
    }
}
