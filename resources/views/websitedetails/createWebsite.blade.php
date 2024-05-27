@extends('layouts.admin-leyout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Website</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <style>
        .vali-red {
            color: red;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-light" href="#">Website</a>
            </li>
        </ul>
    </nav>

    @if($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <strong>{{ $message }}</strong>
    </div>
    @endif

    <div class="container">
        <div class="row justify-content-center"> 
            <div class="col-sm-8">
                <div class="card mt-3 p-3">
                    <form id="websiteForm" action="{{ route('storeWebsite') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="websiteurl">Website URL:</label>
                            <input type="text" name="websiteurl" class="form-control" value="{{ old('websiteurl') }}">
                            @error('websiteurl')
                                <div class="vali-red">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="da">DA:</label>
                            <input type="number" name="da" class="form-control" value="{{ old('da') }}">
                            @error('da')
                                <div class="vali-red">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Category:</label>
                            <div>
                                @php
                                    $categories = ['food' => 'Food', 'toy' => 'Toy', 'study' => 'Study', 'job' => 'Job'];
                                @endphp
                                @foreach($categories as $value => $label)
                                    <input type="checkbox" name="category[]" value="{{ $value }}" id="category{{ ucfirst($value) }}" {{ is_array(old('category')) && in_array($value, old('category')) ? 'checked' : '' }}> 
                                    <label for="category{{ ucfirst($value) }}">{{ $label }}</label>
                                @endforeach
                                @error('category')
                                <div class="vali-red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fcCategory">FC Category:</label>
                            <div>
                                @php
                                    $fcCategories = ['Java' => 'Java', 'Php' => 'Php', 'Kotlin' => 'Kotlin', 'Mysql' => 'Mysql'];
                                @endphp
                                @foreach($fcCategories as $value => $label)
                                    <input type="checkbox" name="fcCategory[]" value="{{ $value }}" id="category{{ ucfirst($value) }}" {{ is_array(old('fcCategory')) && in_array($value, old('fcCategory')) ? 'checked' : '' }}> 
                                    <label for="category{{ ucfirst($value) }}">{{ $label }}</label>
                                @endforeach
                                @error('fcCategory')
                                <div class="vali-red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="categoryPrice">Category Price:</label>
                            <input type="number" name="categoryPrice" class="form-control" value="{{ old('categoryPrice') }}">
                            @error('categoryPrice')
                                <div class="vali-red">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fcCategoryprice">FC Category Price:</label>
                            <input type="number" name="fcCategoryprice" class="form-control" value="{{ old('fcCategoryprice') }}">
                            @error('fcCategoryprice')
                                <div class="vali-red">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#websiteForm').validate({
                rules: {
                    websiteurl: {
                        required: true,
                        url: true
                    },
                    da: {
                        required: true,
                        number: true,
                        min: 1,
                        max: 100
                    },
                    'category[]': {
                        required: function(element) {
                            return !$('input[name="fcCategory[]"]:checked').length;
                        }
                    },
                    'fcCategory[]': {
                        required: function(element) {
                            return !$('input[name="category[]"]:checked').length;
                        }
                    },
                    categoryPrice: {
                        required: function(element) {
                            return $('input[name="category[]"]:checked').length;
                        },
                        number: true
                    },
                    fcCategoryprice: {
                        required: function(element) {
                            return $('input[name="fcCategory[]"]:checked').length;
                        },
                        number: true
                    }
                },
                messages: {
                    websiteurl: {
                        required: "Website URL is required.",
                        url: "Website URL must be a valid URL."
                    },
                    da: {
                        required: "DA is required.",
                        number: "DA must be a number.",
                        min: "DA must be at least 1.",
                        max: "DA must not be more than 100."
                    },
                    'category[]': {
                        required: "Category is required if FC Category is not selected."
                    },
                    'fcCategory[]': {
                        required: "FC Category is required if Category is not selected."
                    },
                    categoryPrice: {
                        required: "Category Price is required if Category is selected.",
                        number: "Category Price must be a number."
                    },
                    fcCategoryprice: {
                        required: "FC Category Price is required if FC Category is selected.",
                        number: "FC Category Price must be a number."
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "category[]" || element.attr("name") == "fcCategory[]") {
                        error.appendTo(element.closest('div'));
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });
    </script>
</body>
</html>


@endsection
