@extends('dashboard.layout.base')

@section('content')

<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#addProductModal">
    Add New Product
</button>


<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <div class="card card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Quantity</th> 
                        <th>Price</th> 
                        {{-- <th>Desc</th>
                        <th>Category</th>
                        <th>Subcategory</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($products))
                    @foreach ($products as $item)
                    <tr>
                        <td>
                            {{$loop->index + 1}}
                        </td>
                        <td>
                            <img src="{{asset('/images/products/'.$item['img'])}}" class="img-fluid"
                                style="height: 125px">
                        </td>
                        <td>
                            {{$item['name']}}
                        </td>
                        <td>
                            {{$item['quantity']}}
                        </td>
                        <td>
                            {{$item['price']}}
                        </td> 
                        <td>
                            <div class="d-flex">
                                <a href="/dashboard/product/view/{{$item['id']}}" class="btn btn-success btn-sm">View</a> 
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection


@section('modal')
<!-- Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Add New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/product/add" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Product Image </label>
                        <input name="img" required type="file" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Product Name</label>
                        <input name="name" required type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Product Quantity</label>
                        <input name="quantity" required type="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Product Price</label>
                        <input name="price" required type="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Product Description</label>
                        <textarea name="desc" required type="text" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Choose Category</label>
                        <select name="subcat_id" required class="form-control">
                            @if (!empty($categories))

                            @foreach ($categories as $item)

                            <option disabled>{{$item['category_name']}}</option>

                            @foreach ($item['subcategories'] as $subcat)
                            <option value="{{$subcat['id']}}">
                                {{$subcat['name']}}
                            </option>

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