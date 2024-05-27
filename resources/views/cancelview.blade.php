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
                                    <th>Purchase_id</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cancel as $purchase)
                                <tr>
                                    <td>{{ $purchase->id }}</td>
                                    <td>{{ $purchase->user_id }}</td>
                                    <td>{{ $purchase->purchase_id }}</td>
                                    <td>{{ $purchase->reason }}</td>
                                    <td>
                                        <div class="col">
                                            <form action="{{ route('deletecancel.cancel', ['id' => $purchase->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Approve</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection