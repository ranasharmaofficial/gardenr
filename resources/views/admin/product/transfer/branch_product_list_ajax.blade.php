<style>
    .table tbody tr {
        background-color: transparent !important;
    }

    .table tbody tr > td {
        background-color: inherit !important;
    }
</style>
	<table id="" class="table table-bordered text-nowrap mt-3" style="width:100%">
		<thead>
			<tr>
				<th>#</th>
				<th>Branch</th>
				<th>Category</th>
				<th>Product</th>
				<th>MRP/Red Price</th>
				<th>Blue Price</th>
				<th>Green Price</th>
				<th>Stop Price</th>
				<th>Stock</th>
				<th>Transfer Date</th>
                @if(currentUserType()==1)
				<th class="text-right">Actions</th>
                @endif
			</tr>
		</thead>
		<tbody>
			@foreach ($product_list as $key => $value)
				@php

                $rowColors = [
                    '#b2d0e5',
                    '#c6dbae',
                    '#e4c085',
                    '#d392a8',
                    '#b99fe0',
                    '#5ac8d4',
                ];
            @endphp

                @php
                    $bgColor = $rowColors[$loop->index % count($rowColors)];
                @endphp
				<tr>
					<td style="background-color: {{ $bgColor }} !important; font-size:16px !important;">{{ ($product_list->currentPage() - 1) * $product_list->perPage() + ($key + 1) }}</td>
					<td style="background-color: {{ $bgColor }} !important; font-size:16px !important;">{{ $value->branch_name   }}</td>
					<td style="background-color: {{ $bgColor }} !important; font-size:16px !important;color:green;">{{ $value->category_name }}</td>
					<td style="background-color: {{ $bgColor }} !important; font-size:16px !important; max-width: 200px;word-wrap: break-word;overflow-wrap: break-word;white-space: normal;"> {{ $value->product_name }}   </td>
					<td style="background-color: {{ $bgColor }} !important; font-size:16px !important;"> {{ $value->price_80 }}   </td>
					<td style="background-color: {{ $bgColor }} !important; font-size:16px !important;"> {{ $value->price_62 }}   </td>
					<td style="background-color: {{ $bgColor }} !important; font-size:16px !important;"> {{ $value->price_50 }}   </td>
					<td style="background-color: {{ $bgColor }} !important; font-size:16px !important;"> {{ $value->price_45 }}   </td>
					<td style="background-color: {{ $bgColor }} !important; font-size:16px !important;"> {{ $value->stock }} </td>
                    <td style="background-color: {{ $bgColor }} !important; font-size:16px !important;">{{ date('d M, Y', strtotime($value->transfer_date)) }}</td>
					@if(currentUserType()==1)
                     <td style="background-color: {{ $bgColor }} !important; font-size:16px !important;" class="text-right">
                        <a href="javascript:void(0)"
                            class="btn btn-sm btn-warning openUpdateStockModal"
                            data-id="{{ $value->id }}"
                            data-product="{{ $value->product_name }}"
                            data-stock="{{ $value->stock }}"
                            data-price="{{ $value->price }}"
                            data-offer="{{ $value->offer_price }}">
                            Update Stock
                        </a>
                      </td>
                    @endif
                </tr>
			@endforeach
		</tbody>
	</table>

		<div style="float:right;" class="mt-3 justify-content-center">
			{{ $product_list->links() }}
		</div>
