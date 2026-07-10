@extends('frontend.layouts.master')
@section('title') Home @endsection

@section('meta_tags')

@endsection
@section('content')
<main class="main">

    <!-- Breadcrumb Background -->
    <div class="page-header page-header-bg text-left"
        style="background: url('{{ static_asset('assets/assets_web/images/banners/banner-top.jpg') }}') center center / cover no-repeat;">

        <div class="container">
            <div class="page-header-content">
                <h1>Product</h1>
            </div>
        </div>

    </div>

    <div class="container">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">
                    <a href="index.php">
                        <i class="icon-home"></i>
                    </a>
                </li>

                <li class="breadcrumb-item">
                    <a href="#">Plants</a>
                </li>

                <li class="breadcrumb-item active" aria-current="page">
					{{ $product->name }}
                </li>

            </ol>

        </nav>

        <!-- Product Single -->
        <div class="product-single-container product-single-default">

            <div class="row">

                <!-- Product Gallery -->
                <div class="col-lg-5 col-md-6 product-single-gallery">

                    <div class="product-slider-container">

                        <div class="label-group">
                            <div class="product-label label-hot">HOT</div>
                            <div class="product-label label-sale">-20%</div>
                        </div>

                        <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
							<div class="product-item">
								<img class="product-single-image"
									src="{{ static_asset($product->thumbnail) }}"
									data-zoom-image="{{ static_asset($product->thumbnail) }}"
									width="468" height="468" alt="{{ $product->name }}">
							</div>
							@foreach($product_images as $val)
								<div class="product-item">
									<img class="product-single-image"
										src="{{ static_asset($val->image_path) }}"
										data-zoom-image="{{ static_asset($val->image_path) }}"
										width="468" height="468" alt="{{ $product->name }}">
								</div>
							@endforeach
						</div>

                        <span class="prod-full-screen">
                            <i class="icon-plus"></i>
                        </span>

                    </div>

                    <!-- Thumbnail -->
                    <div class="prod-thumbnail owl-dots">
                        <div class="owl-dot">
                            <img src="{{ static_asset($product->thumbnail) }}"
                                width="110" height="110" alt="{{ $product->name }}">
                        </div>
						@foreach($product_images as $val)
                        <div class="owl-dot">
                            <img src="{{ static_asset($val->image_path) }}"
                                width="110" height="110" alt="{{ $product->name }}">
                        </div>
						@endforeach

                    </div>

                </div>

                <!-- Product Details -->
                <div class="col-lg-7 col-md-6 product-single-details">

                    <h1 class="product-title">{{ $product->name }}</h1>

                    <div class="product-nav d-none">

                        <div class="product-prev">
                            <a href="#">
                                <span class="product-link"></span>

                                <span class="product-popup">
                                    <span class="box-content">

                                        <img alt="Spider Plant"
                                            width="150"
                                            height="150"
                                            src="assets/images/products/spider.jpg">

                                        <span>Spider Plant</span>

                                    </span>
                                </span>
                            </a>
                        </div>

                        <div class="product-next">
                            <a href="#">
                                <span class="product-link"></span>

                                <span class="product-popup">
                                    <span class="box-content">

                                        <img alt="Peace Lily"
                                            width="150"
                                            height="150"
                                            src="assets/images/products/peace.jpg">

                                        <span>Peace Lily</span>

                                    </span>
                                </span>
                            </a>
                        </div>

                    </div>

                    <!-- Ratings -->
                    <div class="ratings-container">

                        <div class="product-ratings">
                            <span class="ratings" style="width:95%"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>

                        <a href="#" class="rating-link">( 12 Reviews )</a>

                    </div>

                    <hr class="short-divider">

                    <!-- Price -->
                    <div class="price-box">
                        <span class="old-price">₹{{ $product->purchase_price }}</span>
                        <span class="new-price">₹{{ $product->offer_price }}</span>
                    </div>

                    <!-- Description -->
                    <div class="product-desc">
                        <p>{{ $product->short_description }}</p>
                    </div>

                    <!-- Info -->
                    <ul class="single-info-list">

                        <li>
                            SKU:
                            <strong>PLANT4589</strong>
                        </li>

                        <li>
                            CATEGORY:
                            <strong>
                                <a href="#" class="product-category">{{ $product->category->name }}</a>
                            </strong>
                        </li>

                        <li>
                            TAGs:
                            <strong>
                                <a href="#" class="product-category">Air Purifying</a>
                            </strong>,
                            <strong>
                                <a href="#" class="product-category">Low Maintenance</a>
                            </strong>
                        </li>

                    </ul>

                    <!-- Action -->
                    <div class="product-action">

                        <div class="product-single-qty">
                            <input class="horizontal-quantity form-control qtySelect" type="number" min="1" value="1">
                        </div>

                        <a href="javascript:;"
                            class="btn btn-dark add-cart mr-2 addToCartBtn"
                            data-id="{{ $product->id }}"
                            title="Add to Cart">
                            Add to Cart
                        </a>

                        <a href="cart.php" class="btn btn-gray view-cart d-none">
                            View cart
                        </a>

                    </div>

                    <hr class="divider mb-0 mt-0">

                    <!-- Share -->
                    <div class="product-single-share mb-3">

                        <label class="sr-only">Share:</label>

                        <div class="social-icons mr-2">
							@php
								$shareUrl   = urlencode(url('product/'.$product->slug));
								$shareTitle = urlencode($product->product_name);
							@endphp
                            <!-- Facebook -->
							<a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}"
							   class="social-icon social-facebook icon-facebook"
							   target="_blank"
							   title="Share on Facebook"></a>

							<!-- Twitter / X -->
							<a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}"
							   class="social-icon social-twitter icon-twitter"
							   target="_blank"
							   title="Share on Twitter"></a>

							<!-- LinkedIn -->
							<a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}"
							   class="social-icon social-linkedin fab fa-linkedin-in"
							   target="_blank"
							   title="Share on LinkedIn"></a>

							<!-- WhatsApp -->
							<a href="https://wa.me/?text={{ $shareTitle }}%20{{ $shareUrl }}"
							   class="social-icon fab fa-whatsapp"
							   target="_blank"
							   title="Share on WhatsApp"></a>

							<!-- Email -->
							<a href="mailto:?subject={{ $shareTitle }}&body=Check%20this%20product:%20{{ $shareUrl }}"
							   class="social-icon social-mail icon-mail-alt"
							   target="_blank"
							   title="Share via Email"></a>

                        </div>

                        <a href=""
                            class="btn-icon-wish add-wishlist"
                            title="Add to Wishlist">

                            <i class="icon-wishlist-2"></i>
                            <span>Add to Wishlist</span>

                        </a>

                    </div>

                </div>

            </div>

        </div>

        <!-- Tabs -->
        <div class="product-single-tabs">

            <ul class="nav nav-tabs" role="tablist">

                <li class="nav-item">
                    <a class="nav-link active"
                        id="product-tab-desc"
                        data-toggle="tab"
                        href="#product-desc-content">
                        Description
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                        id="product-tab-size"
                        data-toggle="tab"
                        href="#product-size-content">
                        Plant Care
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                        id="product-tab-tags"
                        data-toggle="tab"
                        href="#product-tags-content">
                        Additional Information
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                        id="product-tab-reviews"
                        data-toggle="tab"
                        href="#product-reviews-content">
                        Reviews (1)
                    </a>
                </li>

            </ul>

            <div class="tab-content">

                <!-- Description -->
                <div class="tab-pane fade show active"
                    id="product-desc-content">

                    <div class="product-desc-content">

					{!! $product->description !!}

                    </div>

                </div>

                <!-- Plant Care -->
                <div class="tab-pane fade"
                    id="product-size-content">

                    <div class="product-size-content">

					{!! $product->plant_care !!}

                    </div>

                </div>

                <!-- Additional Information -->
                <div class="tab-pane fade"
                    id="product-tags-content">

                    <div class="product-tags-content">

					{!! $product->additional_information !!}

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>

@endsection
