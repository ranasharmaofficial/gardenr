@extends('admin.include.master')
@section('title', 'Update Team')
@section('content')

<!-- Page Header -->
<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h4 class="fw-medium mb-2">Team</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Team</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Update Team</li>
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
                        <form method="post" action="{{ route('admin.staffs.update', $staff->id) }}" enctype="multipart/form-data">
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

                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Type <span class="text-danger">*</span></label>
                                        <select class=" form-control" name="type">
                                            <option selected value="Team">Team</option>
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span> </label>
                                        <input type="text" placeholder="Enter Name" value="{{ $staff->first_name }}" class="form-control" name="name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile <span class="text-danger">*</span> </label>
                                        <input type="text" placeholder="Enter Mobile" value="{{ $staff->mobile }}" class="form-control" name="mobile">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span> </label>
                                        <input type="text" placeholder="Enter Email" value="{{ $staff->email }}" class="form-control" name="email">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Designtion <span class="text-danger">*</span> </label>
                                        <input type="text" placeholder="Enter Designation" value="{{ $staff->designation }}" class="form-control" name="designation">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Expertise <span class="text-danger">*</span> </label>
                                        <input type="text" value="{{ $staff->expertise }}" class="form-control" placeholder="Enter Expertise" name="expertise">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Company <span class="text-danger">*</span> </label>
                                        <input type="text" value="{{ $staff->company }}" class="form-control" placeholder="Enter Company" name="company">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Experience <span class="text-danger">*</span> </label>
                                        <input type="text" value="{{ $staff->experience }}" class="form-control" placeholder="Enter Experience" name="experience">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Profile Pic <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="profile_pic">
                                        <img class="mt-2" src="{{ static_asset($staff->profile_pic) }}" height="100" width="auto">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ $staff->state }}"  placeholder="State"  class="form-control" name="state">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ $staff->city }}" placeholder="City"  class="form-control" name="city">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pincode <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ $staff->pincode }}" placeholder="Pincode"  class="form-control" name="pincode">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ $staff->address }}" placeholder="Address"  class="form-control" name="address">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Login Username <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ $staff->username }}" placeholder="Login Username"   class="form-control" name="username">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Login Password <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ $staff->password }}" placeholder="Login Password" class="form-control" name="password">
                                    </div>
                                </div>

                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Facebook ID <span class="text-danger"></span> </label>
                                        <input type="text" placeholder="https://facebook.com/username" value="{{ old('facebook_id') }}"  class="form-control" name="facebook_id">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Twitter/X ID <span class="text-danger"></span> </label>
                                        <input type="text" placeholder="https://x.com/username" value="{{ old('twitter_id') }}" class="form-control" name="twitter_id">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Linkedin ID <span class="text-danger"></span> </label>
                                        <input type="text" placeholder="https://linkedin_id.com/username"  value="{{ old('linkedin_id') }}" class="form-control" name="linkedin_id">
                                    </div>
                                </div> --}}

                                {{-- <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Details <span class="text-danger"></span> </label>
                                        <textarea id="myeditor" type="text" class="form-control" name="details">
                                            {{ old('details') }}
                                        </textarea>
                                    </div>
                                </div> --}}

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status <span class="text-danger">*</span></label>
                                        <select class=" form-control" name="status">
                                            <option @if($staff->status=='1') selected @endif value="1" >Active</option>
                                            <option  @if($staff->status=='2') selected @endif value="2">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary buttonedit1">UPDATE</button>
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
