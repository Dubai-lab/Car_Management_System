<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    // Display all vehicles
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('vehicles.index', compact('vehicles'));
    }

    // Show form to create a new vehicle
    public function create()
    {
        return view('vehicles.create');
    }

    // Store a new vehicle
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imageFilename = null;
        if ($request->hasFile('image')) {
            $imageFilename = $request->file('image')->store('vehicles', 'public');
        }

        Vehicle::create([
            'vehicle_name' => $request->vehicle_name,
            'model' => $request->model,
            'price' => $request->price,
            'image_filename' => $imageFilename,
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle added successfully.');
    }

    // Show a single vehicle
    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicles.show', compact('vehicle'));
    }

    // Show form to edit a vehicle
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicles.edit', compact('vehicle'));
    }

    // Update a vehicle
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'vehicle_name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($vehicle->image_filename) {
                Storage::disk('public')->delete($vehicle->image_filename);
            }
            $vehicle->image_filename = $request->file('image')->store('vehicles', 'public');
        }

        $vehicle->vehicle_name = $request->vehicle_name;
        $vehicle->model = $request->model;
        $vehicle->price = $request->price;
        $vehicle->save();

        return redirect()->route('vehicles.show', $vehicle->id)->with('success', 'Vehicle updated successfully.');
    }

    // Delete a vehicle
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        if ($vehicle->image_filename) {
            Storage::disk('public')->delete($vehicle->image_filename);
        }
        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }

    // Search vehicles by name or model
    public function search(Request $request)
    {
        $query = $request->input('query');
        $vehicles = Vehicle::where('vehicle_name', 'like', "%$query%")
            ->orWhere('model', 'like', "%$query%")
            ->get();

        return view('vehicles.index', compact('vehicles'));
    }
}
