@extends('admin.include.master')
@section('title', 'Expense List')

@section('content')

<div style="background:linear-gradient(45deg, #f33057, rgb(56, 88, 249));"
     class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">

    <div>
        <h4 class="fw-medium mb-2">Expense List</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Expense Management</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Expense</li>
                </ol>
            </nav>
        </div>
    </div>

    <a href="{{ route('admin.expense.create') }}" class="btn btn-light btn-sm">
        + Add Expense
    </a>
</div>

<div class="main-content app-content">
    <div class="container-fluid">

      

        <div class="card custom-card mt-3">

            <div class="card-header">
                <h5 class="mb-0">Expense List</h5>
            </div>

            <div class="card-body">

                <form method="GET" action="{{ route('admin.expense.list') }}">
                    <div class="row mb-3">

                        <div class="col-md-3">
                            <label class="form-label">Search</label>
                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   class="form-control"
                                   placeholder="Search title / amount / mode">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Group</label>
                            <select name="group_id" id="group_id" class="form-control">
                                <option value="">All Group</option>
                                @foreach($groups as $g)
                                    <option value="{{ $g->id }}"
                                        {{ request('group_id') == $g->id ? 'selected' : '' }}>
                                        {{ $g->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Sub Group</label>
                            <select name="sub_group_id" id="sub_group_id" class="form-control">
                                <option value="">All Sub Group</option>
                                @if(isset($subGroups))
                                    @foreach($subGroups as $sub)
                                        <option value="{{ $sub->id }}"
                                            {{ request('sub_group_id') == $sub->id ? 'selected' : '' }}>
                                            {{ $sub->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-3 d-flex align-items-end gap-2">
                            <button class="btn btn-danger">Search</button>
                            <a href="{{ route('admin.expense.list') }}" class="btn btn-secondary">Reset</a>
                        </div>

                    </div>
                </form>
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
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Group</th>
                            <th>Sub Group</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Mode</th>
                            <th>Bill</th>
                            {{-- <th class="text-end">Action</th> --}}
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($expenses as $key => $exp)
                            <tr>
                                <td>{{ method_exists($expenses, 'firstItem') ? $expenses->firstItem() + $key : $key+1 }}</td>
                                <td>{{ $exp->group->name ?? '-' }}</td>
                                <td>{{ $exp->subGroup->name ?? '-' }}</td>
                                <td>{{ $exp->title ?? '-' }}</td>
                                <td>₹ {{ $exp->amount }}</td>
                                <td>{{ $exp->expense_date }}</td>
                                <td>{{ ucfirst($exp->payment_mode) }}</td>

                                <td>
                                    @if($exp->bill_file)
                                        <a target="_blank" href="{{ asset('uploads/bills/'.$exp->bill_file) }}">View</a>
                                    @else
                                        -
                                    @endif
                                </td>

                                {{-- <td class="text-end">
                                    <a onclick="return confirm('Delete this expense?')"
                                       href="{{ route('admin.expense.delete',$exp->id) }}"
                                       class="btn btn-sm btn-danger">
                                        Delete
                                    </a>
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">No Expenses Found</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>

                @if(method_exists($expenses, 'links'))
                    <div class="mt-3">
                        {{ $expenses->appends(request()->query())->links() }}
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>

<script>
$(document).ready(function(){

    $('#group_id').on('change', function(){
        let group_id = $(this).val();
        $('#sub_group_id').html('<option value="">Loading...</option>');

        if(group_id){
            $.ajax({
                url: "{{ url('admin/expense/get-subgroup') }}/" + group_id,
                type: "GET",
                dataType: "json",
                success: function(data){
                    $('#sub_group_id').empty();
                    $('#sub_group_id').append('<option value="">All Sub Group</option>');

                    $.each(data, function(key, value){
                        $('#sub_group_id').append('<option value="'+value.id+'">'+value.name+'</option>');
                    });
                }
            });
        }else{
            $('#sub_group_id').html('<option value="">All Sub Group</option>');
        }
    });

});
</script>

@endsection
