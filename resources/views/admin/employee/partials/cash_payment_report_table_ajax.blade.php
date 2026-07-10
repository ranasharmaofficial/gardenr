<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Employee Code</th>
            <th>Name</th>
             
            <th>Time</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($cash_entries as $key => $entry)
		  
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $entry->employee_code }}</td>
            <td>{{ $entry->first_name }}</td>
            <td>{{ $entry->created_at->format('d-m-Y h:i A') }}</td>
			<td>₹ {{ number_format($entry->subtotal, 2) }}</td>
			<td>
				<button class="btn btn-sm btn-primary toggleDetails" data-id="{{ $entry->id }}">
					View Details
				</button>
				<a class="btn btn-icon btn-sm btn-danger-light rounded-pill" onclick="return confirm('Are you sure, you want to delete this?')" href="{{route('admin.cashPayment.delete', $entry->id)}}"><i class="ri-delete-bin-line"></i></a>
			</td>
			
        </tr>
		<!-- Hidden Detail Row -->
		<tr class="detailsRow" id="details-{{ $entry->id }}" style="display:none;">
			<td colspan="7">
				<table class="table table-sm table-bordered">
					<thead>
						<tr>
							<th>Note</th>
							<th>Quantity</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($entry->details as $detail)
						<tr>
							<td>₹ {{ $detail->note_value }}</td>
							<td>{{ $detail->quantity }}</td>
							<td>₹ {{ number_format($detail->total, 2) }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</td>
		</tr>

		@empty
		<tr>
			<td colspan="5" class="text-center">No Data Found</td>
		</tr>
		@endforelse
         
    </tbody>
</table>

{{ $cash_entries->links() }}
