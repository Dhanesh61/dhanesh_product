@extends('layouts.admin-leyout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0">Room</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr> 
                                    <th>Id</th>
                                    <th>User Id</th>
                                    <th>Slot</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                    <tr>
                                    <td>{{ $room->id }}</td>
                                    <td>{{ $room->user_id }}</td>
                                    <td>{{ $room->slot }}</td>
                                    <td>{{ $room->date }}</td>
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

