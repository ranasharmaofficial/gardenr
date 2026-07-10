@extends('admin.include.master')
@section('title', 'Update CMS Page')
@section('content')

<!-- Page Header -->
	<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
		<div>
			<h4 class="fw-medium mb-2">CMS Page</h4>
			<div class="ms-sm-1 ms-0">
				<nav>
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="javascript:void(0);">CMS Page</a></li>
						<li class="breadcrumb-item active fw-normal" aria-current="page">Page List</li>
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
						Update Page List
						<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/pages') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Page List</a>
					</div>
                    <div class="card-body booking_card">
                        <form method="post" action="{{ route('admin.pages.update',$page->id) }}" enctype="multipart/form-data">
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
                                        <label>Select Parent </label>
                                        <select class="form-control" name="parent_id" required>
                                            <option value="0">No Parent</option>
                                            @foreach($menus AS $menu)
                                                <option value="{{$menu->id}}" @if($menu->id == $page->parent_id) selected @endif>{{$menu->title}}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status </label>
                                        <select class=" form-control" name="status" required>
                                            <option value="1" @if($page->status == 1) selected @endif>Active</option>
                                            <option value="2" @if($page->status == 2) selected @endif>Inactive</option>
                                        </select> 
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title </label>
                                        <input type="text" class="form-control" name="title" value="{{$page->title}}" required> 
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Page URL <span class="text-danger"></span> </label>
                                        <input type="text" class="form-control" name="page_url" value="{{$page->page_url}}"> 
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Meta Title </label>
                                        <input type="text" class="form-control" name="meta_title" value="{{$page->meta_title}}"> 
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Meta Tag </label>
                                        <input type="text" class="form-control" name="meta_tag" value="{{$page->meta_tag}}"> 
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Meta Description </label>
                                        <textarea class="form-control" id="myeditorinstance" name="meta_description">{!! $page->meta_description !!}</textarea>
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
 

@endsection

@section('script')
    <script>
        tinymce.init({
            selector: 'textarea#description',
        });
    </script>
@endsection