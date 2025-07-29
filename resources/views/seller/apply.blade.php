@extends('layouts.front-end')
@section('content')
<div class="container mt-5">
  <h2>Become a Seller</h2>
  <form action="{{route('seller.apply.submit')}}" method="POST">
    @csrf
    <div class="mb-3">
      <label>Your Bio / Store Description</label>
      <textarea name="seller_bio" class="form-control" required>{{old('seller_bio')}}</textarea>
      @error('seller_bio')<div class="text-danger">{{$message}}</div>@enderror
    </div>
    <button class="btn btn-primary">Submit Application</button>
  </form>
</div>
@endsection
