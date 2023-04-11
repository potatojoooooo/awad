<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function getServices()
    {
        // $services = DB::table('services')->get();
        // return view('services')->with('services', $services);

        $services = Service::paginate(5);
        return view('services', ['services' => $services]);
    }

    public function index()
    {
        $services = Service::paginate(5);
        return view('services.index', compact('services'));
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
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
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

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect('/services');
    }
}
