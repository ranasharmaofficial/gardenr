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


                            <h4>Upcoming Marriage - {{ $monthName }}</h4>

                            <div class="card  p-3 mb-3">
                                <strong>Total Count: {{ $count }}</strong>
                            </div>

                            <table class="table table-bordered table-hover table-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Membership No</th>
                                        <th>Name</th>
                                        <th>Father/Husband</th>
                                        <th>Address</th>
                                        <th>Post</th>
                                        <th>State</th>
                                        <th>District</th>
                                        <th>Pincode</th>
                                        <th>Mobile</th>
                                        <th>WhatsApp</th>

                                        <th>Father Occupation</th>
                                        <th>Father / Husband Name</th>

                                        <th>Ayushmati Name</th>
                                        <th>Ayushmati Age</th>
                                        <th>Ayushmati Qualification</th>

                                        <th>Sister 1 Name</th>
                                        <th>Sister 1 Qualification</th>
                                        <th>Sister 1 Age</th>

                                        <th>Sister 2 Name</th>
                                        <th>Sister 2 Qualification</th>
                                        <th>Sister 2 Age</th>

                                        <th>Sister 3 Name</th>
                                        <th>Sister 3 Qualification</th>
                                        <th>Sister 3 Age</th>

                                        <th>Expected Package</th>
                                        <th>Card Type</th>
                                        <th>Card Price</th>
                                        <th>Status</th>
                                        <th>Added Date</th>
                                        <th>Marriage Month</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($members as $key => $member)

                                        @php
                                            $marriageDate = \Carbon\Carbon::createFromFormat(
                                                'Y-m',
                                                $member->ayushmati_expected_marriage_month
                                            )->startOfMonth();

                                            $today = \Carbon\Carbon::today();
                                            $daysRemaining = $today->diffInDays($marriageDate, false);
                                        @endphp

                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $member->membership_number }}</td>
                                            <td>{{ $member->name }}</td>
                                            <td>{{ $member->father_husband }}</td>
                                            <td>{{ $member->address }}</td>
                                            <td>{{ $member->post }}</td>
                                            <td>{{ $member->state }}</td>
                                            <td>{{ $member->district }}</td>
                                            <td>{{ $member->pincode }}</td>
                                            <td>{{ $member->mobile }}</td>
                                            <td>{{ $member->whatsapp }}</td>

                                            <td>{{ $member->ayushmati_father_occupation }}</td>
                                            <td>{{ $member->father_husband }}</td>

                                            <td>{{ $member->ayushmati_girl_name }}</td>
                                            <td>{{ $member->ayushmati_age }}</td>
                                            <td>{{ $member->ayushmati_qualification }}</td>

                                            <td>{{ $member->sister_name_1 }}</td>
                                            <td>{{ $member->sister_qualification_1 }}</td>
                                            <td>{{ $member->sister_age_1 }}</td>

                                            <td>{{ $member->sister_name_2 }}</td>
                                            <td>{{ $member->sister_qualification_2 }}</td>
                                            <td>{{ $member->sister_age_2 }}</td>

                                            <td>{{ $member->sister_name_3 }}</td>
                                            <td>{{ $member->sister_qualification_3 }}</td>
                                            <td>{{ $member->sister_age_3 }}</td>

                                            <td>{{ $member->expected_marriage_package }}</td>

                                            <td>{{ $member->card_type }}</td>
                                            <td>{{ $member->card_price }}</td>

                                            <td>
                                                <span class="badge {{ $member->status ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $member->status ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>

                                            <td>{{ $member->created_at->format('d-m-Y') }}</td>

                                            <td>
                                                {{ $marriageDate->format('F Y') }}
                                                <br>
                                                <small class="text-danger">
                                                    ({{ $daysRemaining }} days remaining)
                                                </small>
                                            </td>
                                            <td>
                    <button class="btn btn-sm btn-primary openCallModal" data-id="{{ $member->id }}"
                        data-name="{{ $member->name }}" data-bs-toggle="modal" data-bs-target="#callRemarkModal">
                        Add Call Remark
                    </button>


                    <a href="{{ route('admin.call.details', $member->id) }}" class="btn btn-sm btn-info">
                        Call Details
                    </a>
                </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="27" class="text-center text-danger">
                                                No Data Found
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
    </div>
    <!-- Call Remark Modal -->
    <div class="modal fade" id="callRemarkModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" action="{{ route('admin.call.remark.store') }}">
                    @csrf

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Add Call Remark</h5>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">

                        <input type="hidden" name="member_id" id="member_id">

                        <div class="form-group mb-2">
                            <label><strong>Member Name :</strong>
                                <span class="text-success" id="member_name"></span>
                            </label>
                        </div>

                        <div class="form-group mb-2">
                            <label>Call Start Time</label>
                            <input type="datetime-local" name="call_start_time" class="form-control" required>
                        </div>

                        <div class="form-group mb-2">
                            <label>Call End Time</label>
                            <input type="datetime-local" name="call_end_time" class="form-control" required>
                        </div>

                        <div class="form-group mb-2">
                            <label>Remarks</label>
                            <textarea name="remarks" class="form-control" rows="3" placeholder="Enter call remarks..."
                                required></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success">Save Remark</button>
                    </div>

                </form>

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
        $(document).on('click', '.openCallModal', function () {

            let memberId = $(this).data('id');
            let memberName = $(this).data('name');

            $('#member_id').val(memberId);
            $('#member_name').text(memberName);

        });
    </script>

@endsection