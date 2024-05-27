@extends('layouts.admin-leyout')

@section('content')
<!DOCTYPE html>

<body>
 
    <nav class="navbar navbar-expand-sm bg-dark">
        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-light"  href="#">Orders</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        {{-- <div class="text-right">
            <a href="/create" class="btn btn-dark mt-2">New Product</a>
        </div> --}}
        <table class="table table-hover mt-2">
            <thead>
                <tr>
                    <th style="width:50%">Product</th>
                    <th style="width:10%">Price</th>
                    <th style="width:10%">Quantity</th>
                    <th style="width:30%" class="text-center">Subtotal</th>
                    {{-- <th style="width:10%">Action</th> --}}
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
                                    <div class="col-sm-3 hidden-xs"><img src="{{ asset('img') }}/{{ $details['photo'] }}" width="100" height="100" class="img-responsive"/></div>
                                    <div class="col-sm-9">
                                        <h4 class="nomargin">{{ $details['product_name'] }}</h4>
                                    </div>
                                </div>
                            </td>
                            <td data-th="Price">${{ $details['price'] }}</td>
                            <td data-th="Quantity">
                                <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity cart_update" min="1" />
                            </td>
                            <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
                            <td class="actions" data-th="">
                                {{-- <button class="btn btn-danger btn-sm cart_remove"><i class="fa fa-trash-o"></i> Delete</button> --}}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>

@endsection