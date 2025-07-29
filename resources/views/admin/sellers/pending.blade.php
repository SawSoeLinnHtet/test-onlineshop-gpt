{{-- resources/views/admin/sellers/pending.blade.php --}}
@extends('layouts.admin')

@section('title','Pending Sellers')

@section('content')
  <h1>Pending Seller Applications</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th><th>Name</th><th>Email</th><th>Bio</th><th>Applied At</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $u)
          <tr>
            <td>{{ $u->id }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ \Illuminate\Support\Str::limit($u->seller_bio,50) }}</td>
            <td>{{ $u->created_at->format('Y-m-d') }}</td>
            <td>
              <form action="{{ route('admin.sellers.approve',$u) }}" method="POST" style="display:inline">
                @csrf @method('PATCH')
                <button class="btn btn-success btn-sm"
                        onclick="return confirm('Approve this seller?')">Approve</button>
              </form>
              <form action="{{ route('admin.sellers.ban',$u) }}" method="POST" style="display:inline">
                @csrf @method('PATCH')
                <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Reject this application?')">Reject</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" class="text-center">No pending applications.</td></tr>
        @endforelse
      </tbody>
    </table>
    <div class="card-footer">
      {{ $users->links() }}
    </div>
  </div>
@endsection
