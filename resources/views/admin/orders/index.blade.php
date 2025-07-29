@extends('layouts.admin')

@section('title','Orders')

@section('breadcrumbs')
<ol class="breadcrumb mb-0">
  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
  <li class="breadcrumb-item active">Orders</li>
</ol>
@endsection

@section('content')
<div class="card">
  <div class="card-header"><h5>All Orders</h5></div>
  <div class="card-body p-0">
    <table class="table table-hover mb-0">
      <thead class="table-light">
        <tr>
          <th>Voucher</th>
          <th>User</th>
          <th>Total</th>
          <th>Status</th>
          <th>Date</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse($orders as $o)
        <tr>
          <td>{{ $o->voucherNo }}</td>
          <td>{{ $o->user->name }}</td>
          <td>{{ number_format($o->total,2) }}</td>
          <td>{{ ucfirst($o->status) }}</td>
          <td>{{ $o->created_at->format('Y-m-d') }}</td>
          <td>
            <!-- Detail Button -->
            <a href="{{ route('admin.orders.show', $o->id) }}" class="btn btn-sm btn-primary">
              Details
            </a>

            <!-- Cancel Button (form for POST method) -->
            @if($o->status !== 'cancelled')
              <a href="{{ route('admin.orders.cancel', $o->id) }}" class="btn btn-sm btn-danger">
                Cancel    
              </a>
            @endif
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center">No orders found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="card-footer">{{ $orders->links() }}</div>
</div>
@endsection
