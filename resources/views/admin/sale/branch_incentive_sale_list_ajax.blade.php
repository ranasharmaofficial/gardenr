<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Employee</th>
            <th>Vivah Mitra</th>
            <th>Member</th>
            <th>Sale Date</th>
            <th>Sale Amount</th>
            <th>Incentive</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales_list as $key => $sale)
		 
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $sale->branchName }}</td>
            <td>{{ $sale->vivahMitraName }}</td>
            <td>{{ $sale->memberName }}</td>
            <td>{{ date('d-M-Y', strtotime($sale->sale_date)) }}</td>
            <td>{{ $sale->total_amount }}</td>
            <td>{{ $sale->incentive_amount }}</td>
			<td>{{ date('d-M-Y', strtotime($sale->created_at)) }}</td>
            <td>
				<a href="{{ route('admin.sale.viewSaleDetails', $sale->id) }}" class="btn btn-success btn-sm btn-success-light">View&nbsp;Sale&nbsp;Details</a>
				<a target="_blank" href="{{ route('admin.sale.viewSaleInvoice', $sale->id) }}" class="btn btn-primary btn-sm btn-success-light">View&nbsp;Sale&nbsp;Invoice</a>
			</td>
			 
        </tr>
        @endforeach
    </tbody>
</table>

{{ $sales_list->links() }}
