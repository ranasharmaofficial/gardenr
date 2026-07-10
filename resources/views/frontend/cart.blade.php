@extends('frontend.layouts.master')
@section('title') Home @endsection

@section('meta_tags')

@endsection
@section('content')

   
		<main class="main">
			<div class="container">
				<ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
					<li class="active">
						<a href="{{ url('cart') }}">Shopping Cart</a>
					</li>
					<li>
						<a href="{{ url('checkout') }}">Checkout</a>
					</li>
					<li class="disabled">
						<a href="javascript:(0)">Order Complete</a>
					</li>
				</ul>

				<div class="row">
					<div class="col-lg-8">
						<div class="cart-table-container">
							<table class="table table-cart">
								<thead>
									<tr>
										<th class="thumbnail-col"></th>
										<th class="product-col">Product</th>
										<th class="price-col">Price</th>
										<th class="qty-col">Quantity</th>
										<th class="text-right">Subtotal</th>
									</tr>
								</thead>
								<tbody id="cartBody">

									@php
									$total = 0;
									@endphp

									@foreach($cartItems as $cart)

									@php
									$subtotal = $cart->price * $cart->qty;
									$total += $subtotal;
									@endphp

									<tr class="product-row" id="row{{ $cart->id }}" data-price="{{ $cart->price }}">

										<td>
											<figure class="product-image-container">

												<a href="#" class="product-image">
													<img src="{{ static_asset($cart->product->thumbnail) }}">
												</a>

												<a href="javascript:void(0)"
												   class="btn-remove icon-cancel removeCartItem"
												   data-id="{{ $cart->id }}">
												</a>

											</figure>
										</td>

										<td class="product-col">
											<h5 class="product-title">
												{{ $cart->product->name }}
											</h5>
										</td>

										<td>
											₹{{ number_format($cart->price,2) }}
										</td>

												   
										<td>
											<div class="product-single-qty">
												<input value="{{ $cart->qty }}"
												   data-cart-id="{{ $cart->id }}" class="horizontal-quantity cartQtyInput form-control" type="text" min="1">
											</div><!-- End .product-single-qty -->
										</td>

										<td class="text-right">

											₹<span class="itemSubtotal{{ $cart->id }}">
												{{ number_format($subtotal,2) }}
											</span>

										</td>

									</tr>

									@endforeach

								</tbody>


								 
							</table>
						</div><!-- End .cart-table-container -->
					</div><!-- End .col-lg-8 -->

					<div class="col-lg-4">
						<div class="cart-summary">
							<h3>CART TOTALS</h3>

							<table class="table table-totals">
								<tbody>

									<tr>
										<td>Subtotal</td>
										<td>
											₹<span id="cartTotal">
												{{ number_format($total,2) }}
											</span>
										</td>
									</tr>

									</tbody>

									<tfoot>
									<tr>
										<td>Total</td>
										<td>
											₹<span id="grandTotal">
												{{ number_format($total,2) }}
											</span>
										</td>
									</tr>
									</tfoot>
							</table>

							<div class="checkout-methods">
								<a href="{{ url('checkout') }}" class="btn btn-block btn-dark">Proceed to Checkout
									<i class="fa fa-arrow-right"></i></a>
							</div>
						</div><!-- End .cart-summary -->
					</div><!-- End .col-lg-4 -->
				</div><!-- End .row -->
			</div><!-- End .container -->

			<div class="mb-6"></div><!-- margin -->
		</main><!-- End .main -->
@endsection
