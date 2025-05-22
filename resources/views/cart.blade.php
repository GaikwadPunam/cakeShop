@extends('layouts.app')

@section('content')
@if(session('message'))
<div class="alert alert-success" role="alert">
  {{ session('message') }}
</div>
@endif
<div class="container">

    <table class="table border">
        <thead>
            <tr>

                <th> cake Name</th>

                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $totalprice=0;  ?>
            @foreach ($data as $data)
                <tr>

                    <td>{{ $data->cake_name }}</td>

                    <td>${{ $data->price }}</td>
<td><img src="{{ Storage::url($data->image) }}" width="100"alt="Image"></td>
<td><a class="btn btn-danger" href="{{ url('remove_cart',$data->id) }}">Remove </a></td>
</tr>
<?php $totalprice=$totalprice + $data->price ?>
            @endforeach
        </tbody>
    </table>
   <p class="text-center"> total price: {{$totalprice}}</p>
   <p class="text-center">proceed to order</p>
   <div class="text-center">
   <a class="btn btn-danger " href="{{url('cash_order')}}">cash on Delivery </a>
   <a class="btn btn-danger " href="">Pay using Card </a>
   

</div>
</div>

@endsection
