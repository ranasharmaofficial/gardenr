<style>


</style>

@php
    $discount = 0;

    if($item->purchase_price > 0 && $item->offer_price < $item->purchase_price){
        $discount = round((($item->purchase_price - $item->offer_price) / $item->purchase_price) * 100);
    }
@endphp

<div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
    
    <figure class="position-relative">

        @if($discount > 0)
            <span class="discount-badge">
                {{ $discount }}% OFF
            </span>
        @endif

        <a href="{{ url('product/'.$item->slug) }}">
            <img src="{{ static_asset($item->thumbnail) }}" width="280" height="280" alt="{{ $item->name }}">
            <img src="{{ static_asset($item->thumbnail) }}" width="280" height="280" alt="{{ $item->name }}">
        </a>
    </figure>

    <div class="product-details">
        <h3 class="product-title">
            <a href="{{ url('product/'.$item->slug) }}">{{ $item->name }}</a>
        </h3>

        <div class="ratings-container">
            <div class="product-ratings">
                <span class="ratings" style="width:100%"></span>
            </div>
        </div>

        <div class="price-box">
            <del class="old-price">₹{{ number_format($item->purchase_price,2) }}</del>
            <span class="product-price">₹{{ number_format($item->offer_price,2) }}</span>
        </div>

        <div class="product-action">
            <a href="{{ url('product/'.$item->slug) }}" class="btn-icon-wish">
                <i class="icon-heart"></i>
            </a>

            <a href="javascript:void(0)"
			   class="btn-icon btn-add-cart addToCartBtn"
			   data-id="{{ $item->id }}">
				<i class="fa fa-shopping-cart"></i>
				<span>Add To Cart</span>
			</a>

            <a href="{{ url('product/'.$item->slug) }}" class="btn-quickview">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>
</div>