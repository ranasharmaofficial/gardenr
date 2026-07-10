@extends('admin.include.master')
@section('title', 'Approved Student List')
@section('content')

<style>
.table-responsive::-webkit-scrollbar {
  height: 12px;
}

.table-responsive::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 6px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
  background: #555;
}


</style>
<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Student</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Student</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Approved Student List</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->



            <!--APP-CONTENT START-->
            <div class="main-content app-content">
                <div class="container-fluid">


                   <!-- Start:: row-2 -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">
                                    Approved Student
                                </div>
								{{--<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/add-subcourse') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Add Sub Course</a>--}}
                            </div>
                            <div class="card-body">
							<div class="row mb-3">
								<div class="col-md-4">
									<input type="text" id="searchQuery" class="form-control" placeholder="Search by Name or Enrollment number">
								</div>
								<div class="col-md-4">
									<select id="filterCourse" class="form-control">
										<option value="">-- Filter by Course --</option>
										@foreach ($courses as $course)
											<option value="{{ $course->id }}">{{ $course->courseTitle }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-4">
									<button id="searchBtn" class="btn btn-primary w-100">Search</button>
								</div>
							</div>
								<div class="table-responsive">
									<table id="responsiveDataTabless" class="table table-bordered text-nowrap mt-3" style="width:100%">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col" class="text-right">Actions</th>
												<th scope="col" class="text-right">Result</th>
												<th scope="col">Enrollment Number</th>
												 <th scope="col">Roll No.</th>
												<th scope="col">Serial No.</th>
												<th scope="col">DOB</th>
												<th scope="col">English Name</th>
												<th scope="col">Franchise</th>
												<th scope="col">Course</th>
												<th scope="col">Sub Course</th>
												<th scope="col">Mobile</th>
												<th scope="col">Email</th>
												<th scope="col">Status</th>
												<th scope="col">Created At</th>
												
												 
											</tr>
										</thead>
										<tbody id="studentsTableBody">
											@include('admin.documents.student_certificate_ajax_list', ['approved_student' => $approved_student])
										</tbody>
									</table>
									<!-- Pagination Links -->
									<div id="paginationLinks">
										{!! $approved_student->links() !!}
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:: row-2 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
function loadStudents(page = 1) {
    let search = $('#searchQuery').val();
    let course = $('#filterCourse').val();
	 
    $.ajax({
        url: "{{ url('admin/generate-certificate') }}",
        type: "GET",
        data: {
            search: search,
            course_id: course,
            page: page
        },
        success: function(res) {
            $('#studentsTableBody').html(res.html);
            $('#paginationLinks').html(res.pagination);
        },
        error: function() {
            alert("Failed to load students.");
        }
    });
}

$(document).ready(function() {
    // Search/Filter
	 
    $('#searchBtn, #filterCourse').on('click change', function() {
        loadStudents();
    });

    // Handle pagination click
    $(document).on('click', '#paginationLinks a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        let page = url.split('page=')[1];
        loadStudents(page);
    });

    // Initial load
    loadStudents();
});
</script>


@endsection

