@extends('dashboard.layout.base')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard/products">Products</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$product['name']}}</li>
    </ol>
</nav>

<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card card-body">

            <img src="{{asset('/images/products/'.$product['img'])}}" class="img-fluid d-block m-auto"
                style="height: 225px">

            <table class="table">
                <tr>
                    <td>Name</td>
                    <td>{{$product['name']}}</td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td>{{$product['quantity']}}</td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>Rs {{$product['price']}}</td>
                </tr>
                @if ($product['subcat_id'] != 0)
                @php
                $subcat = \App\Subcategory::find($product['subcat_id']);
                $cat = \App\Category::find($subcat->category_id);
                @endphp
                <tr>
                    <td>Category</td>
                    <td>{{$cat['name']}}</td>
                </tr>
                <tr>
                    <td>SubCategory</td>
                    <td>{{$subcat['name']}}</td>
                </tr>
                @endif

                <tr>
                    <td>Description</td>
                    <td>{{$product['desc']}}</td>
                </tr>
                <tr>
                    <td>Action</td>
                    <td>
                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#editProductModal">
                            Edit Product
                        </button>
                    </td>
                </tr>
            </table>

        </div>

    </div>
</div>


<a href="/dashboard/product/remove/{{$product['id']}}" class="btn btn-danger btn-sm ml-3 mt-5">Remove Product</a>

@endsection


@section('modal')
<!-- Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/product/edit" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input name="product_id" required type="hidden" value="{{$product['id']}}" class="form-control">
                    <div class="form-group">
                        <label>Product Image </label>
                        <input name="img"   type="file" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Product Name</label>
                        <input name="name" required type="text" class="form-control" value="{{$product['name']}}">
                    </div>
                    <div class="form-group">
                        <label>Product Quantity</label>
                        <input name="quantity" required type="number" class="form-control"
                            value="{{$product['quantity']}}">
                    </div>
                    <div class="form-group">
                        <label>Product Price</label>
                        <input name="price" required type="number" class="form-control" value="{{$product['price']}}">
                    </div>
                    <div class="form-group">
                        <label>Product Description</label>
                        <textarea name="desc" required type="text" class="form-control">{{$product['desc']}}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Choose Category</label>
                        <select name="subcat_id" required class="form-control">
                            @if (!empty($categories))

                            @foreach ($categories as $item)

                            <option disabled>{{$item['category_name']}}</option>

                            @foreach ($item['subcategories'] as $subcat)

                            @if ($product['subcat_id'] == $subcat['id'] )
                            <option value="{{$subcat['id']}}" selected>
                                {{$subcat['name']}}
                            </option>
                            @else 
                            <option value="{{$subcat['id']}}">
                                {{$subcat['name']}}
                            </option>    
                            @endif
                         

                            @endforeach

                            @endforeach
                            @endif
                        </select>

                    </div>

                    <button type="submit" class="btn btn-success">ADD</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection