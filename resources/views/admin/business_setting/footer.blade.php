@extends('admin.include.master')
@section('title', 'Website Footer')
@section('content')



<!-- Page Header -->
	<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
		<div>
			<h4 class="fw-medium mb-2">Business Setting</h4>
			<div class="ms-sm-1 ms-0">
				<nav>
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
						<li class="breadcrumb-item active fw-normal" aria-current="page">Footer</li>
					</ol>
				</nav>
			</div>
		</div>

	</div>
<!-- Page Header Close -->
	<div class="main-content app-content">

       <!--Manage Footer Logo  -->
        <div class="row mb-3">
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
            <div class="col-sm-12 w-75 mx-auto">
                <div class="card">
                    <div class="card-body booking_card">
                        <form method="post" id="update-footer-logo-form" action="{{ route('admin.websitefooter.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row formtype">

								<div class="col-md-12 mb-3">
									<div style="display:none;" id="show-footer-logo-form-error" class="alert alert-danger col-md-12">
										<ul>
											<div class="errorMsgntainer"></div>
										</ul>
									</div>
								</div>
                                <input type="hidden" class="form-control" name="type" value="footer_setup" required>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Footer Logo </strong></label>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="footer_logo">
                                            @if(fetch_business_setting_value('footer_setup', 'footer_logo') != null)
                                                <img src="{{ asset('public/'.fetch_business_setting_value('footer_setup', 'footer_logo')) }}">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Footer Description</strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="footer_description" required>
                                            <textarea class="form-control" name="values[]" row="6" col="50"> {{ fetch_business_setting_value('footer_setup', 'footer_description') }} </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Copyright Widget</strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="copyright_widget" required>
                                            <input type="text" class="form-control" name="values[]" value="{{ fetch_business_setting_value('footer_setup', 'copyright_widget') }}" pattern="+91[7-9]{1}[0-9]{9}">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary buttonedit1 update-footer-button">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manage Contact Info  -->
        <div class="row mb-3">
            <div class="col-sm-12 w-75 mx-auto">
                <div class="card">
                    <div class="card-body booking_card">
                        <form method="post" action="{{ route('admin.website.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row formtype">
                                <input type="hidden" class="form-control" name="type" value="footer_setup" required>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Contact Address</strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="contact_address" required>
                                            <textarea class="form-control" name="values[]" row="6" col="50"> {{ fetch_business_setting_value('footer_setup', 'contact_address') }} </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Contact Phone</strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="contact_phone" required>
                                            <input type="text" class="form-control" name="values[]" value="{{ fetch_business_setting_value('footer_setup', 'contact_phone') }}" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Contact Email</strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="contact_email" required>
                                            <input type="text" class="form-control" name="values[]" value="{{ fetch_business_setting_value('footer_setup', 'contact_email') }}" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Working Hours</strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="contact_working_hr" required>
                                            <textarea class="form-control" name="values[]" row="6" col="50"> {{ fetch_business_setting_value('footer_setup', 'contact_working_hr') }} </textarea>
                                        </div>
                                    </div>
                                </div>

								<div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Corporate Address</strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="corporate_address" required>
                                            <textarea class="form-control" name="values[]" row="6" col="50"> {{ fetch_business_setting_value('footer_setup', 'corporate_address') }} </textarea>
                                        </div>
                                    </div>
                                </div>

								<div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Corporate Address Phone</strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="corporate_address_phone" required>
                                            <textarea class="form-control" name="values[]" row="6" col="50"> {{ fetch_business_setting_value('footer_setup', 'corporate_address_phone') }} </textarea>
                                        </div>
                                    </div>
                                </div>

								<div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Corporate Address Email</strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="corporate_address_email" required>
                                            <textarea class="form-control" name="values[]" row="6" col="50"> {{ fetch_business_setting_value('footer_setup', 'corporate_address_email') }} </textarea>
                                        </div>
                                    </div>
                                </div>

								{{--
								<div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Registered Address</strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="registered_address" required>
                                            <textarea class="form-control" name="values[]" row="6" col="50"> {{ fetch_business_setting_value('footer_setup', 'registered_address') }} </textarea>
                                        </div>
                                    </div>
                                </div>

								<div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Registered Address Phone</strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="registered_address_phone" required>
                                            <textarea class="form-control" name="values[]" row="6" col="50"> {{ fetch_business_setting_value('footer_setup', 'registered_address_phone') }} </textarea>
                                        </div>
                                    </div>
                                </div>

								<div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Registered Address Email</strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="registered_address_email" required>
                                            <textarea class="form-control" name="values[]" row="6" col="50"> {{ fetch_business_setting_value('footer_setup', 'registered_address_email') }} </textarea>
                                        </div>
                                    </div>
                                </div>

								<div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Leads UK Address</strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="leads_uk_address" required>
                                            <textarea class="form-control" name="values[]" row="6" col="50"> {{ fetch_business_setting_value('footer_setup', 'leads_uk_address') }} </textarea>
                                        </div>
                                    </div>
                                </div>

								<div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Leads UK Phone</strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="leads_uk_address_phone" required>
                                            <textarea class="form-control" name="values[]" row="6" col="50"> {{ fetch_business_setting_value('footer_setup', 'leads_uk_address_phone') }} </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Skype Id</strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="skype" required>
                                            <textarea class="form-control" name="values[]" row="6" col="50"> {{ fetch_business_setting_value('footer_setup', 'skype') }} </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Telegram</strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="telegram" required>
                                            <textarea class="form-control" name="values[]" row="6" col="50"> {{ fetch_business_setting_value('footer_setup', 'telegram') }} </textarea>
                                        </div>
                                    </div>
                                </div>
								--}}

                                <div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>WhatsApp</strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="field_names[]" value="whatsapp" required>
                                            <textarea class="form-control" name="values[]" row="6" col="50"> {{ fetch_business_setting_value('footer_setup', 'whatsapp') }} </textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary buttonedit1">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manage Widget One  -->
        <div class="row mb-3">
            <div class="col-sm-12 w-75 mx-auto">
                <div class="card">
                    <div class="card-body booking_card">
                        <form method="post" action="{{ route('admin.website.update_widget') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row formtype align-items-end">
                                <input type="hidden" class="form-control" name="widget_type1" value="footer_widget_one_lable" required>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Widget One Name</strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="widget_lable" value="widget_one_name" required>
                                            <input type="text" class="form-control" name="widget_name" value="{{ fetch_business_setting_value('footer_widget_one_lable', 'widget_one_name') }}" >
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="widget_type2" value="footer_widget_one_links">
                                @php
                                    $widget_one_data = fetch_business_setting_data('footer_widget_one_links');
                                @endphp

                                @if($widget_one_data)
                                    @foreach(json_decode($widget_one_data->field_name) as $key=>$value)
                                        <div class="row w-100 my-2" id="row">
                                            <div class="col-md-12 d-flex mb-3">
                                                <input type="text" class="form-control mx-1" name="widget_lables[]" placeholder="Lable" value="{{$value}}">
                                                <input type="text" class="form-control mx-1" name="widget_links[]" placeholder="Link" value="{{json_decode($widget_one_data->value)[$key]}}">
                                                <div class="input-group-prepend mx-1">
                                                    <button class="btn btn-danger"
                                                        id="DeleteRow" type="button">
                                                        <i class="ri-delete-bin-fill"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                <div id="new_widget_one_input" class="w-100 mb-3"></div>

                                <div class="w-100 d-block text-start mb-3">
                                    <button style="background-color: #066c62;" id="widget_one_row_adder" type="button"
                                        class="btn btn-success">
                                        <span class="ri-add-fill"></span>
                                        Add Widget
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary buttonedit1">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manage Widget Two  -->
        <div class="row mb-3">
            <div class="col-sm-12 w-75 mx-auto">
                <div class="card">
                    <div class="card-body booking_card">
                        <form method="post" action="{{ route('admin.website.update_widget') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row formtype align-items-end">
                                <input type="hidden" class="form-control" name="widget_type1" value="footer_widget_two_lable" required>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Widget Two Name</strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="widget_lable" value="widget_two_name" required>
                                            <input type="text" class="form-control" name="widget_name" value="{{ fetch_business_setting_value('footer_widget_two_lable', 'widget_two_name') }}" >
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="widget_type2" value="footer_widget_two_links">
                                @php
                                    $widget_two_data = fetch_business_setting_data('footer_widget_two_links');
                                @endphp

                                @if($widget_two_data)
                                    @foreach(json_decode($widget_two_data->field_name) as $key=>$value)
                                        <div class="row w-100 my-2" id="row">
                                            <div class="col-md-12  mb-3 d-flex">
                                                <input type="text" class="form-control mx-1" name="widget_lables[]" placeholder="Lable" value="{{$value}}">
                                                <input type="text" class="form-control mx-1" name="widget_links[]" placeholder="Link" value="{{json_decode($widget_two_data->value)[$key]}}">
                                                <div class="input-group-prepend mx-1">
                                                    <button class="btn btn-danger"
                                                        id="DeleteRow" type="button">
                                                        <i class="ri-delete-bin-fill"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                <div id="new_widget_two_input" class="w-100 mb-3"></div>

                                <div class="w-100 d-block text-start mb-3">
                                    <button style="background-color: #066c62;" id="widget_two_row_adder" type="button"
                                        class="btn btn-success">
                                        <span class="ri-add-fill"></span>
                                        Add Widget
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary buttonedit1">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manage Widget Three  -->
        <div class="row mb-3">
            <div class="col-sm-12 w-75 mx-auto">
                <div class="card">
                    <div class="card-body booking_card">
                        <form method="post" action="{{ route('admin.website.update_widget') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row formtype align-items-end">
                                <input type="hidden" class="form-control" name="widget_type1" value="footer_widget_three_lable" required>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group d-flex align-items-center">
                                        <label class="col-md-3"><strong>Widget Three Name</strong></label>
                                        <div class="col-md-9">
                                            <input type="hidden" class="form-control" name="widget_lable" value="widget_three_name" required>
                                            <input type="text" class="form-control" name="widget_name" value="{{ fetch_business_setting_value('footer_widget_three_lable', 'widget_three_name') }}" >
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="widget_type2" value="footer_widget_three_links">
                                @php
                                    $widget_three_data = fetch_business_setting_data('footer_widget_three_links');
                                @endphp
                                @if($widget_three_data)
                                    @foreach(json_decode($widget_three_data->field_name) as $key=>$value)
                                        <div class="row w-100 my-2 mb-3" id="row">
                                            <div class="col-md-12 d-flex">
                                                <input type="text" class="form-control mx-1" name="widget_lables[]" placeholder="Lable" value="{{$value}}">
                                                <input type="text" class="form-control mx-1" name="widget_links[]" placeholder="Link" value="{{json_decode($widget_three_data->value)[$key]}}">
                                                <div class="input-group-prepend mx-1">
                                                    <button class="btn btn-danger" id="DeleteRow" type="button">
                                                        <i class="ri-delete-bin-fill"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                <div id="new_widget_three_input" class="w-100 mb-3"></div>

                                <div class="w-100 d-block text-start mb-3">
                                    <button style="background-color: #066c62;" id="widget_three_row_adder" type="button"
                                        class="btn btn-success">
                                        <span class="ri-add-fill"></span>
                                        Add Widget
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary buttonedit1">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script type="text/javascript">

