@extends('admin.include.master')
@section('title', 'Vivah Mitra List')
@section('content')

<style>
    table.table-bordered td,
    table.table-bordered th {
        border: 1px solid #dee2e6 !important;
    }
</style>

<!-- Page Header -->
<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h4 class="fw-medium mb-2">{{ $page_title }}</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">{{ $page_title }}</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Vivah Mitra</li>
                </ol>
            </nav>
        </div>
    </div>

</div>
<!-- Page Header Close -->


<div class="main-content app-content">
		 
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-12">
								<div class="card card-table">
									<div class="card-header d-flex align-items-center justify-content-between">
										<h5 class="card-title">Vivah Mitra Team List</h5>
										<a href="{{ route('admin.emp.addVivahMitraTeam') }}" class="btn btn-primary ms-auto">
											Add Vivah Mitra Team for App
										</a>
									</div>
									<div class="card-body booking_card">
										<div class="container">
										
										<div class="row">
									<div class="col-md-3 mb-4">
										<div class="card shadow text-center p-4 border-0 rounded-4 text-white"
											 style="background: linear-gradient(45deg, #4e73df, #224abe);">

											<h6 class="mb-2">Total Vivah Mitra </h6>

											<h2 class="fw-bold">{{ $vivah_mitra }}</h2>

											<a href="" 
											   class="btn btn-light btn-sm mt-3 px-4 rounded-pill">
											   View
											</a>

										</div>
									</div>
									
									<div class="col-md-3 mb-4">
										<div class="card shadow text-center p-4 border-0 rounded-4 text-white"
											 style="background: linear-gradient(45deg, #f6c23e, #dda20a);">

											<h6 class="mb-2">Total Panchayat Mitra</h6>

											<h2 class="fw-bold">{{ $panchayat_mitra }}</h2>

											<a href="" 
											   class="btn btn-light btn-sm mt-3 px-4 rounded-pill">
											   View
											</a>

										</div>
									</div>
									
									<div class="col-md-3 mb-4">
										<div class="card shadow text-center p-4 border-0 rounded-4 text-white"
											 style="background: linear-gradient(45deg, #e74a3b, #be2617);">

											<h6 class="mb-2">Total Prakhand Mitra</h6>

											<h2 class="fw-bold">{{ $prakhand_mitra }}</h2>

											<a href="" 
											   class="btn btn-light btn-sm mt-3 px-4 rounded-pill">
											   View
											</a>

										</div>
									</div>
									
									<div class="col-md-3 mb-4">
										<div class="card shadow text-center p-4 border-0 rounded-4 text-white"
											 style="background: linear-gradient(45deg, #1cc88a, #13855c);">

											<h6 class="mb-2">Total Jila Mitra</h6>

											<h2 class="fw-bold">{{ $jila_mitra }}</h2>

											<a href="" 
											   class="btn btn-light btn-sm mt-3 px-4 rounded-pill">
											   View
											</a>

										</div>
									</div>
									
									
									
								</div>
								
										<form id="filterForm">
											<div class="row">
												<div class="col-md-3 mb-3">
													<div class="form-group">
														<label>User Type <span class="text-danger">*</span></label>
														<select class="form-control" name="user_type_id" id="user_type_id">
															<option value="">Select User Type</option>
															@foreach($user_type_list as $val)
																<option value="{{ $val->id }}">{{ $val->name }}</option>
															@endforeach
														</select>
													</div>
												</div>
												
												<div class="col-md-3">
													<div class="form-group">
														<label>User Designation <span class="text-danger">*</span></label>
														<select class="form-control" id="user_designation_id" name="user_designation_id">
															<option value="">Select Designation</option>
														</select>
													</div>
												</div>

												<div class="col-md-4 mb-3">
													<div class="form-group">
														<label>Search <span class="text-danger">*</span></label>
														<div class="input-group">
															<input type="text" class="form-control" name="search" id="search" placeholder="Search by Name, Mobile, Email">
														</div>
													</div>
												</div>
												<div class="col-md-2">
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
												@include('admin.staffs.vivah_mitra.vivahmitraapp.user_table', ['users' => $users])
											</div>
											 
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

