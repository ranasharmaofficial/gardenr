@extends('vivah_mitra.layouts.master')
@section('title') Send Monthly Routine Work @endsection

@section('meta_tags')

@endsection
@section('content')
	<style >
	.features-box {
		background: #fff;
		border-radius: 14px;
		padding: 5px;
		box-shadow: 0 6px 14px rgba(0,0,0,0.08);
		transition: 0.3s;
		text-align: center;
	}
	
	.policy-accordion {
    max-width: 900px;
    margin: auto;
}

.accordion-item {
    background: #fff;
    border-radius: 10px;
    margin-bottom: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    overflow: hidden;
    border-left: 5px solid #007bff;
}

.accordion-header {
    padding: 15px 20px;
    cursor: pointer;
    font-weight: 600;
    position: relative;
    font-size: 16px;
    background: #f8f9fc;
}

.accordion-header .icon {
    position: absolute;
    right: 20px;
    font-size: 20px;
    font-weight: bold;
}

.accordion-body {
    display: none;
    padding: 15px 20px;
    font-size: 15px;
    color: #555;
    line-height: 1.7;
}

.accordion-item.active .accordion-body {
    display: block;
}

.accordion-item.active .icon::before {
    content: "-";
}

.icon::before {
    content: "+";
}

/* Color variants */
.blue { border-left-color: #007bff; }
.green { border-left-color: #28a745; }
.info { border-left-color: #17a2b8; }
.orange { border-left-color: #fd7e14; }
.red { border-left-color: #dc3545; }
.warning { border-left-color: #ffc107; }
	
	
	/* TABLE DESIGN */
#routingTable {
    width: 100%;
    border-collapse: collapse;
}

#routingTable th,
#routingTable td {
    border: 1px solid #dcdcdc;
    padding: 8px;
    vertical-align: middle;
}

/* REMOVE ROUND SHAPE */
#routingTable .form-control {
    border-radius: 0px !important;
    height: 45px;
    min-width: 180px; /* Increased Width */
    font-size: 14px;
    padding: 8px 10px;
}

/* DATE FIELD FIX */
#routingTable input[type="date"] {
    min-width: 170px;
}

/* VISIT PLACE + WORK FIELD BIGGER */
#routingTable input[type="text"] {
    min-width: 220px;
}

/* BUTTON STYLE */
.addRow {
    border-radius: 0px !important;
    width: 42px;
    height: 42px;
    font-size: 18px;
}

/* MOBILE FIX */
@media (max-width: 768px) {

    .table-responsive {
        overflow-x: auto;
    }

    #routingTable {
        min-width: 850px; /* Important */
    }

    #routingTable .form-control {
        min-width: 180px;
    }

    #routingTable input[type="text"] {
        min-width: 220px;
    }
}
	 
	</style >
	<!-- jQuery (ONLY ONCE) -->
 


   <!-- Header -->
    <header class="header">
        <div class="main-bar">
            <div class="container">
                <div class="header-content">
                    <div class="left-content">
                        <a href="javascript:void(0);" class="back-btn">
                            <svg width="18" height="18" viewbox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M9.03033 0.46967C9.2966 0.735936 9.3208 1.1526 9.10295 1.44621L9.03033 1.53033L2.561 8L9.03033 14.4697C9.2966 14.7359 9.3208 15.1526 9.10295 15.4462L9.03033 15.5303C8.76406 15.7966 8.3474 15.8208 8.05379 15.6029L7.96967 15.5303L0.96967 8.53033C0.703403 8.26406 0.679197 7.8474 0.897052 7.55379L0.96967 7.46967L7.96967 0.46967C8.26256 0.176777 8.73744 0.176777 9.03033 0.46967Z" fill="#a19fa8"></path>
							</svg>
                        </a>
                    </div>
                    <div class="mid-content">
                        <h5 class="mb-0">Send Monthly Routine Work Details </h5>
                    </div>
                    <div class="right-content">
                        <a href="javascript:void(0);" class="menu-toggler">
							<svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path opacity="0.4" d="M16.0755 2H19.4615C20.8637 2 22 3.14585 22 4.55996V7.97452C22 9.38864 20.8637 10.5345 19.4615 10.5345H16.0755C14.6732 10.5345 13.537 9.38864 13.537 7.97452V4.55996C13.537 3.14585 14.6732 2 16.0755 2Z" fill="#a19fa8"></path>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="#a19fa8"></path>
							</svg>
						</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

     @include('vivah_mitra.includes.sidebar')

    <!-- Page Content -->
    <div class="page-content">

        <div class="content-inner pt-0">
			<div class="container fb">
                 
                <div class="dashboard-area m-b30">
					<!-- Features -->
                    <div class="features-box  mt-3">
					 



						<div class="row m-b20 g-3">
							<div class="container">
								<h4 class="mb-3">मंथली रूटीन सेव करें </h4>

								<div class="alert alert-warning">
									<b>नोट:</b> प्रत्येक माह के 30 या 31 तारीख को अगले एक माह का रूटीन बनाकर सबमिट करना अनिवार्य है!
								</div>

								<div class="routine-card">

									<form action="{{ route('member.monthlyRoutineWorkSave') }}" id="routine-work-form" method="POST">
										@csrf
										
										<div class="row">
											<div style="display:none;" id="show-form-error" class="alert alert-danger col-md-12">
												<ul>
													<div class="errorMsgntainer"></div>
												</ul>
											</div>
										</div>

										<!-- Month -->
										<div class="row mb-4">
											<div class="col-md-4">
												<label>माह चुनें</label>
												<input type="month" name="month" class="form-control" required>
											</div>
										</div>

										<div class="table-responsive">

											<table class="table routine-table" id="routingTable">

												<thead>
													<tr>
														<th>Si.</th>
														<th>Day</th>
														<th>Date</th>
														<th>Visit Place</th>
														<th>Type of Work</th>
														<th>Action</th>
													</tr>
												</thead>

												<tbody>

													<tr>

														<td data-label="Si.">
															<span class="serial">1</span>
														</td>

														<td data-label="Day">
															<select name="routing[0][day]" class="form-control" required>
																<option value="">Select Day</option>
																<option>Monday</option>
																<option>Tuesday</option>
																<option>Wednesday</option>
																<option>Thursday</option>
																<option>Friday</option>
																<option>Saturday</option>
																<option>Sunday</option>
															</select>
														</td>

														<td data-label="Date">
															<input type="date" name="routing[0][date]" class="form-control" required>
														</td>

														<td data-label="Visit Place">
															<input type="text" name="routing[0][place]" class="form-control" placeholder="Visit Place" required>
														</td>

														<td data-label="Type of Work">
															<input type="text" name="routing[0][work]" class="form-control" placeholder="Type of Work" required>
														</td>

														<td data-label="Action" class="action-btns">
															<button type="button" class="btn btn-success addRow">+</button>
														</td>

													</tr>

												</tbody>

											</table>

										</div>

										<div class="text-center mt-4">
											<button type="submit" class="btn btn-primary submit-btn saveDetails">
												Submit Routine
											</button>
										</div>

									</form>

								</div>
							</div>
									
									
								 
								
							</div>
						</div>
                    </div>
					<!-- Features End -->

					 

				</div>
			</div>
		</div>

    </div>
    <!-- Page Content End-->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
 $(document).on('submit', '#routine-work-form', function (e) {
			e.preventDefault();

			var clk_btns = $(".saveDetails");
			clk_btns.prop('disabled', true).text('Saving...');

			var formData = new FormData(this);

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				type: "POST",
				url: "{{ route('member.monthlyRoutineWorkSave') }}",
				data: formData,
				processData: false,
				contentType: false,
				dataType: "JSON",
				success: function (data) {
					clk_btns.prop('disabled', false).text('Save Details');

					if (data.status === true) {
						$('#routine-work-form')[0].reset();
						$('.errorMsgntainer').html('');
						Swal.fire({
							icon: "success",
							title: "Success",
							text: data.message,
							timer: 1500,
							showConfirmButton: false
						});
						document.getElementById('show-form-error').style.display = "none";
					} else {
						Swal.fire({
							icon: "error",
							title: "Oh No!",
							text: data.message,
							timer: 1500,
							showConfirmButton: false
						});

					}
				},
				error: function (err) {
					clk_btns.prop('disabled', false).text('Save Details');
					document.getElementById('show-form-error').style.display = "block";

					let error = err.responseJSON;
					$('.errorMsgntainer').html('');
					$.each(error.errors, function (index, value) {
						$('.errorMsgntainer').append('<span class="text-danger">' + value + '</span><br>');
					});
				}
			});
		});
		
		
