<table id="table-data" class="table truncate m-0 align-middle">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Document</th>
			<th scope="col">Status</th>
			<th scope="col" class="text-right">Actions</th>
			<th scope="col">Name</th>
			<th scope="col">Father's Name</th>
			<th scope="col">Mobile</th>
			<th scope="col">WhatsApp</th>
			<th scope="col">DOB</th>
			<th scope="col">Address</th>
			<th scope="col">Gender</th>
			<th scope="col">Bloodgroup</th>
			<th scope="col">Email</th>
			<th scope="col">Created At</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($member_list as $key => $value)
		<tr>
			<td>{{ $key + 1 }}</td>
			<td class="truncate-cell" title="{{ $value->name }}">                <button type="button" class="btn btn-primary open-generate-modal" data-id="{{ $value->id }}" data-name="{{ $value->name }}">                    Generate                </button>            </td>
			<td>
				<div class="actions"> @if($value->status == 1) <a href="#" class="badge badge bg-success">Active</a> @else <a href="#" class="badge badge bg-danger">Inactive</a> @endif </div>
				@php														$checked = $value->status ? 'checked' : '';													@endphp
				<div class="form-check form-switch">														<input class="form-check-input toggle-status" data-id="{{ $value->id }}" {{ $checked }} type="checkbox" role="switch" id="switchCheckChecked">													</div>
			</td>
			<td class="text-right">                <a href="{{ url('admin/edit-member-details/'.$value->id) }}" class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Volunteer Details">                    <i class="ri-edit-box-line"></i>                </a>                <a href="{{ url('admin/view-member/'.$value->id) }}" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Member Details">                    <i class="ri-eye-line"></i>                </a>                {{--<a class="text-primary" href="{{ url('admin/edit-notification/'.$value->id) }}"> <i class="ri-edit-box-line"></i></a>                <a class="text-danger" onclick="return confirm('Are you sure, you want to delete this?')" href="{{route('admin.galleries.delete',$value->id)}}"><i class="fas fa-trash-alt m-r-5"></i>Delete</a>                <a onclick="return confirm('Are you sure, you want to delete this?')" href="{{ url('admin/deleteNotification/'.$value->id)}}" class="btn btn-icon btn-sm btn-danger-light rounded-pill"><i class="ri-delete-bin-line"></i></a>--}}            </td>
			<td class="truncate-cell" title="{{ $value->name }}">{{ $value->name }}</td>
			<td class="truncate-cell" title="{{ $value->fname }}">{{ $value->fname }}</td>
			<td class="truncate-cell" title="{{ $value->mobile }}">{{ $value->mobile }}</td>
			<td class="truncate-cell" title="{{ $value->wmobile }}">{{ $value->wmobile }}</td>
			<td class="truncate-cell" title="{{ $value->dob }}">{{ $value->dob }}</td>
			<td class="truncate-cell" title="{{ $value->address }}">{{ $value->address }}</td>
			<td class="truncate-cell" title="{{ $value->gender }}">{{ $value->gender }}</td>
			<td class="truncate-cell" title="{{ $value->email }}">{{ $value->email }}</td>
			<td class="truncate-cell" title="{{ $value->bgroup }}">{{ $value->bgroup}}</td>
			<td>
				<div class="actions"> @if($value->status == 1) <a href="#" class="btn btn-sm bg-success-light mr-2">Active</a> @else <a href="#" class="btn btn-sm bg-danger-light mr-2">Inactive</a> @endif </div>
			</td>
			<td>{{ date('d M Y', strtotime($value->created_at)) }}</td>
			<td class="text-right">													<a href="{{ url('admin/edit-member-details/'.$value->id) }}" class="btn btn-outline-success btn-sm"													  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Volunteer Details">													  <i class="ri-edit-box-line"></i>													</a>													<a href="{{ url('admin/view-member/'.$value->id) }}" class="btn btn-outline-info btn-sm"													  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Member Details">													  <i class="ri-eye-line"></i>													</a>																												{{--<a class="text-primary" href="{{ url('admin/edit-notification/'.$value->id) }}"> <i class="ri-edit-box-line"></i></a>														<a class="text-danger" onclick="return confirm('Are you sure, you want to delete this?')" href="{{route('admin.galleries.delete',$value->id)}}"><i class="fas fa-trash-alt m-r-5"></i>Delete</a>														<a onclick="return confirm('Are you sure, you want to delete this?')" href="{{ url('admin/deleteNotification/'.$value->id)}}" class="btn btn-icon btn-sm btn-danger-light rounded-pill"><i class="ri-delete-bin-line"></i></a>--}}													 												</td>
		</tr>
		@endforeach
	</tbody>
</table>
<div class="mt-3 mb-3">										{{ $member_list->appends(request()->all())->links() }}									</div>
{{-- Bootstrap Modal --}}
<div class="modal fade" id="generateModal" tabindex="-1" aria-labelledby="generateModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="generateForm">
				@csrf
				<div class="modal-body">
					<input type="hidden" name="member_id" id="memberId">
					<div class="mb-3">						<label>Name:</label>						<input type="text" class="form-control" style="background-color:#ccc;" id="memberName" readonly>					</div>
					<div class="mb-3">						<label>Membership Number:</label>						<input type="text" class="form-control" placeholder="Enter Membership Number" name="membership_number" id="membership_number" oninput="this.value = this.value.toUpperCase();">						</div>
					<div class="mb-3">						<label>Post:</label>						<input type="text" class="form-control" name="post" id="post" placeholder="Enter Post">						</div>
					<div class="mb-3">						<label>Duration:</label>						<input type="text" class="form-control" name="duration" id="duration" placeholder="Enter Duration">					</div>
					<div class="mb-3">						<label>Validity:</label>						<input type="date" class="form-control" name="validity" id="validity">					</div>
					<div class="mb-3">						<label>Generated Date:</label>						<input type="date" class="form-control" name="generated_date" id="generated_date">					</div>
					<div class="mb-3">
						<label>Status:</label>
						<select class="form-control" name="status" id="status">
							<option value="1">Active</option>
						</select>
					</div>
					<div class="mb-3">
						<label>Select Documents to Generate:</label>
						<div class="form-check">                            <input class="form-check-input" type="checkbox" name="documents[]" value="appointment_letter" id="appointmentLetter">                            <label class="form-check-label" for="appointmentLetter">Appointment Letter</label>                        </div>
						<div class="form-check">                            <input class="form-check-input" type="checkbox" name="documents[]" value="id_card" id="idCard">                            <label class="form-check-label" for="idCard">ID Card</label>                        </div>
						<div class="form-check">                            <input class="form-check-input" type="checkbox" name="documents[]" value="certificate" id="Certificate">                            <label class="form-check-label" for="joiningLetter">Certificate</label>                        </div>
					</div>
				</div>
				<div class="modal-footer">                    <button type="submit" class="btn btn-success">Generate Selected</button>                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                </div>
			</form>
		</div>
	</div>
</div>
