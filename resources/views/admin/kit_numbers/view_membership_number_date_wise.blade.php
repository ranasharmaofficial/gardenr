@extends('admin.include.master')
@section('title')
	{{ $page_title }}
@endsection
@section('content')

<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">{!! $page_title !!}</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a class="" href="javascript:void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item  active fw-normal" aria-current="page">{!! $page_title !!}</li>
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

								<h5 class="mb-0">{!! $page_title !!}</h5>

								<a class="btn btn-danger btn-sm" title="Export Memberships" href="{{ url('admin/export-membership-date-wise/'.$date) }}">
									Export Memberships
								</a>


							</div>


                            <div class="card-body">
							
							 
							
							<div class="table-responsive">
								<div id="sssss">
									
								<table id="" class="table table-bordered text-nowrap mt-3" style="width:100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Membership Number</th>
											<th>Vivah Mitra</th>
											<th>Member</th>
											<th>Is Used</th>
											<th>Leader</th>
											<th>Used Date</th>
											<th>Created By</th>
											<th>Created At</th>
											<th class="text-right">Actions</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($membership_numbers as $key => $value)
											<tr>
												<td>{{ $key + 1 }}</td>
												<td>{{ $value->membership_number }}</td>
												<td style="color:blue;">{{ $value->vivahMitraName }}</td>
												<td style="color:green;">{{ $value->memberName }}</td>
												<td>
													@if($value->is_used==0)
														<span class="badge bg-danger">Not&nbsp;Used</span>
													@endif

													@if($value->is_used==1)
														<span class="badge bg-success">Used</span>
													@endif
												</td>
												<td>{{ $value->leaderName }}</td>
												<td> @if($value->used_date!=null) {{ date('d M, Y', strtotime($value->used_date)) }} @endif</td>
												<td>{{ $value->addedByName }}</td>
												<td>{{ date('d M, Y', strtotime($value->created_at)) }}</td>
												<td class="text-right">
													<a class="btn btn-icon btn-sm btn-primary-light rounded-pill" href=""><i class="ri-edit-line"></i></a>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>

									

								</div>

							</div>



                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:: row-2 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->

		<!-- Agreement Modal -->
<div class="modal fade" id="generateMembershipModal" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" id="generate-membership-Form" enctype="multipart/form-data">
		<div class="modal-header">
			<h5 class="modal-title" id="generateMembershipModalTitle">Generate Membership</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
		</div>

        <div class="modal-body">
            <div style="display:none;" id="show-form-error" class="alert alert-danger col-md-12">
                <ul>
                    <div class="errorMsgntainer"></div>
                </ul>
            </div>

			{{-- <div class="mb-3">
                <label class="">Select Vivah Mitra</label>
                <select type="number" required name="vivah_mitra_id"  id="vivah_mitra_id" class="form-select">
					<option value="">Select Vivah Mitra</option>
					@foreach($vivah_mitra_list as $mitra)
						<option value="{{ $mitra->id }}">{{ $mitra->first_name }} - {{ $mitra->employee_code }} </option>
					@endforeach
				</select>
            </div> --}}

            <div class="mb-3">
                <label class="">Type no of itmes you want to generate</label>
                <input type="number" name="number" min="50" maxlength="200" id="number" class="form-control" placeholder="Type no of itmes you want to generate">
            </div>

            <div class="mb-3">
                <label class="">Select only current Date</label>
                <input type="date" min="{{ date('Y-m-d') }}" name="created_date"  required id="created_date" class="form-control">
            </div>

        </div>

        <div class="modal-footer">
            <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary saveMembershipBtn" id="saveMembershipBtn">
                Generate
            </button>
        </div>

    </form>
  </div>
</div>




<script>
function openAddgenerateMembershipModal() {
    $('#agreement_id').val('');
    $('#agreement_name').val('');
    $('#agreement_status').val('1');

    $("#generateMembershipModalTitle").text("Generate Membership");
    $('#saveMembershipBtn').show();
    $('#updateDesignationBtn').hide();

    $("#targetError").addClass("d-none").html("");
}

