@extends('layouts.admin')
@section('title','Reports')
@section('breadcrumbs')
<ol class="breadcrumb"><li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li><li class="breadcrumb-item active">Reports</li></ol>
@endsection
@section('content')
<div class="alert alert-info">
  🎯 Reports coming soon!<br>
  You might chart revenue, top products, new users, etc.
</div>
@endsection
