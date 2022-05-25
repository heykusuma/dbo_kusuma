<?php

namespace App\Repositories\Eloquent;

abstract class BaseRepository 
{
    private $model;

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    abstract public function getModel(): string;

    protected function modelName(string $modelName)
    {
        return new $modelName;
    }

    public function getAll(array $with, string $order)
    {
        return $this->modelName($this->model)->with($with)->orderBy($order, 'desc')->paginate(10);
    }

    public function getOne(int $id, array $with)
    {
        return $this->modelName($this->model)->with($with)->where('id', '=', $id)->first();
    }

    public function getOneBy(string $column, string $value, array $with)
    {
        return $this->modelName($this->model)->with($with)->where($column, $value)->first();
    }

    public function insert(array $data)
    {
        return $this->modelName($this->model)->create($data);

    }

    public function update(array $data, int $id)
    {
        return $this->modelName($this->model)->where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->modelName($this->model)->where('id', '=', $id)->delete();
    }

}
