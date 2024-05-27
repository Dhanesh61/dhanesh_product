<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchases</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table thead th {
            background-color: #343a40;
            color: #fff;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .product-image {
            border-radius: 50%;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="card-title mb-0">Your Order</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr> 
                                        <th>Id</th>
                                        <th>Product Id</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $purchase)
                                    <tr>
                                        <td>{{ $purchase->id }}</td>
                                        <td>{{ $purchase->product_id}}</td>
                                        <td>{{ $purchase->name }}</td>
                                        <td>{{ $purchase->quantity }}</td>  
                                        <td>${{ $purchase->price }}</td>
                                        <td>
                                            <img src="{{ asset('img') }}/{{ $purchase->image }}" class="product-image"
                                                width="50" height="50" alt="Product Image">
                                        </td>
                                        <td>{{$purchase->status}}</td>
                                        <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
                                        <td>
                                        <form action="{{ route('purchase.cancel', ['id' => $purchase->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger" @if($purchase->status == 'cancelled' ) disabled @endif>
                                                <a href="{{route('cancel',['purchase_id'=>$purchase->id])}}" style="text-decoration: none; color: inherit;">Cancel</a>
                                            </button>
                                        </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                           <a href="{{ url('/home') }}" class="btn btn-success"><i class="fa fa-arrow-left"></i>Back To Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</body>

</html>
