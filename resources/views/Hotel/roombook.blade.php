<!DOCTYPE html>
<html lang="en">
<head>
    <title>DK Brothers</title>
    <style>
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
            height: 300px; 
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

        .yourroom {
            padding-right: 10px;
            padding-top: 7px;
            padding-left: 14px;
        }

        .slot-btn[disabled] {
            background-color: #ccc; /* Light grey color */
            cursor: not-allowed;
        }

        .btn-warning {
            color: #212529;
            background-color: #ffc107;
            border-color: #ffc107;
            width: 117px;
            padding-top: 7px;
            margin-top: -2px;
            height: 39px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-gray-200">
    <nav class="bg-gray-800 p-6">
        <div class="container mx-auto flex items-center justify-between">
            <a href="{{ url('/home') }}" class="text-white font-semibold hover:text-gray-200"><i class="fa fa-arrow-left mr-2"></i> Back To Home</a>
            <div class="text-white text-xl font-semibold">DK Brothers Hotels</div>
            <div class="flex items-center">
                <div class="relative">
                    <a href="{{ route('userroom') }}" class="btn btn-warning">
                        <i class="fas fa-door-open"></i> Room
                    </a>
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
   
    <div class="image-carousel">
        <div class="image">
            <img src="../../dist/img/room.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="image">
            <img src="../../dist/img/room2.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="image">
            <img src="../../dist/img/room3.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="image">
            <img src="../../dist/img/room4.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
    </div>
        
    @extends('layout')
    
    @section('content')

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="mb-4">
        <label for="date" class="block text-gray-700 dark:text-gray-300">Date:</label>
        <input type="date" id="date" name="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        <div id="dateError" class="text-red-500"></div>
    </div>

    <div class="grid grid-cols-3 gap-4">
        @php
            $times = ['12 AM', '1 AM', '2 AM', '3 AM', '4 AM', '5 AM', '6 AM', '7 AM', '8 AM', '9 AM', '10 AM', '11 AM', '12 PM', '1 PM', '2 PM', '3 PM', '4 PM', '5 PM', '6 PM', '7 PM', '8 PM', '9 PM', '10 PM', '11 PM'];
        @endphp
        @for ($i = 0; $i < 23; $i++)
            @php
                $start = $times[$i];
                $end = $times[$i + 1];
            @endphp
            <form action="{{ route('book.slot', ['slot' => $start . 'to' . $end]) }}" method="POST" class="slot-form">
                @csrf
                <input type="hidden" name="date" class="date-input">
                <button type="submit" class="slot-btn bg-blue-500 hover:bg-blue-700 dark:bg-blue-300 dark:hover:bg-blue-100 text-white py-4 px-32 rounded-md shadow-md transition-colors">
                    Time {{ $start }} to {{ $end }}
                </button> 
            </form>
        @endfor
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
        var scrollAmount = 1300 + 20; 
        var speed = 5000; 
        function scrollImages() {
            $('.image-carousel').animate({scrollLeft: '+=' + scrollAmount}, speed, 'linear', function() {
                $(this).append($('.image:first-child'));
                $(this).scrollLeft(0);
                scrollImages();
            });
        }
        scrollImages();

        $('#date').change(function() {
            var selectedDate = $(this).val();
            var formattedDate = selectedDate.replace(/-/g, '');
            $.ajax({
                url: "{{ route('get.booked.slots', '') }}/" + formattedDate,
                method: "GET",
                success: function(response) {
                    disableBookedSlots(response);
                }
            });
        });

        function disableBookedSlots(bookedSlots) {
            $('.slot-form button').prop('disabled', false); 
            bookedSlots.forEach(function(slot) {
                $('.slot-form button:contains("Time ' + slot.replace('to', ' to ') + '")').prop('disabled', true);
            });
        }

        document.querySelectorAll('.slot-form').forEach(function(form) {
            form.addEventListener('submit', function(event) {
                var dateInput = this.querySelector('.date-input');
                var selectedDate = document.getElementById('date').value;
                dateInput.value = selectedDate;
                
                if (selectedDate < new Date().toISOString().split('T')[0]) {
                    event.preventDefault(); 
                    document.getElementById('dateError').innerHTML = 'Please select a date on or after today.';
                }
            });
        });
    });
</script>
</html>
