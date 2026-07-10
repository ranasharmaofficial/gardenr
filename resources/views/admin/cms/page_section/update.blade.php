@extends('admin.include.master')
@section('title', 'Update Page Section')
@section('content')

<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
		<div>
			<h4 class="fw-medium mb-2">CMS Page</h4>
			<div class="ms-sm-1 ms-0">
				<nav>
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Page section</a></li>
						<li class="breadcrumb-item active fw-normal" aria-current="page">Update Page Section</li>
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
						Update Page Section List
						<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/page_sections') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Page Section</a>
					</div>
                    <div class="card-body booking_card">
                        <form method="post" action="{{ route('admin.page_sections.update',$page_section->id) }}" enctype="multipart/form-data">
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
                                        <label>Select Parent <span class="text-danger">*</span> </label>
                                        <select class="form-control" name="page_id">
                                            <option value="0">No Parent</option>
                                            @foreach($cms_pages AS $page)
                                                <option value="{{$page->id}}" @if($page->id == $page_section->page_id) selected @endif>{{$page->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section Name </label>
                                        <input type="text" readonly class="form-control" name="section_name" value="{{$page_section->section_name}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title in primary color <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" name="title" value="{{$page_section->title}}">
                                    </div>
                                </div>
								
								<div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title in green color <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" name="title_green" value="{{$page_section->title_green}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description </label>
                                        <textarea class="form-control" name="description" id="description">{{$page_section->description}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image <span class="text-danger"></span></label>
                                        <input type="file" class="form-control" name="image">
                                        @if($page_section->image)
                                            <img src="{{ static_asset($page_section->image)}}" height="100" width="100">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status </label>
                                        <select class=" form-control" name="status" required>
                                            <option value="1" @if($page_section->status == 1) selected @endif>Active</option>
                                            <option value="2" @if($page_section->status == 2) selected @endif>Inactive</option>
                                        </select>
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