/* website footer script */
	/*
	$(document).on('click', '. update-footer-button', function(e) {
        e.preventDefault();
        var clk_btn = $(". update-footer-button");
        clk_btn.prop('disabled', true).text('Updating...');

        var formData = new FormData(document.getElementById("update-footer-logo-form"));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('admin.website.update') }}",
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
                    clk_btn.prop('disabled', false).text('Login'); // Reset button text
                }
            },
            error: function(err) {
                document.getElementById('show-footer-logo-form-error').style = "display: block";
                clk_btn.prop('disabled', false).text('Update'); // Reset button text
                let error = err.responseJSON;
                $('.errorMsgntainer').html(''); // Clear previous errors
                $.each(error.errors, function(index, value) {
                    $('.errorMsgntainer').append('<span style="color:red;" class="text-danger">' + value + '<span>' + '<br>');
                });
            }
        });
    });
	*/

    function addNewRow(append_id){
        newRowAdd =
            '<div class="row my-2 w-100" id="row"><div class="col-md-12 d-flex">'+
            '<input type="text" class="form-control mx-1" name="widget_lables[]" placeholder="Lable">'+
            '<input type="text" class="form-control mx-1" name="widget_links[]" placeholder="Link">'+
            '<div class="input-group-prepend mx-1">'+
            '<button class="btn btn-danger" id="DeleteRow" type="button">'+
            '<i class="fa fa-trash"></i> </button>'+
            '</div></div></div>';

        $(append_id).append(newRowAdd);
    }

    $("#widget_one_row_adder").click(function () {
        addNewRow("#new_widget_one_input");
    });

    $("#widget_two_row_adder").click(function () {
        addNewRow("#new_widget_two_input");
    });

    $("#widget_three_row_adder").click(function () {
        addNewRow("#new_widget_three_input");
    });

    $("body").on("click", "#DeleteRow", function () {
        $(this).parents("#row").remove();
    })
	
	
	
	
	
	
</script>

@endsection
