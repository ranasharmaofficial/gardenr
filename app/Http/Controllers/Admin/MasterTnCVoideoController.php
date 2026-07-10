<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MasterAgreement;
use App\Models\UserType;
use App\Models\MasterTncVideo;
use App\Models\MasterOffer;
use App\Models\MasterDesignation;

class MasterTnCVoideoController extends Controller
{
    public function index(Request $request){
        $user_type =  UserType::where('status', 1)->where('id', 6)->get();
        // dd($user_type);
         $query = MasterTncVideo::select([
                'master_tnc_videos.*',
                'user_types.name as userType',
                'master_designations.name as userDesignation',
            ])->join('user_types', 'user_types.id', '=', 'master_tnc_videos.user_type')
              ->leftJoin('master_designations', 'master_designations.id', '=', 'master_tnc_videos.user_designation');

            if ($request->type) {
                $query->where('master_tnc_videos.user_type', $request->type);
            }

            if ($request->user_designation) {
                $query->where('master_tnc_videos.user_designation', $request->user_designation);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_tnc_videos.title', 'like', "%$search%")
                    ->orWhere('master_tnc_videos.type', 'like', "%$search%");
                });
            }

            $offer_list = $query->orderBy('id', 'DESC')->paginate(30);

        $datas = [
            'offer_list' => $offer_list,
            'user_type' => $user_type,
            'request' => $request,
            'page_title' => 'T&C Video List',
        ];
        return view('admin.master.tncvideo.index', $datas);
    }

    public function fetchAgreementData(Request $request)
    {
        $query = MasterTncVideo::select([
                'master_tnc_videos.*',
                'user_types.name as userType',
                'master_designations.name as userDesignation',
            ])->join('user_types', 'user_types.id', '=', 'master_tnc_videos.user_type')
              ->leftJoin('master_designations', 'master_designations.id', '=', 'master_tnc_videos.user_designation');

            if ($request->type) {
                $query->where('master_tnc_videos.user_type', $request->type);
            }

            if ($request->user_designation) {
                $query->where('master_tnc_videos.user_designation', $request->user_designation);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_tnc_videos.title', 'like', "%$search%")
                    ->orWhere('master_tnc_videos.type', 'like', "%$search%");
                });
            }

            $offer_list = $query->orderBy('id', 'DESC')->paginate(30);

        if ($request->ajax()) {
            return view('admin.master.tncvideo.offer_table_ajax', compact('offer_list'))->render();
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
            'video_url' => 'required',
        ]);

        // if ($request->hasFile('file')) {
        //     $ext = $request->file->getClientOriginalExtension();
        //     $fileName = time() . rand(1, 999) . '.' . $ext;
        //     $request->file->move(public_path('uploads/offer'), $fileName);
        //     $data['file'] = 'uploads/offer/' . $fileName;
        // } else {
        //     $data['file'] = NULL;
        // }

        $offer = new MasterTncVideo();
        $offer->title = $request->title;
        $offer->status = $request->status;
        $offer->video_url = $request->video_url;
        $offer->user_type = $request->type;
        $offer->user_designation = $request->user_designation_id;
        $offer->created_by = session('LoggedUser')->id;
        $offer->save();

        return response()->json(['status' => true, 'message' => 'Added successfully!']);
    }


    public function edit($id)
    {
        $agreement = MasterTncVideo::find($id);
        $user_type =  UserType::where('status', 1)->where('id', '!=', 1)->get();
        $user_designation_details =  MasterDesignation::where('id', $agreement->user_designation)->first();
        $page_title = 'Edit T&C Video';
        return view('admin.master.tncvideo.edit_offer', compact('agreement', 'page_title', 'user_type', 'user_designation_details'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'user_designation_id' => 'required',
            'status' => 'required',
            'video_url' => 'required',
        ]);

        // if ($request->hasFile('file')) {
        //     $ext = $request->file->getClientOriginalExtension();
        //     $fileName = time() . rand(1, 999) . '.' . $ext;
        //     $request->file->move(public_path('uploads/offer'), $fileName);
        //     $data['file'] = 'uploads/offer/' . $fileName;
        // } else {
        //     $data['file'] = NULL;
        // }

        $offer = MasterTncVideo::findOrFail($id);
        $offer->title = $request->title;
        $offer->status = $request->status;
        $offer->user_type = $request->type;
        $offer->user_designation = $request->user_designation_id;
        $offer->video_url = $request->video_url;
        $offer->created_by = session('LoggedUser')->id;
        $offer->save();

       return response()->json(['status' => true, 'message' => 'Updated successfully!']);
    }

    public function deletetndcVidData($id){
        $delete_offer = MasterTncVideo::find($id);
        $delete_offer->delete();
        return back()->with(session()->flash('alert-success', 'Deleted Successfully'));
    }

}
