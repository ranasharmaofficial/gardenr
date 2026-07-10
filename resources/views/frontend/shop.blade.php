@extends('frontend.layouts.master')
@section('title') Shop - All Plants & Garden Products @endsection

@section('content')
<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Shop</li>
                        @isset($category)
                            <li class="breadcrumb-item active">{{ $category->name }}</li>
                        @endisset
                    </ol>
                </div>
            </nav>
            <h1>@isset($category){{ $category->name }}@else All Products @endisset</h1>
        </div>
    </div>

    <div class="container">
        <div class="row">
            {{-- Sidebar --}}
            <div class="col-lg-3 col-md-4 order-lg-first">
                <div class="sidebar sidebar-shop">
                    <div class="widget widget-categories">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-1" role="button">Categories</a>
                        </h3>
                        <div class="collapse show" id="widget-body-1">
                            <div class="widget-body">
                                <ul class="cat-list">
                                    <li @if(!isset($category)) class="active" @endif>
                                        <a href="{{ route('shop') }}">All Products <span class="products-count">({{ \App\Models\Product::where('status',1)->count() }})</span></a>
                                    </li>
                                    @foreach($categories as $cat)
                                        <li @if(isset($category) && $category->id == $cat->id) class="active" @endif>
                                            <a href="{{ route('category.slug', $cat->slug) }}">
                                                {{ $cat->name }}
                                                <span class="products-count">({{ \App\Models\Product::where('category_id', $cat->id)->where('status',1)->count() }})</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Products Grid --}}
            <div class="col-lg-9 col-md-8">
                <div class="toolbox">
                    <div class="toolbox-left">
                        <div class="toolbox-info">
                            Showing <span>{{ $products->firstItem() }}–{{ $products->lastItem() }}</span> of <span>{{ $products->total() }}</span> results
                        </div>
                    </div>
                </div>

                @if($products->count() > 0)
                    <div class="row product-ajax-grid">
                        @foreach($products as $item)
                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                @include('frontend.partials.product_box')
                            </div>
                        @endforeach
                    </div>

                    <div class="pagination-wrapper mt-4">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="icon-search" style="font-size:48px; color:#ccc;"></i>
                        <h3 class="mt-3 text-muted">No products found in this category.</h3>
                        <a href="{{ route('shop') }}" class="btn btn-primary mt-3">View All Products</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
