<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>SN</th>
            <th>User Type</th>
            <th>User Designation</th>
            <th>Employee Code</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Username</th>
            <th>Password</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $key => $user)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $user->userType }}</td>
            <td>{{ $user->designation_name }}</td>
            <td>{{ $user->employee_code }}</td>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->mobile }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->password }}</td>
            <td>{{ $user->status ? 'Active' : 'Inactive' }}</td>
			<td>
				<a href="{{ route('admin.staffs.edit', $user->id) }}" class="btn btn-icon btn-sm btn-danger-light rounded-pill"><i class="ri-edit-line"></i></a>
			</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $users->links() }}
