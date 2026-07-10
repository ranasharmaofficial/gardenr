<table id="" class="table table-bordered text-nowrap mt-3" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Type</th>
                                        <th>Name</th>
                                        <th>Incentive</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($designayion_list as $key => $value)
									<tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->userType }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->incentive }}&nbsp;%</td>
                                        <td>
                                            <div class="actions"> @if($value->status == 1) <a href="#" class="btn btn-sm bg-success-light mr-2">Active</a> @else <a href="#" class="btn btn-sm bg-danger-light mr-2">Inactive</a> @endif </div>
                                        </td>
                                        <td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
                                        <td class="text-right">
                                            <a class="btn btn-icon btn-sm btn-primary-light rounded-pill" onclick="editDesignation({{ $value->id }})" href="javascript:void();"><i class="ri-edit-line"></i></a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>


                                </table>

		<div style="float:right;" class="mt-3 justify-content-center">
			{{ $designayion_list->links() }}
		</div>
