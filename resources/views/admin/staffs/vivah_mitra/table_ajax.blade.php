<style>
    .table tbody tr {
        background-color: transparent !important;
    }

    .table tbody tr > td {
        background-color: inherit !important;
    }
</style>
	<table id="" class="table table-bordered text-nowrap mt-3" style="width:100%">
		<thead>
			<tr>
				<th>#</th>
				<th>Vivah Mitra Code</th>
				<th>Vivah Mitra Name</th>
				<th>Total Membership</th>
				<th>Used Membership</th>
				<th>Due Membership</th>
				<th>Is Used</th>
				<th>Used Date</th>
				<th>Created By</th>
				<th>Created At</th>
				<th>View</th>
				<th class="text-right">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($membership_list as $key => $value)
				@php
					$count_membership_added = \App\Models\MasterMembership::where('vivah_mitra_id', $value->vivahMitraId)->count();
					$used_membership = \App\Models\MasterMembership::where('is_used', 1)->where('vivah_mitra_id', $value->vivahMitraId)->count();
                $rowColors = [
                    '#b2d0e5',
                    '#c6dbae',
                    '#e4c085',
                    '#d392a8',
                    '#b99fe0',
                    '#5ac8d4',
                ];
            @endphp

                @php
                    $bgColor = $rowColors[$loop->index % count($rowColors)];
                @endphp
				<tr>
					<td style="background-color: {{ $bgColor }} !important; font-size:16px !important;">{{ ($membership_list->currentPage() - 1) * $membership_list->perPage() + ($key + 1) }}</td>
					<td style="background-color: {{ $bgColor }} !important; font-size:16px !important;">{{ $value->employee_code }}</td>
					<td style="background-color: {{ $bgColor }} !important; font-size:16px !important;color:green;">
						@if($value->is_used==0)
							<a href="{{ url('admin/staffs/add-vivah-mitra/'.$value->employee_code) }}" class="btn btn-success btn-sm">Add Vivah Mitra</a>
						@else
							{{ $value->leaderName }}
						@endif
					</td>
					<td style="background-color: {{ $bgColor }} !important; font-size:16px !important;"> {{ $count_membership_added }}   </td>
					<td style="background-color: {{ $bgColor }} !important; font-size:16px !important;"> {{ $used_membership }}   </td>
					<td style="background-color: {{ $bgColor }} !important; font-size:16px !important;"> {{ $count_membership_added-$used_membership }}   </td>
					<td style="background-color: {{ $bgColor }} !important; font-size:16px !important;">
						@if($value->is_used==0)
							<span class="badge bg-danger">Not&nbsp;Used</span>
						@endif

						@if($value->is_used==1)
							<span class="badge bg-success">Used</span>
						@endif
					</td>

					<td style="background-color: {{ $bgColor }} !important; font-size:16px !important;"> @if($value->used_date!=null) {{ date('d M, Y', strtotime($value->used_date)) }} @endif</td>
					<td style="background-color: {{ $bgColor }} !important; font-size:16px !important;">{{ $value->addedByName }}</td>
                    <td style="background-color: {{ $bgColor }} !important; font-size:16px !important;">{{ date('d M, Y', strtotime($value->created_at)) }}</td>
					<td style="background-color: {{ $bgColor }} !important; font-size:16px !important;" class="text-right">
                         
						
						 @if($count_membership_added > 0 && !empty($value->vivahMitraId))
							<a class="btn btn-sm btn-warning" target="_blank"
							   href="{{ route('admin.membership.viewVivahMitraMemberships', ['id' => $value->vivahMitraId]) }}">
								View Membership
							</a>
						@else
							<span class="text-danger">No Membership</span>
						@endif
						
					</td>
                    <td style="background-color: {{ $bgColor }} !important; font-size:16px !important;" class="text-right">
						<a class="btn btn-icon btn-sm btn-primary-light rounded-pill" href=""><i class="ri-edit-line"></i></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

		<div style="float:right;" class="mt-3 justify-content-center">
			{{ $membership_list->links() }}
		</div>