let rowIndex = 1;

$(document).on('click', '.addRow', function () {

    let row = `
    <tr>
        <td class="serial"></td>

        <td>
            <select name="routing[${rowIndex}][day]" class="form-control" required>
                <option value="">Select Day</option>
                <option>Monday</option>
                <option>Tuesday</option>
                <option>Wednesday</option>
                <option>Thursday</option>
                <option>Friday</option>
                <option>Saturday</option>
                <option>Sunday</option>
            </select>
        </td>
		
		<td>
			<input type="date" name="routing[${rowIndex}][date]" class="form-control" placeholder="Date" required>
		</td>

        <td>
            <input type="text" name="routing[${rowIndex}][place]" class="form-control" placeholder="Visit Place" required>
        </td>

        <td>
            <input type="text" name="routing[${rowIndex}][work]" class="form-control" placeholder="Type of Work" required>
        </td>

        <td>
            <button type="button" class="btn btn-danger removeRow">-</button>
        </td>
    </tr>
    `;

    $('#routingTable tbody').append(row);
    rowIndex++;

    updateSerial();
});

// Remove row
$(document).on('click', '.removeRow', function () {
    $(this).closest('tr').remove();
    updateSerial();
});

// Update serial numbers
function updateSerial() {
    $('.serial').each(function (index) {
        $(this).text(index + 1);
    });
}

// initial call
updateSerial();
  
</script>

    @include('vivah_mitra.includes.home_footer_menu')

    @endsection
