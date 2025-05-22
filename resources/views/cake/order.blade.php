

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .sidenav {
  height: 100%;
  width: 170px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 160px; /* Same as the width of the sidenav */
  /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
        <div class="sidenav">
  <a href=>Cake shop</a>
  <a href="{{ url('cake/index')}}">View</a>
  <a href="{{ url('cake/create')}}">Create</a>
  <a href="{{ url('cake/order')}}">Order</a>

  <a href="{{ url('home')}}">Home</a>
</div>
</div>
<div class="main">
   

<div class="card border-0 shadow-lg">
  <div class="card-body">
  <table class="table  table-striped border">
    
      <tr>
      <th> name</th>
      <th> number</th>
      <th> address</th>

      <th> cake Name</th>

<th>Price</th>
<th>Image</th>

<th>delivery status</th>
<th>payment status</th>

<th>Delivered</th>

      </tr>
      
            @foreach ($order  as $order)


      <tr>
      <td>{{ $order->user_name }}</td>
      <td>{{ $order->contact_number}}</td>

      <td>{{ $order->address }}</td>


      <td>{{ $order->cake_name }}</td>
      <td>${{ $order->price }}</td>

<td><img src="{{ Storage::url($order->image) }}" width="100"alt="Image"></td>
<td>{{ $order->delivery_status }}</td>
      <td>{{ $order->payment_status }}</td>
<td> 
    @if($order->delivery_status=='processing')
    <a href="{{url('delivered',$order->id)}}" class="btn btn-primary">Delivered</a>
</td>
@else<p>Delivered</p>
@endif

@endforeach

  



</div>
</div>
</div>












</body>
</html>





































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































