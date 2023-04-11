<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Service;

class ServiceController extends Controller
{
    public function getServices()
    {
        $services=Service::paginate(5);
        return view('services.displayServices', ['services'=>$services]);
    }
}
