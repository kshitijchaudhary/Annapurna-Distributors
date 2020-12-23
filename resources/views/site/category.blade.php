@extends('site.layout.base')

@section('content')
 
 
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
  
        @php 
        $cat = \App\Category::find($subcat->category_id);
        @endphp
        <li class="breadcrumb-item"> {{$cat['name']}} </li>
        <li class="breadcrumb-item active"> {{$subcat['name']}} </li>
       
 
    </ol>
</nav>

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
                    {{-- <h4 class="card-title text-uppercase text-center font-weight-bold mb-1">Jobs Posts</h4>
                            <p class="card-text text-center h3"> </p> --}}
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>



@endsection