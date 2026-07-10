
	<table id="" class="table table-bordered text-nowrap mt-3" style="width:100%">
		<thead>
			<tr>
				<th>#</th>
				<th>Investor Photo</th>
				<th>Investor Agreement</th>
				<th>Investor Name</th>
				<th>Shop</th>
				<th>Opening Date</th>
				<th>Shop Status</th>
				<th>Created At</th>
				<th class="text-right">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($shop_list as $key => $value)
				<tr>
					<td>{{ $key + 1 }}</td>
					<td>
						<img style="height:120px;" src="{{ static_asset($value->investor_photo) }}" class="img-fluid" alt="">
					</td>
					<td>
						<a href="{{ static_asset($value->investor_agreement) }}" target="_blank" class="btn btn-danger btn-sm">Check Agreement</a>
					</td>
					<td>{{ $value->investor_name }}</td>
					<td>{{ $value->name }}</td>
					<td>{{ date('d M, Y', strtotime($value->opening_date)) }}</td>
					<td>{{ $value->shop_status }}</td>
					<td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
					<td class="text-right">
						<a class="btn btn-icon btn-sm btn-primary-light rounded-pill" href="{{ url('admin/shop/edit/'.$value->id) }}"><i class="ri-edit-line"></i></a>
							{{--<a class="btn btn-icon btn-sm btn-danger-light rounded-pill" onclick="return confirm('Are you sure, you want to delete this?')" style="" href="{{route('admin.tndcVid.delete',$value->id)}}"><i class="ri-delete-bin-3-fill"></i></a>--}}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

		<div style="float:right;" class="mt-3 justify-content-center">
			{{ $shop_list->links() }}
		</div>
