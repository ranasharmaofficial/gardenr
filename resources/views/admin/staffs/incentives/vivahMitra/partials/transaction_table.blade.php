<table class="table table-bordered table-hover">
<thead class="table-light">
<tr>
    <th>#</th>
    <th>Type</th>
    <th>Balance Before</th>
    <th>Amount</th>
    <th>Balance After</th>
    <th>Remarks</th>
    <th>Date</th>
</tr>
</thead>

<tbody>
@forelse($transactions as $key => $t)
<tr>
    <td>{{ $transactions->firstItem() + $key }}</td>
    <td>
        <span class="badge {{ $t->type == 'credit' ? 'bg-success' : 'bg-danger' }}">
            {{ ucfirst($t->type) }}
        </span>
    </td>
    <td>₹ {{ number_format($t->balance_before, 2) }}</td>
    <td>₹ {{ number_format($t->amount, 2) }}</td>
    <td>₹ {{ number_format($t->balance_after, 2) }}</td>
<td class="remark-wrap">{{ $t->remarks }}</td>
    <td>{{ $t->created_at->format('d-m-Y h:i A') }}</td>
</tr>
@empty
<tr>
    <td colspan="7" class="text-center text-danger">
        No transactions found
    </td>
</tr>
@endforelse
</tbody>
</table>

<div class="mt-3">
    {{ $transactions->links() }}
</div>
