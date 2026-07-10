@extends('admin.include.master')
@section('title', 'Expense Sub Group')

@section('content')

    <div style="background:linear-gradient(45deg, #f33057, rgb(56, 88, 249));"
        class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">

        <div>
            <h4 class="fw-medium mb-2">Expense Sub Group</h4>
            <div class="ms-sm-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Expense Management</a></li>
                        <li class="breadcrumb-item active fw-normal" aria-current="page">Sub Group</li>
                    </ol>
                </nav>
            </div>
        </div>

        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addSubGroupModal">
            + Add Sub Group
        </button>
    </div>

    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="card custom-card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Sub Group List</h5>
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
                                    <th>#</th>
                                    <th>Group Name</th>
                                    <th>Sub Group</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($subGroups as $key => $sub)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $sub->group->name ?? '-' }}</td>
                                        <td>{{ $sub->name }}</td>

                                        <td>
                                            @if($sub->status == 1)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>

                                        <td class="text-end">
                                            <button class="btn btn-sm btn-primary"
                                                onclick="openEditSubGroupModal({{ $sub->id }})">
                                                Edit
                                            </button>

                                            <a href="{{ url('admin/expense-subgroups/delete/' . $sub->id) }}"
                                                class="btn btn-sm btn-danger">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">
                                            No Sub Group Found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="addSubGroupModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <form action="{{ route('admin.expense.subgroups.store') }}" method="POST" class="modal-content">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Add Expense Sub Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Select Group <span class="text-danger">*</span></label>
                        <select name="group_id" class="form-control">
                            <option value="">Select Group</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>
                                    {{ $group->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sub Group Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                            placeholder="Enter sub group name">
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


    <div class="modal fade" id="editSubGroupModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <form id="editSubGroupForm" class="modal-content">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Edit Expense Sub Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div id="editSubGroupError" class="alert alert-danger d-none"></div>

                    <input type="hidden" id="edit_id">

                    <div class="mb-3">
                        <label class="form-label">Select Group <span class="text-danger">*</span></label>
                        <select id="edit_group_id" class="form-control">
                            <option value="">Select Group</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sub Group Name <span class="text-danger">*</span></label>
                        <input type="text" id="edit_name" class="form-control" placeholder="Enter sub group name">
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
                    <button type="button" class="btn btn-danger" id="updateBtn">Update</button>
                </div>
            </form>
        </div>
    </div>


    @if($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var myModal = new bootstrap.Modal(document.getElementById('addSubGroupModal'));
                myModal.show();
            });
        </script>
    @endif


    <script>
        function openEditSubGroupModal(id) {
            $('#editSubGroupError').addClass('d-none').html('');
            $('#edit_id').val(id);

            $.ajax({
                url: "{{ url('admin/expense-subgroups/edit') }}/" + id,
                type: "GET",
                success: function (res) {
                    $('#edit_group_id').val(res.group_id);
                    $('#edit_name').val(res.name);
                    $('#edit_status').val(res.status);

                    let modal = new bootstrap.Modal(document.getElementById('editSubGroupModal'));
                    modal.show();
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    alert("Edit load error!");
                }
            });
        }

        $(document).on('click', '#updateBtn', function (e) {
            e.preventDefault();

            let id = $('#edit_id').val();

            $('#updateBtn').prop('disabled', true).text('Updating...');
            $('#editSubGroupError').addClass('d-none').html('');

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            $.ajax({
                url: "{{ url('admin/expense-subgroups/update') }}/" + id,
                type: "POST",
                data: {
                    group_id: $('#edit_group_id').val(),
                    name: $('#edit_name').val(),
                    status: $('#edit_status').val(),
                },
                success: function (res) {
                    $('#updateBtn').prop('disabled', false).text('Update');

                    if (res.success) {
                        // alert(res.message); 
                        location.reload();
                    }
                },
                error: function (xhr) {
                    $('#updateBtn').prop('disabled', false).text('Update');

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let msg = "";

                        $.each(errors, function (key, value) {
                            msg += value[0] + "<br>";
                        });

                        $('#editSubGroupError').removeClass('d-none').html(msg);
                    } else {
                        alert("Update error! Check console");
                        console.log(xhr.responseText);
                    }
                }
            });
        });
    </script>


@endsection