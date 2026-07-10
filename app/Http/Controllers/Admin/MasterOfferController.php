<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MasterAgreement;
use App\Models\UserType;
use App\Models\MasterOffer;

class MasterOfferController extends Controller
{
    public function index(Request $request){
        $user_type =  UserType::where('status', 1)->where('id', 6)->get();
        // dd($user_type);
         $query = MasterOffer::select([
                'master_offers.*',
                'user_types.name as userType',
                'master_designations.name as userDesignation',
            ])->join('user_types', 'user_types.id', '=', 'master_offers.user_type')
              ->leftJoin('master_designations', 'master_designations.id', '=', 'master_offers.user_designation');

            if ($request->type) {
                $query->where('master_offers.user_type', $request->type);
            }

            if ($request->user_designation) {
                $query->where('master_offers.user_designation', $request->user_designation);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_offers.title', 'like', "%$search%")
                    ->orWhere('master_offers.type', 'like', "%$search%");
                });
            }

            $offer_list = $query->paginate(30);

        $datas = [
            'offer_list' => $offer_list,
            'user_type' => $user_type,
            'request' => $request,
            'page_title' => 'Offer List',
        ];
        return view('admin.master.offers.index', $datas);
    }

    public function fetchAgreementData(Request $request)
    {
        $query = MasterOffer::select([
                'master_offers.*',
                'user_types.name as userType',
                'master_designations.name as userDesignation',
            ])->join('user_types', 'user_types.id', '=', 'master_offers.user_type')
              ->leftJoin('master_designations', 'master_designations.id', '=', 'master_offers.user_designation');

            if ($request->type) {
                $query->where('master_offers.user_type', $request->type);
            }

            if ($request->user_designation) {
                $query->where('master_offers.user_designation', $request->user_designation);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_offers.title', 'like', "%$search%")
                    ->orWhere('master_offers.type', 'like', "%$search%");
                });
            }

            $offer_list = $query->paginate(30);

        if ($request->ajax()) {
            return view('admin.master.offers.offer_table_ajax', compact('offer_list'))->render();
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
            'offer_type' => 'required',
            'shorts_video_url' => 'nullable',
            'file' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ], [
            'file.max' => 'The file must not be greater than 2 MB.',
        ]);

        if ($request->hasFile('file')) {
            $ext = $request->file->getClientOriginalExtension();
            $fileName = time() . rand(1, 999) . '.' . $ext;
            $request->file->move(public_path('uploads/offer'), $fileName);
            $data['file'] = 'uploads/offer/' . $fileName;
        } else {
            $data['file'] = NULL;
        }

        $offer = new MasterOffer();
        $offer->title = $request->title;
        $offer->status = $request->status;
        $offer->offer_type = $request->offer_type;
        $offer->shorts_video_url = $request->shorts_video_url ?? null;
        $offer->file = $data['file'] ?? null;
        $offer->user_type = $request->type;
        $offer->user_designation = $request->user_designation_id;
        $offer->created_by = session('LoggedUser')->id;
        $offer->save();

        return response()->json(['status' => true, 'message' => 'Offer Added successfully!']);
    }


    public function edit($id)
    {
        $offer = MasterOffer::find($id);
        $user_type =  UserType::where('status', 1)->where('id', '!=', 1)->get();
        $user_designation_details =  MasterDesignation::where('id', $offer->user_designation)->first();
        $page_title = 'Edit Offer';
        return view('admin.master.offers.edit_offer', compact('offer', 'page_title', 'user_type', 'user_designation_details'));
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
            $request->file->move(public_path('uploads/offer'), $fileName);
            $data['file'] = 'uploads/offer/' . $fileName;
        } else {
            $data['file'] = NULL;
        }

        $offer = MasterOffer::findOrFail($id);
        $offer->title = $request->title;
        $offer->status = $request->status;
        if( $data['file'] != NULL ){
             $offer->file = $data['file'];
        }
        $offer->user_type = $request->type;
        $offer->user_designation = $request->user_designation_id;
        $offer->created_by = session('LoggedUser')->id;
        $offer->save();

       return response()->json(['status' => true, 'message' => 'Offer Updated successfully!']);
    }

    public function deleteOfferData($id){
        $delete_offer = MasterOffer::find($id);
        $delete_offer->delete();
        return back()->with(session()->flash('alert-success', 'Offer Deleted Successfully'));
    }

}
