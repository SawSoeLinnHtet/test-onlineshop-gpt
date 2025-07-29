<?php

namespace App\Http\Controllers;

use App\Models\Item; 
use App\Models\Order; 
use App\Models\OrderItem;
use App\Models\Payment;   
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Show current cart
    public function index()
    {
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Add an item
    public function add(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $qty  = max(1, (int)$request->input('quantity', 1));
        $cart = session('cart', []);
        

        // increment if already in cart
        $cart[$id] = [
            'id'       => $item->id,
            'name'     => $item->name,
            'price'    => $item->price,
            'quantity' => ($cart[$id]['quantity'] ?? 0) + $qty,
            'image'    => $item->image,
        ];

        session(['cart' => $cart]);

        return back()->with('success', 'Added to cart.');
    }

    // Remove one item entry
    public function remove($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Item removed.');
    }

    // Clear entire cart
    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Cart cleared.');
    }

    // Show the checkout form
    public function checkout()
    {
        $cart     = session('cart', []);
        $payments = Payment::all();
        return view('cart.checkout', compact('cart','payments'));
    }

    // Handle final order placement
    public function placeOrder(Request $request)
    {
        $request->validate([
            'paymentID'        => 'required|exists:payments,id',
            'paymentSlip'      => 'required|string|max:255',
            'shipping_name'    => 'required|string|max:255',
            'shipping_address' => 'required|string',
            'shipping_phone'   => 'required|string|max:20',
        ]);

        $cart = session('cart', []);

        $totalPrice = 0;

        foreach ($cart as $item) {
            $totalPrice += (int) $item['price'] * (int) $item['quantity'];
        }
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error','Your cart is empty.');
        }

        // store slip if uploaded

        $voucher = Str::uuid()->toString();

        $order = Order::create([
            'userID'           => auth()->id(),
            'voucherNo'        => $voucher,
            'total'            => $totalPrice,
            'paymentSlip'      => $request->paymentSlip,
            'paymentID'        => $request->paymentID,
            'shipping_name'    => $request->shipping_name,
            'shipping_address' => $request->shipping_address,
            'shipping_phone'   => $request->shipping_phone,
        ]);
            
        foreach ($cart as $i => $c) {
            OrderItem::create([
                'order_id' => $order->id,
                'item_id'  => $c['id'],
                'quantity' => $c['quantity'],
                'price'    => $c['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('cart.success', $voucher);
    }

    // Show a simple confirmation page
    public function success($voucher)
    {
        $order = Order::where('voucherNo', $voucher)->with('orderItems.item')->firstOrFail();
        
        return view('cart.success', compact('order'));
    }
}
