<?php

namespace Evara\Base\Repositories;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function all();
    public function find($id): ?Model;
    public function create(array $data): ?Model;
    public function update(Model $model, array $data): ?Model;
    public function destroy(Model $model): ?bool;
}
