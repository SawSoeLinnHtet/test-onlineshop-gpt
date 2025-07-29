@extends('layouts.front-end')
@section('content')
<div class="container mt-5 mb-5">
  <h3 class="mb-5">Checkout</h3>
  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <form action="{{ route('cart.placeOrder') }}" method="POST" enctype="multipart/form-data" class="mt-2">
    @csrf

    {{-- Order Summary --}}
    <h5 class="fw-bolder">Order Summary</h5>
    <table class="table border mb-3">
      <thead>
        <tr>
          <th>Product</th>
          <th>Qty</th>
          <th>Price</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        @foreach($cart as $c)
        <tr>
          <td>{{ $c['name'] }}</td>
          <td>{{ $c['quantity'] }}</td>
          <td>{{ number_format($c['price'],2) }}</td>
          <td>{{ number_format($c['price']*$c['quantity'],2) }}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th colspan="3">Total</th>
          <th>{{ number_format(collect($cart)->sum(fn($c)=> $c['price']*$c['quantity']),2) }}</th>
        </tr>
      </tfoot>
    </table>

    <hr>

    {{-- Shipping Info --}}
    <h5 class="fw-bolder">Shipping Information</h5>
    <div class="mb-3 mt-3">
      <label for="shipping_name" class="form-label">Name</label>
      <input type="text" name="shipping_name" id="shipping_name"
             class="form-control" value="{{ old('shipping_name') }}" required>
      @error('shipping_name')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label for="shipping_address" class="form-label">Address</label>
      <textarea name="shipping_address" id="shipping_address"
                class="form-control" required>{{ old('shipping_address') }}</textarea>
      @error('shipping_address')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label for="shipping_phone" class="form-label">Phone</label>
      <input type="text" name="shipping_phone" id="shipping_phone"
             class="form-control" value="{{ old('shipping_phone') }}" required>
      @error('shipping_phone')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    <hr>
    {{-- Payment --}}
    <h5 class="fw-bolder">Payment</h5>
    <div class="mb-3 mt-3">
      <label for="paymentID" class="form-label">Method</label>
      <select name="paymentID" id="paymentID" class="form-select" required>
        <option value="">— Select —</option>
        @foreach($payments as $p)
          <option value="{{ $p->id }}">{{ $p->name . ' - ' . $p->account_name . ' ( ' . $p->account_number . ' ) ' }}</option>
        @endforeach
      </select>
      @error('paymentID')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label for="paymentSlip" class="form-label">Upload Slip</label>
      <input type="text" name="paymentSlip" id="paymentSlip" class="form-control">
      @error('paymentSlip')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <button type="submit" class="btn btn-success">Place Order</button>
  </form>
</div>
@endsection
