
	<table id="" class="table table-bordered text-nowrap mt-3" style="width:100%">
		<thead>
			<tr>
				<th>#</th>
				<th>User Type</th>
				<th>User Designation</th>
				<th>Category</th>
				<th>Subcategory</th>
				<th>Video Type</th>
				<th>Video Title</th>
				<th>Video Url</th>
				<th>Created At</th>
				<th class="text-right">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($video_list as $key => $value)
				@php
					$category_name = \App\Models\MVideoCategory::where('id', $value->category_id)->pluck('name')->first();
					$sub_category_name = \App\Models\MVideoCategory::where('id', $value->sub_category_id)->pluck('name')->first();
				@endphp
				<tr>
					<td>{{ ($video_list->currentPage() - 1) * $video_list->perPage() + ($key + 1) }}</td>
					<td>{{ $value->userType }}</td>
					<td>{{ $value->userDesignation }}</td>
					<td>{{ $category_name ?? '-' }}</td>
					<td>{{ $sub_category_name ?? '-' }}</td>
					<td>{{ $value->video_type }}</td>
					<td>{{ $value->video_title }}</td>
					<td><a target="_blank" class="btn btn-primary btn-sm" href="{{ $value->video_url }}">View</a></td>

					<td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
					<td class="text-right">
						<a class="btn btn-icon btn-sm btn-primary-light rounded-pill" href="{{ url('admin/videoList/edit/'.$value->id) }}"><i class="ri-edit-line"></i></a>
                        <a class="btn btn-icon btn-sm btn-danger-light rounded-pill" onclick="return confirm('Are you sure, you want to delete this?')" href="{{route('admin.mvideo.deleteMasterVideo',$value->id)}}"><i class="ri-delete-bin-line"></i></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

		<div style="float:right;" class="mt-3 justify-content-center">
			{{ $video_list->links() }}
		</div>
