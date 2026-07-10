@extends('admin.include.master')
@section('title', 'Update Category')
@section('content')
<!-- Page Header -->
	<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
		<div>
			<h4 class="fw-medium mb-2">Setup</h4>
			<div class="ms-sm-1 ms-0">
				<nav>
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Setup</a></li>
						<li class="breadcrumb-item active fw-normal" aria-current="page">Update Category</li>
					</ol>
				</nav>
			</div>
		</div>

	</div>
<!-- Page Header Close -->
<div class="main-content app-content">
    <div class="content container-fluid">
         

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body booking_card">
                        <form method="POST" action="{{ route('admin.categories.update',$category->id) }}">
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

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Category Name </label>
                                        <input type="text" class="form-control" name="title" value="{{$category->title}}" required>  
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Type </label>
                                        <select class="form-control" name="type" id="type">
                                            <option value="">Select Type</option>
                                            <option value="blog" @if($category->type == "blog") selected @endif>Blog</option>
                                            <option value="news" @if($category->type == "news") selected @endif>News</option>
                                            <option value="event" @if($category->type == "event") selected @endif>Event</option>
                                            <option value="case_study" @if($category->type == "case_study") selected @endif>Case Study</option>
                                        </select> 
                                    </div>
                                </div>
                    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status </label>
                                        <select class=" form-control" id="status" name="status" required>
                                            <option value="1" @if($category->status == 1) selected @endif>Active</option>
                                            <option value="0" @if($category->status == 0) selected @endif>Inactive</option>
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
