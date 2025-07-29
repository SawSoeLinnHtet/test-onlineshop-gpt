<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems.item')->orderBy('created_at','desc')->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['orderItems.item', 'user', 'payment'])->find($id);
        
        return view('admin.orders.show', compact('order'));
    }

    public function pendingToProcessing($id)
    {
        $order = Order::find($id);
        $order->update(['status' => 'processing']);

        return back();
    }

    public function processingToShipped($id)
    {
        $order = Order::find($id);
        $order->update(['status' => 'shipped']);

        return back();
    }

    public function shippedToDelivered($id)
    {
        $order = Order::find($id);
        $order->update(['status' => 'delivered']);

        return back();
    }

    public function cancel($id)
    {
        $order = Order::find($id);
        $order->update(['status' => 'cancelled']);

        return back();
    }
}
