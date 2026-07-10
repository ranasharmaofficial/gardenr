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
            <th>Username</th>
            <th>Password</th>
            <th>Status</th>
            <th>Photo</th>
            <th>Total Card</th>
            <th>Physical Card</th>
            <th>Kit Package</th>
            <th>Login</th>
            <th>Verify&nbsp;Employee</th>
            <th>View Team</th>
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
                <td>{{ $user->username }}</td>
                <td>{{ $user->password }}</td>
                <td>{{ $user->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <img onclick="updateStaffPhoto(this)" id="{{ $user->id }}" style="cursor:pointer;"
                        src="{{ static_asset($user->profile_pic) }}" width="60"
                        onerror="this.onerror=null;this.src='https://www.pulsecarshalton.co.uk/wp-content/uploads/2016/08/jk-placeholder-image.jpg';"
                        alt="{{ $user->first_name }}" class="img-fluid">
                </td>
                <td>
                    {{ $getTotalCard }}

                    @if($getTotalCard >= 5)
                        <a href="{{ route('admin.emp.promoteVivahMitra', $user->id) }}" target="_blank"
                            class="btn btn-success btn-sm btn-success-light">Promote</a>
                    @endif

                </td>
                <td>
                    <a onclick="givePhysicalCard(this)" id="{{ $user->id }}"
                        class="btn btn-danger btn-sm btn-danger-light mt-3">Give&nbsp;Physical&nbsp;Card</a>
                    <a href="{{ route('admin.cards.history', $user->id) }}"
                        class="btn btn-info btn-sm btn-info-light mt-3">View&nbsp;Card&nbsp;History</a>

                </td>
				<td>
                    <a onclick="giveKitCard(this)" id="{{ $user->id }}"
                        class="btn btn-danger btn-sm btn-danger-light mt-3">Give&nbsp;Kit</a>
                    <a href="{{ route('admin.kits.history', $user->id) }}"
                        class="btn btn-info btn-sm btn-info-light mt-3">View&nbsp;Kit&nbsp;History</a>

                </td>
                <td>
                    <form target="_blank" action="{{ route('admin.emp.adminVivahMitraLoginPost') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $user->username }}" name="username" placeholder="Your Mobile No."
                            class="form-control">
                        <input type="hidden" value="{{ $user->password }}" name="password" placeholder="Password"
                            id="dz-password" class="form-control be-0">
                        <button type="submit" class="btn btn-info btn-sm btn-info-light"><i
                                class="ri-login-box-line"></i>&nbsp;LOGIN</button>
                    </form>

					<form class="update-vm-box-form">
						@csrf

						<div style="display:none;"
							class="alert alert-danger show-vm-box-form-error">
							<div class="errorMsgContainer"></div>
						</div>

						<input type="hidden" name="user_id" value="{{ $user->id }}">

						<button type="submit"
							class="btn btn-danger btn-sm update_vm_button mt-3">
							UPDATE&nbsp;VM&nbsp;BOX
						</button>
					</form>

                    @php
                        $checkVmCount = \App\Models\PrakhandVmBox::where('user_id', $user->id)->where('is_filled', 0)->count();
                    @endphp

                    @if($checkVmCount==20)
                        <a onclick="return confirm('Are you sure, you want to delete this?')" href="{{ url('admin/emp/deleteVmVox/'.$user->id)}}" class="btn btn-info btn-sm mt-3">DELETE&nbsp;VM&nbsp;BOX</a>
                    @endif

                </td>
                <td>
                    @if($check_user_details_added == 0)
                        <a href="{{ route('admin.verifyEmployee', $user->id) }}"
                            class="btn btn-success btn-sm btn-success-light">Verify&nbsp;Employee</a>

						<a target="_blank" href="{{ route('admin.employee.printVivahMitraAgreement', $user->id) }}" class="btn btn-primary btn-sm mt-1">
                            Download&nbsp;Agreement
                        </a>
                    @else
                        <a href="{{ route('admin.viewEmployeeDetails', $user->id) }}"
                            class="btn btn-danger btn-sm btn-danger-light">Update&nbsp;Employee&nbsp;Details</a>

						<a target="_blank" href="{{ route('admin.employee.printVivahMitraAgreement', $user->id) }}" class="btn btn-primary btn-sm mt-1">
                            Download&nbsp;Agreement
                        </a>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.viewTeam', $user->id) }}"
                        class="btn btn-info btn-sm btn-info-light">View&nbsp;Team</a>
                </td>
                <td>
                    <a href="{{ route('admin.staffs.edit', $user->id) }}"
                        class="btn btn-icon btn-sm btn-danger-light rounded-pill"><i class="ri-edit-line"></i></a>

                    <a onclick="updateBlockUnblock(this)" id="{{ $user->id }}"
                        class="btn btn-danger btn-sm btn-danger-light mt-3">Block/Un&nbsp;Block</a>

					<a onclick="updateunBlockDate(this)" id="{{ $user->id }}"
                        class="btn btn-danger btn-sm btn-danger-light mt-3">Un&nbsp;Block&nbsp;&&nbsp;Date&nbsp;Update</a>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $users->links() }}
