@extends('admin.include.master')
@section('title', 'Add New FAQ')
@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-2">
                        <h4 class="card-title float-left mt-2">Add New FAQ</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body booking_card">
                        <form method="post" action="{{ route('admin.faqs.store') }}" enctype="multipart/form-data">
                            @csrf
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
                                        <label>Select Type <span class="text-danger">*</span> </label>
                                        <select class="form-control" name="faq_type" id="faq_type">
                                            <option value="">Select Type</option>
											<option value="1">Product</option>
                                            <option value="2">Service</option>
                                            <option value="0">Common</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Faq Categry <span class="text-danger">*</span> </label>
                                        <select class="form-control" name="faq_category" id="faq_category">
                                            <option value="">Select Faq Categry</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Question <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" name="question"> 
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Answer <span class="text-danger">*</span></label>
                                        <textarea id="answer" class="form-control" name="answer"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status <span class="text-danger">*</span></label>
                                        <select class=" form-control" name="status">
                                            <option value="1" selected>Active</option>
                                            <option value="2">Inactive</option>
                                        </select> 
                                    </div>
                                </div>

                            </div>	
                            <button type="submit" class="btn btn-primary buttonedit1">Add</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        // tinymce.init({
        //     selector: 'textarea#answer',
        // });
		
		$(document).ready(function () {
            /** Get Sub category list on change on parent category */
            $('#faq_type').on('change', function () {
                var idPage = this.value;
				// alert(idPage);
                $("#faq_category").html('');
                $.ajax({
                    url: "{{ route('admin.fetch_faq_category')}}",
                    type: "POST",
                    data: {
                        faq_type: idPage,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',

                    success: function (result) {
						console.log(result);
                        $('#faq_category').html('<option value="">Choose Section</option>');
                        $.each(result.categories, function (key, value) {
                            $("#faq_category").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
        
    </script>
@endsection
