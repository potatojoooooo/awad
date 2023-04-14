<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function getServices()
    {
        // $services = DB::table('services')->get();
        // return view('services')->with('services', $services);

        $services = Service::paginate(5);
        return view('services.displayService', ['services' => $services]);
    }

    public function createService(Request $request)
    {
        // Check if the user is authorized to create a service
        if (Gate::denies('create', Service::class)) {
            abort(403);
        }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload the image file if provided
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('services', 'public');
        }

        // Create a new service with the validated data
        $service = new Service();
        $service->name = $validatedData['name'];
        $service->price = $validatedData['price'];
        $service->description = $validatedData['description'];
        $service->image = $imagePath;
        $service->save();

        // Redirect the user to the service details page
        return redirect()->route('services.admin', ['id' => $service->id])->with('createSuccess', 'Service created successfully');;
    }


    public function displayService($id)
    {
        // Find the service by ID
        $service = Service::findOrFail($id);

        // Check if the user is authorized to view the service
        if (Gate::denies('view', $service)) {
            abort(403);
        }

        // Display the service details
        $services = Service::paginate(5);
        return view('services.displayService', [
            'services' => $services
        ]);
    }

    public function edit($id)
    {
        // Retrieve the service with the given ID
        $service = Service::find($id);

        // Pass the service to the view
        return view('services.updateService', compact('service'));
    }



    public function updateService(Request $request, $id)
    {
        // Find the service by ID
        $service = Service::findOrFail($id);

        // Check if the user is authorized to update the service
        if (Gate::denies('update', $service)) {
            abort(403);
        }

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|max:1024', // Assuming the image is optional and has a max size of 1MB
        ]);

        // Update the attributes of the service
        $service->name = $validatedData['name'];
        $service->price = $validatedData['price'];
        $service->description = $validatedData['description'];

        // Handle the image upload (if any)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $image->storeAs('public/images', $filename);
            $service->image = $filename;
        }

        // Save the updated service
        $service->save();

        // Redirect the user to the updated service page
        return redirect()->route('services.admin', ['id' => $service->id])->with('updateSuccess', 'Service updated successfully');;
    }

    public function deleteService($id)
    {
        $service = Service::findOrFail($id);

        // Check if the user is authorized to delete the service
        if (Gate::denies('delete', $service)) {
            abort(403);
        }

        $adminId = session()->get('admin_id');

        $service->delete();
        return redirect()->route('services.admin', ['id' => $adminId])->with('deleteSuccess', 'Service deleted successfully');
    }
}
