@extends('dashboard.layout.base')

@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Category</li>
    </ol>
</nav>

<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#addModal">
    Add New Category
</button>

{{-- categories --}}
<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        {{-- <div class="card card-body ">
             
        </div> --}}

        <div class="list-group" id="accordionOne">
            @if (!empty($categories))
            @foreach ($categories as $item)
            <div class="expansion-panel list-group-item">
                <a aria-controls="collapse-{{$item['category_id']}}" aria-expanded="false" class="expansion-panel-toggler collapsed"
                    data-toggle="collapse" href="#collapse-{{$item['category_id']}}" id="headingOne">
                    {{$item['category_name']}}
                    <div class="expansion-panel-icon ml-3 text-black-secondary">
                        <i class="collapsed-show material-icons">keyboard_arrow_down</i>
                        <i class="collapsed-hide material-icons">keyboard_arrow_up</i>
                    </div>
                </a>
                <div aria-labelledby="headingOne" class="collapse" data-parent="#accordionOne" id="collapse-{{$item['category_id']}}">
                    <div class="expansion-panel-body">
                        <div>

                            {{-- //remove category   --}}

                            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#addSubCat-{{$item['category_id']}}">
                                Add Sub Category  
                            </button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#removeMainCat-{{$item['category_id']}}">
                                Remove Category ({{$item['category_name']}})
                            </button>

                        </div>
                        <div class="mt-3">
                           
                            <ul class="list-group">
                                @foreach ($item['subcategories'] as $subcat)
                                <li class="list-group-item d-flex">
                                    <div>
                                        {{$subcat['name']}}
                                    </div>
                                    <div>
                                    <a href="/dashboard/sub-categories/remove/{{$subcat['id']}}" type="button" class="btn btn-danger btn-sm ml-5"  >
                                            Remove 
                                        </a>
                                    </div>
                                </li> 
                                @endforeach  
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
 
        </div>
    </div>
</div>


@endsection


@section('modal')

  

@if (!empty($categories))
@foreach ($categories as $item)
{{-- //remove main category  --}}
<div class="modal fade" id="removeMainCat-{{$item['category_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Remove Category ({{$item['category_name']}})</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="/dashboard/categories/remove" method="POST" >
                @csrf  
                <div class="form-group"> 
                    <input name="category_id"   type="hidden"  value="{{$item['category_id']}}">
                </div> 
                <button type="submit" class="btn btn-success">Remove</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>

{{-- add sub category  --}}
<div class="modal fade" id="addSubCat-{{$item['category_id']}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Sub Category ({{$item['category_name']}})</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/sub-categories/add" method="POST">
                    @csrf
                    <div class="form-group">
                        <input name="category_id" type="hidden" value="{{$item['category_id']}}">
                    </div>
                    <div class="form-group">
                        <label>SubCategory Name</label>
                        <input name="name" required type="text" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Add</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endforeach
@endif



<!-- Add Category -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/categories/add" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Category Name</label>
                        <input name="name" required type="text" class="form-control">
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