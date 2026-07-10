<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Employee Code</th>
            <th>Name</th>
            <th>Month</th>
            <th>Date</th>
            <th>Day</th>
            <th>Place</th>
            <th>Work</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($monthly_routines as $key => $val)
		  
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $val->employee_code }}</td>
            <td>{{ $val->first_name }}</td>
            <td>{{ \Carbon\Carbon::parse($val->month)->format('F Y') }}</td>
			<td>{{ date('d-M-Y', strtotime($val->date)) }}</td>
			<td>{{ $val->day }}</td>
			<td>{{ $val->place }}</td>
			<td>{{ $val->work }}</td>
				{{--
            <td>
				<a href="{{ route('admin.navigation.assignEmployeeShop', $val->id) }}" class="btn btn-danger btn-sm btn-danger-light">Assign&nbsp;Shop</a>
			</td>
			--}}
			<td>
				<a class="btn btn-icon btn-sm btn-danger-light rounded-pill" onclick="return confirm('Are you sure, you want to delete this?')" href="{{route('admin.monthly_routine.delete', $val->id)}}"><i class="ri-delete-bin-line"></i></a>
			</td>
			
        </tr>
        @endforeach
    </tbody>
</table>

{{ $monthly_routines->links() }}
