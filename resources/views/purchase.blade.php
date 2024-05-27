@extends('layouts.admin-leyout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0">Purchases</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr> 
                                    <th>Id</th>
                                    <th>User Id</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchases as $purchase)
                                    <tr class="@if($purchase->status == 'cancelled') table-danger @elseif($purchase->status == 'approved') table-success @elseif($purchase->status == 'your order has been cancel') table-dark @endif">
                                    <td>{{ $purchase->id }}</td>
                                    <td>{{ $purchase->user_id }}</td>
                                    <td>{{ $purchase->name }}</td>
                                    <td>{{ $purchase->quantity }}</td>
                                    <td>${{ $purchase->price }}</td>
                                    <td>
                                        <img src="{{ asset('img') }}/{{ $purchase->image }}" class="rounded-circle"
                                            width="50" height="50" alt="Product Image">
                                    </td>
                                    <td>{{$purchase->status}}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <form action="{{ route('purchase.approve', ['id' => $purchase->id]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success" @if($purchase->status == 'approved' ) disabled @endif>Approve</button>
                                                </form>
                                            </div>
                                            <div class="col">
                                                <form action="{{ route('purchase.cancel', ['id' => $purchase->id]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger" @if($purchase->status == 'cancelled' ) disabled @endif>Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $purchases->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

