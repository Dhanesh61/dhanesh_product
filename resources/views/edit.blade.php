@extends('layouts.admin-leyout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark">

        <!-- Links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-light"  href="/">Products</a>
          </li>
      
        </ul>
      </nav>

      @if($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <strong>{{$message}}</strong>  
        </div>
      @endif

    <div class="container">
      <div class="row justify-content-center"> 
        <div class="col-sm-8">
            <div class="card mt-3 p-3">
                <h3>Product Edit</h3>
            <form action="/product_update/{{$product->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Name:</label>
                    <input type="text" name="name" class="form-control" value="{{old('name',$product->name)}}">
                    @if($errors->has('name'))
                    <span class="text-danger">{{$errors->first('name')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Description:</label>
                    <textarea class="form-control" rows="3" name="description">{{old('description',$product->description)}}</textarea>
                    @if($errors->has('description'))
                    <span class="text-danger">{{$errors->first('description')}}</span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="">Product Price:</label>
                  <input type="number" class="form-control" name="price" value="{{old('price',$product->price)}}">
                  @if($errors->has('price'))
                  <span class="text-danger">{{$errors->first('price')}}</span>
                  @endif
                </div>
                <div class="form-group">
                    <label for="">Image:</label>
                    <input type="file" name="image" class="form-control">
                    @if($errors->has('image'))      
                    <span class="text-danger">{{$errors->first('image')}}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
            </div>
        </div>
      </div>
    </div>
</body>
</html>
@endsection