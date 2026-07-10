
	<table id="" class="table table-bordered text-nowrap mt-3" style="width:100%">
		<thead>
			<tr>
				<th>#</th>
				<th>User Type</th>
				<th>User Designation</th>
				<th>Title</th>
				<th>File</th>
				<th>Created At</th>
				<th class="text-right">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($offer_list as $key => $value)
				<tr>
					<td>{{ $key + 1 }}</td>
					<td>{{ $value->userType }}</td>
					<td>{{ $value->userDesignation }}</td>
					<td>{{ $value->title }}</td>
					<td>
						<a href="{{ $value->video_url }}" target="_blank" class="btn btn-danger btn-sm">Check Video</a>
					</td>
					<td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
					<td class="text-right">
						<a class="btn btn-icon btn-sm btn-primary-light rounded-pill" href="{{ url('admin/tndcVid/edit/'.$value->id) }}"><i class="ri-edit-line"></i></a>
						<a class="btn btn-icon btn-sm btn-danger-light rounded-pill" onclick="return confirm('Are you sure, you want to delete this?')" style="" href="{{route('admin.tndcVid.delete',$value->id)}}"><i class="ri-delete-bin-3-fill"></i></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

		<div style="float:right;" class="mt-3 justify-content-center">
			{{ $offer_list->links() }}
		</div>
