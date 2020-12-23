@extends('dashboard.layout.base')

@section('content')
  
<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <div class="card card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>SN</th> 
                        <th>Status</th>
                        <th>Client Name</th>
                        <th>Client Address</th>
                        <th>Client Phone</th>
                        <th>Total Quantity</th>  
                        <th>Total Price</th> 
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
                            @if ($item['status'] == 'complete')
                                <span class="badge badge-pill badge-success px-2 py-1">{{$item['status']}}</span>
                            @else 
                                <span class="badge badge-pill badge-danger px-2 py-1">{{$item['status']}}</span>
                            @endif
                         
                        </td>
                        <td>
                            {{$item['name']}}
                        </td>
                        <td>
                            {{$item['address']}}
                        </td>
                        <td>
                            {{$item['phone']}}
                        </td> 
                        <td>
                            {{$item['quantity']}}
                        </td>
                        <td>
                            {{$item['total']}}
                        </td> 
                       
                        <td>
                            <div class="d-flex">
                                <a href="/dashboard/order/view/{{$item['user_id']}}" class="btn btn-success btn-sm">View</a> 
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

 