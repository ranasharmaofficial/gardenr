
	<table id="" class="table table-bordered text-nowrap mt-3" style="width:100%">
		<thead>
			<tr>
				<th>#</th>
				<th>Membership Number</th>
				<th>Vivah Mitra</th>
				<th>Member</th>
				<th>Is Used</th>
				<th>Leader</th>
				<th>Used Date</th>
				<th>Created By</th>
				<th>Created At</th>
				<th class="text-right">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($membership_list as $key => $value)
				<tr>
					<td>{{ ($membership_list->currentPage() - 1) * $membership_list->perPage() + ($key + 1) }}</td>
					<td>{{ $value->membership_number }}</td>
					<td style="color:blue;">{{ $value->vivahMitraName }}</td>
					<td style="color:green;">{{ $value->memberName }}</td>
					<td>
						@if($value->is_used==0)
							<span class="badge bg-danger">Not&nbsp;Used</span>
						@endif

						@if($value->is_used==1)
							<span class="badge bg-success">Used</span>
						@endif
					</td>
					<td>{{ $value->leaderName }}</td>
					<td> @if($value->used_date!=null) {{ date('d M, Y', strtotime($value->used_date)) }} @endif</td>
					<td>{{ $value->addedByName }}</td>
                    <td>{{ date('d M, Y', strtotime($value->created_at)) }}</td>
					<td class="text-right">
						<a class="btn btn-icon btn-sm btn-primary-light rounded-pill" href=""><i class="ri-edit-line"></i></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

		<div style="float:right;" class="mt-3 justify-content-center">
			{{ $membership_list->links() }}
		</div>
