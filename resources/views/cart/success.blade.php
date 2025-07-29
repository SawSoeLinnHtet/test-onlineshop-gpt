@extends('layouts.front-end')
@section('content')
<div class="container mt-5">
  <h2>Thank You!</h2>
  <p>Your order has been placed. Your voucher number is <strong>{{ $order->voucherNo }}</strong>.</p>

  <h4>Order Details</h4>
  <table class="table">
    <thead><tr>
      <th>Product</th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Subtotal</th>
    </tr></thead>
    <tbody>
      @foreach($order->orderItems as $i)
      <tr>
        <td>{{ $i->item->name }}</td>
        <td>{{ $i->quantity }}</td>
        <td>{{ number_format($i->item->price, 2) }}</td>
        <td>{{ number_format($i->quantity * $i->item->price, 2) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <a href="{{ route('shop.home') }}" class="btn btn-primary">Continue Shopping</a>
</div>
@endsection
