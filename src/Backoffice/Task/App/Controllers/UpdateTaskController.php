<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Task\App\Requests\UpdateTaskRequest;
use Lightit\Backoffice\Task\App\Transformers\TaskTransformer;
use Lightit\Backoffice\Task\Domain\Actions\UpdateTaskAction;
use Lightit\Backoffice\Task\Domain\DataTransferObjects\TaskDTO;
use Lightit\Backoffice\Task\Domain\Models\Task;

class UpdateTaskController
{
    public function __invoke(Task $task, UpdateTaskRequest $request, UpdateTaskAction $action): JsonResponse
    {
        $currentTaskDto = new TaskDTO(
            title: $task->title,
            description: $task->description,
            status: $task->status,
            employeeId: $task->employee_id,
        );

        $updatedTask = $action->execute($task, $request->toDto($currentTaskDto));

        return responder()
            ->success($updatedTask, TaskTransformer::class)
            ->respond();
    }
}
