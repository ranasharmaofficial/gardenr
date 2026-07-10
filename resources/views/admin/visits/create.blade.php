@extends('admin.include.master')
@section('title', 'Add Visit to Doctor')
@section('content')

<!-- Page Header -->
<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h4 class="fw-medium mb-2">Visit to Doctor</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Visit to Doctor</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Add Visit to Doctor</li>
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
                    <div class="card-body booking_card">
                        <form method="post" action="{{ route('admin.visits.store') }}" enctype="multipart/form-data">
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

                                {{--
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Doctor <span class="text-danger">*</span></label>
                                        <select class=" form-control" name="type">
                                            <option selected value="Team">Team</option>
                                        </select>
                                    </div>
                                </div>--}}

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Doctor Name <span class="text-danger">*</span> </label>
                                        <input type="text" placeholder="Enter Doctor Name" value="{{ old('name') }}" class="form-control" name="name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile </label>
                                        <input type="text" placeholder="Enter Mobile" value="{{ old('mobile') }}" class="form-control" name="mobile">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email </label>
                                        <input type="text" placeholder="Enter Email" value="{{ old('email') }}" class="form-control" name="email">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Expertise <span class="text-danger">*</span> </label>
                                        <input type="text" value="{{ old('expertise') }}" class="form-control" placeholder="Enter Expertise" name="expertise">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Experience <span class="text-danger">*</span> </label>
                                        <input type="text" value="{{ old('experience') }}" class="form-control" placeholder="Enter Experience" name="experience">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('state') }}"  placeholder="State"  class="form-control" name="state">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('city') }}" placeholder="City"  class="form-control" name="city">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pincode <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('pincode') }}" placeholder="Pincode"  class="form-control" name="pincode">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('address') }}" placeholder="Address"  class="form-control" name="address">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Visit Date <span class="text-danger">*</span></label>
                                        <input type="date" value="{{ date('Y-m-d') }}" placeholder="Login Username"   class="form-control" name="visit_date">
                                    </div>
                                </div>
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Remarks <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('remarks') }}"  class="form-control" name="remarks">
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Picture <span class="text-danger">*</span></label>
                                        <input type="file"  class="form-control" name="picture">
                                    </div>
                                </div>
								
								<div class="col-md-12">
                                    <div class="form-group">
										<button type="submit" class="btn btn-primary buttonedit1">Add</button>
									</div>
								</div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea#answer',
        });

    </script>
@endsection
