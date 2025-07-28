<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        return Service::where('status', 'active')->get();
    }

    public function store(ServiceRequest $request)
    {
        $service = Service::create($request->validated());
        
        return response()->json($service, 201);
    }

    public function update(ServiceRequest $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->validated());

        return response()->json($service);
    }

    public function destroy($id)
    {
        return Service::destroy($id);
    }
}

