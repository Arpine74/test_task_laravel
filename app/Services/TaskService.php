<?php

namespace App\Services;
use App\Exceptions\ModelCreateErrorException;
use App\Exceptions\ModelDeleteErrorException;
use App\Exceptions\ModelUpdateErrorException;
use App\Http\Repositories\TaskRepository;
use App\Http\Resources\TaskResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskService
{
    protected TaskRepository $repository;
    public function __construct(
        TaskRepository $repository,
    ) {
        $this->repository = $repository;
    }

    public function resource(): string
    {
        return TaskResource::class;
    }

    public function getAll(): JsonResource
    {
        $resource = $this->resource();

        return $resource::collection($this->repository->filters()->get());
    }

    public function store(array $data): JsonResource
    {
        $model = $this->repository->create($data);
        if ($this->repository->save($model)) {
            $resource = $this->resource();
            return new $resource($model); 
        }

        throw new ModelCreateErrorException();
    }

    public function show(Model $model): JsonResource
    {
        $resource = $this->resource();

        return new $resource($model);
    }

    /**
     * @param array $data
     * @param Model $model
     * @return JsonResource
     * @throws ModelUpdateErrorException
     */
    public function update(array $data, Model $model): JsonResource
    {
        if ($this->repository->update($model, $data)) {
            $resource = $this->resource();
            return new $resource($model);
        }

        throw new ModelUpdateErrorException();
    }

    /**
     * @param Model $model
     * @return bool
     * @throws ModelDeleteErrorException
     */
    public function delete(Model $model): bool
    {
        if ($this->repository->delete($model)) {
            return true;
        }

        throw new ModelDeleteErrorException();
    }
}
