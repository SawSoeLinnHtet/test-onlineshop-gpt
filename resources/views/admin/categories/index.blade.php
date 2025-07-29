@extends('layouts.admin')
@section('title','Categories')
@section('breadcrumbs')
<ol class="breadcrumb"><li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li><li class="breadcrumb-item active">Categories</li></ol>
@endsection
@section('content')
<div class="card">
  <div class="card-header"><h5>All Categories</h5></div>
  <div class="card-body p-0">
    <table class="table mb-0">
      <thead class="table-light"><tr><th>ID</th><th>Name</th><th>Slug</th><th>Created</th></tr></thead>
      <tbody>
        @forelse($categories as $c)
        <tr>
          <td>{{ $c->id }}</td>
          <td>{{ $c->name }}</td>
          <td>{{ $c->slug }}</td>
          <td>{{ $c->created_at->format('Y-m-d') }}</td>
        </tr>
        @empty
        <tr><td colspan="4" class="text-center">No categories found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="card-footer">{{ $categories->links() }}</div>
</div>
@endsection
