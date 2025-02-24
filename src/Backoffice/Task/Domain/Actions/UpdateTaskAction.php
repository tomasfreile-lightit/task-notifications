<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\Actions;

use Lightit\Backoffice\Task\Domain\DataTransferObjects\UpdateTaskDTO;
use Lightit\Backoffice\Task\Domain\Models\Task;

class UpdateTaskAction
{
    public function execute(Task $task, UpdateTaskDTO $dto): Task
    {
        $task->update($dto->toArray());

        return $task->fresh();
    }
} 