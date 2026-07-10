@extends('admin.include.master')
@section('title')
	{{ $page_title }}
@endsection
@section('content')

<style>
 
/* COLORS */
    .row-head > td {
        background: #fff7cc !important;   /* Golden */
    }
    .row-child > td {
        background: #d8ffd6 !important;   /* Light Green */
    }
    .row-subchild > td {
        background: #f4d9ff !important;   /* Light Purple */
    }

    .text-center { text-align:center; }
    .text-nowrap { white-space:nowrap; }
/* Center table content */
.table td, .table th {
    vertical-align: middle !important;
}

/* Input box styling */
.table input[type="number"] {
    width: 80px;
    height: 34px;
    text-align: center;
    border-radius: 6px;
}

/* Buttons */
.btn-vsm {
    padding: 3px 8px;
    font-size: 12px;
}

/* Toggle cursor */
.nav-children, .subnav-children {
    cursor: pointer;
}

/* Animation container */
.slide-row {
    overflow: hidden;
    height: 0;
    opacity: 0;
    transition: all 0.35s ease;
}

/* When visible */
.slide-row.open {
    height: auto;
    opacity: 1;
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
						<a href="{{ url('admin/navigation/add-navigation?id=0') }}" class="btn btn-primary ms-auto btn-sm">Add {{ $page_title }}</a>
					</div>
                    <div class="card-body booking_card">

					{{--<form method="GET" class="form">
                            <div class="row">

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="search" placeholder="Search" value="@isset($request){{$request->search}}@endisset">
                                </div>
                            </div>
                        </form>--}}

						<div class="advance-table" style="overflow-x: auto;">
    <table id="active_navigation_tbl" class="table table-bordered">
        <thead>
            <tr>
                <th>SNo.</th>
                <th>nav_id</th>
                <th>nav_title</th>
                <th><i class="fa fa-window-minimize"></i></th>
                <th>nav_order</th>
                <th>nav_link</th>
                <th>nav_head</th>
                <th>nav_status</th>
                <th>
                    <a href="{{ url('admin/navigation/add/0') }}" class="btn btn-info">
                        <i class="fa fa-plus"></i>
                    </a>
                </th>
            </tr>
        </thead>

        <tbody>
        @php $i = 0; @endphp

        @foreach ($menus as $nav)
            @php $i++; @endphp

            <!-- ================= LEVEL 0 ================= -->
            <tr class="row-head">
                <td>{{ $i }}</td>
                <td>{{ $nav->id }}</td>
                <td>{{ $nav->name }}</td>

                <td class="nav-children" data-child=".parent{{ $nav->id }}">
                    <i class="fa fa-arrow-up"></i>
                </td>

                <td>
                    <input type="number" value="{{ $nav->sort_order }}"
                           name="sort_order[{{ $nav->id }}]"
                           class="form-control text-center">
                </td>

                <td>{{ $nav->route }}</td>
                <td class="text-center">{{ $nav->parent_id }}</td>

                <td>
                    <button class="btn btn-info btn-sm">{{ $nav->status ? 'Active' : 'Inactive' }}</button>
                </td>

                <td class="text-nowrap">
                    <a href="javascript:void(0);" 
					data-id="{{ $nav->id }}"
					data-icon="{{ $nav->icon }}"
					data-name="{{ $nav->name }}"
					data-sort_order="{{ $nav->sort_order }}"
					data-route="{{ $nav->route }}"
					data-parent_id="{{ $nav->parent_id }}"
					data-status="{{ $nav->status }}"
					class="btn btn-icon btn-sm btn-danger-light rounded-pill editNavigationBtn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Navigation"><i class="ri-edit-line"></i></a>

                    <a href="{{ url('admin/navigation/add-navigation?id='.$nav->id) }}"
                       class="btn btn-info">
                       <i class="fa fa-plus"></i>
                    </a>
                </td>
            </tr>

            <!-- ================= LEVEL 1 ================= -->
            @foreach ($nav->children as $subnav)
                @php $i++; @endphp

                <tr class="row-child parent{{ $nav->id }}" style="display:none;">

                    <td>{{ $i }}</td>
                    <td>{{ $subnav->id }}</td>
                    <td>— {{ $subnav->name }}</td>

                    <td @if($subnav->children->count() > 0)
                        class="subnav-children"
                        data-child=".parent{{ $subnav->id }}"
                        @endif>
                        <i class="{{ $subnav->children->count() ? 'fa fa-arrow-down' : 'fa fa-window-minimize' }}"></i>
                    </td>

                    <td>
                        <input type="number" value="{{ $subnav->sort_order }}"
                               name="sort_order[{{ $subnav->id }}]"
                               class="form-control text-center">
                    </td>

                    <td>{{ $subnav->route }}</td>
                    <td class="text-center">{{ $subnav->parent_id }}</td>

                    <td>
                        <button class="btn btn-info btn-sm">{{ $subnav->status ? 'Active' : 'Inactive' }}</button>
                    </td>

                    <td class="text-nowrap">
                        <a href="javascript:void(0);" 
							data-id="{{ $subnav->id }}"
							data-icon="{{ $subnav->icon }}"
							data-name="{{ $subnav->name }}"
							data-sort_order="{{ $subnav->sort_order }}"
							data-route="{{ $subnav->route }}"
							data-parent_id="{{ $subnav->parent_id }}"
							data-status="{{ $subnav->status }}"
							class="btn btn-icon btn-sm btn-danger-light rounded-pill editNavigationBtn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Navigation"><i class="ri-edit-line"></i></a>

                        <a href="{{ url('admin/navigation/add-navigation?id='.$subnav->id) }}"
                           class="btn btn-info">
                           <i class="fa fa-plus"></i>
                        </a>
						
                    </td>
                </tr>

                <!-- ================= LEVEL 2 ================= -->
                @foreach ($subnav->children as $menu)
                    @php $i++; @endphp

                    <tr class="row-subchild parent{{ $nav->id }} parent{{ $subnav->id }}" style="display:none;">
                        <td>{{ $i }}</td>
                        <td>{{ $menu->id }}</td>
                        <td>—— {{ $menu->name }}</td>

                        <td><i class="fa fa-window-minimize"></i></td>

                        <td>
                            <input type="number" value="{{ $menu->sort_order }}"
                                   name="sort_order[{{ $menu->id }}]"
                                   class="form-control text-center">
                        </td>

                        <td>{{ $menu->route }}</td>
                        <td class="text-center">{{ $menu->parent_id }}</td>

                        <td>
                            <button class="btn btn-info btn-sm">{{ $menu->status ? 'Active' : 'Inactive' }}</button>
                        </td>

                        <td class="text-nowrap">
                            <button class="btn btn-success edit-navigation"
                                    data-value="{{ $menu->id }}">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </td>
                    </tr>

                @endforeach
            @endforeach
        @endforeach

        </tbody>
    </table>
</div>






						 <div class="pagination">

                            </div>



                    </div>
                </div>
            </div>
        </div>
		</div>


<div class="modal fade" id="editNavigationModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form method="POST" id="update-navigation-form" action="">
            @csrf
            <input type="hidden" name="id" id="edit_id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Navigation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    
                            <div class="row formtype">

                                <div class="col-md-12 mb-3">
									<div style="display:none;" id="show-navigation-form-error" class="alert alert-danger col-md-12">
										<ul>
											<div class="errorMsgntainer"></div>
										</ul>
									</div>
								</div>
								
								<div class="col-md-12 mb-3">
									<div style="display:none;" id="show-form-error" class="alert alert-danger col-md-12">
										<ul>
											<div class="errorMsgntainer"></div>
										</ul>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
										  <label>Navigation Title<span class="text-danger">*</span></label>
										  <input type="text" name="name" id="edit_name" class="form-control" placeholder="Navigation Title" required="" autofocus="true">
										</div>  
									</div>

									<div class="col-md-4">
										<div class="form-group">
										  <label>Navigation Icon</label>
										  <input type="text" name="icon" id="edit_icon" class="form-control" placeholder="Navigation Icon">
										</div>  
									</div>

									<div class="col-md-4">
										<div class="form-group">
										  <label>Navigation Order</label>
										  <input type="number" name="sort_order" id="edit_sort_order" class="form-control" placeholder="Navigation Order" min="0" value="0">
										</div>  
									</div>

								</div> 
								<div class="row">

									<div class="col-md-4">
										<div class="form-group">
										  <label>Head</label>
											<select name="parent_id" id="edit_parent_id" class="form-control">
												<option value="0">Own</option>
												@foreach(\App\Models\Menu::where('parent_id', 0)->get() as $nhead)
													<option value="{{ $nhead->id }}">{{ $nhead->name }}</option>
												@endforeach
											</select>
										</div>  
									</div>

									<div class="col-md-4">
									  <div class="form-group">
										  <label>Status</label>
										  <select name="status" id="edit_status" class="form-control" title="Select Status">
											 <option value="1">Active</option>
											 <option value="0">In-Active</option>
										  </select>
									  </div>  
									</div>

								</div> 
								<div class="row">

									<div class="col-md-6">
									  <div class="form-group">
										  <label>Link (Route)</label>
										  <input name="route"  id="edit_route" class="form-control" placeholder="Link" />
									  </div>  
									</div>
									 
								</div>

							</div>
                            <!-- Card acrions starts -->
							{{--<div class="d-flex gap-2 justify-content-end mt-4">
							  <button type="submit" id="btn-add-navigation" class="btn btn-primary buttonedit1 add-button">Add</button>
							</div>--}}
                        
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="btn-edit-navigation" class="btn btn-success update-button">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
	$(document).on('click', '.editNavigationBtn', function () {

		$('#edit_id').val($(this).data('id'));
		$('#edit_name').val($(this).data('name'));
		$('#edit_icon').val($(this).data('icon'));
		$('#edit_sort_order').val($(this).data('sort_order'));
		$('#edit_route').val($(this).data('route'));

		let parentId = $(this).data('parent_id');
		$('#edit_parent_id').val(parentId); // 0 selects Own automatically

		$('#status').val($(this).data('status'));
		$('#editNavigationModal').modal('show');
	});
	
	$(document).on('click', '#btn-edit-navigation', function(e) {
        e.preventDefault();
        var clk_btn = $("#btn-edit-navigation");
        clk_btn.prop('disabled', true).text('Updating...');

        var formData = new FormData(document.getElementById("update-navigation-form"));
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('admin.navigation.updateNavigationDetails') }}",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function(data) {
                if (data.status == true) {
                   Swal.fire({
						icon: "success",
						title: "Success",
						text: data.message,
						timer: 1500,
						showConfirmButton: false
					});
                    location.reload();
                    
                } else {
                     Swal.fire({
						icon: "error",
						title: "Oh! No",
						text: data.message,
						timer: 1500,
						showConfirmButton: false
					});
                    clk_btn.prop('disabled', false).text('Update'); // Reset button text
                }
            },
            error: function(err) {
                document.getElementById('show-navigation-form-error').style = "display: block";
                clk_btn.prop('disabled', false).text('Update'); // Reset button text
                let error = err.responseJSON;
                $('.errorMsgntainer').html(''); // Clear previous errors
                $.each(error.errors, function(index, value) {
                    $('.errorMsgntainer').append('<span style="color:red;" class="text-danger">' + value + '<span>' + '<br>');
                });
            }
        });
    });
	
	
</script>


  <script>
 

document.addEventListener("DOMContentLoaded", function () {

    // LEVEL 0 toggle
    document.querySelectorAll(".nav-children").forEach(btn => {
        btn.addEventListener("click", function () {
            let target = document.querySelectorAll(this.dataset.child);
            target.forEach(row => row.style.display =
                row.style.display === "none" ? "" : "none"
            );
        });
    });

    // LEVEL 1 toggle
    document.querySelectorAll(".subnav-children").forEach(btn => {
        btn.addEventListener("click", function () {
            let target = document.querySelectorAll(this.dataset.child);
            target.forEach(row => row.style.display =
                row.style.display === "none" ? "" : "none"
            );
        });
    });

});
</script>
@endsection

