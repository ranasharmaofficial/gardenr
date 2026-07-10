@extends('admin.include.master')
@section('title', 'Update Video')
@section('content')

<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Update Video</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a class="" href="javascript:void(0);">Video</a></li>
                                <li class="breadcrumb-item  active fw-normal" aria-current="page">Update Video</li>
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
                            <div class="card-header">
                                <div class="card-title">
                                    Update Video
									<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/testimonial/videos') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Video List</a>
                                </div>
                            </div>
                            <div class="card-body">
								<form method="post" action="{{ route('admin.testimonial.videos.update',$video->id) }}" enctype="multipart/form-data">
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


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" name="title" value="{{$video->title}}"> 
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status </label>
                                        <select class=" form-control" name="status" required>
                                            <option value="1" @if($video->status == 1) selected @endif>Active</option>
                                            <option value="2" @if($video->status == 2) selected @endif>Inactive</option>
                                        </select> 
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Link <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="link" value="{{$video->link}}"> 
                                    </div>
                                </div>

                            </div>	
                            <button type="submit" class="btn btn-primary buttonedit1">Update</button>
                        </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:: row-2 -->

                    

                </div>
            </div>
            <!--APP-CONTENT CLOSE-->
			
			
	 

@endsection

@section('script')
    <script>
        tinymce.init({
            selector: 'textarea#description',
        });
        $(document).ready(function () {
            /** Get Sub category list on change on parent category */
            $('#category_id').on('change', function () {
                var idCategory = this.value;
                $("#sub_category_id").html('');

                $.ajax({
                    url: "{{url('admin/testimonials/fetch_subcategory')}}",
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