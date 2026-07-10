@extends('admin.include.master')
@section('title', 'Terms & Conditions')

@section('content')

<div style="background:linear-gradient(45deg, #f33057, rgb(56, 88, 249));"
     class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">

    <div>
        <h4 class="fw-medium mb-2">Terms & Conditions</h4>
        <div class="ms-sm-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">CMS Management</a></li>
                    <li class="breadcrumb-item active fw-normal" aria-current="page">Terms & Conditions</li>
                </ol>
            </nav>
        </div>
    </div>

    <a href="{{ route('admin.terms.create') }}" class="btn btn-light btn-sm">
        + Add Terms
    </a>
</div>

<div class="main-content app-content">
    <div class="container-fluid">

        <div class="card custom-card mt-3">

            <div class="card-header">
                <h5 class="mb-0">Terms & Conditions List</h5>
            </div>

            <div class="card-body">

                @if(session('success'))
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: "{{ session('success') }}",
                                timer: 1500,
                                showConfirmButton: false
                            });
                        });
                    </script>
                @endif

                <form method="GET" action="{{ route('admin.terms.index') }}">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Search</label>
                            <input type="text" name="search" value="{{ request('search') }}"
                                   class="form-control" placeholder="Search title / type">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="">All</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-5 d-flex align-items-end gap-2">
                            <button class="btn btn-danger">Search</button>
                            <a href="{{ route('admin.terms.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($terms as $key => $item)
                            <tr>
                                <td>{{ $terms->firstItem() + $key }}</td>
                                <td>{{ $item->title }}</td>
                                <td><span class="badge bg-info text-dark">{{ $item->type }}</span></td>
                                <td>
                                    @if($item->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    <a href="{{ route('admin.terms.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                    <form action="{{ route('admin.terms.delete', $item->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                                >
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No Terms Found</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>

                {{ $terms->appends(request()->query())->links() }}

            </div>
        </div>
    </div>
</div>

@endsection
