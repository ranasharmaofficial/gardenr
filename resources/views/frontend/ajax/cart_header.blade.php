@php
    $count = $count ?? 0;
    $subtotal = $subtotal ?? 0;
    $cartItems = $cartItems ?? collect();
@endphp


    <div class="dropdown-cart-header">
		Shopping Cart
	</div>

		<div class="dropdown-cart-products">
			@foreach($cartItems as $cart)

                <div class="product">
					<div class="product-details">
						<h4 class="product-title">
                            {{ $cart->product->name }}
                        </h4>
						<span class="cart-product-info">
							<span class="cart-product-qty">
                                {{ $cart->qty }}
                            </span>

                            × ₹{{ $cart->price }}

                        </span>

                    </div>

                    <figure class="product-image-container">

                        <img
                        src="{{ static_asset($cart->product->thumbnail) }}"
                        width="80">

                    </figure>

                </div>
			@endforeach

		</div>

<div class="dropdown-cart-total">
    <span>SUBTOTAL:</span>
    <span class="cart-total-price float-right">
        ₹{{ number_format($subtotal,2) }}
    </span>
</div>

<div class="dropdown-cart-action">
    <a href="{{ url('cart') }}" style="color:#000;" class="btn btn-gray btn-block">
        View Cart
    </a>

    <a href="{{ url('checkout') }}" class="btn btn-dark btn-block">
        Checkout
    </a>
</div>

<input type="hidden" id="cartCountValue" value="{{ $count }}">




           