$(document).on('click', '.saveMembershipBtn', function(e) {
		e.preventDefault();
        var clk_btn = $(".saveMembershipBtn");
        clk_btn.prop('disabled', true);
        var formData = new FormData(document.getElementById("generate-membership-Form"));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{ route('admin.membership.store') }}",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
			success: function(data) {
                console.log('status ' + data.status);
                if (data.status == true) {
                    Swal.fire({
						icon: "success",
						title: "Success",
						text: data.message,
						timer: 1500,
						showConfirmButton: false
					});
					document.getElementById('show-form-error').style = "display: none";
                    location.reload();
                } else {
                    Swal.fire({
						icon: "error",
						title: "Oh No!",
						text: "Something went wrong!",
						timer: 1500,
						showConfirmButton: false
					});
					//toastr.error('Something went wrong.');
                }
            }, error: function(err) {

                document.getElementById('show-form-error').style = "display: block";
                clk_btn.prop('disabled', false);
                let error = err.responseJSON;
                console.log(error);
                $.each(error.errors, function(index, value) {
                    $('.errorMsgntainer').append('<span class="text-danger">' + value +

                        '<span>' + '<br>');
                });

            }
        });
    });

	$(document).ready(function () {
		$('#target_type').on('change', function () {
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
	});

function editAgreement(id){

    $("#targetError").addClass("d-none").html("");

    $.ajax({
        url: "{{ url('admin/designations/edit') }}/" + id,
        type: "GET",

        success: function(res){

            $('#agreement_id').val(res.id);
            $('#agreement_name').val(res.name);
            $('#agreement_status').val(res.status);

            $("#generateMembershipModalTitle").text("Edit Master Membership");

            $('#saveMembershipBtn').hide();
            $('#updateAgreementBtn').show();

            $('#generateMembershipModal').modal('show');
        }
    });
}

function updateDesignation(){

    $("#designationError").addClass("d-none").html("");

    let id = $('#designation_id').val();

    let btn = $("#updateDesignationBtn");
    let original = btn.text();

    btn.prop("disabled", true).text("Updating...");

    $.ajax({
        url: "{{ url('admin/designations/update') }}/" + id,
        type: "POST",
        data: {
            name: $('#designation_name').val(),
            body: $('#designation_body').val(),
            status: $('#designation_status').val(),
            _token: "{{ csrf_token() }}"
        },

        success: function(res){
            btn.prop("disabled", false).text(original);

            if(res.success){
                $('#designationModal').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "Updated!",
                    text: res.message,
                    timer: 1500,
                    showConfirmButton: false
                });

                setTimeout(() => location.reload(), 1500);
            }
        },

        error: function(xhr){
            btn.prop("disabled", false).text(original);

            if(xhr.status === 422){
                let msg = "";
                $.each(xhr.responseJSON.errors, function(k, v){
                    msg += v[0] + "<br>";
                });
                $("#designationError").removeClass("d-none").html(msg);
            }
        }
    });
}

/* fetching agreement data area start */

 function fetchUsers(page = 1) {
        let vivah_mitra = $('#vivah_mitra').val();
        let search = $('#search').val();
		$.ajax({
            url: "{{ route('admin.membership.fetch') }}?page=" + page,
            method: "GET",
            data: {
                vivah_mitra,
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
    $('#vivah_mitra').change(function () {
        fetchUsers();
    });

    // Trigger on search
    $('#search').on('keyup', function () {
        fetchUsers();
    });

    // Reset filters
    $('#resetSearchBtn').on('click', function (e) {
        e.preventDefault();
        $('#vivah_mitra').val('');
        $('#search').val('');
        fetchUsers();
    });

/* fetching agreement data area end*/

</script>




@endsection

