@extends('layouts.admin')

@section('title','Products')

@section('breadcrumbs')
<ol class="breadcrumb mb-0">
  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
  <li class="breadcrumb-item active">Products</li>
</ol>
@endsection

@section('content')
<div class="card">
  <div class="card-header"><h5>All Products</h5></div>
  <div class="card-body p-0">
    <table class="table table-hover mb-0">
      <thead class="table-light">
        <tr>
          <th>ID</th><th>Name</th><th>Seller</th><th>Category</th><th>Price</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($items as $i)
          <tr>
            <td>{{ $i->id }}</td>
            <td>{{ $i->name }}</td>
            <td>{{ $i->user?->name    ?? '—' }}</td>
            <td>{{ $i->category?->name ?? '—' }}</td>
            <td>{{ number_format($i->price,2) }}</td>
            <td><!-- …actions… --></td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center">No products found.</td>
          </tr>
        @endforelse
      </tbody>

    </table>
  </div>
  <div class="card-footer">{{ $items->links() }}</div>
</div>
@endsection
