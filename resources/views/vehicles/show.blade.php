@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $vehicle->vehicle_name }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($vehicle->image_filename)
        <img src="{{ asset('storage/' . $vehicle->image_filename) }}" alt="{{ $vehicle->vehicle_name }}" class="img-fluid mb-3">
    @endif

    <p><strong>Model:</strong> {{ $vehicle->model }}</p>
    <p><strong>Price:</strong> ${{ number_format($vehicle->price, 2) }}</p>

    <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-primary">Edit</a>

    <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this vehicle?')">Delete</button>
    </form>

    <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
