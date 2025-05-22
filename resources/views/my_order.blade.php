@extends('layouts.app')

@section('content')



<div class="container">

<table class="table  table-striped border">
    
    <tr>

    <th> cake Name</th>

<th>Price</th>
<th>Image</th>

<th>delivery status</th>
<th>payment status</th>
<th>Cancel order</th>


    </tr>
    
          @foreach ($order  as $order)


    <tr>


    

    <td>{{ $order->cake_name }}</td>
    <td>{{ $order->price }}</td>

<td><img src="{{ Storage::url($order->image) }}" width="100"alt="Image"></td>
<td>{{ $order->delivery_status }}</td>
    <td>{{ $order->payment_status }}</td> 
    

<td> 

       <a href="{{url('cancel_order',$order->id)}}" class="btn btn-primary">Cancel</a>
</td>
</tr>
@endforeach





</table>
</div>

@endsection
