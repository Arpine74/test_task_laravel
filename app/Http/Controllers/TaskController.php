<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Task\TaskStoreRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Exceptions\ModelCreateErrorException;
use App\Exceptions\ModelDeleteErrorException;
use App\Exceptions\ModelUpdateErrorException;
use App\Http\RequestTransformers\Task\TaskStoreTransformer;
use App\Http\RequestTransformers\Task\TaskUpdateTransformer;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Get All Tasks And Filter By Status
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(
            $this->taskService->getAll()
        );
    }

    /**
     * @param TaskStoreRequest $request
     * @return JsonResponse
     * @throws ModelCreateErrorException
     */
    public function store(TaskStoreRequest $request): JsonResponse
    {
        return response()->json(
            $this->taskService->store(
                (new TaskStoreTransformer())->transform($request)
            )
        );
    }

    /**
     * @param Task $task
     * @return JsonResponse
     */
    public function show(Task $task): JsonResponse
    {
        return response()->json($this->taskService->show($task));
    }

    /**
     * @param TaskUpdateRequest $request
     * @param Task $task
     * @return JsonResponse
     * @throws ModelUpdateErrorException
     */
    public function update(TaskUpdateRequest $request, Task $task): JsonResponse
    {
        return response()->json(
            $this->taskService->update((new TaskUpdateTransformer())->transform($request), $task),
        );
    }

    /**
     * @param Task $task
     * @return JsonResponse
     * @throws ModelDeleteErrorException
     */
    public function destroy(Task $task): JsonResponse
    {
        $this->taskService->delete($task);

        return response()->json();
    }
}
