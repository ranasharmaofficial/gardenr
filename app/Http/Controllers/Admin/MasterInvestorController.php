<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\UserType;
use App\Models\MasterInvestor;
use App\Models\MasterDesignation;

class MasterInvestorController extends Controller
{
    public function index(Request $request){
        $user_type =  UserType::where('status', 1)->where('id', '!=', 1)->get();
        $query = MasterInvestor::select([
            'master_investors.*',
            // 'user_types.name as userType',
            // 'master_designations.name as userDesignation',
        ]);
            // ->join('user_types', 'user_types.id', '=', 'master_investors.user_type')
            // ->leftJoin('master_designations', 'master_designations.id', '=', 'master_investors.user_designation');

        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('master_investors.title', 'like', "%$search%")
                ->orWhere('master_investors.percentage', 'like', "%$search%");
            });
        }

        $master_investor = $query->paginate(30);

        $datas = [
            'master_investor' => $master_investor,
            'user_type' => $user_type,
            'request' => $request,
            'page_title' => 'Investor Investment List',
        ];
        return view('admin.master.master_investor.index', $datas);
    }

    public function fetchInvestorInvestmentData(Request $request)
    {
         $query = MasterInvestor::select([
            'master_investors.*',
            // 'user_types.name as userType',
            // 'master_designations.name as userDesignation',
        ]);
            // ->join('user_types', 'user_types.id', '=', 'master_investors.user_type')
            // ->leftJoin('master_designations', 'master_designations.id', '=', 'master_investors.user_designation');

        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('master_investors.title', 'like', "%$search%")
                ->orWhere('master_investors.percentage', 'like', "%$search%");
            });
        }

        $master_investor = $query->paginate(30);

        if ($request->ajax()) {
            return view('admin.master.master_investor.table_ajax', compact('master_investor'))->render();
        }
    }

    /* Store New Session */
   public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'percentage' => 'required',

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

        $target = new MasterInvestor();
        $target->title = $request->title;
        $target->percentage = $request->percentage;
        $target->status = $request->status;
        $target->save();

        return response()->json(['status' => true, 'message' => 'Added successfully!']);
    }


   public function edit($id)
    {
        return response()->json(MasterInvestor::find($id));
    }


    /* Update Branch */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'percentage' => 'nullable|string|max:50',
            'status' => 'required|in:0,1',
        ]);

        $branch = MasterInvestor::findOrFail($id);

        $branch->update([
            'title' => $request->title,
            'percentage' => $request->percentage,
            'status' => $request->status,
        ]);

        return response()->json(['success' => true, 'message' => 'Updated successfully!']);
    }



}
