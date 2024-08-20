<?php

namespace Evara\Base\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    protected Model $model;

    public function all()
    {
        return $this->model->all();
    }

    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    public function create(array $data): ?Model
    {
        foreach ($data as $field => $val) {
            $this->model->{$field} = $val;
        }
        $this->model->save();
        return $this->model;
    }

    public function update($model, array $data): ?Model
    {
        foreach ($data as $field => $val) {
            $model->{$field} = $val;
        }

        $model->save();
        return $this->model;
    }

    public function destroy($model): bool
    {
        return $model->delete() ? true : false;
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param Model $model
     */
    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

}
