@extends('admin.include.master')
@section('title', 'Add Terms')

@section('content')

    <div style="background:linear-gradient(45deg, #f33057, rgb(56, 88, 249));"
        class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">

        <div>
            <h4 class="fw-medium mb-2">Add Terms</h4>
            <div class="ms-sm-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">CMS Management</a></li>
                        <li class="breadcrumb-item active fw-normal" aria-current="page">Add Terms</li>
                    </ol>
                </nav>
            </div>
        </div>

        <a href="{{ route('admin.terms.index') }}" class="btn btn-light btn-sm">Back</a>
    </div>

    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="card custom-card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Add Terms & Conditions</h5>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.terms.store') }}" method="POST">
                        @csrf

                        <div class="row">
                           
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                                @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Type <span class="text-danger">*</span></label>
                                <select id="notice_type" name="type" required class="form-control">
                                    <option value="">---Select Type---</option>
                                    <option value="Employee">Employee</option>
                                    <option value="Vivah Mitra">Vivah Mitra</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Content</label>
                                <textarea name="content" rows="6" class="form-control">{{ old('content') }}</textarea>
                            </div>


                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="col-md-12 d-flex gap-2 mt-2">
                                <button class="btn btn-danger">Save</button>
                                <a href="{{ route('admin.terms.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection