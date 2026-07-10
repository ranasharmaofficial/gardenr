
	<table id="" class="table table-bordered text-nowrap mt-3" style="width:100%">
		<thead>
			<tr>
				<th>#</th>
				<th>Title</th>
				<th>Percentage</th>
				<th>Created At</th>
				<th class="text-right">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($master_investor as $key => $value)
				<tr>
					<td>{{ $key + 1 }}</td>
					<td>{{ $value->title }}</td>
					<td>{{ $value->percentage }}</td>

					<td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
					<td class="text-right">
						<a class="btn btn-icon btn-sm btn-primary-light rounded-pill" onclick="editBranch({{ $value->id }})"  href="javascript:void(0);"><i class="ri-edit-line"></i></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

		<div style="float:right;" class="mt-3 justify-content-center">
			{{ $master_investor->links() }}
		</div>
