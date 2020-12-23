@extends('site.layout.base')

@section('content')
 


<div class="container">
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
                            <div >
                                Quantity - <span class="font-weight-bold text-danger">
                                    {{$product['quantity']}}
                                </span>
                            </div>
                            <div >
                                Total - <span class="font-weight-bold text-danger">
                                   Rs {{$product['quantity'] *  $product['price'] }}
                                </span>
                            </div>
                            <div class="font-weight-bold text-info text-center mt-3">
                                <a href="/product/{{$product['product_id']}}" target="_blank" class="btn btn-info">More Information</a>
                                <a href="/cart/remove/{{$product['cart_id']}}"   class="btn btn-danger mt-1">Remove From Cart</a>
                            </div> 
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<div class="text-center mt-4">
    <a href="/cart/order-info" target="_blank" class="btn btn-dark mt-1">Proceed to check out </a>
</div>


@endsection