@extends('layouts.front-end')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
  <div class="card shadow-lg" style="max-width: 420px; width: 100%;">
    <div class="card-header bg-primary text-white position-relative">
        {{-- ① Close “X” in the top-right --}}
        <button
          type="button"
          class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
          aria-label="Close"
          onclick="window.location='{{ route('shop.home') }}'"></button>

  {{-- ② Your existing titles --}}
  <h3 class="my-2 text-center">Welcome Back</h3>
  <p class="small text-center mb-0">Log in to continue shopping</p>
</div>
    <div class="card-body p-4">
      <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            class="form-control @error('email') is-invalid @enderror"
            required autofocus
          >
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Password --}}
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            class="form-control @error('password') is-invalid @enderror"
            required
          >
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Remember --}}
        <div class="mb-3 form-check">
          <input
            type="checkbox"
            id="remember"
            name="remember"
            class="form-check-input"
            {{ old('remember') ? 'checked' : '' }}
          >
          <label class="form-check-label" for="remember">
            Remember me
          </label>
        </div>

        {{-- Submit --}}
        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-primary btn-lg">
            Log In
          </button>
        </div>

        {{-- Forgot & Register --}}
        <div class="d-flex justify-content-between">
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="small">
              Forgot your password?
            </a>
          @endif
          <a href="{{ route('register') }}" class="small">
            Create an account
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
