@extends('layouts.front-end')

@section('content')
<div class="container mt-5">
  <h2 class="mb-5">My Orders</h2>

  @forelse($orders as $index => $order)
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <div>
          Voucher: <strong>{{ $order->voucherNo }}</strong>
        </div>
        <div class="d-flex align-items-center justify-content-between gap-3">
          <span class="text-muted float-end">
            {{ $order->created_at->fromNow() }}
          </span>
          @if($order->status === 'pending')
            <span class="badge text-black" style="background-color: gray; text-transform: capitalize;">{{ $order->status }}</span>
          @elseif($order->status === 'processing')
            <span class="badge text-black" style="background-color: skyblue; text-transform: capitalize;">{{ $order->status }}</span>
          @elseif($order->status === 'shipped')
            <span class="badge" style="background-color: orange; text-transform: capitalize; color: white;">{{ $order->status }}</span>  
          @elseif ($order->status === 'delivered')
            <span class="badge" style="background-color: green; text-transform: capitalize; color: white;">{{ $order->status }}</span>
          @else
            <span class="badge" style="background-color: red; text-transform: capitalize; color: white;">{{ $order->status }}</span> 
          @endif

        </div>
      </div>
      <div class="card-body">
        <table class="table mb-0">
          <thead>
            <tr>
              <th>Product</th>
              <th>Qty</th>
              <th>Unit Price</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
            @foreach($order->orderItems as $i)
              <tr>
                <td>{{ $i->item->name }}</td>
                <td>{{ $i->quantity }}</td>
                <td>{{ number_format($i->item->price,2) }} MMK</td>
                <td>{{ number_format($i->quantity * $i->item->price,2) }} MMK</td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            @if ($order->status !==  'cancelled')
              <tr>
                <td colspan="3">

                </td>
                <td>
                    <a href="{{ route('orders.cancel', $order->id) }}" class="btn btn-danger">
                      Cancel
                    </a>
                </td>
              </tr>
            @endif
          </tfoot>
        </table>
      </div>
      {{-- <div class="card-footer text-end">
        @if($group->first()->status === 'pending')
          <button 
            type="button" 
            class="btn btn-sm btn-outline-danger"
            data-bs-toggle="modal"
            data-bs-target="#cancelModal-{{ $voucher }}"
          >
            Cancel Order
          </button>
        @else
          <span class="badge bg-secondary">{{ ucfirst($group->first()->status) }}</span>
        @endif
      </div> --}}
    </div>
  @empty
    <p>You haven’t placed any orders yet.</p>
  @endforelse
</div>

{{-- Two-step Cancel Modals --}}
@foreach($orders as $voucher => $group)
  <div 
    class="modal fade" 
    id="cancelModal-{{ $voucher }}" 
    tabindex="-1" 
    aria-hidden="true"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        {{-- Step 1 --}}
        <div class="step1 modal-body text-center p-4">
          <h5>Cancel Order {{ $voucher }}?</h5>
          <p>Are you sure?</p>
          <button 
            type="button" 
            class="btn btn-secondary me-2" 
            data-bs-dismiss="modal"
          >No</button>
          <button 
            type="button" 
            class="btn btn-danger" 
            id="confirm-{{ $voucher }}"
          >Yes</button>
        </div>

        {{-- Step 2 --}}
        <div class="step2 modal-body p-4" style="display:none;">
          <h5>Please let us know why:</h5>
          <form 
            action="{{ route('orders.cancel', $voucher) }}" 
            method="POST"
          >
            @csrf @method('PATCH')
            <textarea
              name="reason"
              class="form-control mb-3"
              rows="3"
              placeholder="Your reason…"
              required
            ></textarea>
            <div class="text-end">
              <button 
                type="button" 
                class="btn btn-outline-secondary me-2" 
                id="back-{{ $voucher }}"
              >Back</button>
              <button type="submit" class="btn btn-danger">
                Submit 
              </button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
@endforeach
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    @foreach($orders as $voucher => $group)
      document.getElementById('confirm-{{ $voucher }}')
        .addEventListener('click', function() {
          let m = document.getElementById('cancelModal-{{ $voucher }}');
          m.querySelector('.step1').style.display = 'none';
          m.querySelector('.step2').style.display = 'block';
        });

      document.getElementById('back-{{ $voucher }}')
        .addEventListener('click', function() {
          let m = document.getElementById('cancelModal-{{ $voucher }}');
          m.querySelector('.step2').style.display = 'none';
          m.querySelector('.step1').style.display = 'block';
        });
    @endforeach
  });
</script>
@endpush
