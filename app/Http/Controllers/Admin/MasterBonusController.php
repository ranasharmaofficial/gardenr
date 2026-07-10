<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\UserType;
use App\Models\MasterYearlyBonus;
use App\Models\MasterDesignation;

class MasterBonusController extends Controller
{
    public function index(Request $request){
        $user_type =  UserType::where('status', 1)->where('id', '!=', 1)->get();
        // dd($user_type);
            $query = MasterYearlyBonus::select([
                'master_yearly_bonuses.*',
                'user_types.name as userType',
                'master_designations.name as userDesignation',
            ])->join('user_types', 'user_types.id', '=', 'master_yearly_bonuses.user_type')
              ->leftJoin('master_designations', 'master_designations.id', '=', 'master_yearly_bonuses.user_designation');

            if ($request->type) {
                $query->where('master_yearly_bonuses.user_type', $request->type);
            }

            if ($request->user_designation) {
                $query->where('master_yearly_bonuses.user_designation', $request->user_designation);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_yearly_bonuses.title', 'like', "%$search%")
                    ->orWhere('master_yearly_bonuses.value', 'like', "%$search%");
                });
            }

            $yearly_bonus_list = $query->paginate(30);

        $datas = [
            'yearly_bonus_list' => $yearly_bonus_list,
            'user_type' => $user_type,
            'request' => $request,
            'page_title' => 'Yearly Bonus List',
        ];
        return view('admin.master.yearly_bonus.index', $datas);
    }

    public function fetchAgreementData(Request $request)
    {
         $query = MasterYearlyBonus::select([
                'master_yearly_bonuses.*',
                'user_types.name as userType',
                'master_designations.name as userDesignation',
            ])->join('user_types', 'user_types.id', '=', 'master_yearly_bonuses.user_type')
              ->leftJoin('master_designations', 'master_designations.id', '=', 'master_yearly_bonuses.user_designation');

            if ($request->type) {
                $query->where('master_yearly_bonuses.user_type', $request->type);
            }

            if ($request->user_designation) {
                $query->where('master_yearly_bonuses.user_designation', $request->user_designation);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_yearly_bonuses.target', 'like', "%$search%")
                    ->orWhere('master_yearly_bonuses.target_value', 'like', "%$search%");
                });
            }

            $yearly_bonus_list = $query->paginate(30);

        if ($request->ajax()) {
            return view('admin.master.yearly_bonus.table_ajax', compact('yearly_bonus_list'))->render();
        }
    }

    /* Store New Session */
   public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'value' => 'required',
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

        $target = new MasterYearlyBonus();
        $target->title = $request->title;
        $target->value = $request->value;
        $target->status = $request->status;
        $target->user_type = $request->type;
        $target->user_designation = $request->user_designation_id;
        $target->created_by = session('LoggedUser')->id;
        $target->save();

        return response()->json(['status' => true, 'message' => 'Bonus Added successfully!']);
    }


    public function edit($id)
    {
        $bonus = MasterYearlyBonus::find($id);
        $user_type =  UserType::where('status', 1)->where('id', '!=', 1)->get();
        $user_designation_details =  MasterDesignation::where('id', $bonus->user_designation)->first();
        $page_title = 'Edit Yearly Bonus';
        return view('admin.master.yearly_bonus.edit', compact('bonus', 'page_title', 'user_type', 'user_designation_details'));
    }


    public function update(Request $request, $id)
    {
         $request->validate([
            'title' => 'required',
            'value' => 'required',
            'type' => 'required',
            'user_designation_id' => 'required',
            'status' => 'required',
        ]);



        $target = MasterYearlyBonus::findOrFail($id);
        $target->title = $request->title;
        $target->value = $request->value;
        $target->status = $request->status;
        $target->user_type = $request->type;
        $target->user_designation = $request->user_designation_id;
        $target->created_by = session('LoggedUser')->id;
        $target->save();
        return response()->json(['status' => true, 'message' => 'Bonus Updated successfully!']);
    }
}
