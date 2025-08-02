<?php

namespace App\Services;

use App\Repositories\Contracts\ServiceRepositoryInterface;

class OurService
{
    public function __construct(protected ServiceRepositoryInterface $repo) {}

    public function store(array $data)
    {
        if (empty($data)) {
            throw new \Exception('Data cannot be empty', 400);
        }
        
        return $this->repo->create($data);
    }

    public function update($id, array $data)
    {
        if (empty($id)) {
            throw new \Exception('ID is required for update', 400);
        }

        if (empty($data)) {
            throw new \Exception('Update data cannot be empty', 400);
        }

        return $this->repo->update($id, $data);
    }

    public function delete($id)
    {
        if (empty($id)) {
            throw new \Exception('ID is required for deletion', 400);
        }

        return $this->repo->delete($id);
    }

    public function find($id)
    {
        if (empty($id)) {
            throw new \Exception('ID is required to find the resource', 400);
        }

        return $this->repo->find($id);
    }

    public function all()
    {
        return $this->repo->all();
    }
}