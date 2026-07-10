<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseGroup;
use App\Models\ExpenseSubGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpenseManagementController extends Controller
{
    public function groupIndex()
    {
        $groups = ExpenseGroup::latest()->get();
        return view('admin.expense.group.index', compact('groups'));
    }
    public function groupStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:150',
            'status' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        ExpenseGroup::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Group added successfully!');
    }
    public function groupEdit($id)
    {
        $group = ExpenseGroup::findOrFail($id);
        return response()->json($group);
    }

    public function groupUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'   => 'required|max:150',
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        $group = ExpenseGroup::findOrFail($id);
        $group->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Group updated successfully!'
        ]);
    }
    public function groupDelete($id)
    {
        ExpenseGroup::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Group deleted successfully!');
    }



    public function subGroupIndex()
    {
        $groups = ExpenseGroup::where('status', 1)->get();
        $subGroups = ExpenseSubGroup::with('group')->latest()->get();

        return view('admin.expense.subgroup.index', compact('groups', 'subGroups'));
    }

    public function subGroupStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_id' => 'required|exists:expense_groups,id',
            'name' => 'required|max:150',
            'status' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        ExpenseSubGroup::create([
            'group_id' => $request->group_id,
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Sub Group added successfully!');
    }
    public function subGroupEdit($id)
    {
        $sub = ExpenseSubGroup::findOrFail($id);
        return response()->json($sub);
    }

    public function subGroupUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'group_id' => 'required|exists:expense_groups,id',
            'name'     => 'required|max:150',
            'status'   => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        $sub = ExpenseSubGroup::findOrFail($id);
        $sub->update([
            'group_id' => $request->group_id,
            'name'     => $request->name,
            'status'   => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Sub Group updated successfully!'
        ]);
    }


    public function subGroupDelete($id)
    {
        ExpenseSubGroup::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Sub Group deleted successfully!');
    }

    public function getSubGroupByGroup($group_id)
    {
        $data = ExpenseSubGroup::where('group_id', $group_id)
            ->where('status', 1)
            ->get(['id', 'name']);

        return response()->json($data);
    }


    public function expenseIndex(Request $request)
    {
        $groups = ExpenseGroup::where('status', 1)->get();

        $query = Expense::with(['group', 'subGroup']);

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('amount', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('payment_mode', 'LIKE', '%' . $request->search . '%');
            });
        }

        if ($request->group_id) {
            $query->where('group_id', $request->group_id);
            $subGroups = ExpenseSubGroup::where('group_id', $request->group_id)->get();
        } else {
            $subGroups = [];
        }

        if ($request->sub_group_id) {
            $query->where('sub_group_id', $request->sub_group_id);
        }

        $expenses = $query->latest()->paginate(10)->withQueryString();

        return view('admin.expense.expense.index', compact('expenses', 'groups', 'subGroups'));
    }


    public function expenseCreate()
    {
        $groups = ExpenseGroup::where('status', 1)->get();
        return view('admin.expense.expense.create', compact('groups'));
    }

    public function expenseStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_id' => 'required|exists:expense_groups,id',
            'sub_group_id' => 'nullable|exists:expense_sub_groups,id',
            'title' => 'required|max:200',
            'amount' => 'required|numeric',
            'expense_date' => 'required|date',
            'payment_mode' => 'required|in:cash,online,bank,upi',
            'bill_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'status' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fileName = null;

        if ($request->hasFile('bill_file')) {
            $fileName = time() . '.' . $request->bill_file->extension();
            $request->bill_file->move(public_path('uploads/bills'), $fileName);
        }

        Expense::create([
            'group_id' => $request->group_id,
            'sub_group_id' => $request->sub_group_id,
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
            'expense_date' => $request->expense_date,
            'payment_mode' => $request->payment_mode,
            'bill_file' => $fileName,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.expense.list')->with('success', 'Expense added successfully!');
    }
    public function expenseDelete($id)
    {
        Expense::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Expense deleted successfully!');
    }
}
