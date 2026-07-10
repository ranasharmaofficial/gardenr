@extends('admin.include.master')
@section('title', 'Add New CMS Page')
@section('content')

<!-- Page Header -->
	<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
		<div>
			<h4 class="fw-medium mb-2">CMS Page</h4>
			<div class="ms-sm-1 ms-0">
				<nav>
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="javascript:void(0);">CMS Page</a></li>
						<li class="breadcrumb-item active fw-normal" aria-current="page">Add CMS Page</li>
					</ol>
				</nav>
			</div>
		</div>

	</div>
<!-- Page Header Close -->
	<div class="main-content app-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
					<div class="card-header">
						<div class="card-title">
							Add Page
						</div>
						<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/pages') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Page List</a>
					</div>
                    <div class="card-body booking_card">
                        <form method="post" action="{{ route('admin.pages.store') }}" enctype="multipart/form-data">
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
                                        <label>Select Parent <span class="text-danger">*</span> </label>
                                        <select class="form-control" name="parent_id">
                                            <option value="0">No Parent</option>
                                            @foreach($categories AS $menu)
                                                <option value="{{$menu->id}}">{{$menu->title}}</option>
                                            @endforeach
                                        </select>
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

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" name="title">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="title" class="col-form-label">Page URL <star>*</star></label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon3">{{ url('') }}/</span>
                                      </div>
                                        <input type="text" name="page_url" class="form-control" placeholder="slug" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Meta Title </label>
                                        <input type="text" class="form-control" name="meta_title">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Meta Tag </label>
                                        <input type="text" class="form-control" name="meta_tag">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Meta Description </label>
                                        <textarea class="form-control" name="meta_description" rows="5"></textarea>
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
 

@endsection

@section('script')
    <script>
        tinymce.init({
            selector: 'textarea#description',
        });

    </script>
@endsection
