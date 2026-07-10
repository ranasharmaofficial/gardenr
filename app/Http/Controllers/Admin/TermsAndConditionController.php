<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;

class TermsAndConditionController extends Controller
{
   public function index(Request $request)
    {
        $query = TermsAndCondition::query();

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('type', 'like', '%' . $request->search . '%');
        }

        if ($request->status !== null && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $terms = $query->latest()->paginate(10);

        return view('admin.terms.index', compact('terms'));
    }

    public function create()
    {
        $type = [
            'Vivah Mitra',
            'Employee'
        ];
        return view('admin.terms.create', compact('type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'type'    => 'required',
            'content' => 'nullable|string',
            'status'  => 'required|in:0,1',
        ]);

        TermsAndCondition::create($request->only('title','type','content','status'));

        return redirect()->route('admin.terms.index')->with('success', 'Terms Added Successfully!');
    }

    public function edit($id)
    {
        $type = [
            'Vivah Mitra',
            'Employee'
        ];
        $term = TermsAndCondition::findOrFail($id);
        return view('admin.terms.edit', compact('term','type'));
    }

    public function update(Request $request, $id)
    {
        $term = TermsAndCondition::findOrFail($id);

        $request->validate([
            'title'   => 'required|string|max:255',
            'type'    => 'required',
            'content' => 'nullable|string',
            'status'  => 'required|in:0,1',
        ]);

        $term->update($request->only('title','type','content','status'));

        return redirect()->route('admin.terms.index')->with('success', 'Terms Updated Successfully!');
    }

    public function destroy($id)
    {
        $term = TermsAndCondition::findOrFail($id);
        $term->delete();

        return redirect()->route('admin.terms.index')->with('success', 'Terms Deleted Successfully!');
    }

}
