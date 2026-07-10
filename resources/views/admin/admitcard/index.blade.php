@extends('admin.include.master')
@section('title', 'Subject List')
@section('content')

<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Subject</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Subject</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Subject List</li>
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
                                    Subject
                                </div>
								<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/add-subject') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Add Subject</a>
                            </div>
                            <div class="card-body">
								@php
									//dd($data);
								@endphp
								<form method="get" class="row mb-3" action="">
									<div class="col-sm-4">
										<label for="course_id" class="col-form-label">Select Course<star>*</star></label>
										<select class="form-control" type="text" id="course_id" name="course_id" required >
											<option value="">Select Course</option>
											@foreach(\App\Models\Course::where('status', 1)->get() as $row)
												<option @if($data['course_id']==$row->id) selected @endif value="{{ $row->id }}">{{ $row->courseTitle }}</option>
											@endforeach
										</select>
									</div>
									@php
										$get_subcourse = \App\Models\SubCourse::where('course_id', $data['course_id'])->where('status', 1)->get()
									@endphp
									<div class="col-sm-4">
										<label for="subcourse_id" class="col-form-label">Select Sub Course<star>*</star></label>
										<select class="form-control" type="text" id="subcourse_id" name="subcourse_id" >
											<option value="">Select Course First</option>
											@if($get_subcourse!=null)
												@foreach($get_subcourse as $row)
													<option @if($row->id==$data['subcourse_id']) selected @endif  value="{{ $row->id }}">{{ $row->title }}</option>
												@endforeach
											@endif
										</select>
									</div>

									<div class="col-sm-4">
										<button style="margin-top:30px;" class="btn btn-primary" type="submit"> Search</button>
									</div>

								</form>

                                <table id="responsiveDataTable" class="table table-bordered text-nowrap mt-3" style="width:100%;margin-top:10px;">
                                    <thead>
                                        <tr>
											<th scope="col">#</th>
											<th scope="col">Semester</th>
											<th scope="col">Course Name</th>
											<th scope="col">Subcourse</th>
											<th scope="col">Subject</th>
											<th scope="col">Subject Code</th>
											<th scope="col">Full Marks</th>
											<th scope="col">Pass Marks</th>
											<th scope="col">Status</th>
											<th scope="col" class="text-right">Actions</th>
										</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subjectlists as $key => $value)
                                            @php
                                                $semester = \App\Models\MasterSemester::where('id', $value->semester)->pluck('semester')->first();
                                            @endphp
										<tr>
											<td>{{ $key + 1 }}</td>
											<td>{{ $semester }}</td>
											<td>{{ $value->courseTitle }}</td>
											<td>{{ $value->title }}</td>
											<td>{{ $value->name }}</td>
											<td>{{ $value->subject_code }}</td>
											<td>{{ $value->full_marks }}</td>
											<td>{{ $value->pass_marks }}</td>
											<td>
												<div class="actions"> @if($value->status == 1) <a href="#" class="btn btn-sm bg-success-light mr-2">Active</a> @else <a href="#" class="btn btn-sm bg-danger-light mr-2">Inactive</a> @endif </div>
											</td>
											<td class="text-right">
												<!-- Edit Button -->
														<button type="button"
															class="btn btn-icon btn-sm btn-info-light rounded-pill editSubjectBtn"
															data-id="{{ $value->id }}">
															<i class="ri-edit-line"></i>
														</button>

											</td>
										</tr>
										@endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:: row-2 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->


			<!-- Edit Subject Modal -->
<div class="modal fade" id="editSubjectModal" tabindex="-1" aria-labelledby="editSubjectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="editSubjectForm">
        @csrf
        <input type="hidden" id="subject_id" name="subject_id">
        <div class="modal-header">
          <h5 class="modal-title" id="editSubjectModalLabel">Edit Subject</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body row g-3">
            <div class="col-sm-6">
                <label for="semester" class="col-form-label">Select Semester<star>*</star></label>
                <select class="form-control" type="text" id="semester" name="semester" required >
                    <option value="">Select Semester</option>
                    @foreach(master_semester_list() as $val)
                        <option value="{{ $val->id }}">{{ $val->semester }}</option>
                    @endforeach
                </select>
                <small class="text-danger form-text">@error('semester') {{$message}} @enderror</small>
            </div>
          <div class="col-md-6">
            <label>Subject Name</label>
            <input type="text" class="form-control" id="subject_name" name="name" required>
          </div>
          <div class="col-md-6">
            <label>Subject Code</label>
            <input type="text" class="form-control" id="subject_code" name="subject_code" required>
          </div>
          <div class="col-md-6">
            <label>Full Marks</label>
            <input type="number" class="form-control" id="full_marks" name="full_marks" required>
          </div>
          <div class="col-md-6">
            <label>Pass Marks</label>
            <input type="number" class="form-control" id="pass_marks" name="pass_marks" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Handle edit click
    $('.editSubjectBtn').on('click', function() {
        alert('button clicked');
        let id = $(this).data('id');
        $.ajax({
            url: "{{ url('admin/admin/get-subject') }}/" + id,
            method: 'GET',
            success: function(data) {
                $('#subject_id').val(data.id);
                $('#subject_name').val(data.name);
                $('#subject_code').val(data.subject_code);
                $('#full_marks').val(data.full_marks);
                $('#pass_marks').val(data.pass_marks);

                $('#semester option[value="' + data.semester + '"]').prop('selected', true);
                $('#editSubjectModal').modal('show');
            }
        });
    });

    // Handle form submit
    $('#editSubjectForm').on('submit', function(e) {
        e.preventDefault();
        let id = $('#subject_id').val();
        let formData = $(this).serialize();

        $.ajax({
            url: "{{ url('admin/admin/update-subject') }}/" + id,
            method: 'POST',
            data: formData,
            success: function(response) {
                $('#editSubjectModal').modal('hide');
                //location.reload(); // or dynamically update the row
				Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: 'Updated Successfully!',
                    showConfirmButton: false,
                    timer: 3500
                });
				location.reload();
            },
            error: function(xhr) {
                alert("Something went wrong.");
            }
        });
    });
});

 $(document).ready(function() {
            $('#course_id').on('change', function() {
                var course = this.value;
                $("#subcourse_id").html('');
                $.ajax({
                    url: "{{ url('get-subcourse') }}",
                    type: "POST",
                    data: {
                        course: course,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#subcourse_id').html('<option value="">Select Sub Course</option>');
                        $.each(result.subcourse, function(key, value) {
                            $("#subcourse_id").append('<option value="' + value.id +
                                '">' + value.title + '</option>');
                        });
                    }
                });
            });
        });
 </script>
@endsection

