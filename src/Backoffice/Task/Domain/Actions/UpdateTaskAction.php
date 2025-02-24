<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\Actions;

use Lightit\Backoffice\Task\Domain\DataTransferObjects\TaskDTO;
use Lightit\Backoffice\Task\Domain\Models\Task;

class UpdateTaskAction
{
    public function execute(Task $task, TaskDTO $dto): Task
    {
        $task->update([
            'title' => $dto->title,
            'description' => $dto->description,
            'status' => $dto->status,
            'employee_id' => $dto->employee_id,
        ]);

        return $task;
    }
}
