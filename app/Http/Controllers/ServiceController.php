<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    // for displaying the services to user and guest
    public function getServices()
    {
        $services = Service::paginate(5);
        return view('services.displayService', ['services' => $services]);
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $service = Service::create($validatedData);

        return redirect('/services');
    }

    public function show(Service $service)
    {
        if (Auth::guard('admin')->check()) {
            $admin = Auth::user();
            $admin_id = $admin->id;
            session(['admin_id' => $admin_id]);
            $service = Service::paginate(5);
            return view('services.updateService', ['id' => $admin_id], ['services' => $service], compact('service'));
        }
    }

    public function edit(Service $service)
    {
        return view('services.updateService', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $service->update($validatedData);

        return redirect('/services/' . $service->id);
    }

   

}
