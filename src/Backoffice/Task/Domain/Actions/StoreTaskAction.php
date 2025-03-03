<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\Actions;

use Lightit\Backoffice\Employee\App\Notifications\NewTaskAssignmentNotification;
use Lightit\Backoffice\Employee\Domain\Models\Employee;
use Lightit\Backoffice\Task\Domain\DataTransferObjects\TaskDTO;
use Lightit\Backoffice\Task\Domain\Models\Task;

class StoreTaskAction
{
    public function execute(TaskDTO $dto): Task
    {
        $task = Task::create([
            'title' => $dto->title,
            'description' => $dto->description,
            'status' => $dto->status,
            'employee_id' => $dto->employeeId,
        ]);

        $employee = Employee::findOrFail($dto->employeeId);

        $employee->notify(new NewTaskAssignmentNotification($task));

        return $task;
    }
}
