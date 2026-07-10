@extends('vivah_mitra.layouts.master')
@section('title') Physical Card @endsection

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

		/* Notification Card */
.notify-card{
    max-width:600px;
    margin:50px auto;
    background:#fff;
    border-radius:16px;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
    overflow:hidden;
    border-left:6px solid #ff9800;
}

/* Header */
.notify-header{
    background:linear-gradient(45deg,#ff9800,#ff5722);
    color:#fff;
    padding:15px 20px;
    font-size:20px;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:10px;
}

/* Body */
.notify-body{
    padding:20px;
    color:#333;
    line-height:1.7;
    font-size:16px;
}

/* Highlight */
.highlight{
    color:#ff5722;
    font-weight:600;
}

/* Note Box */
.note-box{
    margin-top:20px;
    padding:15px;
    background:#fff3e0;
    border-left:5px solid #ff9800;
    border-radius:10px;
    font-size:15px;
}

/* Footer Quote */
.notify-footer{
    padding:15px 20px;
    background:#fafafa;
    text-align:center;
    font-weight:600;
    color:#444;
    font-style:italic;
    border-top:1px solid #eee;
}

/* Icon */
.icon{
    font-size:22px;
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
                        <h5 class="mb-0">Physical Card Received History </h5>
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


						@php
							$from_user_name = \App\Models\User::where('id', $kit_received_details->from_user_id)->pluck('first_name')->first();
							$to_user_name = \App\Models\User::where('id', $kit_received_details->to_user_id)->pluck('first_name')->first();
							$to_user_designation_id = \App\Models\User::where('id', $kit_received_details->to_user_id)->pluck('user_designation_id')->first();
							$to_user_designation_name = \App\Models\MasterDesignation::where('id', $to_user_designation_id)->pluck('name')->first();
						@endphp

						<div class="row m-b20 g-3">
							<div class="container">

								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
										{{--<tr>
												<td colspan="2">“मैं, {{ $from_user_name }} ({{ $to_user_name }} / {{$to_user_designation_name}}) से {{ $kit_received_details->quantity }} किट प्राप्त कर रहा/रही हूँ।”</td>
											</tr>--}}
											<tr>
												<td colspan="2">

													<div class="notify-card">

														<div class="notify-header">
															<i class="fa-solid fa-bell icon"></i>
															नोटिफिकेशन
														</div>

														<div class="notify-body">
															<p>
																मैं, <span class="highlight">{{ $from_user_name ?? 'ADMIN' }}</span>
																(<span class="highlight">{{ $to_user_name }} / {{$to_user_designation_name}}</span>) से
																<span class="highlight">{{ $kit_received_details->quantity }} फिज़िकल कार्ड </span> प्राप्त कर रहा/रही हूँ।
															</p>

															<div class="note-box">
																<strong>📝 नोट:</strong><br>
																यदि किसी भी कारणवश फिज़िकल कार्ड  मेरे पास से खो जाता है या मिस हो जाता है,
																तो इसकी पूर्ण जिम्मेदारी मेरी होगी तथा मैं इसकी भरपाई करने के लिए बाध्य रहूँगा/रहूँगी।
															</div>
														</div>

														<div class="notify-footer">
															“जिम्मेदारी के साथ काम — पारदर्शिता के साथ विश्वास।”
														</div>

													</div>

												</td>
											</tr>
											<tr>
												<th style="font-size:18px;">Transferred By</th>
												<th style="font-size:18px;">{{ $from_user_name ?? 'ADMIN' }}</th>
											</tr>
											<tr>
												<th style="font-size:18px;">Received By</th>
												<th style="font-size:18px;">{{ $to_user_name }}</th>
											</tr>
											<tr>
												<th style="font-size:18px;">Quantity</th>
												<th style="font-size:18px;">{{ $kit_received_details->quantity }}</th>
											</tr>

											<tr>
												<th style="font-size:18px;">Acccept Physical Card</th>
												<th style="font-size:18px;">
													@if($kit_received_details->status=='pending')
														<form method="post" id="save-form" action="{{ route('member.acceptPhysicalCardTransfer') }}">
															<input type="hidden" name="id" value="{{ $kit_received_details->id }}">
															@csrf
															<div class="row">
																<div style="display:none;" id="show-form-error" class="alert alert-danger col-md-12">
																	<ul>
																		<div class="errorMsgntainer"></div>
																	</ul>
																</div>
															</div>
															<div class="form-group">
																<label>Select Status</label>
																<select class="form-control" required name="status">
																	<option value="">Select Status</option>
																	<option @if($kit_received_details->status=='accepted') selected @endif value="accepted">ACCEPT</option>
																	<option @if($kit_received_details->status=='rejected') selected @endif value="rejected">REJECTED</option>
																</select>
															</div>

															<div class="form-group mt-3">
																<button type="submit" name="submit" class="btn btn-primary saveDetails">SUBMIT</button>
															</div>
														</form>
													@endif

													@if($kit_received_details->status=='accepted')
														<span class="badge bg-success">ACCEPTED</span>
													@endif

													@if($kit_received_details->status=='rejected')
														<span class="badge bg-danger">REJECTED</span>
													@endif


												</th>
											</tr>

										</thead>




									</table>
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
	 <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	 <script>
$(document).ready(function(){
    $('.accordion-header').click(function(){
        var parent = $(this).parent();

        // Close others (optional)
        $('.accordion-item').not(parent).removeClass('active');

        // Toggle current
        parent.toggleClass('active');
    });
});

$(document).on('submit', '#save-form', function (e) {
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
			url: "{{ route('member.acceptPhysicalCardTransfer') }}",
			data: formData,
			processData: false,
			contentType: false,
			dataType: "JSON",
			success: function (data) {
				clk_btns.prop('disabled', false).text('Save Details');

				if (data.status === true) {
					//$('#save-form')[0].reset();
					$('.errorMsgntainer').html('');
					Swal.fire({
						icon: "success",
						title: "Success",
						text: data.message,
						timer: 1500,
						showConfirmButton: false
					});
					// document.getElementById('show-form-error').style.display = "none";
					location.reload();
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
</script>


    @include('vivah_mitra.includes.home_footer_menu')

    @endsection
