<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MasterAgreement;
use App\Models\UserType;
use App\Models\MasterDesignation;

class MasterAgreementController extends Controller
{
    public function index(Request $request){
        $user_type =  UserType::where('status', 1)->where('id', '!=', 1)->get();
        // dd($user_type);
         $query = MasterAgreement::select([
                'master_agreements.*',
                'user_types.name as userType',
                'master_designations.name as userDesignation',
            ])->join('user_types', 'user_types.id', '=', 'master_agreements.user_type')
              ->leftJoin('master_designations', 'master_designations.id', '=', 'master_agreements.user_designation');

            if ($request->type) {
                $query->where('master_agreements.user_type', $request->type);
            }

            if ($request->user_designation) {
                $query->where('master_agreements.user_designation', $request->user_designation);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_agreements.title', 'like', "%$search%")
                    ->orWhere('master_agreements.type', 'like', "%$search%");
                });
            }

            $agreement_list = $query->paginate(30);

        $datas = [
            'agreement_list' => $agreement_list,
            'user_type' => $user_type,
            'request' => $request,
            'page_title' => 'Agreement List',
        ];
        return view('admin.master.agreement.index', $datas);
    }

    public function fetchAgreementData(Request $request)
    {
        $query = MasterAgreement::select([
                'master_agreements.*',
                'user_types.name as userType',
                'master_designations.name as userDesignation',
            ])->join('user_types', 'user_types.id', '=', 'master_agreements.user_type')
              ->leftJoin('master_designations', 'master_designations.id', '=', 'master_agreements.user_designation');

            if ($request->type) {
                $query->where('master_agreements.user_type', $request->type);
            }

            if ($request->user_designation) {
                $query->where('master_agreements.user_designation', $request->user_designation);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_agreements.title', 'like', "%$search%")
                    ->orWhere('master_agreements.type', 'like', "%$search%");
                });
            }

            $agreement_list = $query->paginate(30);

        if ($request->ajax()) {
            return view('admin.master.agreement.agreement_table_ajax', compact('agreement_list'))->render();
        }
    }

    /* Store New Session */
   public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'user_designation_id' => 'required',
            'status' => 'required',
            'file' => 'required|mimes:pdf|max:10240',
        ], [
            'file.max' => 'The file must not be greater than 10 MB.',
        ]);

        if ($request->hasFile('file')) {
            $ext = $request->file->getClientOriginalExtension();
            $fileName = time() . rand(1, 999) . '.' . $ext;
            $request->file->move(public_path('uploads/agreement'), $fileName);
            $data['file'] = 'uploads/agreement/' . $fileName;
        } else {
            $data['file'] = NULL;
        }

        $agreement = new MasterAgreement();
        $agreement->title = $request->title;
        $agreement->status = $request->status;
        $agreement->file = $data['file'];
        $agreement->user_type = $request->type;
        $agreement->user_designation = $request->user_designation_id;
        $agreement->created_by = session('LoggedUser')->id;
        $agreement->save();

        return response()->json(['status' => true, 'message' => 'Agreement Added successfully!']);
    }


    public function edit($id)
    {
        $agreement = MasterAgreement::find($id);
        $user_type =  UserType::where('status', 1)->where('id', '!=', 1)->get();
        $user_designation_details =  MasterDesignation::where('id', $agreement->user_designation)->first();
        $page_title = 'Edit Agreement';
        return view('admin.master.agreement.edit_agreement', compact('agreement', 'page_title', 'user_type', 'user_designation_details'));
    }


    public function update(Request $request, $id)
    {
         $request->validate([
            'title' => 'required',
            'type' => 'required',
            'user_designation_id' => 'required',
            'status' => 'required',
            'file' => 'nullable|mimes:pdf|max:10240',
        ], [
            'file.max' => 'The file must not be greater than 10 MB.',
        ]);

        if ($request->hasFile('file')) {
            $ext = $request->file->getClientOriginalExtension();
            $fileName = time() . rand(1, 999) . '.' . $ext;
            $request->file->move(public_path('uploads/agreement'), $fileName);
            $data['file'] = 'uploads/agreement/' . $fileName;
        } else {
            $data['file'] = NULL;
        }

        $agreement = MasterAgreement::findOrFail($id);
        $agreement->title = $request->title;
        $agreement->status = $request->status;
        if( $data['file'] != NULL ){
             $agreement->file = $data['file'];
        }
        $agreement->user_type = $request->type;
        $agreement->user_designation = $request->user_designation_id;
        $agreement->created_by = session('LoggedUser')->id;
        $agreement->save();

       return response()->json(['status' => true, 'message' => 'Agreement Updated successfully!']);
    }
}