<div id="updateStaffPhotoModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<!-- Modal content-->
    <div class="modal-content">
		  <div class="modal-header bg-danger text-white">
			<h4 class="modal-title">Update Staff Photo</h4>&nbsp;&nbsp;
			<button type="button" style="color:#fff;" class="close btn-primary" data-bs-dismiss="modal">X</button>
		  </div>
        <form method="post" enctype="multipart/form-data" id="photo-form" action="">
			@csrf
			<div class="modal-body">
				<div class="row">
					<div style="display:none;" id="show-photo-form-error" class="alert alert-danger col-md-12">
						<ul>
							<div class="errorMsgntainer"></div>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h4>Name: <span class="text-success" id="staff_name"></span></h4>
						<h4>Employee Code: <span class="text-success" id="employee_code"></span></h4>
					</div>
					<div class="col-md-12">
					    <div class="form-group" id="">
						 <label class="font-weight-bold" for="">Select Photo <span class="text-danger">*</span></label>
						 <input type="file" onchange="loadFile(event)" name="image_file" class="form-control" required>
						 <input type="hidden" id="staff_id" name="staff_id" class="form-control" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<img style="width:auto;height:100px;padding-top:5px;padding-bottom:2px;" class="img-fluid" id="picone" />
							<script>
							
							  var loadFile = function(event) {
								var input = document.getElementById('picone');
								picone.src = URL.createObjectURL(event.target.files[0]);
							  };
							  
							</script>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" name="update_photo" value="update_photo" class="btn btn-info update_photo" id="">Save Photo</button>
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
			</div>
        </form>
    </div>

  </div>
</div>

<div id="blockUnblockModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<!-- Modal content-->
    <div class="modal-content">
		  <div class="modal-header bg-danger text-white">
			<h4 class="modal-title">Block / Un Block</h4>&nbsp;&nbsp;
			<button type="button" style="color:#fff;" class="close btn-primary" data-bs-dismiss="modal">X</button>
		  </div>
        <form method="post" enctype="multipart/form-data" id="block-form" action="">
			@csrf
			<div class="modal-body">
				<div class="row">
					<div style="display:none;" id="show-block-form-error" class="alert alert-danger col-md-12">
						<ul>
							<div class="errorMsgntainer"></div>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h4>Name: <span class="text-success" id="staff_name1"></span></h4>
						<h4>Employee Code: <span class="text-success" id="employee_code1"></span></h4>
					</div>
					<div class="col-md-12">
					    <div class="form-group" id="">
						 <label class="font-weight-bold" for="">Select Status <span class="text-danger">*</span></label>
						 <select name="status" id="status" class="form-control" required>
							<option value="0">Block</option>
							<option value="1">Un Block</option>
						 </select>
						 <input type="hidden" id="staff_id1" name="staff_id" class="form-control" required>
						</div>
					</div>
					 
					
					<!-- Block Section -->
					<div id="block_section">
						<div class="form-group">
							<label>Reason for Block</label>
							<select name="block_reason" id="block_reason" class="form-control">
								<option>Select Reason</option>
								<option>काम नहीं कर रहे है/कर रही है।</option>
								<option>मीटिंग/ट्रेनिंग में नहीं आ रहे है।</option>
								<option>रिपोर्ट नहीं कर रहे है।</option>
								<option>झूठ बोल कर ग्रुप बना रहे है।</option>
								<option>मार्केट से पेमेट ले कर रख रहे है।</option>
								<option>पेमेंट खर्च कर दिए है।</option>
								<option>अग्रीमेंट के रूल ओर रैलीग्रेशन को समझ नहीं पाए है।</option>
								<option>30 दिन से जायदा हो गया है पर 10 अप्लाई नहीं करवाए है।</option>
								<option>ग्रुप/होम मीटिंग नहीं लगा रहे है।</option>
								<option>अन्य कारण के कारण ब्लॉक किया जाता है।</option>
							</select>
						</div>

						<div class="form-group">
							<label>Blocked Date</label>
							<input name="block_date" id="block_date" type="date" class="form-control">
						</div>
					</div>

					<!-- Unblock Section -->
					<div id="unblock_section">
						<div class="form-group">
							<label>Reason for Un Block</label>
							<select name="unblock_reason" id="unblock_reason" class="form-control">
								<option>Select Reason</option>
								<option>काम स्टार्ट कर रहे है/कर रही है।</option>
								<option>मीटिंग/ट्रेनिंग में आयेगे।</option>
								<option>रिपोर्ट अब करेगे ।</option>
								<option>झूठ बोल कर ग्रुप बना रहे है। बात हो गया है,अब ये गलती नहीं करेंगे।</option>
								<option>मार्केट से पेमेट ले कर रख रहे है।बात हो गया है,अब ये गलती नहीं करेंगे।</option>
								<option>पेमेंट खर्च कर दिए है,बात हो गया है,अब ये गलती नहीं करेंगे।</option>
								<option>अग्रीमेंट के रूल ओर रैलीग्रेशन को समझ नहीं पाए है। पुनः समझा दिया गया है।</option>
								<option>30 दिन से जायदा हो गया है पर 10 अप्लाई नहीं करवाए है।एक मौका दिया जाए कर लेंगे। बात हो गई है।</option>
								<option>ग्रुप/होम मीटिंग नहीं लगा रहे है।बात हो गया है,अब ये गलती नहीं करेंगे।</option>
								<option>अन्य कारण के कारण अनब्लॉक्ड  किया जाता है।</option>
							</select>
						</div>

						<div class="form-group">
							<label>Un Block Date</label>
							<input name="unblock_date" id="unblock_date" type="date" class="form-control">
						</div>
					</div>
					
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-info update_block_stats" id="">UPDATE</button>
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
			</div>
        </form>
    </div>

  </div>
