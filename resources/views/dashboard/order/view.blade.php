@extends('dashboard.layout.base')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard/orders">Orders</a></li>
        <li class="breadcrumb-item active" aria-current="page">View</li>
    </ol>
</nav>

<div class="row justify-content-center mt-3">
    <div class="col-md-5">
        <div class="card card-body table-responsive">
            Client Info
            <table class="table">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>{{$clientinfo->name}}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{$clientinfo->phone}}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{$clientinfo->address}}</td>
                    </tr>
                    <tr>
                        <td>Order Status</td>
                        <td>
                            @if ($clientinfo['status'] == 'complete')
                            <span class="badge badge-pill badge-success px-2 py-1">{{$clientinfo['status']}}</span>
                            @else
                            <span class="badge badge-pill badge-danger px-2 py-1">{{$clientinfo['status']}}</span>
                            @endif
                        </td> 
                    </tr>
                    <tr>
                        <td colspan="2">
                            @if ($clientinfo->status == 'incomplete')
                            <a href="/dashboard/order/{{$clientinfo['user_id']}}/complete"   class="btn btn-danger btn-sm">Mark Order Complete</a>
                            @else 
                            <a href="/dashboard/order/{{$clientinfo['user_id']}}/incomplete" class="btn btn-danger btn-sm">Mark Order Incomplete</a>

                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <div class="card card-body table-responsive">

            Product Info

            <table class="table">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($orders))
                    @foreach ($orders as $item)
                    <tr>
                        <td>
                            {{$loop->index + 1}}
                        </td>
                        <td>
                            {{$item['product_name']}}
                        </td>
                        <td>
                            Rs {{$item['price']}}
                        </td>
                        <td>
                            {{$item['quantity']}}
                        </td>
                        <td>
                            Rs {{$item['quantity'] * $item['price']}}
                        </td>

                        <td>
                            <div class="d-flex">
                                <a href="/product/{{$item['product_id']}}" target="_blank"
                                    class="btn btn-success btn-sm">View</a>
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

<div class="text center mt-5">
    <a href="/dashboard/order/{{$item['user_id']}}/cancel-order" target="_blank" class="btn btn-danger btn-sm">Cancel Order</a>
</div>

@endsection


{{-- @section('modal')
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


@endsection --}}