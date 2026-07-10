<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\District;
use App\Models\MasterVendor;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MasterVendorController extends Controller
{
    public function index(Request $request)
    {
        $query = MasterVendor::with(['state', 'district','branch']);
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('owner_name', 'LIKE', "%$search%")
                    ->orWhere('owner_email', 'LIKE', "%$search%")
                    ->orWhere('shop_name', 'LIKE', "%$search%")
                    ->orWhere('gst', 'LIKE', "%$search%");
            });
        }
        // if ($request->filled('state_id')) {
        //     $query->where('state_id', $request->state_id);
        // }

        $vendors = $query->latest()->paginate(10);


        return view('admin.master.vendor.index', compact('vendors'));
    }

    public function create()
    {
        $states = State::all();
        $districts = District::all();
        $branch=Branch::all();
        return view('admin.master.vendor.create', compact('states', 'districts', 'branch'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'owner_name'   => 'required|string|max:150',
            'owner_email'  => 'required|email|max:150|unique:master_vendors,owner_email',
            'shop_name'    => 'required|string|max:200',
            'gst'          => 'nullable|string|max:20',
            'state_id'     => 'required|exists:states,id',
            'district_id'  => 'required|exists:districts,id',
            'branch_id'    => 'required|exists:branches,id',
            'address'      => 'required|string',
            'status'       => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed!');
        }

        try {
            MasterVendor::create([
                'owner_name'   => $request->owner_name,
                'owner_email'  => $request->owner_email,
                'shop_name'    => $request->shop_name,
                'gst'          => $request->gst,
                'state_id'     => $request->state_id,
                'district_id'  => $request->district_id,
                'branch_id'    => $request->branch_id,
                'address'      => $request->address,
                'status'       => $request->status,
            ]);

            return redirect()->route('admin.vendors.index')
                ->with('success', 'Vendor created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $vendor = MasterVendor::findOrFail($id);

        $states = State::all();
        $districts = District::where('state_id', $vendor->state_id)->get();
        $branch = Branch::all();

        return view('admin.master.vendor.edit', compact('vendor', 'states', 'districts', 'branch'));
    }

    public function update(Request $request, $id)
    {
        $vendor = MasterVendor::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'owner_name'   => 'required|string|max:150',
            'owner_email'  => 'required|email|max:150|unique:master_vendors,owner_email,' . $vendor->id,
            'shop_name'    => 'required|string|max:200',
            'gst'          => 'nullable|string|max:20',
            'state_id'     => 'required|exists:states,id',
            'district_id'  => 'required|exists:districts,id',
            'branch_id'    => 'required|exists:branches,id',
            'address'      => 'required|string',
            'status'       => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validation failed!');
        }

        try {
            $vendor->update([
                'owner_name'   => $request->owner_name,
                'owner_email'  => $request->owner_email,
                'shop_name'    => $request->shop_name,
                'gst'          => $request->gst,
                'state_id'     => $request->state_id,
                'district_id'  => $request->district_id,
                'branch_id'    => $request->branch_id,
                'address'      => $request->address,
                'status'       => $request->status,
            ]);

            return redirect()->route('admin.vendors.index')
                ->with('success', 'Vendor updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $vendor = MasterVendor::find($id);

            if (!$vendor) {
                return redirect()->back()->with('error', 'Vendor not found!');
            }

            $vendor->delete();

            return redirect()->route('admin.vendors.index')
                ->with('success', 'Vendor deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }
    public function getDistrictByState($state_id)
    {
        $districts = District::where('state_id', $state_id)
            ->get(['id', 'name']);
        return response()->json($districts);
    }
}
