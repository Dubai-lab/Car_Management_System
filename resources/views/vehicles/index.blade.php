@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Vehicles</h1>

    <form action="{{ route('vehicles.search') }}" method="GET" class="mb-3">
        <input type="text" name="query" placeholder="Search by name or model" value="{{ request('query') }}">
        <button type="submit">Search</button>
    </form>

    <a href="{{ route('vehicles.create') }}" class="btn btn-primary mb-3">Add New Vehicle</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($vehicles->count())
        <div class="row">
            @foreach($vehicles as $vehicle)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        @if($vehicle->image_filename)
                            <img src="{{ asset('storage/' . $vehicle->image_filename) }}" class="card-img-top" alt="{{ $vehicle->vehicle_name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $vehicle->vehicle_name }}</h5>
                            <p class="card-text">Model: {{ $vehicle->model }}</p>
                            <p class="card-text">Price: ${{ number_format($vehicle->price, 2) }}</p>
                            <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No vehicles found.</p>
    @endif
</div>
@endsection
