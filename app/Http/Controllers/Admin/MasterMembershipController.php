<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\UserType;
use App\Models\MasterDesignation;
use App\Models\MasterMembership;
use App\Models\Member;
use App\Models\User;
use App\Models\State;
use App\Models\District;
use App\Models\CardTransaction;
use Illuminate\Support\Facades\Validator;   // ← ADD THIS
use Illuminate\Support\Facades\DB;

class MasterMembershipController extends Controller
{
    public function getDesignationByUserType($state_id)
    {
        $cities = MasterDesignation::where('user_type', $state_id)->get(['id', 'name']);
        return response()->json($cities);
    }

    public function index(Request $request){
        $user_type =  UserType::where('status', 1)->where('id', '!=', 1)->get();
        // $designayion_list =  MasterDesignation::latest()->get();

        $query = MasterMembership::select([
                'master_memberships.*',
                'users.first_name as addedByName',
                'members.name as memberName',
                'l.first_name as leaderName',
                'vm.first_name as vivahMitraName',
            ])->join('users', 'users.id', '=', 'master_memberships.created_by')
              ->leftJoin('members', 'members.id', '=', 'master_memberships.member_id')
              ->leftJoin('users as l', 'l.id', '=', 'master_memberships.leader_id')
              ->leftJoin('users as vm', 'vm.id', '=', 'master_memberships.vivah_mitra_id');

            if ($request->vivah_mitra) {
                $query->where('master_memberships.vivah_mitra_id', $request->vivah_mitra);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_memberships.membership_number', 'like', "%$search%")
                    ->orWhere('members.name', 'like', "%$search%");
                });
            }

            $membership_list = $query->orderBy('master_memberships.id', 'DESC')->paginate(20);
            // dd($membership_list);
        $total_card = MasterMembership::count();
        $total_used_card = MasterMembership::where('is_used', 1)->count();
        $total_available_card = MasterMembership::where('is_used', 0)->count();
        $total_issue_cards = CardTransaction::where('type', 'issue')->where('from_user_id', NULL)->sum('quantity');
        $master_membership_generate = MasterMembership::groupBy('created_date')->orderBy('created_date', 'DESC')->get(['created_date', DB::raw('COUNT(*) as count')]);
        // dd($master_membership_generate);
        $datas = [
            'membership_list' => $membership_list,
            'total_card' => $total_card,
            'total_used_card' => $total_used_card,
            'total_available_card' => $total_available_card,
            'total_issue_cards' => $total_issue_cards,
            'request' => $request,
            'master_membership_generate' => $master_membership_generate,
            'page_title' => 'Generate Membership',
            'vivah_mitra_list' => User::where('user_type_id', 6)->get(),
        ];
        return view('admin.membership.index', $datas);
    }

    public function fetchMembershipData(Request $request)
    {
        $query = MasterMembership::select([
                'master_memberships.*',
                'users.first_name as addedByName',
                'members.name as memberName',
                'l.first_name as leaderName',
                'vm.first_name as vivahMitraName',
            ])->join('users', 'users.id', '=', 'master_memberships.created_by')
              ->leftJoin('members', 'members.id', '=', 'master_memberships.member_id')
              ->leftJoin('users as l', 'l.id', '=', 'master_memberships.leader_id')
              ->leftJoin('users as vm', 'vm.id', '=', 'master_memberships.vivah_mitra_id');

            if ($request->vivah_mitra) {
                $query->where('master_memberships.vivah_mitra_id', $request->vivah_mitra);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_memberships.membership_number', 'like', "%$search%")
                    ->orWhere('master_memberships.membership_number', 'like', "%$search%");
                });
            }

            $membership_list = $query->orderBy('master_memberships.id', 'DESC')->paginate(20);

        if ($request->ajax()) {
            return view('admin.membership.table_ajax', compact('membership_list'))->render();
        }
    }

    /* Store New Session */
    public function store(Request $request){
        $request->validate([
            'number' => 'required|numeric|min:50|max:200',
            'created_date' => 'required|date|in:' . now()->toDateString(),
        ]);

        $count = (int) $request->number;  // How many membership numbers to generate
        $generated = [];

        for ($i = 0; $i < $count; $i++) {

            do {
                // Generate remaining 12 digits (since 50 + 12 digits = 14 digits total)
                $random = str_pad(mt_rand(0, 9999999999), 10, '0', STR_PAD_LEFT);

                // Final code: 50 + 12 digits = 14 digits
                $newCode = '50' . $random;

                // Check uniqueness in DB
                $exists = MasterMembership::where('membership_number', $newCode)->exists();

            } while ($exists);

            // Save into DB
            MasterMembership::create([
                'membership_number' => $newCode,
                'created_date'      => $request->created_date,
                // 'vivah_mitra_id'      => $request->vivah_mitra_id,
                'created_by'        => session('LoggedUser')->id,
            ]);

            $generated[] = $newCode;
        }

        return response()->json([
            'status' => true,
            'message'  => 'Membership numbers generated successfully!',
            'generated_codes' => $generated  // optional, shows generated numbers
        ]);
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


    public function addMember(Request $request){
        // dd(session('LoggedUser'));
        $user_type = session('LoggedUser')->user_type_id;
        $userId = session('LoggedUser')->user_id;
        if($user_type==1){
            $vivah_mitra_list =  User::where('status', 1)->where('user_type_id', 6)->get();
            $datas = [
                // 'user_type' => $user_type,
                'request' => $request,
                'vivah_mitra_list' => $vivah_mitra_list,
                'state_bihar_list' =>  State::where('id', 5)->get(),
                'district_bihar_list' =>  District::where('state_id', 5)->get(),
                'page_title' => 'Add Member',
            ];
            return view('admin.membership.add_member', $datas);
        }
        if($user_type==6){
            $vivah_mitra_list =  User::where('status', 1)->where('id', $userId)->get();
            $datas = [
                // 'user_type' => $user_type,
                'request' => $request,
                'vivah_mitra_list' => $vivah_mitra_list,
                'state_bihar_list' =>  State::where('id', 5)->get(),
                'district_bihar_list' =>  District::where('state_id', 5)->get(),
                'page_title' => 'Add Member',
            ];
            return view('admin.membership.add_member', $datas);
        }

    }

    public function checkMembership(Request $request)
    {
        $membership = DB::table('master_memberships')
            ->where('membership_number', $request->membership_number)
            ->first();

        if (!$membership) {
            return response()->json(['status' => 'not_found']);
        }

        // If membership is already used
        if ($membership->is_used == 1) {

            // Get member name from members table
            $member = DB::table('members')
                ->where('id', $membership->member_id)
                ->first();

            return response()->json([
                'status' => 'used',
                'member_name' => $member ? $member->name : 'Unknown'
            ]);
        }

        // Not used
        return response()->json(['status' => 'unused']);
    }

    /** save members store */

    public function storeMemberData(Request $request){
        try {

            $validator = Validator::make($request->all(), [
                'membership_number' => 'required|exists:master_memberships,membership_number',
                'leader_id' => 'required',
                'name' => 'required',
                'father_husband' => 'required',
                'mobile' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();

            // Create Member
            $member = new Member();
            $member->leader_id = $request->leader_id;
            $member->membership_number = $request->membership_number;
            $member->name = $request->name;
            $member->father_husband = $request->father_husband;
            $member->address = $request->address;
            $member->post = $request->post;
            $member->state = $request->state;
            $member->district = $request->district;
            $member->pincode = $request->pincode;
            $member->mobile = $request->mobile;
            $member->whatsapp = $request->whatsapp;

            // Ayushmati Details
            $member->ayushmati_girl_name = $request->ayushmati_girl_name;
            $member->ayushmati_age = $request->ayushmati_age;
            $member->ayushmati_qualification = $request->ayushmati_qualification;
            $member->ayushmati_father_occupation = $request->ayushmati_father_occupation;
            $member->ayushmati_father_husband_name = $request->ayushmati_father_husband_name;
            $member->ayushmati_expected_marriage_month = $request->ayushmati_expected_marriage_month;
            $member->ayushmati_expected_marriage_year = $request->ayushmati_expected_marriage_year;

            // Sister Details
            $member->sister_name_1 = $request->sister_name_1;
            $member->sister_qualification_1 = $request->sister_qualification_1;
            $member->sister_age_1 = $request->sister_age_1;

            $member->sister_name_2 = $request->sister_name_2;
            $member->sister_qualification_2 = $request->sister_qualification_2;
            $member->sister_age_2 = $request->sister_age_2;

            $member->sister_name_3 = $request->sister_name_3;
            $member->sister_qualification_3 = $request->sister_qualification_3;
            $member->sister_age_3 = $request->sister_age_3;

            $member->expected_marriage_package = $request->expected_marriage_package;
            $member->received_card_amount = $request->received_card_amount;
            $member->card_price = $request->card_price;
            $member->status = 1;
            $member->card_type = 'physical';

            $member->save(); // save member

            // Update master membership
            DB::table('master_memberships')
                ->where('membership_number', $request->membership_number)
                ->update([
                    'is_used' => 1,
                    'member_id' => $member->id,
                    'leader_id' => $request->leader_id,
                    'used_date' => date('Y-m-d')
                ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Member Saved Successfully!'
            ], 200);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }


    }


    public function addDigitalCardMember(Request $request){
        $vivah_mitra_list =  User::where('status', 1)->where('user_type_id', 6)->get();
        // $designayion_list =  MasterDesignation::latest()->get();
        $datas = [
            // 'user_type' => $user_type,
            'request' => $request,
            'vivah_mitra_list' => $vivah_mitra_list,
            'state_bihar_list' =>  State::where('id', 5)->get(),
            'district_bihar_list' =>  District::where('state_id', 5)->get(),
            'page_title' => 'Add Digital Card Member',
        ];
        return view('admin.membership.add_digital_card_member', $datas);
    }

    public function storeDigitalCardMemberData(Request $request){
        try {

            $validator = Validator::make($request->all(), [
                // 'membership_number' => 'required|exists:master_memberships,membership_number',
                'leader_id' => 'required',
                'name' => 'required',
                'father_husband' => 'required',
                'mobile' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            do {
                // Generate remaining 12 digits (since 50 + 12 digits = 14 digits total)
                $random = str_pad(mt_rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
                // Final code: 50 + 12 digits = 14 digits
                $newMembershipCode = '50' . $random;
                // Check uniqueness in DB
                $exists = MasterMembership::where('membership_number', $newMembershipCode)->exists();

            } while ($exists);

            // Save into DB
            $saveNewMembership = new MasterMembership();
            $saveNewMembership->membership_number = $newMembershipCode;
            $saveNewMembership->created_date = date('Y-m-d');
            $saveNewMembership->created_by = session('LoggedUser')->id;
            $saveNewMembership->save();

            // Create Member
            $member = new Member();
            $member->leader_id = $request->leader_id;
            $member->membership_number = $newMembershipCode;
            $member->name = $request->name;
            $member->father_husband = $request->father_husband;
            $member->address = $request->address;
            $member->post = $request->post;
            $member->state = $request->state;
            $member->district = $request->district;
            $member->pincode = $request->pincode;
            $member->mobile = $request->mobile;
            $member->whatsapp = $request->whatsapp;

            // Ayushmati Details
            $member->ayushmati_girl_name = $request->ayushmati_girl_name;
            $member->ayushmati_age = $request->ayushmati_age;
            $member->ayushmati_qualification = $request->ayushmati_qualification;
            $member->ayushmati_father_occupation = $request->ayushmati_father_occupation;
            $member->ayushmati_father_husband_name = $request->ayushmati_father_husband_name;
            $member->ayushmati_expected_marriage_month = $request->ayushmati_expected_marriage_month;
            $member->ayushmati_expected_marriage_year = $request->ayushmati_expected_marriage_year;

            // Sister Details
            $member->sister_name_1 = $request->sister_name_1;
            $member->sister_qualification_1 = $request->sister_qualification_1;
            $member->sister_age_1 = $request->sister_age_1;

            $member->sister_name_2 = $request->sister_name_2;
            $member->sister_qualification_2 = $request->sister_qualification_2;
            $member->sister_age_2 = $request->sister_age_2;

            $member->sister_name_3 = $request->sister_name_3;
            $member->sister_qualification_3 = $request->sister_qualification_3;
            $member->sister_age_3 = $request->sister_age_3;

            $member->expected_marriage_package = $request->expected_marriage_package;
            $member->status = 1;
            $member->card_type = 'digital';

            $member->save(); // save member

            // Update master membership
            DB::table('master_memberships')
                ->where('membership_number', $newMembershipCode)
                ->update([
                    'is_used' => 1,
                    'member_id' => $member->id,
                    'leader_id' => $request->leader_id,
                    'used_date' => date('Y-m-d')
                ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Digital Membership Card Saved Successfully!'
            ], 200);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }


    }


    public function viewVivahMitraMemberships(Request $request, $id){
        $user_type =  UserType::where('status', 1)->where('id', '!=', 1)->get();
        $query = MasterMembership::where('master_memberships.vivah_mitra_id', $id)->select([
                'master_memberships.*',
                'users.first_name as addedByName',
                'members.name as memberName',
                'l.first_name as leaderName',
                'vm.first_name as vivahMitraName',
            ])->join('users', 'users.id', '=', 'master_memberships.created_by')
              ->leftJoin('members', 'members.id', '=', 'master_memberships.member_id')
              ->leftJoin('users as l', 'l.id', '=', 'master_memberships.leader_id')
              ->leftJoin('users as vm', 'vm.id', '=', 'master_memberships.vivah_mitra_id');

              if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_memberships.membership_number', 'like', "%$search%")
                    ->orWhere('members.memberName', 'like', "%$search%");
                });
            }

              $membership_list = $query->orderBy('master_memberships.id', 'DESC')->paginate(100);
              $vivahMitra = User::where('id', $id)->first();
        $datas = [
            'vivahMitra' => $vivahMitra,
            'vivah_mitra_id' => $id,
            'membership_list' => $membership_list,
            'page_title' => 'Showing Membership of <span style="color:green;font-size:17px;font-weight:bold;">'.$vivahMitra->first_name.' - '.$vivahMitra->employee_code.'</span>',
            'vivah_mitra_list' => User::where('user_type_id', 6)->get(),
        ];
        return view('admin.membership.individual_membersship_of_vivah_mitra', $datas);
    }

    public function fetchVivahMitraMemberships(Request $request)
    {
        $query = MasterMembership::select([
                'master_memberships.*',
                'users.first_name as addedByName',
                'members.name as memberName',
                'l.first_name as leaderName',
                'vm.first_name as vivahMitraName',
            ])->join('users', 'users.id', '=', 'master_memberships.created_by')
              ->leftJoin('members', 'members.id', '=', 'master_memberships.member_id')
              ->leftJoin('users as l', 'l.id', '=', 'master_memberships.leader_id')
              ->leftJoin('users as vm', 'vm.id', '=', 'master_memberships.vivah_mitra_id');

            if ($request->vivah_mitra) {
                $query->where('master_memberships.vivah_mitra_id', $request->vivah_mitra);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_memberships.membership_number', 'like', "%$search%")
                    ->orWhere('members.memberName', 'like', "%$search%");
                });
            }

            $membership_list = $query->orderBy('master_memberships.id', 'DESC')->paginate(100);

        if ($request->ajax()) {
            return view('admin.membership.individual_membersship_of_vivah_mitra_ajax', compact('membership_list'))->render();
        }
    }


    public function exportVivahMitraMemberships(Request $request, $id){
        $user_type =  UserType::where('status', 1)->where('id', '!=', 1)->get();
        $query = MasterMembership::where('master_memberships.vivah_mitra_id', $id)->select([
                'master_memberships.*',
                'users.first_name as addedByName',
                'members.name as memberName',
                'l.first_name as leaderName',
                'vm.first_name as vivahMitraName',
                'vm.employee_code as vivahMitraCode',
            ])->join('users', 'users.id', '=', 'master_memberships.created_by')
              ->leftJoin('members', 'members.id', '=', 'master_memberships.member_id')
              ->leftJoin('users as l', 'l.id', '=', 'master_memberships.leader_id')
              ->leftJoin('users as vm', 'vm.id', '=', 'master_memberships.vivah_mitra_id');

              if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_memberships.membership_number', 'like', "%$search%")
                    ->orWhere('members.memberName', 'like', "%$search%");
                });
            }

            $membership_list = $query->orderBy('master_memberships.id', 'DESC')->paginate(100);
            $vivahMitra = User::where('id', $id)->first();
        $datas = [
            'vivahMitra' => $vivahMitra,
            'vivah_mitra_id' => $id,
            'membership_list' => $membership_list,
            'page_title' => 'Showing Membership of <span style="color:green;font-size:17px;font-weight:bold;">'.$vivahMitra->first_name.' - '.$vivahMitra->employee_code.'</span>',
            'vivah_mitra_list' => User::where('user_type_id', 6)->get(),
        ];
        return view('admin.membership.individual_membersship_of_vivah_mitra_export_in_excel', $datas);
    }

    public function exportMemberships(Request $request){
        $user_type =  UserType::where('status', 1)->where('id', '!=', 1)->get();
       /* $query = MasterMembership::where('is_used', 0)->select([
                'master_memberships.*',
                'users.first_name as addedByName',
                'members.name as memberName',
                'l.first_name as leaderName',
                'vm.first_name as vivahMitraName',
                'vm.employee_code as vivahMitraCode',
            ])->join('users', 'users.id', '=', 'master_memberships.created_by')
              ->leftJoin('members', 'members.id', '=', 'master_memberships.member_id')
              ->leftJoin('users as l', 'l.id', '=', 'master_memberships.leader_id')
              ->leftJoin('users as vm', 'vm.id', '=', 'master_memberships.vivah_mitra_id');


            $membership_list = $query->orderBy('master_memberships.id', 'DESC')->get();
*/
            $membership_list = MasterMembership::where('is_used', 0)->get();
        $datas = [


            'membership_list' => $membership_list,
            'page_title' => 'Showing Membership of <span style="color:green;font-size:17px;font-weight:bold;"> </span>',
            'vivah_mitra_list' => User::where('user_type_id', 6)->get(),
        ];
        return view('admin.membership.membersship_export_in_excel', $datas);
    }

    public function viewMembershipNumberDateWise(Request $request, $date){
        $membership_numbers = MasterMembership::where('created_date', $date)->get();
        $datas = [
            'date' => $date,
            'membership_numbers' => $membership_numbers,
            'page_title' => 'Membership Numbers generated on <span style="color:green;font-size:17px;font-weight:bold;">'.date('d-M-Y', strtotime($date)).'</span>',
        ];
        return view('admin.membership.view_membership_number_date_wise', $datas);
    }

    public function exportMembershipDateWise(Request $request, $date){
        $membership_numbers = MasterMembership::where('created_date', $date)->get();
        $datas = [
            'date' => $date,
            'membership_numbers' => $membership_numbers,
        ];
        return view('admin.membership.export_membership_date_wise_in_excel', $datas);
    }

    public function addOldMemberships(Request $request){
        $datas = [
            'page_title' => 'Add Old Membership Numbers',
            'membership_list' => MasterMembership::where('is_old', 1)->paginate(100),
        ];
        return view('admin.membership.add_old_membership', $datas);
    }

    public function storeOldMembership(Request $request){
        $request->validate([
            'membership_number' => 'required|numeric|digits:12|unique:master_memberships,membership_number',
            'created_date' => 'required|date',
        ]);

        MasterMembership::create([
            'membership_number' => $request->membership_number,
            'created_date' => $request->created_date,
            // 'is_used' => 1, // Mark as used since it's an old membership
            'is_old' => 1, // Mark as old membership
            'created_by' => session('LoggedUser')->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Old Membership number added successfully!'
        ]);
    }


}
