<?php

namespace App\Http\Repositories;

use App\Models\Task;
use App\Traits\FilterableTrait;

/**
 * Class TaskRepository
 */
class TaskRepository extends BaseRepository
{
    use FilterableTrait;

    /**
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->model = $task;
    }

    public function filters()
    {
        return $this->model->filter(request()->only('status'));
    }
}
