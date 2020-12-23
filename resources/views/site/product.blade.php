@extends('site.layout.base')

@section('content')



<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        @if ($product['subcat_id'] != 0)
        @php
        $subcat = \App\Subcategory::find($product['subcat_id']);
        $cat = \App\Category::find($subcat->category_id);
        @endphp
        <li class="breadcrumb-item"> {{$cat['name']}} </li>
        <li class="breadcrumb-item"><a href="/category/{{$subcat->id}}/{{$subcat->name}}">{{$subcat['name']}}</a></li>
        @endif

        <li class="breadcrumb-item active" aria-current="page">{{$product['name']}}</li>
    </ol>
</nav>

<div class="container card card-body">
    <div class="row ">
        <div class="col-12 col-md-4 mt-2">
            <img src="{{asset('/images/products/'.$product['img'])}}" class="img-fluid d-block m-auto">
        </div>
        <div class="col-12 col-md-6 mt-2">
            <div>

                <div class="h4 font-weight-bold text-info">
                    {{$product['name']}}
                </div>
                <div class="h6 ">
                    <span class="text-danger">
                        Rs {{$product['price']}}</span>
                    <br>
                    Quantity - {{$product['quantity']}}
                </div>
                <div class="h5  s">
                </div>
                <div>
                    <p>
                        {{$product['desc']}}
                    </p>
                </div>

                <div>
                    @if ($product['quantity'] != 0)

                    <form action="/add-to-cart" method="POST"  >
                        @csrf 
                        <input name="product_id" value="{{$product->id}}" type="hidden" >
                        <div class="form-group">
                            <label>Product Quantity</label> 
                        <input name="quantity" required type="number" min="1" max="{{$product['quantity']}}" class="form-control" value="1" style="width: 50%">
                        </div> 
                        <button type="submit" class="btn btn-danger">Add To Cart</button>
                    </form>
 
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

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
                    <div class="font-weight-bold text-info text-center mt-3">
                        <a href="/product/{{$product['id']}}" class="btn btn-info">More Information</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>

@endsection