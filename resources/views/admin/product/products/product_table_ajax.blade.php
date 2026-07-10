    <table id="basicExample" class="table truncate m-0 align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Name</th>
                <th>Purchase Price</th>
                <th>Offer Price</th>
                <th>Logo</th>
                <th>Status</th>
                <th>Created At</th>
                <th class="text-right">Actions</th>
                <th class="text-right">Product Gallery</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $value)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $value->category->name }}</td>
                <td>{{ $value->brand->name }}</td>
                <td>{{ $value->name }}</td>
                <td>₹&nbsp;{{ $value->purchase_price }}</td>
                <td>₹&nbsp;{{ $value->offer_price }}</td>
                <td><img style="max-width: 26px;width: 26px;" src="{{ static_asset($value->thumbnail) }}"></td>
                <td>
                    <div class="actions"> @if($value->status == 1) <span class="badge bg-success-subtle text-success">Active</span> @else <span class="badge bg-danger-subtle text-danger">InActive</span> @endif </div>
                </td>
                <td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
                <td class="text-right">
                    <a href="{{ route('admin.products.edit',$value->id) }}" class="btn btn-icon btn-sm btn-danger-light rounded-pill" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Product"><i class="ri-edit-line"></i></a>
                </td>
                <td class="text-right">
                    <a href="{{ route('admin.products.edit',$value->id) }}" class="btn btn-info btn-sm">
                        Product&nbsp;Gallery
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $products->appends(request()->input())->links() }}
    </div>
