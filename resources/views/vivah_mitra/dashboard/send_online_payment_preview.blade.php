@extends('vivah_mitra.layouts.master')
@section('title') Send Online Payment Preview @endsection

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
                        <h5 class="mb-0">Send Online Payment Details </h5>
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
                    <div class="features-boxs  mt-3">
					 



						<div class="row m-b20 g-3">
							<div class="container mt-4">

							<div class="card shadow-lg border-0 rounded-4 p-4">

								<!-- Header -->
								<div class="text-center mb-3">
									<h3 class="fw-bold text-primary">💳 Payment Preview</h3>
									<p class="text-muted mb-0">कृपया विवरण जांच लें</p>
								</div>

								<!-- Details -->
								<div class="row text-center mb-3">
									<div class="col-6 col-md-3 mb-2">
										<div class="p-3 bg-light rounded-3">
											<small class="text-muted">Date</small>
											<div class="fw-bold">{{ now()->format('d-m-Y') }}</div>
										</div>
									</div>

									<div class="col-6 col-md-3 mb-2">
										<div class="p-3 bg-light rounded-3">
											<small class="text-muted">Day</small>
											<div class="fw-bold">{{ now()->format('l') }}</div>
										</div>
									</div>

									<div class="col-6 col-md-3 mb-2">
										<div class="p-3 bg-light rounded-3">
											<small class="text-muted">Time</small>
											<div class="fw-bold">{{ now()->format('h:i A') }}</div>
										</div>
									</div>

									<div class="col-6 col-md-3 mb-2">
										<div class="p-3 bg-success text-white rounded-3">
											<small>Total Amount</small>
											<div class="fw-bold fs-5">₹ {{ $amount }}</div>
										</div>
									</div>
								</div>

								<!-- Screenshot Count -->
								<div class="text-center mb-3">
									<span class="badge bg-primary p-2">
										Screenshots: {{ count($images) }}
									</span>
								</div>

								<!-- Images -->
								<div class="d-flex flex-wrap justify-content-center gap-3 mb-3">
									@foreach($images as $img)
										<div class="position-relative">
											<img src="{{ asset('storage/app/public/'.$img) }}" 
												 class="rounded-3 shadow-sm" 
												 style="width:120px;height:120px;object-fit:cover;">
										</div>
										 
									@endforeach
								</div>
								

								<!-- Warning -->
								<div class="alert alert-danger text-center">
									⚠️ कृपया पुनः जांच कर लें, सबमिट होने के बाद बदलाव नहीं होगा
								</div>

								<!-- Buttons -->
								<div class="d-flex justify-content-center gap-3">

									<form action="{{ route('member.onlinePaymentStore') }}" method="POST">
										@csrf
										<button type="submit" class="btn btn-success px-4 rounded-pill shadow">
											✅ Final Submit
										</button>
									</form>

									<a href="{{ route('member.sendOnlinePayment') }}" 
									   class="btn btn-warning px-4 rounded-pill shadow">
										✏️ Edit
									</a>

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
$(document).ready(function () {

    // Add new field
    $(document).on('click', '.add-btn', function () {
        let html = `
        <div class="col-md-4 mb-3 screenshot-group">
            <div class="form-group">
                <label style="float:left;">Select Screenshot</label>
                <div class="input-group">
                    <input type="file" class="form-control" name="screenshot[]">
                    <button type="button" class="btn btn-danger remove-btn">-</button>
                </div>
            </div>
        </div>`;
        
        $('#screenshot-wrapper').append(html);
    });

    // Remove field
    $(document).on('click', '.remove-btn', function () {
        $(this).closest('.screenshot-group').remove();
    });

});
</script>

    @include('vivah_mitra.includes.home_footer_menu')

    @endsection
