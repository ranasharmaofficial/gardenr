
	<table id="" class="table table-bordered text-nowrap mt-3" style="width:100%">
		<thead>
			<tr>
				<th>#</th>
				<th>User Type</th>
				<th>User Designation</th>
				<th>Target Type</th>
				<th>Target</th>
				<th>Target Value</th>
				<th>Created At</th>
				<th class="text-right">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($target_list as $key => $value)
				<tr>
					<td>{{ $key + 1 }}</td>
					<td>{{ $value->userType }}</td>
					<td>{{ $value->userDesignation }}</td>
					<td>
						@if($value->target_type=='yearly_target')
							<span class="badge bg-primary">Yearly Target</span>
						@elseif($value->target_type=='monthly_target')
							<span class="badge bg-primary">Monthly Target</span>
						@elseif($value->target_type=='10_days_target')
							<span class="badge bg-primary">10 Days Target</span>
						@elseif($value->target_type=='per_day_target')
							<span class="badge bg-primary">Per Day Target</span>
						@endif
					</td>
					<td>{{ $value->target }}</td>
					<td>{{ $value->target_value }}</td>

					<td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
					<td class="text-right">
						<a class="btn btn-icon btn-sm btn-primary-light rounded-pill" href="{{ url('admin/employeetargetList/edit/'.$value->id) }}"><i class="ri-edit-line"></i></a>
						<a onclick="return confirm('Are you sure, you want to delete this?')" href="{{ route('admin.emp_target.destroy', $value->id) }}" class="btn btn-icon btn-sm btn-danger-light rounded-pill"><i class="ri-delete-bin-line"></i></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

		<div style="float:right;" class="mt-3 justify-content-center">
			{{ $target_list->links() }}
		</div>
