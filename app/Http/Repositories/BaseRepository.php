<?php

namespace App\Http\Repositories;

use App\Exceptions\CustomErrorException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Throwable;

/**
 * Class BaseRepository
 * @package App\Http\Repositories
 */
abstract class BaseRepository
{
    protected Model | Builder $model;
    protected ?int $updateId = null;

    /**
     * Find by id
     *
     * @param int $id
     * @param bool $isTrashed
     * @param array $relation
     * @param array $where
     * @param array $select
     * @return Model|null
     */
    public function findById(
        int $id,
        bool $isTrashed = false,
        array $where = [],
        array $relation = [],
        array $select = ['*'],
    ): ?Model {
        $model = $this->model;

        if ($isTrashed) {
            $model = $model->withTrashed();
        }

        if (!empty($select)) {
            $model = $model->select($select);
        }

        if (!empty($where)) {
            $model = $model->where($where);
        }

        if (!empty($relation)) {
            $model = $model->with($relation);
        }

        return $model
            ->find($id);
    }

    /**
     * Find or fail
     *
     * @param int $id
     * @return Model
     */
    public function findOrFail(int $id): Model
    {
        return $this
            ->model
            ->findOrFail($id);
    }

    /**
     * Create one model
     * @param array $data
     * @return Model
     * @throws CustomErrorException
     */
    public function create(array $data): Model
    {
        try {
            return $this
                ->model
                ->create($data);
        } catch (Throwable $e) {
            throw new CustomErrorException($e->getMessage(), 422);
        }
    }

    /**
     * Insert many models by array
     *
     * @param array $dataOfModels
     * @return bool
     */
    public function insert(array $dataOfModels): bool
    {
        return $this->model->insert($dataOfModels);
    }

    /**
     * Update
     *
     * @param Model $model
     * @param array $data
     * @return bool
     * @throws CustomErrorException
     */
    public function update(
        Model $model,
        array $data = [],
    ): bool {
        try {
            return $model->update($data);
        } catch (Throwable $e) {
            throw new CustomErrorException($e->getMessage(), 422);
        }
    }

    /**
     * Save by model
     *
     * @param Model $model
     * @return bool
     */
    public function save(Model $model): bool
    {
        return $model
            ->save();
    }

    /**
     * Delete model
     *
     * @param Model $model
     * @return bool
     */
    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    /**
     * Get
     *
     * @return Collection
     */
    public function get(): Collection {
        return $this->model->get();
    }
}
