<?php

namespace App\Repositories;

use App\Contracts\IBaseRepository;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\isNull;

class BaseRepository implements IBaseRepository
{
    private Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create($entity)
    {
        return $this->model->create($entity);
    }

    public function all(int $pageSize)
    {
        return $this->model->withTrashed()
            ->paginate($pageSize);
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function update($id, $entity): bool
    {
        return $this->findById($id)->update($entity);
    }

    public function delete($id): int
    {
        $selectedModel = $this->findById($id);
        if ($selectedModel == null)
            return 0;
        return $selectedModel->delete();
    }
}
