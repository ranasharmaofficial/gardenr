<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MasterNotice;
use App\Models\UserType;
use App\Models\MasterDesignation;

class MasterNoticeController extends Controller
{
    // public function index(Request $request){
    //     $user_type =  UserType::where('status', 1)->where('id', '!=', 1)->get();
    //     // dd($user_type);
    //      $query = MasterNotice::select([
    //             'master_notices.*',
    //             'user_types.name as userType',
    //             'master_designations.name as userDesignation',
    //         ])->join('user_types', 'user_types.id', '=', 'master_notices.user_type')
    //           ->leftJoin('master_designations', 'master_designations.id', '=', 'master_notices.user_designation');

    //         if ($request->type) {
    //             $query->where('master_notices.user_type', $request->type);
    //         }

    //         if ($request->user_designation) {
    //             $query->where('master_notices.user_designation', $request->user_designation);
    //         }

    //         if ($request->search) {
    //             $search = $request->search;
    //             $query->where(function ($q) use ($search) {
    //                 $q->where('master_notices.title', 'like', "%$search%")
    //                 ->orWhere('master_notices.type', 'like', "%$search%");
    //             });
    //         }

    //         $notice_list = $query->paginate(30);

    //     $datas = [
    //         'notice_list' => $notice_list,
    //         'user_type' => $user_type,
    //         'request' => $request,
    //         'page_title' => 'Notice List',
    //     ];
    //     return view('admin.master.notice.index', $datas);
    // }
    public function index(Request $request)
    {

        $type = [
            'Vivah Mitra',
            'Employee'
        ];
        $query = MasterNotice::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }



        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('type', 'like', "%$search%");
            });
        }

        $notice_list = $query->paginate(30);

        $datas = [
            'notice_list' => $notice_list,
            'type' => $type,
            'request' => $request,
            'page_title' => 'Notice List',
        ];
        return view('admin.master.notice.index', $datas);
    }

    public function fetchNoticeData(Request $request)
    {
        $type = [
            'Vivah Mitra',
            'Employee'
        ];
        $query = MasterNotice::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }


        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('type', 'like', "%$search%");
            });
        }

        $notice_list = $query->paginate(30);
        if ($request->ajax()) {
            return view('admin.master.notice.notice_table_ajax', compact('notice_list'))->render();
        }
    }

    /* Store New Session */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'status' => 'required',
            'file' => 'required',
        ], [
            'file.max' => 'The file must not be greater than 10 MB.',
        ]);

        if ($request->hasFile('file')) {
            $ext = $request->file->getClientOriginalExtension();
            $fileName = time() . rand(1, 999) . '.' . $ext;
            $request->file->move(public_path('uploads/notice'), $fileName);
            $data['file'] = 'uploads/notice/' . $fileName;
        } else {
            $data['file'] = NULL;
        }

        $agreement = new MasterNotice();
        $agreement->title = $request->title;
        $agreement->status = $request->status;
        $agreement->file = $data['file'];
        $agreement->type = $request->type;
        $agreement->created_by = session('LoggedUser')->id;
        $agreement->save();

        return response()->json(['status' => true, 'message' => 'Notice Added successfully!']);
    }


    public function edit($id)
    {
        $notice = MasterNotice::find($id);
        $type = [
            'Vivah Mitra',
            'Employee'
        ];
        // $user_type =  UserType::where('status', 1)->where('id', '!=', 1)->get();
        // $user_designation_details =  MasterDesignation::where('id', $notice->user_designation)->first();
        $page_title = 'Edit Notice';
        return view('admin.master.notice.edit_notice', compact('notice', 'page_title','type'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            // 'user_designation_id' => 'required',
            'status' => 'required',
            'file' => 'nullable|mimes:pdf|max:10240',
        ], [
            'file.max' => 'The file must not be greater than 10 MB.',
        ]);

        if ($request->hasFile('file')) {
            $ext = $request->file->getClientOriginalExtension();
            $fileName = time() . rand(1, 999) . '.' . $ext;
            $request->file->move(public_path('uploads/notice'), $fileName);
            $data['file'] = 'uploads/notice/' . $fileName;
        } else {
            $data['file'] = NULL;
        }

        $notice = MasterNotice::findOrFail($id);
        $notice->title = $request->title;
        $notice->status = $request->status;
        if ($data['file'] != NULL) {
            $notice->file = $data['file'];
        }
        $notice->type = $request->type;
        // $notice->user_designation = $request->user_designation_id;
        $notice->created_by = session('LoggedUser')->id;
        $notice->save();

        return response()->json(['status' => true, 'message' => 'Notice Updated successfully!']);
    }

    public function deleteNoticeData($id)
    {
        $notice = MasterNotice::find($id);
        if ($notice) {
            $notice->delete();
            // return response()->json(['status' => true, 'message' => 'Notice deleted successfully!']);
            return redirect()->back()->with('alert-danger', 'Notice deleted successfully');
        } else {
            return redirect()->back()->with('alert-danger', 'Something went wrong');
        }
    }

}
