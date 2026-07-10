@extends('admin.include.master')
@section('title')
	{{ $page_title }}
@endsection

@section('content')
<style>
/* The check-container */
.check-container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  font-weight: unset;
  box-shadow: 1px 2px 1px 0px #d7d0d0;
  border-top: 1px solid #f2f9ff;
}

/* Hide the browser's default checkbox */
.check-container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.check-container:hover input ~ .checkmark {
  background-color: #ccc;
}

.check-container:hover input:checked  ~ .checkmark {
  background-color: #df02ba;
}

/* When the checkbox is checked, add a blue background */
.check-container input:checked ~ .checkmark {
  border: 1px solid #fcf50f;
  background-color: #ff00d4;
  box-shadow: 1px 1px 2px 1px #b4b2b2;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.check-container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.check-container .checkmark:after {
  left: 8px;
  top: 2px;
  width: 9px;
  height: 15px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
#UserRol h4{
  line-height: unset;
}

.toggle-child {
  text-align: center;
  float: right;
  margin-top: -37px;
  margin-right: 0px;
  width: 20px;
  box-shadow: 1px 2px 1px 0px #d7d0d0;
  border-top: 1px solid #f2f9ff;
}

  #frm-change-order .nev_id{
    background-color: aliceblue;
    text-align: center;
    color: black;
    border: 2px solid #a29696;
  }

  #frm-change-order td, th { text-transform: none !important; }
  ul {
  list-style: none;
}
 
    
	
	tr th{
		font-size:15px !important;
	}
	
	.highlight-check {
        display: flex;
        gap: 10px;
        padding: 14px 16px;
        border: 2px solid #d4dcee;
        border-radius: 12px;
        cursor: pointer;
        font-size: 18px;
        font-weight: 600;
        color: #0a2a61;
        transition: 0.25s;
    }

    .highlight-check input[type="checkbox"] {
        width: 22px;
        height: 22px;
        accent-color: #315bff;
    }

    .highlight-check:has(input:checked) {
        background: #e8edff;
        border-color: #315bff;
        box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
    }
	
	.profile-card {
		width: 100%;
		max-width: 420px;
		margin: 20px auto;
		background: linear-gradient(135deg, #e0f2ff, #f5f5ff);
		padding: 15px;
		border-radius: 18px;
		box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
		font-family: 'Inter', sans-serif;
	}

	.profile-header {
		display: flex;
		align-items: center;
		gap: 20px;
	}

	.profile-header img {
		width: 110px;
		height: 110px;
		border-radius: 14px;
		object-fit: cover;
		border: 3px solid white;
		box-shadow: 0 3px 12px rgba(0,0,0,0.15);
	}

	.profile-name {
		font-size: 24px;
		font-weight: 700;
		color: #1f2937;
	}

	.profile-position {
		font-size: 16px;
		font-weight: 600;
		color: #2563eb;
	}

	.profile-table {
		width: 100%;
		margin-top: 20px;
		border-collapse: collapse;
	}

	.profile-table th {
		text-align: left;
		padding: 10px 5px;
		font-weight: 600;
		color: #374151;
		width: 30%;
	}

	.profile-table td {
		padding: 10px 5px;
		font-weight: 500;
		color: #1d4ed8;
	}

	.profile-card:hover {
		transform: translateY(-3px);
		transition: 0.25s;
	}

</style>

<!-- Page Header -->
<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h4 class="fw-medium mb-2">{{ $page_title }}</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Update {{ $page_title }}</li>
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
                <div class="card">
				<div class="card-header d-flex align-items-center justify-content-between">
						<h5 class="card-title">{{ $page_title }}</h5>
						<a href="{{ url('admin/navigation/user-roles') }}" class="btn btn-primary ms-auto">
							Employee List
						</a>
					</div>
                    <div class="card-body booking_card">
						<div class="row justify-content-center">
							<div class="col-sm-6">
								<div class="profile-card">

									<!-- Profile Header with Image -->
									<div class="profile-header">
										<img src="{{ static_asset($staff->profile_pic) }}" alt="Profile Photo">

										<div>
											<div class="profile-name">{{ $staff->first_name }}</div>
											<div class="profile-position">{{ $staff->designation_name }}</div>
										</div>
									</div>

									<!-- Details Table -->
									<table class="profile-table">
										<tr>
											<th>Employee Code</th>
											<td>{{ $staff->employee_code }} - {{ $staff->id }}</td>
										</tr>
										<tr>
											<th>Type</th>
											<td>{{ $staff->user_type_name }}</td>
										</tr>
										<tr>
											<th>Branch</th>
											<td>{{ $staff->branch_name }}</td>
										</tr>
										<tr>
											<th>Session</th>
											<td>{{ $staff->session_name }}</td>
										</tr>
										<tr>
											<th>Mobile</th>
											<td>{{ $staff->mobile }}</td>
										</tr>
										<tr>
											<th>Email</th>
											<td>{{ $staff->email }}</td>
										</tr>
									</table>
								</div>


							</div>
							
							<div class="col-sm-12">
								<div class="row" id="UserRol">
								
									@foreach($menus as $nav)
										<div class="col-md-4 col-sm-4 myList">
											<div class="page-box">
												<ul>
													<li>
														<h4>
															<label class="check-container" style="background-color:#ffff0026;margin-right:20px;">
																<input class="check-nev" type="checkbox" name="navid[]" value="{{ $nav->id }}" {{ in_array($nav->id, $assignedMenus) ? 'checked' : '' }}>
																<span class="checkmark"></span>
																{{ $nav->name }}
															</label>

															@if($nav->children->count())
																<span class="toggle-child" style="background-color:#ffff0026;">
																	<i class="fa fa-arrow-up"></i>
																</span>
															@endif
														</h4>

														{{-- LEVEL 2 --}}
														@if($nav->children->count())
														<ul>
															@foreach($nav->children as $subnav)
															<li style="margin-left:15px;margin-top:5px;">
																<label class="check-container" style="background-color:#ffc0cb8f;margin-right:20px;">
																	<input class="check-nev" type="checkbox" name="navid[]" value="{{ $subnav->id }}" {{ in_array($subnav->id, $assignedMenus) ? 'checked' : '' }}>
																	<span class="checkmark"></span>
																	<b>{{ $subnav->name }}</b>
																</label>

																@if($subnav->children->count())
																	<span class="toggle-child" style="background-color:#ffc0cb8f;">
																		<i class="fa fa-arrow-down"></i>
																	</span>
																@endif

																{{-- LEVEL 3 --}}
																@if($subnav->children->count())
																<ul style="display:none;">
																	@foreach($subnav->children as $menu)
																	<li style="margin-left:15px;margin-top:5px;">
																		<label class="check-container" style="background-color:#16f91647;">
																			<input class="check-nev" type="checkbox" name="navid[]" value="{{ $menu->id }}">
																			<span class="checkmark"></span>
																			{{ $menu->name }}
																		</label>
																	</li>
																	@endforeach
																</ul>
																@endif
															</li>
															@endforeach
														</ul>
														@endif

													</li>
												</ul>
											</div>
										</div>
									@endforeach



									 
								</div>
							</div>
                        
						
						 

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<script>
    $("div#UserRol .toggle-child").on('click', function(){
		  var clk_btn = $(this), btn_icon = clk_btn.children('i'),
		  target_ul = clk_btn.parents('li').eq(0).children('ul');

		  if (btn_icon.hasClass("fa-arrow-down")) {
			btn_icon.removeClass("fa-arrow-down");
			btn_icon.addClass("fa-arrow-up");
			target_ul.show('slow');
		  }else{
			btn_icon.removeClass("fa-arrow-up");
			btn_icon.addClass("fa-arrow-down");
			target_ul.hide('slow');
		  }
  
	});
	
	$(document).on('change', '.check-nev', function () {

		let checkbox = $(this);
		let navId    = checkbox.val();
		let checked  = checkbox.is(':checked') ? 1 : 0;
		let userId   = "{{ $staff->id }}";

		/* 🔹 1. AUTO PARENT CHECK */
		if (checked) {
			checkbox
				.closest('ul')
				.prev('h4')
				.find('input[type=checkbox]')
				.prop('checked', true);
		}

		/* 🔹 2. AUTO CHILD UNCHECK */
		if (!checked) {
			checkbox
				.closest('li')
				.find('ul input[type=checkbox]')
				.prop('checked', false);
		}

		/* 🔹 3. AJAX ADD / REMOVE */
		$.ajax({
			url: "{{ route('admin.user.menu.toggle') }}",
			type: "POST",
			data: {
				_token: "{{ csrf_token() }}",
				user_id: userId,
				nav_id: navId,
				checked: checked
			},
			success: function () {
				console.log('Permission updated');
			}
		});

	});

</script>

<script>
	$(document).ready(function () {
		$('#state').on('change', function () {
			var stateID = $(this).val();
			if (stateID) {
				$.ajax({
					url: '{{ url("get-district-by-state") }}/' + stateID,
					type: "GET",
					dataType: "json",
					success: function (data) {
						$('#city').empty();
						$('#city').append('<option value="">Select City</option>');
						$.each(data, function (key, value) {
							$('#city').append('<option value="' + value.id + '">' + value.name + '</option>');
						});
					}
				});
			} else {
				$('#city').empty();
				$('#city').append('<option value="">Select City</option>');
			}
		});
		
		$('#user_type_id').on('change', function () {
			var userTypeId = $(this).val();
			if (userTypeId) {
				$.ajax({
					url: '{{ url("admin/get-designation-by-user") }}/' + userTypeId,
					type: "GET",
					dataType: "json", //getDesignationByUserType
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
	
	
	$(document).on('submit', '#stepForm', function(e) {
		e.preventDefault();

		var clk_btns = $(".saveCampaign");
		clk_btns.prop('disabled', true).text('Processing...');

		var formData = new FormData(this);

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: "POST",
			url: "{{ route('admin.emp.SaveEmployeeDetails') }}",
			data: formData,
			processData: false,
			contentType: false,
			dataType: "JSON",
			success: function(data) {
				clk_btns.prop('disabled', false).text('Save Details');

				if (data.status === true) {
					$('#stepForm')[0].reset();
					$('.errorMsgntainer').html('');
					Swal.fire({
						icon: "success",
						title: "Success",
						text: data.message,
						timer: 1500,
						showConfirmButton: false
					});
					// location.href = "{{ url('brand/campaign-preview') }}/" + data.lastId;
				} else {
					// toastr.success(data.message || "Something went wrong!");
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
				clk_btns.prop('disabled', false).text('Save Details');
				document.getElementById('show-campaign-form-error').style.display = "block";

				let error = err.responseJSON;
				$('.errorMsgntainer').html('');
				$.each(error.errors, function(index, value) {
					$('.errorMsgntainer').append('<span class="text-danger">' + value + '</span><br>');
				});
			}
		});
	});
</script>


@endsection

@section('script')
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea#answer',
        });

    </script>
@endsection
