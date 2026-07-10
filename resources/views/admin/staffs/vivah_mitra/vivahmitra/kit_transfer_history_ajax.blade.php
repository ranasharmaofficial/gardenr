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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kit_transactions as $key => $trx)
                <tr>
                    <td>{{ $kit_transactions->firstItem() + $key }}</td>
                    <td>
                        <span class="badge {{ $trx->type == 'issue' ? 'bg-success' : 'bg-primary' }}">
                            {{ ucfirst($trx->type) }}
                        </span>
                    </td>
                    <td>{{ $trx->from_user_name ?? 'Admin' }}</td>
                    <td>{{ $trx->to_user_name ?? '-' }}</td>
                    <td class="fw-bold">{{ $trx->quantity }}</td>
                    <td>{{ $trx->created_at->format('d-m-Y h:i A') }}</td>
                    <td><a class="btn btn-icon btn-sm btn-danger-light rounded-pill" onclick="return confirm('Are you sure, you want to delete this?')" href="{{route('admin.kitTransferHistoryDelete', $trx->id)}}"><i class="ri-delete-bin-line"></i></a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-danger">
                        No Kit Found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $kit_transactions->links() }}
    </div>
</div>