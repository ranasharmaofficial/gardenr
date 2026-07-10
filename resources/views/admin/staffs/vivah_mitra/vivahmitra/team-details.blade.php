@extends('admin.include.master')
@section('title', 'Vivah Mitra List')
@section('content')

<style>
    table.table-bordered td,
    table.table-bordered th {
        border: 1px solid #dee2e6 !important;
    }
 

.team-tree,
.team-tree ul{
    list-style:none;
    padding-left:20px;
}

.node{
    cursor:pointer;
    padding:6px 10px;
    background:#f1f3f5;
    border-radius:6px;
    display:inline-block;
    margin:4px 0;
    font-weight:600;
}

.node:hover{
    background:#d794ea;
    color:#fff;
}

.child{
    margin-left:20px;
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
										<h5 class="mb-0">
											Team of {{ $manager->first_name }} {{ $manager->employee_code }}
										</h5>
										<a href="{{ url('admin/vivah-mitra-list') }}" class="btn btn-primary ms-auto">
											Back
										</a>
									</div>
									<div class="card-body booking_card">
										 
										<div class="table-responsive">
											 <table class="table table-bordered table-hover mb-0">

												<thead class="table-dark">
													<tr>
														<th>#</th>
														<th>Name</th>
														<th>Designation</th>
														<th>Employee Code</th>
														<th>Mobile</th>
														<th>Email</th>
														<th>User Type</th>
														<th>Team</th>
													</tr>
												</thead>

												<tbody>

													@forelse($teamMembers as $k => $user)
														@php
															$designationName = \App\Models\MasterDesignation::where('id', $user->user_designation_id)->value('name');
														@endphp
														<tr>
															<td>{{ $k+1 }}</td>
															<td>{{ $user->first_name }} {{ $user->last_name }}</td>
															<td>{{ $designationName }}</td>
															<td>{{ $user->employee_code }}</td>
															<td>{{ $user->mobile }}</td>
															<td>{{ $user->email }}</td>
															<td>{{ $user->user_type_id }}</td>
															<td>
																<a href="{{ route('admin.viewTeam', $user->id) }}" class="btn btn-info btn-sm btn-info-light">View&nbsp;Team</a>
															</td>
														</tr>

													@empty

														<tr>
															<td colspan="6" class="text-center text-muted">
																No team members found
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
	 
<script>
    function fetchUsers(page = 1) {
        let user_type_id = $('#user_type_id').val();
        let user_designation_id = $('#user_designation_id').val();
        let search = $('#search').val();

        $.ajax({
            url: "{{ route('admin.emp.fetchVivahMitra') }}?page=" + page,
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
<script>

////////////////////////////////////////////////////
// LAZY LOAD TREE
////////////////////////////////////////////////////
$(document).on('click', '.node', function () {

    let el = $(this);
    let id = el.data('id');
    let child = el.next('.child');

    // already loaded → toggle
    if(child.children().length > 0){
        child.toggleClass('d-none');
        return;
    }

    $.get('admin/emp/team-children/' + id, function (users) {

        let html = '';

        users.forEach(u => {
            html += `
                <li>
                    <span class="node" data-id="${u.id}">
                        ▶ ${u.first_name} ${u.last_name} (${u.employee_code ?? '-'})
                    </span>
                    <ul class="child d-none"></ul>
                </li>
            `;
        });

        child.html(html).removeClass('d-none');
    });

});



////////////////////////////////////////////////////
// SEARCH
////////////////////////////////////////////////////
$('#searchUser').on('keyup', function(){

    let q = $(this).val();

    if(q.length < 2){
        $('#searchResult').html('');
        return;
    }

    $.get('admin/emp/team-search?q='+q, function(users){

        let html = '';

        users.forEach(u => {
            html += `
                <a href="/emp/view-team-details/${u.id}"
                   class="list-group-item list-group-item-action">
                   ${u.first_name} ${u.last_name}
                   (${u.employee_code ?? '-'})
                </a>
            `;
        });

        $('#searchResult').html(html);
    });

});

</script>

@endsection
