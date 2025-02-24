<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\Actions;

use Lightit\Backoffice\Task\Domain\DataTransferObjects\TaskDTO;
use Lightit\Backoffice\Task\Domain\Models\Task;

class UpsertTaskAction
{
    public function execute(TaskDTO $dto, Task|null $task = null): Task
    {
        if ($task) {
            $task->update($dto->toArray());

            return $task->fresh();
        }

        return Task::create($dto->toArray());
    }
}
