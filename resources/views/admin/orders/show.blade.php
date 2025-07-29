@extends('layouts.admin')

@section('title','Orders')

@section('breadcrumbs')
<ol class="breadcrumb mb-0">
  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
  <li class="breadcrumb-item active">Orders Details</li>
</ol>
@endsection

@section('content')
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center gap-4 ml-2">
        <h4>Order #{{ $order->id }}</h4>
        <span class="text-sm badge" style="background-color: gray">
          {{ $order->voucherNo }}
        </span>
      </div>
      <div>
        @if($order->status == 'pending')
          <a href="{{ route('admin.orders.processing', $order->id) }}" class="btn btn-sm btn-secondary text-white">
            Order Confirmed
          </a>
        @elseif($order->status == 'processing')
          <a href="{{ route('admin.orders.shipped', $order->id) }}" class="btn btn-sm btn-info text-white">
            Order Shipping
          </a>
        @elseif($order->status == 'shipped')
          <a href="{{ route('admin.orders.delivered', $order->id) }}" class="btn btn-sm btn-warning text-white">
            Order Delivered
          </a>
        @elseif($order->status == 'delivered')
          <p class="btn btn-sm btn-success text-white">
            Order Completed
          </p>
        @else
            <p class="btn btn-sm btn-danger text-white">
              Order Cancelled
            </p>
        @endif
      </div>
    </div>

    <div class="card-body">
      {{-- <div class="py-3">
        
      </div> --}}
      <div>
        <h5 class="mb-3">Customer Info</h5>
        <p><strong>Name:</strong> {{ $order->user->name }}</p>
        <p><strong>Email:</strong> {{ $order->user->email }}</p>
      </div>

      <hr>

      <div>
        <h5 class="mt-4 mb-3">Shipping Info</h5>
        <p><strong>Name:</strong> {{ $order->shipping_name }}</p>
        <p><strong>Address:</strong> {{ $order->shipping_address }}</p>
        <p><strong>Phone:</strong> {{ $order->shipping_phone }}</p>
      </div>

      <hr>

      <div>
        <h5 class="mt-4 mb-3">Payment</h5>
        <p><strong>Payment with:</strong> {{ $order->payment->name }}</p>
        <p><strong>Payslip:</strong> {{ $order->paymentSlip }}</p>
      </div>

      <hr>

      <h5 class="mt-4 mb-3">Order Items</h5>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @foreach($order->orderItems as $index => $i)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $i->item->name }}</td>
            <td>{{ $i->quantity }}</td>
            <td>{{ number_format($i->price) }}</td>
            <td>{{ number_format($i->quantity * $i->price) }}</td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4" class="text-end">Total:</th>
            <th>{{ number_format($order->total) }}</th>
          </tr>
          <tr>
            <th colspan="4" class="text-end">Status:</th>
            <th>
              @if($order->status == 'pending')
                <p class="badge badge-sm badge-secondary text-white mt-2">
                  Pending
                </p>
              @elseif($order->status == 'processing')
                <a href="#" class="btn btn-sm btn-info text-white mt-2">
                  Order Processing
                </a>
              @elseif($order->status == 'shipped')
                <p class="btn btn-sm btn-warning text-white mt-2">
                  Order Shipped
                </p>
              @elseif($order->status == 'delivered')
                <p class="btn btn-sm btn-success text-white mt-2">
                  Order Completed
                </p>
              @else
                <p class="btn btn-sm btn-danger text-white mt-2">
                  Order Cancelled
                </p>
              @endif
            </th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
@endsection
