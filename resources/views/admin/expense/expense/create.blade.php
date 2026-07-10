@extends('admin.include.master')
@section('title', 'Add Expense')

@section('content')

<!-- Page Header -->
<div style="background:linear-gradient(45deg, #f33057, rgb(56, 88, 249));"
     class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">

    <div>
        <h4 class="fw-medium mb-2">Add Expense</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Expense Management</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.expense.list') }}">Expense List</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Add Expense</li>
                </ol>
            </nav>
        </div>
    </div>

    <a href="{{ route('admin.expense.list') }}" class="btn btn-light btn-sm">
        Back
    </a>
</div>
<!-- Page Header Close -->

<div class="main-content app-content">
    <div class="container-fluid">

  @if(session('success'))
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: "{{ session('success') }}",
                                timer: 1500,
                                showConfirmButton: false
                            });
                        });
                    </script>
                @endif

                @if(session('error'))
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "{{ session('error') }}",
                                showConfirmButton: true
                            });
                        });
                    </script>
                @endif

                @if ($errors->any())
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            Swal.fire({
                                icon: "warning",
                                title: "Validation Error",
                                html: `{!! implode('<br>', $errors->all()) !!}`,
                                showConfirmButton: true
                            });
                        });
                    </script>
                @endif

        <div class="card custom-card mt-3">

            <div class="card-header">
                <h5 class="mb-0">Expense Details</h5>
            </div>

            <div class="card-body">

                <form action="{{ route('admin.expense.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Group <span class="text-danger">*</span></label>
                            <select name="group_id" id="group_id" class="form-control">
                                <option value="">Select Group</option>
                                @foreach($groups as $g)
                                    <option value="{{ $g->id }}"
                                        {{ old('group_id') == $g->id ? 'selected' : '' }}>
                                        {{ $g->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Sub Group</label>
                            <select name="sub_group_id" id="sub_group_id" class="form-control">
                                <option value="">Select Sub Group</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Expense Title <span class="text-danger">*</span></label>
                            <input type="text" name="title"
                                   value="{{ old('title') }}"
                                   class="form-control"
                                   placeholder="Expense title">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Amount <span class="text-danger">*</span></label>
                            <input type="number" name="amount"
                                   value="{{ old('amount') }}"
                                   class="form-control"
                                   placeholder="Enter amount">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Expense Date <span class="text-danger">*</span></label>
                            <input type="date" name="expense_date"
                                   value="{{ old('expense_date') }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Payment Mode</label>
                            <select name="payment_mode" class="form-control">
                                <option value="cash"  {{ old('payment_mode') == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="upi"   {{ old('payment_mode') == 'upi' ? 'selected' : '' }}>UPI</option>
                                <option value="bank"  {{ old('payment_mode') == 'bank' ? 'selected' : '' }}>Bank</option>
                                <option value="online"{{ old('payment_mode') == 'online' ? 'selected' : '' }}>Online</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="3"
                                      class="form-control"
                                      placeholder="Write description...">{{ old('description') }}</textarea>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Bill File</label>
                            <input type="file" name="bill_file" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status') == "1" ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == "0" ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-12 d-flex gap-2">
                            <button class="btn btn-danger">Save Expense</button>
                            <a href="{{ route('admin.expense.list') }}" class="btn btn-secondary">Cancel</a>
                        </div>

                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

<script>
$(document).ready(function () {

    function loadSubGroups(group_id, selected = null) {

        if(!group_id){
            $('#sub_group_id').html('<option value="">Select Sub Group</option>');
            return;
        }

        $('#sub_group_id').html('<option value="">Loading...</option>');

        $.ajax({
            url: "{{ url('admin/expense/get-subgroup') }}/" + group_id,
            type: "GET",
            dataType: "json",
            success: function (data) {
                $('#sub_group_id').empty();
                $('#sub_group_id').append('<option value="">Select Sub Group</option>');

                if(data.length > 0){
                    $.each(data, function (key, value) {
                        let sel = (selected == value.id) ? 'selected' : '';
                        $('#sub_group_id').append('<option '+sel+' value="'+value.id+'">'+value.name+'</option>');
                    });
                }else{
                    $('#sub_group_id').append('<option value="">No Sub Group Found</option>');
                }
            }
        });
    }

    $('#group_id').on('change', function () {
        loadSubGroups($(this).val());
    });

    let oldGroup = "{{ old('group_id') }}";
    let oldSub   = "{{ old('sub_group_id') }}";
    if(oldGroup){
        loadSubGroups(oldGroup, oldSub);
    }

});
</script>

@endsection
