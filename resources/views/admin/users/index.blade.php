@extends('layouts.admin')

@section('title','Users')

@section('breadcrumbs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb mb-0">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Users</li>
  </ol>
</nav>
@endsection

@section('content')
<div class="card">
  <div class="card-header">
    <h5>All Users</h5>
  </div>
  <div class="card-body p-0">
    <table class="table table-hover mb-0">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Seller?</th>
          <th>Admin?</th>
          <th>Joined</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $u)
        <tr>
          <td>{{ $u->id }}</td>
          <td>{{ $u->name }}</td>
          <td>{{ $u->email }}</td>
          <td>
            @if($u->seller_status === 'approved')
              <span class="badge bg-success">Yes</span>
            @else
              <span class="badge bg-secondary">No</span>
            @endif
          </td>
          <td>
            @if($u->is_admin)
              <span class="badge bg-primary">Yes</span>
            @else
              <span class="badge bg-secondary">No</span>
            @endif
          </td>
          <td>{{ $u->created_at->format('Y-m-d') }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center">No users found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- pagination --}}
  <div class="card-footer">
    {{ $users->links() }}
  </div>
</div>
@endsection
