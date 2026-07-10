@foreach($users as $k=>$u)

<tr>
<td>{{ $users->firstItem()+$k }}</td>
<td>{{ $u->first_name }}</td>
<td>{{ $u->employee_code }}</td>
<td>{{ $u->mobile }}</td>
<td>{{ $u->designation_name }}</td>
<td>{{ $u->address }}</td>
<td>₹ {{ number_format($u->wallet_balance,2) }}</td>
<td>
<a href="{{ route('admin.vivahMitraIncentive.details', $u->wallet_id) }}"
   class="btn btn-sm btn-info">
   Details
</a>
    <a href="" class="btn btn-sm btn-info">Pay</a>    
</td>
</tr>

@endforeach

<tr>
<td colspan="7">
{!! $users->links() !!}
</td>
</tr>
