{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title','Dashboard')

@section('breadcrumbs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb mb-0">
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
  </ol>
</nav>
@endsection

@section('content')
  <div class="row g-4">

    {{-- Total Revenue --}}
    <div class="col-sm-6 col-xl-3">
      <div class="card text-white bg-primary h-100">
        <div class="card-body d-flex flex-column justify-content-center text-center">
          <h2 class="fw-bold mb-0">฿0</h2>
          <div>Total Revenue</div>
        </div>
      </div>
    </div>

    {{-- Orders Today --}}
    <div class="col-sm-6 col-xl-3">
      <div class="card text-white bg-success h-100">
        <div class="card-body d-flex flex-column justify-content-center text-center">
          <h2 class="fw-bold mb-0">0</h2>
          <div>Orders Today</div>
        </div>
      </div>
    </div>

    {{-- New Users --}}
    <div class="col-sm-6 col-xl-3">
      <div class="card text-white bg-warning h-100">
        <div class="card-body d-flex flex-column justify-content-center text-center">
          <h2 class="fw-bold mb-0">0</h2>
          <div>New Users</div>
        </div>
      </div>
    </div>

    {{-- Pending Sellers --}}
    <div class="col-sm-6 col-xl-3">
      <div class="card text-white bg-danger h-100">
        <div class="card-body d-flex flex-column justify-content-center text-center">
          <h2 class="fw-bold mb-0">0</h2>
          <div>Pending Sellers</div>
        </div>
      </div>
    </div>

  </div>
@endsection
