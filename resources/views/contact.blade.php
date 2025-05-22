@extends('layouts.app')
@section('content')




    <!-- contact section -->

    <section class="contact_section layout_padding">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-5 col-lg-4 offset-md-1 offset-lg-2">
            <div class="form_container">
              <div class="heading_container">
                <h2>
                  Contact Us
                </h2>

              </div>
              @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ url('/contact') }}" method="POST">
            @csrf

                <div>
                  <input type="text" placeholder="Full Name " name="name" />
                </div>
                <div>
                  <input type="text" placeholder="Phone number" name="mobile"/>
                </div>
                <div>
                  <input type="email" placeholder="Email"  name="email"/>
                </div>
                <div>
                  <input type="text" class="message-box" placeholder="Message"  name="message"/>
                </div>
                <div class="d-flex ">
                  <button>
                    SEND NOW
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-6  px-0">
            <div class="map_container">
              <div class="map">
                <div id="googleMap"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- end contact section -->

@include('footer')
@endsection