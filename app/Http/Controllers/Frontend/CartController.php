<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\UserLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function cartPage()
    {
        $cartItems = Cart::with('product')
                    ->where('session_id', session()->getId())
                    ->get();

        return view('frontend.cart', compact('cartItems'));
    }

    public function checkoutPage()
    {
        $cartItems = Cart::with('product')
                    ->where('session_id', session()->getId())
                    ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.page')->with('alert-danger', 'Your cart is empty');
        }

        $subtotal = $cartItems->sum(function($item){ return $item->qty * $item->price; });
        $shipping_charge = $subtotal < 1000 ? 40.00 : 0.00;
        $total = $subtotal + $shipping_charge;

        $address = null;
        if (auth()->check()) {
            $address = UserAddress::where('user_id', auth()->id())->latest()->first();
        }

        return view('frontend.checkout', compact('cartItems', 'subtotal', 'shipping_charge', 'total', 'address'));
    }

    public function saveCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits:10',
            'email' => 'nullable|email|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:2000',
            'pincode' => 'required|digits:6',
            'payment_method' => 'required|string|in:COD',
        ]);

        $cartItems = Cart::with('product')
                    ->where('session_id', session()->getId())
                    ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.page')->with('alert-danger', 'Your cart is empty');
        }

        $subtotal = $cartItems->sum(function($item){ return $item->qty * $item->price; });
        $shipping_charge = $subtotal < 1000 ? 40.00 : 0.00;
        $total_order_value = $subtotal + $shipping_charge;

        $order = DB::transaction(function () use ($request, $cartItems, $total_order_value, $shipping_charge) {
            $user = User::where('mobile', $request->mobile)->first();

            if (!$user && $request->filled('email')) {
                $user = User::where('email', $request->email)->first();
            }

            if (!$user) {
                $email = $request->filled('email')
                    ? $request->email
                    : 'customer-' . $request->mobile . '-' . Str::lower(Str::random(5)) . '@gardenr.local';

                $user = User::create([
                    'first_name' => $request->name,
                    'last_name' => '',
                    'email' => $email,
                    'mobile' => $request->mobile,
                    'status' => 1,
                    'user_type_id' => 2,
                    'user_designation_id' => 2,
                ]);

                UserLogin::create([
                    'user_id' => $user->id,
                    'username' => $user->email,
                    'password' => Hash::make($request->mobile),
                    'status' => 1,
                    'user_type_id' => 2,
                ]);
            }

            $userAddress = UserAddress::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'state' => $request->state,
                'city' => $request->city,
                'address' => $request->address,
                'pincode' => $request->pincode,
            ]);

            $order_code = 'ORD-' . strtoupper(Str::random(10));
            while (Order::where('order_code', $order_code)->exists()) {
                $order_code = 'ORD-' . strtoupper(Str::random(10));
            }

            $order = Order::create([
                'order_code' => $order_code,
                'user_id' => $user->id,
                'address_id' => $userAddress->id,
                'total_order_value' => $total_order_value,
                'payment_method' => $request->payment_method,
                'shipping_charge' => $shipping_charge,
                'status' => 'pending',
            ]);

            foreach ($cartItems as $item) {
                OrderDetails::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->qty,
                    'price' => $item->price,
                    'total' => $item->qty * $item->price,
                    'status' => 'pending',
                ]);
            }

            Cart::where('session_id', session()->getId())->delete();
            auth()->login($user);

            return $order;
        });

        try {
            $order->load(['user', 'address', 'orderDetails.product']);
            if ($order->user && filter_var($order->user->email, FILTER_VALIDATE_EMAIL) && !Str::endsWith($order->user->email, '@gardenr.local')) {
                \Illuminate\Support\Facades\Mail::to($order->user->email)->send(new \App\Mail\OrderPlacedMail($order));
            }
        } catch (\Exception $e) {
            // Email should never block a successfully placed COD order.
        }

        return redirect()->route('checkout.success', ['order_code' => $order->order_code])
                         ->with('alert-success', 'Order placed successfully!');
    }

    public function checkoutSuccess($order_code)
    {
        $order = Order::with(['address', 'orderDetails.product'])
                    ->where('order_code', $order_code)
                    ->firstOrFail();

        return view('frontend.order_success', compact('order'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $cart = Cart::where('session_id', session()->getId())
                    ->where('product_id', $product->id)
                    ->first();

        $qty = max(1, intval($request->qty ?? 1));

        if($cart){
            $cart->qty = $cart->qty + $qty;
            $cart->save();
        }else{
            Cart::create([
                'session_id' => session()->getId(),
                'product_id' => $product->id,
                'qty' => $qty,
                'price' => $product->offer_price
            ]);
        }

        return response()->json([
            'status' => true
        ]);
    }

    public function cartHeader()
    {
        $cartItems = Cart::with('product')
                    ->where('session_id', session()->getId())
                    ->get();

        $count = $cartItems->sum('qty');
        $subtotal = $cartItems->sum(function($item){
            return $item->qty * $item->price;
        });

        return view('frontend.ajax.cart_header',compact(
            'cartItems',
            'count',
            'subtotal'
        ));
    }

    public function updateQty(Request $request)
    {
        $cart = Cart::where('session_id', session()->getId())
                    ->where('id', $request->cart_id)
                    ->first();
        if($cart)
        {
            $cart->qty = max(1, intval($request->qty));
            $cart->save();
        }
        return response()->json([
            'status' => true
        ]);
    }


    public function removeItem(Request $request)
    {
        Cart::where('session_id', session()->getId())
            ->where('id',$request->cart_id)
            ->delete();
        return response()->json([
            'status' => true
        ]);
    }

}
