<table class="table table-bordered table-striped">
    <thead>
        <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Employee Code</th>
                                    <th>Mobile</th>
                                    <th>Designation</th>
                                    <th>Address</th>
                                    <th>Wallet</th>
                                    <th>transaction history</th>
                                </tr>
    </thead>
    <tbody>
        @foreach($users as $k=>$u)

<tr>
<td>{{ $users->firstItem()+$k }}</td>
<td>{{ $u->first_name }}</td>
<td>{{ $u->employee_code }}</td>
<td>{{ $u->mobile }}</td>
<td>{{ $u->designation_name }}</td>
<td>{{ $u->address }}</td>
{{-- <td>₹{{ $u->incentive }}</td> --}}
<td>₹ {{ number_format($u->wallet_balance,2) }}</td>
<td>
<a href="{{ route('admin.vivahMitraIncentive.details', $u->wallet_id) }}"
   class="btn btn-sm btn-info">
   Details
</a>
    <a href="javascript:void(0)"
        class="btn btn-sm btn-primary payBtn"
        data-id="{{ $u->id }}">
        Pay
    </a>
</td>

</tr>

@endforeach

<tr>
<td colspan="7">
    {!! $users->links() !!}
</td>
</tr>

    </tbody>
</table>

{{ $users->links() }}