@extends('vivah_mitra.layouts.master')
@section('title') {{ $page_title ?? 'Products' }} @endsection

@section('meta_tags')
@endsection

@section('content')
<style>
.product-img{
    height:150px;
    width:100%;
    object-fit:cover;
}
</style>
   <header class="header">
        <div class="main-bar">
            <div class="container">
                <div class="header-content">
                    <div class="left-content">
                        <a href="{{ url()->previous() }}" class="back-btn">
                            <svg width="18" height="18" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.03033 0.46967C9.2966 0.735936 9.3208 1.1526 9.10295 1.44621L9.03033 1.53033L2.561 8L9.03033 14.4697C9.2966 14.7359 9.3208 15.1526 9.10295 15.4462L9.03033 15.5303C8.76406 15.7966 8.3474 15.8208 8.05379 15.6029L7.96967 15.5303L0.96967 8.53033C0.703403 8.26406 0.679197 7.8474 0.897052 7.55379L0.96967 7.46967L7.96967 0.46967C8.26256 0.176777 8.73744 0.176777 9.03033 0.46967Z"
                                    fill="#a19fa8"></path>
                            </svg>
                        </a>
                    </div>

                    <div class="mid-content">
                        <h5 class="mb-0">Product List</h5>
                    </div>

                    <div class="right-content">
                        <a href="javascript:void(0);" class="menu-toggler">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4"
                                    d="M16.0755 2H19.4615C20.8637 2 22 3.14585 22 4.55996V7.97452C22 9.38864 20.8637 10.5345 19.4615 10.5345H16.0755C14.6732 10.5345 13.537 9.38864 13.537 7.97452V4.55996C13.537 3.14585 14.6732 2 16.0755 2Z"
                                    fill="#a19fa8"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z"
                                    fill="#a19fa8"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @include('vivah_mitra.includes.sidebar')

    <div class="page-content">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
                <div>
                    <h5 class="mb-0">{{ $page_title ?? 'Products' }}</h5>
                     
                </div>
            </div>
			@if(false)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <form method="GET" action="">
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                placeholder="Search product or stock...">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
			@endif

            @if($product_list->count() > 0)

                <div class="row">
				
				 
					@foreach($product_list as $item)
						<div class="col-6 col-md-3 mb-3">
							<div class="card h-100">
								<img src="{{ static_asset($item->product_photo) }}" class="card-img-top product-img">
								
								<div class="card-body text-center">
									<small class="text-muted">
										Category: {{ $item->category_name ?? '-' }}
									</small>

									<h6>{{ $item->product_name ?? '-' }}</h6>
									<p>₹{{ $item->price_80 }}</p>
								</div>
							</div>
						</div>
					@endforeach
					
					@if(false)
                    @foreach($product_list as $item)
                        <div class="col-12 mb-3"> 
                            <div class="card shadow-sm border-0">
                                <div class="card-body">

                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="mb-1">{{ $item->product_name ?? '-' }}</h6>
                                            <small class="text-muted">
                                                Category: {{ $item->category_name ?? '-' }}
                                            </small>
                                        </div>

                                        <div class="text-end">
                                            <span class="badge bg-success">Stock: {{ $item->stock ?? 0 }}</span>
                                            @if(($item->stock ?? 0) <= 5)
                                                <div class="mt-1">
                                                    <span class="badge bg-danger">Low Stock</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <hr class="my-2">

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="text-muted d-block">Branch: {{ $item->branch_name ?? '-' }}</small>
                                        </div>

                                        <div class="text-end">
                                            @if(!empty($item->offer_price) && $item->offer_price > 0)
                                                <div>
                                                    <span class="text-muted text-decoration-line-through">
                                                        ₹{{ number_format($item->price ?? 0, 2) }}
                                                    </span>
                                                    <span class="fw-bold text-success ms-1">
                                                        ₹{{ number_format($item->offer_price, 2) }}
                                                    </span>
                                                </div>
                                            @else
                                                <div class="fw-bold">
                                                    ₹{{ number_format($item->price ?? 0, 2) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
					@endif

                </div>

                <div class="mt-3">
                    {{ $product_list->links() }}
                </div>

            @else
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="mb-1">No products found</h6>
                        <p class="text-muted mb-0">Try searching with different keyword.</p>
                    </div>
                </div>
            @endif

        </div>
    </div>

    @include('vivah_mitra.includes.home_footer_menu')

@endsection