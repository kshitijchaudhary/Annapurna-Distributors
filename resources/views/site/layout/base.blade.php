<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Annapurna Distributors</title>

    <!-- CSS -->
    <!-- Add Material font (Roboto) and Material icon as needed -->
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i|Roboto+Mono:300,400,700|Roboto+Slab:300,400,700"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="{{asset('/js/app.js')}}"></script>
</head>

<body>


    @yield('modal')


    <nav class="navbar navbar-expand-lg navbar-light text-white bg-danger site_navbar d-flex justify-content-between">
        <a class="navbar-brand brand_name" href="/">Annapurna Distributors</a>
        <div>
            @if (Auth::check())
            @php
                //cart
                // $cart_count = 0;
                $cart_count = \App\Cart::where('user_id',Auth::user()->id)->count();
            @endphp
                <div>
                    <a href="/cart" class="btn btn-info btn-sm">Cart  [ {{$cart_count}} ]</a>
                    <a href="/logout" class="btn btn-dark btn-sm">Logout</a>
                </div>
            @else 
                <a href="/login" class="btn btn-dark btn-sm">Login</a>
            @endif
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light text-white bg-danger">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home</a>
                </li>

                 

                @foreach (\App\Category::get() as $cat)
                <li class="nav-item dropdown text-white">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{$cat->name}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach (\App\Subcategory::where('category_id', $cat['id'])->get() as $subcat)
                        <a class="dropdown-item" href="/category/{{$subcat->id}}/{{$subcat->name}}">{{$subcat->name}}</a> 
                        @endforeach 
                    </div>
                </li>
                @endforeach
                {{-- <li class="nav-item dropdown text-white">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a> 
                    </div>
                </li>  --}}
            </ul>
        </div>
    </nav>


    {{-- <main class="layout-content"> --}}
    <div class="container-fluid mt-3">

        @yield('content')

        <div class="mt-5"></div>
    </div>
    {{-- </main> --}}






    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <script src="{{asset('/js/app.js')}}"></script>
</body>

</html>