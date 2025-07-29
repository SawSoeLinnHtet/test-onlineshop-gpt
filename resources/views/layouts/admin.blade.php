<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard – @yield('title','Dashboard')</title>

  {{-- Bootstrap & Icons --}}
  <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
    rel="stylesheet"
  />
  <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" 
    rel="stylesheet"
  />

  {{-- Custom admin CSS --}}
  <style>
    body { overflow-x: hidden; }
    #sidebar { min-width: 240px; max-width: 240px; }
    #sidebar .nav-link { color: #ddd; }
    #sidebar .nav-link.active { background: #343a40; color: #fff; }
    #content { width: calc(100% - 240px); }
  </style>
</head>
<body class="d-flex">

  {{-- Sidebar --}}
  <nav 
    id="sidebar" 
    class="bg-dark vh-100 position-fixed d-flex flex-column p-3"
  >
    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center mb-3 text-white text-decoration-none">
      <i class="bi-speedometer2 fs-4 me-2"></i>
      <span class="fs-4">Admin</span>
    </a>
    <hr class="text-secondary" />
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a 
          href="{{ route('admin.dashboard') }}" 
          class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif"
        >
          <i class="bi-house-door me-2"></i> Dashboard
        </a>
      </li>
      <li>
        <a 
          href="{{ route('admin.sellers.pending') }}" 
          class="nav-link @if(request()->routeIs('admin.sellers.*')) active @endif"
        >
          <i class="bi-people-fill me-2"></i> Sellers
        </a>
      </li>
      <li>
        <a 
          href="{{ route('admin.users') }}" 
          class="nav-link @if(request()->routeIs('admin.users')) active @endif"
        >
          <i class="bi-person-fill me-2"></i> Users
        </a>
      </li>
      <li>
        <a 
          href="{{ route('admin.products') }}" 
          class="nav-link @if(request()->routeIs('admin.products')) active @endif"
        >
          <i class="bi-box-seam me-2"></i> Products
        </a>
      </li>
      <li>
        <a 
          href="{{ route('admin.orders') }}" 
          class="nav-link @if(request()->routeIs('admin.orders')) active @endif"
        >
          <i class="bi-receipt me-2"></i> Orders
        </a>
      </li>
      <li>
        <a 
          href="{{ route('admin.categories') }}" 
          class="nav-link @if(request()->routeIs('admin.categories')) active @endif"
        >
          <i class="bi-tags-fill me-2"></i> Categories
        </a>
      </li>
      <li>
        <a 
          href="{{ route('admin.reports') }}" 
          class="nav-link @if(request()->routeIs('admin.reports')) active @endif"
        >
          <i class="bi-graph-up me-2"></i> Reports
        </a>
      </li>
    </ul>
    <hr class="text-secondary mt-auto" />
    <div class="dropdown">
      <a 
        href="#" 
        class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" 
        id="adminMenu" 
        data-bs-toggle="dropdown" 
        aria-expanded="false"
      >
        <img 
          src="https://via.placeholder.com/32" 
          alt="" 
          class="rounded-circle me-2"
        />
        <strong>{{ auth()->user()->name }}</strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="adminMenu">
        <li><a class="dropdown-item" href="{{ route('home') }}">Back to Shop</a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
      </ul>
    </div>
  </nav>

  {{-- Main content area --}}
  <div id="content" class="ms-auto p-4">
    {{-- Topbar (optional) --}}
    <nav class="navbar navbar-expand bg-light mb-4 rounded shadow-sm">
      <div class="container-fluid">
        <form class="d-flex w-50">
          <input 
            class="form-control me-2" 
            type="search" 
            placeholder="Search…" 
            aria-label="Search"
          />
          <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <a 
              class="nav-link position-relative" 
              href="#" 
              id="notifDropdown" 
              data-bs-toggle="dropdown" 
              aria-expanded="false"
            >
              <i class="bi-bell fs-4"></i>
              <span 
                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
              >
                3
              </span>
            </a>
            <ul 
              class="dropdown-menu dropdown-menu-end shadow" 
              aria-labelledby="notifDropdown"
            >
              <li><a class="dropdown-item" href="#">5 new orders</a></li>
              <li><a class="dropdown-item" href="#">2 seller apps</a></li>
              <li><a class="dropdown-item" href="#">1 product flagged</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>

    {{-- Page title & breadcrumbs --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1 class="h3">@yield('title','Dashboard')</h1>
      @yield('breadcrumbs')
    </div>

    {{-- Page content --}}
    <section>
      @yield('content')
    </section>
  </div>

  {{-- Bootstrap JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
