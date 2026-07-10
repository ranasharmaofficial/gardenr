@extends('admin.include.master')
@section('title')
	{{ $page_title }}
@endsection
@section('content')

<style>
tr.head-row > td { background:#fff9c4 !important; }
tr.menu-row > td { background:#fde2e4 !important; }
tr.submenu-row > td { background:#f0fff0 !important; }

.toggle-btn {
    border:none;
    background:none;
    cursor:pointer;
    font-size:18px;
}
</style>

<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">{{ $page_title }}</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a class="" href="javascript:void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item  active fw-normal" aria-current="page">{{ $page_title }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->



            <!--APP-CONTENT START-->
            <div class="main-content app-content">
			<div class="row gx-3">
            <div class="col-md-12">
                <div class="card card-table">
					<div class="card-header d-flex align-items-center justify-content-between">
						<h5 class="card-title">{{ $page_title }} List</h5>
						<a href="{{ url('admin/navigations/create') }}" class="btn btn-primary ms-auto btn-sm">Add {{ $page_title }}</a>
					</div>
                    <div class="card-body booking_card">

					{{--<form method="GET" class="form">
                            <div class="row">
                                 
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="search" placeholder="Search" value="@isset($request){{$request->search}}@endisset">
                                </div>
                            </div>
                        </form>--}}
						
						 
						
						 
						
						<table class="table table-bordered">
    <thead>
        <tr>
            <th></th>
            <th>S.NO</th>
            <th>ID</th>
            <th>NAME</th>
            <th>ORDER</th>
            <th>ROUTE</th>
            <th>PARENT</th>
            <th>STATUS</th>
            <th>ACTION</th>
        </tr>
    </thead>

    <tbody id="accordion">
        @php $i = 1; @endphp
        @foreach($menus as $head)

        <!-- HEAD ROW -->
        <tr class="head-row" data-bs-toggle="collapse" data-bs-target="#group{{ $head->id }}" aria-expanded="false" style="cursor:pointer;">
            <td class="arrow">▶</td>
            <td>{{ $i++ }}</td>
            <td>{{ $head->id }}</td>
            <td><strong>{{ $head->name }}</strong></td>
            <td>{{ $head->sort_order }}</td>
            <td>{{ $head->route }}</td>
            <td>{{ $head->parent_id }}</td>
            <td><span class="badge bg-success">Active</span></td>
            <td><a class="btn btn-primary btn-sm">Edit</a></td>
        </tr>

        <!-- CHILDREN AS REAL <tr> -->
        <tr class="collapse menu-row" id="group{{ $head->id }}" data-bs-parent="#accordion">
            <td colspan="10" style="padding:0 !important;">
                <table class="table mb-0">
                    @foreach($head->children as $child)
                    <tr class="menu-row">
                        <td></td>
                        <td>{{ $i++ }}</td>
                        <td>{{ $child->id }}</td>
                        <td>— {{ $child->name }}</td>
                        <td>{{ $child->sort_order }}</td>
                        <td>{{ $child->route }}</td>
                        <td>{{ $child->parent_id }}</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td><a class="btn btn-primary btn-sm">Edit</a></td>
                    </tr>
                        @foreach($child->children as $sub)
                        <tr class="submenu-row">
                            <td></td>
                            <td>{{ $i++ }}</td>
                            <td>{{ $sub->id }}</td>
                            <td>—— {{ $sub->name }}</td>
                            <td>{{ $sub->sort_order }}</td>
                            <td>{{ $sub->route }}</td>
                            <td>{{ $sub->parent_id }}</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td><a class="btn btn-primary btn-sm">Edit</a></td>
                        </tr>
                        @endforeach
                    @endforeach
                </table>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>
						
						 <div class="pagination">
                                
                            </div>
						 
                        

                    </div>
                </div>
            </div>
        </div>
		</div>

  <script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".head-row").forEach(row => {
        row.addEventListener("click", function() {
            let arrow = this.querySelector(".arrow");
            let isOpen = this.getAttribute("aria-expanded") === "true";
            arrow.textContent = isOpen ? "▶" : "▼";
        });
    });
});
</script>
@endsection

