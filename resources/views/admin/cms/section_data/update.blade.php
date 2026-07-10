@extends('admin.include.master')
@section('title', 'Update Section Data')
@section('content')

<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
		<div>
			<h4 class="fw-medium mb-2">Section Data</h4>
			<div class="ms-sm-1 ms-0">
				<nav>
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Section Data</a></li>
						<li class="breadcrumb-item active fw-normal" aria-current="page">Update Section Data</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	<div class="main-content app-content">

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
					<div class="card-header">
						Update Section Data 
						<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/section_data') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Section Data</a>
					</div>
                    <div class="card-body booking_card">
                        <form method="post" action="{{ route('admin.section_data.update',$section_data->id) }}" enctype="multipart/form-data">
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
                                        <label>Select Page <span class="text-danger">*</span> </label>
                                        <select class="form-control" name="page_id" id="page_id">
                                            <option value="">Select Page</option>
                                            @foreach($cms_pages AS $page)
                                                <option value="{{$page->id}}" @if($page->id == $section_data->page_id) selected @endif>{{$page->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Section <span class="text-danger">*</span> </label>
                                        <select class="form-control" name="section_id" id="section_id">
                                            <option value="">Select Section</option>
                                            @foreach($page_sections AS $section)
                                                <option value="{{$section->id}}" @if($section->id == $section_data->section_id) selected @endif>{{$section->section_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" name="title" value="{{$section_data->title}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description </label>
                                        <textarea class="form-control" name="description" id="description">{{$section_data->description}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image <span class="text-danger"></span></label>
                                        <input type="file" class="form-control" name="img">
                                        @if($section_data   ->img)
                                            <img src="{{static_asset($section_data->img)}}" height="100" width="100">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status </label>
                                        <select class=" form-control" name="status" required>
                                            <option value="1" @if($section_data->status == 1) selected @endif>Active</option>
                                            <option value="2" @if($section_data->status == 2) selected @endif>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Other (Link/Icon) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="other" value="{{$section_data->other}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Order Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="order_number" value="{{$section_data->order_number}}">
                                    </div>
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

@endsection

