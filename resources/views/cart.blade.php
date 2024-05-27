<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags and title -->
    <title>DK Brothers</title>

    <style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .actions button {
        padding: 8px 12px;
        background-color: #dc3545;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .actions button:hover {
        background-color: #c82333;
    }

    .checkout-btn {
        padding: 12px 20px;
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
    }

    .checkout-btn:hover {
        background-color: #218838;
    }
</style>

    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-gray-200">

    <nav class="bg-gray-800 p-6">
        <div class="container mx-auto flex items-center justify-between">
            <div class="text-white text-xl font-semibold">DK Brother</div>
            <div>
                <!-- Logout Button and View Profile Link -->
                <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a href="{{ route('profile.show') }}" class="text-blue-500 hover:text-blue-700 dark:text-blue-300 dark:hover:text-blue-100 mr-4">View Profile</a>
                    <button type="submit" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white bg-red-500 hover:bg-red-600">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <h1 class="text-4xl font-bold text-center my-8">DK Brothers Shop</h1>

@extends('layout')
   
@section('content')
<table id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            
            <th style="width:30%">Product</th>
            <th style="width:20%">Product Name</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%">Action</th>
        </tr>
        
        
    </thead>
    <tbody>
        @php $total = 0 @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                <tr data-id="{{ $id }}">
                    <td data-th="Product">
                        <div class="row">
                            @php
                            @endphp
                            <div class="col-sm-3 hidden-xs"><img src="{{ asset('img') }}/{{ $details['photo'] }}" width="100" height="100" class="img-responsive"/></div>
                        </div>
                    </td>
                    <td >{{ $details['product_name'] }}</td>
                    <td data-th="Price">${{ $details['price'] }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity cart_update" min="1" />
                    </td>
                    <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm cart_remove"><i class="fa fa-trash-o"></i> Delete</button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" class="text-right"><h3><strong>Total ${{ $total }}</strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('/home') }}" class="btn btn-danger"> <i class="fa fa-arrow-left"></i> Continue Shopping</a>
                <button class="btn btn-success">
                    <i class="fa fa-money"></i> <!-- Font Awesome icon for money -->
                    <a href="{{ route('paypal') }}" style="color: #fff; text-decoration: none;">Checkout</a>
                </button>
                
            </td>
        </tr>
    </tfoot>
</table>
@endsection
   
@section('scripts')
<script type="text/javascript">
   
    $(".cart_update").change(function (e) {
        e.preventDefault();
   
        var ele = $(this);
   
        $.ajax({
            url: '{{ route('update_cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
   
    $(".cart_remove").click(function (e) {
        e.preventDefault();
   
        var ele = $(this);
   
        if(confirm("Do you really want to remove?")) {
            $.ajax({
                url: '{{ route('remove_from_cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
   
</script>
@endsection


