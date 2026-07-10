@extends('admin.include.master')
@section('title', 'Add New Category')
@section('content')
<!-- Page Header -->
	<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
		<div>
			<h4 class="fw-medium mb-2">Setup</h4>
			<div class="ms-sm-1 ms-0">
				<nav>
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Setup</a></li>
						<li class="breadcrumb-item active fw-normal" aria-current="page">Category List</li>
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
                <div class="card custom-card">
				<div class="card-header">
						<div class="card-title">
							Add New Category
						</div>
						<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/categories') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Category List</a>
					</div>
                    <div class="card-body booking_card">
                        <form method="post" action="{{ route('admin.categories.store') }}">
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

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Category Name <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" name="title" required> 
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Type <span class="text-danger">*</span> </label>
                                        <select class="form-control" name="type" id="type">
                                            <option value="">Select Type</option>
                                            <option value="blog">Blog</option>
                                            <!--<option value="news">News</option>
                                            <option value="event">Event</option>
                                            <option value="case_study">Case Study</option>-->
                                        </select> 
                                    </div>
                                </div>
                    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status <span class="text-danger">*</span> </label>
                                        <select class=" form-control" id="status" name="status" required>
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
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
