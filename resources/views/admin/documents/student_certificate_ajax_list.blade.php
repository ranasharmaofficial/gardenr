
											@foreach ($approved_student as $key => $value)
											@php
												$state = \App\Models\State::where('id', $value->state)->first();
												$courseName = \App\Models\Course::where('id', $value->course_id)->pluck('courseTitle')->first();
												$SubCourseName = \App\Models\SubCourse::where('id', $value->subcourse_id)->pluck('title')->first();
												$FranchiseDetails = \App\Models\User::where('id', $value->franchise_id)->first();
											@endphp
											<tr>
												<td>{{ $key + 1 }}</td>
												<td>
													<a title="View Student Details" target="_blank" href="{{ url('admin/view-student/'.$value->id) }}" class="btn btn-icon btn-sm btn-primary-light rounded-pill"><i class="ri-eye-line"></i></a>
													<a title="Edit Student Details" target="_blank" href="{{ url('admin/edit-student-details/'.$value->id) }}" class="btn btn-icon btn-sm btn-info-light rounded-pill"><i class="ri-edit-line"></i></a>
												</td>
												<td class="text-right">
												{{--<form method="post" action="{{ route('admin.saveSubCourseCertificate') }}">
														@csrf
														<select class="form-control" required name="semester">
															<option value="">Select Semester</option>
															@foreach(master_semester_list() as $row)
																<option value="{{ $row->id }}">{{ $row->semester }}</option>
															@endforeach

														</select>
														<input type="hidden" name="student_id" value="{{ $value->id }}">
														<input type="hidden" name="course_id" value="{{ $value->course_id }}">
														<input type="hidden" name="subcourse_id" value="{{ $value->subcourse_id }}">
														<input type="hidden" name="franchise_id" value="{{ $value->franchise_id }}">
														<button type="submit" name="submit" class="btn btn-primary mt-1 btn-sm">Generate Certificate</button>
													</form>--}}
													<form method="get" target="_blank" action="{{ route('admin.addResult') }}">
														@csrf
														<select class="form-control" required name="semester">
															<option value="">Select Semester</option>
															@foreach(master_semester_list() as $row)
																<option value="{{ $row->id }}">{{ $row->semester }}</option>
															@endforeach

														</select>
														<input type="hidden" name="student_id" value="{{ $value->id }}">
														<button type="submit" class="btn btn-danger btn-sm mt-1">Add Result</button>
													</form>
												</td>
												<td>{{ $value->enrollment_number }}</td>
												<td>{{ $value->roll_number }}</td>
												<td>{{ $value->serial_number }}</td>
												<td>{{ date('d-M-Y', strtotime($value->dob)) }}</td>
												<td>{{ $value->english_name }}</td>
												<td>{{ $FranchiseDetails->first_name.' '.$FranchiseDetails->last_name }}-({{ $FranchiseDetails->partner_code }})</td>
												<td>{{ $courseName }}</td>
												<td>{{ $SubCourseName }}</td>
												<td>{{ $value->mobile }}</td>
												<td>{{ $value->email }}</td>

												<td class="">
												@if($value->status==0)
													<p class="text-danger">Pending</p>
												@elseif($value->status==1)
													<p class="text-success">Active</p>
												@else($value->status==2)
													<p class="text-danger">Reject/Block</p>
												@endif

												</td>
												<td>{{ date('d M, Y', strtotime($value->created_at)) }}</td>
												


											</tr>
											@endforeach





