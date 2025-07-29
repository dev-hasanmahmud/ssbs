<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    use ApiResponse;

    /**
     * Customer + Admin: Get all active services
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $services = Service::where('status', 'active')->get();

        return $this->success(
            ServiceResource::collection($services),
            'Services fetched successfully'
        );
    }

    /**
     * Admin: Create a new service
     *
     * @param ServiceRequest $request
     * @return JsonResponse
     */
    public function store(ServiceRequest $request): JsonResponse
    {
        $service = Service::create($request->validated());

        return $this->success(
            new ServiceResource($service),
            'Service created successfully',
            201
        );
    }

    /**
     * Admin: Update an existing service
     *
     * @param ServiceRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ServiceRequest $request, int $id): JsonResponse
    {
        $service = Service::findOrFail($id);
        $service->update($request->validated());

        return $this->success(
            new ServiceResource($service),
            'Service updated successfully'
        );
    }

    /**
     * Admin: Delete a service
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return $this->success(null, 'Service deleted successfully');
    }
}
