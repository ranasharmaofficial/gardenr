@extends('admin.include.master')
@section('title', 'Add New Page Scetion')
@section('content')

<!-- Page Header -->
	<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
		<div>
			<h4 class="fw-medium mb-2">CMS Page</h4>
			<div class="ms-sm-1 ms-0">
				<nav>
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Page section</a></li>
						<li class="breadcrumb-item active fw-normal" aria-current="page">Page Section List</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>

	<div class="main-content app-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body booking_card">
                        <form method="post" action="{{ route('admin.page_sections.store') }}" enctype="multipart/form-data">
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
                                        <select class="form-control" name="page_id">
                                            <option value="0">No Parent</option>
                                            @foreach($cms_pages AS $menu)
                                                <option value="{{$menu->id}}">{{$menu->title}}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section Name </label>
                                        <select class="form-control" name="section_name" class="form-control">
											<option value="section_1">Section One</option>
											<option value="section_2">Section Two</option>
											<option value="section_3">Section Three</option>
											<option value="section_4">Section Four</option>
											<option value="section_5">Section Five</option>
											<option value="section_6">Section Six</option>
											<option value="section_7">Section Seven</option>
											<option value="section_8">Section Eight</option>
											<option value="section_9">Section Nine</option>
											<option value="section_10">Section Ten</option>
										</select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title in primary color<span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" name="title"> 
                                    </div>
                                </div>
								
								<div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title in green color <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" name="title_green"> 
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description </label>
                                        <textarea class="form-control" name="description" id="description"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image <span class="text-danger"></span></label>
                                        <input type="file" class="form-control" name="image">
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
 

@endsection

