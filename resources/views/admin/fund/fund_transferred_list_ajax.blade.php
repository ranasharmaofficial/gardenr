<table class="table table-bordered">
<thead>
	<tr>
		<th>#</th>
		<th>Ower Name</th>
		<th>Date</th>
		<th>Type</th>
		<th>Amount</th>
		<th>Remark</th>
		<th>Fund Balance</th>
	</tr>
</thead>

<tbody>
	@foreach($transactions as $txn)
	<tr>
		<td> {{ ($transactions->currentPage() - 1) * $transactions->perPage() + $loop->iteration }}.</td>
		<td>{{ ucfirst($txn->owner_name) }} - {{ $txn->owner_employee_code }}</td>
		<td>{{ date('d-m-Y', strtotime($txn->created_at)) }}</td>
		@if($txn->type=='credit')
			<td style="background-color:green !important;color:#fff !important;">{{ ucfirst($txn->type) }}</td>
		@else
			<td style="background-color:red !important;color:#fff !important;">{{ ucfirst($txn->type) }}</td>
		@endif
		<td>₹ {{ $txn->amount }}</td>
		<td>{{ $txn->remarks }}</td>
		<td>₹ {{ $txn->balance }}</td>
	</tr>
	@endforeach
</tbody>
</table>
<div class="mt-3 float-end">
	{{ $transactions->links() }}
</div>