<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\UserType;

class UserTypeController extends Controller
{
    public function index(Request $request){
        $user_type_list =  UserType::latest()->get();
        $datas = [
            'user_type_list' => $user_type_list,
            'request' => $request,
            'page_title' => 'User Type List',
        ];
        return view('admin.master.user_type.index', $datas);
    }

    /* Store New Session */
   public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        UserType::create([
            'name'       => $request->name,
            'status'     => $request->status,
        ]);

        return response()->json(['success' => true, 'message' => 'User Type added successfully!']);
    }


    public function edit($id)
    {
        return response()->json(UserType::find($id));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        $userType = UserType::findOrFail($id);

        $userType->update([
            'name'       => $request->name,
            'status'     => $request->status,
        ]);

        return response()->json(['success' => true, 'message' => 'User Type updated successfully!']);
    }
}
