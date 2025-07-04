<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    @vite([ 'resources/js/app.js'])

    <!-- तुमचं Bootstrap आणि Custom Styles - नंतर load करा -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css">
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
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
  <a href="{{ url('cake/index/cake')}}">View</a>
  <a href="{{ url('cake/create')}}">Create</a>
  <a href="{{ url('cake/order')}}">Order</a>

  <a href="{{ url('home')}}">Home</a></div>

<div class="main">
   

<div class="container py-3">
        <div class="d-flex justify-content-between">
            <div class="h4">
    </div>
    <div>
      
    <a href=" {{route('cake.index')}}"class="btn btn-primary ms-auto">Back</a>



</div> 
</div>

@if (count($errors) > 0)
        
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">

                {{ $error }}
                </div>
            @endforeach

    
@endif

<form action="{{route('cake.update', $onerow->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
<div class="card border-0 shadow-lg">

  <div class="card-body">

  <div class="mb-3">
      <label for="name"> Name of cake</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $onerow->name }}" id="name" placeholder="Enter name" name="name">
      @error('name')
      <p class="invalid-feedback"> {{  $message }} </p>
      @enderror
    </div>

    <div class="mb-3">

    <label for="description">Description of cake</label>
<textarea class="form-control"  rows="5"  id="description"  name="description">{{ $onerow->description}}</textarea>


    </div>
    <div class="mb-3">
    <label for="price">price</label>
    <input type="number" class="form-control " value="{{ $onerow->price }}" id="price" placeholder="price" name="price">


    </div>
    <div class="mb-3">
      <label for="image">Image</label>
      <input type="file" class="form-control" id="image" name="image" style="height: 40px; width: 200px;">
      <img src="{{ Storage::url($onerow->image) }}" alt="Image">




    </div>




</div>
</div>
<button  class="btn btn-primary mt-3">Submit</button>

</form>


</div>
</body>
</html>




























































































































































































































































































































































































































































































































