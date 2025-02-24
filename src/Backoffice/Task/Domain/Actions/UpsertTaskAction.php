<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\Actions;

use Lightit\Backoffice\Task\Domain\DataTransferObjects\TaskDTO;
use Lightit\Backoffice\Task\Domain\Enums\TaskStatus;
use Lightit\Backoffice\Task\Domain\Models\Task;

class UpsertTaskAction
{
    public function execute(TaskDTO $dto, ?Task $task = null): Task
    {
        if ($task) {
            $updateData = $dto->toArray();
            
            if (empty($updateData)) {
                return $task;
            }

            $task->update($updateData);
            return $task->fresh();
        }

        return Task::create([
            'title' => $dto->title,
            'description' => $dto->description,
            'status' => $dto->status ?? TaskStatus::Pending,
            'employee_id' => $dto->employee_id,
        ]);
    }
}
