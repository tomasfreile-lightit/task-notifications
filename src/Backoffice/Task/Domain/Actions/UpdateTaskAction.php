<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\Actions;

use Lightit\Backoffice\Employee\App\Notifications\ReassignedTaskNotification;
use Lightit\Backoffice\Employee\Domain\Models\Employee;
use Lightit\Backoffice\Task\Domain\DataTransferObjects\TaskDTO;
use Lightit\Backoffice\Task\Domain\Models\Task;

class UpdateTaskAction
{
    public function execute(Task $task, TaskDTO $dto): Task
    {
        $previousEmployeeId = $task->employee_id;

        $task->update([
            'title' => $dto->title,
            'description' => $dto->description,
            'status' => $dto->status,
            'employee_id' => $dto->employeeId,
        ]);

        if ($previousEmployeeId !== $task->employee_id) {
            $employee = Employee::findOrFail($task->employee_id);
            $employee->notify(new ReassignedTaskNotification($task));
        }

        return $task;
    }
}