</div>

<div id="givePhysicalCardModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<!-- Modal content-->
    <div class="modal-content">
		  <div class="modal-header bg-danger text-white">
			<h4 class="modal-title">Issue Physical Card</h4>&nbsp;&nbsp;
			<button type="button" style="color:#fff;" class="close btn-primary" data-bs-dismiss="modal">X</button>
		  </div>
        <form method="post" enctype="multipart/form-data" id="card-given-form" action="">
			@csrf
			<div class="modal-body">
				<div class="row">
					<div style="display:none;" id="show-card-form-error" class="alert alert-danger col-md-12">
						<ul>
							<div class="errorMsgntainer"></div>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h4>Name: <span class="text-success" id="staff_name2"></span></h4>
						<h4>Employee Code: <span class="text-success" id="employee_code2"></span></h4>
					</div>
					
					 
					 
					<input type="hidden" id="staff_id2" name="user_id" class="form-control" required>
					 
					<div class="form-group">
						<label>Enter No. of Cards Given</label>
						<input name="quantity" id="card_given" type="number" class="form-control">
					</div>
					
					<div class="form-group">
						<label>Enter Date</label>
						<input name="date" id="date" type="date" class="form-control">
					</div>
					 
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-info save_card_given" id="">SAVE</button>
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
			</div>
        </form>
    </div>

  </div>
</div>

<div id="unblockDateModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<!-- Modal content-->
    <div class="modal-content">
		  <div class="modal-header bg-danger text-white">
			<h4 class="modal-title">Un Block & Update Date</h4>&nbsp;&nbsp;
			<button type="button" style="color:#fff;" class="close btn-primary" data-bs-dismiss="modal">X</button>
		  </div>
        <form method="post" enctype="multipart/form-data" id="unblock-date-form" action="">
			@csrf
			<div class="modal-body">
				<div class="row">
					<div style="display:none;" id="show-unbblockdate-form-error" class="alert alert-danger col-md-12">
						<ul>
							<div class="errorMsgntainer"></div>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h4>Name: <span class="text-success" id="staff_name3"></span></h4>
						<h4>Employee Code: <span class="text-success" id="employee_code3"></span></h4>
					</div>
					<div class="col-md-12">
					    <div class="form-group" id="">
						 <label class="font-weight-bold" for="">Update Date <span class="text-danger">*</span></label>
						 <input name="created_at" id="created_at" class="form-control" required>
						 
						 <input type="hidden" id="staff_id3" name="staff_id" class="form-control" required>
						</div>
					</div>
					
					<div class="form-group">
						<label>Select Status</label>
						<select name="unb_status" id="unb_status" class="form-control">
							<option value="">Select Reason</option>
							<option value="1">Active</option>
							<option value="0">Blocked</option>
						</select>
					</div>
					 
					
					 
					
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-info update_unblock_date_status" id="">UPDATE</button>
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
			</div>
        </form>
    </div>

  </div>
