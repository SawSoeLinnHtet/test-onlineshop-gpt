@extends('layouts.front-end')

@section('content')
<div class="container mt-5">
  <h2>Your Cart</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if($cart)
    <table class="table">
      <thead>
        <tr><th>Product</th><th>Qty</th><th>Price</th><th>Subtotal</th><th></th></tr>
      </thead>
      <tbody>
        @foreach($cart as $id => $c)
          <tr>
            <td>{{ $c['name'] }}</td>
            <td>{{ $c['quantity'] }}</td>
            <td>{{ number_format($c['price'],2) }}</td>
            <td>{{ number_format($c['price'] * $c['quantity'],2) }}</td>
            <td>
              <form action="{{ route('cart.remove', $id) }}" method="POST">
                @csrf
                <button class="btn btn-sm btn-danger">Remove</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="d-flex justify-content-between">
      <form action="{{ route('cart.clear') }}" method="POST">
        @csrf
        <button class="btn btn-outline-secondary">Clear Cart</button>
      </form>

      <!-- Checkout button -->
      <a href="{{ route('cart.checkout') }}"
         class="btn btn-success">
        Proceed to Checkout
      </a>
    </div>
  @else
    <p>Your cart is empty.</p>
  @endif
</div>
@endsection
