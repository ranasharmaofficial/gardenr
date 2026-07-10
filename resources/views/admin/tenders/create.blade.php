@extends('admin.include.master')
@section('title', 'Add Tender')
@section('content')

<!-- Page Header -->
<div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
    <div>
        <h4 class="fw-medium mb-2">Tender</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Tender</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Add Tender</li>
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
                        <form method="post" action="{{ route('admin.tenders.store') }}" enctype="multipart/form-data">
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
                                        <label>Title <span class="text-danger">*</span> </label>
                                        <input type="text" placeholder="Enter Title" value="{{ old('title') }}" class="form-control" name="title">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Details </label>
                                        <input type="text" placeholder="Enter Details" value="{{ old('details') }}" class="form-control" name="details">
                                    </div>
                                </div>

                                 
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>File <span class="text-danger">*</span></label>
                                        <input type="file"  class="form-control" name="file">
                                    </div>
                                </div>
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date <span class="text-danger">*</span></label>
                                        <input type="date"  class="form-control" name="uploaddate">
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
