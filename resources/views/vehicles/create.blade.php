@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Vehicle</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vehicles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="vehicle_name">Vehicle Name</label>
            <input type="text" name="vehicle_name" id="vehicle_name" class="form-control" value="{{ old('vehicle_name') }}" required>
        </div>

        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" name="model" id="model" class="form-control" value="{{ old('model') }}" required>
        </div>

        <div class="form-group">
            <label for="price">Price ($)</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="image">Vehicle Image</label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Add Vehicle</button>
    </form>
</div>
@endsection
