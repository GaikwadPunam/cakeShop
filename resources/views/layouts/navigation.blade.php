{{-- resources/views/layouts/navigation.blade.php --}}
<header class="header_section">
  <nav class="navbar navbar-expand-lg custom_nav-container ">
    <div class="container">
      <a class="navbar-brand me-auto" href="{{ url('/') }}">Cake</a>

      <button class="navbar-toggler" type="button" data-toggle="collapse"
        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class=""> </span>
      </button>

      <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('about') }}">About</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('chocolate') }}">Cakes</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('testimonial') }}">Testimonial</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('contact') }}">Contact Us</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('cart') }}">Cart</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('my_order') }}">myOrder</a></li>

          @guest
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
          @else
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                {{ Auth::user()->name }}
              </a>
              <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
</header>
