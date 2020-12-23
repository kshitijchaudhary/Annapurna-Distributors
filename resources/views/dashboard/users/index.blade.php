@extends('dashboard.layout.base')

@section('content')

 
<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <div class="card card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th> 
                        <th>Email</th>  
                        <th>Joined Ar</th>  
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($clients))
                    @foreach ($clients as $item)
                    <tr>
                        <td>
                            {{$loop->index + 1}}
                        </td> 
                        <td>
                            {{$item['name']}}
                        </td>
                        <td>
                            {{$item['phone']}}
                        </td>
                        <td>
                            {{$item['address']}}
                        </td> 
                        <td>
                            {{$item['email']}}
                        </td> 
                        <td>
                            {{$item['joined']}}
                        </td> 
                        {{-- <td>
                            <div class="d-flex">
                                <a href="/dashboard/product/view/{{$item['id']}}" class="btn btn-success btn-sm">View</a> 
                            </div>
                        </td> --}}
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

 