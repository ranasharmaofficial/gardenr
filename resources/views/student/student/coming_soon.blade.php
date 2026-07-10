@extends('student.include.master')
@section('title', 'Coming Soon')
@section('content')

<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Coming Soon</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Coming Soon</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Coming Soon</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->



            <!--APP-CONTENT START-->
            <div class="main-content app-content">
                <div class="container-fluid">


                    <!-- Start:: row-1 -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">
                                        Coming Soon
                                    </div>
                                </div>
								<div class="card-body" method="post" action="{{ route('franchise.saveStudentDetails') }}" enctype="multipart/form-data">
									 
									<div class="row formtype">

										<div class="col-md-12">
											<div style="text-shadow: 7px -5px 3px #00000099;">
        <div width="100%" style="height: 500px; padding-top: 40px;">
          <center>
            <br><br><br>
            <br><br><br>
            <p class="cs-clr" style="font-weight: 1000; font-size: 100px;">work &nbsp; &nbsp; &nbsp;</p>
            <br><br><br>
            <p class="cs-clr" style="font-weight: 800; font-size: 70px;">on progress . . .</p>
          </center>
        </div>
      </div>
										</div>

										 
								</form>
                            </div>
                        </div>

                    </div>
                    <!-- End:: row-1 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
 $(document).ready(function() {
            $('#course_id').on('change', function() {
                var course = this.value;
                $("#subcourse_id").html('');
                $.ajax({
                    url: "{{ url('get-subcourse') }}",
                    type: "POST",
                    data: {
                        course: course,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#subcourse_id').html('<option value="">Select Sub Course</option>');
                        $.each(result.subcourse, function(key, value) {
                            $("#subcourse_id").append('<option value="' + value.id +
                                '">' + value.title + '</option>');
                        });
                    }
                });
            });
        });
 </script>

@endsection


@section('script')
    <script>
        // tinymce.init({
        //     selector: 'textarea#description',
        // });
        $(document).ready(function () {
            /** Get Sub category list on change on parent category */
            $('#category_id').on('change', function () {
                var idCategory = this.value;
                $("#sub_category_id").html('');

                $.ajax({
                    url: "{{url('admin/blogs/fetch_subcategory')}}",
                    type: "POST",
                    data: {
                        category_id: idCategory,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',

                    success: function (result) {
                        $('#sub_category_id').html('<option value="">Choose Sub Catyegory</option>');

                        $.each(result.sub_categories, function (key, value) {
                            $("#sub_category_id").append('<option value="' + value
                                .id + '">' + value.title + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
