@extends('admin.include.master')
@section('title')
	{{ $page_title }}
@endsection
@section('content')

<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">{{ $page_title }}</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a class="" href="javascript:void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item  active fw-normal" aria-current="page">{{ $page_title }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->



            <!--APP-CONTENT START-->
            <div class="main-content app-content">
                <div class="container-fluid">
				<!-- Start:: row-2 -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-header d-flex justify-content-between align-items-center">

								<h5 class="mb-0">{{ $page_title }}</h5>

								<a href="javascript:void(0)"
								   class="btn btn-danger btn-sm float-end"
								   data-bs-toggle="modal"
								   data-bs-target="#noticeModal"
								   onclick="openAddNoticeModal()">
								   Add Notice
								</a>


							</div>


                            <div class="card-body">

							<div class="container">
								<form id="filterForm">
									<div class="row">
										<div class="col-md-3 mb-3">
											<div class="form-group">
												<label>Type <span class="text-danger">*</span></label>
												<select class="form-control" name="type" id="type">
													<option value="">Select User Type</option>
													@foreach($type as $val)
														<option value="{{ $val }}">{{ $val }}</option>
													@endforeach
												</select>
											</div>
										</div>

										<div class="col-md-3 mb-3">
											<div class="form-group">
												<label>Search <span class="text-danger">*</span></label>
												<div class="input-group">
													<input type="text" class="form-control" name="search" id="search" placeholder="Search by Name, Mobile, Email">
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group mt-4">
												<button class="btn btn-danger" id="resetSearchBtn" title="Reset Search">
													Reset
												</button>

											</div>
										</div>
									</div>
								</form>
							</div>
							<div class="table-responsive">
								<div id="user-table">
									@include('admin.master.notice.notice_table_ajax', ['notice_list' => $notice_list])
								</div>

							</div>



                            </div>
                        </div>
                    </div>
                </div>



                </div>
            </div>

		<!-- Notice Modal -->
        <div class="modal fade" id="noticeModal" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" id="noticeForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="noticeModalTitle">Add Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div style="display:none;" id="show-form-error" class="alert alert-danger col-md-12">
                <div class="errorMsgntainer"></div>
                </div>

                <input type="hidden" name="notice_id" id="notice_id">

                <div class="mb-3">
                <label class="form-label">Select Type</label>
                <select id="notice_type" name="type" required class="form-control">
                    <option value="">---Select Type---</option>
                    <option value="Employee">Employee</option>
                    <option value="Vivah Mitra">Vivah Mitra</option>
                </select>
                </div>

                <div class="mb-3">
                <label class="form-label">Notice Title</label>
                <input type="text" name="title" id="notice_title" class="form-control" placeholder="Notice Title">
                </div>

                <div class="mb-3">
                <label class="form-label">Notice File</label>
                <input type="file" name="file" id="notice_file" class="form-control">
                </div>

                <div class="mb-3">
                <label class="form-label">Status</label>
                <select id="notice_status" name="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>

                <button type="button" class="btn btn-primary" id="saveNoticeBtn">
                Save
                </button>

                <button type="button" class="btn btn-primary" id="updateNoticeBtn" style="display:none;">
                Update
                </button>

            </div>
            </form>
        </div>
        </div>
        <script>
            function openAddNoticeModal() {
            $('#notice_id').val('');
            $('#notice_title').val('');
            $('#notice_type').val('');
            $('#notice_file').val('');
            $('#notice_status').val('1');

            $("#noticeModalTitle").text("Add Notice");
            $('#saveNoticeBtn').show();
            $('#updateNoticeBtn').hide();

            $('.errorMsgntainer').html('');
            $('#show-form-error').hide();

            $('#noticeModal').modal('show');
        }

        $(document).on('click', '#saveNoticeBtn', function(e) {
            e.preventDefault();

            let btn = $(this);
            btn.prop('disabled', true);

            $('.errorMsgntainer').html('');
            $('#show-form-error').hide();

            let formData = new FormData(document.getElementById("noticeForm"));

            $.ajax({
                type: "POST",
                url: "{{ route('admin.notice.store') }}",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",

                success: function(res) {
                    btn.prop('disabled', false);

                    if (res.status == true) {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        $('#noticeModal').modal('hide');
                        fetchUsers(); // refresh table
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oh No!",
                            text: "Something went wrong!",
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                },

                error: function(err) {
                    btn.prop('disabled', false);

                    let errors = err.responseJSON?.errors;
                    if (errors) {
                        $('#show-form-error').show();
                        $.each(errors, function(index, value) {
                            $('.errorMsgntainer').append('<div class="text-danger">' + value + '</div>');
                        });
                    }
                }
            });
        });



        function editNotice(id) {
            $('.errorMsgntainer').html('');
            $('#show-form-error').hide();

            $.ajax({
                url: "{{ url('admin/noticeList/edit') }}/" + id,
                type: "GET",
                success: function(res) {

                    $('#notice_id').val(res.id);
                    $('#notice_title').val(res.title);
                    $('#notice_type').val(res.type);
                    $('#notice_status').val(res.status);

                    $("#noticeModalTitle").text("Edit Notice");

                    $('#saveNoticeBtn').hide();
                    $('#updateNoticeBtn').show();

                    $('#noticeModal').modal('show');
                }
            });
        }


        $(document).on('click', '#updateNoticeBtn', function(e) {
            e.preventDefault();

            let id = $('#notice_id').val();
            let btn = $(this);
            btn.prop('disabled', true);

            $('.errorMsgntainer').html('');
            $('#show-form-error').hide();

            let formData = new FormData(document.getElementById("noticeForm"));

            $.ajax({
                url: "{{ url('admin/notice/update') }}/" + id,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                success: function(res) {
                    btn.prop('disabled', false);

                    if (res.status == true) {
                        Swal.fire({
                            icon: "success",
                            title: "Updated!",
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        $('#noticeModal').modal('hide');
                        fetchUsers();
                    }
                },

                error: function(err) {
                    btn.prop('disabled', false);

                    let errors = err.responseJSON?.errors;
                    if (errors) {
                        $('#show-form-error').show();
                        $.each(errors, function(index, value) {
                            $('.errorMsgntainer').append('<div class="text-danger">' + value + '</div>');
                        });
                    }
                }
            });
        });


      
        function fetchUsers(page = 1) {
            let type = $('#type').val();
            let search = $('#search').val();

            $.ajax({
                url: "{{ route('admin.notice.fetch') }}?page=" + page,
                method: "GET",
                data: { type, search },
                success: function(data) {
                    $('#user-table').html(data);
                }
            });
        }

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetchUsers(page);
        });

        $('#type').change(function() {
            fetchUsers();
        });

        $('#search').on('keyup', function() {
            fetchUsers();
        });

        $('#resetSearchBtn').on('click', function(e) {
            e.preventDefault();
            $('#type').val('');
            $('#search').val('');
            fetchUsers();
        });

        </script>


@endsection