<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\EmployeeTarget;
use App\Models\UserType;
use App\Models\MasterDesignation;

class EmployeeTargetController extends Controller
{
    public function index(Request $request){
        $user_type =  UserType::where('status', 1)->where('id', '!=', 1)->get();
        // dd($user_type);
            $query = EmployeeTarget::select([
                'employee_targets.*',
                'user_types.name as userType',
                'master_designations.name as userDesignation',
            ])->join('user_types', 'user_types.id', '=', 'employee_targets.user_type')
              ->leftJoin('master_designations', 'master_designations.id', '=', 'employee_targets.user_designation');

            if ($request->type) {
                $query->where('employee_targets.user_type', $request->type);
            }

            if ($request->user_designation) {
                $query->where('employee_targets.user_designation', $request->user_designation);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('employee_targets.target', 'like', "%$search%")
                    ->orWhere('employee_targets.target_value', 'like', "%$search%");
                });
            }

            $target_list = $query->paginate(30);

        $datas = [
            'target_list' => $target_list,
            'user_type' => $user_type,
            'request' => $request,
            'page_title' => 'Employee Target List',
        ];
        return view('admin.master.employee_target.index', $datas);
    }

    public function fetchAgreementData(Request $request)
    {
         $query = EmployeeTarget::select([
                'employee_targets.*',
                'user_types.name as userType',
                'master_designations.name as userDesignation',
            ])->join('user_types', 'user_types.id', '=', 'employee_targets.user_type')
              ->leftJoin('master_designations', 'master_designations.id', '=', 'employee_targets.user_designation');

            if ($request->type) {
                $query->where('employee_targets.user_type', $request->type);
            }

            if ($request->user_designation) {
                $query->where('employee_targets.user_designation', $request->user_designation);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('employee_targets.target', 'like', "%$search%")
                    ->orWhere('employee_targets.target_value', 'like', "%$search%");
                });
            }

            $target_list = $query->paginate(30);

        if ($request->ajax()) {
            return view('admin.master.employee_target.target_table_ajax', compact('target_list'))->render();
        }
    }

    /* Store New Session */
   public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'target' => 'required',
            'target_value' => 'required',
            'target_type' => 'required',
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

        $target = new EmployeeTarget();
        $target->target = $request->target;
        $target->target_value = $request->target_value;
        $target->status = $request->status;
        $target->user_type = $request->type;
        $target->user_designation = $request->user_designation_id;
        $target->target_type = $request->target_type;
        $target->created_by = session('LoggedUser')->id;
        $target->save();

        return response()->json(['status' => true, 'message' => 'Target Added successfully!']);
    }


    public function edit($id)
    {
        $target = EmployeeTarget::find($id);
        $user_type =  UserType::where('status', 1)->where('id', '!=', 1)->get();
        $user_designation_details =  MasterDesignation::where('id', $target->user_designation)->first();
        $page_title = 'Edit Employee Target';
        return view('admin.master.employee_target.edit_target', compact('target', 'page_title', 'user_type', 'user_designation_details'));
    }


    public function update(Request $request, $id)
    {
         $request->validate([
            'target' => 'required',
            'target_value' => 'required',
            'type' => 'required',
            'user_designation_id' => 'required',
            'status' => 'required',
            'target_type' => 'required',
        ]);



        $target = EmployeeTarget::findOrFail($id);
        $target->target = $request->target;
        $target->target_value = $request->target_value;
        $target->status = $request->status;
        $target->user_type = $request->type;
        $target->user_designation = $request->user_designation_id;
        $target->target_type = $request->target_type;
        $target->created_by = session('LoggedUser')->id;
        $target->save();
        return response()->json(['status' => true, 'message' => 'Target Updated successfully!']);
    }

    public function destroy($id)
    {
        $target = EmployeeTarget::findOrFail($id);
        if(!$target){
            return redirect()->back()->with(session()->flash('alert-danger', 'Target not found!'));
        }
        $target->delete();
        return redirect()->back()->with(session()->flash('alert-success', 'Target Deleted successfully!'));
    }
}
