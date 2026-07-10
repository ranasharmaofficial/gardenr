@extends('admin.include.master')
@section('title', 'Update Color')
@section('content')

<div class="app-container">
    <div class="content container-fluid">
        <!-- App hero header starts -->
          <div class="app-hero-header d-flex align-items-center">

            <!-- Breadcrumb starts -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
                <a href="{{ url('admin/dashboard') }}">Home</a>
              </li>
              <li class="breadcrumb-item text-primary" aria-current="page">
                Update Color
              </li>
            </ol>
            <!-- Breadcrumb ends -->


          </div>

        <div class="app-body">
			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-header d-flex align-items-center justify-content-between">
							<h5 class="card-title">Update Color</h5>
							<a href="{{ url('admin/colors') }}" class="btn btn-primary ms-auto">Color List</a>
						</div>
						<div class="card-body booking_card">
							<form method="post" id="update-speciality-form" action="{{ route('admin.colors.update',$data->id) }}" enctype="multipart/form-data">
								@csrf
								@method('put')
								<div class="row formtype">
									<div class="col-md-12">
										@if ($errors->any())
											<div class="alert alert-danger">
												<ul>
													@foreach ($errors->all() as $error)
														<li>{{ $error }}</li>
													@endforeach
												</ul>
											</div>
										@endif
									</div>
									
									<div class="col-md-12 mb-3">
										<div style="display:none;" id="show-form-error" class="alert alert-danger col-md-12">
											<ul>
												<div class="errorMsgntainer"></div>
											</ul>
										</div>
									</div>
									
									<div class="col-xxl-6 col-lg-4 col-sm-6 mb-3">
										<div class="form-group">
											<label>Color Name <span class="text-danger">*</span> </label>
											<input type="text" value="{{ $data->name }}" placeholder="Enter Color Name" class="form-control" name="name">
										</div>
									</div>
									
									<div class="col-xxl-6 col-lg-4 col-sm-6 mb-3">
										<div class="form-group">
											<label>Color Code <span class="text-danger">*</span> </label>
											<input type="color" value="{{ $data->code }}" placeholder="Enter" class="form-control" name="code">
										</div>
									</div>
									 

								</div>	
								
								<!-- Card acrions starts -->
								<div class="d-flex gap-2 justify-content-end mt-4">
								  <a href="{{ url('admin/colors') }}" class="btn btn-outline-secondary">
									Cancel
								  </a>
								 <button type="submit" class="btn btn-primary buttonedit1 update-button">Update</button>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>

    </div>
</div>


<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script>
	$(document).on('click', '.update-button', function(e) {
        e.preventDefault();
        var clk_btn = $(".update-button");
        clk_btn.prop('disabled', true).text('Updating...');

        var formData = new FormData(document.getElementById("update-speciality-form"));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('admin.colors.update',$data->id) }}",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function(data) {
                if (data.status == true) {
                    toastr.success(data.message);
                    location.reload();
                } else {
                    toastr.error(data.message);
                    clk_btn.prop('disabled', false).text('Update'); // Reset button text
                }
            },
            error: function(err) {
                document.getElementById('show-form-error').style = "display: block";
                clk_btn.prop('disabled', false).text('Update'); // Reset button text
                let error = err.responseJSON;
                $('.errorMsgntainer').html(''); // Clear previous errors
                $.each(error.errors, function(index, value) {
                    $('.errorMsgntainer').append('<span style="color:red;" class="text-danger">' + value + '<span>' + '<br>');
                });
            }
        });
    });

	</script>
@endsection

@section('script')
    <script>
        tinymce.init({
            selector: 'textarea#description',
        });
    </script>
@endsection