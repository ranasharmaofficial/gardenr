@extends('admin.include.master')
@section('title', 'Member List')
@section('content')

    <style>
        table.table-bordered td,
        table.table-bordered th {
            border: 1px solid #dee2e6 !important;
        }
    </style>

    <div style="background:linear-gradient(45deg,#f33057,rgb(56,88,249));"
        class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h4 class="fw-medium mb-2">{{ $page_title }}</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">{{ $page_title }}</li>
                <li class="breadcrumb-item active">Members</li>
            </ol>
        </div>
    </div>

    <div class="main-content app-content">
        <div class="container-fluid">
            <div class="card card-table">

                <div class="card-header">
                    <h5 class="card-title">Member List</h5>
                </div>

                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <input type="text" id="membership_number" class="form-control" placeholder="Membership No">
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="name" class="form-control" placeholder="Name">
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="mobile" class="form-control" placeholder="Mobile">
                        </div>
                        <div class="col-md-2">
                            <select id="status" class="form-control">
                                <option value="">All Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-danger w-100" id="resetFilter">Reset</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <div id="member-table">
                            @include('admin.membership.member.partials.member_table', ['members' => $members])
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function fetchMembers(page = 1) {
            $.ajax({
                url: "{{ route('admin.member.list') }}",
                type: "GET",
                data: {
                    page: page,
                    membership_number: $('#membership_number').val(),
                    name: $('#name').val(),
                    mobile: $('#mobile').val(),
                    status: $('#status').val()
                },
                success: function (data) {
                    $('#member-table').html(data);
                }
            });
        }

        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetchMembers(page);
        });

        $('#membership_number, #name, #mobile').on('keyup', function () {
            fetchMembers();
        });
        $('#status').on('change', function () {
            fetchMembers();
        });

        $('#resetFilter').on('click', function () {
            $('#membership_number,#name,#mobile').val('');
            $('#status').val('');
            fetchMembers();
        });
    </script>

@endsection