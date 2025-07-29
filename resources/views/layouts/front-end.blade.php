<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Homepage - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <!-- Core theme CSS (includes Bootstrap)-->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body class="d-flex flex-column min-vh-100">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="{{route('shop.home')}}">One&All</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{route('shop.home')}}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li>
                    </ul>

                    <div class="d-flex align-items-center">
                      @php
                        $totalItems = collect(session('cart', []))->sum('quantity');
                      @endphp

                      {{-- ① Login / Register for guests --}}
                      @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">
                          Login
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary me-4">
                          Register
                        </a>
                      @endguest

                      {{-- ② “Become a Seller” / “Seller Dashboard” --}}
                      @auth
                        @if(auth()->user()->is_seller)
                          <a href="{{ route('seller.dashboard') }}" class="btn btn-outline-primary me-3">
                            Seller Dashboard
                          </a>
                        @else
                          <a href="{{ route('seller.apply') }}" class="btn btn-outline-primary me-3">
                            Become a Seller
                          </a>
                        @endif
                      @endauth

                      {{-- ③ My Orders --}}
                      @auth
                        <div class="me-3">
                          <a class="nav-link text-center" href="{{ route('orders.index') }}">
                            My Orders
                          </a>
                        </div>
                      @endauth

                      {{-- ④ Cart --}}
                      <div class="me-3">
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-dark">
                          <i class="bi-cart-fill me-1"></i>
                          Cart
                          <span class="badge bg-dark text-white ms-1 rounded-pill">
                            {{ $totalItems }}
                          </span>
                        </a>
                      </div>

                      {{-- ⑤ Logout for authenticated users --}}
                      @auth
                        <form action="{{ route('logout') }}" method="POST" class="d-inline me-3">
                          @csrf
                          <button type="submit" class="btn btn-outline-danger">
                            Logout
                          </button>
                        </form>
                      @endauth
                    </div>

                </div>
            </div>
        </nav>
        <main class="flex-grow-1">
          @yield('content')
        </main>
        <!-- Footer-->
        <footer class="py-5 bg-dark mt-auto">
          <div class="container">
            <p class="m-0 text-center text-white">&copy; Your Website 2023</p>
          </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    <!-- 1) Login Prompt Modal -->
  <div class="modal fade" id="loginPromptModal" tabindex="-1" aria-labelledby="loginPromptLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginPromptLabel">Please log in</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          You need to be logged in to add items to your cart.
        </div>
        <div class="modal-footer">
          <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
          <a href="{{ route('register') }}" class="btn btn-outline-secondary">Register</a>
        </div>
      </div>
    </div>
  </div>

  <!-- 2) Logout Success Modal -->
  <div class="modal fade" id="logoutSuccessModal" tabindex="-1" aria-labelledby="logoutSuccessLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-danger">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="logoutSuccessLabel">You’ve been logged out</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          Hope to see you again.
        </div>
      </div>
    </div>
  </div>

  <!-- 3) JS to wire it up -->
  <script>
  window.isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};

  document.addEventListener('DOMContentLoaded', () => {
    // intercept link‐based add‐to‐cart buttons
    document.querySelectorAll('.btn-add-to-cart').forEach(btn => {
      btn.addEventListener('click', e => {
        if (!window.isAuthenticated) {
          e.preventDefault();
          new bootstrap.Modal(
            document.getElementById('loginPromptModal')
          ).show();
        }
      });
    });

    // intercept form‐based add‐to‐cart submits
    document.querySelectorAll('form[action*="/cart/add/"]').forEach(form => {
      form.addEventListener('submit', e => {
        if (!window.isAuthenticated) {
          e.preventDefault();
          new bootstrap.Modal(
            document.getElementById('loginPromptModal')
          ).show();
        }
      });
    });

    // logout‐success modal…
    @if(session('success') === 'Logged out successfully.')
      const logoutModal = new bootstrap.Modal(
        document.getElementById('logoutSuccessModal')
      );
      logoutModal.show();
      setTimeout(() => {
        window.location = "{{ route('shop.home') }}";
      }, 2000);
    @endif
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
 @stack('scripts')

</body>
</html>
