<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Employee Code</th>
            <th>Name</th>
			<th>Date</th>
			<th>Day</th>
			<th>Time</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Remarks</th>
            <th>Screenshot</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($online_payments as $key => $payment)
		  
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $payment->employee_code }}</td>
            <td>{{ $payment->first_name }}</td>
            <td>{{ date('d-M-Y', strtotime($payment->date)) }}</td>
			<td>{{ $payment->day }}</td>
			<td>{{ date('h:i A', strtotime($payment->time)) }}</td>
			<td>₹ {{ number_format($payment->amount, 2) }}</td>
			<td>
				{{-- STATUS BUTTON --}}
				 
					@if($payment->status=='pending')
						<button type="button"
							class="btn btn-sm btn-danger paymentStatusBtn"
							data-id="{{ $payment->id }}"
							data-status="{{ $payment->status }}">
							PENDING
						</button>
					@elseif($payment->status=='verified')
						<span class="badge bg-success">VERIFIED</span>
					@else
						<span class="badge bg-warning">REJECTED</span>
					@endif
				 
			</td>
			
			<td>{{ $payment->remarks ?? '' }}</td>

			<td>
				@if($payment->screenshots && count($payment->screenshots))
					@foreach($payment->screenshots as $img)
						<img src="{{ static_asset($img->image) }}" 
							 class="img-thumbnail previewImg" 
							 style="width:60px;height:60px;cursor:pointer;"
							 data-src="{{ static_asset($img->image) }}">
					@endforeach
				@else
					<span>No Image</span>
				@endif
			</td>
			<td>
				<a class="btn btn-icon btn-sm btn-danger-light rounded-pill" onclick="return confirm('Are you sure, you want to delete this?')" href="{{route('admin.onlinePayment.delete', $payment->id)}}"><i class="ri-delete-bin-line"></i></a>
			</td>
			
        </tr>
		@empty
		<tr>
			<td colspan="9" class="text-center">No Data Found</td>
		</tr>
		@endforelse
		 
         
    </tbody>
</table>

<!-- Image Preview Modal -->
							<div class="modal fade" id="imageModal" tabindex="-1">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-body text-center">
											<img id="modalImage" src="" class="img-fluid">
										</div>
									</div>
								</div>
							</div>

{{ $online_payments->links() }}
