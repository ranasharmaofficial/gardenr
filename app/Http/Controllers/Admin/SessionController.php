<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Session;

class SessionController extends Controller
{
    public function index(Request $request){
        $session_list =  Session::latest()->get();
        return view('admin.master.session.index', compact('session_list', 'request'));
    }

    /* Store New Session */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
        ]);

        Session::create([
            'title' => $request->title,
        ]);

        return response()->json(['success' => true, 'message' => 'Session added successfully!']);
    }

    /* Get One Session for Editing */
    public function edit($id)
    {
        return response()->json(Session::find($id));
    }

    /* Update Session */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:50',
        ]);
        $session = Session::findOrFail($id);
        $session->update([
            'title' => $request->title,
        ]);

        return response()->json(['success' => true, 'message' => 'Session updated successfully!']);
    }
}
