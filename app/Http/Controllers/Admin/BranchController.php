<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Wallet;

class BranchController extends Controller
{
    public function index(Request $request){
        $branch_list =  Branch::latest()->get();
        $datas = [
            'branch_list' => $branch_list,
            'request' => $request,
            'page_title' => 'Branch List',
        ];
        return view('admin.master.branch.index', $datas);
    }

    /* Store Branch */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        // Step 1: First create branch to get the ID
        $branch = Branch::create([
            'name' => strtoupper($request->name),
            'status' => $request->status,
        ]);

        // Step 2: Generate Code
        // Static prefix
        $prefix = "V2F";

        // First 3 letters of name
        $short = strtoupper(substr($branch->name, 0, 3));

        // Last 2 digits of current year
        $year = date('y');

        // ID padded to 3 digits
        $idPadded = str_pad($branch->id, 3, '0', STR_PAD_LEFT);

        // Final Code
        $code = "{$prefix}-{$short}-{$year}{$idPadded}";

        // Step 3: Update branch with code
        $branch->update([
            'code' => $code
        ]);

        // Wallet::firstOrCreate(
        //     [
        //         'owner_type' => 'branch',
        //         'owner_id'   => $branch->id
        //     ],
        //     [
        //         'balance' => 0
        //     ]
        // );
// $wallet = Wallet::where('owner_type','branch')
//                 ->where('owner_id', $branch->id)
//                 ->first();
//         dd($wallet);

        return response()->json([
            'success' => true,
            'message' => 'Branch added successfully!',
            'code' => $code
        ]);
    }



    /* Edit Branch */
    public function edit($id)
    {
        return response()->json(Branch::find($id));
    }


    /* Update Branch */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'status' => 'required|in:0,1',
        ]);

        $branch = Branch::findOrFail($id);

        $branch->update([
            'name' => $request->name,
            'code' => $request->code,
            'status' => $request->status,
        ]);

        return response()->json(['success' => true, 'message' => 'Branch updated successfully!']);
    }
}
