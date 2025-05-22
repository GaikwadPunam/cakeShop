
      <!-- end header section -->
      @extends('layouts.app')
@section('content')


    <!-- chocolate section -->

    <section class="chocolate_section ">
      <div class="container">
        <div class="heading_container">
          <h2>
            Our cake products
          </h2>

          <div class="col-12 row p-2">
  @foreach($allcakes as $key => $cake )

  <div class="col-3 p-5">
  <form action="{{ url('add_cart',$cake->id) }}" method="POST">
    @csrf

  <div class="card  text-center">
  <img  src="{{ Storage::url($cake->image) }}" class="m-auto d- " style="height:100% ; width:100%;" alt="...">

  <div class="card-body   text-center">

  <h4 class="card-title ">{{ $cake->name;}}</h4>
  <p class="card-text "> Rs. {{ $cake->price;}}</p>
</div>
</div>

<button type="submit">Add to Cart</button>

</div>
</form>
@endforeach
</div>
</div>
          
        
        </div>
      
    </section>


    <!-- end chocolate section -->
@include('footer')
    <!-- info section -->
   @endsection