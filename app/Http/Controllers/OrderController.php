<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  
use App\Models\Order;

class OrderController extends Controller
{
   // Ensure only logged-in users can view their orders
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show a list of this user’s orders, grouped by voucher
    public function index()
    {
        $orders = Order::where('userID', Auth::id())
                       ->with('orderItems.item')
                       ->orderBy('created_at','desc')
                       ->get();

        return view('orders.index', compact('orders'));
    }
    public function cancelOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $update_order = $order->update(['status' => 'cancelled',]);
         
        return back()->with('success','Order cancelled. Thanks for your feedback!');
    }
}
