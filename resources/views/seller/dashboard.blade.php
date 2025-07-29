@extends('layouts.front-end')

@section('content')
<div class="container mt-5">
  <h2>Seller Dashboard</h2>
  <p>Welcome, {{ auth()->user()->name }}! Here’s where you’ll manage your products and orders.</p>
  <!-- Later: links to your CRUD pages -->
</div>
@endsection
