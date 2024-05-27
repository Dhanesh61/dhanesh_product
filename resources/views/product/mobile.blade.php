<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags and title -->
    <title>DK Brothers</title>

    <style>
        /* Custom CSS for product cards */
        .fa-shopping-cart {
            font-size: 24px; 
            color: white; 
            margin-right: 10px;
        }
        .image-carousel {
            width: 100%; 
            overflow: hidden;
            white-space: nowrap;
        }

        .image {
            display: inline-block;
        }

        .image img {
            width: 1300px; 
            height: 400px; 
            margin-right: 20px; 
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            width: 1200px;
            margin-left: 20px;
            margin: 20px;
        }

        .header {
            text-align: center;
            flex: 1;
        }

        .header img {
            display: block;
            margin: 0 auto;
            width: 80px;
            height: 80px;
        }

        .header h3 {
            margin-top: 10px;
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
            <div class="flex items-center">
                <div class="dropdown mr-4">
                        <a href="{{ route('yourorder') }}" class="btn btn-success">
                            <i class="fas fa-shopping-bag"></i> Your Order
                        </a>
                    <button type="button" class="btn btn-primary" data-toggle="dropdown">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                    </button>

                    <div class="dropdown-menu">
                        <div class="row total-header-section">
                            @php $total = 0 @endphp
                            @foreach((array) session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            @endforeach
                            <div class="col-lg-12 col-sm-12 col-12 total-section text-right">
                                <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                            </div>
                        </div>
                        @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                        <div class="row cart-detail">
                            <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                <img src="{{ asset('img') }}/{{ $details['photo'] }}" />
                            </div>
                            <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                <p>{{ $details['product_name'] }}</p>
                                <span class="price text-info"> ${{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <div class="row">
                            <!-- View Cart Button -->
                            <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                <a href="{{ route('cart') }}" class="btn btn-primary btn-block">View all</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Logout Button -->
                <div class="relative">
                    <button class="inline-block bg-blue-500 hover:bg-blue-700 dark:bg-blue-300 dark:hover:bg-blue-100 text-white dark:text-gray-800 py-2 px-4 rounded-md shadow-md transition-colors duration-300 mr-4" onclick="toggleDropdown()">
                        {{ Auth::user()->name }} <i class="fas fa-caret-down ml-1"></i>
                    </button>
                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 bg-white border rounded-md shadow-lg z-10">
                        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-100 dark:text-gray-300 dark:hover:bg-blue-100">View Profile</a>
                        <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-blue-100 dark:text-gray-300 dark:hover:bg-blue-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <h1 class="text-4xl font-bold text-center my-8">DK Brothers Shop</h1>
    <div class="image-carousel">
        <div class="image">
          <img src="../../dist/img/iphoneoffer.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="image">
          <img src="../../dist/img/samsung.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        </div>
       
       
    @extends('layout')
    
    @section('content')
   
    <div class="row">
        @foreach($mobiles as $mobile)
        <div class="col-xs-18 col-sm-6 col-md-4" style="margin-top:10px;">
            <div class="img_thumbnail productlist">
                <img src="{{ asset('img/' . $mobile->image) }}" alt="mobile" class="img-fluid" style="width: 300px; height: 200px;">
                <div class="caption">
                    <h4>{{ $mobile->name }}</h4>
                    <p>{{ $mobile->description }}</p>
                    <p><strong>Price: </strong><del>{{ number_format($mobile->price * 1.10 ) }}</del> ${{ $mobile->price }}</p>
                    <p class="btn-holder"><a href="{{ route('add_to_cart', $mobile->id) }}" class="btn btn-primary btn-block text-center" role="button">Add to cart</a> </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    @endsection

</body>
    <script>
    function toggleDropdown() {
        var dropdownMenu = document.getElementById("dropdownMenu");
        dropdownMenu.classList.toggle("hidden");
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    var scrollAmount = 1300 + 20; // Width of image + margin-right
    var speed = 8000; // Adjust scroll speed as needed
    
    function scrollImages() {
      $('.image-carousel').animate({scrollLeft: '+=' + scrollAmount}, speed, 'linear', function() {
        $(this).append($('.image:first-child'));
        $(this).scrollLeft(0);
        scrollImages();
      });
    }
    
    scrollImages();
  });
</script>

</html>
