<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Traits\{
    ApiResponse,
    HandleAPIException
};
use App\Services\OurService;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    use ApiResponse, HandleAPIException;

    public function __construct(protected OurService $srv) {}

    /**
     * Customer + Admin: Get all active services
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->handleExceptions(function () {
            $services = $this->srv->all();

            return $this->success(
                ServiceResource::collection($services),
                'Services fetched successfully'
            );
        });
    }

    /**
     * Admin: Create a new service
     *
     * @param ServiceRequest $request
     * @return JsonResponse
     */
    public function store(ServiceRequest $request): JsonResponse
    {
        return $this->handleExceptions(function () use ($request) {
            $service = $this->srv->store($request->validated());

            return $this->success(
                new ServiceResource($service),
                'Service created successfully',
                201
            );
        });
    }

    /**
     * Admin: show a service
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->handleExceptions(function () use ($id) {
            $service = $this->srv->find($id);

            return $this->success(
                new ServiceResource($service),
                'Service retrieved'
            );
        });
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
        return $this->handleExceptions(function () use ($request, $id) {
            $service = $this->srv->update($id, $request->validated());

            return $this->success(
                new ServiceResource($service),
                'Service updated successfully'
            );
        });
    }

    /**
     * Admin: Delete a service
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->handleExceptions(function () use ($id) {
            $this->srv->delete($id);

            return $this->success(null, 'Service deleted successfully');
        });
    }
}
