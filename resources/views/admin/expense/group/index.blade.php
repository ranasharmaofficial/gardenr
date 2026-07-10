@extends('admin.include.master')
@section('title', 'Expense Group List')

@section('content')

<!-- Page Header -->
<div style="background:linear-gradient(45deg, #f33057, rgb(56, 88, 249));"
     class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">

    <div>
        <h4 class="fw-medium mb-2">Expense Group List</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Expense Management</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Group List</li>
                </ol>
            </nav>
        </div>
    </div>

    <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addGroupModal">
        + Add Group
    </button>
</div>
<!-- Page Header Close -->

<div class="main-content app-content">
    <div class="container-fluid">

        <div class="card custom-card mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Group List</h5>
            </div>

            <div class="card-body">

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
                            <th>ID</th>
                            <th>Group Name</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th class="text-end">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($groups as $key => $group)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $group->name }}</td>

                                <td>
                                    @if(($group->status ?? 1) == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>

                                <td>{{ $group->created_at ? $group->created_at->format('d M Y') : '-' }}</td>

                                <td class="text-end">
                                    <button class="btn btn-sm btn-primary"
                                            onclick="openEditGroupModal({{ $group->id }})">
                                        Edit
                                    </button>

                                    <a href="{{ url('admin/expense-groups/delete/'.$group->id) }}"
                                       class="btn btn-sm btn-danger">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No Group Found</td>
                            </tr>
                        @endforelse
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="addGroupModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form action="{{ route('admin.expense.groups.store') }}" method="POST" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Add Expense Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Group Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="form-control" placeholder="Enter group name">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-danger" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="editGroupModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form id="editGroupForm" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Edit Expense Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div id="editGroupError" class="alert alert-danger d-none"></div>

                <input type="hidden" id="edit_group_id">

                <div class="mb-3">
                    <label class="form-label">Group Name <span class="text-danger">*</span></label>
                    <input type="text" id="edit_name" class="form-control" placeholder="Enter group name">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select id="edit_status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="updateGroupBtn">Update</button>
            </div>
        </form>
    </div>
</div>


@if($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var myModal = new bootstrap.Modal(document.getElementById('addGroupModal'));
        myModal.show();
    });
</script>
@endif


<script>
function openEditGroupModal(id)
{
    $('#editGroupError').addClass('d-none').html('');
    $('#edit_group_id').val(id);

    $.ajax({
        url: "{{ url('admin/expense-groups/edit') }}/" + id,
        type: "GET",
        success: function(res){
            $('#edit_name').val(res.name);
            $('#edit_status').val(res.status ?? 1);

            let modal = new bootstrap.Modal(document.getElementById('editGroupModal'));
            modal.show();
        },
        error: function(){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Unable to load group data."
            });
        }
    });
}

$(document).on('click', '#updateGroupBtn', function(e){
    e.preventDefault();

    let id = $('#edit_group_id').val();
    let btn = $('#updateGroupBtn');

    btn.prop('disabled', true).text('Updating...');
    $('#editGroupError').addClass('d-none').html('');

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $.ajax({
        url: "{{ url('admin/expense-groups/update') }}/" + id,
        type: "POST",
        data: {
            name: $('#edit_name').val(),
            status: $('#edit_status').val(),
        },

        success: function(res){
            btn.prop('disabled', false).text('Update');

            if(res.success){
                $('#editGroupModal').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "Updated!",
                    text: res.message,
                    timer: 1500,
                    showConfirmButton: false
                });

                setTimeout(() => location.reload(), 1500);

            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: res.message ?? "Something went wrong!"
                });
            }
        },

        error: function(xhr){
            btn.prop('disabled', false).text('Update');

            if(xhr.status === 422){
                let errors = xhr.responseJSON.errors;
                let msg = "";

                $.each(errors, function(key, value){
                    msg += value[0] + "<br>";
                });

                $('#editGroupError').removeClass('d-none').html(msg);

                Swal.fire({
                    icon: "warning",
                    title: "Validation Error",
                    text: "Please fill required fields."
                });

            } else {
                Swal.fire({
                    icon: "error",
                    title: "Server Error",
                    text: "Something went wrong. Please try again."
                });
            }
        }
    });
});
</script>

@endsection
