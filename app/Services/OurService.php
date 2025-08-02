<?php

namespace App\Services;

use App\Repositories\Contracts\ServiceRepositoryInterface;

class OurService
{
    public function __construct(protected ServiceRepositoryInterface $repo) {}

    public function store(array $data)
    {
        return $this->repo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }

    public function all()
    {
        return $this->repo->all();
    }
}