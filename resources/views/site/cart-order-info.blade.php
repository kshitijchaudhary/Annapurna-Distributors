@extends('site.layout.base')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/cart">Cart</a></li>
        <li class="breadcrumb-item active" aria-current="page">Customer Information</li>
    </ol>
</nav>

{{-- <div class="container">
    <div class="row mt-4">

        @if (!empty($products))
        @foreach ($products as $product)
        <div class="col-12 col-md-4 mt-3">
            <div class="card card-body">
                <div class="">
                    <img src="{{asset('/images/products/'.$product['img'])}}" class="img-fluid d-block m-auto"
                        style="height: 225px">
                    <div class="font-weight-bold">
                        {{$product['name']}}
                    </div>
                    <div class="font-weight-bold text-info">
                        Rs {{$product['price']}}
                    </div>
                    <div>
                        Quantity - <span class="font-weight-bold text-danger">
                            {{$product['quantity']}}
                        </span>
                    </div>
                    <div>
                        Total - <span class="font-weight-bold text-danger">
                            Rs {{$product['quantity'] *  $product['price'] }}
                        </span>
                    </div>
                    <div class="font-weight-bold text-info text-center mt-3">
                        <a href="/product/{{$product['product_id']}}" target="_blank" class="btn btn-info">More
                            Information</a>
                        <a href="/cart/remove/{{$product['cart_id']}}" class="btn btn-danger mt-1">Remove From Cart</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div> --}}


<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-5 mt-3">
            <div class="card card-body">
                <form action="/cart/confirm-order" method="POST" >
                    @csrf
                  <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter Name" value="{{$clientinfo->name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone</label>
                            <input name="phone" type="text" class="form-control" placeholder="Enter Phone" value="{{$clientinfo->phone}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Address</label>
                            <input name="address" type="text" class="form-control" placeholder="Enter Address" value="{{$clientinfo->address}}">
                        </div>
                
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-success">confirm order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- <div class="text-center mt-4">
    <a href="/cart/order-info"  class="btn btn-dark mt-1">confirm order </a>
</div> --}}


@endsection