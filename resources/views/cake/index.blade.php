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
  width: 200px;
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
   

<div class="container-fluid py-3">
<div class="container">

<div class="card border-0 ">
  <div class="card-body">
    @if(session('message'))
<div class="alert alert-success" role="alert">
  {{ session('message') }}
</div>
@endif



<!-- resources/views/dashboard.blade.php -->

<div class="container">
    

    <div class="row">
        <div class="col-md-4">
            <div class="card   mb-3 border-0 shadow-lg">
                <div class="card-body text-center">
                                  <h4>Total Cakes</h4>

                    <h5 class="card-title">{{ $totalCakes }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card  mb-3 border-0 shadow-lg">
                <div class="card-body text-center ">
                  <h4>Total Orders</h4>
                    <h5 class="card-title">{{ $totalOrders }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card  mb-3 border-0 shadow-lg">
                <div class="card-body text-center">
                  <h4>Total Customers</h4>
                    <h5 class="card-title">{{ $totalCustomers }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<form method="GET" action="{{ route('cake.index') }}" class="d-flex mb-3" id="searchForm">
    <input type="text" name="search" id="searchInput" class="form-control me-2" placeholder="Search cake..." value="{{ request('search') }}">

    
         <button type="submit" class="btn btn-primary">Search</button>

    <button type="button" class="btn btn-danger me-2" onclick="clearSearch()">Clear</button>

</form>

<script>
    function clearSearch() {
        document.getElementById('searchInput').value = ''; 
        document.getElementById('searchForm').submit();    
    }
</script>



<div class="card border-0 shadow-lg">
  <div class="card-body">
  <table class="table  table-striped border">
    
      <tr>
      <th>No</th>

        <th>Name</th>

        <th>desc</th>
        <th>price</th>
        <th>images</th>
        <th>Action</th>

      </tr>
      @if(count($allCakes)>0)
            @foreach ($allCakes  as $Cake)


      <tr>
      <td>{{ $Cake->id}}</td>
      <td>{{ $Cake->name}}</td>
      <td>{{ $Cake->description}}</td>
      <td>{{ $Cake->price}}</td>
      
      <td> 
      <img src="{{ Storage::url($Cake->image) }}" width="100"alt="Image">
      </td>



        <td>

        <a href="{{route('cake.edit',$Cake->id)}}" class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
</svg></a>


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal{{$Cake->id}} ">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg>
  </button>
</div>

<!-- The Modal -->
<div class="modal" id="myModal{{$Cake->id}}">
  
<form action="{{ route('cake.delete', $Cake->id) }}" method="POST">
  @csrf
    @method('DELETE')
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">are you sure</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>


      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">delete</button>
      </div>

    </div>
  </div>
</form>
</div>


        </td>

      </tr>

      @endforeach
      @else
    <tr>
        <td colspan="6">Record Not Found</td>
</tr>
@endif


    
  </table>

<div class="d-flex justify-content-center">
    {{ $allCakes->links() }}
</div>

</div>
</div>
</div>
</div>
</div>
</body>
</html>
