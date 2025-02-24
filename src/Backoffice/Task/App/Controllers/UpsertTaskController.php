<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Task\App\Requests\UpsertTaskRequest;
use Lightit\Backoffice\Task\App\Transformers\TaskTransformer;
use Lightit\Backoffice\Task\Domain\Actions\UpsertTaskAction;
use Lightit\Backoffice\Task\Domain\Models\Task;

class UpsertTaskController
{
    public function __invoke(UpsertTaskRequest $request, UpsertTaskAction $action, Task|null $task = null): JsonResponse
    {
        $task = $action->execute($request->toDto(), $task);

        return responder()
            ->success($task, TaskTransformer::class)
            ->respond($task->wasRecentlyCreated ? JsonResponse::HTTP_CREATED : JsonResponse::HTTP_OK);
    }
}
