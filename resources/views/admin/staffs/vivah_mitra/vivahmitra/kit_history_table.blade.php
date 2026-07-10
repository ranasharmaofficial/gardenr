<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-dark text-center">
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>From</th>
                <th>To</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Note</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $key => $trx)
                <tr>
                    <td>{{ $transactions->firstItem() + $key }}</td>
                    <td>
                        <span class="badge {{ $trx->type == 'issue' ? 'bg-success' : 'bg-primary' }}">
                            {{ ucfirst($trx->type) }}
                        </span>
                    </td>
                    <td>{{ $trx->fromUser->name ?? 'Admin' }}</td>
                    <td>{{ $trx->toUser->name ?? '-' }}</td>
                    <td class="fw-bold">{{ $trx->quantity }}</td>
                    <td>{{ $trx->created_at->format('d-m-Y h:i A') }}</td>
                    <td>{{ $trx->note }}</td>
                    <td>
                        @if($trx->status=='pending')
                            <span class="badge bg-danger">PENDING</span>
                        @elseif($trx->status=='accepted')
                            <span class="badge bg-primary">ACCEPTED</span>
                        @elseif($trx->status=='rejected')
                            <span class="badge bg-danger">REJECTED</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-danger">
                        No Card Transactions Found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $transactions->links() }}
    </div>
</div>
