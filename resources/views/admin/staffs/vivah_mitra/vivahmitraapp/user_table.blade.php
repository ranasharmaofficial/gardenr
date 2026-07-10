<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>User Type</th>
            <th>User Designation</th>
            <th>Employee Code</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Status</th>
            <th>Photo</th>
            
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $key => $user)
            @php
                $check_user_details_added = \App\Models\UserDetail::where('user_id', $user->id)->count();
                $getTotalCard = \App\Models\Member::where('leader_id', $user->id)->count();
             @endphp
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $user->userType }}</td>
                <td>{{ $user->designation_name }}</td>
                <td>{{ $user->employee_code }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->mobile }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <img onclick="updateStaffPhoto(this)" id="{{ $user->id }}" style="cursor:pointer;"
                        src="{{ static_asset($user->profile_pic) }}" width="60"
                        onerror="this.onerror=null;this.src='https://www.pulsecarshalton.co.uk/wp-content/uploads/2016/08/jk-placeholder-image.jpg';"
                        alt="{{ $user->first_name }}" class="img-fluid">
                </td>
                 
                
                 
                
                <td>
                    <a href="{{ route('admin.staffs.edit', $user->id) }}"
                        class="btn btn-icon btn-sm btn-danger-light rounded-pill"><i class="ri-edit-line"></i></a>

                    
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $users->links() }}