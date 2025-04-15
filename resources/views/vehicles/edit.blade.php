@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Vehicle</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="vehicle_name">Vehicle Name</label>
            <input type="text" name="vehicle_name" id="vehicle_name" class="form-control" value="{{ old('vehicle_name', $vehicle->vehicle_name) }}" required>
        </div>

        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" name="model" id="model" class="form-control" value="{{ old('model', $vehicle->model) }}" required>
        </div>

        <div class="form-group">
            <label for="price">Price ($)</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $vehicle->price) }}" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="image">Vehicle Image</label>
            @if($vehicle->image_filename)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $vehicle->image_filename) }}" alt="{{ $vehicle->vehicle_name }}" class="img-fluid" style="max-height: 200px;">
                </div>
            @endif
            <input type="file" name="image" id="image" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Vehicle</button>
    </form>
</div>
@endsection
