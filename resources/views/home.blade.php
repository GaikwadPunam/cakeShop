@extends('layouts.app')
@section('content')
@if(auth()->user())
@if(auth()->user()->isAdmin != 1)

@include('slider')

      <!-- end slider section -->
    </div>

    <section class="about_section layout_padding ">
      <div class="container  ">
        <div class="row">
          <div class="col-md-6">
            <div class="detail-box">
              <div class="heading_container">
                <h2>
                  About Our Company
                </h2>
              </div>
              <p>
                Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web pagend web page editors now use Lorem Ipsum as their default model text, </p>
              <a href="#">
                <span>
                  Read More
                </span>
                <img src="images/color-arrow.png" alt="">
              </a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="img-box">
              <img src="images/cake1.jpg " class="h-75 w-75" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="chocolate_section ">
      <div class="container">
        <div class="heading_container">
          <h2>
            Our cake products
          </h2>

          <div class="col-12 row p-2">
  @foreach($allcakes as $key => $cake )
  <div class="col-3 p-5">
  <div class="card  text-center">
  <img  src="{{ Storage::url($cake->image) }}" class="m-auto d- " style="height:100% ; width:100%;" alt="...">
  <div class="card-body   text-center">

  <h4 class="card-title ">{{ $cake->name;}}</h4>
  <p class="card-text "> Rs. {{ $cake->price;}}</p>
</div>
</div>
</div>
@endforeach
</div>
</div>
          
        
        </div>
      
    </section>

    <!-- end chocolate section -->

    <!-- offer section -->

    <section class="offer_section layout_padding">
      <div class="container">
        <div class="box">
          <div class="detail-box">
            <h2>
              Offers on cake
            </h2>
            <h3>
              Get 5% Offer <br>
              any Chocolate items
            </h3>
            <a href="">
              Buy Now
            </a>
          </div>
          <div class="img-box">
            <img src="images/offer-img.png" alt="">
          </div>
        </div>
        <div class="btn-box">
          <a href="">
            <span>
              See More
            </span>
            <img src="images/color-arrow.png" alt="">
          </a>
        </div>
      </div>
    </section>

    <!-- end offer section -->

    <!-- client section -->

    <section class="client_section">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 ml-auto">
            <div class="img-box sub_img-box">
              <img src="images/client-chocolate.png" alt="">
            </div>
          </div>
          <div class="col-lg-6 px-0">
            <div class="client_container">
              <div class="heading_container">
                <h2>
                  Testimonial
                </h2>
              </div>
              <div id="customCarousel2" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <div class="box">
                      <div class="img-box">
                        <img src="images/client-img.jpg" alt="">
                      </div>
                      <div class="detail-box">
                        <h4>
                          Gero Miliya
                        </h4>
                        <p>
                          long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it haslong established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it haslong established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has
                        </p>
                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="box">
                      <div class="img-box">
                        <img src="images/client-img.jpg" alt="">
                      </div>
                      <div class="detail-box">
                        <h4>
                          Gero Miliya
                        </h4>
                        <p>
                          long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it haslong established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it haslong established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has
                        </p>
                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="box">
                      <div class="img-box">
                        <img src="images/client-img.jpg" alt="">
                      </div>
                      <div class="detail-box">
                        <h4>
                          Gero Miliya
                        </h4>
                        <p>
                          long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it haslong established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it haslong established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has
                        </p>
                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="carousel_btn-box">
                  <a class="carousel-control-prev" href="#customCarousel2" role="button" data-slide="prev">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#customCarousel2" role="button" data-slide="next">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    

@include('footer')
@endif
@endif

@if(auth()->user())
@if(auth()->user()->isAdmin == 1)
<div class="col-12 row text-right py-3">

   <div class="div">
        <a class="btn btn-primary" href="{{route("cake.create") }} "> Add</a>
        <a class="btn btn-primary" href="{{route("cake.index") }} " > view all</a>
</div>
</div>


<div class="container-fluid">
<div class="container text-center">
  <div class="row">
    <div class="col text-start ">
    "Welcome to cake shop Admin Panel! Manage orders, update menus, track inventory, and oversee customer inquiries—all in one place. Our intuitive dashboard ensures smooth operations, helping you deliver delicious cakes with efficiency and ease.


    </div>
    <div class="col">

   <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    @foreach($allcakes as $key => $cake )
    <div class="carousel-item  ">
      <img src="{{ Storage::url($cake->image) }}" class="d-block " style="height:200px; width:300px;" alt="...">
</div>

      @endforeach
    
  </div>
</div>
    </div>
</div>
</div>
<div class="container-fluid p-5">
<div class="container pb-5">
<h2 class="text-center p-5">
            All products
          </h2>



 <div class="col-12 row">
  @foreach($allcakes as $key => $cake )
  <div class="col-3">
  <div class="card  text-center">
  <img  src="{{ Storage::url($cake->image) }}" class="m-auto d- " style="height:100% ; width:100%;" alt="...">
  <div class="card-body   text-center">

  <h4 class="card-title ">{{ $cake->name;}}</h4>
  <p class="card-text "> Rs. {{ $cake->price;}}</p>
</div>
</div>
</div>
@endforeach
</div>
</div>

</div>
</div>
</div>
</div>
</div>
<script>
  setTimeout(() => {
    document.querySelectorAll('.carousel-item')[0].classList.add('active')
    
  }, 500);
  </script>
  @endif
  @endif
  @endsection