</div>

	 
<script>

	function updateunBlockDate(updateunBlockDate){
        $('#unblockDateModal').modal('show'); 
        let staff_id = $(updateunBlockDate).attr('id');
		var base_url = "{{ url('admin/emp/get-employee-details/') }}";
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
        $.ajax({
           url: base_url,
           type: 'post',
           data:'staff_id='+staff_id,
           success:function(response){
			  console.log(response.data.id);
              $('#staff_id3').val(response.data.id);
              $('#staff_name3').text(response.data.first_name);
              $('#employee_code3').text(response.data.employee_code);
              $('#unb_status').val(response.data.status);
               
              // ✅ Proper Date Format
				let rawDate = response.data.created_at;

				let dateObj = new Date(rawDate);

				let formattedDate = 
					dateObj.getFullYear() + '-' +
					String(dateObj.getMonth() + 1).padStart(2, '0') + '-' +
					String(dateObj.getDate()).padStart(2, '0') + ' ' +
					String(dateObj.getHours()).padStart(2, '0') + ':' +
					String(dateObj.getMinutes()).padStart(2, '0') + ':' +
					String(dateObj.getSeconds()).padStart(2, '0');

				$('#created_at').val(formattedDate);
              
           }
       })
    }

	$(document).on('submit', '#unblock-date-form', function(e) {
		e.preventDefault();
		var clk_btns = $(".update_unblock_date_status");
		clk_btns.prop('disabled', true).text('Updating...');
		var formData = new FormData(this);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type: "POST",
			url: "{{ route('admin.emp.updateUnBlockDateStatus') }}",
			data: formData,
			processData: false,
			contentType: false,
			dataType: "JSON",
			success: function(data) {
				clk_btns.prop('disabled', false).text('UPDATE');

				if (data.status === true) {
					$('#unblock-date-form')[0].reset();
					document.getElementById('show-unbblockdate-form-error').style.display = "none";
					$('.errorMsgntainer').html('');
					 $('#unblockDateModal').modal('hide'); 
					Swal.fire({
						position: "top-end",
						icon: "success",
						title: data.message,
						showConfirmButton: false,
						timer: 3500
					});
					// location.href = "{{ url('brand/campaign-preview') }}/" + data.lastId;
					location.reload();
				} else {
					// toastr.success(data.message || "Something went wrong!");
					Swal.fire({
						position: "top-end",
						icon: "error",
						title: data.message,
						showConfirmButton: false,
						timer: 3500
					});
					
				}
			},
			error: function(err) {
				
				clk_btns.prop('disabled', false).text('Update Status');
				
				document.getElementById('show-block-form-error').style.display = "block";

				let error = err.responseJSON;
				$('.errorMsgntainer').html('');
				$.each(error.errors, function(index, value) {
					$('.errorMsgntainer').append('<span class="text-danger">' + value + '</span><br>');
				});
			}
		});
	});
	
	
	
	$(document).ready(function () {

		function toggleSections() {
			let status = $('#status').val();

			if (status == "0") { // Block
				$('#block_section').show();
				$('#unblock_section').hide();
			} else { // Unblock
				$('#block_section').hide();
				$('#unblock_section').show();
			}
		}

		// on change
		$('#status').change(toggleSections);

		// page load default
		toggleSections();
	});

    function fetchUsers(page = 1) {
        let user_type_id = $('#user_type_id').val();
        let user_designation_id = $('#user_designation_id').val();
        let search = $('#search').val();

        $.ajax({
            url: "{{ route('admin.emp.fetchVivahMitraInApp') }}?page=" + page,
            method: "GET",
            data: {
                user_type_id,
                user_designation_id,
                search
            },
            success: function (data) {
                $('#user-table').html(data);
            }
        });
    }

    // Trigger on pagination click
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        fetchUsers(page);
    });

    // Trigger on filter change
    $('#user_type_id, #user_designation_id').change(function () {
        fetchUsers();
    });

    // Trigger on search
    $('#search').on('keyup', function () {
        fetchUsers();
    });

    // Reset filters
    $('#resetSearchBtn').on('click', function (e) {
        e.preventDefault();
        $('#user_type_id').val('');
        $('#user_designation_id').val('');
        $('#search').val('');
        fetchUsers();
    });
	
	function updateStaffPhoto(updateStudentPhoto){
        $('#updateStaffPhotoModal').modal('show'); 
        let staff_id = $(updateStudentPhoto).attr('id');
		var base_url = "{{ url('admin/emp/get-employee-details/') }}";
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
        $.ajax({
           url: base_url,
           type: 'post',
           data:'staff_id='+staff_id,
           success:function(response){
			  console.log(response.data.id);
              $('#staff_id').val(response.data.id);
              $('#staff_name').text(response.data.first_name);
              $('#employee_code').text(response.data.employee_code);
              
           }
       })
    }
	
	function updateBlockUnblock(updateBlockUnblock){
        $('#blockUnblockModal').modal('show'); 
        let staff_id = $(updateBlockUnblock).attr('id');
		var base_url = "{{ url('admin/emp/get-employee-details/') }}";
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
        $.ajax({
           url: base_url,
           type: 'post',
           data:'staff_id='+staff_id,
           success:function(response){
			  console.log(response.data.id);
              $('#staff_id1').val(response.data.id);
              $('#staff_name1').text(response.data.first_name);
              $('#employee_code1').text(response.data.employee_code);
              $('#status').val(response.data.status);
              $('#block_reason').val(response.data.block_reason);
              $('#block_date').val(response.data.block_date);
              $('#unblock_reason').val(response.data.unblock_reason);
              $('#unblock_date').val(response.data.unblock_date);
              
           }
       })
    }
	
	function givePhysicalCard(givePhysicalCard){
        $('#givePhysicalCardModal').modal('show'); 
        let staff_id = $(givePhysicalCard).attr('id');
		var base_url = "{{ url('admin/emp/get-employee-details/') }}";
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
        $.ajax({
           url: base_url,
           type: 'post',
           data:'staff_id='+staff_id,
           success:function(response){
			  console.log(response.data.id);
              $('#staff_id2').val(response.data.id);
              $('#staff_name2').text(response.data.first_name);
              $('#employee_code2').text(response.data.employee_code);
			}
       })
    }

	
	/* Physical card given */
	$(document).on('submit', '#card-given-form', function(e) {
		e.preventDefault();
		var clk_btns = $(".save_card_given");
		clk_btns.prop('disabled', true).text('Saving...');
		var formData = new FormData(this);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type: "POST",
			url: "{{ route('admin.emp.saveCardGiven') }}",
			data: formData,
			processData: false,
			contentType: false,
			dataType: "JSON",
			success: function(data) {
				clk_btns.prop('disabled', false).text('SAVE');

				if (data.status === true) {
					$('#photo-form')[0].reset();
					document.getElementById('show-card-form-error').style.display = "none";
					$('.errorMsgntainer').html('');
					 $('#updateStaffPhotoModal').modal('hide'); 
					Swal.fire({
						position: "top-end",
						icon: "success",
						title: data.message,
						showConfirmButton: false,
						timer: 3500
					});
					// location.href = "{{ url('brand/campaign-preview') }}/" + data.lastId;
					location.reload();
				} else {
					// toastr.success(data.message || "Something went wrong!");
					Swal.fire({
						position: "top-end",
						icon: "error",
						title: data.message,
						showConfirmButton: false,
						timer: 3500
					});
					
				}
			},
			error: function(err) {
				clk_btns.prop('disabled', false).text('SAVE');
				document.getElementById('show-card-form-error').style.display = "block";

				let error = err.responseJSON;
				$('.errorMsgntainer').html('');
				$.each(error.errors, function(index, value) {
					$('.errorMsgntainer').append('<span class="text-danger">' + value + '</span><br>');
				});
			}
		});
	});
	
	
	
	/* update photo */
	$(document).on('submit', '#photo-form', function(e) {
		e.preventDefault();
		var clk_btns = $(".update_photo");
		clk_btns.prop('disabled', true).text('Saving...');
		var formData = new FormData(this);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type: "POST",
			url: "{{ route('admin.emp.SaveEmployeePhoto') }}",
			data: formData,
			processData: false,
			contentType: false,
			dataType: "JSON",
			success: function(data) {
				clk_btns.prop('disabled', false).text('Save Photo');

				if (data.status === true) {
					$('#photo-form')[0].reset();
					document.getElementById('show-photo-form-error').style.display = "none";
					$('.errorMsgntainer').html('');
					 $('#updateStaffPhotoModal').modal('hide'); 
					Swal.fire({
						position: "top-end",
						icon: "success",
						title: data.message,
						showConfirmButton: false,
						timer: 3500
					});
					// location.href = "{{ url('brand/campaign-preview') }}/" + data.lastId;
					location.reload();
				} else {
					// toastr.success(data.message || "Something went wrong!");
					Swal.fire({
						position: "top-end",
						icon: "error",
						title: data.message,
						showConfirmButton: false,
						timer: 3500
					});
					
				}
			},
			error: function(err) {
				clk_btns.prop('disabled', false).text('Save Photo');
				document.getElementById('show-photo-form-error').style.display = "block";

				let error = err.responseJSON;
				$('.errorMsgntainer').html('');
				$.each(error.errors, function(index, value) {
					$('.errorMsgntainer').append('<span class="text-danger">' + value + '</span><br>');
				});
			}
		});
	});
	
	/* block unblock user **/
	
	$(document).on('submit', '#block-form', function(e) {
		e.preventDefault();
		var clk_btns = $(".update_block_stats");
		clk_btns.prop('disabled', true).text('Updating...');
		var formData = new FormData(this);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type: "POST",
			url: "{{ route('admin.emp.updateBlockStatus') }}",
			data: formData,
			processData: false,
			contentType: false,
			dataType: "JSON",
			success: function(data) {
				clk_btns.prop('disabled', false).text('UPDATE');

				if (data.status === true) {
					$('#photo-form')[0].reset();
					document.getElementById('show-block-form-error').style.display = "none";
					$('.errorMsgntainer').html('');
					 $('#updateStaffPhotoModal').modal('hide'); 
					Swal.fire({
						position: "top-end",
						icon: "success",
						title: data.message,
						showConfirmButton: false,
						timer: 3500
					});
					// location.href = "{{ url('brand/campaign-preview') }}/" + data.lastId;
					location.reload();
				} else {
					// toastr.success(data.message || "Something went wrong!");
					Swal.fire({
						position: "top-end",
						icon: "error",
						title: data.message,
						showConfirmButton: false,
						timer: 3500
					});
					
				}
			},
			error: function(err) {
				
				clk_btns.prop('disabled', false).text('Update Status');
				
				document.getElementById('show-block-form-error').style.display = "block";

				let error = err.responseJSON;
				$('.errorMsgntainer').html('');
				$.each(error.errors, function(index, value) {
					$('.errorMsgntainer').append('<span class="text-danger">' + value + '</span><br>');
				});
			}
		});
	});
	
	
	
	$('#user_type_id').on('change', function () {
		var userTypeId = $(this).val();
		if (userTypeId) {
			$.ajax({
				url: '{{ url("admin/get-designation-by-user") }}/' + userTypeId,
				type: "GET",
				dataType: "json", 
				success: function (data) {
					$('#user_designation_id').empty();
					$('#user_designation_id').append('<option value="">Select Designation</option>');
					$.each(data, function (key, value) {
						$('#user_designation_id').append('<option value="' + value.id + '">' + value.name + '</option>');
					});
				}
			});
		} else {
			$('#user_designation_id').empty();
			$('#user_designation_id').append('<option value="">Select Designation</option>');
		}
	});


</script>


@endsection
