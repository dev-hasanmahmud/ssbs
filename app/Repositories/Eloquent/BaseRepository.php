<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    abstract protected function model(): string;

    protected function resolveModel()
    {
        return app()->make($this->model());
    }

    public function newQuery()
    {
        return $this->model->newQuery();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->find($id);
        $model->update($data);

        return $model;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
