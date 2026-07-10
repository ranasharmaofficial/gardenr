@foreach($meeting_list as $key => $val)
	<tr>
		<td>{{ $key+1 }}</td>
		<td><img src="{{ static_asset($val->photo1) }}" style="height:100px;width:auto;" class="" alt="" /></td>
		<td><img src="{{ static_asset($val->photo2) }}" style="height:100px;width:auto;" class="" alt="" /></td>
		<td>{{ $val->training_place }}</td>
		<td>{{ $val->training_address }}</td>
		<td>{{ $val->district_name }}</td>
		<td>{{ date('d-M-Y', strtotime($val->training_date)) }}</td>
		<td>{{ date('h:i A', strtotime($val->start_time)) }}</td>
		<td>{{ date('h:i A', strtotime($val->end_time)) }}</td>
		<td>{{ $val->supported_by }}</td>
		<td>{{ $val->total_vivah_mitra }}</td>
		<td>{{ $val->total_panchayat_mitra }}</td>
		<td>{{ $val->total_block_vivah_mitra }}</th>
		<td>{{ $val->total_district_vivah_mitra }}</td>
		<td>
			@if($val->status==0)
				<span class="badge bg-danger">PENDING</span>
			@else
				<span class="badge bg-success">APPROVED</span>
			@endif
		</td>
		<td>{{ date('d-M-Y', strtotime($val->created_at)) }}</td>
		<td>
			<a href="{{ url('admin/seminar-guest-meeting-details/'.$val->id) }}"
			   class="btn btn-sm btn-info">
			   Details
			</a>
			 
		</td>
	</tr>
@endforeach

<tr>
<td colspan="7">
    {!! $meeting_list->links() !!}
</td>
</tr>											
 