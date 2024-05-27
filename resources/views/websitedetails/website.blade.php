@extends('layouts.admin-leyout')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .custom-edit-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            margin-right: 5px;
        }

        .custom-trash-button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
        }

        .custom-trash-button:hover {
            background-color: #c82333;
        }

        .custom-trash-button:focus {
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.5);
        }

        .website-btn {
            margin-right: 15px;
        }

        .btn-dark {
            color: #fff;
            background-color: #343a40;
            border-color: #343a40;
            box-shadow: none;
            padding: 10px 20px;
            margin-bottom: 18px;
            margin-right: 0px;
        }

        .table td, .table th {
            text-align: center;
        }
    </style>
</head>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0">Website</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="custom-search-container">
                            
                        </div>
                        <a href="{{route('createWebsite')}}" class="btn btn-dark website-btn"><i class="fas fa-plus"></i></a>
                    </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width:20%">Website Url</th>
                                        <th style="width:10%">DA</th>
                                        <th style="width:10%">Category</th>
                                        <th style="width:15%">Fc Category</th>
                                        <th style="width:20%">Category Price</th>
                                        <th style="width:20%">Fc Category Price</th>
                                        <th style="width:5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($websites as $website)
                                    <tr>
                                        <td><a href="{{ $website->websiteurl }}" target="_blank">{{ $website->websiteurl }}</a></td>
                                        <td>{{$website->da}}</td>
                                        <td>{{ $website->category ?: '-' }}</td>
                                        <td>{{ $website->fcCategory ?: '-' }}</td>
                                        <td>{{ $website->categoryPrice ?: '-' }}</td>
                                        <td>{{ $website->fcCategoryprice ?: '-' }}</td>
                                        <td>
                                            <div style="display: flex;">
                                                <a href="{{ route('website.edit', $website->id) }}" class="btn btn-sm custom-edit-button">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('website.delete', $website->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm custom-trash-button" onclick="return confirm('Are you sure you want to delete this product?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
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
